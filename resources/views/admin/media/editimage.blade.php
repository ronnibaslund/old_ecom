<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
    </button>
    <h4 class="modal-title">Redigere {{ $file->title }}</h4>
</div>
<div class="modal-body">

    <div class="thumbnail">
        <img src="{{ url($file->path . $file->file)  }}"/>
    </div>

    <form action="/admin/media/image/{{ $file->id }}/edit" method="post" id="modalForm" onsubmit="return false;">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $file->id }}">

        <div class="form-group">
            <label for="name">Navn</label>
            <input type="text" class="form-control" id="name" name="name"
                   placeholder="Navn"
                   value="{{ $file->title }}">
        </div>

        <div class="form-group">
            <label for="description">Beskrivelse</label>
            <textarea name="description" class="form-control"
                      placeholder="Enter text ...">{{ $file->description }}</textarea>
        </div>

    </form>


</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Luk</button>
    <button type="button" class="btn btn-primary" onclick="submitModal()">Gem</button>
</div>
