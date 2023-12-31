<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class NovaPostController extends Controller
{

    public function index(Request $request)
    {
        $cities = City::all();
        $warehouses = [];
        $selectedCity = null;
        $selectedWarehouse = null;
        $total_cost = null;

        if ($request->city) {
            $selectedCity = City::where('ref', $request->city)->first();
            $warehouses = Warehouse::where('city_ref', $selectedCity->ref)->get();
        }

        if ($request->warehouse) {
            $selectedWarehouse = Warehouse::where('ref', $request->warehouse)->first();;
        }

        if ($request->total_cost) {
            $total_cost = $request->total_cost;
        }

        return view('index', [
            'cities' => $cities,
            'warehouses' => $warehouses,
            'selectedCity' => $selectedCity,
            'selectedWarehouse' => $selectedWarehouse,
            'total_cost' => $total_cost
        ]);
    }

    public function calculate(Request $request)
    {
        $city = City::where('ref', $request->city)->first();
        $warehouse = Warehouse::where('ref', $request->warehouse)->first();
        $price = (int)$request->price;

        // Виконайте обрахунки та отримайте значення cost
        $total_cost = 0;
        if ($price < 1000) {
            $total_cost = 50 + ($price * 0.5);
        } elseif ($price < 3000) {
            $total_cost = 50 + ($price * 0.3);
        }

        return redirect()->route('novapost.index', [
            'city' => $city,
            'warehouse' => $warehouse,
            'price' => $price,
            'total_cost' => $total_cost
        ]);
    }

    /*public function index()
    {
        $cities = City::all();
        $warehouses = Warehouse::all();

        return view('index', ['cities' => $cities, 'warehouses' => $warehouses]);
    }

    public function calculate(Request $request)
    {
        $data = $request->validate(
            [
                'city' => 'required',
                'warehouse' => 'required',
                'price' => 'required|integer'
            ]
        );

        $price = (int)$data['price'];
        $total_cost = 0;
        if ($price < 1000) {
            $total_cost = 50 + ($price * 0.5);
        } elseif ($price < 3000) {
            $total_cost = 50 + ($price * 0.3);
        }

        $cities = City::all();
        $warehouses = Warehouse::all();
        $my_city = City::where('ref', $data['city'])->first();
        $my_warehouse = Warehouse::where('ref', $data['warehouse'])->first();

        return view('index', ['cities' => $cities, 'warehouses' => $warehouses])
            ->with(
                [
                    'old_city_ref' => $data['city'],
                    'old_wh_ref' => $data['warehouse'],
                    'old_price' => $price,
                    'my_city' => $my_city,
                    'my_warehouse' => $my_warehouse,
                    'total_cost' => $total_cost
                ]
            );
    }*/
}
