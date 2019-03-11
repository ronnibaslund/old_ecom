@extends('admin.layout')

@section('content')

    <div class="row">

        @if(isset($product))
            <form action="/admin/product/{{ $product->id }}" method="post">
        @else
            <form action="/admin/product" method="post">
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
                            <div class="form-group">
                                <label for="name">Navn</label>
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
                                <label for="description">Beskrivelse</label>
                                <textarea id="description" name="description" placeholder="Enter text ..." style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid rgb(221, 221, 221); padding: 10px;">{{ $description->description or '' }}</textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </div>
                    <!-- /.box -->

                    <!-- General -->
                    <div class="box">
                        <div class="box-header with-border">

                            <h3 class="box-title">General</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="box-body">

                            <!-- status (active / not active) -->
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="status" {{ (isset($product) && $product->status == 1) ? 'checked':'' }}> Aktiv
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="item_number">Varenummer</label>
                                <input type="text" class="form-control" id="item_number" name="item_number"
                                       placeholder="Enter item number"
                                       value="{{ $product->item_number or '' }}">
                            </div>

                            <div class="form-group">
                                <label for="price">Pris</label>
                                <input type="number" step="0.10" class="form-control" id="price" name="price"
                                       placeholder="Enter sales price"
                                       value="{{ $product->price or '' }}">
                            </div>

                            <!-- TODO: get tax_class from the database -->
                            <!-- tax_class_id (Momsklasse) -->
                            <div class="form-group">
                                <label>Moms</label>
                                <select class="form-control" name="tax_class_id">
                                    @if($tax_classes)
                                        @foreach($tax_classes as $tax)
                                            <option value="{{ $tax->id }}" {{ (isset($product) && $product->tax_class_id == $tax->id) ? 'selected':'' }} >{{ $tax->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <!-- date_available -->
                            <div class="form-group">
                                <label>Tilgængelige fra:</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="date_available"
                                           id="date_available"
                                           data-inputmask="'alias': 'dd-mm-yyyy'" data-mask=""
                                            @if(isset($product->date_available) and $product->date_available != null and $product->date_available != '0000-00-00 00:00:00')
                                            value="{{ $product->date_available }}"
                                            @else
                                            value="{{ date('d-m-Y') }}"
                                            @endif
                                            >
                                </div>
                                <!-- /.input group -->
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Gem</button>
                        </div>

                    </div>
                    <!-- /.box -->

                    <!-- Images -->
                    <div class="box">
                        <div class="box-header with-border">

                            <h3 class="box-title">Billeder</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <div>
                                <a data-toggle="modal" href="/admin/media/image/allimages/modal/{{ $product->id or '' }}" data-target="#modal" class="btn btn-default">Tilføj billede(r)</a>
                            </div>
                            <br />
                            <div id="product-images">
                            @if(isset($product))
                                @foreach($product->medias as $media)
                                    <div class="img-thumbnail">
                                        <a href="{{ url("admin/media/product/image/$media->id/delete?product_id=$product->id") }}" class="remove-image" onclick="Delete(this)" title="Slet billede" data-confirm="Er du sikker på du vil slette dette billede?"><i class="fa fa-times-circle"></i></a>
                                        <img src="{{ url($media->path . $media->file) }}" width="130" height="130" />
                                    </div>
                                @endforeach
                            @endif
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Gem</button>
                        </div>

                    </div>
                    <!-- /.box -->

                    <!-- Shipping -->
                    <div class="box collapsed-box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fragt</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="box-body">

                            <!-- weight (vægt) -->
                            <div class="form-group">
                                <label for="weight">Vægt</label>
                                <input type="number" step="0.10" class="form-control" id="weight" name="weight"
                                       placeholder="Enter weight"
                                       value="{{ $product->weight or '' }}">
                            </div>

                            <strong>Størrelse (cm)</strong>

                            <div class="row">
                                <div class="col-xs-4">
                                    <input type="number" class="form-control" name="length" placeholder="Længde" value="{{ $product->length or '' }}">
                                </div>
                                <div class="col-xs-4">
                                    <input type="number" class="form-control" name="width" placeholder="Brede" value="{{ $product->width or '' }}">
                                </div>
                                <div class="col-xs-4">
                                    <input type="number" class="form-control" name="height" placeholder="Højde" value="{{ $product->height or '' }}">
                                </div>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Gem</button>
                        </div>

                    </div>
                    <!-- /.box -->

                    <!-- Stuck -->
                    <div class="box collapsed-box">
                        <div class="box-header with-border">

                            <h3 class="box-title">Beholdning <!--(Beholdning)--></h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="box-body">

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="manage_stock" value="1" {{ (isset($product) && $product->manage_stock == true) ? 'checked':'' }}> Aktiver lagerstyring på
                                    produktniveau (Administrer lager?)
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Lager stk.</label>
                                <input type="number" class="form-control" name="quantity" id="quantity"
                                       placeholder="Enter qty"
                                       value="{{ $product->quantity or '' }}">
                            </div>


                            <div class="form-group">
                                <label>Tillad restordrer?</label>
                                <select class="form-control" name="backorders" title="Tillad restordrer?">
                                    <option value="no" {{ (isset($product) && $product->backorders == 'no') ? 'selected':'' }}>Tillad ikke</option>
                                    <option value="notify" {{ (isset($product) && $product->backorders == 'notify') ? 'selected':'' }}>Tillad, men underret kunde</option>
                                    <option value="yes" {{ (isset($product) && $product->backorders == 'yes') ? 'selected':'' }}>Tillad</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Lagerstatus</label>
                                <select class="form-control" name="stock_status">
                                    <option value="instock" {{ (isset($product) && $product->stock_status == 'instock') ? 'selected':'' }}>På lager</option>
                                    <option value="outofstock" {{ (isset($product) && $product->stock_status == 'outofstock') ? 'selected':'' }}>Ikke på lager</option>
                                </select>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </div>
                    <!-- /.box -->

                    <!-- Manufacturer -->
                    <div class="box collapsed-box">
                        <div class="box-header with-border">

                            <h3 class="box-title">Leverandør</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="box-body">

                            <!-- TODO: get manufacturers from the database -->
                            <!-- manufacturer_id (Leverandør) -->
                            <div class="form-group">
                                <label>Leverandør</label>
                                <select class="form-control" name="manufacturer_id">
                                    <option value="manufacturer_id" {{ (isset($product) && $product->manufacturer_id == 'id') ? 'selected':'' }}>Navn</option>
                                </select>
                            </div>

                            <!-- manufacturer_item_number (Leverandør varenummer) -->
                            <div class="form-group">
                                <label for="manufacturer_item_number">Leverandørs varenummer</label>
                                <input type="text" class="form-control" id="manufacturer_item_number"
                                       name="manufacturer_item_number"
                                       placeholder="Enter manufacturer item number"
                                        value="{{ $product->manufacturer_item_number or '' }}">
                            </div>

                            <!-- cost (Indkøbspris) -->
                            <div class="form-group">
                                <label for="cost">Indkøbspris</label>
                                <input type="number" step="0.01" class="form-control" id="cost" name="cost"
                                       placeholder="Enter cost price"
                                        value="{{ $product->cost or '' }}">
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Gem</button>
                        </div>

                    </div>
                    <!-- /.box -->

                    <!-- Featured -->
                    <div class="box collapsed-box">
                        <div class="box-header with-border">

                            <h3 class="box-title">Tilbud</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="box-body">

                            <!-- featured (true / false) - tilbud eller ej -->
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="true" name="featured" {{ (isset($product) && $product->featured == true) ? 'checked':'' }}> Aktiv
                                </label>
                            </div>

                            <div class="form-group">
                                <label for="featured_price">Tilbudspris</label> <!-- Tilbuds pris -->
                                <input type="text" class="form-control" id="featured_price"
                                       name="featured_price"
                                       placeholder="Enter discount price"
                                        value="{{ $product->featured_price or '' }}">
                            </div>

                            <div class="form-group">
                                <label>Tilbud indtil: <!-- (Tilbud indtil) --></label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" name="featured_until"
                                           id="featured_until"
                                           data-inputmask="'alias': 'dd-mm-yyyy'" data-mask=""
                                           @if(isset($product->featured_until) and $product->featured_until != null and $product->featured_until != '0000-00-00 00:00:00')
                                           value="{{ $product->featured_until }}"
                                           @else
                                           value=""
                                           @endif
                                            >
                                </div>
                                <!-- /.input group -->
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Gem</button>
                        </div>

                    </div>
                    <!-- /.box -->

                    <!-- Product tags -->
                    <div class="box">
                        <div class="box-header with-border">

                            <h3 class="box-title">Produkt tags</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            @if(isset($tags))
                            <?php
                            $tags_string = '';
                            foreach($tags as $tag) {
                                if($tags_string != '') {
                                    $tags_string .= ','.$tag->name;
                                } else {
                                    $tags_string .= $tag->name;
                                }
                            }
                            ?>
                            @else
                                <?php $tags_string = ''; ?>
                            @endif

                            <input type="text" class="form-control" name="tags" id="tokenfield" value="{{ $tags_string }}" />


                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Gem</button>
                        </div>
                    </div>

                    <!-- Product categories -->
                    <div class="box">
                        <div class="box-header with-border">

                            <h3 class="box-title">Produktkategorier</h3>

                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-plus"></i></button>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label>Vælg de kategorier produktet skal vises i</label>
                                <select class="form-control select2" multiple="multiple" name="categories[]" data-placeholder="Vælg kategorier" style="width: 100%;">
                                    @foreach($categories as $category)
                                    <?php
                                        if(isset($related_categories)) {
                                            echo renderSelectTree($category, $related_categories);
                                        } else {
                                            echo renderSelectTree($category);
                                        }
                                    ?>
                                    @endforeach
                                </select>
                            </div><!-- /.form-group -->


                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Gem</button>
                        </div>
                    </div>


                    <div class="box">
                        Mnagler:

                        Mersalg - Krydssalg - Gruppering<br/>
                        <br/>

                    </div>

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
            //Initialize Select2 Elements
            $(".select2").select2();

            $('#tokenfield').tokenfield();

            //bootstrap WYSIHTML5 - text editor
            $('#description').wysihtml5();

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
                $('#url').val(val);
            })

        });

        function submitModal() {

            var _form = $('#modalForm');
            var _data = _form.serializeArray();
            var _url = _form.attr('action');


            $.post( _url, _data)
                    .done(function( response ) {
                        if(response.error != 'success') {
                            alert('Noget gik galt prov igen!');
                        } else {

                            response.images.forEach(function(image) {
                                console.log(image);

                                var _element = '<div class="img-thumbnail">' +
                                        '<a href="/admin/media/product/image/' + image.id + '/delete?product_id=' + response.product_id + '" class="remove-image" onclick="Delete(this)" title="Slet billede" data-confirm="Er du sikker på du vil slette dette billede?"><i class="fa fa-times-circle"></i></a>' +
                                        '<img src="/' + image.path + image.file + '" width="130" height="130" />' +
                                        '</div>';

                                $('#product-images').append(_element);
                                $('#modal').modal('hide')
                            });

                        }
                    });

        }
    </script>
@endsection