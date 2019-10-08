<?php

namespace App\Http\Controllers;

use App\BasicConfig;
use Illuminate\Http\Request;

class BasicConfigController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {

        $configParams = BasicConfig::first();
        return view('administrator.config.index', ['configParams' => $configParams]);
    }

    public function setTaxRate(Request $request) {

        $configParams = BasicConfig::first();
        $configParams->tax_rate = $request->input('tax_rate');
        $configParams->save();
        return redirect()->back();
    }

    public function setGlobalDiscount(Request $request) {

        $configParams = BasicConfig::first();
        $configParams->global_discount = $request->input('global_discount');
        $configParams->global_discount_type = $request->input('global_discount_type');
        $configParams->save();
        return redirect()->back();
    }

    public function setTaxFlag(Request $request) {

        $configParams = BasicConfig::first();
        if ($request->input('tax_flag') === null) {
            $configParams->tax_flag = 0;
        } else {
            $configParams->tax_flag = $request->input('tax_flag');
        }

        $configParams->save();
        return redirect()->back();
    }

}
