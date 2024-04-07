<?php
include "init.php";

$db = new Database();
$parts=URL_Parts();

$cred=json_decode($_SESSION['community_credentials'],true);
$email=$cred['email'];

//wallet info
$member=R::findOne("members","email=?",[$email]);
$wallet='';
if(!empty($member)){
    $wallet=$member['wallet_address'];
}else{
    echo "<script>window.location='".URL_Make('/rewards')."';</script>";
}
$assets=array();
if(isset($_POST['nft_assets'])){
    $nft=json_decode($_POST['nft_assets'],true);
    if(strlen($nft['title'])!=0){
        foreach($nft['assets'] as $asset){
            $n=R::dispense("nftcontents");
            $n->name=$nft['title'];
            $n->email=$email;
            $info=array(
                "name"=>$nft['title'],
                "description"=>$nft['description'],
                "image"=>$asset
            );
            $info=json_encode($info);
            $n->data=$info;
            $n->url=$asset;
            $n->preview=$asset;
            $n->status='Active';
            $r=R::store($n);
            if($r){
                array_push($assets,$r);
            }
        }
    }
}

if(isset($_POST['name'])){
    $data=R::dispense("rewards");
    $data->name=$_POST['name'];
    $data->description=$_POST['description'];
    $data->type=$_POST['type'];
    $data->amount=$_POST['redeem_data'];
    $data->community_id=$community_id;
    $data->cover=$_POST['cover'];
    $info=array(
        "type"=>'NFT',
        "data"=>$assets
    );
    $data->redeem_data=json_encode($info);
    if(R::store($data)){
        echo "<script>window.location='".URL_Make('/rewards')."';</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title> Create Rewards | <?php echo $title; ?></title>
	<?php include "includes/head.php"; ?>
	
	<style>
	    .active-step{
	        border-bottom:5px solid green;
	    }
	    .uk-tab>.uk-active>a {
            color: #333;
            border-color: #00000000;
        }
	</style>
	<script>
	    var nft_assets=[];
	</script>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
</head>

<body>
	<div class="theme-layout">
		<?php include "includes/header2.php"; ?>
		<?php include "includes/nav.php"; ?>
		<!--Main Form-->
		<form id='reward' action='' method='post'>
		    <input type='hidden' name='nft_assets' id='nft_assets' value=''/>
		    <input type='hidden' name='admin_approval' id='admin_approval' value='true'/>
		    <input type='hidden' name='fulfilment_type' id='fulfilment_type' value='manual'/>
		    <input type='hidden' name='name' id='name'/>
		    <input type='hidden' name='description' id='description'/>
		    <input type='hidden' name='type' id='type'/>
		    <input type='hidden' name='disclaimer' id='disclaimer'/>
		    <input type='hidden' name='fulfilment_type' id='fulfilment_type'/>
		    <input type='hidden' name='featured' id='featured'/>
		    <input type='hidden' name='cover' id='cover'/>
		    <input type='hidden' name='fulfilment_type' id='fulfilment_type'/>
		    <input type='hidden' name='redeem_type' id='redeem_type'/>
		    <input type='hidden' name='redeem_data' id='redeem_data'/>
		</form>
		<section class='panel-content'>
			<div class="gap" id='content' style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
				<div class="container">
					<div class="row">
						<div class="offset-lg-1 col-lg-10">
							<div class="blog-detail">
								<div class="blog-details-meta">
									<div class='screen new'>
									    <?php include "includes/rewards/new.php";?>
									</div>
									<div class='screen fulfilment'>
									    <?php include "includes/rewards/fulfilment.php";?>
									</div>
									<div class='screen headline'>
									    <?php include "includes/rewards/headline.php";?>
									</div>
									<div class='screen eligibility'>
									    <?php include "includes/rewards/eligibility.php";?>
									</div>
									<div class='screen redeeming'>
									    <?php include "includes/rewards/redeeming.php";?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php include "includes/footer.php"; ?>
	</div>
	<script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
	
	<script>
		$(document).ready(function() {
		    //Switch Screen
		    function SS(name){
		       $('.screen').hide();
		       $('.'+name).show();
		    }
		    SS('fulfilment');
		    $('#scratch').click(function(){
		        SS('new');
		    })
			$('.theme-layout').click(function() {
				sidebar = $('#sidenav').prop("classList");
			})
			//Fulfilment Functionality
            $('[name="category"]').on('change',function(){
                var cat=$('[name="category"]').prop('checked');
                if(!cat){
                    $('.nft-wallet').show();
                }else{
                    $('.nft-wallet').hide();
                }
            })
            
            
            //create nft
            function createNFT(name,description,image){
                email='<?php echo $email;?>';
                $.ajax({
                    url: '<?php echo $url . 'api/nft_contents.php'; ?>',
                    method: 'post',
                    data: {
                        name,description,image,url:image,preview:image,email,method:'create'
                    },
                    success: function(data) {
                        alert(data);
                        console.log(data);
                        $('#nft-btn').html('Create');
                        $('#nft-btn').prop('disabled','false');
                        loadNFT();
                    }
                })
            }
            //loadNFT();
            function loadNFT(){
                email='<?php echo $email;?>';
                $.ajax({
                    url: '<?php echo $url . 'api/nft_contents.php'; ?>',
                    method: 'post',
                    data: {
                        email,method:'load'
                    },
                    success: function(data) {
                        console.log(data);
                        data=JSON.parse(data);
                        $('#nft-list').html('');
                        for(i=0;i<data.length;i++){
                            obj=data[i];
                            ele="<div class='card col-md-6 p-2'><div class='card-body'><div class='row'><div class='col-md-3'><img src='"+obj.preview+"' style='height:100%;width:60px;object-fit:cover;object-position:center' /></div><div class='col-md-9' style='justify-content:center;align-items:center'><p>Name : <b>"+obj.name+"</b></p></div></div></div></div>";
                            $('#nft-list').append(ele);
                        }
                    }
                });
                
                
            }
            
            var nft_img=''
            $('#nft-btn').on('click',function(){
                $('#nft-btn').html('Loading');
                $('#nft-btn').prop('disabled','true');
                name=$('#name_val').val();
                $('#name_val').val('');
                $('#description_val').val('');
                description=$('#description_val').html();
                createNFT(name,description,thumbnail_url);
            })
            $('#nft-image').on('change', function() {
                thumbnail = $('#nft-image')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $.ajax({
                    url: '<?php echo $url . 'api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        nft_img= data.secure_url;
                        $('#nft-img').attr('src',thumbnail_url);
                        
                    }
                })
            })
            var nft_data;
            $('#fulfilment').click(function(){
                des=$('#nft_description').html();
                des_=$('#nft_description').html();
                type=$('.nft-input').val();
                if(type=='NFT'){
                    nft_data={
                        title:$('#nft_name').val(),
                        keyword:$('#nft_keyword').val(),
                        description:$('#nft_description').html(),
                        assets:nft_assets,
                        type:'NFT'
                    }
                }else{
                    nft_data={
                        type:'Gift Card',
                        amount:$('#gift_amount').val()
                    }
                }
                console.log(nft_data)
                SS('headline');
            })
            $('#done').click(function(){
                $('#nft_assets').val(JSON.stringify(nft_data));
                $('#reward')[0].submit();
            })
            $('#headline').click(function(){
                $('#name').val($('#headline_name').val());
                $('#type').val($('#headline_type').val());
                $('#description').val($('#headline_description').val());
                $('#cover').val($('#thumbnail').val());
                SS('redeeming');
            })
            $('#redeem').click(function(){
                $('#redeem_data').val($('#coin').val());
                SS('eligibility');
            })
            //redeem functionality
            $('.data-switch').on('change',function(){
                var identity=$(this).attr('target-expand');
                $('.data-detail').hide();
                $('.'+identity).show();
            })
            
            //headline functionality
            $('#manage-reward-types').click(function(){
                $('#reward-types').modal('show');
            })
            $('#new-type').click(function(){
                $('#reward-types').modal('hide');
                $('#add-type').modal('show');
            })
            $('#type-form').on('submit',function(e){
                e.preventDefault();
                type_name=$('#type_name').val();
                type_description=$('#type_description').val();
                $('#type_description').val('');
                $('#type_name').val('');
                ele="<tr><td class='text-primary'><b>"+type_name+"</b></td><td>1</td><td class='text-secondary'>"+type_description+"</td></tr>";
                $('#type_table').append(ele);
                $('#reward-types').modal('show');
                $('#add-type').modal('hide');
                ele="<option>"+type_name+"</option>";
                $('#headline_type').append(ele);
            })
            
            $('#thumbnail_btn').click(function(){
                $('#thumbnail_uploader').click();
            })
            
            $('#thumbnail_uploader').on('change', function() {
                $('#uploading').show();
                thumbnail = $('#thumbnail_uploader')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $.ajax({
                    url: '<?php echo $url . 'api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#uploading').hide();
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        $('#thumbnail-preview').attr('src',thumbnail_url);
                        $('#thumbnail').val(thumbnail_url);
                    }
                })
            })

            

		})
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
</body>

</html>