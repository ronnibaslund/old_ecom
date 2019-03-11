@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        <a  href="{{ url('admin/coupon/create') }}" class="btn btn-flat btn-info inline">Opret nyt</a>
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
                            <th>Beløb</th>
                            <th>Status</th>
                            <th>Kode</th>
                            <th>Antal brugt</th>
                            <th></th>
                        </tr>
                        @foreach($coupons as $coupon)
                        <tr>
                            <td>#{{ $coupon->id }}</td>
                            <td>@currency($coupon->amount)</td>
                            <td><?php echo $coupon->active == 1? 'Aktiv':'Ikke aktiv'; ?></td>
                            <td>{{ $coupon->code }}</td>
                            <td>0</td> <!-- TODO: implementere antal brugte så det vises på listen -->
                            <td class="text-right">
                                <!--<a href="" class="btn btn-link" title="Show"><i class="fa fa-eye"></i></a>-->
                                <a href="{{ url("admin/coupon/$coupon->id/edit") }}" class="btn btn-link" title="Edit"><i class="fa fa-pencil"></i></a>
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