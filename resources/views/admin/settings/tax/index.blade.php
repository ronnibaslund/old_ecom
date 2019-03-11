@extends('admin.layout')
@section('content')

    <div class="row">
        <div class="col-xs-12">

            <form action="/admin/settings/tax/configuration" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Indstillinger</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="calc_taxes"
                                           value="1" <?php echo shop_config('calc_taxes', 'TAX') == 1 ? 'checked' : ''; ?>>
                                    Aktiver moms og momsberegninger
                                </label>
                            </div>
                        </div>


                        Priser indtastet med moms
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="prices_include_tax" id="prices_include_tax1" value="yes"
                                    <?php echo shop_config('prices_include_tax', 'TAX') == 'yes' ? 'checked' : ''; ?>>
                                    Ja, jeg vil indtaste priser inklusiv moms
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="prices_include_tax" id="prices_include_tax2" value="no"
                                    <?php echo shop_config('prices_include_tax', 'TAX') == 'no' ? 'checked' : ''; ?>>
                                    Nej, jeg vil indtaste priser eksklusive moms
                                </label>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Beregn moms baseret på</label>
                            <select class="form-control" name="shipping_tax_class">
                                <option value="shipping" <?php echo shop_config('shipping_tax_class', 'TAX') == 'shipping' ? 'selected' : ''; ?>>
                                    Kunde leveringsadresse
                                </option>
                                <option value="billing" <?php echo shop_config('shipping_tax_class', 'TAX') == 'billing' ? 'selected' : ''; ?>>
                                    Kunde faktureringsadresse
                                </option>
                                <option value="base" <?php echo shop_config('shipping_tax_class', 'TAX') == 'base' ? 'selected' : ''; ?>>
                                    Butiksadresse
                                </option>
                            </select>
                        </div>


                        {{--<div class="form-group">--}}
                        {{--<label>Forsendelse Momsklasser</label>--}}
                        {{--<select class="form-control" name="tax_based_on">--}}
                        {{--<option value="shipping">Kunde leveringsadresse</option>--}}
                        {{--<option value="billing">Kunde faktureringsadresse</option>--}}
                        {{--<option value="base">Butiksadresse</option>--}}
                        {{--</select>--}}
                        {{--</div>--}}


                        <div class="form-group">
                            <label>Vis priser i Butik</label>
                            <select class="form-control" name="tax_display_shop">
                                <option value="incl" <?php echo shop_config('tax_display_shop', 'TAX') == 'incl' ? 'selected' : ''; ?>>
                                    incl. moms
                                </option>
                                <option value="excl" <?php echo shop_config('tax_display_shop', 'TAX') == 'excl' ? 'selected' : ''; ?>>
                                    ekskl. moms
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Vis priser under Kurv og Betaling</label>
                            <select class="form-control" name="tax_display_cart">
                                <option value="incl" <?php echo shop_config('tax_display_cart', 'TAX') == 'incl' ? 'selected' : ''; ?>>
                                    incl. moms
                                </option>
                                <option value="excl" <?php echo shop_config('tax_display_cart', 'TAX') == 'excl' ? 'selected' : ''; ?>>
                                    ekskl. moms
                                </option>
                            </select>
                        </div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <!-- /.box -->
            </form>

            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        <h3 class="box-title">Rater</h3>
                    </h3>

                    <div class="box-tools">
                        <a href="{{ url('admin/settings/tax/create') }}" class="btn btn-flat btn-info inline">Opret ny rate</a>
                    </div>
                </div>
                <!-- /.box-header -->

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Moms Navn</th>
                            <th>Land</th>
                            <th>Sats %</th>
                            <th>Prioriteret</th>
                            <th></th>
                        </tr>
                        @foreach($rates as $rate)
                            <tr>
                                <td>#{{ $rate->id }}</td>
                                <td>{{ $rate->zone->name }}</td>
                                <td>{{ $rate->taxClass->title }}</td>
                                <td>{{ $rate->rate }}</td>
                                <td>{{ $rate->priority }}</td>
                                <td class="text-right">
                                    {{--<!--<a href="" class="btn btn-link" title="Show"><i class="fa fa-eye"></i></a>-->--}}
                                    <a href="{{ url("admin/settings/tax/$rate->id/edit") }}" class="btn btn-link"
                                       title="Edit"><i class="fa fa-pencil"></i></a>
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