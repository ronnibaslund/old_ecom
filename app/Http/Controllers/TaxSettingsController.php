<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\TaxClass;
use App\TaxRates;
use App\Zones;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TaxSettingsController extends Controller
{
    private $configurationGroup = 'TAX';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'page_title' => 'Moms',
            'rates' => TaxRates::all()
        );

        return view('admin.settings.tax.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array(
            'page_title' => 'Ny moms stas',
            'zones' => Zones::all(),
            'tax_classes' => TaxClass::all()
        );

        return view('admin.settings.tax.rate_create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $taxrate = new TaxRates();
        $taxrate->fill($request->all());
        $taxrate->save();

        return redirect("admin/settings/tax/");
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
        $data = array(
            'page_title' => 'Redigere moms sats',
            'zones' => Zones::all(),
            'tax_classes' => TaxClass::all(),
            'rate' => TaxRates::find($id)
        );

        return view('admin.settings.tax.rate_create', $data);
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
        $taxrate = TaxRates::findOrNew($id);
        $taxrate->fill($request->all());
        $taxrate->save();

        return redirect("admin/settings/tax/");
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

    public function configurationUpdate(Request $request) {

        Configuration::insertConfiguration($request, $this->configurationGroup);

        return redirect("admin/settings/tax");
    }
}
