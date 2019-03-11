@extends('admin.layout')

@section('content')

    <div class="row">

        @if(isset($category))
            <form action="/admin/category/{{ $category->id }}" method="post">
        @else
            <form action="/admin/category" method="post">
                <input type="hidden" name="_method" value="PUT">
        @endif

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="language_id" value="1"> <!-- TODO: Hente denne fra databasen -->

                <div class="col-xs-12">

                    <!-- Info -->
                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <h3 class="box-title">Info</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <!-- status (active / not active) -->
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="status" {{ (isset($product) && $product->status == 1) ? 'checked':'' }}> Aktiv
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Enter name"
                                       value="{{ $description->name or '' }}">
                            </div>

                            <div class="form-group">
                                <label for="title">title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                       placeholder="Enter title"
                                       value="{{ $description->title or '' }}">
                            </div>

                            <div class="form-group">
                                <label>Vælg forældre</label>
                                <select class="form-control select2" name="parent_id" style="width: 100%;">
                                    <option selected="selected" value="">Ingen</option>
                                    @foreach($categories as $c)
                                        <?php $id = isset($category) ? $category->parent_id:''; ?>
                                        <?php echo renderSelectTree($c, $id); ?>
                                    @endforeach
                                </select>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="path">Url</label>
                                <input type="text" class="form-control" id="path" name="path"
                                       placeholder="Enter url"
                                       value="{{ $category->path or '' }}">
                            </div>


                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" placeholder="Enter text ..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;">{{ $description->description or '' }}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="title_tag">title_tag</label>
                                <input type="text" class="form-control" id="title_tag" name="title_tag"
                                       placeholder="Enter title_tag"
                                       value="{{ $description->title_tag or '' }}">
                            </div>

                            <div class="form-group">
                                <label for="desc_tag">desc_tag</label>
                                <input type="text" class="form-control" id="desc_tag" name="desc_tag"
                                       placeholder="Enter desc_tag"
                                       value="{{ $description->desc_tag or '' }}">
                            </div>

                            <div class="form-group">
                                <label for="keywords_tag">keywords_tag</label>
                                <input type="text" class="form-control" id="keywords_tag" name="keywords_tag"
                                       placeholder="Enter keywords_tag"
                                       value="{{ $description->keywords_tag or '' }}">
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </div>
                    <!-- /.box -->


                </div>
            </form>
    </div>




    </div>

@endsection

@section('head_scripts')

@endsection

@section('footer_scripts')

    <script>
        $(function () {
            //bootstrap WYSIHTML5 - text editor
            $('#description').wysihtml5();

            //Initialize Select2 Elements
            $(".select2").select2();

            $("#featured_until").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
            $("#date_available").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});


            $('#name').on('keypress keyup', function() {

                // Replace space with dash
                var val = $('#name').val()
                        .split(' ').join('-')
                        .toLowerCase()
                        .split('æ').join('ae')
                        .split('ø').join('oe')
                        .split('å').join('aa');
                $('#path').val(val);
            })

        });
    </script>
@endsection