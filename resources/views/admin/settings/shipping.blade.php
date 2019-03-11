@extends('admin.layout')
@section('content')

    <div class="row">
        <div class="col-xs-12">

            <form action="/admin/settings/shipping" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="true">Indstillinger</a>
                        </li>
                        <li class=""><a href="#free_shipping" data-toggle="tab" aria-expanded="false">Gratis fragt</a>
                        </li>
                        <li class=""><a href="#international" data-toggle="tab" aria-expanded="false">International</a>
                        </li>
                        <li class=""><a href="#companies" data-toggle="tab" aria-expanded="false">Firmae(r)</a></li>
                        <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">

                            <h4>Forsendelsesberegninger</h4>

                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="calc_shipping">
                                    <input type="checkbox" name="calc_shipping" value="true" <?php echo (shop_config('calc_shipping', 'SHIPPING') == true) ? 'checked':''; ?>> Aktiver forsendelse
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="enable_shipping_calc">
                                    <input type="checkbox" name="enable_shipping_calc" value="true" <?php echo (shop_config('enable_shipping_calc', 'SHIPPING') == true) ? 'checked':''; ?>> Aktiver
                                    forsendelsesberegneren på kurvsiden
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="shipping_cost_requires_address">
                                    <input type="checkbox" name="shipping_cost_requires_address" value="true" <?php echo (shop_config('shipping_cost_requires_address', 'SHIPPING') == true) ? 'checked':''; ?>> Skjul
                                    forsendelsesomkostninger indtil en adresse er angivet
                                </label>
                            </div>

                            <h4>Fragt visnings måde</h4>

                            <div class="form-group">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="shipping_method_format" id="shipping_method_format1"
                                               value="radio" checked=""
                                                <?php echo (shop_config('shipping_method_format', 'SHIPPING') == 'radio') ? 'selected':''; ?>
                                                >
                                        Vis fragt metoder med "radio"-knapper
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="shipping_method_format" id="shipping_method_format2"
                                               value="dropdown"
                                            <?php echo (shop_config('shipping_method_format', 'SHIPPING') == 'dropdown') ? 'selected':''; ?>
                                                >
                                        Vis fragt metoder med dropdown
                                    </label>
                                </div>
                            </div>

                            <h4>Fragt firmaer</h4>
                                <div id="UpdateActiveShipping" data-action="/admin/settings/shipping/company/activate">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="40">Sotering</th>
                                        <th width="40">Aktive</th>
                                        <th>Navn</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shipping_companies as $company)
                                        <tr>
                                            <td>{{ $company->sort_order }}</td>
                                            <td class="text-center"><input type="checkbox" class="cbx" name="active[{{ $company->id }}]" value="1"
                                                       @if($company->active == 1) checked @endif /></td>
                                            <td>{{ $company->name }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary" onclick="submitUpdateActiveShipping()">Gem</button>
                                </div>
                        </div>
                        <!-- /.Indstillinger tab-pane -->
                        <div class="tab-pane" id="free_shipping">

                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="free_shipping_enabled">
                                    <input type="checkbox" name="free_shipping_enabled" value="true" <?php echo (shop_config('free_shipping_enabled', 'SHIPPING') == true) ? 'checked':''; ?>> Aktiver gratis
                                    fragt
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Vælg lande du vil aktiver gratis fragt til</label>
                                <select class="form-control select2" multiple="multiple" name="free_shipping_countries_dropdown" id="free_shipping_countries_dropdown"
                                        style="width: 100%;">
                                    <option value="all" @if(in_array('all', $selected_free_shipping_countries)) selected @endif>Alle</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if(in_array($country->id, $selected_free_shipping_countries)) selected @endif>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="free_shipping_countries" id="free_shipping_countries" value="<?php echo shop_config('free_shipping_countries', 'SHIPPING'); ?>" />
                            <!-- /.form-group -->

                            <div class="form-group">
                                <label>Minimumsordrebeløb</label>
                                <input type="number" step="1" class="form-control" name="free_shipping_min_amount"
                                       value="<?php echo shop_config('free_shipping_min_amount', 'SHIPPING'); ?>" placeholder="Enter ...">
                            </div>

                        </div>
                        <!-- /.Gratis fragt tab-pane -->
                        <div class="tab-pane" id="international">

                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="international_delivery_enabled">
                                    <input type="checkbox" name="international_delivery_enabled" value="true" <?php echo (shop_config('international_delivery_enabled', 'SHIPPING') == true) ? 'checked':''; ?>> Aktiver
                                    gratis fragt
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Vælg lande som du vil levere til</label>
                                <select class="form-control select2" multiple="multiple"
                                        name="international_delivery_countries_dropdown"
                                        id="international_delivery_countries_dropdown"
                                        style="width: 100%;">
                                    <option value="all" @if(in_array('all', $selected_international_delivery_countries)) selected @endif>Alle</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" @if(in_array($country->id, $selected_international_delivery_countries)) selected @endif>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="international_delivery_countries" id="international_delivery_countries" value="<?php echo shop_config('international_delivery_countries', 'SHIPPING'); ?>">
                            <!-- /.form-group -->


                            <div class="form-group">
                                <label>Omkostning</label>
                                <input type="text" class="form-control" name="international_delivery_cost"
                                       placeholder="Enter ..."
                                       value="<?php echo shop_config('international_delivery_cost', 'SHIPPING'); ?>"
                                        >
                            </div>

                        </div>
                        <!-- /.International tab-pane -->
                        <div class="tab-pane" id="companies">

                            <a data-toggle="modal" href="/admin/settings/shipping/company/modal" data-target="#modal"
                               class="btn btn-primary pull-right">Tilføj ny firma</a>

                            @foreach($shipping_companies as $sc)

                                <h4>{{ $sc->name }} <a data-toggle="modal" href="/admin/settings/shipping/company/modal/{{ $sc->id }}" data-target="#modal" class="btn btn-link"><i class="fa fa-pencil"></i></a></h4>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Vægt fra</th>
                                        <th>Vægt til</th>
                                        <th>Pris</th>
                                        <th style="width: 40px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sc->prices as $price)
                                        <tr>
                                            <td>{{ $price->weight_from }}</td>
                                            <td>{{ $price->weight_to }}</td>
                                            <td>@currency($price->price)</td>
                                            <td><span onclick="deletePrice(this, '{{ $price->id }}')"><i class="fa fa-trash"></i></span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endforeach

                        </div>
                        <!-- /.Firmae(r) tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <button type="submit" class="btn btn-primary">Gem</button>
            </form>
        </div>
    </div>

@endsection
@section('footer_scripts')

    <script>
        $(function () {
            //Initialize Select2 Elements
            $("#free_shipping_countries_dropdown").select2();
            $("#international_delivery_countries_dropdown").select2();

            // Add data to the hidden input field
            $("#free_shipping_countries_dropdown").on('change', function() {
                $("#free_shipping_countries").val($('#free_shipping_countries_dropdown').select2("val"));
            });

            // Add data to the hidden input field
            $("#international_delivery_countries_dropdown").on('change', function() {
                $("#international_delivery_countries").val($('#international_delivery_countries_dropdown').select2("val"));
            });

            // Remove the shipping price model content after close
            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });
        });

        function submitUpdateActiveShipping() {

            var _form = $('#UpdateActiveShipping');
            var _data = _form.find(':input').serializeArray();
            var _url = _form.data('action');

            $("#UpdateActiveShipping .cbx:not(:checked)").each(function() {
                _data.push({name: this.name, value: '0' });
            });

            console.log(_data);

            $.post(_url, _data)
                    .done(function (response) {
                        console.log(response);
                    });
        }

        function submitCompanyCreateModal() {

            var _form = $('#modalForm');
            var _data = _form.serializeArray();
            var _url = _form.attr('action');

            console.log(_data);

            $.post(_url, _data)
                    .done(function (response) {
                        console.log(response);
                        if (response == 'true')
                            location.reload();
                    });
        }

        function deletePrice(_self, _id) {
            if(confirm('Er du sikker på du vil slette denne?')) {

                $.get('/admin/settings/shipping/company/price/delete/' + _id)
                        .done(function (response) {
                            if(response == 'true')
                                $(_self).closest('tr').remove();
                            else
                                alert('Noget gik galt prøv igen!');
                        });
                   //

            }
        }
    </script>
@endsection