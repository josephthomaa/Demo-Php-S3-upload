<?php
$servername = "localhost";
$username = "root";
$password = "accessme";//accessme
$dbname = "dcard";

$con = new mysqli($servername, $username, $password,$dbname);

if ($con->connect_error) {
  echo "Could not connect: " .mysql_error();
} 





//$con = mysqli_connect("localhost","root","","test");

if (isset($_GET['search'])&& $_GET['search'] != '')
{
	$cat=$_GET['search'];
		
	
	$query = "SELECT `Cid`, `Cname`, `Cdesgination`, `Ccompany`, `Clocation`, `Cpicture`, `Cphone`, `Cwhatsapp`, `Cdirect`, `Ctext`, `Cemail`, `Cwebsite`, `Cchat`, `Cfacebook`, `Clinkedin`, `Cskype`, `Cgoogle`, `Cnotes`, `CprofileLink` FROM `contact` WHERE `Cname` like '%$cat%'";
	$result = $con->query( $query );
	
	if (!$result) {
		echo 'Could not run query: ' . mysqli_error();
		exit;
	}
	$data = array();
	if(mysqli_num_rows($result)) {
		while( $row = $result->fetch_assoc() ){
			extract($row);
			$data[] = array('id'=>$Cid,'name'=>$Cname,'desigination'=>$Cdesgination,'company'=>$Ccompany,'Location'=>$Clocation,'profilePicture'=>$Cpicture,'phone'=>$Cphone,'whatsapp'=>$Cwhatsapp,'direct'=>$Cdirect,'text'=>$Ctext,'email'=>$Cemail,'website'=>$Cwebsite,'chat'=>$Cchat,'facebook'=>$Cfacebook,'linkedin'=>$Clinkedin,'skype'=>$Cskype,'google'=>$Cgoogle,'notes'=>$Cnotes,'profileLink'=>$CprofileLink);
			
		}
	}
	
}
else{ $data = array(); }

	if (empty($data)) {
     header('Content-type: application/json');
		echo json_encode(array('status'=>0,'Message'=>'No results found','Search'=>$data),JSON_UNESCAPED_SLASHES);
	
}
	else {
		header('Content-type: application/json');
		
		echo json_encode(array('status'=>1,'Message'=>'Success','Search'=>$data));
	}

@mysqli_close($con);
?>
