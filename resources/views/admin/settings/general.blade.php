@extends('admin.layout')
@section('content')

    <div class="row">
        <div class="col-xs-12">

            <form action="/admin/settings/general" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box box-info">
                    <div class="box-header">
                        {{--<h3 class="box-title">Email Indstillinger</h3>--}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="form-group">
                            <label>Sidetitel</label>
                            <input type="text" name="shop_name" class="form-control" value="<?php echo shop_config('shop_name', 'GENERAL'); ?>">
                        </div>

                        <div class="form-group">
                            <label>Tagline</label>
                            <input type="text" name="shop_description" class="form-control" value="<?php echo shop_config('shop_description', 'GENERAL'); ?>">
                        </div>

                        <div class="form-group">
                            <label>Webstedsadresse (URL)</label>
                            <input type="text" name="shop_url" class="form-control" value="<?php echo shop_config('shop_url', 'GENERAL'); ?>">
                        </div>

                        <div class="form-group">
                            <label>E-mailadresse</label>
                            <input type="text" name="admin_email" class="form-control" value="<?php echo shop_config('admin_email', 'GENERAL'); ?>">
                            <div class="help-block">Denne e-mailadresse anvendes til administrative formål som notifikation om nye brugere, ordre osv...</div>
                        </div>

                        {{-- TODO: Mangler at implementer --}}
                        {{--Tidszone--}}
                        {{--Datoformat--}}
                        {{--Tidsformat--}}
                        {{--Ugen starter på en--}}
                        {{--Webstedets sprog--}}

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