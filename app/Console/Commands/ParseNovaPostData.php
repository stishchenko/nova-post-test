<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Warehouse;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class ParseNovaPostData extends Command
{
    protected $signature = 'parse:novapost {--limit=20}';

    protected $description = 'The command to parse data from novapost api';


    /**
     * @throws GuzzleException
     */
    public function handle()
    {
        $limit = $this->option('limit');
        $url = 'https://api.novaposhta.ua/v2.0/json/';

        $client = new Client(['verify' => false]);
        $response = $client->post($url, [
            'json' => [
                "apiKey" => "",
                "modelName" => "Address",
                "calledMethod" => "getCities",
                "methodProperties" => [
                    "Limit" => $limit
                ]
            ]
        ]);

        $body = $response->getBody();
        $cityData = json_decode($body, true)['data'];

        $cities = array_filter($cityData, function ($city) {
            $excludedCities = ['Абрикосівка', 'Агаймани', 'Агрономічне', 'Адампіль'];
            foreach ($excludedCities as $ex) {
                if (str_starts_with($city['Description'], $ex)) {
                    return false;
                }
            }
            return true;
        });

        foreach ($cities as $item) {
            $city = new City();
            $city->ref = $item['Ref'];
            $city->description = $item['Description'];
            $city->description_ru = $item['DescriptionRu'];
            $city->settlement_type_description = $item['SettlementTypeDescription'];
            $city->settlement_type_description_ru = $item['SettlementTypeDescriptionRu'];
            $city->area_description = $item['AreaDescription'];
            $city->area_description_ru = $item['AreaDescriptionRu'];
            $city->save();
        }

        $this->info('Data about cities was parsed and saved successfully');

        foreach ($cities as $item) {

            $response = $client->post($url, [
                'json' => [
                    "apiKey" => "",
                    "modelName" => "Address",
                    "calledMethod" => "getWarehouses",
                    "methodProperties" => [
                        "CityRef" => $item['Ref']
                    ]
                ]
            ]);

            $body = $response->getBody();
            $warehouseData = json_decode($body, true)['data'];

            foreach ($warehouseData as $item) {
                $warehouse = new Warehouse();
                $warehouse->ref = $item['Ref'];
                $warehouse->description = $item['Description'];
                $warehouse->description_ru = $item['DescriptionRu'];
                $warehouse->city_ref = $item['CityRef'];
                $warehouse->save();
            }
        }

        $this->info('Data about warehouses was parsed and saved successfully');
    }
}
