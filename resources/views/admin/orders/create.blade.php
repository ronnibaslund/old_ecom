@extends('admin.layout')

@section('content')

    <section class="row">

        @if(isset($order))
            <form action="/admin/order/{{ $order->id }}" method="post">
        @else
            <form action="/admin/order" method="post">
                <input type="hidden" name="_method" value="PUT">
        @endif

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="col-xs-9">
                    <section class="invoice">
                        <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Faktura</button>
                        <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Følgeseddel</button>
                        <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-print"></i> Adresseseddel</button>
                        <button class="btn btn-success pull-right" style="margin-right: 5px;"><i class="fa fa-credit-card"></i> Sendbetalingslink</button>
                        <div class="clearfix"></div>
                    </section>
                    <br>
                    <div class="clearfix"></div>

                    <!-- Main content -->
                    <section class="invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="page-header">
                                    <?php echo shop_config('shop_name') ?>.
                                    <small class="pull-right">Date: {{ date('d/m/Y') }}</small>
                                </h2>
                            </div><!-- /.col -->
                        </div>
                        @if(!isset($order))
                        <div class="row customer-select-row">
                            <div class="col-sm-4">
                                <label>Vælg kunde</label>
                                <select name="customer_id" class="form-control select-customer"></select>
                                <a class="btn btn-primary btn-sm margin-4-0 create-new-customer">Ny kunde</a>
                            </div>
                            <div class="col-sm-4">
                                <div class="customer-shipping-select hidden">
                                    <label>Vælg leverings adresse</label>
                                    <select name="shipping_id" class="form-control select-shipping"></select>
                                </div>
                            </div>
                            <div class="col-sm-4">

                                <div class="form-group form-horizontal">
                                    <label class="col-sm-4">Betalingsmetode:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="payment_method" id="order-type">
                                            <option>Vælg</option>
                                            <option value="cash">Kontant</option>
                                            <option value="swipp">Swipp</option>
                                            <option value="mobilepay">MobilePay</option>
                                            <option value="creditcard">Kreditkort</option>
                                            <option value="basc">Bankoverførelse</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="col-sm-4">Type:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="order_type" id="order-type-select">
                                            <option value="once">{{ trans('order_types.once') }}</option>
                                            <option value="7days">{{ trans('order_types.7days') }}</option>
                                            <option value="14days">{{ trans('order_types.14days') }}</option>
                                            <option value="1month">{{ trans('order_types.1month') }}</option>
                                            <option value="3month">{{ trans('order_types.3month') }}</option>
                                            <option value="6month">{{ trans('order_types.6month') }}</option>
                                            <option value="12month">{{ trans('order_types.12month') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        @endif

                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <b>Faktureringsoplysninger</b>
                                @if(isset($order))
                                <a data-toggle="modal" href="/admin/customer/address/1/is_primary" data-target="#modal"><i class="fa fa-pencil"></i></a>
                                <address id="billing">
                                    Ronni H. Baslund<br>
                                    Åtoften 33<br>
                                    6710 Esbjerg V<br>
                                    Telefon: 20637474<br>
                                    Email: ronnibaslund@gmail.com
                                </address>
                                @else
                                    <address id="billing" class="hidden"></address>
                                    <div class="customer-create-billing hidden">
                                        <div class="form-inline">
                                            <input type="text" name="billing[firstname]" class="form-control inline-block" placeholder="Fornavn">
                                            <input type="text" name="billing[lastname]" class="form-control" placeholder="Efternavn">
                                        </div>

                                        <input type="text" name="billing[street]" class="form-control margin-4-0" style="width: 100%" placeholder="Adresse">

                                        <div class="controls form-inline margin-4-0">
                                            <input type="text" name="billing[postcode]" class="form-control" placeholder="Post nr.">
                                            <input type="text" name="billing[city]" class="form-control" placeholder="By">
                                        </div>

                                        <input type="text" name="billing[phone]" class="form-control margin-4-0" placeholder="Telefon nummer">
                                        <input type="email" name="billing[email]" class="form-control margin-4-0" placeholder="E-mail">
                                    </div>
                                @endif
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Forsendelsesoplysninger</b> <a onclick="javascript:copyBillingToShipping()">Copy</a>
                                @if(isset($order))
                                <a data-toggle="modal" href="/admin/customer/address/1/is_shipping" data-target="#modal"><i class="fa fa-pencil"></i></a>
                                <address id="shipping">
                                    Ronni H. Baslund<br>
                                    Åtoften 33<br>
                                    6710 Esbjerg V<br>
                                    Telefon: 20637474<br>
                                    Email: ronnibaslund@gmail.com
                                </address>
                                @else
                                    <address id="shipping" class="hidden"></address>
                                    <div class="customer-create-shipping hidden">
                                        <div class="form-inline item-lin">
                                            <input type="text" name="shipping[firstname]" class="form-control inline-block" placeholder="Fornavn">
                                            <input type="text" name="shipping[lastname]" class="form-control" placeholder="Efternavn">
                                        </div>

                                        <input type="text" name="shipping[street]" class="form-control margin-4-0" style="width: 100%" placeholder="Adresse">

                                        <div class="controls form-inline margin-4-0">
                                            <input type="text" name="shipping[postcode]" class="form-control" placeholder="Post nr.">
                                            <input type="text" name="shipping[city]" class="form-control" placeholder="By">
                                        </div>

                                        <input type="text" name="shipping[phone]" class="form-control margin-4-0" placeholder="Telefon nummer">
                                    </div>
                                @endif
                            </div><!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Order ID:</b> #1<br>
                                <b>Betalingsdato:</b> {{ date('d/m/Y') }}<br>
                                {{--<b>KundeID:</b> #1000<br>--}}
                                {{--<b>Status:</b> Ny ordre<br>--}}
                                <b>Betalingsmetode:</b> <span class="payment-method"></span>

                                {{--<img src="{{ asset("/bower_components/AdminLTE/dist/img/credit/visa.png") }}" alt="Visa">--}}
                                {{--<img src="{{ asset("/bower_components/AdminLTE/dist/img/credit/mastercard.png") }}" alt="Mastercard">--}}
                                {{--<img src="{{ asset("/bower_components/AdminLTE/dist/img/credit/american-express.png") }}/" alt="American Express">--}}
                                {{--<img src="{{ asset("/bower_components/AdminLTE/dist/img/credit/paypal2.png") }}" alt="Paypal">--}}


                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <hr>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <div class="controls form-inline header">
                                    <div class="inline-block text-bold" style="width: 30%;">
                                        <span style="width: 100%">Produkt</span>
                                    </div>
                                    <div class="inline-block text-bold" style="width: 38%;">
                                        <span style="width: 100%">Beskrivelse</span>
                                    </div>
                                    <div class="inline-block text-bold" style="width: 10%;">
                                        <span style="width: 100%">Antal</span>
                                    </div>
                                    <div class="inline-block text-bold" style="width: 10%;">
                                        <span style="width: 100%">Enhedspris</span>
                                    </div>
                                    <div class="inline-block text-right text-bold" style="width: 10%;">
                                        <span style="width: 100%">Subtotal</span>
                                    </div>

                                </div>
                                <div id="item-lines"></div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->

                        <br>

                        <div class="row">
                            <div class="col-xs-8">
                                <a class="btn btn-primary btn-sm" id="addItemLine" href="#">Tilføj vare linje</a>
                            </div>
                            <div class="col-xs-4">
                                <div class="table-responsive">

                                    <input type="hidden" name="order_subtotal" id="order-subtotal">
                                    <input type="hidden" name="order_tax" id="order-tax">
                                    <input type="hidden" name="order_shipping" id="order-shipping">
                                    <input type="hidden" name="order_total" id="order-total">

                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td id="subtotal" class="text-right">0,00 DKK</td>
                                        </tr>
                                        <tr>
                                            <th>Moms (25%)</th>
                                            <td id="tax" class="text-right">0,00 DKK</td>
                                        </tr>
                                        <tr>
                                            <th>Fragt:</th>
                                            <td id="shipping" class="text-right">0,00 DKK</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td id="total" class="text-right">0,00 DKK</td>
                                        </tr>
                                    </table>
                                </div>
                            </div><!-- /.col -->
                        </div>
                    </section><!-- /.content -->
                </div>

                <div class="col-xs-3">
                    <section class="invoice">
                        <h2 class="page-header">Ordrer handling</h2>
                        <div class="form-group">
                            <label>Ordrestatus</label>

                            <select id="order_status" name="order_status" class="form-control" tabindex="-1" title="Ordrestatus">
                                @foreach($order_status as $status)
                                <option value="{{ $status->name }}">{{ trans("order_statues.$status->name") }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary btn-sm" style="margin-right: 5px;">Opdater</button>
                    </section>
                    <br>
                    <section class="invoice">
                        <h2 class="page-header">Ordrer noter</h2>

                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            <footer>Tilføjet: 11-11-2015 10:00</footer>
                        </blockquote>
                        <blockquote>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                            <footer>Tilføjet: 11-11-2015 10:00</footer>
                        </blockquote>

                        <div class="form-group">
                            <label>Tilføj bemærkning</label>
                            <textarea class="form-control" name="note" rows="3" placeholder="Enter ..."></textarea>
                        </div>

                        <div class="form-group">
                            <select name="order_note_type" id="order_note_type" class="form-control">
                                <option value="private" selected>Privat bemærkning</option>
                                <option value="public">Besked til kunden</option>
                            </select>
                        </div>

                        <button class="btn btn-primary btn-sm" style="margin-right: 5px;">Tilføj</button>

                    </section>

                </div>

            </form>
    </div>




    </div>

@endsection

@section('head_scripts')

@endsection

@section('footer_scripts')

    <script>

        var _subtotal = 0;
        var _tax = 0;
        var _shipping = 0;
        var _total = 0;

        $(function () {
            //Initialize Select2 Elements
            $(".select2").select2();

            //bootstrap WYSIHTML5 - text editor
            $('#description').wysihtml5();
            $("#expire_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});

            // Update subtotal on item line when qty is changed
            $('#item-lines').on('change','.qty', function() {
                var _qty = $(this).val();
                var _price = $(this).closest(".item-line").find('.price').val();
                var _subtotal = numeral(_qty * _price).format('0.00 $');
                $(this).closest(".item-line").find('.item-subtotal').html(_subtotal);
                updateSubtotal();
            });

            // Update subtotal on item line when price is changed
            $('#item-lines').on('change','.price', function() {
                var _price = $(this).val();
                var _qty = $(this).closest(".item-line").find('.qty').val();
                var _subtotal = numeral(_qty * _price).format('0.00 $');
                $(this).closest(".item-line").find('.item-subtotal').html(_subtotal);
                updateSubtotal();
            });

            // add select2 to dynimic add elements
            $('#item-lines').on('DOMNodeInserted', function (e) {
                var _element = e.target;
                $(_element).find('.select-product').select2({
                    ajax: {
                        url: "/admin/products/search",
                        dataType: 'json',
                        delay: 250,
                        data: function (params) {
                            return {
                                q: params.term, // search term
                            };
                        },
                        processResults: function (data) {

                            console.log('her');

                            return {
                                results: data
                            };
                        },
                        cache: true
                    },
                    escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                    minimumInputLength: 2,
                    templateResult: formatProduct,
                    templateSelection: formatProductSelection
                });
            });
            function formatProduct (product) {
                var markup = '';

                if(product.text == 'Searching…') {
                    markup = product.text;
                } else {
                    //TODO: Need to implement language so er get the right product description - (Default select right now)
                    markup = '(' + product.item_number + ') ' + product.descriptions[0].name;
                }

                return markup;
            }
            function formatProductSelection (product) {
                return product.item_number + ' - ' + product.descriptions[0].name || product.text;
            }

            // listen for change in the item select2 element
            $('#item-lines').on("select2:select", '.select-product', function (e) {
                //console.log('her');
                if(e) {
                    var _product = e.params.data;
                    $(this).closest(".item-line").find('.description').val($(_product.descriptions[0].description).text());
                    $(this).closest(".item-line").find('.price').val(_product.price);
                    $(this).closest(".item-line").find('.item-subtotal').html(numeral(_product.price).format('0.00 $'));
                    updateSubtotal();
                }
            });

            // Item line temp element
            $('#addItemLine').on('click', function() {

                var n = $(".item-line").length + 1;

                var _tmpl = '<div class="controls form-inline item-line">' +
                        '<select class="form-control select-product" name="product[' + n + '][id]" style="width: 30%;"></select>' +
                        '<input type="text" name="product[' + n + '][description]" class="form-control description" style="width: 38%;" placeholder="Evt. Beskrivelse">' +
                        '<input type="number" name="product[' + n + '][qty]" step="1" class="form-control qty" style="width: 10%;" placeholder="Antal" value="1">' +
                        '<input type="number" name="product[' + n + '][price]" step=".10" class="form-control price" style="width: 10%;" placeholder="Enhedspris">' +
                        '<div class="inline-block text-right" style="width: 10%;">' +
                        '<span class="item-subtotal" style="width: 100%">0,00 DKK</span>' +
                        '</div>' +
                        '</div>';

                $('#item-lines').append(_tmpl);
            });
            $('#addItemLine').trigger('click');

            //
            // Customer select
            $(".select-customer").select2({
                placeholder: {
                    id: "-1",
                    firstname: "Vælg",
                    lastname: "kunde"
                },
                ajax: {
                    url: "/admin/customers/search",
                    dataType: 'json',
                    delay: 250,

                    data: function (params) {
                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function (data) {

                        console.log(data);

                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                minimumInputLength: 2,
                templateResult: formatCustomer,
                templateSelection: formatCustomerSelection
            });
            function formatCustomer (customer) {
                var markup = '';

                if(customer.text == 'Searching…') {
                    markup = customer.text;
                } else {

                    markup = '<address>' +
                            customer.firstname + ' ' + customer.lastname + '<br>' +
                            customer.street +'<br>' +
                            customer.postcode + ' ' + customer.city + '<br>' +
                            'Telefon: ' + customer.phone + '<br>' +
                            'Email: ' + customer.email +
                            '</address>';
                }

                return markup;
            }
            function formatCustomerSelection (customer) {
                return customer.firstname + ' ' + customer.lastname || customer.text;
            }

            // listen for change in the customer select2 element
            $('.customer-select-row').on("select2:select", '.select-customer', function (e) {
                if(e) {
                    var customer = e.params.data;

                    var _t = customer.firstname + ' ' + customer.lastname + '<br>' +
                            customer.street +'<br>' +
                            customer.postcode + ' ' + customer.city + '<br>' +
                            'Telefon: ' + customer.phone + '<br>' +
                            'Email: ' + customer.email;

                    $('#billing').html(_t);
                    $('#shipping').html(_t);
                    $('.customer-shipping-select').removeClass('hidden');
                    $('#billing').removeClass('hidden');
                    hideCreateCustomer();

                    $(".select-shipping").select2({
                        data: customer.addresses,
                        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                        templateResult: formatCustomer,
                        templateSelection: formatCustomerSelection
                    });

                }
            });

            // listen for change in the customer shipping select2 element
            $('.customer-shipping-select').on("select2:select", '.select-shipping', function (e) {
                if(e) {
                    var customer = e.params.data;

                    var _t = customer.firstname + ' ' + customer.lastname + '<br>' +
                            customer.street +'<br>' +
                            customer.postcode + ' ' + customer.city + '<br>' +
                            'Telefon: ' + customer.phone + '<br>' +
                            'Email: ' + customer.email;

                    $('#shipping').html(_t);
                    $('#shipping').removeClass('hidden');
                    hideCreateCustomer();
                }
            });

            //
            // Create new customer
            $('.create-new-customer').on('click', function() {
                showCreateCustomer();
            });

            //
            // Select payment method
            $('#payment-method-select').on('change', function() {
                $('.payment-method').html($(this).val());
            });

            function showCreateCustomer() {
                // hide customer billing address
                if(!$('#billing').hasClass('hidden'))
                    $('#billing').addClass('hidden');


                // hide customer shipping address
                if(!$('#shipping').hasClass('hidden'))
                    $('#shipping').addClass('hidden');

                // Show create new billing
                $('.customer-create-billing').toggleClass('hidden');

                // show create new shipping
                $('.customer-create-shipping').toggleClass('hidden');
            }
            function hideCreateCustomer() {
                // hide customer billing address
                if($('#billing').hasClass('hidden'))
                    $('#billing').removeClass('hidden');


                // hide customer shipping address
                if($('#shipping').hasClass('hidden'))
                    $('#shipping').removeClass('hidden');

                // Show create new billing
                $('.customer-create-billing').addClass('hidden');

                // show create new shipping
                $('.customer-create-shipping').addClass('hidden');
            }

        });

        function updateSubtotal() {
            _subtotal = 0;
            // Update subtotal
            $( ".item-subtotal" ).each( function( index, element ){
                _subtotal = _subtotal + numeral().unformat($( this ).html());
                $('#subtotal').html(numeral(_subtotal).format('0.00 $'));
            });
            $('#order-subtotal').val(_subtotal);

            // Update TAX
            _tax = _subtotal * 0.2;
            $('#tax').html(numeral(_tax).format('0.00 $'));
            $('#order-tax').val(_tax);

            _shipping = '';
            $('#shipping').html();
            $('#order-shipping').val(_shipping);

            _total = _subtotal + _shipping;
            $('#total').html(numeral(_total).format('0.00 $'));
            $('#order-total').val(_total);

        }
        function submitAddressModal() {

            var _form = $('#modalForm');
            var _data = _form.serializeArray();
            var _url = _form.attr('action');

//            console.log(_url);
//            console.log(_data);

            $.post( _url, _data)
                    .done(function( response ) {
                        if(response.error != 'success') {
                            alert('Noget gik galt prov igen!');
                        } else {
                            console.log(response);

                            var _tmpl =  response.address.firstname + ' ' + response.address.lastname + '<br>' +
                                    response.address.street + '<br>' +
                                    response.address.postcode + ' ' + response.address.city + '<br>' +
                                    'Telefon: ' + response.address.phone;


                            if(response.type == 'is_primary') {
                                _tmpl = _tmpl + '<br>Email: ' + response.address.email;
                                $('#billing').html(_tmpl);
                            }

                            if(response.type == 'is_shipping') {
                                $('#shipping').html(_tmpl);
                            }

                            $('#modal').modal('hide')
                        }
                    });

        }
        function copyBillingToShipping() {
            // Firstname
            $('.customer-create-shipping').find('input[name="shipping[firstname]"]').val(
                    $('.customer-create-billing').find('input[name="billing[firstname]"]').val()
            );

            //Lastname
            $('.customer-create-shipping').find('input[name="shipping[lastname]"]').val(
                    $('.customer-create-billing').find('input[name="billing[lastname]"]').val()
            );

            //Address
            $('.customer-create-shipping').find('input[name="shipping[street]"]').val(
                    $('.customer-create-billing').find('input[name="billing[street]"]').val()
            );
            // Postcode
            $('.customer-create-shipping').find('input[name="shipping[postcode]"]').val(
                    $('.customer-create-billing').find('input[name="billing[postcode]"]').val()
            );
            //City
            $('.customer-create-shipping').find('input[name="shipping[city]"]').val(
                    $('.customer-create-billing').find('input[name="billing[city]"]').val()
            );
            // Phone
            $('.customer-create-shipping').find('input[name="shipping[phone]"]').val(
                    $('.customer-create-billing').find('input[name="billing[phone]"]').val()
            );
        }

    </script>
@endsection