<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Country;
use App\ShippingCompanies;
use App\ShippingCompanyPrices;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConfigurationController extends Controller
{
    public function email() {

        $data = array(
            'page_title' => 'Email indstillinger'
        );

        return view('admin.settings.email')->with($data);

    }

    public function emailStore(Request $request) {
        Configuration::insertConfiguration($request, 'EMAIL');

        return redirect("admin/settings/email/");
    }

    public function general() {
        $data = array(
            'page_title' => 'Generelle indstillinger'
        );

        return view('admin.settings.general')->with($data);
    }

    public function generalStore(Request $request) {
        Configuration::insertConfiguration($request, 'GENERAL');

        return redirect("admin/settings/general/");
    }


    public function shipping() {

        $data = array(
            'page_title' => 'Forsendelse Indstillinger',
            'countries' => Country::all(),
            'shipping_companies' => ShippingCompanies::all(),
            'selected_free_shipping_countries' => explode(',', shop_config('free_shipping_countries', 'SHIPPING')),
            'selected_international_delivery_countries' => explode(',', shop_config('international_delivery_countries', 'SHIPPING'))
        );

        return view('admin.settings.shipping')->with($data);
    }

    public function shippingStore(Request $request) {

        $except = array(
            'active',
            'free_shipping_countries_dropdown',
            'international_delivery_countries_dropdown'
        );
        Configuration::insertConfiguration($request, 'SHIPPING', $except);

        return redirect("admin/settings/shipping");
    }

    public function shippingUpdateActiveCompanies(Request $request) {
        foreach($request->get('active') as $id=>$status) {
            ShippingCompanies::setActiveState($id, $status);
        }
    }

    /**
     * Create new shipping company modal
     * @return \Illuminate\View\View
     */
    public function shippingCompanyModal() {
        return view('admin.settings.shipping.company_create_modal', []);
    }

    /**
     * Save the new shipping company and prices to the database
     *
     * @param Request $request
     * @return string
     */
    public function shippingCompanyCreate(Request $request) {

        $company = new ShippingCompanies();
        $company->name = $request->get('shipping_company_name');
        $company->save();

        //shipping_company_name
        ShippingCompanyPrices::createPrices($request->get('prices'), $company->id);

        return 'true';
    }

    /**
     * Update shipping company modal
     * @param $id
     * @return \Illuminate\View\View
     */
    public function shippingCompanyModalUpdate($id) {
        $data = array(
            'company' => ShippingCompanies::find($id)
        );

        return view('admin.settings.shipping.company_create_modal', $data);
    }

    /**
     * Save the update shipping company and prices to the database
     * @param Request $request
     * @return string
     */
    public function shippingCompanyUpdate(Request $request, $id) {
        $company = ShippingCompanies::find($id);
        $company->name = $request->get('shipping_company_name');
        $company->save();

        // Delete all prices so we can create them again
        ShippingCompanyPrices::where('shipping_companies_id', $id)->delete();

        //shipping_company_name
        ShippingCompanyPrices::createPrices($request->get('prices'), $company->id);

        return 'true';
    }

    public function shippingPriceDelete($id) {
        ShippingCompanyPrices::find($id)->delete();
        return "true";
    }

    public function product() {

        $data = array(
            'page_title' => 'Produkt Indstillinger'
        );

        return view('admin.settings.products')->with($data);
    }

    public function productStore(Request $request) {

        Configuration::insertConfiguration($request, 'PRODUCT');

        return redirect("admin/settings/product");
    }

    public function checkout() {

        $data = array(
            'page_title' => 'Indkøbskurv Indstillinger'
        );

        return view('admin.settings.checkout')->with($data);
    }

    public function checkoutStore(Request $request) {

        Configuration::insertConfiguration($request, 'CHECKOUT');

        return redirect("admin/settings/checkout");
    }
}
