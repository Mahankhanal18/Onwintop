<!DOCTYPE html>
<html lang="en">
<?php 
$cred=json_decode($_SESSION['community_credentials'],true);
//print_r($cred);
$email=$cred['email'];
$c=R::findOne("members","email=?",[$email]);


?>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Torus Wallet Integration</title>
</head>

<body>
    <div>
        
        <center>
            <p id="text">Loading...</p>
            <p id="error"></p>
            <button id="login" class='btn btn-outline-primary'>Connect Now</button>
            
        </center>
        
        <div class='container wallet' style='display:none'>
                    <div class="uk-child-width-1-2@s" uk-grid>

                        <ul data-uk-tab="{connect:'#my-wallet'}" class="uk-tab-right" uk-tab style="width:20%">
                            <li class="uk-active"><a style='font-size:16px' href="#">My Wallet</a></li>
                            <li><a style='font-size:16px' href="#">Exchange</a></li>
                            <li><a style='font-size:16px' href="#">Transfer</a></li>
                        </ul>
                        <ul id="my-wallet" class="uk-switcher uk-margin" style="width:80%">
                            <li style="padding:0px">
                                <div style='width:100%'>
                                    <div style='width:100%;background-image:linear-gradient(90deg,#3596dc,#ca3c95);padding:20px;border-radius:8px'>
                                        <h6 class='text-white'><b>My Wallet</b></h6>
                                        <p class='text-white'>Welcome, <b id='name'></b> </p>
                                        <h4 class='text-white'>Balance : <b><?php echo $c['coins'];?></b> UtilityTokens</h4>
                                        <h6 class='text-white'>Wallet Address : <small id='address'>######</small></h6>
                                    </div>
                                    <div style='width:100%;background-color:#ffffff;padding-bottom:100px;padding:20px'>
                                        <div class='row' id='nft_holders'>
                                        <?php
                                            $nfts=R::findAll("nftcontents","email=?",[$email]);
                                            foreach($nfts as $nft){
                                                echo "
                                                <div class='col-md-4 mb-2'>
                                                    <div class='card p-1'>
                                                        <img src='".$nft['preview']."' style='height:140px;object-fit:contain;object-position:center;width:100%' />
                                                        <center><b>".$nft['name']."</b></center>
                                                    </div>
                                                </div>
                                                
                                                ";
                                            }
                                            if(count($nfts)==0){
                                                echo "<h6><b>Your wallet is empty</b></h6>";
                                            }
                                        ?>
                                        </div>
                                        
                                        <button style='float:right;' id="logout" class='btn btn-outline-danger' style="display:none">Logout</button>
                                    </div>
                                </div>
                            </li>
                            <li style="padding:0px">
                                <div style='width:100%'>
                                    <div style='width:100%;background-image:linear-gradient(90deg,#3596dc,#ca3c95);padding:20px;border-radius:8px'>
                                        <h6 class='text-white'><b>Exchange</b></h6></br>
                                    </div>
                                    <div style='width:100%;background-color:#ffffff;padding:20px'>
                                        <div class='form-group'>
                                            <label>You exchange</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" id='amount-ex' placeholder="Enter Amount" aria-label="Enter Amount" aria-describedby="basic-addon2">
                                              <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">ETH</span>
                                              </div>
                                            </div>
                                        </div>
                                        <center><h4><i class="fa fa-exchange" aria-hidden="true"></i></h4></center>
                                        <div class='form-group'>
                                            <label>You Receive</label>
                                            <div class="input-group mb-3">
                                              <input type="text" class="form-control" id='coin-ex' placeholder="Enter Coin" aria-label="Enter Coin" aria-describedby="basic-addon2">
                                              <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Coins</span>
                                              </div>
                                            </div>
                                        </div>
                                        <div class='form-group' style='padding-bottom:100px'>
                                            <button style='float:right;margin-top:20' onclick="alert('In sufficient balance');" class='btn btn-outline-primary'>Procceed</button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li style="padding:0px">
                                <div style='width:100%'>
                                    <div style='width:100%;background-image:linear-gradient(90deg,#3596dc,#ca3c95);padding:20px;border-radius:8px'>
                                        <h6 class='text-white'><b>Transfer</b></h6></br>
                                    </div>
                                    <div style='width:100%;background-color:#ffffff;padding:20px'>
                                        <small>You have insufficient balance to transfer</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

        </div>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@toruslabs/torus-embed"></script>
    <script src="https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.34/dist/web3.js"></script>
    <script>
    
        (async function init() {
            $("#login").hide();
            $("#logout").hide();

            //exchange 
            amount=0;
            coin=0;
            function exchange(){
                $('#coin-ex').val(coin);
                $('#amount-ex').val(amount);
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
                console.log(user);
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
            loadNFTs(address)
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
        loadNFTs('0x1ff35c96719aaf6add04848b05717ebf1b5c5820');
        function loadNFTs(address){
            //https://app-dev.onwintop.com/api/fetch-nfts.php?email=
            /*$.ajax({
                url:'https://eth-goerli.g.alchemy.com/v2/RvnYQYXR3ybTnD1VngD_bwPhnQq1t-0n/getNFTs/?owner='+address,
                method:'GET',
                success:function(data){
                    console.log(data);
                    elements="";
                    data.ownedNfts.forEach((val,index)=>{
                        elements+="<div class='col-md-4 mb-2'><div class='card p-1'><img src='"+val.metadata.image+"' style='height:140px;object-fit:contain;object-position:center;width:100%' /><center><b>"+val.metadata.name+"</b></center></div></div>";
                    })
                    $('#nft_holders').html(elements);
                }
            })*/
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

        $("#login").click(function (event) {
            window.torus
                .login()
                .then(function () {
                    return initWeb3();
                })
                .then(function () {
                    return window.torus.getUserInfo();
                })
                .then(function (user) {
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
        });

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