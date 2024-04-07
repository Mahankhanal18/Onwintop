<?php
include "init.php";
$data = R::findOne("branding","WHERE community_id=?",[$_SESSION['community_id']]);
$info=R::findOne("communities","WHERE link=?",[$_SESSION['community_id']]);

$color='{"post_background": "#b5b5b5","post_text": "#f5f5f5","background_color": "#ffffff","header_text_color": "#000000","body_text_color": "#454545"}';
$colors=json_decode($color, true);
$custom_codes=array();
if(!empty($data)){
    $colors = json_decode($data['colors'], true);
}

$cred=json_decode($_SESSION['community_credentials'],true);
$login=false;
if(!empty($cred)){
    $login=true;
    $email=$cred['email'];
    $c=R::findOne("members","email=?",[$email]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challange Focus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<meta name="theme-color" content="<?php echo $colors['post_background']; ?>">
    <style>
        :root {
            --banner-text: #ffffff;
            --primary-color: <?php echo $colors['post_background']; ?>;
            --secondary-color: <?php echo $colors['post_text']; ?>;
            --primary-color-transparent: <?php echo $colors['post_background']; ?>73;
            /**Primary color 73% */
            --topnav-color: <?php echo $colors['topnav_text']; ?>;
            --background-color: <?php echo $colors['background_color']; ?>;
            --topbar-color: <?php echo $colors['post_text']; ?>;
            --footer-color: <?php echo $colors['post_text']; ?>;
            --title-text-color: <?php echo $colors['header_text_color']; ?>;
            --body-text-color: <?php echo $colors['body_text_color']; ?>;
            /**Primary color 90% */
            /*--topbar-color:#f5f5f5;*/
            /*--primary-color: #088dcd;*/
        }
        .nav-tabs {
            background-color: #ffffff !important;
        }
        .nav-link {
            color: #a1a1a1 !important;
        }
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            border-color: #ffffff !important;
            margin-bottom:0px !important;
            border-bottom: 4px solid var(--primary-color) !important;
        }
        .nav-tabs .inner.active {
            border-color: #efefef !important;
            border-radius: 5px;
            background-color: #efefef;
            border-top: 4px solid var(--primary-color) !important;
            border-right: 1px solid #dfe2e6 !important;
            border-left: 1px solid #dfe2e6 !important;
        }
        .card {
            border-radius: 0px !important;
        }
        .card-img-top {
            border-radius: 0px !important;
        }
        .challange{
            color:gray;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            border-bottom: none !important;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link {
            border-bottom: none !important;
            border-radius:0px !important;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            background-color: #fff0 !important;
            color:var(--primary-color) !important;
        }
        
.container_ {
  list-style: none;
  column-gap: 0;
  padding: 0;
  column-count: 3;
}
.card_ {
  width: 100%;
  height: auto;
  padding:5px;
  margin: 0;
  box-sizing: border-box;
  break-inside: avoid;
}


#myTabContent2 .nav-link.active{
    background-color:#ffffff !important;
    border:none !important;
    color:#000000 !important;
    font-size:13px;
}
#myTabContent2 .nav-link{
    border:none !important;
    font-size:13px;
}
a:hover{color:#000000 !important;}
.chosen-container{
    display:none;
}
    </style>
</head>
<div class='data' style='display:none'>
<?php
    //get saved page
    $data=R::findOne("challengefocushomepage","community_link=?",[$_SESSION['community_id']]);
    echo $data['code'];
?>
</div>

<body style='background-color:#f3f3f3;'>
    <nav class="navbar navbar-light px-2" style="background-color:var(--secondary-color) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 px-5">
                    <h2 class='text-white'><img src='<?php echo $colors['logo'];?>' style='max-width: 180px !important;' alt='Logo'><b id='header'></b></h2>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12 px-5">
                <div class='row' style='background-color:#ffffff;'>
                    <div class='col-md-8' style='padding-right:0px;padding-left:0px;'>
                        <ul class="nav nav-tabs pt-2" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" style='border-bottom:4px solid var(--primary-color) !important;' id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Challanges</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" onclick="window.location='<?php URL('/explore');?>';" type="button" aria-selected="false">Explore</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" onclick="window.location='<?php URL('/discussions');?>';" type="button" aria-selected="false">Discussion</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" onclick="window.location='<?php URL('/rewards');?>';" type="button" aria-selected="false">Rewards</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" onclick="window.location='<?php URL('/channels');?>';" type="button" aria-selected="false">Contents</button>
                            </li>
                        </ul>
                    </div>
                    <div class='col-md-4' style='border-bottom:1px solid #dee2e6;display:flex;align-items:center;justify-content:right;'>
                        <?php
                        if($login){
                            echo "
                            <b style='color:#929090;'><i class='fa fa-coins'></i>&nbsp; ".$c['coins']." &nbsp;&nbsp;</b>
                            <a href='".URL_Make('/profile')."'><img src='https://ui-avatars.com/api/?name=".$c['first_name']." ".$c['last_name']."&background=random' style='height:35px;width:35px;border-radius:50%;'/></a>
                            ";
                        }
                        ?>
                        
                    </div>
                </div>
                <div class='row'>
                    <div class='col-md-9'>
                        <div class="tab-content" id="myTabContent" style='background-color:#f3f3f3;border-right:1px solid #dee2e6;'>
                            <div class="tab-pane fade show active p-4" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row" style='border-bottom:1px solid #dee2e6;'>
                                    <div class="col-md-8">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist" style='background-color:background-color:var(--secondary-color) !important;border:none !important;'>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link inner active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button" role="tab" aria-controls="home" aria-selected="true">Available</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link inner" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab-empty" type="button" role="tab" aria-controls="profile" aria-selected="false">Waiting</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link inner" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab-empty" type="button" role="tab" aria-controls="contact" aria-selected="false">Completed</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4 p-1" style="justify-content:right;display:flex;">
                                        <select id='filter' style='padding:6px;border:1px solid #dee2e6;background-color:#f3f3f3;color:#7d7b7b;width:180px;font-size:14px;display:block !important;'>
                                            <option value=''>Filter by type</option>
                                            <?php
                                                $categories=R::findAll('challengecategories','community_id=?',[$community_id]);
                                                foreach($categories as $cat){
                                                    $selected='';
                                                    if($cat['name']==$type){
                                                        $selected='selected';
                                                    }
                                                    echo "<option value='".$cat['name']."' ".$selected.">".$cat['name']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="tab-content" id="myTabContent" style='padding-top:10px;'>
                                            <div class="tab-pane fade show active" id="tab1" role="tabpanel" aria-labelledby="home-tab">
                                                <ul class="container_">
                                                    <?php
                                                        $challanges=R::findAll("challenges","ORDER BY id DESC");
                                                        if(isset($type) && strlen($type)!=0){
                                                            $challanges=R::findAll("challenges","type=? ORDER BY id DESC",[$type]);
                                                        }
                                                        foreach($challanges as $challange){
                                                            echo '
                                                            <li class="card_">
                                                                <a href="'.URL_Make("/challenge/" . $challange['id']).'" class="challange" style="text-decoration:none">
                                                                    <div class="card" style="width: 100%;">
                                                                        <div class="card-body" style="background-color:#fefefe;">
                                                                            <small style="color:gray" style="font-size:9px;"><i class="fa fa-fire text-danger" aria-hidden="true"></i> '.$challange['type'].'</small></br>
                                                                            <b style="color:#000000;margin-top:5px">'.$challange['headline'].'</b>
                                                                            
                                                                            <img src="'.$challange['thumbnail'].'" style="margin-top:5px;width:100%;height:auto;object-fit:cover;object-position:center;margin-top:5px;" class="card-img-top" alt="">
                                                                            <small class="card-text p-1" style="margin-top:5px;font-size:14px;color:#898989;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 3;line-clamp: 3;-webkit-box-orient: vertical;">'.$challange['description'].'</small>
                                                                            <div class="row px-2 mt-3">
                                                                                <div class="col-md-6">
                                                                                    <small><i class="fa fa-users"></i> 0</small>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <small style="float:right;"><i class="fa fa-coins"></i> '.$challange['reward'].'</small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                            ';
                                                        }
                                                        
                                                    ?>
                                                    
                                                </ul>
                                                
                                            </div>
                                            <div class="tab-pane fade" id="tab-empty" role="tabpanel" aria-labelledby="profile-tab">
                                                <div class='contianer p-5'>
                                                    <center><h5 style='color:gray'>No Challanges Available</h5></center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class='col-md-3 pt-4'>
                        <h5 style="font-weight:400">Leaderboard</h5>
                        <div class="tab-content mt-4" id="myTabContent2">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-12" style='padding-right:0px'>
                                        <ul class="nav nav-tabs" id="ledtab" role="tablist" style='background-color:background-color:var(--secondary-color) !important;'>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link inner led-switch active" id="led-tab" data-bs-toggle="tab" data-bs-target="#led" type="button" role="tab" aria-controls="home" aria-selected="true">My Leaderboard</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link inner led-switch" id="top-tab" data-bs-toggle="tab" data-bs-target="#top" type="button" role="tab" aria-controls="profile" aria-selected="false">Top 10</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="led" role="tabpanel" aria-labelledby="led-tab">
                                        <ul class="list-group mt-1">
                                          <?php
                                            $chams=R::findAll("members","community_id=? AND coins!=? ORDER BY coins DESC",[$community_id,'0']);
                                            
                                            foreach($chams as $cham){
                                                if($cham['credit']!=0){
                                                echo "
                                                <li class='list-group-item' style='background-color:#ffffff00 !important;border-radius:0px;border-left:none;border-right:none;border-top:none;margin-top:0px;padding:7px;'>
                                                    <div class='row'>
                                                        <div class='col-md-2' style='justify-content:center;align-items:center;'>
                                                            <img src='https://ui-avatars.com/api/?name=".$cham['name']."&background=random' style='height:43px;width:43px;border-radius:50%;'/>
                                                        </div>
                                                        <div class='col-md-6' style='align-items:center;display:flex;color:#646464;'>
                                                            <span style='padding-left:5px;font-size:14px'>".$cham['name']."</span>
                                                        </div>
                                                        <div class='col-md-4 pl-1' style='align-items:center;display:flex;justify-content:right;color:#929090;'>
                                                            <small style='float:right'><i class='fa fa-coins' aria-hidden='true'></i>&nbsp;&nbsp;".$cham['credit']."</small>
                                                        </div>
                                                    </div>
                                                </li>
                                                ";
                                                }
                                            }
                                          ?>
                                        </ul>
                                        
                                    </div>
                                    <div class="tab-pane fade show" id="top" role="tabpanel" aria-labelledby="top-tab">
                                        <ul class="list-group mt-1">
                                          <?php
                                            $chams=R::findAll("challengesubmissions");
                                            foreach($chams as $cham){
                                                if($cham['credit']!=0){
                                                echo "
                                                <li class='list-group-item' style='background-color:#ffffff00 !important;border-radius:0px;border-left:none;border-right:none;border-top:none;margin-top:0px;padding:7px;'>
                                                    <div class='row'>
                                                        <div class='col-md-2' style='justify-content:center;align-items:center;'>
                                                            <img src='https://ui-avatars.com/api/?name=".$cham['name']."&background=random' style='height:43px;width:43px;border-radius:50%;'/>
                                                        </div>
                                                        <div class='col-md-6' style='align-items:center;display:flex;color:#646464;'>
                                                            <span style='padding-left:5px;font-size:14px'>".$cham['name']."</span>
                                                        </div>
                                                        <div class='col-md-4 pl-1' style='align-items:center;display:flex;justify-content:right;color:#929090;'>
                                                            <small style='float:right'><i class='fa fa-coins' aria-hidden='true'></i>&nbsp;&nbsp;".$cham['credit']."</small>
                                                        </div>
                                                    </div>
                                                </li>
                                                ";
                                                }
                                            }
                                          ?>
                                        </ul>
                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                        
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        header=$('h4').html();
        //alert(header);
        $('#header').html(header);
        $('#filter').on('change',function(){
            filter=$('#filter').val();
            
            url='<?php URL('/challange-focus');?>'+'/'+filter;
            
            window.location=url;
        })
    });
</script>
</html>