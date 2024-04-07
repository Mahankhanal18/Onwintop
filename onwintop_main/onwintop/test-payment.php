<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Stripe Sample Form</title>

        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
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
                    // remove the input field names for security
                    // we do this *before* anything else which might throw an exception
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
                        "card-cvc" : {
                            cardCVC: true,
                            required: true
                        },
                        "card-number" : {
                            cardNumber: true,
                            required: true
                        },
                        "card-expiry-year" : "cardExpiry" // we don't validate month separately
                    }
                });

                // adding the input field names is the last step, in case an earlier step errors                
                addInputNames();
            });
        </script>
    </head>
    <body>

        <h1>Stripe Example Form</h1>
    
        <form action="http://localhost:4000/payment" method="post" id="example-form" style="display: none;">
            <div class="form-row">
                <label for="email">E-mail Address</label>
                <input type="text" value="labofub@gmail.com" name="email" class="required" />
                <input type="hidden" name="description" value="6 Months">
                <input type="hidden" name="amount" value="599">
            </div> 
            
            <div class="form-row">
                <label>Card Number</label>
                <input type="text" value="4242424242424242" maxlength="20" autocomplete="off" class="card-number stripe-sensitive required" />
            </div>
            
            <div class="form-row">
                <label>CVC</label>
                <input type="text" value="123" maxlength="4" autocomplete="off" class="card-cvc stripe-sensitive required" />
            </div>
            
            <div class="form-row">
                <label>Expiration</label>
                <div class="expiry-wrapper">
                    <select class="card-expiry-month stripe-sensitive required">
                    </select>
                    <script type="text/javascript">
                        var select = $(".card-expiry-month"),
                            month = new Date().getMonth() + 1;
                        for (var i = 1; i <= 12; i++) {
                            select.append($("<option value='"+i+"' "+(month === i ? "selected" : "")+">"+i+"</option>"))
                        }
                    </script>
                    <span> / </span>
                    <select class="card-expiry-year stripe-sensitive required"></select>
                    <script type="text/javascript">
                        var select = $(".card-expiry-year"),
                            year = new Date().getFullYear();

                        for (var i = 0; i < 12; i++) {
                            select.append($("<option value='"+(i + year)+"' "+(i === 0 ? "selected" : "")+">"+(i + year)+"</option>"))
                        }
                    </script>
                </div>
            </div>

            <div class="form-row">
                <label for="name" class="stripeLabel">Your Name</label>
                <input type="text" value="Utpal" name="name" class="required" />
            </div>  

            <div class="form-row">
                <label for="name" class="stripeLabel">Address</label>
                <input type="text" value="TC 9/4 Old MES colony" name="address" class="required" />
            </div> 

            <div class="form-row">
                <label for="name" class="stripeLabel">City</label>
                <input type="text" value="1600 Amphitheatre Pkwy" name="city" class="required" />
            </div> 

            <div class="form-row">
                <label for="name" class="stripeLabel">State</label>
                <input type="text" value="Mountain View" name="state" class="required" />
            </div> 

            <div class="form-row">
                <label for="name" class="stripeLabel">County</label>
                <input type="text" value="United States" name="country" class="required" />
            </div>  

            <div class="form-row">
                <label for="name" class="stripeLabel">ZIP</label>
                <input type="text" value="94043" name="zip" class="required" />
            </div>  

            <button type="submit" name="submit-button">Submit</button>
            <span class="payment-errors"></span>
        </form>

        <!-- 
            The easiest way to indicate that the form requires JavaScript is to show
            the form with JavaScript (otherwise it will not render). You can add a
            helpful message in a noscript to indicate that users should enable JS.
        -->
        <script>if (window.Stripe) $("#example-form").show()</script>
        <noscript><p>JavaScript is required for the registration form.</p></noscript>

    </body>
</html>