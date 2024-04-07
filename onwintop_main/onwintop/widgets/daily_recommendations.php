
    
        <?php
            $s="SELECT * FROM `events` WHERE `community_id`='".$community_id."' ORDER BY `id` DESC";
            $data=$db->RetriveArray($s);
            foreach($data as $event){
                ?>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="event-post mb-3">
                        <figure><a href="<?php URL('/event/'.$event['url']);?>" title=""><img style="height:180px;width:100%" src="<?php echo $event['cover']; ?>" alt=""></a></figure>
                        <div class="event-meta">
                            <span><?php echo $event['name'];?></span>
                            <h6><a href="<?php URL('/event/'.$event['url']);?>" title=""><?php echo $event['name'];?></a></h6>
                            <p><?php echo $event['description'];?></p>
                            <a class="classic-btn" href="<?php URL('/event/'.$event['url']);?>" title="">Interested</a>
                            <div class="more">
                                <div class="more-post-optns">
                                    <i class="">
                                        <svg class="feather feather-more-horizontal" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="currentColor" fill="none" viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                                            <circle r="1" cy="12" cx="12" />
                                            <circle r="1" cy="12" cx="19" />
                                            <circle r="1" cy="12" cx="5" />
                                        </svg></i>
                                    <ul>
                                        <li>
                                            <i class="icofont-share-alt"></i>Share to Feed
                                            <span>Share This Post to Friends</span>
                                        </li>
                                        <li>
                                            <i class="icofont-ui-text-chat"></i>Send Message
                                            <span>Send This in messages, groups</span>
                                        </li>
                                        <li>
                                            <i class="icofont-ui-delete"></i>Delete Post
                                            <span>If inappropriate Post By Mistake</span>
                                        </li>
                                        <li>
                                            <i class="icofont-flag"></i>Report
                                            <span>Inappropriate content</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
        





