<?php

namespace App\Http\Controllers;

use App\Giftcards;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GiftcardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = array(
            'page_title' => 'Gavekort',
            'giftcards' => Giftcards::all()
        );

        return view('admin.giftcards.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = array(
            'page_title' => 'Nyt Gavekort',
        );

        return view('admin.giftcards.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $giftcard = new Giftcards();
        $giftcard->fill($request->all());
        $giftcard->expire_date = date('Y-m-d', strtotime($request->get('expire_date')));
        $giftcard->save();

        return redirect("admin/giftcard/$giftcard->id/edit");
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
        $giftcard = Giftcards::find($id);

        $data = array(
            'page_title' => 'Redigere gavekort',
            'giftcard' => $giftcard
        );

        return view('admin.giftcards.create', $data);
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
        $giftcard = Giftcards::find($id)->first();
        $giftcard->fill($request->all());
        $giftcard->expire_date = date('Y-m-d', strtotime($request->get('expire_date')));
        $giftcard->save();

        return redirect("admin/giftcard/$giftcard->id/edit");
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
