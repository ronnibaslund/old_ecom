@extends('admin.layout')
@section('content')

    <div class="row">
        <div class="col-xs-12">

            <form action="/admin/settings/checkout" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class=""><a href="#settings" data-toggle="tab" aria-expanded="true">Indstillinger</a></li>
                        <li class=""><a href="#BACS" data-toggle="tab" aria-expanded="false">BACS</a></li>
                        <li class="active"><a href="#STRIPE" data-toggle="tab" aria-expanded="false">Stripe</a></li>
                        {{--<li class=""><a href="#companies" data-toggle="tab" aria-expanded="false">Firmae(r)</a></li>--}}
                        {{--<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>--}}
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="settings">

                            Kuponer
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="enable_coupons">
                                    <input type="checkbox" name="enable_coupons"
                                           value="true" <?php echo (shop_config('enable_coupons', 'CHECKOUT') == true) ? 'checked' : ''; ?>>
                                    Aktiver anvendelse af kuponer
                                </label>
                                <span class="help-block">Kuponer kan anvendes fra kassen og checkoutsiderne.</span>
                            </div>

                            Kuponer
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="calc_discounts_sequentially">
                                    <input type="checkbox" name="calc_discounts_sequentially"
                                           value="true" <?php echo (shop_config('calc_discounts_sequentially', 'CHECKOUT') == true) ? 'checked' : ''; ?>>
                                    Beregn kupon rabat sekventielt
                                </label>
                            </div>

                            Checkout
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="enable_guest_checkout">
                                    <input type="checkbox" name="enable_guest_checkout"
                                           value="true" <?php echo (shop_config('enable_guest_checkout', 'CHECKOUT') == true) ? 'checked' : ''; ?>>
                                    Aktiver gæste checkout
                                </label>
                                <span class="help-block">Tillad kunderne at gå til kassen uden at oprette en konto.</span>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="force_ssl_checkout">
                                    <input type="checkbox" name="force_ssl_checkout"
                                           value="true" <?php echo (shop_config('force_ssl_checkout', 'CHECKOUT') == true) ? 'checked' : ''; ?>>
                                    Gennemtving sikker checkout
                                </label>
                                <span class="help-block">Tving SSL (HTTPS) på kasse siderne (en SSL-certifikat er påkrævet).</span>
                            </div>

                            Gateway Display Order
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Gateway</th>
                                    <th>Gateway ID</th>
                                    <th>Aktiveret</th>
                                </tr>
                                </thead>
                            </table>

                        </div>
                        <!-- /.Indstillinger tab-pane -->

                        <div class="tab-pane" id="BACS">

                            <h4>BACS</h4>
                            <div>Tillad betalinger via BACS (Bank Account Clearing System), bedre kendt som direkte bank/bankoverførsel.</div>

                            Aktiver/Deaktiver
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="bacs_enabled">
                                    <input type="checkbox" name="bacs_enabled"
                                           value="true" <?php echo (shop_config('bacs_enabled', 'CHECKOUT') == true) ? 'checked' : ''; ?>>
                                    Tillad bankoverførsel
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Titel</label>
                                <input type="text" name="bacs_title" class="form-control"
                                       value="<?php echo shop_config('bacs_title', 'CHECKOUT'); ?>">
                            </div>

                            <div class="form-group">
                                <label>Beskrivelse</label>
                                <textarea name="bacs_description" class="form-control"><?php echo shop_config('bacs_description', 'CHECKOUT'); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Instruktioner</label>
                                <textarea name="bacs_instructions" class="form-control"><?php echo shop_config('bacs_instructions', 'CHECKOUT'); ?></textarea>
                            </div>


                            Konto detaljer:

                            <div class="row">
                                <div class="col-md-2">Kontonavn</div>
                                <div class="col-md-2">Kontonummer</div>
                                <div class="col-md-2">Bankens navn</div>
                                <div class="col-md-2">Registreringsnummer</div>
                                <div class="col-md-2">IBAN</div>
                                <div class="col-md-2">BIC (tidligere Swift)</div>
                            </div>
                            <div class="row">
                                <div class="col-md-2"><input type="text" value="<?php echo shop_config('bacs_account_name', 'CHECKOUT'); ?>" name="bacs_account_name"></div>
                                <div class="col-md-2"><input type="text" value="<?php echo shop_config('bacs_account_number', 'CHECKOUT'); ?>" name="bacs_account_number"></div>
                                <div class="col-md-2"><input type="text" value="<?php echo shop_config('bacs_bank_name', 'CHECKOUT'); ?>" name="bacs_bank_name"></div>
                                <div class="col-md-2"><input type="text" value="<?php echo shop_config('bacs_sort_code', 'CHECKOUT'); ?>" name="bacs_sort_code"></div>
                                <div class="col-md-2"><input type="text" value="<?php echo shop_config('bacs_iban', 'CHECKOUT'); ?>" name="bacs_iban"></div>
                                <div class="col-md-2"><input type="text" value="<?php echo shop_config('bacs_bic', 'CHECKOUT'); ?>" name="bacs_bic"></div>
                            </div>

                        </div>
                        <!-- /.BACS tab-pane -->
                        <div class="tab-pane active" id="STRIPE">
                            <h2>Stripe</h2>

                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="enable_stripe">
                                    <input type="checkbox" name="enable_stripe"
                                           value="true" <?php echo (shop_config('enable_stripe', 'CHECKOUT') == true) ? 'checked' : ''; ?>>
                                    Aktiver Stripe
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Titel</label>
                                <input type="text" name="stripe_title" class="form-control"
                                       value="<?php echo shop_config('stripe_title', 'CHECKOUT'); ?>">
                            </div>

                            <div class="form-group">
                                <label>Beskrivelse</label>
                                <textarea name="stripe_description" class="form-control"><?php echo shop_config('stripe_description', 'CHECKOUT'); ?></textarea>
                            </div>

                            <select class="select " name="stripe_charge_type" id="stripe_charge_type" style="">
                                <option value="capture" <?php echo shop_config('stripe_charge_type', 'CHECKOUT') == 'capture' ? 'selected':''; ?>>Authorize &amp; Capture</option>
                                <option value="authorize" <?php echo shop_config('stripe_charge_type', 'CHECKOUT') == 'authorize' ? 'selected':''; ?>>Authorize Only</option>
                            </select>


                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="stripe_saved_cards">
                                    <input type="checkbox" name="stripe_saved_cards"
                                           value="true" <?php echo (shop_config('stripe_saved_cards', 'CHECKOUT') == true) ? 'checked' : ''; ?>>
                                    Saved Cards
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="hidden" value="false" name="stripe_testmode">
                                    <input type="checkbox" name="stripe_testmode"
                                           value="true" <?php echo (shop_config('stripe_testmode', 'CHECKOUT') == true) ? 'checked' : ''; ?>>
                                    Test mode
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Stripe API Test Secret key</label>
                                <input type="text" name="stripe_test_secret_key" class="form-control"
                                       value="<?php echo shop_config('stripe_test_secret_key', 'CHECKOUT'); ?>">
                            </div>

                            <div class="form-group">
                                <label>Stripe API Live Secret key</label>
                                <input type="text" name="stripe_test_publishable_key" class="form-control"
                                       value="<?php echo shop_config('stripe_test_publishable_key', 'CHECKOUT'); ?>">
                            </div>

                            <div class="form-group">
                                <label>Stripe API Test Publishable key</label>
                                <input type="text" name="stripe_live_secret_key" class="form-control"
                                       value="<?php echo shop_config('stripe_live_secret_key', 'CHECKOUT'); ?>">
                            </div>

                            <div class="form-group">
                                <label>Stripe API Live Publishable key</label>
                                <input type="text" name="stripe_live_publishable_key" class="form-control"
                                       value="<?php echo shop_config('stripe_live_publishable_key', 'CHECKOUT'); ?>">
                            </div>


                        </div>
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
//            //Initialize Select2 Elements
//            $("#free_shipping_countries_dropdown").select2();
//            $("#international_delivery_countries_dropdown").select2();
//
//            // Add data to the hidden input field
//            $("#free_shipping_countries_dropdown").on('change', function() {
//                $("#free_shipping_countries").val($('#free_shipping_countries_dropdown').select2("val"));
//            });
//
//            // Add data to the hidden input field
//            $("#international_delivery_countries_dropdown").on('change', function() {
//                $("#international_delivery_countries").val($('#international_delivery_countries_dropdown').select2("val"));
//            });
//
//            // Remove the shipping price model content after close
//            $('body').on('hidden.bs.modal', '.modal', function () {
//                $(this).removeData('bs.modal');
//            });
        });

