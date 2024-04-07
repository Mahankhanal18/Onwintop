<style>
    .silver{
        /*background-image:linear-gradient(350deg, #00000012, transparent);*/
    }
</style>
<div action='' method='post' style='color:#646464;'>
    
    <h3 class='mt-2'>Rewards</h3>
    <p class='mb-4'>New Reward</p>
    
    <ul uk-tab>
        <li class="active-step"><a style='text-transformation:capitalize' href="#">1. Fulfilment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>> </a></li>
        <li class="active-step"><a style='text-transformation:capitalize' href="#">2. Headline &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>> </a></li>
        <li class="active-step"><a style='text-transformation:capitalize' href="#">3. Redeeming &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>> </a></li>
        <li class=""><a style='text-transformation:capitalize' href="#">4. Eligibility &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></li>
    </ul>    
    
    <div class='form-group'>
        <p>Configure how your advocate can earn this reward.</p>
    </div>

    <div class='my-3 silver' style='margin-top:10;margin-bottom:10;border:1px solid #ebebeb;padding:15px'>
        <input type='checkbox' name='redeem-type' class='mr-2' id='rewards-catalog' checked>
        <label for='rewards-catalog' class='ml-2'><b>Add to the Rewards Catalog</b></label>
        <p>If you want your advocates to be able to spend points for this reward, enter it here</p>
        <label>Points required to Redeem</label>
        <input type='number' id='coin' style='width:100px;padding:5px;border:1px solid #ebebeb;margin-left:5px'/>
    </div>
    
    <div class='my-3 silver' style='margin-top:10;margin-bottom:10;border:1px solid #ebebeb;padding:15px'>
        <input type='checkbox' name='redeem-type' class='mr-2' id='rewards-perk'>
        <label for='rewards-perk' class='mr-2'><b>Award as a Perk</b></label>
        <p>You can make this reward available as perk. Advocates will automatically earn this reward when they meet the conditions below.</br>
            We'll start tracking all new activities completed after the <b>criteria</b> is established.
        </p>
        <!--Types-->
        <div class='form-group'>
            <input type='radio' class='mr-2 data-switch' id='specific-challange-complete' target-expand="expand-1" name='perk' value='specific-challange-complete'>
            <label for='specific-challange-complete'>Completed a specific challange</label>
            <div class='data-detail expand-1 form-group' style='display:none'>
                <label>Select Challange <span class='text-danger'>*</span></label>
                <select>
                    <option selected='selected'>Choose one...</option>
                </select>
            </div>
        </div>
        <div class='form-group'>
            <input type='radio' class='mr-2 data-switch' id='challange-type-complete' name='perk' target-expand="expand-2" value='challange-type-complete'>
            <label for='challange-type-complete'>Completed a type of challange</label>
            <div class='data-detail expand-2 form-group' style='display:none'>
                <label>Select Challange <span class='text-danger'>*</span></label>
                <select id='category' style="width: 100%;border:none" value='["one"]' multiple="multiple" name="tags" required>
                  <option value="one">First</option>
                  <option value="two" disabled="disabled">Second (disabled)</option>
                  <option value="three">Third</option>
                </select>
            </div>
        </div>
        <div class='form-group'>
            <input type='radio' class='mr-2 data-switch' id='event-logged' name='perk' value='event-logged'>
            <label for='event-logged'>Had an event logged</label>
        </div>
        <div class='form-group'>
            <input type='radio' class='mr-2 data-switch' id='point-level' name='perk' value='point-level'>
            <label for='point-level'>Reached a point level</label>
        </div>
        <div class='form-group'>
            <input type='radio' class='mr-2 data-switch' id='manual' name='perk' value='manual'>
            <label for='manual'>Don't award this automatically. I'll award this myself</label>
        </div>
    </div>
    <div class='my-3 silver' style='margin-top:10;margin-bottom:10;border:1px solid #ebebeb;padding:15px'>
        <b class='mb-4'>Shipping Informations</b></br></br>
        <input type='checkbox' name='shipping-info' class='mr-2' id='shipping-info' checked>
        <label for='shipping-info' class='ml-2'>Require advocates to enter their shipping information as part of this redeemtion</label>
    </div>
    <div class='form-group'>
        <button class='btn btn-primary' id='redeem'>Save Reward</button>
    </div>
    
</div>
