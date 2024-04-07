
<style>
    .chosen-single {
        display: none !important;
    }
    select{
        display:inherit !important;
        width:auto !important;
        padding:2px;
        border:1px solid #ebebeb;
        border-radius:5px;
        margin-left:10px;
        margin-right:10px;
    }
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
    .chosen-container{
        display:none !important;
    }
</style>
<div action='' method='post' style='color:#646464;'>
    
    <h3 class='mt-2'>Rewards</h3>
    <p class='mb-4'>New Reward</p>
    
    <ul uk-tab>
        <li class="active-step"><a style='text-transformation:capitalize' href="#">1. Fulfilment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>> </a></li>
        <li class=""><a style='text-transformation:capitalize' href="#">2. Headline &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>> </a></li>
        <li class=""><a style='text-transformation:capitalize' href="#">3. Redeeming &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>> </a></li>
        <li class=""><a style='text-transformation:capitalize' href="#">4. Eligibility &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></li>
    </ul>    
    
    <h5 style="color:##646464;">Fulfilment</h5>
    <div class='form-group mt-4' style="border-bottom:1px solid #ebebeb;">
        <input type='checkbox' name='approval' class='mt-2' id='approval'/>
        <label for='approval' class='ml-2'>Administrator Approval Required</label>
    </div>
    <div class='form-group'>
        <input name='category' value='manual' class='mr-2 manual-type' id='cat1' type='radio' checked='true'>
        <label for='cat1'>Manual</label></br>
        <small style='color:#a1a1a1;'><i>Can be anything that you decide, including free support hours, ticket to an event or a dinner with the CEO</i></small>
    </div>
    <div class='form-group'>
        <input name='category' value='wallet' class='mr-2 nft-type' id='cat2' type='radio'>
        <label for='cat2'>Web 3.0 Wallet/Gift Card</label></br>
        <small style='color:#a1a1a1;'><i>Can be anything that you decide, including free support hours, ticket to an event or a dinner with the CEO</i></small>
    </div>
    
    <div class='form-group nft-wallet' style='display:none'>
        <div class='nft-holder mt-5 p-4' style='width:100%;border:1px solid #ebebeb;'>
            <small class='text-danger'><?php if(strlen($wallet)==0) echo "You need to connect to your wallet to create NFTs.";?></small>
            <p id='overall' class='overall-text' style="font-size:18px;text-align:justify;display:inline;">
                <b>I want a</b>
                    <select class='nft-input'>
                        <option <?php if(strlen($wallet)==0) echo "disabled";?>>NFT</option>
                        <option>Gift Card</option>
                    </select>
                <b class='nft-template'>
                   with a name as
                    <input id='nft_name' type='text' style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:120px;text-align:center;" />
                    to reward my gamified space, it should have keywords
                    <input id='nft_keyword' type='text' style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:auto;text-align:center;" /> in its description,
                    it should use a picture contains
                    <b id='nft_description' type='text' style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:200px;text-align:center;" contenteditable='true'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> or just use (upload) as its picture.
                </b>
                
                <b class="giftcard-template" style='display:none'>
                    with a name as <input type='text'  style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:120px;text-align:center;" />
                    to reward my gamified space, it should have values as <input type='text' class='amount' style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:120px;text-align:center;" id='gift_amount'/> EURO and it can be redeemed in these brands
                    <input type='text' class='typeahead' data-provide="typeahead" style="outline: none;border:none;border-bottom:1px solid #a1a1a1;font-size:18px;width:120px;text-align:center;"  id='gift_name'/> (e.g, Amazon, Spotify, Airnob etc).
                </b>
            </p>
            
            <div class="row pt-4 pb-5 mt-2 nft-sug">
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
            </div>
        </div>

    </div>
    

    
    <div class='form-group'>
        <button class='btn btn-primary' id='fulfilment'>Save Reward</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script>
    $(document).ready(function(){
        
        var $testinput = $(".typeahead");
        $testinput.typeahead({
            source: ['Amazon','Airbnb','Apple','BitCard','Coinbase','eBay','Google play','H&M','Hotels.com','Hulu','Playstation store','Roblox','Spotify','Starbuck','Subway','Twitch','Uber','Xbox'],
            autoSelect: true,
        });

        $testinput.change(function() {
            var current = $testinput.typeahead("getActive");
            matches = [];
            if (current) {
                if (current.name == $testinput.val()) {
                    matches.push(current.name);
                }
            }
        });
        
        
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
                    $('#nft_description').html(text);
                }
            })
        })
        function renderNFT() {
            $('.nft-sug').show();
            element = "";
            images.forEach((data, key) => {
                element += '<div class="col-md-4"><div class="card"><div class="card-body" style="border-radius:5px;background-image: url(' + data.url + ');"><div class="row" style="height:20px"><div class="col-md-1"><input style="height:20px;margin:8px" class="form-check-input nft-img" data-image="'+data.url+'" type="checkbox" name="suggestions"></div><div class="col-md-11"></div></div><div class="row detail align-items-end pb-3" style="height:190px;"><div class="col-md-12"><h5 class="text-white detail-text" style="text-transform: capitalize;">' + name + '</h5><small class="text-white detail-text two-line">' + text + '</small></div></div></div></div></div>';
            })
            $('#suggestion').html(element);
            $('#suggestion').show();
        }
        
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
        $('#gift_name').on('change',function(){
            $('#shimmer').show();
            $('.nft-sug').show();
            $('#suggestion-label').show();
            $('#suggestion').hide();
            var name=$('#gift_name').val();
            var url="https://app-dev.onwintop.com/api/load_gift_products.php?brand="+name;
            $.ajax({
                url:url,
                method:'GET',
                success:function(data){
                    $('#shimmer').hide();
                    response=JSON.parse(data);
                    element = "";
                    denoms="";
                    var c=0;
                    for(c;c<6;c++) {
                        data=response[c];
                        if(data!=null){
                            element += '<div class="col-md-4 mb-3"><div class="card"><div class="card-body" style="border-radius:5px;background-image: url(' + data.image_url + ');"><div class="row" style="height:20px"><div class="col-md-1"><input style="height:20px;margin:8px;" class="form-check-input nft-img" data-image="'+data.image_url+'" type="checkbox" name="suggestions"></div><div class="col-md-11"></div></div><div class="row detail align-items-end pb-3" style="height:130px;"><div class="col-md-12"><h5 class="text-white detail-text" style="text-transform: capitalize;">' + data.name + '</h5><small class="text-white detail-text two-line">' + data.code + '</small></div></div></div></div></div>';
                        }
                    }
                    $('#suggestion').html(element);
                    $('#suggestion').show();
                }
            })
        });
        $('select').niceSelect('update')
    })
    </script>
        
    
</div>
