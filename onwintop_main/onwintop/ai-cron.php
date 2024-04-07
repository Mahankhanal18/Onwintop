<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Josantonius\Cookie\Cookie;

$cookie = new Cookie();

include "init.php";
//get all pending jobs
$jobs=R::findAll("aiwritters","status=?",['Pending']);
foreach($jobs as $job){
    $dates=json_decode($job['dates'],true);
    $today=date('Y-m-d');
    if(in_array($today,$dates)){
        //Pop out current date from date list
        if (($key = array_search($today, $dates)) !== false) {
            unset($dates[$key]);
        }
        //Update status and count
        if(count($dates)==0){
            $job->status='Completed';
            $job->dates=json_encode($dates);
        }
        $job->last_update=date('Y-m-d');
        $total_articles=intval($job->articles_completed);
        $job->articles_completed=$total_articles+1;
        echo "Generating contents";
        if(generateArticles($job['name'],$job['url'],$job['type'],$job['community_id'])){
            R::store($job);
        }
    }else{
        echo "out of date ".$today;
        print_r($dates);
    }
}
//Generate Articles
function generateArticles($name,$url,$type,$community_id){
    $query='';
    $title='';
    if($type=='List Benefits'){
        $query='I want you to be Expert Researcher whos job is to click a link and analyze the content. Please read and analyze the content from the following url ->
        "'.$url.'". Use the info from the page above to Write a creative and SEO-optimized blog post describing the benefits of products mentioned in the page above.';
        $title='I want you to be Expert Researcher whos job is to click a link and analyze the content. Please read and analyze the content from the following url ->
        "'.$url.'". Use the info from the page above to Write a creative and SEO-optimized title of 8 words describing the benefits of products mentioned in the page above.';
    }
    if($type=='P-A-S'){
        $query='I want you to be Expert Researcher whos job is to click a link and analyze the content. Please read and analyze the content from the following url ->
        "'.$url.'". Use the info from the page above to Write a creative and SEO-optimized blog post Using the P-A-S (Pain, Agitate, Solution) marketing forumla.';
        $title='I want you to be Expert Researcher whos job is to click a link and analyze the content. Please read and analyze the content from the following url ->
        "'.$url.'". Use the info from the page above to Write a creative and SEO-optimized title of 8 words Using the P-A-S (Pain, Agitate, Solution) marketing forumla.';
    }
    if($type=='Strategy'){
        $query='I want you to be Expert Researcher whos job is to click a link and analyze the content. Please read and analyze the content from the following url ->
        "'.$url.'". Use the info from the page above to Write an SEO-optimized explainer on why businesses need to incorporate products mentioned in the page above into their strategies today.';
        $title='I want you to be Expert Researcher whos job is to click a link and analyze the content. Please read and analyze the content from the following url ->
        "'.$url.'". Use the info from the page above to Write an SEO-optimized title in around 8 words on why businesses need to incorporate products mentioned in the page above into their strategies today.';
    }
    if($type=='Business Impact'){
        $query='I want you to be Expert Researcher whos job is to click a link and analyze the content. Please read and analyze the content from the following url ->
        "'.$url.'". Use the info from the page above to Write an SEO-friendly article exploring the potential impacts of products mentioned in the page above on traditional business models.';
        $title='I want you to be Expert Researcher whos job is to click a link and analyze the content. Please read and analyze the content from the following url ->
        "'.$url.'". Use the info from the page above to Write an SEO-friendly title in 8 words exploring the potential impacts of products mentioned in the page above on traditional business models.';
    }
    if($type=='Lead Generation'){
        $query='I want you to be Expert Researcher whos job is to click a link and analyze the content. Please read and analyze the content from the following url ->
        "'.$url.'". Use the info from the page above to Write a lead-generation SEO-friendly article for products mentioned in the page above';
        $title='I want you to be Expert Researcher whos job is to click a link and analyze the content. Please read and analyze the content from the following url ->
        "'.$url.'". Use the info from the page above to Write a lead-generation SEO-friendly title of 8 words for products mentioned in the page above';
    }
    
    $curl = curl_init();
    $fields = array(
        'query' => $query,
    );
    $fields2 = array(
        'title' => $title,
    );

    $fields = json_encode($fields);
    $fields2 = json_encode($fields2);
  
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://organic-service-371417.de.r.appspot.com/generate-blog',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $fields,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response,true);
    
    
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://organic-service-371417.de.r.appspot.com/generate-title',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $fields2,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response2 = curl_exec($curl);
    curl_close($curl);
    $response2 = json_decode($response2,true);
    
    
    echo json_encode($response);
    echo json_encode($response2);
    
    $data=R::dispense("blogs");
    $data->community_id=$community_id;
    $data->cover=$response['cover'];
    //$data->cover='test cover';
    $data->post=$response['article'];
    $data->name=$response2['title'];
    $data->status='Pending';

    $data->date=date('Y-m-d');
    $data->time=date('h:ia');
    if(R::store($data)){
        return true;
    }else{
        return false;
    }
}

?>