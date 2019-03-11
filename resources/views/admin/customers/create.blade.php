@extends('admin.layout')

@section('content')

    <div class="row">

        @if(isset($customer))
            <form action="/admin/customer/{{ $customer->id }}" method="post">
        @else
            <form action="/admin/customer" method="post">
                <input type="hidden" name="_method" value="PUT">
        @endif

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="col-md-6">

                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <h3 class="box-title">Betalingsadresse</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            @include('admin.customers.partial.address', ['countries' => $countries, 'address' => $primary, 'type' => 'is_primary'])

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            {{--<button type="submit" class="btn btn-primary">Save</button>--}}
                        </div>

                    </div>
                    <!-- /.box -->



                </div>
                <div class="col-md-6">

                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <h3 class="box-title">Leveringsadresse</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            @include('admin.customers.partial.address', ['countries' => $countries, 'address' => $shipping, 'type' => 'is_shipping'])

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
            //$('#description').wysihtml5();
            //$("#expire_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
        });

    </script>
@endsection