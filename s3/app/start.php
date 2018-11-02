<?php

use Aws\S3\S3Client;

require '../s3/vendor/autoload.php';

$config = require('config.php');

//s3
$s3 = S3Client::factory([
    'credentials' => $config['s3']['credentials'],
    'region' => $config['s3']['region'],
    'version' => $config['s3']['version']
])

?>