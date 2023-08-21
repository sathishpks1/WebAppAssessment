<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CountryController extends Controller
{

    public function fetchCountries()
    {
        try{

            $response = Http::get('https://restcountries.com/v3.1/all');

            if ($response->successful()) {
                $countries = $response->json();
                $countryContacts = [];

                foreach($countries as $indx => $arr){

                    ['name' => ['common' => $country_name], 'idd' => $idd ] = $arr;

                    if(isset($idd['root'])){

                        $root = $idd['root']??'';
                        $suffixes = $idd['suffixes']?? [];
                        [$suffix] = $suffixes;

                        $countryContacts[] = [
                            'countryName' => $country_name,
                            'callingCode' => $root.$suffix,
                        ];
                    }

                }
                sort($countryContacts);
                return $countryContacts;
            } else {
                return [];
            }

        }catch(\Exception $ex){
            return [];
        }        
    }


    

    
    
}
