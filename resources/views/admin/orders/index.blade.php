@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        <a  href="{{ url('admin/order/create') }}" class="btn btn-flat btn-info inline">Opret ny ordre</a>
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
                            <th></th>
                            <th>Ordrenummer</th>
                            <th>Navn</th>
                            <th>E-mail</th>
                            <th>Købt</th>
                            <th>Betalingsmetode</th>
                            <th>Total</th>
                            <th>Handling</th>
                        </tr>
                        @foreach($orders as $order)
                        <tr>
                            <td><input type="checkbox" name="" value="" /></td>
                            <td>#1</td>
                            <td>Ronni H. Baslund</td>
                            <td>ronnibaslund@gmail.com</td>
                            <td>04/11/2015 21:05:05</td>
                            <td>Kreditkort</td>
                            <td>999,99 DKK</td>
                            <td>
                                <a href="#" class="btn btn-default btn-sm" title="Se"><i class="fa fa-eye"></i></a>
                                <a href="#" class="btn btn-default btn-sm" title="Redigere"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-default btn-sm" title="Faktura"><i class="fa fa-file-text-o"></i></a>
                                <a href="#" class="btn btn-default btn-sm" title="Følgeseddel"><i class="fa fa-file-text"></i></a>
                                <a href="#" class="btn btn-danger btn-sm" title="Slet"><i class="fa fa-trash"></i></a>

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>


                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    @include('pagination.default', ['paginator' => $orders, 'class' => 'pagination-sm no-margin pull-right'])
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>

@endsection