//        function submitUpdateActiveShipping() {
//
//            var _form = $('#UpdateActiveShipping');
//            var _data = _form.find(':input').serializeArray();
//            var _url = _form.data('action');
//
//            $("#UpdateActiveShipping .cbx:not(:checked)").each(function() {
//                _data.push({name: this.name, value: '0' });
//            });
//
//            console.log(_data);
//
//            $.post(_url, _data)
//                    .done(function (response) {
//                        console.log(response);
//                    });
//        }
//
//        function submitCompanyCreateModal() {
//
//            var _form = $('#modalForm');
//            var _data = _form.serializeArray();
//            var _url = _form.attr('action');
//
//            console.log(_data);
//
//            $.post(_url, _data)
//                    .done(function (response) {
//                        console.log(response);
//                        if (response == 'true')
//                            location.reload();
//                    });
//        }
//
//        function deletePrice(_self, _id) {
//            if(confirm('Er du sikker på du vil slette denne?')) {
//
//                $.get('/admin/settings/shipping/company/price/delete/' + _id)
//                        .done(function (response) {
//                            if(response == 'true')
//                                $(_self).closest('tr').remove();
//                            else
//                                alert('Noget gik galt prøv igen!');
//                        });
//                   //
//
//            }
//        }
    </script>
@endsection