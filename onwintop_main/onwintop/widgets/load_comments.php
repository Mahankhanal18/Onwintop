<?php
include "../conf/conf.php";
include "../conf/controllers.php";
if (isset($_POST['content_id'])) {
    $db = new Database();
    $content = $db->RetriveSingle("SELECT * FROM `contents` WHERE `id`='" . $_POST['content_id'] . "' ");
    $comments = json_decode($content['comments'], true);
    foreach ($comments as $comment) {
        echo '
        <li>
            <figure><img alt="" src="https://ui-avatars.com/api/?name=' . $comment["name"] . '&background=random"></figure>
            <div class="commenter">
                <h5><a title="" href="#">' . $comment['name'] . '</a></h5>
                <span>' . $comment['time'] . '</span>
                <p>
                    ' . $comment['comment'] . '
                </p>
            </div>
        </li>
        ';
    }
}
