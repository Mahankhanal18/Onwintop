<?php  
$fp = fopen('cron.txt', 'a');//opens file in append mode  
fwrite($fp, time().' last crawl /n');  
fclose($fp);  
?>  