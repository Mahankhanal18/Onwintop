<h5 class='pb-2'>Advocate workflow</h5>
<div class='pb-3 card'>
    <div class='row advocate-1 card-body'>
        <div class='col-md-6'>
            <div class='form-group'>
                <label>Headline</label>
                <input type='text' class='form-control' id='headline'/>
            </div>
            <div class='form-group'>
                <label>Description</label>
                <textarea rows='3' class='form-control' id='description'></textarea>
            </div>
        </div>
        <div class='col-md-6'>
            <div class='form-group'>
                <input type='checkbox' id='duration'>
                <label for='duration'>Has to stay on the challenge longer than ____ seconds</label>
                </br>
                <input type='checkbox' id='click'>
                <label for='click'>Has to clicked on objects on the challenge</label>
                </br>
                <input type='checkbox' id='upload'>
                <label for='upload'>Has to upload an images as proof of complition</label>
            </div>
        </div>
        <div class='col-md-12'>
            <label>Upload an image or video:</label>
            <div class='card'>
                <div class='card-body' style='border:1px bordered #aaaaaa' valign='center'>
                    </br></br>
                    <center class='content-upload'>
                        <h5>Upload an image or video</h5>
                        <small>No file uploaded</small></br>
                        <span class='btn btn-outline-primary mt-2 mb-2' id='content-btn'>Upload an image or video</span></br>
                        <input type='file' style='display:none' id='content'/>
                        <small>Supported formats : png, jpg, jpeg, mp4 or gif</small>
                        
                    </center>
                    <center><b class='uploading text-success' style='display:none'>Uploading...</b></center>
                    <center class='content-uploaded' style='display:none'>
                        <h5>Content Uploaded</h5>
                        <div class='row mt-5' style='width:300px'>
                            <div class='col-6'>
                                <a id='preview-content' target='_blank' href='#' class='btn btn-outline-primary'>Preview</a>
                            </div>
                            <div class='col-6'>
                                <a id='replace-content' class='btn btn-danger text-white'>Replace</a>
                            </div>
                        </div>
                    </center>
                    </br></br>
                    
                </div>
            </div>
        </div>
        <div class='col-md-2'>
            <button id='save-advocate' class='mt-3 btn btn-primary'>Save</button> 
        </div>
    </div>
</div>
<script>
$(document).ready(function(){

    //for content
    $('#content-btn').on('click',function(){
        $('#content').click();
    })
    $('#replace-content').on('click',function(){
        $('#content').click();
    })
    $('#content').on('change', function() {
        thumbnail = $('#content')[0].files[0];
        thumbnail_form = new FormData();
        thumbnail_form.append('file', thumbnail);
        $('.uploading').show();
        $.ajax({
            url: '<?php echo $url . '/api/upload_file.php'; ?>',
            method: 'post',
            data: thumbnail_form,
            contentType: false,
            processData: false,
            success: function(data) {
                data = JSON.parse(data);
                $('.uploading').hide();
                thumbnail_url = data.secure_url;
                $('#preview-content').attr('href', thumbnail_url);
                //$('#thumbnail_url').val(thumbnail_url);
                $('.content-upload').hide();
                $('.content-uploaded').show();
            }
        })
    })
    
    $('#save-advocate').on('click',function(e){
        obj={
            headline:$('#headline').val(),
            description:$('#description').html(),
            duration:$('#duration').val(),
            click:$('#click').val(),
            upload:$('#upload').val(),
        }
        $('#challenge_type').val('advocate');
        $('#challenge_data').val(JSON.stringify(obj));
        $('#create-data')[0].submit();
    })
    
})
</script>