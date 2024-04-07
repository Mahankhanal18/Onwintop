<?php
include "init.php";
$link = UID(6);
$url_parts = URL_Parts();
$edit_mode = false;
$method = $url_parts[6];
if ($method == 'manage-event') {
    $event = R::findOne("events", "WHERE url=?", [$url_parts[7]]);
}

if(isset($_POST['invite-email'])){
    //print_r($_POST);
    $inv=R::dispense("guests");
    $inv->email=$_POST['invite-email'];
    $inv->event_id=$event['url'];
    $inv->status='Invited';
    $inv->date=date('Y-m-d');
    if(R::store($inv)){
        SendMail($_POST['invite-subject'], $_POST['invite-email'], 'Guest', $_POST['invite-msg']);    
    }
}

if(isset($_POST['guest_id'])){
    $guest=R::findOne("guests","WHERE id=?",[$_POST['guest_id']]);
    $guest->status=$_POST['status'];
    R::store($guest);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php if ($edit_mode) echo "Manage Event";
            else echo "Manage Event"; ?> | <?php echo $title; ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <?php include "includes/head.php"; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #category_chosen {
            display: none;
        }

        .select2-container--default .select2-selection--single {
            background: #f8fafa none repeat scroll 0 0;
            border: 1px solid #eaeaea;
            border-radius: 7px;
            color: #535165;
            font-size: 13px;
            cursor: text;
            height: 40px;
            padding-top: 5px;
            position: relative;
        }

        .uk-tab-left>*>a {
            justify-content: left;
            border-right: 1px solid transparent;
            border-bottom: none;
            padding-top: 10px;
            padding-bottom: 10px;
            font-size: 16px;
            text-transform: capitalize !important;
        }

        .post {
            display: none;
        }

        .uk-card-default {
            color: #666;
            box-shadow: 0 1px 5px rgb(0 0 0 / 8%);
        }

        .uk-card-default {
            display: inline-block;
            margin-bottom: 15px !important;
            margin-top: 0px;
            width: 100%;
            background-color: #ffffff8f;
        }

        #invite:hover {
            cursor: pointer;
        }

        #new_remainder:hover {
            cursor: pointer;
        }

        .uk-width-expand {
            flex: 1;
            min-width: 1px;
            width: 70vw !important;
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
                                    <div class="main-wraper">
                                        <div class="main-title"><?php echo "Manage Event"; ?>
                                        </div>
                                        <div class="d-widget-content">
                                            <div id='create-data' action='' method='post' class="c-form">
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <div uk-grid style='width:100% !important'>
                                                            <div>
                                                                <div uk-grid>
                                                                    <div class="uk-width-auto">
                                                                        <ul class="uk-tab-left" uk-tab="connect: #component-tab-left; animation: uk-animation-fade">
                                                                            <li><a href="#"><i class="icofont-people"></i>Guests</a></li>
                                                                            <li><a href="#"><i class="icofont-email"></i>Emails</a></li>
                                                                        </ul>
                                                                    </div>
                                                                    <div class="uk-width-expand">
                                                                        <ul id="component-tab-left" class="uk-switcher">
                                                                            <li>
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <h5>Guests</h5>
                                                                                        <p>This event requires registration. Only registered guests can see meeting informations.</p>
                                                                                        <div class="card">
                                                                                            <div class="card-body">
                                                                                                <div class="form-group">
                                                                                                    <label for="">Invite Guests</label>
                                                                                                    <input type="text" id='email' placeholder="Enter Email Address">
                                                                                                    <span class="button soft-success" id='invite'><i class="icofont-send-mail"></i> Send Invitation</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6 mt-4">
                                                                                        <label><input type="checkbox"> Stop Registration</label>
                                                                                    </div>
                                                                                    <div class="col-md-6 mt-4">
                                                                                        <label><input type="checkbox" checked> Notify Me as Guests Register</label>
                                                                                    </div>
                                                                                    <div class="col-md-12 mt-4">
                                                                                        <h5>Guest List</h5>
                                                                                        <table class="uk-table uk-table-striped">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Guest</th>
                                                                                                    <th>Date</th>
                                                                                                    <th>Status</th>
                                                                                                    <th>Action</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <?php
                                                                                                    $guests=R::findAll("guests","WHERE event_id=?",[$event['url']]);
                                                                                                    foreach($guests as $guest){
                                                                                                        echo "
                                                                                                        <tr>
                                                                                                            <td>".$guest['email']."</td>
                                                                                                            <td>".date_format(date_create($guest['date']),'d M Y')."</td>
                                                                                                            <td>".$guest['status']."</td>
                                                                                                            <td>
                                                                                                                <button data-id='".$guest['id']."' data-status='".$guest['status']."' class='status button soft-primary'><i class='icofont-ui-settings'></i></button>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        ";
                                                                                                    }
                                                                                                    if(count($guests)==0){
                                                                                                        echo "
                                                                                                        <tr>
                                                                                                            <td colspan='4' style='text-align:center;padding:30px'>
                                                                                                                No Guests Registered
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                        ";
                                                                                                    }
                                                                                                ?>
                                                                                                
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                            <li>
                                                                                <div class="row">
                                                                                    <!--<div class="col-md-12">
                                                                                        <h5>Registration</h5>
                                                                                        <div class="card mt-2">
                                                                                            <div class="card-body">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-1">
                                                                                                        <i style='font-size:40px' class="icofont-envelope"></i>
                                                                                                    </div>
                                                                                                    <div class="col-md-10">
                                                                                                        <b>Registration confirmed for Sales Demo Webinar</b>
                                                                                                        <p>To: All Guests</p>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>-->
                                                                                    <div class="col-md-12">
                                                                                        <h5>Schedules</h5>

                                                                                        <div class="card mt-2">
                                                                                            <div class="card-body text-center guests-scheduled">
                                                                                                <b style='padding:30px'>
                                                                                                    No Email Schedules
                                                                                                </b>
                                                                                            </div>
                                                                                        </div>
                                                                                        <span class="button soft-dark mt-2" id='new_remainder'>+ New Schedule</span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
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
                </div>
            </div>
        </section>
        <?php include "includes/footer.php"; ?>
    </div>
    <!--New Session Popup-->
    <div class="popup-wraper" id='invite-email'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5>Invite Guest</h5>
                </div>
                <form action='' id='invite-form' method='post' class="send-message c-form">
                    <input type='hidden' name='invite-email' id='invite-addr' value=''/>
                    <input type="text" name="invite-subject" value="Invitation to attend event - <?php echo $event['name'];?>" placeholder='Subject' required>
                    <textarea name="invite-msg" id="" cols="30" rows="10" placeholder="Enter Message" required>
Hi,
We would like to invite you to our event <?php echo $event['name'];?>. To join this event register here - <?php echo URL_Make('event/'.$event['url']);?>
                    </textarea>
                    <button type='submit' class="button soft-success">Send</button>
                </form>
            </div>
        </div>
    </div>

    <!--New Update Guests-->
    <div class="popup-wraper" id='status-popup'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5>Update Status</h5>
                </div>
                <form action='' method='post' class="send-message c-form">
                    <select name='status' id='guest_status' style='width:100%'>
                        <option>Invited</option>
                        <option>Accepted</option>
                        <option>Approved</option>
                        <option>Declined</option>
                    </select>
                    <input type='hidden' name='guest_id' id='guest_id'/>
                    <button class="button soft-success mt-2">Save</button>
                </form>
            </div>
        </div>
    </div>
    
    <!--New Session Popup-->
    <div class="popup-wraper" id='remainder-email'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5>New Schedule</h5>
                </div>
                <form id='schedule-form' class="send-message c-form">
                    <label>Audience:</label></br>
                    <select name='audience' style='width:100%'>
                        <option>To Invited Guests</option>
                        <option>To Registered Guests</option>
                        <option>To Accepted Guests</option>
                        <option>To Declined Guests</option>
                    </select></br></br>
                    <input type="text" name="subject" placeholder='Subject' class='mt-1' id="">
                    <input type='hidden' name='event_id' value='<?php echo $event["url"];?>'/>
                    <input type='hidden' name='method' value='NEW'/>
                    <textarea name="message" id="" cols="30" rows="10" placeholder="Enter Message"></textarea>
                    <button type='submit' class="button soft-success">Send</button>
                </form>
            </div>
        </div>
    </div>


    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            
            $('#schedule-form').on('submit',function(e){
                e.preventDefault();
                $.ajax({
                    url:'<?php echo $root;?>api/schedule-email.php',
                    type:'POST',
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data){
                        GetGuests();
                    }
                })
            })
            $('.status').click(function(){
                data_id=$(this).attr('data-id');
                status=$(this).attr('data-status');
                $('#guest_status').val(status).trigger('change');
                $('#guest_id').val(data_id);
                $('#status-popup').addClass('active');
            })
            $('#new_remainder').click(function() {
                $('#remainder-email').addClass('active');
            })
            $('#invite').click(function() {
                email=$('#email').val();
                if(email.length!=0){
                    $('#invite-addr').val(email);
                    $('#invite-email').addClass('active'); 
                    
                }else{
                    alertify.error('Please enter an email address first');
                }
            });
            GetGuests();
            function GetGuests(){
                $.ajax({
                    url:'<?php echo $root;?>api/schedule-email.php',
                    type:'POST',
                    method:'POST',
                    data:{
                        event_id:'<?php echo $event['url'];?>',
                        method:'GET',
                    },
                    success:function(data){
                        //alert(data);
                        $('#remainder-email').removeClass('active');
                        $('.guests-scheduled').html(data);
                    }
                })
            }

        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
</body>

</html>