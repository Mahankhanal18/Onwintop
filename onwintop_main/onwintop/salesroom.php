<?php

include "init.php";
$paths=URL_Parts();

$path = $id;
$s = "SELECT * FROM `salesrooms` WHERE `link`='" . $path . "' ";
$sol = $db->RetriveSingle($s);
$thumbnail = $sol['thumbnail'];
$contents=json_decode($sol['contents'],true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php echo $sol['name']; ?> | Salesrooms | <?php echo $title;?> </title>
	<?php include "includes/head.php"; ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container, .container-lg, .container-md, .container-sm, .container-xl {
            max-width: 1930px;
        }
        .gap {
            float: left;
            padding: 20px 0;
            position: relative;
            width: 100%;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<div class="theme-layout">

		<?php include "includes/header2.php"; ?>
		<?php include "includes/nav.php"; ?>

		<section>
			<div class="gap" style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
								<div class="col-lg-12">
									<div class="main-wraper">
										
										<div class="container">
                <div class="row">
                	<div class="col-lg-3 mb-4">
                		<nav class="responsive-tab">
		                    <ul class="nav nav-tabs uk-list">
								<!--<li class="nav-item"><a class="active" href="#account" data-toggle="tab">Account</a></li>
								<li class="nav-item"><a class="" href="#notification" data-toggle="tab">Notification</a></li>-->
								<?php
								    $i=0;
								    foreach($contents as $content){
								        $default='';
								        if($i==0){
								            $default='active';
								        }
								        echo '<li class="nav-item"><a class="'.$default.'" style="padding: 18px 22px;" href="#section_'.$i.'" data-toggle="tab"><i class="fa '.$content['icon'].'"></i>&nbsp;&nbsp;'.$content['name'].'</a></li>';
								        $i++;
								    }
								?>
		                    </ul>
		                </nav>
                	</div>
                    <div class="col-lg-6">
                        <div class="main-wraper">
                            <div class="tab-content" id="components-nav">
                                <!-- settings -->
                                <?php
								    $j=0;
								    foreach($contents as $content){
								        $default='';
								        if($j==0){
								            $default='active';
								        }
								        $files=$content['contents'];
								        $render='';
								        foreach($files as $file){
								            
								            $render.='
								            <div class="col-md-6">
								                <div class="card mt-2">
								                    <img class="lazy" src="'.$file['thumbnail'].'" style="width:100%;height:240px"/>
								                    <center><b><a target="_blank" href="'.URL_Make('/file/'.$file['id']).'">'.$file['name'].'</a></b></center>
								                </div>
								            </div>
								            ';
								        }
								        echo '
								        <div class="tab-pane '.$default.' fade show" id="section_'.$j.'">
        									<div class="uk-width">
        										<div class="setting-card">
        											<h2><i class="fa '.$content['icon'].'"></i>&nbsp;&nbsp;'.$content['name'].'</h2>
        											<div class="row mt-2">
        											'.$render.'
        											</div>
        										</div>
        									</div>
                                        </div>
								        ';
								        $j++;
								    }
								?>
                                
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-4">
                        <video src='<?php echo $sol['welcome_message'];?>' style='width:100%;height:200px' controls></video>
                		<button style='width:100%' class='button soft-success' id='meeting'>Book a meeting</button>
                		<button style='width:100%' class='button soft-primary mt-2' id='question'><i class='fa fa-comment'></i>&nbsp;&nbsp;Ask a question</button>
                	</div>
                </div>
            </div>
										
										
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		
	<div class="post-new-popup" id='meeting-popup'>
		<div class="popup" style="width: 800px;">
			<span class="popup-closed"><i class="icofont-close"></i></span>
			<div class="popup-meta">
				<div class="popup-head">
					<h5><i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></i>Book a meeting</h5>
				</div>
				<div class="post-new">
					<div>
						<?php
						    $s_id=$sol['salesperson'];
						    $m="SELECT * FROM `members` WHERE `id`='".$s_id."' ";
						    $member=$db->RetriveSingle($m);
						    if(strlen($member['meeting_url'])!=0){
						        echo "<iframe src='https://calendly.com/".$member['meeting_url']."' style='width:100%;height:550px'></iframe>";    
						    }else{
						    echo "<div class='pt-2 pb-2'><center><h3>Meeting Details Not Available</h3></center></div>";      
						    }
						      
						?>
					</div>
					
				</div>
			</div>
		</div>
	</div><!-- New post popup -->
	
	<div class="post-new-popup" id='question-popup'>
		<div class="popup">
			<span class="popup-closed"><i class="icofont-close"></i></span>
			<div class="popup-meta p-4">
					<form class='c-form' id='sub'>
						<label>First Name</label>
						<input type='text' name='first_name'/>
						<label>Last Name</label>
						<input type='text' name='last_name'/>
						<label>Company Name</label>
						<input type='text' name='company_name'/>
						<label>Business Email</label>
						<input type='text' name='email'/>
						<button type='submit' class='button soft-success'>Submit</button>
					</form>
			</div>
		</div>
	</div><!-- New post popup -->
		
		
		
		<?php include "includes/footer.php"; ?>
	</div>
	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>
	<script>
	    $(document).ready(function(){
	        url=location.href;
	        
	        $('#meeting').click(function(){
	            $('#meeting-popup').addClass('active');
	        })
	        $('#question').click(function(){
	            $('#question-popup').addClass('active');
	        })
	        $('#sub').on('submit',function(e){
	            e.preventDefault();
	            $('#sub')[0].reset();
	            $('#question-popup').removeClass('active');
	        })
	        if(url.includes('#scan')){
	            $('#question-popup').addClass('active');
	        }
	    })
	</script>



</body>

</html>