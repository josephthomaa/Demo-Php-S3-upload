<?php
// Bucket Name
$bucket="watchwithme";


use Aws\S3\S3Client;
 
//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', '');
if (!defined('awsSecretKey')) define('awsSecretKey', '');

  $client = S3Client::factory(
      array(
	  'version'     => 'latest',
                'region'      => 'ap-south-1',
				'credentials' => [
      'key'    => "",
      'secret' => ""
       ])
      );
	  

?>
