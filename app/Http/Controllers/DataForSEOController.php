<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;  //e2004a13baa6dedc
use App\Models\GetSeoRank;
use DB;


class DataForSEOController extends Controller
{
    public function dataforseo(Request $request){
        return view('dataforseo');
    }
    public function getRank(Request $request)
    {
        // Set your API credentials      
       $api_key = 'waqas.ger@gmail.com';    
        $api_secret = 'e2004a13baa6dedc';

        // Set the API endpoint URL
        $api_url = 'https://api.dataforseo.com/';

        // Set your keyword, country, and device
        $keyword =  $request->input('search_keyword');
        $country_code ='2840';// $request->input('country');
        $device =  $request->input('device');
        $repetitions =  $request->input('repetitions');
 
        // Create an array with your API request parameters
        $request_data = [
            [ 
                "language_code" => "en",
                "location_code" => $country_code,
                "keyword" => mb_convert_encoding($keyword, "UTF-8"),
                "calculate_rectangles" => true

            ],
        ];

        // Initialize the Guzzle client
        $client = new Client();

        // Send a POST request to the API
        try {
            $response = $client->post($api_url . 'v3/serp/google/organic/live/advanced', [
                'auth' => [$api_key, $api_secret],
                'json' => $request_data,
            ]); 
            // Parse the JSON response
            $data = json_decode($response->getBody(), true);
            
            // Process the data
            // You can now access the rank information in $data['data'][0]['items']

            // Example: Return the rank data for the first result
            $ary_data = $data['tasks'][0]['result'][0]['items'];

             for($k=1;$k<=$repetitions;$k++ ){ 
                for($i=0;$i<=sizeof($ary_data);$i++){
                    if (isset($ary_data[$i]['url'])){ 
                        $rank_absolute = $ary_data[$i]['rank_absolute'];
                        $url = $ary_data[$i]['url']; 
                        $key_word = mb_convert_encoding($keyword, "UTF-8");
                        

                        $seoRank = GetSeoRank::create([
                                'url' => $url,
                                'ranked' => $rank_absolute,
                                'country_code' => $country_code,
                                'device' => $device,
                                'search_position' => $k,
                                'search_keyword' => $key_word,
                            ]);
                        $seoRank->save(); 
                 }
                }
            } 
        } catch (\Exception $e) {
            // Handle API request errors
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
        

         $data =   GetSeoRank::select('url' , 'search_position',DB::raw('MAX(ranked) as ranked'))
    ->where('search_keyword','=', $request->input('search_keyword'))
    ->where('search_position', '<=', $repetitions)
    ->groupBy('search_position', 'url')
    ->orderBy('ranked', 'ASC')
    ->get();
     $ary = [];
     $ary_str='';
     $ary_url='';



     $chart_data = $data->map(function ($item) {
        return [
            'x' => $item->ranked,
            'y' => $item->search_position,
        ];
    });
     $url_data = $data->map(function ($item) {
        return [
               $item->url,             
        ];
    });


    foreach($data as $rs){ 
        $a = $rs['ranked']; $b=$rs['search_position'];
        $ary_str .= '{x:'.$a.', y:'.$b.'},';
        $ary_url .= $rs['url'].',';


    }
   array_push($ary, $ary_str);
   
        return view('chart_view', compact( 'data','ary' ,'chart_data','url_data','repetitions'));
    }
    
}
