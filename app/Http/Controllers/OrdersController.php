<?php

namespace App\Http\Controllers;

use App\Address;
use App\Customer;
use App\OrderNotes;
use App\OrderProducts;
use App\Orders;
use App\OrderStatus;
use App\OrderStatusHistory;
use App\OrderTotals;
use App\Products;
use App\RecurringOrder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'page_title' => 'Ordre',
            'orders' => Orders::paginate(10)
        );

        return view('admin.orders.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'page_title' => 'Opret ny ordre',
            'order_status' => OrderStatus::all()
        );

        return view('admin.orders.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Get order status from the database
        $order_status = OrderStatus::where('name', $request->get('order_status'))->first();

        //
        // Customer part of the order
        $customer_id = $request->get('customer_id');
        $shipping_id = $request->get('shipping_id');

        // If customer id is set then get the customer from the database
        if($customer_id) {
            $customer = Customer::find($customer_id);
            $billing = Address::where('customer_id', $customer->id)->where('is_billing', 1)->first();
        }

        // If shipping id is set then get the address
        if($shipping_id) {
            $shipping = Address::find($shipping_id);
        }

        // If customer id and shipping id is net set then create a new customer and addresses
        if(!isset($customer) and !isset($shipping_address)) {

            //Array ( [firstname] => [lastname] => [street] => [postcode] => [city] => [phone] => [email] => )
            $customer = new Customer();
            $customer->fill($request->get('billing'));
            //$customer->save();

            // Create new
            $primary = new Address();
            $primary->is_primary = 1;
            $primary->customer_id = $customer->id;
            $primary->fill($request->get('billing'));
            //$primary->save();

            // Create new billing address
            $billing = new Address();
            $billing->is_billing = 1;
            $billing->customer_id = $customer->id;
            $billing->fill($request->get('billing'));
            //$billing->save();

            //Array ( [firstname] => [lastname] => [street] => [postcode] => [city] => [phone] => )

            // Create new
            $shipping = new Address();
            $shipping->is_shipping = 1;
            $shipping->customer_id = $customer->id;
            $shipping->fill($request->get('shipping'));
            //$shipping->save();
        }

        //
        // Create the order in the database
        $order = new Orders();
        $order->customer_id = $customer->id;
        $order->customer_email = $customer->email;
        $order->customer_firstname = $customer->firstname;
        $order->customer_lastname = $customer->lastname;
        $order->customer_organization = $customer->organization;
        $order->customer_street = $customer->street;
        $order->customer_city = $customer->city;
        $order->customer_postcode = $customer->postcode;
        $order->customer_country_name = $customer->country_name;
        $order->customer_phone = $customer->phone;
        $order->customer_ean = $customer->ean;
        $order->customer_cvr = $customer->cvr;

        $order->shipping_firstname = $shipping->firstname;
        $order->shipping_lastname = $shipping->lastname;
        $order->shipping_organization = $shipping->organization;
        $order->shipping_street = $shipping->street;
        $order->shipping_city = $shipping->city;
        $order->shipping_postcode = $shipping->postcode;
        $order->shipping_country_name = $shipping->country_name;
        $order->shipping_phone = $shipping->phone;
        $order->shipping_ean = $shipping->ean;
        $order->shipping_cvr = $shipping->cvr;

        $order->billing_firstname = $billing->firstname;
        $order->billing_lastname = $billing->lastname;
        $order->billing_organization = $billing->organization;
        $order->billing_street = $billing->street;
        $order->billing_city = $billing->city;
        $order->billing_postcode = $billing->postcode;
        $order->billing_country_name = $billing->country_name;
        $order->billing_phone = $billing->phone;
        $order->billing_ean = $billing->ean;
        $order->billing_cvr = $billing->cvr;

        $order->payment_method = $request->get('payment_method');
        $order->date_purchased = 'NOW()';
        $order->status = $request->get('order_status');
        $order->currency = ''; //<--------- Slettes
        $order->currency_value = ''; //<--------- Slettes
        $order->shipping_tax = ''; //<--------- Slettes
        $order->shipping_module = '';
        $order->total = $request->get('order_total');
        $order->referer_url = '';
        $order->ip_address = $request->getClientIp();

        $order->save();

        //
        // Create order totals
        OrderTotals::create([
            'order_id' => $order->id,
            'title' => 'subtotal',
            'text' => 'subtotal',
            'value' => $request->get('order_subtotal'),
            'class' => '',
            'sort_order' => '',
        ]);
        OrderTotals::create([
            'order_id' => $order->id,
            'title' => 'tax',
            'text' => 'tax',
            'value' => $request->get('order_tax'),
            'class' => '',
            'sort_order' => '',
        ]);
        OrderTotals::create([
            'order_id' => $order->id,
            'title' => 'shipping',
            'text' => 'shipping',
            'value' => $request->get('order_shipping'),
            'class' => '',
            'sort_order' => '',
        ]);
        OrderTotals::create([
            'order_id' => $order->id,
            'title' => 'total',
            'text' => 'total',
            'value' => $request->get('order_total'),
            'class' => '',
            'sort_order' => '',
        ]);


        //
        // Create order products
        $products = $request->get('product');

        if(isset($products)) {
            foreach($products as $product) {

                $product_id = $product['id'];
                $price = $product['price'];
                $qty = $product['qty'];
                $subtotal = $price * $qty;
                $tax = $subtotal * 0.2;

                $product = Products::find($product_id);
                $description = $product->descriptions()->language(config('app.language_id'))->get();

                $order_products = new OrderProducts();
                $order_products->order_id = $order->id;
                $order_products->product_id = $product_id;
                $order_products->item_number = $product->item_number;
                $order_products->name = $description[0]->name;
                $order_products->qty = $qty;
                $order_products->cost = $product->cost;
                $order_products->price = $price;
                $order_products->tax = $tax;
                $order_products->subtotal = $subtotal;
                $order_products->save();
            }
        }

        //
        // Create Order status history
        OrderStatusHistory::create([
            'order_id'=>$order->id,
            'orders_status_id'=>$order_status->id,
            'customer_notified'=>'',
            'comments'=>''
        ]);

        //
        // Create order note
        OrderNotes::create([
            'order_id'=>$order->id,
            'type'=>$request->get('order_note_type'),
            'customer_notified'=>'',
            'user_id'=>'',
            'user_name'=>'',
            'note'=>$request->get('note')
        ]);


        //
        // Order type, if not once, the create a recurring order
        $order_type = $request->get('order_type'); // 1month etc...
        $recurring_every = '';
        switch ($order_type) {
            case '7days':
                $recurring_every = '+7 days';
                break;
            case '14days':
                $recurring_every = '+14 days';
                break;
            case '1month':
                $recurring_every = '+1 month';
                break;
            case '3month':
                $recurring_every = '+3 month';
                break;
            case '6month':
                $recurring_every = '+6 month';
                break;
            case '12month':
                $recurring_every = '+12 month';
                break;
        }
        //
        // Create the recurring order
        RecurringOrder::create([
            'order_info'=>json_encode($request->except(['product', '_token', 'note', 'order_note_type', '_method'])),
            'products'=>json_encode($request->get('product')),
            'next'=>date('Y-m-d', strtotime($recurring_every)),
            'recurring_every'=>$recurring_every
        ]);


        // Redir to
        echo "her";
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
        //
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
        //
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
