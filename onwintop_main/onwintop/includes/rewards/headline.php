<style>
    .chosen-container-single .chosen-single {
        position: relative;
        display: block;
        width:100%;
        overflow: hidden;
        height: 37px;
        padding: 6px;
        border: 1px solid #d3d8dd;
        border-radius: 4px;
        background-color: #fff;
        color: #444;
        text-decoration: none;
        white-space: nowrap;
        line-height: 24px;
    }
</style>
<div action='' method='post' style='color:#646464;'>
    
    <h3 class='mt-2'>Rewards</h3>
    <p class='mb-4'>New Reward</p>
    
    <ul uk-tab>
        <li class="active-step"><a style='text-transformation:capitalize' href="#">1. Fulfilment &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>> </a></li>
        <li class="active-step"><a style='text-transformation:capitalize' href="#">2. Headline &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>> </a></li>
        <li class=""><a style='text-transformation:capitalize' href="#">3. Redeeming &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>> </a></li>
        <li class=""><a style='text-transformation:capitalize' href="#">4. Eligibility &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </a></li>
    </ul>    
    
    <div class='form-group'>
        <p>This is the information that will be displayed on the advocate. Make sure that you fill in a good description including charity name if it's a charity type. Uploading a picture is also a great way to highlight to the advocate what this reward is all about. </p>
    </div>
    <div class='my-3 silver' style='margin-top:10;margin-bottom:10;border:1px solid #ebebeb;padding:15px'>
        <div class='row'>
            <div class='col-md-6'>
                <div class='form-form'>
                    <label>Name : <span class='text-danger'>*</span> </label>
                    <input type='text' class='form-control' id='headline_name'/>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='form-form'>
                    <label>Type : <span class='text-danger'>*</span></label>
                    <select class='form-control' id='headline_type'/>
                        <option>Choose one...</option>
                        <option>Test Reward 1</option>
                        <option>Test Reward 2</option>
                        <option>Test Reward 3</option>
                    </select>
                    <small><a id='manage-reward-types' class='text-primary'>Manage Types</a></small>
                </div>
            </div>
            <div class='col-md-12 mt-2'>
                <label>Description <span class='text-danger'>*</span>:</label>
                <textarea class='form-control' id='headline_description' row='3'></textarea>
            </div>
            <div class='col-md-6 mt-2'>
                <div class='form-form'>
                    <label>Amount : <span class='text-danger'>*</span> </label>
                    <input type='text' class='form-control' id='amount'/>
                </div>
            </div>
        </div>
    </div>
    <div class='my-3 silver' style='margin-top:10;margin-bottom:10;border:1px solid #ebebeb;padding:15px'>
        <p><i>The width of your image should be 250px or larger. Images will be resized to fit the rewards catalog. Maximum file size : 5 MB</i></p>
        <img src='https://www.themandarin.com.au/wp-content/uploads/2016/01/HiRes.jpg' id='thumbnail-preview' style='width:250px;height:auto;object-position:center;object-fit:cover;'/>
        <b class='my-2 text-success' style='display:none' id='uploading'>Uploading...</b>
        <button id='thumbnail_btn' class='btn btn-outline-primary'>Choose Image</button>
        
        <input type='file' id='thumbnail_uploader' style='display:none'/>
        <input type='hidden' name='thumbnail' id='thumbnail' value='https://www.themandarin.com.au/wp-content/uploads/2016/01/HiRes.jpg'/>
    </div>
    <div class='my-3 silver' style='margin-top:10;margin-bottom:10;border:1px solid #ebebeb;padding:15px'>
        <h5><b>Feature this reward</b></h5>
        <div class='form-group mt-4'>
            <input type='checkbox' id='feature' class='mr-2' name='feature'/>
            <label for='feature'>Featured rewards will be listed first in the Reward tab </label>
        </div>
    </div>
    <div class='my-3 silver' style='margin-top:10;margin-bottom:10;border:1px solid #ebebeb;padding:15px'>
        <h5><b>Reward Disclaimer</b></h5>
        <p class='mt-2'>Hide or override the default reward disclaimer set in the <a class='text-primary'>disclaimer setting page</a></p>
        <div class='form-group mt-4'>
            <input type='radio' name='disclaimer' class='mr-2' value='default' id='default-disclaimer' checked='true'>
            <label for='default-disclaimer'>Use default disclaimer</label>
        </div>
        <div class='form-group'>
            <input type='radio' name='disclaimer' class='mr-2' value='hide' id='hide-disclaimer'>
            <label for='hide-disclaimer'>Hide disclaimer</label>
        </div>
        <div class='form-group'>
            <input type='radio' name='disclaimer' class='mr-2' value='custom' id='custom-disclaimer'>
            <label for='custom-disclaimer'>Use a custom disclaimer</label>
        </div>
    </div>
    <div class='form-group'>
        <button class='btn btn-primary' id='headline'>Save Reward</button>
    </div>
    
</div>

<div class="modal fade" id="reward-types" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style='max-width:700px' role="document">
    <div class="modal-content" style='border-radius:0px;color:#646464'>
      <div class="modal-body">
        <div class='row'>
            <div class='col-md-8'>
                <h5 style="font-weight:300">Reward Type</h5>
            </div>
            <div class='col-md-4'>
                <button class='btn btn-primary' id='new-type' style='float:right'>Add Reward Type</button>
            </div>
        </div>
        <p class='mt-1'>Organize your rewards for advocates by using reward types. Rewards will be grouped by the type in the advocate rewards area helping advocates quickly find a rewards that's best for them. </p>
        <table class='table'>
            <thead>
                <tr>
                    <th>Reward Type</th>
                    <th>Rewards</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody id='type_table'>
                <tr>
                    <td class='text-primary'><b>Test Reward 1</b></td>
                    <td>1</td>
                    <td class='text-secondary'>Test Description</td>
                </tr>
                <tr>
                    <td class='text-primary'><b>Test Reward 2</b></td>
                    <td>1</td>
                    <td class='text-secondary'>Test Description</td>
                </tr>
                <tr>
                    <td class='text-primary'><b>Test Reward 3</b></td>
                    <td>1</td>
                    <td class='text-secondary'>Test Description</td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="add-type" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style='max-width:500px' role="document">
    <div class="modal-content" style='border-radius:0px;color:#646464'>
      <div class="modal-body">
        <div class='row'>
            <form id='type-form' class='col-md-12'>
                <h5 style="font-weight:300;border-bottom:1px solid #ebebeb;">Add Reward Type</h5>
                <div class='form-group mt-4'>
                    <label>Name <span class='text-danger'>*</span></label>
                    <input id='type_name' type='text' class='form-control' required/>
                </div>
                <div class='form-group mt-2'>
                    <label>Description <span class='text-danger'>*</span></label>
                    <textarea id='type_description' class='form-control' row='3' required></textarea>
                </div>
                <div class='form-group mt-2'>
                    <button id='type-save' class='btn btn-primary'>Save</button>
                </div>
            </form>
        </div>
       
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>


