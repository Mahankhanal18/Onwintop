<?php
include "init.php";

if(!isset($page)){
    $page=1;
}
$community_id=$_SESSION['community_id'];
$limit=10;

$cred=json_decode($_SESSION['community_credentials'],true);

$submission=R::findOne("challengesubmissions","challenge_id=?",[$id]);
$challenge=R::findOne("challenges","id=?",[$id]);
$member=R::findOne("members","community_id=? AND email=?",[$community_id,$cred['email']]);

if(isset($_POST['reward'])){
    $submission->credit=$_POST['reward'];
    $submission->status="Rewarded";
    
    //update members
    $coins=$member->coins;
    $updated_coins=intval($coins)+intval($_POST['reward']);
    $member->coins=$updated_coins;
    
    if(R::store($submission) && R::store($member)){
        echo "<script>window.location='".URL_Make('/challenges')."';</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Review Challenge | <?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/jquery.simplePagination.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.6/simplePagination.min.css">
	<?php include "includes/head.php"; ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<script src="<?php URI("js/main.min.js"); ?>"></script>
	<script src="<?php URI("js/script.js"); ?>"></script>

</head>

<body style='background-color:aqua'>
	<!--<div class="page-loader" id="page-loader">
		<div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
	</div> -->
	<div class="theme-layout"  style='background-color:#ffffff'>

		<?php include "includes/header2.php"; ?>

		<?php include "includes/nav.php"; ?>

		<section>
			<div class="gap" style="<?php if($mobile) echo 'padding-left:0px !important;';?>">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div id="page-contents" class="row merged20">
								<div class="col-lg-8 col-md-8">
									<div class="main-wraper wrapper">
										<div class="main-title">Review Challenge
									        <small style='float:right;'>Submission Date : <?php echo date_format(date_create($submission['date']),'d M Y');?></small></br>
										</div>
										
										    <img src='https://ui-avatars.com/api/?name=<?php echo $submission['name'];?>&background=random' style="float:left;height:40px;width:40px;border-radius:50%;margin-right:10px"/>
									        <b><?php echo $submission['name'];?></b></br>
									        <small><?php echo $submission['email'];?></small>
									        
									        </br></br></br>
			
									        <b>Submission Details</b>
									        </br>
									        <?php
									            if($submission['challenge_type']=='share'){ 
									                echo "
									                Post URL : <i><a href='".$submission['submission_data']."' target='_blank'>".$submission['submission_data']."<a></i></br></br>
									                <a class='btn btn-primary' href='".$submission['submission_data']."' target='_blank'>Visit Link</a>
									                ";
									            }
									        ?>
									        
									        <?php
									            if($submission['challenge_type']=='quiz'){ 
									                $quizs=json_decode($submission['submission_data'],true);
									                foreach($quizs as $q){
									                    echo "
									                    <div class='card' style='margin-bottom:5px;'>
									                        <div class='card-body' style='float:left'>
									                            <b>Q. ".$q['question']."</b></br>
									                            <small>Ans. ".$q['answer']."</small></br>
									                            <small class='text-success'><i>Correct Ans. ".$q['correct']."</i></small>
									                        </div>
									                    </div>
									                    ";
									                }
									            }
									        ?>
									        
									        <?php
									            if($submission['challenge_type']=='questions'){ 
									                $answers=json_decode($submission['submission_data'],true);
									                $questions=json_decode($challenge['challenge_data'],true);
									                $i=0;
									                foreach($questions as $q){
									                    echo "
									                    <div class='card' style='margin-bottom:5px;'>
									                        <div class='card-body' style='float:left'>
									                            <b>Q. ".$q['label']."</b></br>
									                            <small>Ans. ".$answers[$i]['value']."</small></br>
									                        </div>
									                    </div>
									                    ";
									                    $i++;
									                }
									            }
									        ?>
									        </br>
									        </br>
									        <?php
									            if($submission['status']=='Pending'){
									                echo "<span class='btn btn-success btn-sm mt-2 approve_btn'>Approve Credit</span>";
									            }else{
									                echo "<small><b>Status :</b> Coins Rewarded</small>";
									            }
									        ?>
									        

										

									</div>
								</div>


							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	<div class="popup-wraper" id='approve'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <form action='' method='post' class="popup-meta">
                <div class="popup-head">
                    <h5>Approve</h5>
                </div>
                <div class="send-message">
                    <div class='form-group'>
                        <label>Token Amount <span class='text-danger'>*</span></label>
                        <input name='reward' value='<?php echo $challenge['reward'];?>' id='token_amount' class='form-control' />
                    </div>
                    <div class='form-group'>
                        <button type='submit' class='btn btn-success' id='confirm'>Approve</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

		<?php include "includes/footer.php"; ?>
	</div>
    <script src='https://unpkg.com/@solana/web3.js@1.73.2/lib/index.iife.js'></script>
    <script>
        $(document).ready(function(){
            wall={};
            receiver_address='';
            const lamports_per_sol=solanaWeb3.LAMPORTS_PER_SOL;
            
            $('.approve_btn').click(function(){
                
                connectWallet();
                //console.log(wall);
            })
            
            $('#confirm').click(function(){
                var amt=$('#token_amount').val();
                receiver_address='<?php echo $member['wallet_address'];?>';
            })
    
            
            
            function connectWallet(){
                (async()=>{
                    try{
                        const resp= await window.solana.connect();
                        wallet=resp;
                        $('#approve').addClass('active');
                    }catch(err){
                        console.log(err);
                    }
                })();
            }
            
            function disconnectWallet(){
                (async()=>{
                    try{
                        await window.solana.disconnect();
                        console.log('disconnected');
                    }catch(err){
                        console.log(err);
                    }
                })();
            }
            disconnectWallet();
            
            window.solana.on("connect",()=>{
                $('#approve').addClass('active');
            })
            
            function processNext(wallet){
                signInTransactionAndSendMoney(wallet,'var',10)
            }
            
              function getProvider (){
                if ("solana" in window) {
                  const provider = window.solana;
                  if (provider.isPhantom) {
                    return provider;
                  }
                }
              };
              
            function signInTransactionAndSendMoney(wallet,destPubKey,lamports){
                provider = getProvider();
                (async()=>{
                    var amount=0.5;
                    const network="https://api.devnet.solana.com";
                    const connection=new solanaWeb3.Connection(network);
                    const transaction=new solanaWeb3.Transaction();
                    lamports=amount*lamports_per_sol;
                    try{
                        destPubKey='FgxMpj3NUjWJyk4qPZ8zRGGdXpQYyU7DGomr42Nd12aU';
                        lamports=amount*lamports_per_sol;
                        console.log('Process Started');
                        console.log(wallet.publicKey);
                        const destKey=new solanaWeb3.PublicKey(destPubKey);
                        const walletAccountInfo=await connection.getAccountInfo(wallet.publicKey);
                        console.log('Wallet data size ',walletAccountInfo?.data.length);
                        
                        const receiverAccountInfo=await connection.getAccountInfo(destKey);
                        console.log('Receiver Wallet data size ',receiverAccountInfo?.data.length);
                        
                        const instruction=solanaWeb3.SystemProgram.transfer({
                            fromPubkey:wallet.publicKey,
                            toPubKey:destKey,
                            lamports:lamports
                        });
                        let trans=await setWalletTransaction(instruction,connection);
                        let signature=await signAndSendTransaction(wallet,trans,connection);
                        let result=await connection.confirmTransaction(signature,'singleGossip');
                        console.log('Money Send',result);
                        
                    }catch(err){
                        console.log(err);
                    }
                })();
                
                async function setWalletTransaction(instruction,connection){
                    const transaction=new solanaWeb3.Transaction();
                    transaction.add(instruction);
                    transaction.feePayer=wallet.publicKey;
                    let hash=await connection.getRecentBlockhash();
                    console.log('blockhash',hash);
                    transaction.recentBlockhash=hash.blockhash;
                    return transaction;
                }
                
                async function signAndSendTransaction(wallet,transaction,connection){
                    const {signature}=await window.solana.signAndSendTransaction(transaction);
                    await connection.confirmTransaction(signature);
                    
                    console.log('sign transaction');
                    console.log('send raw transaction');
                    return signature;
                }
            }
        })
    </script>

</body>

</html>