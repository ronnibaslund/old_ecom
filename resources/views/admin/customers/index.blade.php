@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        <a  href="{{ url('admin/customer/create') }}" class="btn btn-flat btn-info inline">Opret ny kunde</a>
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
                            <th>Email</th>
                            <th>Telefon</th>
                            <th></th>
                        </tr>
                        @foreach($customers as $customer)
                        <tr>
                            <td>#{{ $customer->id }}</td>
                            <td>{{ $customer->firstname }} {{ $customer->lastname }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td class="text-right">
                                <!--<a href="" class="btn btn-link" title="Show"><i class="fa fa-eye"></i></a>-->
                                <a href="{{ url("admin/customer/$customer->id/edit") }}" class="btn btn-link" title="Edit"><i class="fa fa-pencil"></i></a>
                                {{--<button class="btn btn-link" title="Delete"><i class="fa fa-trash"></i></button>--}}
                            </td>
                        </tr>
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