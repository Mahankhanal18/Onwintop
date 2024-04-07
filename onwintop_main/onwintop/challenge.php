<?php
include "init.php";
$db = new Database();
$parts=$id;
$s = "SELECT * FROM `challenges` WHERE `id`='" . $id . "'  ";
$challenge = $db->RetriveSingle($s);
$cover = $challenge['thumbnail'];
//get nav to other posts
$prev = $id - 1;
$next = $id + 1;
?>
<!DOCTYPE html>
<html lang="en">
<?php $cred=json_decode($_SESSION['community_credentials'],true);?>
<head>
	<title><?php echo $challenge['name']; ?></title>
	<?php include "includes/head.php"; ?>
	
	<?php
	    if($_POST['type']=='questions'){
	        if(!isset($cred['email'])){
	            echo "<script>window.location='../signup';</script>";
	        }
	        $submission=R::dispense('challengesubmissions');
	        $submission->community_link=$community_id;
	        $submission->challenge_id=$id;
	        $submission->submission_data=$_POST['submission_data'];
	        $submission->challenge_type=$_POST['type'];
	        $submission->email=$cred['email'];
	        $submission->name=$cred['first_name']." ".$cred['last_name'];
	        $submission->member_id=$cred['id'];
	        $submission->member_type=$cred['role'];
	        $submission->date=date('Y-m-d');
	        $submission->status='Pending';
	        $submission->credit=0;
	        if(R::store($submission)){
	            echo "<script>window.location='../challenge-complete';</script>";
	        }
	    }
	    if($_POST['type']=='quiz'){
	        $submission=R::dispense('challengesubmissions');
	        $submission->community_link=$community_id;
	        $submission->challenge_id=$id;
	        $submission->submission_data=$_POST['quiz_answer'];
	        $submission->challenge_type=$_POST['type'];
	        $submission->email=$cred['email'];
	        $submission->name=$cred['first_name']." ".$cred['last_name'];
	        $submission->member_id=$cred['id'];
	        $submission->member_type=$cred['role'];
	        $submission->date=date('Y-m-d');
	        $submission->status='Pending';
	        $submission->credit=0;
	        if(R::store($submission)){
	            echo "<script>window.location='../challenge-complete';</script>";
	        }
	    }
	    if($_POST['type']=='share'){
	        $submission=R::dispense('challengesubmissions');
	        $submission->community_link=$community_id;
	        $submission->challenge_id=$id;
	        $submission->submission_data=$_POST['post_url'];
	        $submission->challenge_type=$_POST['type'];
	        $submission->email=$cred['email'];
	        $submission->name=$cred['first_name']." ".$cred['last_name'];
	        $submission->member_id=$cred['id'];
	        $submission->member_type=$cred['role'];
	        $submission->date=date('Y-m-d');
	        $submission->status='Pending';
	        $submission->credit=0;
	        if(R::store($submission)){
	            echo "<script>window.location='../challenge-complete';</script>";
	        }
	    }
	
	?>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<style>
    #share-buttons img{
        height:30px !important; 
        width: auto;
        margin-top:15px;
    }
</style>
<script>
    function Done(type){
        
        if(type=='link'){
            setTimeout(function(){
                var data={
                    email:'<?php echo $cred['email'];?>',
                    name:'<?php echo $cred['first_name']." ".$cred['last_name'];?>'
                }
                data=JSON.stringify(data);
                var url='<?php echo $_ENV['project_url'];?>api/submit_challenge.php';
                $.ajax({
                    url:url,
                    method:'POST',
                    data:{
                        challenge_id:'<?php echo $id;?>',
                        submit_data:data,
                    },
                    success:function(data){
                        window.location='../challenge-complete';
                    }
                })
            },6000);
            
        }

        if(type=='advocate'){
            var data={
                email:'<?php echo $cred['email'];?>',
                name:'<?php echo $cred['first_name']." ".$cred['last_name'];?>'
            }
            data=JSON.stringify(data);
            var url='<?php echo $_ENV['project_url'];?>api/submit_challenge.php';
            $.ajax({
                url:url,
                method:'POST',
                data:{
                    challenge_id:'<?php echo $id;?>',
                    submit_data:data,
                },
                success:function(data){
                    window.location='../challenge-complete';
                }
            })
        }
        
        if(type=='referral'){
            var data={
                email:'<?php echo $cred['email'];?>',
                name:'<?php echo $cred['first_name']." ".$cred['last_name'];?>'
            }
            data=JSON.stringify(data);
            var url='<?php echo $_ENV['project_url'];?>api/submit_challenge.php';
            $.ajax({
                url:url,
                method:'POST',
                data:{
                    challenge_id:'<?php echo $id;?>',
                    submit_data:data,
                },
                success:function(data){
                    alert(data)
                    //window.location='../challenge-complete';
                }
            })
        }
        
        
    }
