<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseRequest;
use App\Models\City;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class NovaPostController extends Controller
{

    public function index($locale, Request $request)
    {
        App::setLocale($locale);
        $cities = City::all();
        $warehouses = [];

        if ($request->city) {
            $warehouses = Warehouse::where('city_ref', $request->city)->get();
        } elseif (session('selected_city')) {
            $warehouses = Warehouse::where('city_ref', session('selected_city')->ref)->get();
        }

        return view('index', [
            'cities' => $cities,
            'warehouses' => $warehouses,
            'locale' => app()->getLocale(),
            'selected_city' => session('selected_city'),
            'selected_warehouse' => session('selected_warehouse'),
            'total_cost' => session('total_cost')
        ]);
    }

    public function calculate($locale, WarehouseRequest $request)
    {
        App::setLocale($locale);
        $warehouse = Warehouse::where('ref', $request->warehouse)->first();
        $city = City::where('ref', $warehouse->city_ref)->first();
        $price = (int)$request->price;

        $total_cost = 0;
        if ($price < 1000) {
            $total_cost = 50 + ($price * 0.5);
        } elseif ($price < 3000) {
            $total_cost = 50 + ($price * 0.3);
        }

        return redirect()->route('novapost.index', ['locale' => app()->getLocale()])
            ->with([
                'selected_city' => $city,
                'selected_warehouse' => $warehouse,
                'total_cost' => $total_cost
            ]);
    }
}
