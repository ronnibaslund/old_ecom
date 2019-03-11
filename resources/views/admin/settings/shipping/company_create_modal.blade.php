<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">Fragt firma</h4>
</div>
<div class="modal-body">

    <div class="row tmpl_shipping_company_price hidden">
        <div class="col-md-3">
            <div class="form-group">
                <input type="number" step="0.10" class="form-control" name="weight_from" placeholder="" value="0">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="number" step="0.10" class="form-control" name="weight_to" placeholder="" value="99">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="number" step="0.10" class="form-control" name="price" placeholder="" value="0">
            </div>
        </div>
        <div class="col-md-2 text-center">
            <i class="fa fa-times" onclick="removeRow(this)"></i>
        </div>
    </div>

    @if(isset($company))
        <form action="/admin/settings/shipping/company/{{ $company->id }}/edit" method="post" id="modalForm" onsubmit="return false;">
    @else
        <form action="/admin/settings/shipping/company" method="post" id="modalForm" onsubmit="return false;">
    @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label>Navn</label>
            <input type="text" class="form-control" name="shipping_company_name" placeholder="" value="{{ $company->name or '' }}">
        </div>

        <div class="row">
            <div class="col-md-3">Vægt fra (kg)</div>
            <div class="col-md-3">Vægt til (kg)</div>
            <div class="col-md-4">Pris</div>
            <div class="col-md-2"></div>
        </div>
        <div class="prices">

            @if(isset($company))
                @foreach($company->prices as $price)
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="number" step="0.10" class="form-control" name="prices[{{ $price->id }}][weight_from]" placeholder="" value="{{ $price->weight_from }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="number" step="0.10" class="form-control" name="prices[{{ $price->id }}][weight_to]" placeholder="" value="{{ $price->weight_to }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="number" step="0.10" class="form-control" name="prices[{{ $price->id }}][price]" placeholder="" value="{{ $price->price }}">
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <i class="fa fa-times" onclick="removeRow(this)"></i>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <button class="btn btn-xs btn-default" onclick="addRow()">Tilføj</button>

        <script>
            function addRow() {
                // find number of prices
                var n = $( ".prices .row" ).length;


                var _tmpl = $('.tmpl_shipping_company_price').clone();
                _tmpl.removeClass('hidden');
                _tmpl.removeClass('tmpl_shipping_company_price');

                //find all inputs and change name
                $(_tmpl).find('input').each(function(i) {
                    $(this).attr('name', 'prices[' + n + '][' + $(this).attr('name') + ']');
                });

                $('.prices').append(_tmpl);
            }

            function removeRow(_elm) {
                $(_elm).parent().parent().remove();
            }
        </script>

    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Luk</button>
    <button type="button" class="btn btn-primary" onclick="submitCompanyCreateModal()">Gem</button>
</div>