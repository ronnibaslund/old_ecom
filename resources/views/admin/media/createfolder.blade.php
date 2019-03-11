@extends('admin.layout')

@section('content')

    <div class="row">


            <form action="/admin/media/folder" method="post">
            <input type="hidden" name="_method" value="PUT">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="path" value="{{ $path }}">

                        <div class="col-xs-12">

                            <!-- Info -->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Mappe</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="name">Mappe navn</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Navn"
                                               value="">
                                    </div>
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Opret</button>
                                </div>

                            </div>
                            <!-- /.box -->


                        </div>
                    </form>
    </div>

@endsection

@section('head_scripts')

@endsection

@section('footer_scripts')
@endsection