<?php

$file_name = 'Promo+720p+Take+2.mp4';
$file_url = 'https://s3-us-west-2.amazonaws.com/claytoncoredesign/' . $file_name;
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"".$file_name."\""); 
readfile($file_url);
exit;

?>