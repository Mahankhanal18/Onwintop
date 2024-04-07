<style>
    .form-actions{
        display:none !important;
    }
        #category_chosen {
            display: none;
        }

        .chosen-container-multi .chosen-choices {
            background: #f8fafa none repeat scroll 0 0 !important;
            border: 1px solid #eaeaea;
            border-radius: 7px;
            color: #535165;
            padding: 5px;
            font-size: 13px;
            cursor: text;
            padding-bottom: 5px;
            padding-right: 5px;
            position: relative;
        }

        .select2-container--default .select2-selection--multiple {
            background: #f8fafa none repeat scroll 0 0;
            border: 1px solid #eaeaea;
            border-radius: 7px;
            color: #535165;
            font-size: 13px;
            cursor: text;
            padding-bottom: 5px;
            padding-right: 5px;
            position: relative;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            display: inline;
            list-style: none;
            padding: 0;
            float: left;
            padding-top: 5px;
            padding-left: 5px;
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            display: inline;
            list-style: none;
            padding: 0;
            float: left;
            padding-top: 5px;
            padding-left: 5px;
        }

        #tag_btn:hover {
            cursor: pointer;
        }

        .post {
            display: none;
        }
    </style>
<h5 class='pb-2'>Quiz</h5>


<span class='btn btn-warning btn-add-qstn' style="float:right">Add Question</span>
<!--<div id="quiz-editor"></div> -->
<div class='container' id='quiz-questions' style="width:100%;padding:15px;background-color:#ffffff;">
    <div class='width:100%;padding:45px'>
        <center><b>No Questions Available</b></center>
    </div>
    
</div>
<div class="popup-wraper" id='add_quiz_qstn'>
    <div class="popup">
        <span class="popup-closed"><i class="icofont-close"></i></span>
        <div class="popup-meta">
            <div class="popup-head">
                <h5><i class="fa fa-filter"></i> Add Question</h5>
            </div>
            <div class="send-message">
                <form id='qstn-form' class='row'>
                    <div class='col-md-12'>
                        <label>Enter your question</label>
                        <input type='text' class='form-control' name='question' id='qtz_question'/>
                    </div>
                    <div class='col-md-12 row'>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label>Option 1</label>
                                <input type='text' class='form-control' name='option1' id='option1' placeholder='Enter Option 1'/>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label>Option 2</label>
                                <input type='text' class='form-control' name='option2' id='option2' placeholder='Enter Option 2'/>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label>Option 3</label>
                                <input type='text' class='form-control' name='option3' id='option3' placeholder='Enter Option 3'/>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label>Option 4</label>
                                <input type='text' class='form-control' name='option4' id='option4' placeholder='Enter Option 4'/>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12 row'>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label>Enter Answer</label>
                                <input type='test' class='form-control' name='answer' id='answer'/>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label>Enter Credit</label>
                                <input type='number' class='form-control' name='credit' id='credit'/>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <span id='submit-qstn' class='btn btn-success'>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</br></br>

<span class='btn btn-primary mt-3' id='save-quiz'>Save</span>