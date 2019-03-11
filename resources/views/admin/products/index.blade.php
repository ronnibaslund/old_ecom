@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        <a  href="{{ url('admin/product/create') }}" class="btn btn-flat btn-info inline">Opret nyt</a>
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
                            <th>Image</th>
                            <th>Navn</th>
                            <th>Varenummer</th>
                            <th>Lager</th>
                            <th>Pris</th>
                            <th></th>
                        </tr>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>[]</td>
                            <?php $description = $product->descriptions()->language(config('app.language_id'))->get(); //TODO: Set language_id global ?>
                            <td>{{ $description[0]->name or '' }}</td>
                            <td>{{ $product->item_number }}</td>
                            <td>
                                @if($product->stock_status == "instock")
                                    <span class="label label-success">In stock</span> x {{ $product->quantity }}
                                @else
                                    <span class="label label-danger">Out of stock</span> x {{ $product->quantity }}
                                @endif
                            </td>
                            <td>@currency($product->price)</td>
                            <td class="text-right">
                                <!--<a href="" class="btn btn-link" title="Show"><i class="fa fa-eye"></i></a>-->
                                <a href="{{ url("admin/product/$product->id/edit") }}" class="btn btn-link" title="Edit"><i class="fa fa-pencil"></i></a>
                                <button class="btn btn-link" title="Delete"><i class="fa fa-trash"></i></button>
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