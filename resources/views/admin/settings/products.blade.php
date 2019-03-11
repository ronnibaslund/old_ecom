@extends('admin.layout')
@section('content')

    <div class="row">
        <div class="col-xs-12">

            <form action="/admin/settings/product" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="box box-info">
                    <div class="box-header">
                        {{--<h3 class="box-title">Email Indstillinger</h3>--}}
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <h4>Mål</h4>

                        <div class="form-group">
                            <label>Vægt enhed</label>
                            <select class="form-control" name="weight_unit" style="width: 100%;">
                                <option value="kg" selected="selected" <?php echo (shop_config('weight_unit', 'PRODUCT') == 'kg') ? 'selected':''; ?>>kg</option>
                                <option value="g" <?php echo (shop_config('weight_unit', 'PRODUCT') == 'g') ? 'selected':''; ?>>g</option>
                                <option value="lbs" <?php echo (shop_config('weight_unit', 'PRODUCT') == 'lbs') ? 'selected':''; ?>>lbs</option>
                                <option value="oz" <?php echo (shop_config('weight_unit', 'PRODUCT') == 'oz') ? 'selected':''; ?>>oz</option>
                            </select>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label>Dimensions enhed</label>
                            <select class="form-control" name="dimension_unit" style="width: 100%;">
                                <option value="m" <?php echo (shop_config('dimension_unit', 'PRODUCT') == 'm') ? 'selected':''; ?>>m</option>
                                <option value="cm" <?php echo (shop_config('dimension_unit', 'PRODUCT') == 'cm') ? 'selected':''; ?>>cm</option>
                                <option value="mm" <?php echo (shop_config('dimension_unit', 'PRODUCT') == 'mm') ? 'selected':''; ?>>mm</option>
                                <option value="in" <?php echo (shop_config('dimension_unit', 'PRODUCT') == 'in') ? 'selected':''; ?>>in</option>
                                <option value="yd" <?php echo (shop_config('dimension_unit', 'PRODUCT') == 'yd') ? 'selected':''; ?>>yd</option>
                            </select>
                        </div>
                        <!-- /.form-group -->

                        <br />

                        <h4>Butik og produktsider</h4>

                        <div class="form-group">
                            <label>Butiks-Side-Visning</label>
                            <select class="form-control" name="shop_page_display" style="width: 100%;">
                                <option value="products" <?php echo (shop_config('shop_page_display', 'PRODUCT') == 'products') ? 'selected':''; ?>>Vis produkter</option>
                                <option value="subcategories" <?php echo (shop_config('shop_page_display', 'PRODUCT') == 'subcategories') ? 'selected':''; ?>>Vis kategorier &amp; underkategorier</option>
                                <option value="both" <?php echo (shop_config('shop_page_display', 'PRODUCT') == 'both') ? 'selected':''; ?>>Vis begge</option>
                            </select>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label>Standard Kategori Visning</label>
                            <select class="form-control" name="category_display" style="width: 100%;">
                                <option value="products" <?php echo (shop_config('category_display', 'PRODUCT') == 'products') ? 'selected':''; ?>>Vis produkter</option>
                                <option value="subcategories" <?php echo (shop_config('category_display', 'PRODUCT') == 'subcategories') ? 'selected':''; ?>>Vis underkategorier</option>
                                <option value="both" <?php echo (shop_config('category_display', 'PRODUCT') == 'both') ? 'selected':''; ?>>Vis begge</option>
                            </select>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label>Standard produktsortering</label>
                            <select class="form-control" name="default_catalog_orderby" style="width: 100%;">
                                <option value="menu_order" <?php echo (shop_config('default_catalog_orderby', 'PRODUCT') == 'menu_order') ? 'selected':''; ?>>Standardsortering (tilpasset rækkefølge + navn)</option>
                                <option value="popularity" <?php echo (shop_config('default_catalog_orderby', 'PRODUCT') == 'popularity') ? 'selected':''; ?>>Popularitet (salg)</option>
                                <option value="rating" <?php echo (shop_config('default_catalog_orderby', 'PRODUCT') == 'rating') ? 'selected':''; ?>>Gennemsnitlig Bedømmelse</option>
                                <option value="date" <?php echo (shop_config('default_catalog_orderby', 'PRODUCT') == 'date') ? 'selected':''; ?>>Sorter efter nyeste</option>
                                <option value="price" <?php echo (shop_config('default_catalog_orderby', 'PRODUCT') == 'price') ? 'selected':''; ?>>Sorter efter pris (stigende)</option>
                                <option value="price-desc" <?php echo (shop_config('default_catalog_orderby', 'PRODUCT') == 'price-desc') ? 'selected':''; ?>>Sorter efter pris (faldende)</option>
                            </select>
                        </div>
                        <!-- /.form-group -->

                        Tilføj til kurv adfærd
                        <div class="checkbox">
                            <label>
                                <input type="hidden" value="false" name="cart_redirect_after_add">
                                <input type="checkbox" name="cart_redirect_after_add"
                                       value="true" <?php echo (shop_config('cart_redirect_after_add', 'PRODUCT') == true) ? 'checked' : ''; ?>>
                                Aktiver
                                Omdiriger til kassesiden efter vellykket tilføjelse
                            </label>
                        </div>

                        <br />

                        <h4>Produktbilleder</h4>

                        <table class="table">

                            <tbody>
                            <tr valign="top">
                                <th scope="row" class="titledesc">Katalog billeder</th>
                                <td class="forminp image_width_settings">
                                    <input name="shop_catalog_image_size[width]" id="shop_catalog_image_size-width"
                                           type="text" size="3" value="<?php echo shop_config('shop_catalog_image_size[width]', 'PRODUCT'); ?>"> × <input
                                            name="shop_catalog_image_size[height]" id="shop_catalog_image_size-height"
                                            type="text" size="3" value="<?php echo shop_config('shop_catalog_image_size[height]', 'PRODUCT'); ?>">px
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row" class="titledesc">Enkelt Produkt Billede</th>
                                <td class="forminp image_width_settings">

                                    <input name="shop_single_image_size[width]" id="shop_single_image_size-width"
                                           type="text" size="3" value="<?php echo shop_config('shop_single_image_size[width]', 'PRODUCT'); ?>"> × <input
                                            name="shop_single_image_size[height]" id="shop_single_image_size-height"
                                            type="text" size="3" value="<?php echo shop_config('shop_single_image_size[height]', 'PRODUCT'); ?>">px
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row" class="titledesc">Produktminiaturebilleder</th>
                                <td class="forminp image_width_settings">
                                    <input name="shop_thumbnail_image_size[width]" id="shop_thumbnail_image_size-width"
                                           type="text" size="3" value="<?php echo shop_config('shop_thumbnail_image_size[width]', 'PRODUCT'); ?>"> × <input
                                            name="shop_thumbnail_image_size[height]"
                                            id="shop_thumbnail_image_size-height" type="text" size="3" value="<?php echo shop_config('shop_thumbnail_image_size[height]', 'PRODUCT'); ?>">px
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <br />

                        <h4>Beholdning</h4>

                        <div class="checkbox">
                            <label>
                                <input type="hidden" value="false" name="manage_stock">
                                <input type="checkbox" name="manage_stock"
                                       value="true" <?php echo (shop_config('manage_stock', 'PRODUCT') == true) ? 'checked' : ''; ?>>
                                Aktiver lageradministration
                            </label>
                        </div>


                        <div class="form-group">
                            <label>Tilbagehold (minuter)</label>
                            <input type="number" step="1" name="hold_stock_minutes" class="form-control"
                                   value="<?php echo shop_config('hold_stock_minutes', 'PRODUCT'); ?>">
                            <span class="help-block">Tilbagehold (for ubetalt ordre) 1 x minuter. Når denne grænse bliver nået, vil den uafklarede ordre blive annulleret. Lad den være blank for at inaktivere.</span>
                        </div>


                        Meddelelser
                        <div class="checkbox">
                            <label>
                                <input type="hidden" value="false" name="notify_low_stock">
                                <input type="checkbox" name="notify_low_stock"
                                       value="true" <?php echo (shop_config('notify_low_stock', 'PRODUCT') == true) ? 'checked' : ''; ?>>
                                Aktiver lav lagerstatus meddelelser
                            </label>
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="hidden" value="false" name="notify_no_stock">
                                <input type="checkbox" name="notify_no_stock"
                                       value="true" <?php echo (shop_config('notify_no_stock', 'PRODUCT') == true) ? 'checked' : ''; ?>>
                                Aktiver ikke på lager meddelelser
                            </label>
                        </div>

                        <div class="form-group">
                            <label>Anmeldelsesmodtager</label>
                            <input type="text" name="stock_email_recipient" class="form-control"
                                   value="<?php echo shop_config('stock_email_recipient', 'PRODUCT'); ?>">
                        </div>

                        <div class="form-group">
                            <label>Lav lagergrænse</label>
                            <input type="number" step="1" name="notify_no_stock_amount" class="form-control"
                                   value="<?php echo shop_config('notify_no_stock_amount', 'PRODUCT'); ?>">
                        </div>

                        <div class="form-group">
                            <label>Ikke på lager grænse</label>
                            <input type="number" step="1" name="notify_low_stock_amount" class="form-control"
                                   value="<?php echo shop_config('notify_low_stock_amount', 'PRODUCT'); ?>">
                        </div>

                        Ikke på lager synlighed
                        <div class="checkbox">
                            <label>
                                <input type="hidden" value="false" name="hide_out_of_stock_items">
                                <input type="checkbox" name="hide_out_of_stock_items"
                                       value="true" <?php echo (shop_config('hide_out_of_stock_items', 'PRODUCT') == true) ? 'checked' : ''; ?>>
                                Skjul produkter i kataloget, der ikke er på lager
                            </label>
                        </div>



                        <div class="form-group">
                            <label>Lager-Visning-Format</label>
                            <select class="form-control" name="stock_format" style="width: 100%;">
                                <option value="always_show" <?php echo (shop_config('stock_format', 'PRODUCT') == 'always_show') ? 'selected':''; ?>>Vis altid lager f.eks. "12 på lager"</option>
                                <option value="low_amount" <?php echo (shop_config('stock_format', 'PRODUCT') == 'low_amount') ? 'selected':''; ?>>Vis kun lager når det er lavt f.eks. "Kun 2 tilbage på lager" vs. "På Lager"</option>
                                <option value="no_amount" <?php echo (shop_config('stock_format', 'PRODUCT') == 'no_amount') ? 'selected':''; ?>>Vis aldrig lagerstatus</option>
                            </select>
                        </div>
                        <!-- /.form-group -->

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <!-- /.box -->
            </form>
        </div>
    </div>

@endsection