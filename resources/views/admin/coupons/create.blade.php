@extends('admin.layout')

@section('content')

    <div class="row">

        @if(isset($coupon))
            <form action="/admin/coupon/{{ $coupon->id }}" method="post">
        @else
            <form action="/admin/coupon" method="post">
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

                            <div class="form-group">
                                <label for="name">Navn</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Skriv et navn"
                                       value="{{ $description->name or '' }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Beskrivelse</label>
                                <textarea id="description" name="description" placeholder="Enter text ..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;">{{ $description->description or '' }}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Type</label>
                                <select name="type" class="form-control">
                                    <option value="F">Fast pris</option>
                                    <option value="P">Procent</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="amount">Beløb</label>
                                <input type="number" step="0.10" class="form-control" id="amount" name="amount"
                                       placeholder="Skriv et beløb"
                                       value="{{ $coupon->amount or '0.00' }}">
                            </div>

                            <div class="form-group">
                                <label for="minimum_order_amount">Min. ordre beløb</label>
                                <input type="number" step="0.10" class="form-control" id="minimum_order_amount" name="minimum_order_amount"
                                       placeholder="Skriv et min. ordre beløb"
                                       value="{{ $coupon->minimum_order_amount or '0.00' }}">
                            </div>

                            <!-- start_date -->
                            <div class="form-group">
                                <label>Start dato:</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="start_date"
                                           id="start_date"
                                           data-inputmask="'alias': 'dd-mm-yyyy'" data-mask=""
                                           @if(isset($coupon->start_date) and $coupon->start_date != null and $coupon->start_date != '0000-00-00 00:00:00')
                                           value="{{ $coupon->start_date }}"
                                           @else
                                           value="{{ date('d-m-Y') }}"
                                            @endif
                                            >
                                </div>
                                <!-- /.input group -->
                            </div>

                            <!-- expire_date -->
                            <div class="form-group">
                                <label>Start dato:</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="expire_date"
                                           id="expire_date"
                                           data-inputmask="'alias': 'dd-mm-yyyy'" data-mask=""
                                           @if(isset($coupon->expire_date) and $coupon->expire_date != null and $coupon->expire_date != '0000-00-00 00:00:00')
                                           value="{{ $coupon->expire_date }}"
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
                                       value="{{ $coupon->code or @str_random(8) }}">
                            </div>

                            <div class="form-group">
                                <label for="uses_per_coupon">Antal gange en kupon må bruges</label>
                                <input type="number" step="1" class="form-control" id="uses_per_coupon" name="uses_per_coupon"
                                       placeholder="Skriv antal gange en kupon må bruges"
                                       value="{{ $coupon->uses_per_coupon or '1' }}">
                            </div>

                            <div class="form-group">
                                <label for="uses_per_customer">Antal gange en kupon må bruges pr. kunde</label>
                                <input type="number" step="1" class="form-control" id="uses_per_customer" name="uses_per_customer"
                                       placeholder="Skriv antal gange en kupon må bruges pr. kunde"
                                       value="{{ $coupon->uses_per_customer or '1' }}">
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

            $("#start_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
            $("#expire_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        });

    </script>
@endsection