<?php

namespace App\Http\Controllers;

use App\Address;
use App\Country;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'page_title' => 'Kunder',
            'customers' => Customer::all()
        );

        return view('admin.customers.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'page_title' => 'Ny kunde',
            'countries' => Country::all()
        );

        return view('admin.customers.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = Customer::firstOrCreate($request->get('primary'));
        $customer->email = $request->get('email');
        $customer->save();

        $primary = Address::where('customer_id', $customer->id)->where('is_primary', 1)->first();
        if(isset($primary)) {
            //update
            $primary->fill($request->get('primary'));
            $primary->save();
        } else {
            // Create new
            $primary = new Address();
            $primary->is_primary = 1;
            $primary->customer_id = $customer->id;
            $primary->fill($request->get('primary'));
            $primary->save();
        }

        $billing = Address::where('customer_id', $customer->id)->where('is_billing', 1)->first();
        if(isset($billing)) {
            //update
            $billing->fill($request->get('primary'));
            $billing->save();
        } else {
            // Create new
            $billing = new Address();
            $billing->is_billing = 1;
            $billing->customer_id = $customer->id;
            $billing->fill($request->get('primary'));
            $billing->save();
        }

        $shipping = Address::where('customer_id', $customer->id)->where('is_shipping', 1)->first();
        if(isset($shipping)) {
            //update
            $shipping->fill($request->get('shipping'));
            $shipping->save();
        } else {
            // Create new
            $shipping = new Address();
            $shipping->is_shipping = 1;
            $shipping->customer_id = $customer->id;
            $shipping->fill($request->get('shipping'));
            $shipping->save();
        }

        return redirect("admin/customers");
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
        $customer = Customer::find($id);
        $primary = Address::where('customer_id', $id)->where('is_primary', 1)->first();
        $shipping = Address::where('customer_id', $id)->where('is_shipping', 1)->first();

        $data = array(
            'page_title' => $primary->firstname.' '.$primary->lastname,
            'customer'=> $customer,
            'primary' => $primary,
            'shipping' => $shipping,
            'countries' => Country::all()
        );

        return view('admin.customers.create', $data);
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
        $customer = Customer::find($id);
        $customer->fill($request->get('primary'));
        $customer->email = $request->get('email');
        $customer->save();

        $primary = Address::where('customer_id', $id)->where('is_primary', 1)->first();
        $primary->fill($request->get('primary'));
        $primary->save();

        $billing = Address::where('customer_id', $id)->where('is_billing', 1)->first();
        $billing->fill($request->get('primary'));
        $billing->save();

        $shipping = Address::where('customer_id', $id)->where('is_shipping', 1)->first();
        $shipping->fill($request->get('shipping'));
        $shipping->save();

        return redirect("admin/customers");
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

    /**
     * @param $id Customer id
     * @param string $type is_primary or is_billing or is_shipping
     * @return mixed
     */
    public function addressModal($id, $type = 'is_billing') {

        $address = Address::where('customer_id', $id)->where($type, 1)->first();
        $customer = Customer::find($id);

        $data = array(
            'page_title' => $address->firstname . ' ' . $address->lastname,
            'address'=> $address,
            'customer_id' => $id,
            'countries' => Country::all(),
            'type' => $type,
            'email' => $customer->email
        );

        return view('admin.customers.address-modal', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addressModalUpdate(Request $request)
    {
        $type = $request->get('type');
        $customer_id = $request->get('customer_id');

        if($type == 'is_primary') {
            $address = Customer::find($customer_id);
            $address->fill($request->get('primary'));
            $address->email = $request->get('email');
            $address->save();

            $primary = Address::where('customer_id', $customer_id)->where('is_primary', 1)->first();
            $primary->fill($request->get('primary'));
            $primary->save();
        }

        if($type == 'is_billing') {
            $address = Address::where('customer_id', $customer_id)->where('is_billing', 1)->first();
            $address->fill($request->get('primary'));
            $address->save();
        }

        if($type == 'is_shipping') {
            $address = Address::where('customer_id', $customer_id)->where('is_shipping', 1)->first();
            $address->fill($request->get('shipping'));
            $address->save();
        }

        $data = array(
            'error' => 'success',
            'type' => $type,
            'address' => $address
        );

        return Response::json($data);
    }

    public function search(Request $request) {

        $customers = Customer::where('email', 'like', '%'.$request->get('q').'%')
            ->orwhere('firstname', 'like', '%'.$request->get('q').'%')
            ->orwhere('lastname', 'like', '%'.$request->get('q').'%')
            ->orwhere('phone', 'like', '%'.$request->get('q').'%')
            ->with(['addresses'])
            ->get();

        return Response::json($customers);
    }
}