</script>
</head>

<body>

	<div class="theme-layout">

		<?php include "includes/header2.php"; ?>
		<?php include "includes/nav.php"; ?>

		<section class='panel-content'>
			<div class="gap" id='content' style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
				<div class="container">
					<div class="row">
						<div class="offset-lg-1 col-lg-10">
							<div class="blog-detail">
								<?php
								if($challenge['challenge_type']=='link'){
								?>
								<div class="blog-details-meta" >
									<h3><?php echo $challenge['headline']; ?></h3></br>
                                    <p>Share this <b><?php echo $challenge['name'];?></b></p>
                                    <p><i class="fa fa-coins text-warning"></i>&nbsp;<?php echo $challenge['reward'];?> coins for each shares you make</p>
                                    <div class='row'>
                                        <div class='col-md-12'>
                                            <div class="card mb-5" style="width: 100%;">
                                              <img class="card-img-top" style="height:200px;width:100%;object-position:center;object-fit:cover" src="<?php echo $challenge['thumbnail'];?>" alt="Card image cap">
                                              <div class="card-body">
                                                <h5 class="card-title"><?php echo $challenge['headline'];?></h5>
                                                <p class="card-text"><?php $challenge_data=json_decode($challenge['challenge_data'],true);echo $challenge_data['share_text'];?></p>
                                                <div id="share-buttons">
                                                    <a onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo $challenge['url']; ?>','name','width=600,height=400');">
                                                        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                                                    </a>
                                                    <a onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $challenge['url']; ?>','name','width=600,height=400');" >
                                                        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
                                                    </a>
                                                    <a onclick="https://twitter.com/share?url=<?php echo $challenge['url']; ?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons','name','width=600,height=400');">
                                                        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                                                    </a> 
                                                </div>
                                                <button class='btn btn-success mt-4 confirm-share-btn'>Submit Challenge</button>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
								<?php } ?>
								
								
								<?php
								if($challenge['challenge_type']=='questions'){
								?>
								<div class="blog-details-meta">
                                    
                                    <div class='row'>
                                        <div class='col-md-8'>
                                            <div class="card" style="width: 100%;background-color:#ebebeb;">
                                              <form action='' method='post' id='qstn_form' class="card-body">
                                                <input type='hidden' name='type' id='qstn_type'/>
                                                <input type='hidden' name='submission_data' id='qstn_submission_data'/>
                                                <div class='col-md-12 mt-3'>
                                                    <h5 class="card-title"><?php echo $challenge['headline'];?></h5>
                                                    <p class="card-text"><?php echo $challenge['description'];?></p>
                                                </div>
                                                <div id='questions'></div>
                                                <div class='col-md-12'>
                                                    <button type='submit' class='btn btn-primary mb-2'><?php echo $challenge['submit_text'];?></button>
                                                    <p><small><i class="fa fa-coins text-warning"></i>&nbsp;<?php echo $challenge['reward'];?> coins for each shares you make</small></p>
                                                </div>
                                              </form>
                                            </div>
                                        </div>
                                    </div>
								</div>
								<?php } ?>
								
								
								<?php
								if($challenge['challenge_type']=='quiz'){
								    $quiz=json_decode($challenge['challenge_data'],true);
								?>
								<form id='quiz_form' action='' method='post' class="blog-details-meta p-4" style="background-color:#ebebeb;border-radius:8px">
									<h3><?php echo $challenge['headline']; ?></h3></br>
									<div class='questions'>
									    <?php $quiz=json_decode($challenge['challenge_data'],true); $n=1; foreach($quiz as $q){?>
									       <div class='mt-4 qstn_<?php echo $n;?> qstn'>   
									            <h5>Q. <?php echo $q['question'];?></h5>
									            <div class='row'>
									                <?php 
									                   echo "<div class='col-md-3 mt-2' style='font-size:18px'><input name='option' class='option' question='".$q['question']."' credit='".$q['credit']."' correct='".$q['answer']."' answer='".$q['option1']."' type='radio'>&nbsp;&nbsp;&nbsp;".$q['option1']."</div>";
                                                       echo "<div class='col-md-3 mt-2' style='font-size:18px'><input name='option' class='option' question='".$q['question']."' credit='".$q['credit']."' correct='".$q['answer']."' answer='".$q['option2']."' type='radio'>&nbsp;&nbsp;&nbsp;".$q['option2']."</div>";
                                                       echo "<div class='col-md-3 mt-2' style='font-size:18px'><input name='option' class='option' question='".$q['question']."' credit='".$q['credit']."' correct='".$q['answer']."' answer='".$q['option3']."' type='radio'>&nbsp;&nbsp;&nbsp;".$q['option3']."</div>";
                                                       echo "<div class='col-md-3 mt-2' style='font-size:18px'><input name='option' class='option' question='".$q['question']."' credit='".$q['credit']."' correct='".$q['answer']."' answer='".$q['option4']."' type='radio'>&nbsp;&nbsp;&nbsp;".$q['option4']."</div>";
									                ?>
									                
									            </div>
									       </div>
									    <?php $n++; } ?>
									</div>
									</br></br>
									<input type='hidden' name='type' value='quiz'/>
									<input type='hidden' name='quiz_answer' id='quiz_answer'/>
                                    <span class='btn btn-outline-primary' id='quiz-prev'><< Previous</span>
                                    <span class='btn btn-outline-primary' id='quiz-next'>Next >></span>
                                    </br></br></br></br>
                                    
                                    <button id='quiz_submit' class='btn btn-success'><?php echo $challenge['submit_text'];?></button>
								</form>
								<?php } ?>
								
								
								
								<?php
								if($challenge['challenge_type']=='advocate'){
								    $advocate=json_decode($challenge['challenge_data'],true);
								?>
								<div class='row'>
    								<div class="blog-details-meta pt-4 col-md-7">
    								    <b>State 1 of 1</b>
    								    
    								    <p style='color:gray'><i class="fa fa-fire text-danger" aria-hidden="true"></i> Activities for Advocates</p>
    								    </br>
    									<h3><?php echo $advocate['headline']; ?></h3></br>
    									<?php
    									    if(isset($advocate['upload'])){
    									        echo '
    									        <div class="card" style="background-color:#ebebeb">
        									        <div class="card-body">
        									            <div class="row">
        									                <div class="col-md-3">
        									                    <img src="https://www.gynecoestetic.com/wp-content/plugins/responsive-menu/v4.0.0/assets/images/no-preview.jpeg" style="width:100%;height:auto">
        									                </div>
        									                <div class="col-md-9">
        									                    <b>Upload an image as proof of complition <span class="text-danger">*</span></b></br>
        									                    <small>No image uploaded</small></br>
        									                    <span class="btn btn-outline-primary mt-2">Upload an image</span>
        									                </div>
        									            </div>
        									       </div>
    									        </div>
    									        ';
    									    }
    									?>
                                    </div>
                                    <div class="col-md-7 mt-2" >
                                        
                                        <span onClick="Done('advocate');" class='btn btn-warning text-white' style="float:right"><?php echo $challenge['submit_text'];?></span>
                                        <span class='btn' style="float:right">Later</span>
                                    </div>
								</div>
								<?php } ?>
								
					
								<?php
								if($challenge['challenge_type']=='referral'){
								    $details=json_decode($challenge['challenge_data'],true);
								    $description=$details['description'];
								    $questions=$details['questions'];
								?>
								<div class="blog-details-meta mt-2">
								    <div class='row pt-3'>
								        <div class='col-md-7 p-5' style="text-align:justify">
								            <?php echo $description;?>

								        </div>
								        <form id='referral_form' action='' method='post' class='col-md-5 pt-5 pb-5' style='background-color:#ebebeb'>
								            <h5>Tell us about your referral</h5></br>
								            <?php 
								            foreach($questions as $qstn){
								                if($qstn['type']=='text'){
								                    echo "
								                    <div class='form-group'>
    								                    <label>".$qstn['label']."</label>
    								                    <input type='".$qstn['type']."' name='".$qstn['name']."' class='".$qstn['className']."'>
								                    </div>
								                    ";
								                }        
								            }
								            ?>
							                <button type='submit' class='form-control btn btn-success'><?php echo $challenge['submit_text'];?></button>
								            </br></br>
								            <center><b>OR</b></br>
								                <small>Use this link to collect referrals from your network. Anyone that submit their details throught the form will be associated with your account.</small>
								                <i class='fa fa-facebook-official'></i>
								            </center>
								        </form>
								    </div>
									
                                    
								</div>
								<?php } ?>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php include "includes/footer.php"; ?>
	</div>
	
	<div class="popup-wraper" id='confirm-share'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <form action='' method='post' class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-filter"></i> Submit Challenge</h5>
                </div>
                <div class="send-message">
                    <div class='form-group'>
                        <label>Enter Post URL<span class='text-danger'>*</span></label>
                        <input name='post_url' type='text' class='form-control' required/>
                        <input type='hidden' name='type' value='share'/>
                    </div>
                    <div class='form-group'>
                        <button type='submit' class='btn btn-success'>Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
	
	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/sparkline.js"); ?>"></script>
	<script src="<?php URI("js/chart.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>
	<?php include "includes/scripts.php"; ?>
	<script>
		$(document).ready(function() {
		    
		    //link share
		    $('.confirm-share-btn').click(function(){
		        $('#confirm-share').addClass('active');
		    })
		   
		   
		   //referral
		   $('#referral_form').on('submit',function(e){
		       e.preventDefault();
		       alert('referral');
		   })
		   
		    //quiz
		    var curr_qstn=0;
		    $('.qstn').hide();
		    var type='<?php echo $challenge['type']?>';
		    if(type='quiz'){
		        var qstns=JSON.parse('<?php echo $challenge['challenge_data']?>');
		        var count=qstns.length;
		        $('.qstn').hide();
		        for(i=0;i<count;i++){
		            curr_qstn=0;
		            $('.qstn').hide();
		            $('.qstn_'+i).show();
		        }
		    }
		    var curr_qstn=0;
		    $('#quiz-next').click(function(){
	
		        var qstns=JSON.parse('<?php echo $challenge['challenge_data']?>');
		        var count=qstns.length;
		        if(curr_qstn<count){
		            curr_qstn+=1;
		        }
		        
		        $('.qstn').hide();
		        $('.qstn_'+curr_qstn).show();
		    })
		    $('#quiz-prev').click(function(){
		        
		        var qstns=JSON.parse('<?php echo $challenge['challenge_data']?>');
		        var count=qstns.length;
		        if(curr_qstn!=0){
		            curr_qstn-=1;
		        }
		        
		        $('.qstn').hide();
		        $('.qstn_'+curr_qstn).show();
		    })
		    
		    
			$('.theme-layout').click(function() {
				sidebar = $('#sidenav').prop("classList");
				console.log(sidebar);
			})
			<?php if($challenge['challenge_type']=='questions'){?>
			    data=JSON.parse('<?php echo $challenge['challenge_data'];?>');
				element="";
				for(i=0;i<data.length;i++){
				    obj=data[i];
				    if(obj.subtype=='h1'){
				        element+="<h4>"+obj.label+"</h4></br>";
				    }
				    if(obj.subtype=='p'){
				        element+="<p>"+obj.label+"</p></br>";
				    }
				    if(obj.subtype=='text'){
				        element+='<div class="col-lg-12 col-sm-12 col-md-12"><input type="text" name="'+obj.name+'" placeholder="'+obj.label+'" class="form-control" required></div></br>';
				    }
				    if(obj.subtype=='textarea'){
				        element+='<div class="col-lg-12 col-sm-12 col-md-12"><textarea name="'+obj.name+'" placeholder="'+obj.label+'" class="form-control" required></textarea></div></br>';
				    }
				    if(obj.subtype=='date'){
				        element+='<div class="col-lg-12 col-sm-12 col-md-12"><input type="date" name="'+obj.name+'" placeholder="'+obj.label+'" class="form-control" required></div></br>';
				    }
				}
				$('#questions').html(element);
			    
			<?php } ?>
			
			$('#qstn_form').on('submit',function(e){
			    e.preventDefault();
			    $('#qstn_type').val('questions');
			    data=$('#qstn_form').serializeArray();
			    data=JSON.stringify(data);
			    $('#qstn_submission_data').val(data);
			    $('#qstn_form')[0].submit();
			});
			
			//quiz submission
			var quiz_answers=[];
			$('.option').on('change',function(){
			    question=$(this).attr('question');
			    correct=$(this).attr('correct');
			    credit=$(this).attr('credit');
			    answer=$(this).attr('answer');
			    
			    existing=false;
			    
			    for(i=0;i<quiz_answers.length;i++){
			        if(quiz_answers[i].question==question){
			            existing=true;
			            quiz_answers[i].answer=answer;
			        }
			    }
			    if(!existing){
			        obj={
			            question,answer,correct,credit
			        }
			        quiz_answers.push(obj);
			    }
			});
			$('#quiz_form').on('submit',function(e){
			    e.preventDefault();
			    data=JSON.stringify(quiz_answers);
			    $('#quiz_answer').val(data);
			    $('#quiz_form')[0].submit();
			})
		})
	</script>

</body>

</html>