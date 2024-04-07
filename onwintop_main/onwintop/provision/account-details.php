<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provision - Tellselling</title>
    <?php
    include "header.php";
    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    $error=false;
    $err_msg="";
    if(isset($_POST['name'])){
        if($_POST['password']==$_POST['confirm_password']){
            $data=json_encode($_POST);
            $data=base64_encode($data);
            echo "<script>window.location='".$_ENV['project_url']."choose-theme?data=".$data."';</script>";
        }else{
            $error=true;
            $err_msg="Please confirm the password!";
        }
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
                    <h5 class="fa-sharp fa-solid fa-circle-dot"></h5>
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
        <form id='signup' action='' method='post' class="col-md-9 rightpanel">
            <div class="row pt-4 pb-5 mb-5">
                <div class="col-md-4"></div>
                <div class="col-md-4 p-3 mb-5 pb-5" >
                    <h4 class='text-center mt-3'>Now, let's get some basic details about you</h4>
                    <div class="form-group mt-4 pt-3">
                        <?php
                            if($error){
                                echo "<label class='text-danger py-2'>".$err_msg."</label>"; 
                            }
                        ?>
                        
                        <label> <span class="text-danger">*</span> NAME OF GAMIFIED SPACE</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group mt-3">
                        <label> <span class="text-danger">*</span> WORK EMAIL</label>
                        <input id='email' type="email" name="email" class="form-control" required>
                        <small style='display:none;' id='invalid-email' class="text-danger">Please enter your company email address</small>
                    </div>
                    <div class="form-group mt-3">
                        <label> <span class="text-danger">*</span> COMPANY</label>
                        <input type="text" name="company" class="form-control" required>
                    </div>
                    <div class="form-group mt-3">
                        <label> <span class="text-danger">*</span> COUNTRY</label>
                        <select name='country' class='form-control' required>
                            <option>Select Country</option>
                            <?php
                            foreach ($countries as $country) {
                                echo "<option>" . $country . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label> <span class="text-danger">*</span> PASSWORD</label>
                        <input name='password' minlength='6' type="password" class="form-control" required>
                        <small class='text-secondary'>Minimum 6 Characters</small>
                    </div>
                    <div class="form-group mt-3">
                        <label> <span class="text-danger">*</span> CONFIRM PASSWORD</label>
                        <input type="password" minlength='6' name="confirm_password" class="form-control" required>
                        
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
    </div>
    <div class='operation-holder'>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 operation-board">
                <div class="row p-2">
                    <div class="col-md-6">
                        <a  class="btn btn-outline-secondary"><i class="fa fa-long-arrow-left"></i> &nbsp; &nbsp; &nbsp; Back</a>
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
    $(document).ready(function(){
        var error=false;
        $('#submit').on('click',function(){
            if(!error){
               $('#signup')[0].submit(); 
            }
        });
        $('#email').on('change',function(){
            var email=$('#email').val();
            company=email.split('@')[1];
            if(company=='gmail.com' || company=='yahoo.com' || company=='raddit.com' || company=='outlook.com'){
                $('#invalid-email').show();
                $('#email').css('border-bottom:1px solid #ff0000;');
                error=true;
            }else{
                $('#invalid-email').hide();
                error=false;
            }

        })
    })
</script>
</html>