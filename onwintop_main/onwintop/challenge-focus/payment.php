<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Tellselling</title>
    <?php
    include "header.php";
    print_r($_GET['data']);
    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    $amount = base64_decode($_GET['data']);
    

    ?>
</head>

<body>
    <div class="row">
        <div class="col-md-3">
            <div class="leftpanel px-5 py-5 position-fixed" style="width:24.5%;">
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
        </div>
        <div class="col-md-9 rightpanel">
            <div class="row pt-4 pb-5">
                <div class="col-md-4"></div>
                <form action='' method='post' id='payment' class="col-md-4 p-3 pb-5">
                    <h4 class='text-center mt-3'>Power your gamified space with branded rewards</h4>
                    <div style="width:100%;height:auto;padding:15px;justify-content:center;align-items:center;background-color:#ebebeb">
                        <center>
                            <h4>Gamified Rewards</h4>
                            <h3><?php echo $amount; ?> USD</h3>
                        </center>
                    </div>
                    <div class="form-group mt-4 pt-3">
                        <label> <span class="text-danger">*</span> EMAIL</label>
                        <input type="text" name="" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label> <span class="text-danger">*</span> CARD NO</label>
                        <input maxlength="16" minlength="16" type="number" name="" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label> <span class="text-danger">*</span> EXPIRY MONTH/YEAR</label>
                                <input type="text" name="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-3">
                                <label> <span class="text-danger">*</span> CVV</label>
                                <input type="email" name="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label> <span class="text-danger">*</span> NAME ON CARD</label>
                        <input type="text" name="" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label> <span class="text-danger">*</span> COUNTRY</label>
                        <select class='form-control'>
                            <option>Select Country</option>
                            <?php
                            foreach ($countries as $country) {
                                echo "<option>" . $country . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label> <span class="text-danger">*</span> ZIP CODE</label>
                        <input type="text" name="" class="form-control">
                    </div>
                    <div class="form-group mt-3 loading" style="display:none;">
                        <label class='text-success'>Loading...</label>
                    </div>
                    </br></br></br></br></br>
                </form>
                <div class="col-md-4"></div>
            </div>

        </div>
    </div>

    <div class='operation-holder'>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-9 operation-board">
                <div class="row p-2">
                    <div class="col-md-6">
                        <a href='nft.php' class="btn btn-outline-secondary"><i class="fa fa-long-arrow-left"></i> &nbsp; &nbsp; &nbsp; Back</a>
                    </div>
                    <div class="col-md-6" style="justify-content:right;display:flex;">
                        <button id='pay' style="background-color: var(--theme);color:#ffffff;border:none;" class="btn btn-outline-secondary">Continue &nbsp; &nbsp; &nbsp;<i class="fa fa-long-arrow-right"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<?php include "scripts.php"; ?>
<script src="https://js.stripe.com/v2/"></script>
<script>
    Stripe.setPublishableKey('pk_test_51H6DeMInuA3v8Jr0AvtJAegAzlZCXXxraNcIhzlAKUCd6IBNQrOqLDKWFhHMgeWVOLNxPo2D4JQiPaXJKKfbaspb00hQu5NKqJ');
</script>
<script>
    $(document).ready(function() {
        $('#pay').on('click', function() {
            $('.loading').show();
            setTimeout(function() {
                window.location = 'successful.php';
            }, 4000)
        })
    })
</script>
<script>
    function stripeResponseHandler(status, response) {
        "use strict";
        var paymentForm = document.forms['payform'];
        if (response.error) {
            document.getElementById('feedback').textContent = response.error.message;
            document.getElementById('btnpay').removeAttribute('disabled');
        } else {
            var dataAmount = document.getElementById('amount');
            var dataEmail = document.getElementById('email');
            var stripeToken = response.id;
            var formString = "amount=" + dataAmount.value + "&stripeToken=" + stripeToken + "&email=" + dataEmail.value;

            function submitForm(f) {
                var xhr = new XMLHttpRequest();
                xhr.onload = function() {
                    window.location = xhr.responseText;
                }
                xhr.onerror = function() {
                    document.getElementById('feedback').textContent = "Error";
                    console.log(xhr.responseText);
                }
                xhr.open(paymentForm.method, paymentForm.action, true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send(f);
            }
            return submitForm(formString);
        }
    }! function() {
        "use strict";
        var paymentForm = document.forms['payform'];
        paymentForm.addEventListener('submit', function(e) {
            e.preventDefault();
            var thisForm = this;
            document.getElementById('btnpay').setAttribute('disabled', true);
            var baseAmount = document.getElementById('amountbase').value | 0;
            var amountField = document.getElementById('amount');

            function pound(a) {
                return a * 100;
            };
            amountField.value = pound(baseAmount);
            if (amountField.value > 0) {
                Stripe.card.createToken(thisForm, stripeResponseHandler);
            } else {
                alert('Please enter a payment amount');
                document.getElementById('btnpay').removeAttribute('disabled');
            }
        });
    }();
</script>






</html>