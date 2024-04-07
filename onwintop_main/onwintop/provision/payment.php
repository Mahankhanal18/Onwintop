
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Onwintop</title>
    <?php
    require_once('init.php');
    include "header.php";
    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    if(isset($_GET['payment'])){
        $payment=base64_decode($_GET['payment']);
        $payment=json_decode($payment,true);
        $data=base64_decode($_GET['data']);
        $data=json_decode($data,true);
        
        //get community
        $user=R::findOne("users","email=?",[$data['email']]);
        $community=R::findOne("communities","tenant_id=?",[$user['tenant_id']]);
        
        $amount=0;
        if($payment['type']=='NFT'){
            $p=1.99;
            $qt=count($payment['assets']);
            $amount=$p*$qt;
        }else if($payment['type']=='Gift Card'){
            $amount=$payment['amount'];
        }
    }
    ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
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
                <form action='https://organic-service-371417.de.r.appspot.com/payment' class='col-md-4 p-3 pb-4' method="post" id="example-form" style="display: none;">
                    <h4 class='text-center mt-3'>Power your gamified space with branded rewards</h4>
                    <div style="width:100%;height:auto;padding:15px;justify-content:center;align-items:center;background-color:#ebebeb">
                        <center>
                            <h4>Gamified Rewards</h4>
                            <h3><?php echo $amount; ?> EURO</h3>
                        </center>
                    </div>
                    <div class="form-group mt-5">
                        <label for="email">E-mail Address</label>
                        <input type="text"  name="email" class="form-control" />
                        <input type="hidden" name="description" value="Payment for <?php echo $payment['type']?>">
                        <input type="hidden" name="data" value="<?php echo json_encode($payment);?>">
                        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                    </div>

                    <div class="form-group mt-2">
                        <label>Card Number</label>
                        <input type="text" value="" maxlength="20" autocomplete="off" class="card-number stripe-sensitive form-control" />
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Expiration</label>
                                <div class="expiry-wrapper">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-control card-expiry-month stripe-sensitive card-det-drop">
                                            </select>
                                            <script type="text/javascript">
                                                var select = $(".card-expiry-month"),
                                                    month = new Date().getMonth() + 1;
                                                for (var i = 1; i <= 12; i++) {
                                                    select.append($("<option value='" + i + "' " + (month === i ? "selected" : "") + ">" + i + "</option>"))
                                                }
                                            </script>
                                        </div>
                                        <div class="col-md-1">
                                            <span> / </span>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control card-expiry-year stripe-sensitive card-det-drop"></select>
                                            <script type="text/javascript">
                                                var select = $(".card-expiry-year"),
                                                    year = new Date().getFullYear();

                                                for (var i = 0; i < 12; i++) {
                                                    select.append($("<option value='" + (i + year) + "' " + (i === 0 ? "selected" : "") + ">" + (i + year) + "</option>"))
                                                }
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>CVC</label>
                                <input type="text" placeholder="123" maxlength="4" autocomplete="off" class="card-cvc stripe-sensitive form-control" />
                            </div>
                        </div>
                    </div>


                    <div class="form-group mt-2">
                        <label class="stripeLabel">Your Name</label>
                        <input type="text" placeholder="eg. John Doe" name="name" class="form-control" />
                    </div>

                    <div class="form-group mt-2">
                        <label for="name" class="stripeLabel">Address</label>
                        <input type="text" placeholder="eg. TC 9/4 Old MES colony" name="address" class="form-control" />
                    </div>

                    <div class="form-group mt-2">
                        <label for="name" class="stripeLabel">City</label>
                        <input type="text" placeholder="eg. 1600 Amphitheatre Pkwy" name="city" class="form-control" />
                    </div>

                    <div class="form-group mt-2">
                        <label for="name" class="stripeLabel">State</label>
                        <input type="text" placeholder="eg. Mountain View" name="state" class="form-control" />
                    </div>

                    <div class="form-group mt-2">
                        <label for="name" class="stripeLabel">County</label>
                        <select name="country" class="form-control" required>
                            <option value=''>Select Country...</option>
                            <?php
                            foreach ($countries as $country) {
                                echo "<option>" . $country . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label for="name" class="stripeLabel">ZIP</label>
                        <input type="text" placeholder="eg. 94043" name="zip" class="form-control" />
                    </div>
                    <button type='submit' id='sub' style="display:none">submit</button>
                    <span class="payment-errors"></span>
                    </br></br></br></br></br>
                </form>
                
                <script>
                    if (window.Stripe) $("#example-form").show()
                </script>
                <noscript>
                    <p>JavaScript is required for the registration form.</p>
                </noscript>
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
                        <a href='nft?data=<?php echo $_GET['data'];?>' class="btn btn-outline-secondary"><i class="fa fa-long-arrow-left"></i> &nbsp; &nbsp; &nbsp; Back</a>
                    </div>
                    <div class="col-md-6" style="justify-content:right;display:flex;">
                        <button id='continue' style="background-color: var(--theme);color:#ffffff;border:none;" class="btn btn-outline-secondary">Continue &nbsp; &nbsp; &nbsp;<i class="fa fa-long-arrow-right"></i> </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<?php include "scripts.php"; ?>


<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v1/"></script>


<script type="text/javascript">
    Stripe.setPublishableKey('pk_test_51H6DeMInuA3v8Jr0AvtJAegAzlZCXXxraNcIhzlAKUCd6IBNQrOqLDKWFhHMgeWVOLNxPo2D4JQiPaXJKKfbaspb00hQu5NKqJ');
    $(document).ready(function() {

        function addInputNames() {
            $(".card-number").attr("name", "card-number")
            $(".card-cvc").attr("name", "card-cvc")
            $(".card-expiry-year").attr("name", "card-expiry-year")
        }

        function removeInputNames() {
            $(".card-number").removeAttr("name")
            $(".card-cvc").removeAttr("name")
            $(".card-expiry-year").removeAttr("name")
        }

        function submit(form) {
            removeInputNames(); // THIS IS IMPORTANT!

            // given a valid form, submit the payment details to stripe
            $(form['submit-button']).attr("disabled", "disabled")

            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, function(status, response) {
                if (response.error) {
                    // re-enable the submit button
                    $(form['submit-button']).removeAttr("disabled")

                    // show the error
                    $(".payment-errors").html(response.error.message);

                    // we add these names back in so we can revalidate properly
                    addInputNames();
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];

                    // insert the stripe token
                    var input = $("<input name='stripeToken' value='" + token + "' style='display:none;' />");
                    form.appendChild(input[0])

                    // and submit
                    form.submit();
                }
            });

            return false;
        }

        // add custom rules for credit card validating
        jQuery.validator.addMethod("cardNumber", Stripe.validateCardNumber, "Please enter a valid card number");
        jQuery.validator.addMethod("cardCVC", Stripe.validateCVC, "Please enter a valid security code");
        jQuery.validator.addMethod("cardExpiry", function() {
            return Stripe.validateExpiry($(".card-expiry-month").val(),
                $(".card-expiry-year").val())
        }, "Please enter a valid expiration");

        // We use the jQuery validate plugin to validate required params on submit
        $("#example-form").validate({
            submitHandler: submit,
            rules: {
                "card-cvc": {
                    cardCVC: true,
                    required: true
                },
                "card-number": {
                    cardNumber: true,
                    required: true
                },
                "card-expiry-year": "cardExpiry" // we don't validate month separately
            }
        });

        // adding the input field names is the last step, in case an earlier step errors                
        addInputNames();
    });
</script>
<script>
    $(document).ready(function() {
        $('#continue').click(function() {
            $('.loading').show();
            setTimeout(function() {
                window.location='<?php echo $_ENV['project_url']."provision-success?data=".$_GET['data'];?>';
            }, 4000)
        })
    })
</script>






</html>