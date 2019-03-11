<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">{{ $page_title or '' }}</h4>
</div>
<div class="modal-body">

    <form action="/admin/customer/address/update" method="post" id="modalForm" onsubmit="return false;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="product_id" value="{{ $customer_id }}">

        @include('admin.customers.partial.address', ['countries' => $countries, 'address' => $address, 'type' => $type, 'customer_id' => $customer_id])

    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Luk</button>
    <button type="button" class="btn btn-primary" onclick="submitAddressModal()">Gem</button>
</div>