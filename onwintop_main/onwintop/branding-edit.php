<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Branding | <?php echo $title; ?></title>
    <?php include "includes/head.php"; ?>
    <style>
        .daywise:hover {
            cursor: pointer;
        }

        .blank-wrapper {
            background: #fafafa00 none repeat scroll 0 0 !important;
            border: 1px solid #e1e8ed00 !important;
            border-radius: 5px;
            display: block;
            margin-bottom: 30px;
            padding: 15px 20px 20px;
            position: relative;
            width: 100%;
            z-index: 9;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: var(--primary-color);
        }

        td {
            padding: 10px;
        }
        .chosen-container-single .chosen-single {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="theme-layout">
        <?php include "includes/header2.php"; ?>
        <?php include "includes/nav.php"; ?>
        <section>
            <div class="gap">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12">
                                    <div class="main-wraper blank-wrapper">
                                        <div class="main-title">Branding</div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Colors</a>
                                                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Images</a>
                                                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Others</a>
                                                    </div>
                                                </div>
                                                <div class="col-7">
                                                    <div class="tab-content" id="v-pills-tabContent">
                                                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                            <div class="row">
                                                                <?php
                                                                $db = new Database();
                                                                $s = "SELECT * FROM `branding` WHERE `community_id`='" . $_SESSION['community_id'] . "' ";
                                                                $data = $db->RetriveSingle($s);
                                                                $colors = json_decode($data['colors'], true);
                                                                ?>
                                                                <form id='branding-color' class="col-md-6">

                                                                    <!--Color Schema-->
                                                                    <table style='border:none;width:100%'>
                                                                        <tr>
                                                                            <td class='pr-5 mr-5'>
                                                                                <text>Primary Color</text>
                                                                            </td>
                                                                            <td>
                                                                                <input type='hidden' name='community_id' value='<?php echo $_SESSION['community_id']; ?>' />
                                                                                <input class='col-inp' name='post_background' type='color' value='<?php echo $colors['post_background']; ?>'>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class='pr-5'>
                                                                                <text>Secondary Color</text>
                                                                            </td>
                                                                            <td>
                                                                                <input class='col-inp' name='post_text' type='color' value='<?php echo $colors['post_text']; ?>'>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="display:none">
                                                                            <td>
                                                                                <text>Topbar Text Color</text>
                                                                            </td>
                                                                            <td>
                                                                                <input class='col-inp' name='topnav_text' type='color' value='<?php echo $colors['topnav_text']; ?>'>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="display:none">
                                                                            <td class='pr-5'>
                                                                                <text>Background</text>
                                                                            </td>
                                                                            <td>
                                                                                <input class='col-inp' name='background' type='color' value='<?php echo $colors['background_color']; ?>'>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <tr style="display:none">
                                                                            <td>
                                                                                <text>Title Text Color</text>
                                                                            </td>
                                                                            <td>
                                                                                <input class='col-inp' name='header_text_color' type='color' value='<?php echo $colors['header_text_color']; ?>'>
                                                                            </td>
                                                                        </tr>
                                                                        <tr style="display:none">
                                                                            <td>
                                                                                <text>Body Text Color</text>
                                                                            </td>
                                                                            <td>
                                                                                <input class='col-inp' name='body_text_color' type='color' value='<?php echo $colors['body_text_color']; ?>'>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <button class='button btn-soft-success mt-3'>Save</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                                            <div class="card">
                                                                <div class="card-body p-3">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h4>Header Logo</h4>
                                                                            <p>Add your logo on the top bar of your community app.</p>
                                                                            <p>Required: PNG, transparent, 400x100</p>
                                                                            <img src='<?php if(isset($colors['logo'])) echo $colors['logo']; else echo 'https://via.placeholder.com/400x100.png?text=Loading';?>' id='logo_preview' style='<?php if(!isset($colors['logo'])) echo "display:none;";?>height:100px;width:400px;object-fit:cover;object-position:center' /></br></br>
                                                                            <input type='file' accept='.png,.jpg,.gif,.bmp' id='header_logo' style='display:none' />
                                                                            <span class='text-danger logo_loader my-2' style='display:none'>Loading...</span></br>
                                                                            <button class='btn btn-danger header_logo_btn'>Browse</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="card mt-3">
                                                                <div class="card-body p-3">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h4>Favicon</h4>
                                                                            <p>Customise the default image that is displayed when someone shares a link to your community on social media or on messanging apps.</br>
                                                                                Depending on the platform the link is shared to, the image may appear cropped. We recommend a 1.91:1 ratio to minimise the cropping of your image. however this may vary.</br>
                                                                            <p>Required: JPG, PNG, minimum 16x16</p>
                                                                            <img src='<?php if(isset($colors['favicon_image'])) echo $colors['favicon_image']; else echo 'https://via.placeholder.com/160x160.png?text=Loading';?>' id='favicon_preview' style='<?php if(!isset($colors['favicon_image'])) echo "display:none;";?>height:100px;width:100px;object-fit:cover;object-position:center' /></br></br>
                                                                            <input type='file' accept='.png,.jpg,.gif,.bmp' id='favicon_image' style='display:none;' />
                                                                            <span class='text-danger favicon_loader my-2r' style='display:none'>Loading...</span></br>
                                                                            <button class='btn btn-danger favicon_image_btn'>Browse</button>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="card mt-3">
                                                                <div class="card-body p-3">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h4>Signup page image</h4>
                                                                            <p>Customise the default image that is displayed when someone shares a link to your community on social media or on messanging apps.</br>
                                                                                Depending on the platform the link is shared to, the image may appear cropped. We recommend a 1.91:1 ratio to minimise the cropping of your image. however this may vary.</br>
                                                                            <p>Required: JPG, PNG, minimum 400x400</p>
                                                                            <img src='<?php if(isset($colors['signup_image'])) echo $colors['signup_image']; else echo 'https://via.placeholder.com/400x100.png?text=Loading';?>' id='signup_preview' style='<?php if(!isset($colors['signup_image'])) echo "display:none;";?>height:400px;width:400px;object-fit:cover;object-position:center' /></br></br>
                                                                            <input type='file' accept='.png,.jpg,.gif,.bmp' id='signup_image' style='display:none;' />
                                                                            <span class='text-danger signup_loader my-2r' style='display:none'>Loading...</span></br>
                                                                            <button class='btn btn-danger signup_image_btn'>Browse</button>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="card mt-3">
                                                                <div class="card-body p-3">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h4>Signin page image</h4>
                                                                            <p>Customise the default image that is displayed when someone shares a link to your community on social media or on messanging apps.</br>
                                                                                Depending on the platform the link is shared to, the image may appear cropped. We recommend a 1.91:1 ratio to minimise the cropping of your image. however this may vary.</br>
                                                                            <p>Required: JPG, PNG, minimum 400x400</p>
                                                                            <img src='<?php if(isset($colors['signin_image'])) echo $colors['signin_image']; else echo 'https://via.placeholder.com/400x400.png?text=Loading';?>' id='signin_preview' style='<?php if(!isset($colors['signin_image'])) echo "display:none;";?>height:400px;width:400px;object-fit:cover;object-position:center' /></br></br>
                                                                            <input type='file' accept='.png,.jpg,.gif,.bmp' id='signin_image' style='display:none;' />
                                                                            <span class='text-danger signin_loader my-2' style='display:none'>Loading...</span></br>
                                                                            <button class='btn btn-danger signin_image_btn'>Browse</button>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                                            <div class="main-title">Add Custom Domain</div>
                                                            <div class='row mb-5'>
                                                                <div class='col-md-12 '>
                                                                    <form class='c-form' id='domain'>
                                                                        <label>URL</label></br>
                                                                        <small>*Only enter the domain name except <b>http, https, www</b></small></br>
                                                                        <input type='text' name='link' name='domain_name' />

                                                                        <input type='hidden' name='community_id' value='<?php echo $_SESSION['community_id']; ?>' />
                                                                        <button type='submit' class='button soft-success'>+ Add</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class='row mt-3'>
                                                                <div class='col-md-12'>
                                                                    <div class="main-title">Added Domains</div>
                                                                    <table class='table spft-primary'>
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Domain</th>
                                                                                <th>URL</th>
                                                                                <th>Status</th>
                                                                                <th>Actions</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id='domain_lists'>
                                                                            <?php
                                                                            $d = "SELECT * FROM `custom_domains` WHERE `community_id`='" . $_SESSION['community_id'] . "' ";
                                                                            $custom_doms = $db->RetriveArray($d);
                                                                            $u=URL_Make("/");
                                                                            foreach ($custom_doms as $dom) {
                                                                                echo "
                                                                                <tr>
                                                                                    <td>" . $dom['link'] . "</td>
                                                                                    <td>" . $u . "</td>
                                                                                    <td>{$dom['status']}</td>
                                                                                    <td>
                                                                                        <button class='button soft-danger'><i class='icofont-ui-delete'></i></button>
                                                                                    </td>
                                                                                </tr>
                                                                                ";
                                                                            }
                                                                            if (count($custom_doms) == 0) {
                                                                                echo "
                                                                                <tr>
                                                                                    <td colspan='4' style='text-align:center;padding:20px'>
                                                                                        No Custom Domains Found
                                                                                    </td>
                                                                                </tr>
                                                                                ";
                                                                            }
                                                                            ?>
                                                                        </tbody>

                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="main-title mt-3">Branding</div>

                                                            <form id='font-form'>
                                                            <div class="form-group mb-3">
                                                                <label class='mr-2'>Body Font Color</label>
                                                                <input type='color' value='<?php if(isset($colors['body_font_color'])) echo $colors['body_font_color']; else echo '#000000';   ?>' class='mt-2 form-control' name='body_font_color' />
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="customRange2" class="form-label">Body Font Size</label>
                                                                <input type="range" value='<?php if(isset($colors['font_size'])) echo $colors['font_size'];   ?>' name='size' class="form-range form-control" min="0" max="5" id="customRange2">
                                                            </div>
                                                            <input type='hidden' name='community_id' value='<?php echo $_SESSION['community_id'];?>'/>
                                                            <label>Body Font</label></br>
                                                            <select id='font' style="width: 100%;border:none" name="font" required>
                                                                <?php if(isset($colors['font_family'])) {
                                                                    $fn=str_replace("+"," ",$colors['font_family']);
                                                                    if($fn=='Default'){
                                                                        $fn="Roboto";
                                                                    }
                                                                    echo "<option value='".$colors['font_family']."' >".$fn."</option>";  
                                                                }
                                                                ?>
                                                                <option value='Default'>Roboto</option>
                                                                <option value='Alegreya'>Alegreya</option>
                                                                <option value='Alegreya+Sans'>Alegreya Sans</option>
                                                                <option value='Archivo+Narrow'>Archivo Narrow</option>
                                                                <option value='BioRhyme'>BioRhyme</option>
                                                                <option value='Cardo'>Cardo</option>
                                                                <option value='Chivo'>Chivo</option>
                                                                <option value='Fira+Sans'>Fira Sans</option>
                                                                <option value='IBM+Plex+Sans'>IBM Plex Sans</option>
                                                                <option value='Inconsolata'>Inconsolata</option>
                                                                <option value='Inknut+Antiqua'>Inknut Antiqua</option>
                                                                <option value='Inter'>Inter</option>
                                                                <option value='Karla'>Karla</option>
                                                                <option value='Lato'>Lato</option>
                                                                <option value='Libre+Baskerville'>Libre Baskerville</option>
                                                                <option value='Libre+Franklin'>Libre Franklin</option>
                                                                <option value='Lora'>Lora</option>
                                                                <option value='Manrope'>Manrope</option>
                                                                <option value='Merriweather'>Merriweather</option>
                                                                <option value='Montserrat'>Montserrat</option>
                                                                <option value='Neuton'>Neuton</option>
                                                                <option value='Open+Sans'>Open Sans</option>
                                                                <option value='Playfair+Display'>Playfair Display</option>
                                                                <option value='Poppins'>Poppins</option>
                                                                <option value='Proza+Libre'>Proza Libre</option>
                                                                <option value='PT+Sans'>PT Sans</option>
                                                                <option value='PT+Serif'>PT Serif</option>
                                                                <option value='Raleway'>Raleway</option>
                                                            </select></br>
                                                            <a id='custom-font' class='text-primary my-2' style='float:right'>Upload Custom</a></br>
                                                            <button type='submit' class='button btn-soft-primary mt-3 mb-5'>Save</button>
                                                            </form>
                                                            
                                                            <div class='row mt-3'>
                                                                <div class='col-md-12'>
                                                                    <div class="main-title">Others</div>
                                                                    <?php
                                                                        $access=R::findOne("communities","WHERE link=?",[$_SESSION['community_id']]);
                                                                        $others=json_decode($access['title'],true);
                                                                    ?>
                                                                    <table style='width:100%'>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>Blogs</td>
                                                                                <td>
                                                                                    <button data-name='blogs' data-tar='<?php if(isset($others['blogs']) && $others['blogs']=='disabled') echo "enabled"; else echo "disabled";?>' class='ed button <?php if(isset($others['blogs']) && $others['blogs']=='disabled') echo "soft-danger"; else echo "soft-success";?>'><?php if(isset($others['blogs']) && $others['blogs']=='disabled') echo "Disabled"; else echo "Enabled";?></button>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Digital Salesrooms</td>
                                                                                <td>
                                                                                    <button data-name='salesrooms'  data-tar='<?php if(isset($others['salesrooms']) && $others['salesrooms']=='disabled') echo "enabled"; else echo "disabled";?>' class='ed button <?php if(isset($others['salesrooms']) && $others['salesrooms']=='disabled') echo "soft-danger"; else echo "soft-success";?>'><?php if(isset($others['blogs']) && $others['blogs']=='disabled') echo "Disabled"; else echo "Enabled";?></button>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Channels</td>
                                                                                <td>
                                                                                    <button data-name='channels' data-tar='<?php if(isset($others['channels']) && $others['channels']=='disabled') echo "enabled"; else echo "disabled";?>' class='ed button <?php if(isset($others['channels']) && $others['channels']=='disabled') echo "soft-danger"; else echo "soft-success";?>'><?php if(isset($others['channels']) && $others['channels']=='disabled') echo "Disabled"; else echo "Enabled";?></button>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Discussions</td>
                                                                                <td>
                                                                                    <button data-name='discussion' data-tar='<?php if(isset($others['discussion']) && $others['discussion']=='disabled') echo "enabled"; else echo "disabled";?>' class='ed button <?php if(isset($others['discussion']) && $others['discussion']=='disabled') echo "soft-danger"; else echo "soft-success";?>'><?php if(isset($others['discussion']) && $others['discussion']=='disabled') echo "Disabled"; else echo "Enabled";?></button>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Events</td>
                                                                                <td>
                                                                                    <button data-name='events' data-tar='<?php if(isset($others['events']) && $others['events']=='disabled') echo "enabled"; else echo "disabled";?>' class='ed button <?php if(isset($others['events']) && $others['events']=='disabled') echo "soft-danger"; else echo "soft-success";?>'><?php if(isset($others['events']) && $others['events']=='disabled') echo "Disabled"; else echo "Enabled";?></button>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <div class="popup-wraper" id='custom-success'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-share"></i> Add Custom Domain</h5>
                </div>
                <div class="send-message">
                    <h4>Follow these instructions to set up your DNS records</h4>
                    <ol>
                        <li>Login to your domain management portal</li>
                        <li>Find your domain and click on <b>DNS</b> button to the right</li>
                        <li>Under <b>RECORDS</b>, click <b>ADD</b></li>
                        <li>In the <b>TYPE</b> dropdown, select <b>CNAME</b></li>
                        <li>In the <b>HOST</b> field, type <b>Community Custom Link</b></li>
                        <li>In the <b>POINTS TO </b> field, type <b>landingpage-dev.tellselling.tech URL</b></li>
                        <li>Leave the <b>TTL</b> configuration as is</li>
                        <li>Click <b>SAVE</b></li>
                    </ol>
                    <button class='button soft-success mt-3' id='domain-added'>Confirm</button>
                </div>
            </div>
        </div>
    </div><!-- send message popup -->

    <div class="popup-wraper" id='confirm-success'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-share"></i> Add Custom Domain</h5>
                </div>
                <div class="send-message">
                    <h3 style='color:green'>
                        <center>Domain has been successfully added! It may take upto 30 min to 6 hours to get activated.</center>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    
    <div class="popup-wraper" id='font-popup'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-share"></i> Custom Font Upload</h5>
                </div>
                <div class="send-message">
                    <input type='file' accept='.ttf'/></br></br>
                    <button type='submit' class='button soft-primary'>Upload</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="popup-wraper" id='branding-success'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="fa fa-share"></i> Successful</h5>
                </div>
                <div class="send-message">
                    <p>Your settings has been successfully updated, click on the `Continue` button to reload the page.</p>
                    <button onclick="location.reload();" class='button soft-primary'>Continue</button>
                </div>
            </div>
        </div>
    </div>
    
    
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            $('#custom-font').click(function(){
                $('#font-popup').addClass('active');
            })
            //images switches
            $('.header_logo_btn').click(function(){
                $('#header_logo').click();
            })
            $('.signup_image_btn').click(function(){
                $('#signup_image').click();
            })
            $('.favicon_image_btn').click(function(){
                $('#favicon_image').click();
            })
            $('.signin_image_btn').click(function(){
                $('#signin_image').click();
            })
            
            //upload images
            $('#header_logo').on('change', function() {
                thumbnail = $('#header_logo')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('.logo_loader').show();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        $('#logo_preview').attr('src', thumbnail_url);
                        $('.logo_loader').hide();
                        $('#logo_preview').show();
                        UpdateImage('logo',thumbnail_url);
                    }
                })
            })
            
            $('#favicon_image').on('change', function() {
                thumbnail = $('#favicon_image')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('.favicon_loader').show();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        $('#favicon_preview').attr('src', thumbnail_url);
                        $('.favicon_loader').hide();
                        $('#favicon_preview').show();
                        UpdateImage('favicon_image',thumbnail_url);
                    }
                })
            })
            
            $('#signup_image').on('change', function() {
                thumbnail = $('#signup_image')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('.signup_loader').show();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        $('#signup_preview').attr('src', thumbnail_url);
                        $('.signup_loader').hide();
                        $('#signup_preview').show();
                        UpdateImage('signup_image',thumbnail_url);
                    }
                })
            })
            
            $('#signin_image').on('change', function() {
                thumbnail = $('#signin_image')[0].files[0];
                thumbnail_form = new FormData();
                thumbnail_form.append('file', thumbnail);
                $('.signin_loader').show();
                $.ajax({
                    url: '<?php echo $url . '/api/upload_file.php'; ?>',
                    method: 'post',
                    data: thumbnail_form,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        data = JSON.parse(data);
                        thumbnail_url = data.secure_url;
                        $('#signin_preview').attr('src', thumbnail_url);
                        $('.signin_loader').hide();
                        $('#signin_preview').show();
                        UpdateImage('signin_image',thumbnail_url);
                    }
                })
            });
            
            function UpdateImage(method,value){
                community_id='<?php echo $_SESSION['community_id'];?>';
                $.ajax({
                    url:'<?php echo $root;?>api/branding_images.php',
                    method:'POST',
                    type:'POST',
                    data:{
                        community_id,method,value
                    },
                    success:function(data){
                        alertify.success(data);
                        $('#branding-success').addClass('active');
                    }
                })
                
            }
            
            

            //font settings
            $('#font').select2();
            
            $('.ed').click(function(){
                item=$(this).attr('data-name');
                value=$(this).attr('data-tar');
                community_id='<?php echo $_SESSION['community_id'];?>';
                if(value=='enabled'){
                    $(this).removeClass('soft-danger');
                    $(this).addClass('soft-success');
                    $(this).html('Enabled');
                    $(this).attr('data-tar','disabled');
                }
                if(value=='disabled'){
                    $(this).removeClass('soft-success');
                    $(this).addClass('soft-danger');
                    $(this).html('Disabled');
                    $(this).attr('data-tar','enabled');
                }
                
                $.ajax({
                    url:'<?php echo $root;?>api/nav_access.php',
                    method:'POST',
                    type:'POST',
                    data:{
                        name:item,value,community_id
                    },
                    success:function(data){
                        alertify.success(data);
                    }
                })
            })
            
            $('#font-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url:'<?php echo $root;?>api/fonts.php',
                    method:'POST',
                    type:'POST',
                    contentType:false,
                    processData:false,
                    data:new FormData(this),
                    success:function(data){
                        alertify.success(data);
                        $('#branding-success').addClass('active');
                    }
                })
            })
            
            $('#domain').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo $root . 'api/custom-domain.php'; ?>',
                    method: 'POST',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        alertify.success(data);
                        $('#domain')[0].reset();
                        $('#custom-success').addClass('active');
                        //LoadDomains();
                    }
                })
            })
            $('#domain-added').click(function() {
                $('#custom-success').removeClass('active');
                $('#confirm-success').addClass('active');
                
            });
            //set branding color
            $('#branding-color').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url:'<?php echo $root;?>api/branding_colors.php',
                    method:'POST',
                    type:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){
                        alertify.success(data);
                        $('#branding-success').addClass('active');
                    }
                })
            })
            
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>