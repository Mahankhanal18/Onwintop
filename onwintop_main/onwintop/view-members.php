<?php include "init.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Members | <?php echo $title; ?></title>
    <?php include "includes/head.php"; ?>
    <?php
    if (isset($_POST['id'])) {
        $member = R::findOne("members", "WHERE id=?", [$_POST['id']]);
        $member->first_name = $_POST['first_name'];
        $member->last_name = $_POST['last_name'];
        $member->email = $_POST['email'];
        $member->password = $_POST['password'];
        $member->status = $_POST['status'];
        $member->role = $_POST['role'];
        R::store($member);
    }
    ?>
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

        .popup-wraper.active {
            z-index: 99;
        }

        .chosen-container {
            display: none;
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
                                        <div class="main-title">Members
                                        <a href='<?php URL('/registration-questions');?>' class='button soft-success' style='float:right;text-decoration:none'>
                                            <i class="">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings">
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                                </svg>
                                            </i>&nbsp;Registration Question
                                        </a>
                                        </div>
                                        
                                        <div class="row">
                                            <?php
                                            $members = R::findAll("members", "WHERE community_id=?", [$_SESSION['community_id']]);
                                            if (!empty($members)) {
                                            ?>
                                                <div class="col-md-12">
                                                    <table class='uk-table uk-table-divider'>
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>First Name</th>
                                                                <th>Last Name</th>
                                                                <th>Email</th>
                                                                <th>Role</th>
                                                                <th>Registration Date</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            foreach ($members as $member) {
                                                                $qstn="";
                                                                if(strlen($member['answers'])>5){
                                                                    $qstn="<a href='".URL_Make('/view-answers/'.$member['id'])."' data-password='" . $member['password'] . "' data-last-name='" . $member['last_name'] . "' data-email='" . $member['email'] . "' data-role='" . $member['role'] . "' class='button soft-success'><i class='icofont-question'></i></a>";
                                                                }
                                                                echo "
                                                                <tr>
                                                                    <td><img src='https://ui-avatars.com/api/?name=" . $member['first_name'] . " " . $member['last_name'] . "&background=random' style='height:35px;width:35px;border-radius:50%'></td>
                                                                    <td>" . $member['first_name'] . "</td>
                                                                    <td>" . $member['last_name'] . "</td>
                                                                    <td>" . $member['email'] . "</td>
                                                                    <td>" . $member['role'] . "</td>
                                                                    <td>" . date_format(date_create($member['registration_date']), 'd M, Y') . "</td>
                                                                    <td>" . $member['status'] . "</td>
                                                                    <td>
                                                                        ".$qstn."
                                                                        <button data-status='" . $member['status'] . "' data-id='" . $member['id'] . "' data-password='" . $member['password'] . "' data-first-name='" . $member['first_name'] . "' data-last-name='" . $member['last_name'] . "' data-email='" . $member['email'] . "' data-role='" . $member['role'] . "' class='button edit soft-primary'><i class='icofont-ui-edit'></i></button>
                                                                        <button data-status='" . $member['status'] . "' data-id='" . $member['id'] . "' data-password='" . $member['password'] . "' data-first-name='" . $member['first_name'] . "' data-last-name='" . $member['last_name'] . "' data-email='" . $member['email'] . "' data-role='" . $member['role'] . "' class='button remove soft-danger'><i class='icofont-ui-delete'></i></button>
                                                                    </td>
                                                                </tr>
                                                                ";
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-md-12" style='margin-bottom:300px;'>
                                                    <b style='padding:30px;text-align:center'>No members registered yet!</b>
                                                </div>
                                            <?php
                                            }
                                            ?>


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

    <!--Edit Member-->
    <div class="popup-wraper" id='edit-member'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5>Edit Member</h5>
                </div>
                <form action='' method='post' class="send-message c-form">
                    <div class="row">
                        <div class="col-md-6">
                            <label>First Name</label>
                            <input type="text" name="first_name" id="first_name">
                        </div>
                        <div class="col-md-6">
                            <label>Last Name</label>
                            <input type="text" name="last_name" id="last_name">
                        </div>
                        <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" id="email" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="col-md-6">
                            <label>Role</label></br>
                            <select name="role" id="role">
                                <option value="Member">Member</option>
                                <option value="Community Manager">Community Manager</option>
                                <option value="Community Admin">Community Admin</option>
                            </select>
                        </div></br>
                        <div class="col-md-6">
                            <label>Status</label></br>
                            <select name="status" id="status">
                                <option value="Active">Active</option>
                                <option value="Deactive">Deactive</option>
                            </select>
                        </div></br>
                        <input type="hidden" name="id" id='member_id' value=''>
                    </div>
                    <button type='submit' class="button soft-success mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>


    <!--Delete Member-->
    <div class="popup-wraper" id='remove-member'>
        <div class="popup">
            <span class="popup-closed"><i class="icofont-close"></i></span>
            <div class="popup-meta">
                <div class="popup-head">
                    <h5>Remove Member</h5>
                </div>
                <div class="send-message c-form">
                    <span class="text-danger">
                        Are you sure want to remove this user?
                    </span></br></br>
                    <button id='yes' class="button soft-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <form id='remove_form' action="" method='post'>
        <input type="hidden" name="remove_id" id='remove_id' value=''>
    </form>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#role').select2();
            $('#status').select2();
            var selected_id=0;
            $('.edit').click(function() {
                first_name = $(this).attr('data-first-name');
                last_name = $(this).attr('data-last-name');
                status = $(this).attr('data-status');
                email = $(this).attr('data-email');
                password = $(this).attr('data-password');
                role = $(this).attr('data-role');
                id = $(this).attr('data-id');
                $('#first_name').val(first_name);
                $('#last_name').val(last_name);
                $('#email').val(email);
                $('#password').val(password);
                $('#role').val(role);
                $('#role').trigger('change');
                $('#status').val(status);
                $('#status').trigger('change');
                $('#member_id').val(id);
                $('#edit-member').addClass('active');
            })
            $('.remove').click(function(){
                selected_id=$(this).attr('data-id');
                $('#remove-member').addClass('active');
            })
            $('#yes').click(function(){
                $('#remove_id').val(selected_id);
                $('#remove_form')[0].submit();
            })
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</body>

</html>