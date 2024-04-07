<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Theme - Onwintop</title>
    <?php
    include "header.php";
    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    if(isset($_GET['data'])){
        $data=base64_decode($_GET['data']);
        $data=json_decode($data,true);
    }
    if(isset($_POST['theme'])){
        $res=array(
            "name"=>$data['name'],
            "email"=>$data['email'],    
            "company"=>$data['company'],
            "country"=>$data['country'],
            "password"=>$data['password'],
            "theme"=>$_POST['theme'],
            "logo"=>$_POST['logo'],
            "font"=>$_POST['font'],
        );
        $res=json_encode($res);
        $res=base64_encode($res);
        echo "<script>window.location='".$_ENV['project_url']."nft?data=".$res."';</script>";
    }
    ?>
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
                    <h5 class="fa-sharp fa-solid fa-circle-dot"></h5>
                </div>
                <div class="col-md-11">
                    <h5 style='margin-left:16px'>NFT & Gift Card</h5>
                </div>
            </div>
            <div class="container_ mt-5 pt-5">
                <p class='text-white'>Copyright &copy; 2023 Tellselling Ltd 86-90 Paul Street, London, EC2A 4NE, United Kingdom All rights reserved. Powered by Tellselling.</p>
            </div>
        </div>
        <div class="col-md-9 rightpanel">
            <div class="row pt-4 pb-5">
                <div class="col-md-3"></div>
                <form action='' method='post' id='theme' class="col-md-6">
                    <h4>Customize look and feel</h4>
                    <p>Choose preset colour</p>
                    <div class="row">
                        <div class="col-md-4 theme-holder" onclick="document.getElementById('clear_sky').checked=true;">
                            <img src="<?php echo $_ENV['project_url']."provision/";?>clear_sky.png" style="width:70%;height:auto" alt="" srcset="">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="theme" value='Clear Sky' id="clear_sky">
                                <label class="form-check-label" for="clear_sky">
                                    Clear Sky </br>
                                    <small>(#00B2FE,#FFFFFF)</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 theme-holder">
                            <img src="<?php echo $_ENV['project_url']."provision/";?>purple_nurple.png" onclick="document.getElementById('purple_nurple').checked=true;" style="width:70%;height:auto" alt="" srcset="">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="theme" value='Purple Nurple' id="purple_nurple">
                                <label class="form-check-label" for="purple_nurple">
                                    Purple Nurple </br>
                                    <small>(#B54CE1,#FFFFFF)</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 theme-holder" onclick="document.getElementById('sun_brown').checked=true;">
                            <img src="<?php echo $_ENV['project_url']."provision/";?>sun_brown.png" style="width:70%;height:auto" alt="" srcset="">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="theme" value='Sun Brown' id="sun_brown">
                                <label class="form-check-label" for="sun_brown">
                                    Sun Brown </br>
                                    <small>(#FE7244,#FFFFFF)</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 theme-holder" onclick="document.getElementById('midnight').checked=true;">
                            <img src="<?php echo $_ENV['project_url']."provision/";?>midnight.png" style="width:70%;height:auto" alt="" srcset="">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="theme" value='Midnight' id="midnight">
                                <label class="form-check-label" for="midnight">
                                    Midnight </br>
                                    <small>(#5EC6FF,#1F1F1F)</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 theme-holder" onclick="document.getElementById('lunatic_sky').checked=true;">
                            <img src="<?php echo $_ENV['project_url']."provision/";?>lunatic_sky.png" style="width:70%;height:auto" alt="" srcset="">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="theme" value='Lunatic Sky' id="lunatic_sky">
                                <label class="form-check-label" for="lunatic_sky">
                                    Lunatic Sky </br>
                                    <small>(#5EFEC4,#1F1F1F)</small>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3 theme-holder" onclick="document.getElementById('cyber_pink').checked=true;">
                            <img src="<?php echo $_ENV['project_url']."provision/";?>cyber_pink.png" style="width:70%;height:auto" alt="" srcset="">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="theme" value='Cyber Pink' id="cyber_pink">
                                <label class="form-check-label" for="cyber_pink">
                                    Cyber Pink </br>
                                    <small>(#C97FEC,#1F1F1F)</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6" style="display:flex;align-items:center">
                            <label>Upload logo</label>
                        </div>
                        <div class="col-md-6 text-center" style="align-items:center;">
                            <img id='logo_preview' src='<?php echo $_ENV['project_url']."provision/";?>placeholder.png' style="height:auto;width:30%;object-fit:cover;object-position:center;" /></br>
                            <span class="btn btn-outline-success mt-2" id="upload_btn">Upload</span></br>
                            <input type="file" id="upload_logo" style="display:none;" required>
                            <input type='hidden' name='logo' id='logo'/>
                            <small>Recommeded picture size 512x512</small>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6" style="display:flex;align-items:center">
                            <label>Choose font family</label>
                        </div>
                        <div class="col-md-6 text-center" style="align-items:center;">
                            <div class="form-group">
                                <select name="font" id="" class="form-control" required>
                                    <option value="">Select Font</option>
                                    <option value="Poppins">Poppins</option>
                                    <option value="Default">Roboto</option>
                                    <option value="Alegreya">Alegreya</option>
                                    <option value="Alegreya+Sans">Alegreya Sans</option>
                                    <option value="Archivo+Narrow">Archivo Narrow</option>
                                    <option value="BioRhyme">BioRhyme</option>
                                    <option value="Cardo">Cardo</option>
                                    <option value="Chivo">Chivo</option>
                                    <option value="Fira+Sans">Fira Sans</option>
                                    <option value="IBM+Plex+Sans">IBM Plex Sans</option>
                                    <option value="Inconsolata">Inconsolata</option>
                                    <option value="Inknut+Antiqua">Inknut Antiqua</option>
                                    <option value="Inter">Inter</option>
                                    <option value="Karla">Karla</option>
                                    <option value="Lato">Lato</option>
                                    <option value="Libre+Baskerville">Libre Baskerville</option>
                                    <option value="Libre+Franklin">Libre Franklin</option>
                                    <option value="Lora">Lora</option>
                                    <option value="Manrope">Manrope</option>
                                    <option value="Merriweather">Merriweather</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Neuton">Neuton</option>
                                    <option value="Open+Sans">Open Sans</option>
                                    <option value="Playfair+Display">Playfair Display</option>
                                    <option value="Poppins">Poppins</option>
                                    <option value="Proza+Libre">Proza Libre</option>
                                    <option value="PT+Sans">PT Sans</option>
                                    <option value="PT+Serif">PT Serif</option>
                                    <option value="Raleway">Raleway</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="col-md-3"></div>
            </div>

        </div>
    </div>
    <div class='operation-holder'>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 operation-board">
                <div class="row p-2">
                    <div class="col-md-6">
                        <a href='<?php echo $_ENV['project_url']."signup";?>' class="btn btn-outline-secondary"><i class="fa fa-long-arrow-left"></i> &nbsp; &nbsp; &nbsp; Back</a>
                    </div>
                    <div class="col-md-6" style="justify-content:right;display:flex;">
                        <button id='submit' style="background-color: var(--theme);color:#ffffff;border:none;" class="btn btn-outline-secondary">Continue &nbsp; &nbsp; &nbsp;<i class="fa fa-long-arrow-right"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<?php include "scripts.php"; ?>

<script>
    $(document).ready(function() {
        $('#upload_btn').click(function() {
            $('#upload_logo').click();
        })
        var logo="";
        //upload images
        $('#upload_logo').on('change', function() {
            thumbnail = $('#upload_logo')[0].files[0];
            thumbnail_form = new FormData();
            thumbnail_form.append('file', thumbnail);
            $('#upload_btn').hide();
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
                    $('#upload_btn').show();
                    logo=thumbnail_url;
                    $('#logo').val(logo);
                }
            })
        })
        $('#submit').on('click',function(){
            $('#theme')[0].submit();
        })
        
    })
</script>
<script src="<?php URI("js/main.min.js"); ?>"></script>
<script src="<?php URI("js/script.js"); ?>"></script>

</html>