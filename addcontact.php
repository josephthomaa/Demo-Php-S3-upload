<?php
require('aws/aws-autoloader.php');
     use Aws\S3\S3Client;
     use Aws\S3\Exception\S3Exception;
	 $message='';
$servername = "localhost";
$username = "root";
$password = "";//accessme
$dbname = "dcard";
error_reporting(0);
$con = new mysqli($servername, $username, $password,$dbname);

if ($con->connect_error) {
   d_response(0,'Could not connect to server ',0);
} 



class Response {
    public $status = "";
    public $message  = "";
	public $profileId = "";
    public $profileLink = "";
}

//$con = mysqli_connect("localhost","root","","test");

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$jsonObj = json_decode(file_get_contents("php://input"), true);

//file_put_contents("text.txt",$jsonObj);
//print_r($jsonObj);die;

$name = $jsonObj['name'];
$desigination=$jsonObj['designation'];
$company = $jsonObj['company'];
$location = $jsonObj['location'];
$picture = $jsonObj['picture'];
$phone=$jsonObj['phone'];
$direct = $jsonObj['direct'];
$text = $jsonObj['text'];
$email = $jsonObj['email'];
$website=$jsonObj['website'];
$chat = $jsonObj['chat'];
$facebook = $jsonObj['facebook'];
$linkedin = $jsonObj['linkedin'];
$skype=$jsonObj['skype'];
$google = $jsonObj['google'];
$notes = $jsonObj['notes'];
$pid=$jsonObj['id'];
$wup=$jsonObj['whatsapp'];
$string=$picture;

if(empty($picture))
{
	$picture="https://s3-us-west-2.amazonaws.com/sinergialabs/profile-default-male.png";
	}
if(!empty($picture)){
$pname=uniqid().".jpg";
$uploaddir = 'uploads/contact.jpg';
base64_to_jpeg($string,$uploaddir);
include('config_s3.php');
try {
        $client->putObject(array(
             'Bucket'=>$bucket,
             'Key' =>  $pname,
             'SourceFile' => $uploaddir,
             'StorageClass' => 'REDUCED_REDUNDANCY'
        ));
$message = "S3 Upload Successful.";
$s3file='http://'.$bucket.'.s3.amazonaws.com/'.$pname;
$picture=$s3file;
//echo 'S3 File URL:'.$s3file;
 
    } catch (S3Exception $e) {
         // Catch an S3 specific exception.
        //echo $e->getMessage();
		 d_response(0,'Could not upload picture ',0);die;
    }
}
	
if(!empty($pid)){
		$query2 = "UPDATE `contact` SET `Cname`='$name',`Cdesgination`='$desigination',`Ccompany`='$company',`Clocation`='$location',`Cpicture`='$picture',`Cphone`='$phone',`Cwhatsapp`='$wup',`Cdirect`='$direct',`Ctext`='$text',`Cemail`='$email',`Cwebsite`='$website',`Cchat`='$chat',`Cfacebook`='$facebook',`Clinkedin`='$linkedin',`Cskype`='$skype',`Cgoogle`='$google',`Cnotes`='$notes' WHERE `Cid`=$pid";
					
					$resu = $con->query($query2);
					if($resu)
					{ 
			d_response(1,"Update success","http://ec2-35-167-28-22.us-west-2.compute.amazonaws.com/DCard/digital.php?cid=".$pid,$pid);
				}
				else{
					d_response(0,"Update Failed",0,0);
				}
						
				}
else{
	
	$query = "INSERT INTO `contact`(`Cname`, `Cdesgination`, `Ccompany`, `Clocation`, `Cpicture`, `Cphone`, `Cwhatsapp`,`Cdirect`, `Ctext`, `Cemail`, `Cwebsite`, `Cchat`, `Cfacebook`, `Clinkedin`, `Cskype`, `Cgoogle`, `Cnotes`) VALUES ('$name','$desigination','$company','$location','$picture','$phone','$wup','$direct','$text' ,'$email','$website','$chat','$facebook','$linkedin','$skype','$google','$notes')";
		if ($con->query($query) === TRUE) {
    $Cid = $con->insert_id;
   					$query2 = "UPDATE `contact` SET `CprofileLink`='http://ec2-35-167-28-22.us-west-2.compute.amazonaws.com/DCard/digital.php?cid=$Cid' WHERE `Cid`=$Cid";
					$res = $con->query($query2);
					}
							d_response(1,"success","http://ec2-35-167-28-22.us-west-2.compute.amazonaws.com/DCard/digital.php?cid=".$Cid,$Cid);
					}
				
}	
else{ d_response(0,"Error",0);}
function base64_to_jpeg($base64_string, $output_file) {
    // open the output file for writing
    $ifp = fopen( $output_file, 'wb' ); 

    // split the string on commas
    // $data[ 0 ] == "data:image/png;base64"
    // $data[ 1 ] == <actual base64 string>
    $data = explode( ',', $base64_string );

    // we could add validation here with ensuring count( $data ) > 1
    fwrite( $ifp, base64_decode( $data[ 0 ] ) );

    // clean up the file resource
    fclose( $ifp ); 

    return $output_file; 
}
function d_response($status,$message,$url,$id)
{
	header('Content-type: application/json');
	$users = new Response();
	$users->status = $status;
	$users->message  = $message;
	$users->profileId=$id;
	$users->profileLink=$url;
	
	echo json_encode($users);
}
@mysqli_close($con);
?>
