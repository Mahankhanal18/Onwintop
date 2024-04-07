<?php
    include "init.php";
    if(isset($_POST['type']) && isset($_POST['path'])){
        $path="../".$_POST['path'];
        $report_file=file_get_contents($path);
        $report=json_decode($report_file,true);


        if($_POST['type']=='view'){
            $views=$report['views'];
            array_push($views,$_POST['ip']);
            $report['views']=$views;
        }

        //liking
        if($_POST['type']=='like'){
            $likes=$report['likes'];
            array_push($likes,$_POST['email']);
            $report['likes']=$likes;
        }

        if($_POST['type']=='remlike'){
            $likes=$report['likes'];
            if (($key = array_search($_POST['email'], $likes)) !== false) {
                unset($likes[$key]);
            }
            $report['likes']=$likes;
        }

        //disliking
        if($_POST['type']=='dislike'){
            $dislikes=$report['dislikes'];
            array_push($dislikes,$_POST['email']);
            $report['dislikes']=$dislikes;
        }
        if($_POST['type']=='remdislike'){
            $dislikes=$report['dislikes'];
            if (($key = array_search($_POST['email'], $dislikes)) !== false) {
                unset($dislikes[$key]);
            }
            $report['dislikes']=$dislikes;
        }

        $report=json_encode($report);

        if(file_put_contents($path,$report)){
            echo "Successful";
        }

    }

?>