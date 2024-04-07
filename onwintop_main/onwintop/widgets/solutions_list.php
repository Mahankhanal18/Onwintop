<?php
    $s="SELECT * FROM `solutions` WHERE `community_id`='".$community_id."' ";
    $data=$db->RetriveArray($s);
    foreach($data as $sol){
        $thumbnail=$sol['thumbnail'];
    ?>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="course">
            <figure>
                <img src="<?php echo $thumbnail;?>" style='height:280px;width:100%' alt="">
                <em>Best choice</em>
            </figure>
            <div class="course-meta">

                <h5 class="course-title"><a href="<?php URL('/solution/'.$sol['id']);?>" title=""><?php echo $sol['name'];?></a></h5>
                <div class="course-info">

                </div>
            </div>
        </div>
    </div>


    <?php
    }
?>

