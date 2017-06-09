<!DOCTYPE html>
<html>
<?php
$servername = "localhost";
$username = "root";
$password = "";//accessme
$dbname = "dcard";

$con = new mysqli($servername, $username, $password,$dbname);
if ($con->connect_error) {
  echo "Could not connect: " .mysql_error();
} 
if (isset($_GET['cid'])&& $_GET['cid'] != '')
{
$cid=$_GET['cid'];
$query = "SELECT * FROM `contact` WHERE `Cid`=$cid";
	$result = $con->query( $query );
	
	if (!$result) {
		echo 'Could not run query: ' . mysqli_error();
		exit;
	}
	
	if(mysqli_num_rows($result)) {
		while( $row = $result->fetch_assoc() ){
			extract($row);
			$name = $Cname;
			$desigination=$Cdesgination;
			$company = $Ccompany;
			$location = $Clocation;
			$picture = $Cpicture;
			$phone=$Cphone;
			$direct = $Cdirect;
			$text = $Ctext;
			$email = $Cemail;
			$website=$Cwebsite;
			$chat = $Cchat;
			$facebook = $Cfacebook;
			$linkedin = $Clinkedin;
			$skype=$Cskype;
			$google = $Cgoogle;
			$notes = $Cnotes;
			$wup=str_replace("+","",$Cwhatsapp);
			$wup=str_replace("-","",$wup);
			//print_r($picture);die;
		}
}
}
?>

<title><?php echo ucwords($name);?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <meta charset="utf-8">
  
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.container {
  position: relative;
  top: 10%;
  left:5%;
  width: 130%;
 	max-width:900px ;
  
 
}
html, body {
  height: 100%;
}

.container{
  width:1025px;
}

.vertical-center {
  height:100%;
  width:100%;

  text-align: center;  /* align the inline(-block) elements horizontally */
  font: 0/0 a;         /* remove the gap between inline(-block) elements */
}

.vertical-center:before {    /* create a full-height inline block pseudo=element */
  content: ' ';
  display: inline-block;
  vertical-align: middle;  /* vertical alignment of the inline element */
  height: 100%;
}

.vertical-center > .container {
  max-width: 100%;
  background-color: #B1E27D;

  display: inline-block;
  /* vertical alignment of the inline element */
  font: 16px/1 "Helvetica Neue", Helvetica, Arial, sans-serif;       
}

@media (max-width: 768px) {
  .vertical-center:before {
    /* height: auto; */
    display: none;
  }
}
body {
	background: #B1E27D;
	font-family: 'Open Sans', Arial, Helvetica, Sans-serif, Verdana, Tahoma;
}
.footer a {
  color: #70726F;
  font-size: 20px;
  padding: 10px;
  border-right: 1px solid #70726F;
  transition: all .5s ease;
}
.footer a:first-child {
  border-left: 1px solid #70726F;
}
.footer a:hover {
  color: white;
}

</style>
  <body >

  <div class="modal-dialog">
    
      <!-- Modal content-->
      

<div class="w3-container">
    <div class="w3-card-4" style="width:100%">
    <header class="w3-container w3-light-gray">
	<img src="https://s3-us-west-2.amazonaws.com/sinergialabs/merck.png" alt="Avatar" class="w3-right w3-square " style="width:60px">
      <h4><?php echo strtoupper($name);?></h4>
    <br>
	</header>
    <div class="w3-container w3-white w3-center">
      
      <hr>
      <img src="<?php echo $picture;?>" alt="Avatar" class="w3-justify w3-circle w3-margin-right" style="width:60px">
      <h5><?php echo $desigination;?></h5>
	  <h6> <?php echo $company;?></h6>
	  <h6><?php echo $location;?></h6><br>
    </div>
  
  </div>
</div>
<div class="w3-container">
  

  <div class="w3-card-4 w3-white" style="width:100%">

    <div class="w3-container w3-center">
      <h4>Contact</h4>
	  <div class="list-group">
    <a href="mailto:<?php   echo $email;?>" class="list-group-item">
     <h6 class="list-group-item-heading">Email</h6>
      <p class="list-group-text"><?php   echo $email;?></p>
    </a>
	
    <a href="tel:<?php  echo $phone;?>" class="list-group-item">
      <h6 class="list-group-item-heading">Mobile</h6>
      <p class="list-group-item-text"><?php  echo $phone;?></p>
    </a>
    <a href="https://api.whatsapp.com/send?phone=<?php echo $wup;?>" class="list-group-item">
      <h6 class="list-group-item-heading">Whatsapp</h6>
      <p class="list-group-item-text"><?php echo $wup;?></p>
    </a>
	 <a href="skype:<?php echo $skype;?>?call" class="list-group-item">
      <h6 class="list-group-item-heading">Skype</h6>
      <p class="list-group-item-text"><?php echo $skype;?></p>
    </a>
	<div id="direct">
	 <a href="tel:<?php echo $direct;?>" class="list-group-item">
      <h6 class="list-group-item-heading">Direct</h6>
      <p class="list-group-item-text"><?php echo $direct;?></p>
    </a></div>
	<div id="sms">
	<a href="sms:<?php echo $text;?>" class="list-group-item">
      <h6 class="list-group-item-heading">SMS </h6>
      <p class="list-group-item-text"><?php echo $text;?></p>
    </a></div>
	
	<div id="notes">
	<a href="#" class="list-group-item">
      <h6 class="list-group-item-heading">Notes </h6>
      <p class="list-group-item-text"><?php echo $notes;?></p>
    </a></div>
  </div>
	 	<?php 
	if(empty($notes)){
	echo "<script>
	document.getElementById('notes').style.display ='none';
</script>";}
if(empty($text)){
	echo "<script>
	document.getElementById('sms').style.display ='none';
</script>";}
if(empty($direct)){
	echo "<script>
	document.getElementById('direct').style.display ='none';
</script>";}
	?> 
	   <br>
<footer class="footer">
  
    <a href="<?php echo $facebook;?>"><i class="fa fa-facebook"></i></a>
    <a href="<?php echo $linkedin;?>"><i class="fa fa-linkedin"></i></a>
    <a href="<?php echo $google;?>"><i class="fa fa-google-plus"></i></a>
    <a href="<?php echo $website;?>"><i class="fa fa-globe"></i></a>
 
</footer>
     <br>
<br>
    </div>

  </div>
  
</div></div> </div>
</div></div>
</body>

</html>
