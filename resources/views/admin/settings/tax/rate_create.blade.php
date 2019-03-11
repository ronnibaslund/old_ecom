@extends('admin.layout')

@section('content')

    <div class="row">

        @if(isset($rate))
            <form action="/admin/settings/tax/{{ $rate->id }}" method="post">
        @else
            <form action="/admin/settings/tax" method="post">
                <input type="hidden" name="_method" value="PUT">
        @endif

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="language_id" value="1"> <!-- TODO: Hente denne fra databasen -->

                <div class="col-xs-12">

                    <div class="box box-primary">
                        <div class="box-header with-border">

                            <h3 class="box-title">Rate</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                            <div class="form-group">
                                <label>Land</label>
                                <select class="form-control" name="zone_id">
                                    <option value="">Vælg land</option>
                                    @foreach($zones as $zone)
                                        <option value="{{ $zone->id }}" @if(isset($rate)) {{ ($zone->id == $rate->zone_id) ? 'selected':'' }} @endif>{{ $zone->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Moms klasse</label>
                                <select class="form-control" name="tax_class_id">
                                    <option value="">Vælg moms klasse</option>
                                    @foreach($tax_classes as $tc)
                                        <option value="{{ $tc->id }}"  @if(isset($rate)) {{ ($tc->id == $rate->tax_class_id) ? 'selected':'' }} @endif>{{ $tc->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Prioritet</label>
                                <input type="text" class="form-control" name="priority" placeholder="Prioritet" value="{{ $rate->priority or '' }}">
                            </div>

                            <div class="form-group">
                                <label>Moms sats</label>
                                <input type="number" step="0.10" class="form-control" name="rate" placeholder="Moms sats" value="{{ $rate->rate or '' }}">
                            </div>

                            <div class="form-group">
                                <label>Beskrivelse</label>
                                <textarea class="form-control" name="description" rows="3" placeholder="Beskrivelse">{{ $rate->description or '' }}</textarea>
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
        });

    </script>
@endsection