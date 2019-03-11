@extends('admin.layout')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">
                        @if($path != 'media')
                            <?php $back_path = substr($path, 0, strrpos($path, "/")); ?>
                        <a  href="<?php echo '?path=' . substr($path, 0, strrpos($path, "/")); ?>" class="btn btn-flat btn-info inline">Tilbage</a>
                        @endif
                        <a  href="{{ url("admin/media/folder?path=$path") }}" class="btn btn-flat btn-info inline">Opret mappe</a>
                    </h3>

                    <div class="box-tools">

                        <div class="input-group" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control input-sm pull-right"
                                   placeholder="Search">

                            <div class="input-group-btn">
                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                    <form action="{{ url('admin/media/image/upload')}}" class="dropzone" id="my-awesome-dropzone">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="path" value="{{ $path }}">
                    </form>

                    <a data-toggle="modal" href="/admin/test" data-target="#modal">Click me</a>

                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Navn</th>
                            <th></th>
                        </tr>

                        @foreach($dirs as $dir)

                        <tr>
                            <td>#</td>
                            <td><i class="fa fa-folder"></i></td>
                            <td>{{ substr($dir, strrpos($dir, "/")+1) }}</td>
                            <td class="text-right">
                                <a href="?path={{ htmlspecialchars_decode($dir) }}" class="btn btn-link" title="Show"><i class="fa fa-eye"></i></a>
                                {{--<a href="#" class="btn btn-link" title="Edit"><i class="fa fa-pencil"></i></a>--}}

                                <a href="{{ url("admin/media/folder/delete?path=$path&folder=$dir") }}" class="btn btn-link" title="Delete"
                                   onclick="confirm('Er du sikker på du vil slette mappen: <?php echo substr($dir, strrpos($dir, "/")+1); ?>?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach

                        @foreach($files as $file)
                        <tr>
                            <td>#</td>
                            <td><i class="fa fa-picture-o"></i></td>
                            <td id="image-{{ $file->id }}-title">{{ $file->title }}</td>

                            <td class="text-right">

                                <a data-toggle="modal" href="/admin/media/image/{{ $file->id }}" data-target="#modal"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="btn btn-link" title="Delete"><i class="fa fa-trash"></i></a>
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

@section('footer_scripts')
    <script>
        // The recommended way from within the init configuration:
        Dropzone.options.myAwesomeDropzone = {
            init: function() {
                this.on("success", function(file, response) {
                    //alert("Added file." + file.name);
                    console.log(file);

                    //TODO: add image show icon get image path from -> response.path

                    var temp = '<tr>' +
                                    '<td>#</td>' +
                                    '<td><i class="fa fa-picture-o"></i></td>' +
                                    '<td>'+ response.name +'</td>' +
                                    '<td class="text-right">' +
                                        '<a href="#" class="btn btn-link" title="Delete"><i class="fa fa-trash"></i></a>' +
                                    '</td>' +
                                '</tr>';

                    $('.table').append(temp);
                });
            }
        };

        function submitModal() {

            var _form = $('#modalForm');
            var _data = _form.serializeArray();
            var _url = _form.attr('action');

            $.post( _url, _data)
                    .done(function( response ) {
                        if(response.error != 'success') {
                            alert('Noget gik galt prov igen!');
                        } else {
                            $('#image-'+ response.id +'-title').html(response.name);
                            $('#modal').modal('hide')
                        }
                    });
        }
    </script>
@endsection