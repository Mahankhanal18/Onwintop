<?php
require_once("init.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "head.php";?>
    <title>Payment</title>
    
    <?php
    $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
    if (isset($_GET['data'])) {
        $data = base64_decode($_GET['data']);
        $data = json_decode($data, true);
        $plan=R::findOne("plans","id=?",[$data['plan_id']]);
    }
    
    ?>
    <style>
        .nav-tabs {
            background-color: #ffffff !important;
        }

        .nav-link {
            color: #000000 !important;
            font-size: 14px !important;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            border-color: #ffffff !important;
            margin-bottom: 0px !important;
            border-bottom: none !important;
        }

        .nav-tabs .inner.active {
            border-color: #efefef !important;
            border-radius: 5px;
            background-color: #efefef;
            border: none !important;
        }

        .card {
            border-radius: 0px !important;
        }

        .card-img-top {
            border-radius: 0px !important;
        }

        .challange {
            color: gray;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            border-bottom: none !important;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link {
            border-bottom: none !important;
            border-radius: 0px !important;
        }

        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: #fff0 !important;
            color: var(--primary-color) !important;
        }

        .container_ {
            list-style: none;
            column-gap: 0;
            padding: 0;
            column-count: 3;
        }

        .card_ {
            width: 100%;
            height: auto;
            padding: 5px;
            margin: 0;
            box-sizing: border-box;
            break-inside: avoid;
        }

        #myTabContent2 .nav-link.active {
            background-color: #ffffff !important;
            border: none !important;
            color: #000000 !important;
            font-size: 13px;
        }

        #myTabContent2 .nav-link {
            border: none !important;
            font-size: 13px;
        }

        a:hover {
            color: #000000 !important;
        }

        .nav-menu {
            margin: 0px;
            list-style-type: none;
            display: inline;
        }

        .nav-menu li {
            display: inline;
            margin-right: 20px;
            margin-left: 10px;
        }

        .nav-menu li a {
            text-decoration: none;
            color: #000000;
            font-size: 16px;
        }

        .nav-menu li a:hover {
            color: var(--secondary-color) !important;
        }

        .nav-menu li a.active {
            color: var(--secondary-color) !important;
        }

        .card-rec {
            border-radius: 5px;
            box-shadow: 0px 0px 10px #ebebeb;
        }

        .card-body {
            border-radius: 5px;
        }

        .dis-type {
            font-size: 18px;
            text-decoration: none;
            font-weight: 500;
            color: #000000;
        }

        .dis-type:hover,
        .dis-type.active {
            color: var(--primary-color) !important;
            border-bottom: 4px solid var(--primary-color);
        }

        .card-det-drop {
            width: 100%;
            border: none;
            text-align: left;
        }
    </style>
    <?php
    $titles = array(
        'File without fields', 'Ultimate', 'Final Test', 'Test file'
    );
    $images = array(
        'https://res.cloudinary.com/tellselling/image/upload/v1668443216/uzjhvhdarh8z6c7gw5qm.jpg', 'https://res.cloudinary.com/tellselling/image/upload/v1668462227/gu2s6wonlusm9za5unlt.jpg', 'https://res.cloudinary.com/tellselling/image/upload/v1668455277/ng7j9dsghccce2ds0mra.jpg', 'https://via.placeholder.com/600x400.png?text=Thumbnail+Image'
    );
    ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v1/"></script>

</head>
<div class='data' style='display:none'>

    <body>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
        <title>Payment</title>
        <div class="navbar navbar-light" id="io3q"> <a href="#" class="navbar-brand">
                <center id="ikc8k">
                    <h4 class="text-white">Onwintop Welcome </h4>
                </center>
            </a></div><a href="#" class="navbar-brand">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 px-0" id="iwq6h"> <img src="https://app-dev.onwintop.com/focus-editor/topbar.png" alt="" srcset="" id="ide1e" />
                        <div id="myTabContent" class="tab-content">
                            <div id="home" class="tab-pane fade show active"> <img src="https://app-dev.onwintop.com/focus-editor/content.png" id="i0ebf" /> <img src="https://app-dev.onwintop.com/focus-editor/leaderboard.png" alt="" srcset="" id="ikq8h" /> </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </body>
</div>

<body style='background-color:#eff2f9;'>
    <?php include "nav.php";?>
    <div class="container">
        <form action="" id='plan' method="post">
            <input type="hidden" id="plan_name" name="plan_name" value="">
            <input type="hidden" id="plan_amount" name="plan_amount" value="<?php echo $plan['amount'];?>">
        </form>
        <div class="row">
            <div class="col-md-12 px-5">
                <div class='row'>
                    <div class="col-md-12 py-4">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <div class="card p-4" style="height:450px;border-radius:10px !important;">
                                    <h4>€ <?php echo $plan['amount'];?></h4>
                                    <p><?php echo $plan['name'];?></p>
                                    <ul>
                                        <?php
                                            $features=json_decode($plan['features'],true);
                                            foreach($features as $feature){
                                                echo "<li>".$feature."</li>";
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card" style="border:none;">
                                    <div class="card-body p-4">
                                        <form action='https://organic-service-371417.de.r.appspot.com/payment' method="post" id="example-form" style="display: none;">
                                            <div class="form-group">
                                                <label for="email">E-mail Address</label>
                                                <input type="text" value="" name="email" class="form-control" />
                                                <input type="hidden" name="description" value="<?php echo $plan['name']; ?>">
                                                <input type="hidden" name="data" value="<?php echo json_encode($data);?>">
                                                <input type='hidden' name='community_id' value="<?php echo $community_id;?>">
                                                <input type="hidden" name="amount" value="<?php echo $plan['amount'];?>">
                                            </div>

                                            <div class="form-group mt-2">
                                                <label>Card Number</label>
                                                <input type="text" value="" maxlength="20" autocomplete="off" class="card-number stripe-sensitive form-control" />
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label>Expiration</label>
                                                        <div class="expiry-wrapper form-control">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <select class="card-expiry-month stripe-sensitive card-det-drop">
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
                                                                    <select class="card-expiry-year stripe-sensitive card-det-drop"></select>
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
                                                        <input type="text" value="" maxlength="4" autocomplete="off" class="card-cvc stripe-sensitive form-control" />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group mt-2">
                                                <label class="stripeLabel">Your Name</label>
                                                <input type="text" placeholder="Full Name" name="name" class="form-control" />
                                            </div>

                                            <div class="form-group mt-2">
                                                <label for="name" class="stripeLabel">Address</label>
                                                <input type="text" placeholder="TC 9/4 Old MES colony" name="address" class="form-control" />
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

                                            <button type="submit" class='btn btn-success mt-3' style="width:100%" name="submit-button">Submit</button>
                                            <span class="payment-errors"></span>
                                        </form>
                                        <script>
                                            if (window.Stripe) $("#example-form").show()
                                        </script>
                                        <noscript>
                                            <p>JavaScript is required for the registration form.</p>
                                        </noscript>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center my-5">
        <img src="<?php echo $_ENV['project_url'];?>challenge-focus/supported.png" style="height:25px;width:auto;" alt="" srcset=""></br></br>
        <small class="text-secondary">We accept all major payment methods and procedd payments </br> with Stripe SSL Secure /256-bit SSL secure checkout. 7-Day Money Back Guarantee.</small>
    </div>
</body>
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

</html>