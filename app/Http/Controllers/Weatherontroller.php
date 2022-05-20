<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weather;
use Illuminate\Support\Facades\Http;
use View;
class Weatherontroller extends Controller
{

   public function getData()
   {
   // Approach 1
   // take all cities in an array
     $cities  = [
        ["Berlin Mitte",52.520008,13.404954],
        ["Berlin Friedrichshain",52.515816,13.454293]
      ];

     foreach ($cities as $key => $value) {
       $lat = $cities[$key][1];
       $long  = $cities[$key][2];
     $response_mitte = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                      'appid' => 'bf65d8b174418831a16055a19f50144f',
                      'lat' => $lat,
                      'lon'=>  $long

                 ]);
                  $weatherData_Mitte= json_decode($response_mitte->body());
                  $weather = new Weather;
                  $weather->Name = $weatherData_Mitte->name;
                  $weather->Latitude = $weatherData_Mitte->coord->lat;
                  $weather->Longitude = $weatherData_Mitte->coord->lon;
                  $weather->save();
     }
   // Getting Mitte Weather Data
/*    $response_mitte = Http::get('https://api.openweathermap.org/data/2.5/weather', [
              'appid' => 'bf65d8b174418831a16055a19f50144f',
              'lat' => '52.520008',
              'lon'=>  '13.404954'

          ]);
          $weatherData_Mitte= json_decode($response_mitte->body());
          $weather = new Weather;
          $weather->Name = $weatherData_Mitte->name;
          $weather->Latitude = $weatherData_Mitte->coord->lat;
          $weather->Longitude = $weatherData_Mitte->coord->lon;
          $weather->save();
 // Getting Friedrichshain Weather Data
    $response_friedrichshain= Http::get('https://api.openweathermap.org/data/2.5/weather', [
              'appid' => 'bf65d8b174418831a16055a19f50144f',
              'lat' => '52.515816',
              'lon'=>  '13.454293'
               ]);
          $weatherData_fd= json_decode($response_friedrichshain->body());
            $weather = new Weather;
            $weather->Name = $weatherData_fd->name;
            $weather->Latitude = $weatherData_fd->coord->lat;
            $weather->Longitude = $weatherData_fd->coord->lon;
            $weather->save();
            */
    // getting data to display
    $GetData = Weather::get()->toArray();
    return View::make("welcome", compact('GetData'));

   }

}
