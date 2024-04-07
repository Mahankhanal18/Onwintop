<?php

include "init.php";

if(isset($red)){
    $reward=base64_decode($red);
    $reward=json_decode($reward,true);
    $id=$reward['id'];
}

if(!isset($page)){
    $page=1;
}
$community_id=$_SESSION['community_id'];
$limit=10;
$r=R::findOne('rewards','id=?',[$id]);


$cred=json_decode($_SESSION['community_credentials'],true);

$email=$cred['email'];
$c=R::findOne("members","email=?",[$email]);

$details=json_decode($r['redeem_data'],true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Redeem Reward | <?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.css">
	<?php include "includes/head.php"; ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap');
        .nft-name{
            font-family: 'Abril Fatface', cursive;
            color:#000000;
        }
        #logout:hover{
            cursor:pointer;
        }
    </style>
</head>

<body style='background-color:aqua'>
	<!--<div class="page-loader" id="page-loader">
		<div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
	</div> -->
	<div class="theme-layout"  style='background-color:#ffffff'>

		<?php include "includes/header2.php"; ?>

		<?php include "includes/nav.php"; ?>

		<section class='pb-5'>
			<div class="gap" style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 px-5 mb-5">
							<div id="page-contents" class="row merged20">
							    <div class='col-lg-2'></div>
								<div class="col-lg-8 mb-5">
									<div class="main-wraper_ px-4 mb-5 pt-5 wrapper">
										<div class="main-title_">Reward Redeemption</div>
                                        <?php
                                            $info=base64_decode($red);
                                            $info=json_decode($info,true);
                                            
                                
                                            $nft=$info['reward']['data'];
                                            
                                            $asset=R::findOne("nftcontents","id=?",[$nft[0]]);
                                            $as=json_decode($asset['data'],true);
                                            
                                            $name=$asset['name'];
                                            $description=$as['description'];
                                            $tag='#'.$name;
                                            $image=$as['image'];
                                            
                                        ?>  
                                        <div class='row'>
                                            <div class='col-md-6'>
                                                <h1 class='nft-name mt-3 mb-4'><?php echo $name;?></h1>
                                                <h5 class='mt-3 mb-3'>Edition 1 of <?php echo count($nft);?></h5>
                                                <p style="font-size:18px">
                                                    <?php echo $description;?>
                                                </p>
                                                </br></br>
                                                
                                                <div class='row'>
                                                    <div class="col-md-12 align-self-end">
                                                        
                                                        <h6><b><?php echo $tag;?></b></h6>
                                                        <p id="error"></p>
                                                        <div class='row my-2 mx-1' id='loading' style="display:none;">
                                                            <img src='https://app-dev.onwintop.com/images/resources/loading.gif' style='height:27px;width:27px'/>
                                                            <b class='ml-2'>Loading...</b>
                                                        </div>
                                                        <p class='text-success' id='status'></p>
                                                        <button style="border-radius:0px" id="redeem" class='btn btn-outline-dark mt-3'>Redeem Now</button>
                                                        <p id='logout' class='text-primary mt-2'>Logout</p>
                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class='col-md-6'>
                                                <img src='<?php echo $image;?>' style="width:100%;height:420px;border-radius:10px;object-fit:cover;object-position:center;"/>
                                            </div>
                                            
                                        </div>

									</div>
								</div>
                                <div class='col-lg-2'></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		

		<?php include "includes/footer.php"; ?>
		<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>

	</div>

    <script>
        $(document).ready(function(){
            
            
            $(".wrapper .content-item").slice(8).hide();

            $('#confirm-btn').click(function(){
                $('#confirm').addClass('active');
            })
        })
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@toruslabs/torus-embed"></script>
    <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.34/dist/web3.js"></script>
    <script>
    
        (async function init() {
            $("#login").hide();
            $("#logout").hide();
            
            var login=false;
            var email='';

            $('#redeem').click(function(){
                if(login==false){
                    InitiateLogin();
                }else{
                    ProcessMint(email);
                }
            })

            function InitiateLogin(){
                window.torus
                .login()
                .then(function () {
                    return initWeb3();
                })
                .then(function () {
                    return window.torus.getUserInfo();
                })
                .then(function (user) {
                    ProcessMint(user.email);
                    $("#name").text(user.name);
                    $('#text').text('');
                    $("#error").hide();
                    $("#logout").show();
                    $("#login").hide();
                    $('.wallet').show();
                })
                .catch(function (err) {
                    $("#error").text(err.message);
                });
            }

            //exchange 
            amount=0;
            coin=0;
            function exchange(){
                $('#coin-ex').val(coin);
                $('#amount-ex').val(amount);
            }
            
            function ProcessMint(email){
                var nft_id='<?php echo $asset['id'];?>';
                $('#loading').show();
                $.ajax({
                    url:'https://app-dev.onwintop.com/api/transfer-nft.php',
                    method:'POST',
                    data:{
                        id:nft_id,
                        email:email
                    },
                    success:function(data){
                        $('#loading').hide();
                        $('#status').html(data);
                        window.close();
                    }
                })
            }
            
            $('#amount-ex').on('keyup',function(){
                coin=parseFloat($('#amount-ex').val())*100000;
                amount=$('#amount-ex').val();
                exchange();
            })
            
            $('#coin-ex').on('keyup',function(){
                amount=parseFloat($('#amount-ex').val())/100000;
                coin=$('#coin-ex').val();
                exchange();
            })


            const torus = new Torus();
            window.torus = torus;

            await torus.init();

            try {
                const user = await torus.getUserInfo();
                $("#name").text(user.name);
                $('#text').text('');
                $('.wallet').show();
                $("#logout").show();
                await initWeb3();
            } catch (error) {
                $("#text").text("No Wallet Available");
                $('.wallet').hide();
                $("#login").show();
            }
        })();

        async function initWeb3() {
            const web3 = new Web3(window.torus.provider);
            //console.log(await web3.eth.getAccounts());
            //const address = (await web3.eth.getAccounts())[0];
            const address='0x1ff35c96719aaf6add04848b05717ebf1b5c5820';
            
            //const balance = await web3.eth.getBalance(address);
            const balance = 0.26;
            $("#address").html(address);
            $("#balance").html(balance);
            //loadNFTs(address)
            //window.close();
            $.ajax({
                url:'https://app-dev.onwintop.com/api/connect_wallet.php',
                method:'POST',
                data:{
                    'email':'<?php echo $email;?>',
                    'address':'0x1ff35c96719aaf6add04848b05717ebf1b5c5820',
                },
                success:function(data){
                    console.log(data);
                }
            })
        }
        
        //loadNFTs('0x1ff35c96719aaf6add04848b05717ebf1b5c5820');
        function loadNFTs(address){
            $.ajax({
                url:'https://app-dev.onwintop.com/api/fetch-nfts.php?email='+'<?php echo $email;?>',
                method:'GET',
                success:function(data){
                    data=JSON.parse(data);
                    console.log(data);
                    elements="";
                    data.forEach((val,index)=>{
                        elements+="<div class='col-md-4 mb-2'><div class='card p-1'><img src='"+val.preview+"' style='height:140px;object-fit:contain;object-position:center;width:100%' /><center><b>"+val.name+"</b></center></div></div>";
                    })
                    $('#nft_holders').html(elements);
                }
            })
        }

        $("#logout").click(function (event) {
            window.torus
                .logout()
                .then(function (res) {
                    $("#text").text("Login again to continue");
                    $("#address").text("");
                    $("#balance").text("");
                    $("#login").show();
                    $("#logout").hide();
                    $('.wallet').hide();
                })
                .catch(function (err) {
                    $("#error").text(err.message);
                });
        });
    </script>

</body>

</html>