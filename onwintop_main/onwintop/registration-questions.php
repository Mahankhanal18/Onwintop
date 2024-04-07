<?php include "init.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<?php
$edit_mode=false;
$save=false;

if(isset($_POST['additional'])){
    $additional=R::findOne("questions","WHERE community_id=?",[$_SESSION['community_id']]);
    if(!empty($additional)){
        //update
        $additional->community_id=$_SESSION['community_id'];
        $additional->data=$_POST['additional'];
        if(R::store($additional)){
            $save=true;
        }
    }else{
        //new
        $additional=R::dispense("questions");
        $additional->community_id=$_SESSION['community_id'];
        $additional->data=$_POST['additional'];
        if(R::store($additional)){
            $save=true;
        }
    }
}
$additional_data=R::findOne("questions","WHERE community_id=?",[$_SESSION['community_id']]);
if(!empty($additional_data)){
    $edit_mode=true;
}
?>
<head>
    <title>Registration Questions | <?php echo $title; ?></title>
    <?php include "includes/head.php"; ?>
    <style>
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
        .form-actions{
            display:none !important;
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
                                        <div class="main-title">Registration Questions</div>
                                        <small>*Additional registration informations required for new member registration </small>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div id="fb-editor"></div>
                                                <button class="button soft-primary" id='save'>Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <form action="" method='post' id='form'>
            <input type="hidden" name="additional" id='additional' value=''>
        </form>
        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>
    <script>
        $(document).ready(function() {


            var options = {
                disableFields: ['button','checkbox-group','autocomplete','file','hidden','number','radio-group','select']
            };
            var formBuilder=$('#fb-editor').formBuilder(options);
            //var formData = '[{"type":"text","label":"Full Name","subtype":"text","className":"form-control","name":"text-1476748004559"},{"type":"select","label":"Occupation","className":"form-control","name":"select-1476748006618","values":[{"label":"Street Sweeper","value":"option-1","selected":true},{"label":"Moth Man","value":"option-2"},{"label":"Chemist","value":"option-3"}]},{"type":"textarea","label":"Short Bio","rows":"5","className":"form-control","name":"textarea-1476748007461"}]';
            //formBuilder.actions.setData(formData);
            <?php
                if($edit_mode){
                    ?>
                    var data=JSON.parse('<?php echo $additional_data['data'];?>');
                    //console.log(data);
                    //formBuilder.actions.setData(data);
                    setTimeout(function(){ formBuilder.actions.setData(data); }, 800);
                    <?php
                }
            ?>

            $('#save').click(function(){
                data=JSON.stringify(formBuilder.actions.getData());
                $('#additional').val(data);
                $('#form')[0].submit();
            })
        })
    </script>


</body>

</html>