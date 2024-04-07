<?php
include "../init.php";
$db = new Database();
$s = "SELECT * FROM `channels` WHERE `community_link`='" . $_POST['community_link'] . "' ";
$channels = $db->RetriveArray($s);
?>
<?php
/*echo "<div class='books-caro owl-carousel owl-theme owl-responsive-1000 owl-loaded'>";
    foreach($channels as $channel){
        echo "
        <div class='book-post'>
            <figure><a href='".URL_Make('/channel/'.$channel['link'])."'><img src='".$channel['thumbnail']."' style='height:270px;width:300px' alt=''></a></figure>
            <a href='".URL_Make('/channel/'.$channel['link'])."' >".$channel['name']."</a>
        </div>
        ";
    }
    echo "</div>";*/
?>
<div class="book-post">
    <figure><a href="event-detail.html" title=""><img src="images/resources/book1.jpg" alt=""></a></figure>
    <a href="event-detail.html" title="">Html5 Brick Breaker</a>
</div>
<div class="book-post">
    <figure><a href="event-detail.html" title=""><img src="images/resources/book3.jpg" alt=""></a></figure>
    <a href="event-detail.html" title="">Python Tricks</a>
</div>
<div class="book-post">
    <figure><a href="event-detail.html" title=""><img src="images/resources/book5.jpg" alt=""></a></figure>
    <a href="event-detail.html" title="">Technology Wants</a>
</div>
<div class="book-post">
    <figure><a href="event-detail.html" title=""><img src="images/resources/book2.jpg" alt=""></a></figure>
    <a href="event-detail.html" title="">The Aesthetic Ideology</a>
</div>
<div class="book-post">
    <figure><a href="event-detail.html" title=""><img src="images/resources/book4.jpg" alt=""></a></figure>
    <a href="event-detail.html" title="">Holy Bible Old</a>
</div>