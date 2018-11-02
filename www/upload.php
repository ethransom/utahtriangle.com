<?php

use Aws\S3\Exception\S3Exception;

require '../s3/app/start.php';

if(isset($_FILES['file'])){
    $file = $_FILES['file'];
    
    // File details
    $name = $file['name'];
    $tmp_name = $file['tmp_name'];
    
    $extension = explode('.', $name);
    $extension = strtolower(end($extension));
    
    // Temp details
    $key = md5(uniqid());
    $tmp_file_name = "{$key}.{$extension}";
    $tmp_file_path = "uploads/{$tmp_file_name}";
    
    // Move the file
    move_uploaded_file($tmp_name, $tmp_file_path);
    
    try {
        
        $s3->putObject([
            'Bucket' => $config['s3']['bucket'],
            'Key' => "uploads/{$tmp_file_name}",
            'Body' => fopen($tmp_file_path, 'rb'),
            'ACL' => 'public-read'
        ]);
        
        // Remove the file
        unlink($tmp_file_path);
        
        $bucket = $s3->getObjectUrl($config['s3']['bucket']);
        $return_url = $bucket . "uploads/{$tmp_file_name}";
        die($return_url);
        
    } catch(S3Exception $e) {
        die("There was an error uploading that file.");
    }
}

?>