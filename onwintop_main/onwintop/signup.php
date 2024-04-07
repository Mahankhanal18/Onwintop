<?php
include "init.php";
$db = new Database();
$s = "SELECT * FROM `communities` WHERE `id`='" . $_SESSION['community_id'] . "' ";
$data = $db->RetriveSingle($s);
if (isset($_POST['accept'])) {
	//check if email is already taken
	$user = R::findOne("members", "WHERE email=? AND community_id=?", [$_POST['email'], $_SESSION['community_id']]);
	if (empty($user)) {
		$member = R::dispense("members");
		$member->community_id = $_SESSION['community_id'];
		$member->first_name = $_POST['first_name'];
		$member->last_name = $_POST['last_name'];
		$member->email = $_POST['email'];
		$member->role = 'Member';
		$member->password = $_POST['password'];
		$member->designation = 'Member';
		$member->status = 'Active';
		$member->answers=$_POST['additional_questions'];
		$member->registration_date = date('Y-m-d');
		if (R::store($member)) {
			$success = 'Your account has been successfully created. You will be automatically redirected to the login page...';
            echo "<script>setTimeout(function(){ window.location='signin'; }, 3000);</script>";
		} else {
			$err = "Something went wrong! please try again later";
		}
	} else {
		$err="This email is already associated with an account!";
	}
}
//get additional questions
$questions=R::findOne("questions","WHERE community_id=?",[$_SESSION['community_id']]);
$qe=false;
if(!empty($questions)){
    $qe=true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Signup | <?php if ($_SESSION['community_id'] != 'user') echo $title; else echo "Tellselling"; ?> </title>
	<?php include "includes/head.php"; ?>
</head>
<body>
    				    <?php
				    $img="https://source.unsplash.com/random/600x400/?technology";
				    //print_r($branding);
				    if (isset($branding['signup_image'])){
				        $img=$branding['signup_image'];
				    }
				    ?>
	<div class="theme-layout">
		<div class="authtication high-opacity"  style="background-image:url(<?php echo $img; ?>);background-size:cover;background-position:center">
		</div>
		<div class="auth-login">
			<div class="verticle-center">
				<div class="signup-form">
					<h4><i class="fa fa-lock" aria-hidden="true"></i> Singup</h4>
					<form method="post" id='signup' action="" class="c-form">
						<div class="row merged-10">
							<div class="col-lg-12 col-sm-12 col-md-12">
								<span class='text-danger error'></span>
								<span class='text-success success'></span>
							</div>
							<div class="col-lg-6 col-sm-6 col-md-6">
								<input type="text" name='first_name' placeholder="First Name" required>
							</div>
							<div class="col-lg-6 col-sm-6 col-md-6">
								<input type="text" name='last_name' placeholder="Last Name" required>
							</div>
							<div class="col-lg-6 col-sm-6 col-md-6">
								<input type="email" name='email' placeholder="Email@" required>
							</div>
							<div class="col-lg-6 col-sm-6 col-md-6">
								<input type="password" maxlength="16" minlength="6" name='password' placeholder="Password" required>
							</div>
							<input type='hidden' name='additional_questions' value='' id='additional_questions'/>

							<div class="col-lg-12">
								<div class="checkbox">
									<input type="checkbox" name='accept' id="checkbox" checked>
									<label for="checkbox"><span>I agree the terms of Services and acknowledge the privacy policy</span></label>
								</div>
								<spam class='text-danger mt-2 mb-2'><?php echo $err;?></span>
								<spam class='text-success mt-2 mb-2'><?php echo $success;?></span>
								<button class="main-btn" type="submit"><i class="icofont-key"></i> Signup</button>
							</div>
						</div>
					</form>
					<?php
					if($qe==true){
					?>
					<form id='qstn-form' style='display:none'>
					    <div class='questions c-form'></div>
					    <button class="main-btn" type="submit"><i class="fa fa-key" aria-hidden="true"></i> Continue</button>
					</form>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <script>
        $(document).ready(function(){
            var has_question=false;
            <?php if($qe==true){ ?>
				//code starts here
				has_question=true;
				data=JSON.parse('<?php echo $questions['data'];?>');
				console.log(data);
				element="";
				for(i=0;i<data.length;i++){
				    obj=data[i];
				    if(obj.subtype=='h1'){
				        element+="<h4>"+obj.label+"</h4>";
				    }
				    if(obj.subtype=='p'){
				        element+="<p>"+obj.label+"</p>";
				    }
				    if(obj.subtype=='text'){
				        element+='<div class="col-lg-12 col-sm-12 col-md-12"><input type="text" name="'+obj.name+'" placeholder="'+obj.label+'" required></div>';
				    }
				    if(obj.subtype=='textarea'){
				        element+='<div class="col-lg-12 col-sm-12 col-md-12"><textarea name="'+obj.name+'" placeholder="'+obj.label+'" required></textarea></div>';
				    }
				    if(obj.subtype=='date'){
				        element+='<div class="col-lg-12 col-sm-12 col-md-12"><input type="date" name="'+obj.name+'" placeholder="'+obj.label+'" required></div>';
				    }
				}
				$('.questions').html(element);
                  
			<?php } ?>
			$('#signup').on('submit',function(e){
			    e.preventDefault();
			    if(has_question){
			        $('#signup').hide();
			        $('#qstn-form').show();
			    }else{
			        $('#signup')[0].submit();
			    }
			})
			$('#qstn-form').on('submit',function(e){
			    e.preventDefault();  
			    var formData=new FormData(this);
			    var object = {};
                formData.forEach(function(value, key){
                    object[key] = value;
                });
                var json = JSON.stringify(object);
                //alert(json);
                $('#additional_questions').val(json);
			    $('#signup')[0].submit();
			  //$('#qstn-form')[0].submit();
			  
			})
        })
    </script>
</body>

</html>