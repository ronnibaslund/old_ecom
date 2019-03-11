<?php

namespace App\Http\Controllers;

use App\Category;
use App\ProductDescription;
use App\ProductTag;
use App\ProductToCategory;
use App\TaxClass;
use App\Urls;
use elv1ss\Currency\Currency;
use Illuminate\Http\Request;

use App\Products;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use \Illuminate\Foundation\Application;

class ProductController extends Controller
{
    /**
     * Application instance
     */
    protected $app;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = array(
            'page_title' => 'Produkter',
            'products' => Products::all()
        );

        return view('admin.products.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = array(
            'page_title' => 'Nyt produkt',
            'tax_classes' => TaxClass::all(),
            'categories' => Category::where('parent_id', '=', '0')->get()
        );

        return view('admin.products.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $product = new Products();
        $product->fill($request->all());
        $product->save();

        $description = new ProductDescription();
        $description->fill($request->all());
        $description->product_id = $product->id;
        $description->save();

        // Save product to categories releation
        if(is_array($request->get('categories'))) {
            foreach($request->get('categories') as $category_id) {
                ProductToCategory::firstOrCreate(['product_id' => $product->id, 'category_id' => $category_id]);
            }
        }

        // Save product tags to the database
        ProductTag::stringSave($request->get('tags'), $product->id, $request->get('language_id'));

        Urls::product($request->get('url'), $product->id, 'ProductController', 'view');

        return redirect("admin/product/$product->id/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return Response
     * @internal param int $id
     */
    public function show(Request $request, $id)
    {
        $product = Products::find($id);
        $description = $product->descriptions()->language(config('app.language_id'))->get();

        $currency = new Currency($this->app);

        $subtotal = $product->price * $request->get('qty');

        $data = [
            'product' => $product,
            'description' => $description[0],
            'qty' => $request->get('qty'),
            'price' => $currency->format($product->price, 'DKK'),
            'subtotal' => $currency->format($subtotal, 'DKK'),
            'subtotal_cal' => $subtotal
        ];

        return Response::json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        $description = ProductDescription::where('product_id', '=', $id)->first();
        $related_categories = ProductToCategory::select('category_id')->where('product_id', '=', $id)->get();
        $tags = ProductTag::where('product_id', $id)->get();

        $data = array(
            'page_title' => $description->name,
            'product' => $product,
            'description' => $description,
            'tax_classes' => TaxClass::all(),
            'categories' => Category::where('parent_id', '=', '0')->get(),
            'related_categories' =>$related_categories,
            'tags' => $tags
        );

        return view('admin.products.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // Update product
        $product = Products::find($id);
        $product->fill($request->all());
        $product->save();

        // Get the current product description or create a new
        $description = ProductDescription::firstOrNew(['product_id' => $id, 'language_id' => $request->get('language_id')]);
        $description->fill($request->all());
        $description->save();

        // Save product to categories releation
        if(is_array($request->get('categories'))) {
            foreach($request->get('categories') as $category_id) {
                ProductToCategory::firstOrCreate(['product_id' => $id, 'category_id' => $category_id]);
            }
        }

        // Save product tags to the database
        ProductTag::stringSave($request->get('tags'), $id, $request->get('language_id'));


        Urls::product($request->get('url'), $id, 'ProductController', 'view');

        return redirect("admin/product/$id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // TODO: Opret slet produkt
    }

    public function search(Request $request) {

        $product = Products::where('item_number', 'like', '%'.$request->get('q').'%')
            ->with(['descriptions'])
            ->get();

        return Response::json($product);
    }
}
