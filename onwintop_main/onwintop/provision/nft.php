<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provision - Tellselling</title>
    <?php include "header.php"; ?>
    <style>
        .overall-text {
            color: #000000;
        }
        .overall-loading {
            color: #a1a1a1;
            cursor: not-allowed;
        }
        .card-body {
            padding-left: 8px !important;
            padding-right: 8px !important;
            padding-top: 8px !important;
            padding-bottom: 0px !important;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat !important;
        }
        .detail-text {
            text-shadow: 2px 2px 2px #464646;
        }
        .detail {
            background-image: url(<?php echo $_ENV['project_url'];?>provision/shade.png) !important;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-3 leftpanel px-5 py-5">
            <h1 class='mt-5' style="font-weight:500;color:#f6f6f6;">Welcome to Tellselling</h1>
            <h5 class='mt-4 mb-5' style="font-weight:500;color:#f4f4f4;">Just a few simple steps to get your profile up and running</h5>
            <div class="row pt-5 text-white" style='border-left:1px solid #ffffff;'>
                <div class="col-md-1" style='display:flex;align-items:center'>
                    <h5 class="fa-sharp fa-solid fa-circle-check"></h5>
                </div>
                <div class="col-md-11">
                    <h5 style='margin-left:16px'>Account Details</h5>
                </div>
            </div>
            <div class="row text-white mt-3" style='border-left:1px solid #ffffff;'>
                <div class="col-md-1" style='display:flex;align-items:center'>
                    <h5 class="fa-sharp fa-solid fa-circle-check"></h5>
                </div>
                <div class="col-md-11">
                    <h5 style='margin-left:16px'>Theme</h5>
                </div>
            </div>
            <div class="row text-white mt-3" style='border-left:1px solid #ffffff;'>
                <div class="col-md-1" style='display:flex;align-items:center'>
                    <h5 class="fa-sharp fa-solid fa-circle-check"></h5>
                </div>
                <div class="col-md-11">
                    <h5 style='margin-left:16px'>NFT & Gift Card</h5>
                </div>
            </div>
            <div class="container_ mt-5 pt-5">
                <p class='text-white'>Copyright &copy; 2023 Tellselling Ltd 86-90 Paul Street, London, EC2A 4NE, United Kingdom All rights reserved. Powered by Tellselling.</p>
            </div>
        </div>
        <div class="col-md-9 rightpanel pt-5">
            <div class="row pt-4 pb-5">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h4>Power your gamified space with branded rewards</h4>
                    <p id='overall' class='overall-text' style="font-size:18px;text-align:justify">
                        I want a
                        <select class="nft-input" style="outline: none;border:none;border-bottom:1px solid #a1a1a1;padding-left:10px;padding-right:10px;margin-left:10px;margin-right:10px;text-align:center;">
                            <option>NFT</option>
                            <option>Gift Card</option>
                        </select>
                        <span class='nft-template'>
                            with a name as
                            <input id='nft_name' type='text' style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:120px;text-align:center;" />
                            to reward my gamified space, it should have keywords
                            <input id='nft_keyword' type='text' style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:auto;text-align:center;" /> in its description,
                            it should use a picture contains
                            <input id='nft_description' type='text' style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:200px;text-align:center;" /> or just use (upload) as its picture.
                        </span>
                        <span class="giftcard-template" style='display:none'>
                            with a name as <input type='text' style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:120px;text-align:center;" />
                            to reward my gamified space, it should have values as <input type='text' class='amount' style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:120px;text-align:center;" id='gift_amount'/> EURO and it can be redeemed in these brands
                            <input type='text' style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:120px;text-align:center;"  id='gift_name'/> (e.g, Amazon, Spotify, Airnob etc).
                        </span>
                    </p>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row pt-4 pb-5 nft-sug">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="row" id='suggestion-label' style='display:none'>
                        <div class="col-md-6">
                            <h4>Suggestions</h4>
                        </div>
                        <div class="col-md-6" style="display:flex;justify-content:right;">
                            <input type="checkbox" style="display:none" name="" id="">
                        </div>
                    </div>
                    <div class="row" id='shimmer' style="display:none">
                        <div class="col-md-4">
                            <img src="<?php echo $_ENV['project_url'];?>provision/shimmer.gif" style="width:100%;height:auto" alt="" srcset="">
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo $_ENV['project_url'];?>provision/shimmer.gif" style="width:100%;height:auto" alt="" srcset="">
                        </div>
                        <div class="col-md-4">
                            <img src="<?php echo $_ENV['project_url'];?>provision/shimmer.gif" style="width:100%;height:auto" alt="" srcset="">
                        </div>
                    </div>
                    <div class="row" id='suggestion' style='display:none'>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
        <div class='operation-holder'>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9 operation-board">
                    <div class="row p-2">
                        <div class="col-md-3">
                            <a href='<?php echo $_ENV['project_url']."choose-theme?data=".$_GET['data'];?>' class="btn btn-outline-secondary"><i class="fa fa-long-arrow-left"></i> &nbsp; &nbsp; &nbsp; Back</a>
                        </div>
                        <div class="col-md-6 text-center" style="display:flex;justify-content:center;align-items:center;">
                            <a href='<?php echo $_ENV['project_url']."provision-success?data=".$_GET['data'];?>' style="text-decoration:none" class='text-secondary'>Skip for now</a>
                        </div>
                        <form id='payment' action='payment.php' method='GET' class="col-md-3" style="justify-content:right;display:flex;">
                            <input type="hidden" name="details" value="" id='details'>
                            <span type="submit" id='continue' style="background-color: var(--theme);color:#ffffff;border:none;" class="btn btn-outline-secondary">Continue &nbsp; &nbsp; &nbsp;<i class="fa fa-long-arrow-right"></i> </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        
        var images = [];
        var text = "";
        var name = "";
        
        $('#nft_keyword').on('change', function() {
            
            var query = $('#nft_keyword').val();
            
            $('#shimmer').show();
            $('#suggestion-label').show();
            $('#suggestion').hide();
            name = $('#nft_name').val();
            var url = "https://organic-service-371417.de.r.appspot.com/chatgpt";
            $('#overall').addClass('overall-loading');
            $('#overall').removeClass('overall-text');
            $.ajax({
                url,
                method: 'POST',
                data: {
                    query
                },
                success: function(data) {
                    $('#shimmer').hide();
                    response = JSON.parse(data);
                    text = response.text[0].text;
                    images = response.images;
                    renderNFT();
                    $('#overall').removeClass('overall-loading');
                    $('#overall').addClass('overall-text');
                    $('#nft_description').val(text);
                }
            })
        })
        function renderNFT() {
            $('.nft-sug').show();
            element = "";
            images.forEach((data, key) => {
                element += '<div class="col-md-4"><div class="card"><div class="card-body" style="border-radius:5px;background-image: url(' + data.url + ');"><div class="row" style="height:20px"><div class="col-md-1"><input style="height:20px" class="form-check-input nft-img" data-image="'+data.url+'" type="checkbox" name="suggestions"></div><div class="col-md-11"></div></div><div class="row detail align-items-end pb-3" style="height:190px;"><div class="col-md-12"><h5 class="text-white detail-text" style="text-transform: capitalize;">' + name + '</h5><small class="text-white detail-text two-line">' + text + '</small></div></div></div></div></div>';
            })
            $('#suggestion').html(element);
            $('#suggestion').show();
        }
        var nft_assets=[];
        $('#suggestion').delegate('.nft-img','change',function(){
            var img=$(this).attr('data-image');
            if(nft_assets.includes(img)){
                var index = nft_assets.indexOf(img);
                if (index > -1) { 
                  nft_assets.splice(index, 1); 
                }
            }else{
                nft_assets.push(img);
            }
        })
        $('#continue').on('click',function(){
            type=$('.nft-input').val();
            if(type=='NFT'){
                var obj={
                    title:$('#nft_name').val(),
                    keyword:$('#nft_keyword').val(),
                    description:$('#nft_description').val(),
                    assets:nft_assets,
                    type:'NFT'
                }
                var data=JSON.stringify(obj);
                window.location='<?php echo $_ENV['project_url'].'payment?data='.$_GET['data'].'&&payment=';?>'+btoa(data);
            }else{
                var obj={
                    type:'Gift Card',
                    amount:$('#gift_amount').val()
                }
                var data=JSON.stringify(obj);
                window.location='<?php echo $_ENV['project_url'].'payment?data='.$_GET['data'].'&&payment=';?>'+btoa(data);
            }
        })
        $('#upload_btn').click(function() {
            $('#upload_logo').click();
        })
        $('.nft-input').on('change', function(type) {
            var type = $('.nft-input').val();
            if (type == 'NFT') {
                $('.giftcard-template').hide();
                $('.nft-template').show();
                $('.nft-sug').hide();
            } else {
                $('.giftcard-template').show();
                $('.nft-sug').hide();
                $('.nft-template').hide();
            }
        })

        $('#payment').on('submit',function(e){
            e.preventDefault();
            type=$('#nft-input').val();
            if (type == 'NFT') {
                data=btoa('2.93');
                $('#amount').val(data);
            } else {
                data=$('.amount').val();
                data=btoa(data);
                $('#amount').val(data);
            }
            $('#payment')[0].submit();
        })

        //Gift Card Handle

        $('#gift_name').on('change',function(){
            $('#shimmer').show();
            $('.nft-sug').show();
            $('#suggestion-label').show();
            $('#suggestion').hide();
            var name=$('#gift_name').val();
            var url="https://app-dev.onwintop.com/api/load_gifts.php?name="+name;
            $.ajax({
                url:url,
                method:'GET',
                success:function(data){
                    $('#shimmer').hide();
                    var response=JSON.parse(data);
                    console.log(data);
                    element = "";
                    denoms="";
                    var c=0;
                    for(c;c<6;c++) {
                        data=response[c];
                        if(data!=null){
                            element += '<div class="col-md-4 mb-3"><div class="card"><div class="card-body" style="border-radius:5px;background-image: url(' + data.image_url + ');"><div class="row" style="height:20px"><div class="col-md-1"><input style="height:20px" class="form-check-input nft-img" data-image="'+data.image_url+'" type="checkbox" name="suggestions"></div><div class="col-md-11"></div></div><div class="row detail align-items-end pb-3" style="height:130px;"><div class="col-md-12"><h5 class="text-white detail-text" style="text-transform: capitalize;">' + data.name + '</h5><small class="text-white detail-text two-line">' + data.code + '</small></div></div></div></div></div>';
                        }
                    }
                    $('#suggestion').html(element);
                    $('#suggestion').show();
                }
            })
        });
        $('#gift_amount').on('change',function(){
            $('#shimmer').show();
            $('.nft-sug').show();
            $('#suggestion-label').show();
            $('#suggestion').hide();
            var url="https://app-dev.onwintop.com/api/load_gifts.php";
            $.ajax({
                url:url,
                method:'GET',
                success:function(data){
                    $('#shimmer').hide();
                    var response=JSON.parse(data);
                    console.log(data);
                    element = "";
                    denoms="";
                    var c=0;
                    for(c;c<6;c++) {
                        data=response[c];
                        if(data!=null){
                            element += '<div class="col-md-4 mb-3"><div class="card"><div class="card-body" style="border-radius:5px;background-image: url(' + data.image_url + ');"><div class="row" style="height:20px"><div class="col-md-1"><input style="height:20px" class="form-check-input nft-img" data-image="'+data.image_url+'" type="checkbox" name="suggestions"></div><div class="col-md-11"></div></div><div class="row detail align-items-end pb-3" style="height:130px;"><div class="col-md-12"><h5 class="text-white detail-text" style="text-transform: capitalize;">' + data.name + '</h5><small class="text-white detail-text two-line">' + data.code + '</small></div></div></div></div></div>';
                        }
                    }
                    $('#suggestion').html(element);
                    $('#suggestion').show();
                }
            })
        });
        
    })
</script>

</html>