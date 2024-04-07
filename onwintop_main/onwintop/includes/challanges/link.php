<style>
    #share-buttons img{
        height:30px !important; 
        width: auto;
        margin-top:15px;
    }
    #link-img:hover{
        cursor:pointer;
    }
</style>
<h5 class='pb-2'>Create a social post for members to share</h5>
<div class='row pb-3 link-1'>
    <div class='col-md-6'>
        <div class='card'>
            <div class='card-body'>
                <h5>Text</h5></br>
                <p>You can prefil the post with default text for members to modify before sharing.</p>
                <b>Default Share Text</b>
                <textarea style="width:100%;background-color:#fff;border-radius:0px" rows='5' id='share_text' placeholder="Replace this with your own message about the introduction to AdvocateHub course"></textarea>
                <input type='checkbox' id='verify'/> 
                <label for='verify'>Minimum character count required for members to share</label>
            </div>
        </div>
        
        <div class='card mt-3'>
            <div class='card-body'>
                <h5>Link</h5></br>
                <p>Provide a link for members to share. A preview with the webpage's metadata will be rendered in the challenges as well as on the posts shared by members. The link will be shortened for you.</p>
                <b>Link URL</b>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id='url' placeholder="Enter URL with https://"  aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <span class="input-group-text btn btn-outline-primary btn-sm" id="process_preview">Update Preview</span>
                  </div>
                </div>
                <small class='text-secondary'>NoteL this link will be transformed into an infl.tv link. For now, there is a placeholder in the preview but the real link (which can be upto 26) will be generated after you save. <a>Learn why</a></small>
            </div>
        </div>
        
        <div class='card mt-3'>
            <div class='card-body' id='link-img'>
                <img id='social-img' style='margin-bottom:20px;width:50%;height:auto;display:none;border:2px solid #ebebeb;'>
                <table style='width:100%;border:none'>
                    <tr>
                        <td class='p-2'>
                            
                            <i style='font-size:35px' class="fa fa-file-image"></i>
                        </td>
                        <td class='social-uploader'>
                            
                            <b>Add an image</b></br>
                            <small>Provide an image for members to share on their network</small></br>
                            <b class='text-success' id='loading' style='display:none'>Uploading...</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <input type='file' accept='.png,.jpg,.gif' style='display:none' id='upload-link-img'>
        
    </div>
    <div class='col-md-6'>
        <h5>Share Preview</h5></br>
        <p>Switch between the networks to see a rough preview that your members will end up sharing to each platform.</p>
        <div class='card'>
            <div class='card-body'>
                <iframe src='../social-preview' id='social-preview' style="width:100%;height:300px"></iframe>
            </div>
        </div>
        
        <div class="alert alert-primary mt-3">
            <table style='width:100%;border:none'>
                <tr>
                    <td class='p-2 text-primary' valign='top'>
                        <i style='font-size:20px' class="fa fa-info-circle"></i>
                    </td>
                    <td>
                        <b>Posts may appear slightly different in this preview than when posted</b>
                        <p>Social networks regularly make updates to their platform and each handles data uniquely. Please note that only Twitter and LinkedIn support sharing emojis.</p>
                        <p><a href='#'>Learn More</a></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <span class='btn btn-primary mt-2' id='link-next'>Next</span>
</div>
<div class='row pb-3 link-2' style="display:none">
    <div class='col-md-12'>
        <div class='card'>
            <div class='card-body'>
                
                <center>
                <b>Share this</b></br>
                <img src='https://via.placeholder.com/728x490.png?text=Preview%20Placeholder' style="width:50%;height:auto"/>
                
                <div id="share-buttons">

                    <!-- Facebook -->
                    <a href="http://www.facebook.com/sharer.php?u=<?php echo $u; ?>" target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                    </a>

                    <!-- LinkedIn -->
                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url<?php echo $u; ?>" target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
                    </a>

                    <!-- Twitter -->
                    <a href="https://twitter.com/share?url=<?php echo $u; ?>&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank">
                        <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                    </a>


                </div>
                </center>
            </div>
        </div>
    </div>
    <span class='btn btn-primary mt-2' id='link-save'>Save</span>
</div>


<script>
    $(document).ready(function(){
        var text,url;
        var social_img='https://via.placeholder.com/600x400.png?text=Thumbnail+Image';
        $('#link-next').click(function(){
            $('.link-1').hide();
            $('.link-2').show();
        })
        $('#link-save').click(function(){
            text=$('#share_text').val();
            url=$('#url').val();
            var d={
                share_text:text,
                url
            };
            var data=JSON.stringify(d);
            $('#challenge_data').val(data);
            $('#challenge_type').val('link');
            $('#create-data')[0].submit();
        })
        $('#link-img').click(function(){
            $('#upload-link-img').click();
        })
        $('#upload-link-img').on('change', function() {
                thumbnail = $('#upload-link-img')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('#loading').show();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        social_img=thumbnail_url;
                        $('#social-img').attr('src',thumbnail_url);
                        $('#social-img').show();
                        $('#loading').hide();
                    }
                })
            })
            
        $('#process_preview').click(function(){
            share_text=$('#share_text').val();
            url=$('#url').val();
            if(share_text.length!=0 && url.length!=0){
                obj={
                    type:'Facebook',
                    text:$('#share_text').val(),
                    social_img,
                    url:$('#url').val()
                }
                obj=JSON.stringify(obj);
                u='../social-preview/'+btoa(obj);
                $('#social-preview').attr('src',u);
            }else{
                alertify.error('Please fill the share text and url field');
            }
            
        })
    })
</script>
