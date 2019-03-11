<?php

namespace App\Http\Controllers;

use App\PageDescription;
use App\Pages;
use App\Urls;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = array(
            'page_title' => 'Sider',
            'pages' => Pages::all()
        );

        return view('admin.pages.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = array(
            'page_title' => 'Ny side',
            'pages' => Pages::all()
        );

        return view('admin.pages.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $page = new Pages();
        $page->fill($request->all());
        $page->save();

        $description = new PageDescription();
        $description->fill($request->all());
        $description->page_id = $page->id;
        $description->save();

        Urls::page($request->get('url'), $page->id, 'PageController', 'view');

        return redirect("admin/page/$page->id/edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $page = Pages::find($id);
        $description = PageDescription::where('page_id', '=', $id)->first();

        $data = array(
            'page_title' => $description->name,
            'page' => $page,
            'description' => $description,
            'pages' => Pages::where('id', '!=', $id)->get()
        );

        return view('admin.pages.create', $data);
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
        $page = Pages::find($id);
        $page->fill($request->all());
        $page->save();

        // Get the current page description or create a new
        $description = PageDescription::firstOrNew(['page_id' => $id, 'language_id' => $request->get('language_id')]);
        $description->fill($request->all());
        $description->save();

        Urls::page($request->get('url'), $id, 'PageController', 'view');

        return redirect("admin/page/$id/edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
