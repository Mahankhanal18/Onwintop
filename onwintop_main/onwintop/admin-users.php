<?php include "init.php";
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
$credentials = json_decode($_SESSION['community_credentials'], true);

if (isset($_POST['email'])) {
    $user = R::dispense("users");
    $user->role = $_POST['role'];
    $user->email = $_POST['email'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->password = '';
    $user->tenant_id = $_POST['tenant_id'];
    $user->photo = 'https://ui-avatars.com/api/?name=' . $_POST['first_name'] . '%20' . $_POST['last_name'] . '&background=random';
    $user->creation_time = date('d M Y h:ia');
    $user->plan = 'FREE';
    $user->status = 'Pending';
    if (R::store($user)) {

        //add member to all communities
        $communities = R::findAll("communities", "WHERE tenant_id=?", [$_POST['tenant_id']]);
        foreach ($communities as $com) {
            $member = R::dispense("members");
            $member->community_id = $com['link'];
            $member->first_name = $_POST['first_name'];
            $member->last_name = $_POST['last_name'];
            $member->password = '';
            $member->email = $_POST['email'];
            $member->role = 'Community Manager';
            $member->designation = 'Community Manager';
            $member->registration_date = date('Y-m-d');
            $member->status = 'Active';
            R::store($member);
        }


        $obj = array(
            "first_name" => $_POST['first_name'],
            "last_name" => $_POST['last_name'],
            "email" => $_POST['email'],
            "role" => $_POST['role'],
            "tenant_id" => $_POST['tenant_id'],
        );
        $invite_url = json_encode($obj);
        $invite_url = base64_encode($invite_url);
        $invite_url = str_replace("=", '', $invite_url);
        $complete_url = $root . $invite_url . "/invite";
        $body = "
        <p>
        Hi " . $_POST['first_name'] . "!</br>
        We’ve given you access to our portal so that you can manage your journey with us and get to know all the possibilities offered by Tellselling.
        If you want to create an account, please click on the following link: </br>
        " . $complete_url . "</br>
        </p>
        ";
        SendMail("Account Activation Invitation", $_POST['email'], $_POST['first_name'] . " " . $_POST['last_name'], $body);
    }
}
if (isset($_POST['remove_user'])) {
    $user = R::findOne("users", "WHERE email=?", [$_POST['remove_user']]);
    R::trash($user);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Users | Tellselling</title>
    <?php include "includes/head_admin.php"; ?>
    <style>
        .daywise:hover {
            cursor: pointer;
        }

        .post {
            display: none;
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
    </style>
</head>

<body>
    <!--<div class="page-loader" id="page-loader">
        <div class="loader"><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span><span class="loader-item"></span></div>
    </div> -->
    <div class="theme-layout">
        <?php include "includes/header_admin.php"; ?>
        <?php include "includes/nav_admin.php"; ?>
        <section>
            <div class="gap" style='padding-left:300px'>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="page-contents" class="row merged20">
                                <div class="col-lg-12">
                                    <div class="main-wraper blank-wrapper">
                                        <div class="main-title">Users
                                            <button class="button soft-primary invite" style='float:right'>+ Invite User</button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>First Name</th>
                                                            <th>Last Name</th>
                                                            <th>Email</th>
                                                            <th>Member Since</th>
                                                            <th>Role</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $users = R::findAll("users", "WHERE tenant_id=?", [$credentials['tenant_id']]);
                                                        foreach ($users as $user) {
                                                            echo "
                                                                <tr>
                                                                    <td>
                                                                        <img src='" . $user['photo'] . "' style='height:40px;width:40px;border-radius:50%'/>
                                                                    </td>
                                                                    <td>" . $user['first_name'] . "</td>
                                                                    <td>" . $user['last_name'] . "</td>
                                                                    <td>" . $user['email'] . "</td>
                                                                    <td>" . $user['creation_time'] . "</td>
                                                                    <td>" . $user['role'] . "</td>
                                                                    <td>" . $user['status'] . "</td>
                                                                    <td>
                                                                        <button data-first-name='" . $user['first_name'] . "' data-email='" . $user['email'] . "' data-role='" . $user['role'] . "' data-last-name='" . $user['last_name'] . "' class='button edit soft-primary'><i class='icofont-ui-edit'></i></button>
                                                                        <button data-first-name='" . $user['first_name'] . "' data-email='" . $user['email'] . "' data-role='" . $user['role'] . "' data-last-name='" . $user['last_name'] . "' class='button permission soft-success'><i class='icofont-settings'></i></button>
                                                                        <button data-first-name='" . $user['first_name'] . "' data-email='" . $user['email'] . "' data-role='" . $user['role'] . "' data-last-name='" . $user['last_name'] . "' class='button remove soft-danger'><i class='icofont-ui-delete'></i></button>
                                                                    </td>
                                                                </tr>
                                                                ";
                                                        }
                                                        if (count($users) == 0) {
                                                            echo "
                                                                <tr>
                                                                    <td colspan='7' style='text-align:center;padding:35px'>
                                                                        <b>No Users Available</b>
                                                                    </td>
                                                                </tr>
                                                                ";
                                                        }
                                                        ?>

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
        </section>

        <?php include "includes/footer.php"; ?>
    </div>
    <!--New Session Popup-->
    <div class="popup-wraper" id='invite'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="icofont-ui-user mr-2"></i>Invite User</h5>
                </div>
                <div class="send-message">
                    <form id='invite-user' action='' method='post' class="c-form mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                </br>
                                <label>First Name:</label>
                                <input type="text" name='first_name' placeholder="Enter First Name" required>
                                <label>Last Name:</label>
                                <input type="text" name='last_name' placeholder="Enter Last Name" required>
                                <label>Email:</label>
                                <input type="email" name='email' id='email' placeholder="Enter Email Address" required>
                                <label>Role:</label>
                                <input type="text" name='role' placeholder="Enter Role" required>
                                <input type="hidden" name='tenant_id' value="<?php echo $credentials['tenant_id']; ?>" placeholder="Community Link" readonly>
                            </div>
                        </div>
                        <b class='text-danger error'></b></br>
                        <button type='submit' id='save-btn' class="button soft-primary">Send Invitation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Edit User-->
    <div class="popup-wraper" id='edit_user'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="icofont-ui-user mr-2"></i>Invite User</h5>
                </div>
                <div class="send-message">
                    <form id='edit-user' action='' method='post' class="c-form mb-4">
                        <div class="row">
                            <div class="col-md-12">
                                </br>
                                <label>First Name:</label>
                                <input type="text" name='first_name' id='first_name' placeholder="Enter First Name" required>
                                <label>Last Name:</label>
                                <input type="text" name='last_name' id='last_name' placeholder="Enter Last Name" required>
                                <label>Email:</label>
                                <input type="email" name='email' id='email_edit' placeholder="Enter Email Address" required>
                                <label>Role:</label>
                                <input type="text" name='role' id='role' placeholder="Enter Role" required>
                                <input type="hidden" name='tenant_id' value="<?php echo $credentials['tenant_id']; ?>" placeholder="Community Link" readonly>
                            </div>
                        </div>
                        <b class='text-danger error'></b></br>
                        <button type='submit' id='save-btn' class="button soft-primary">Send Invitation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Remove User-->
    <div class="popup-wraper" id='remove'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="icofont-ui-delete mr-2"></i>Remove User</h5>
                </div>
                <div class="send-message">
                    <form action='' method='post' class="c-form mb-4">
                        <b class='text-danger error'>Are you sure want to delete this user?</b></br>
                        <input type="hidden" name="remove_user" value='' id='selected_email'>
                        <button type='submit' id='delete' class="button soft-danger mt-2">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Permission-->
    <div class="popup-wraper" id='permissions'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5><i class="icofont-settings mr-2"></i>Manage Permissions</h5>
                </div>
                <div class="send-message">
                    <form id='edit-user' class="c-form mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                    <label class="form-check-label" for="exampleCheck1">Manage Channels</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                    <label class="form-check-label" for="exampleCheck1">Manage Files</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                    <label class="form-check-label" for="exampleCheck1">Manage Videos</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                    <label class="form-check-label" for="exampleCheck1">Manage Blogs</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                    <label class="form-check-label" for="exampleCheck1">Manage Support</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Manage Users</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" checked>
                                    <label class="form-check-label" for="exampleCheck1">Manage Events</label>
                                </div>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Manage Billing</label>
                                </div>
                            </div>
                        </div>
                        <b class='text-danger error'></b></br>
                        <button type='submit' id='save-btn' class="button soft-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script>
        $(document).ready(function() {
            selected_email = '';
            $('.invite').click(function() {
                $('#invite').addClass('active');
            })
            $('.permission').click(function() {
                $('#permissions').addClass('active');
            })
            $('.remove').click(function() {
                selected_email = $(this).attr('data-email');
                $('#selected_email').val(selected_email);
                $('#remove').addClass('active');

            })
            //Edit User
            $('.edit').on('click', function() {
                first_name = $(this).attr('data-first-name');
                last_name = $(this).attr('data-last-name');
                email = $(this).attr('data-email');
                role = $(this).attr('data-role');
                $('#first_name').val(first_name);
                $('#last_name').val(last_name);
                $('#email_edit').val(email);
                $('#role').val(role);
                $('#edit_user').addClass('active');
            });
            //Invite User
            $('#invite-user').on('submit', function(e) {
                e.preventDefault();
                email = $('#email').val();
                $.ajax({
                    url: '<?php echo $root; ?>api/invite_user.php',
                    method: 'POST',
                    type: 'POST',
                    data: {
                        method: 'CHECK',
                        email: email
                    },
                    success: function(data) {
                        if (data == '200') {
                            $('#invite-user')[0].submit();
                        } else {
                            $('.error').html(data);
                        }
                    }
                })
            })
        })
    </script>
</body>

</html>