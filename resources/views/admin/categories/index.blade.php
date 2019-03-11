@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        <a  href="{{ url('admin/category/create') }}" class="btn btn-flat btn-info inline">Opret ny kategori</a>
                    </h3>

                    <div class="box-tools">

                        <div class="input-group" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control input-sm pull-right"
                                   placeholder="Search">

                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Navn</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        @foreach($categories as $category)
                            <?php echo renderCategoriesTrTree($category); ?>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection