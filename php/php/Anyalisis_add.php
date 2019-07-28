<?php 
   $errors   = array(); 
	if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
		//header('location: login.php');
	}


	// connect to database
	include'/php/connection/connection.php';
	
	if (isset($_POST['save_btn'])) {
		Analysisadd();
	}
	function Analysisadd()
	{
		global $db,$errors;
$Analysis=$_POST['country'];
$SubAnalysis=$_POST['region'];
$Solvent=$_POST['city'];
$rate=$_POST['samplerate'];
$numberofsamples=$_POST['numberofsamples'];
$Total=$_POST['sum'];
$createddate = date('Y-m-d G:i:s');
$order_date=date("Y-m-d");
$sample="0";
for($i=1;$i<=$numberofsamples;$i++)
{   $temp='sample'.$i;
   
	$sample1=$_POST['sample'.$i];
	if($sample1!="")
	{
	$sample=$sample.','.$sample1;	
	}
}

$samplecount=substr_count($sample, ',');

	              if (empty($Analysis)) { 
			              array_push($errors, "Select Aanalysis is required"); 
		                  }else{
			 
				if (empty($SubAnalysis)) {
					array_push($errors, "Select SubAnalysis is required"); 
				  }
				  
                else{
						if($Analysis==1) {
						 if(empty($Solvent)) {
					array_push($errors, "Select Solvent is required"); 
				  } 
						}
						
							if (empty($numberofsamples)) {
					array_push($errors, "Add Number of Samples is required"); 
				  }else
				   { 
			     if($samplecount!=$numberofsamples){
					 
					array_push($errors, "Enter only '$numberofsamples' Samples"); 
				 }
				  else{
					 
			             $uid=$_SESSION['user']['id']; 
               $query = "INSERT INTO taborder (uid,sample_code,order_date,created_at ) 
						  VALUES($uid,'$sample','$order_date','$createddate')";
				     if(mysqli_query($db, $query))
					 {
						
					 }
					 else{
						 echo" find the error";
					 }
			  
		           			
				}
				}
			}
           
		}
 
	
	}

function display_analysis_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>