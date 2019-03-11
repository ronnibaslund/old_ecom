<?php

namespace App\Http\Controllers;

use App\CouponDescription;
use App\Coupons;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data = array(
            'page_title' => 'Kuponer',
            'coupons' => Coupons::all()
        );

        return view('admin.coupons.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = array(
            'page_title' => 'Ny kupon',
            'customers' => '',
            'products' => '',
            'categories' => ''
        );

        return view('admin.coupons.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $coupon = new Coupons();
        $coupon->fill($request->all());
        $coupon->save();

        $description = new CouponDescription();
        $description->fill($request->all());
        $description->coupon_id = $coupon->id;
        $description->save();

        return redirect("admin/coupon/$coupon->id/edit");
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
        $coupon = Coupons::find($id);
        $description = CouponDescription::where('coupon_id', '=', $id)->first();

        $data = array(
            'page_title' => $description->name,
            'coupon' => $coupon,
            'description' => $description
        );

        return view('admin.coupons.create', $data);
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
        // Update coupon
        $coupon = Coupons::find($id)->first();
        $coupon->fill($request->all());
        $coupon->save();

        // Get the current coupon description or create a new
        $description = CouponDescription::firstOrNew(['coupon_id' => $id, 'language_id' => $request->get('language_id')]);
        $description->fill($request->all());
        $description->save();

        return redirect("admin/coupon/$coupon->id/edit");
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
