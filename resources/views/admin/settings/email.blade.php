@extends('admin.layout')
@section('content')

    <div class="row">
        <div class="col-xs-12">

            <form action="/admin/settings/email" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box box-info">
                    <div class="box-header">
                        {{--<h3 class="box-title">Email Indstillinger</h3>--}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="form-group">
                            <label>Fra Email</label>
                            <input type="text" name="mail_from" class="form-control" value="<?php echo shop_config('mail_from', 'EMAIL'); ?>">
                        </div>

                        <div class="form-group">
                            <label>Fra navn</label>
                            <input type="text" name="mail_from_name" class="form-control" value="<?php echo shop_config('mail_from_name', 'EMAIL'); ?>">
                        </div>


                        SMTP Options

                        <div class="form-group">
                            <label>SMTP Host</label>
                            <input type="text" name="smtp_host" class="form-control" value="<?php echo shop_config('smtp_host', 'EMAIL'); ?>">
                        </div>

                        <div class="form-group">
                            <label>SMTP Port</label>
                            <input type="text" name="smtp_port" class="form-control" value="<?php echo shop_config('smtp_port', 'EMAIL'); ?>">
                        </div>

                        Encryption
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="smtp_ssl" id="optionsRadios1" value="none" @if(shop_config('smtp_ssl', 'EMAIL') == 'none') checked @endif>
                                    No encryption.
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="smtp_ssl" id="optionsRadios2" value="ssl" @if(shop_config('smtp_ssl', 'EMAIL') == 'ssl') checked @endif>
                                    Use SSL encryption.
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="smtp_ssl" id="optionsRadios3" value="smtp_ssl_tls" @if(shop_config('smtp_ssl', 'EMAIL') == 'smtp_ssl_tls') checked @endif>
                                    Use TLS encryption. This is not the same as STARTTLS. For most servers SSL is the recommended option.
                                </label>
                            </div>
                        </div>

                        Authentication
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="smtp_auth" id="optionsRadios1" value="false" @if(shop_config('smtp_auth', 'EMAIL') == 'false') checked @endif>
                                    No: Do not use SMTP authentication.
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="smtp_auth" id="optionsRadios2" value="true" @if(shop_config('smtp_auth', 'EMAIL') == 'true') checked @endif>
                                    Yes: Use SMTP authentication.
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="smtp_user" class="form-control" value="<?php echo shop_config('smtp_user', 'EMAIL'); ?>">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="smtp_pass" class="form-control" value="<?php echo shop_config('smtp_pass', 'EMAIL'); ?>">
                        </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <!-- /.box -->
            </form>
        </div>
    </div>

@endsection