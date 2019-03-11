@extends('admin.layout')

@section('content')

    <div class="row">

        @if(isset($giftcard))
            <form action="/admin/giftcard/{{ $giftcard->id }}" method="post">
        @else
            <form action="/admin/giftcard" method="post">
                <input type="hidden" name="_method" value="PUT">
        @endif

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="language_id" value="1"> <!-- TODO: Hente denne fra databasen -->

                <div class="col-xs-12">

                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <h3 class="box-title">Info</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <!-- status (active / not active) -->
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="active" {{ (isset($giftcard) && $giftcard->active == 1) ? 'checked':'' }}> Aktiv
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="amount">Beløb</label>
                                <input type="number" step="0.10" class="form-control" id="amount" name="amount"
                                       placeholder="Skriv et beløb"
                                       value="{{ $giftcard->amount or '0.00' }}">
                            </div>

                            <!-- expire_date -->
                            <div class="form-group">
                                <label>Udløbsdato:</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="expire_date"
                                           id="expire_date"
                                           data-inputmask="'alias': 'dd-mm-yyyy'" data-mask=""
                                           @if(isset($giftcard->expire_date) and $giftcard->expire_date != null and $giftcard->expire_date != '0000-00-00')
                                           value="{{ date('d-m-Y', strtotime($giftcard->expire_date)) }}"
                                           @else
                                           value="{{ date('d-m-Y') }}"
                                            @endif
                                            >
                                </div>
                                <!-- /.input group -->
                            </div>

                            <div class="form-group">
                                <label for="name">Kode</label>
                                <input type="text" class="form-control" id="code" name="code"
                                       placeholder="Skriv kode"
                                       value="{{ $giftcard->code or @str_random(8) }}">
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </div>
                    <!-- /.box -->


                </div>
            </form>
    </div>




    </div>

@endsection

@section('head_scripts')

@endsection

@section('footer_scripts')

    <script>
        $(function () {
            //bootstrap WYSIHTML5 - text editor
            $('#description').wysihtml5();
            $("#expire_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        });

    </script>
@endsection