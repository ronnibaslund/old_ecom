<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">Billeder</h4>
</div>
<div class="modal-body">

    <form action="/admin/media/product/images" method="post" id="modalForm" onsubmit="return false;">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="product_id" value="{{ $product_id }}">

        @foreach($images as $image)
            <label class="img-thumbnail">
                <img src="{{ url($image->path . $image->file)  }}" width="130" height="130"/>

                <div>
                    <input type="checkbox" name="images[]" value="{{ $image->id }}"/>
                    <span>{{ substr($image->title, 0,10) . '...' }}</span>
                </div>
            </label>
        @endforeach
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Luk</button>
    <button type="button" class="btn btn-primary" onclick="submitModal()">Gem</button>
</div>