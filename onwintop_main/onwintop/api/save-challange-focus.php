<?php
/**
 *  Save Homepage
 */
 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "init.php";
$db = new Database();
if(isset($_POST['community_link'])){
    
    $homepage=R::findOne("challengefocushomepage","WHERE community_link=?",[$_POST['community_link']]);
    $versions=json_decode($homepage['versions'],true);
    
    //set data
    $homepage->version3_code=$homepage['version2_code'];
    $homepage->version3_data=$homepage['version2_data'];
    
    $homepage->version2_code=$homepage['version1_code'];
    $homepage->version2_data=$homepage['version1_data'];
    
    $homepage->version1_code=$homepage['code'];
    $homepage->version1_data=$homepage['data'];
    
    $homepage->code=$_POST['code'];
    $homepage->data=$_POST['data'];
    
    $obj=array(
        "name"=>date('hi-d-m-Y'),
        "version"=>"version1"
    );
    
    if(count($versions)<3){
        $versions=array();
        array_push($versions,$obj);
        array_push($versions,$obj);
        array_push($versions,$obj);
    }else{
        $versions[2]=array("name"=>$versions[1]['name'],"version"=>"version3");
        $versions[1]=array("name"=>$versions[0]['name'],"version"=>"version2");;
        $versions[0]=$obj;        
    }

    $homepage->versions=json_encode($versions);
    //update page type
    $type=R::findOne("homepage_type","id=?",[1]);
    $type->type='challange-based';
    if(R::store($type) && R::store($homepage)){
        //echo $_POST['code'];
        echo "Homepage saved";
    }else{
        echo "Error Occured";
    }
}