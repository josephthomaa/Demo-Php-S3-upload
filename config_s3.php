<?php
// Bucket Name
$bucket="watchwithme";


use Aws\S3\S3Client;
 
//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJFJM3MLADO2LOPBQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');

  $client = S3Client::factory(
      array(
	  'version'     => 'latest',
                'region'      => 'ap-south-1',
				'credentials' => [
      'key'    => "AKIAJFJM3MLADO2LOPBQ",
      'secret' => "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"
       ])
      );
	  

?>
