<?php 
	include('php/php/functions.php');
    include('php/php/Anyalisis_add.php');
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		//header('location: login.php');
	}
?>
<?php

	// connect to database
	include'/php/connection/connection.php';
	$errors   = array(); 
$Analysis=$_POST['country'];
$SubAnalysis=$_POST['region'];
$Solvent=$_POST['city'];
$rate=$_POST['samplerate'];
$numberofsamples=$_POST['numberofsamples'];
$Total=$_POST['sum'];
$createddate = date('Y-m-d G:i:s');
$order_date=date("Y-m-d");
echo$order_date;

$sample="0";
for($i=1;$i<=$numberofsamples;$i++)
{   $temp='sample'.$i;
   
	$sample1=$_POST['sample'.$i];
	if($sample1!="")
	{
	$sample=$sample.','.$sample1;	
	}
}
echo$sample;
function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}
if (empty($Analysis)) { 
			array_push($errors, "Select Aanalysis is required"); 
		}
$uid=$_SESSION['user']['id']; 
$query = "INSERT INTO taborder (uid,sample_code,order_date,created_at ) 
						  VALUES($uid,'$sample','$order_date','$createddate')";
				     if(mysqli_query($db, $query))
					 {
						 echo"add successfully";
					 }
					 else{
						 echo" find the error";
					 }
					

?>