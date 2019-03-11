<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryDescription;
use App\Urls;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'page_title' => 'Kategorier',
            'categories' => Category::where('parent_id', '=', '0')->get()
        );

        return view('admin.categories.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'page_title' => 'Ny kategori',
            'categories' => Category::where('parent_id', '=', '0')->get()
        );

        return view('admin.categories.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->fill($request->all());
        $category->save();

        $description = new CategoryDescription();
        $description->fill($request->all());
        $description->category_id = $category->id;
        $description->save();

        Urls::category($request->get('path'), $category->id, 'CategoryController', 'view');

        return redirect("admin/category/$category->id/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $description = CategoryDescription::where('category_id', '=', $id)->first();

        $data = array(
            'page_title' => $description->name,
            'category' => $category,
            'description' => $description,
            'categories' => Category::where('parent_id', '=', '0')->get()
        );

        return view('admin.categories.create', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Update product
        $category = Category::find($id);
        $category->fill($request->all());
        $category->save();

        // Get the current product description or create a new
        $description = CategoryDescription::firstOrNew(['category_id' => $id, 'language_id' => $request->get('language_id')]);
        $description->fill($request->all());
        $description->save();

        Urls::category($request->get('path'), $id, 'CategoryController', 'view');

        return redirect("admin/category/$id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
