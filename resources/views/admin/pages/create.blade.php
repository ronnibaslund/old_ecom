@extends('admin.layout')

@section('content')

    <div class="row">

        @if(isset($page))
            <form action="/admin/page/{{ $page->id }}" method="post">
        @else
            <form action="/admin/page" method="post">
                <input type="hidden" name="_method" value="PUT">
        @endif

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="language_id" value="1"> <!-- TODO: Hente denne fra databasen -->

                <div class="col-xs-12">

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
                                    <input type="checkbox" value="1" name="status" {{ (isset($page) && $page->status == 1) ? 'checked':'' }}> Aktiv
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Enter name"
                                       value="{{ $description->name or '' }}">
                            </div>

                            <div class="form-group">
                                <label for="name">Url</label>
                                <input type="text" class="form-control" id="url" name="url"
                                       placeholder="Enter url"
                                       value="{{ $description->url or '' }}">
                            </div>

                            <div class="form-group">
                                <label>Vælg forældre</label>
                                <select class="form-control select2" name="parent_id" style="width: 100%;">
                                    <option selected="selected" value="">Ingen</option>
                                    @foreach($pages as $p)
                                        @if(isset($page))
                                            <option {{ $page->parent_id == $p->id ? 'selected="selected"':'' }} value="{{ $p->id }}">{{ $p->descriptions()->language(config('app.language_id'))->first()->name }}</option>
                                        @else
                                            <option value="{{ $p->id }}">{{ $p->descriptions()->language(config('app.language_id'))->first()->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div><!-- /.form-group -->

                            <div class="form-group">
                                <label for="content">Indhold</label>
                                <textarea id="content" name="content" placeholder="Enter text ..." style="width: 100%; height: 600px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;">{{ $description->content or '' }}</textarea>
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
            $('#content').wysihtml5();

            //Initialize Select2 Elements
            $(".select2").select2();

            $('#name').on('keypress keyup', function() {

                // Replace space with dash
                var val = $('#name').val()
                        .split(' ').join('-')
                        .toLowerCase()
                        .split('æ').join('ae')
                        .split('ø').join('oe')
                        .split('å').join('aa');
                $('#url').val(val);
            });
        });

    </script>
@endsection