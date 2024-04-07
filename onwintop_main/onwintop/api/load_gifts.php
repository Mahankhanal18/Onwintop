<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "init.php";


$curl = curl_init();

$countries=array('US','GB','AT','CA','BE','DE','FI','FR','NL','LU','GR','IT','ES','PT','SI');
$gifts=array();
foreach($countries as $c){
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wegift.io/v2/product?country_code='.$c,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'X-API-KEY: wg5vQwfG.OVf&h$bl*hY7Z0yL!lNKBe_xJF=qPeiL',
            'Content-Type: application/json',
            'accept: application/json'
        ),
    ));
    $response = curl_exec($curl);
    $result=json_decode($response,true);   
    foreach($result as $r){
        if(
            str_contains($r['name'],'Apple') ||
            str_contains($r['name'],'Airbnb') ||
            str_contains($r['name'],'Amazon') ||
            str_contains($r['name'],'BitCard') ||
            str_contains($r['name'],'Coinbase') ||
            str_contains($r['name'],'eBay') ||
            str_contains($r['name'],'Google Play') ||
            str_contains($r['name'],'Hotels.com') ||
            str_contains($r['name'],'H&M') ||
            str_contains($r['name'],'Hulu') ||
            str_contains($r['name'],'Playstation Store') ||
            str_contains($r['name'],'Roblox') ||
            str_contains($r['name'],'Spotify') ||
            str_contains($r['name'],'Starbucks') ||
            str_contains($r['name'],'Subway') ||
            str_contains($r['name'],'Twitch') ||
            str_contains($r['name'],'Uber') ||
            str_contains($r['name'],'Xbox')
        ){
            if(!in_array($r,$gifts)){
                $r['country']=$c;
                array_push($gifts,$r);
            }
        }
        
    }
}


echo json_encode($gifts);
curl_close($curl);



?>