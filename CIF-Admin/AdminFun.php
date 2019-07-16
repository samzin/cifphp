<?php 
	session_start();

	// connect to database
	include'connection.php';

	// variable declaration
	$username = "";
	$email    = "";
	$errors   = array(); 

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}

	// call the login() function if register_btn is clicked
	if (isset($_POST['login_btn'])) {
		login(); 
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: ../login.php");
	}
    // Select User Type  
    if (isset($_POST['user_type'])) {
		user_type();
	}
	 // Select User Type  Cancel btn
	  if (isset($_POST['user_type_Cbtn'])) {
		header("location: ./index.php");
	}
	
     //SPPUCampus Profile
	
	 if (isset($_POST['sppucampus_btn'])) {
		sppucampus();
	}

	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		$email_1  =  e($_POST['email_1']);
		$email_2  =  e($_POST['email_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
		
		if (empty($email_1)) { 
			array_push($errors, "email is required"); 
		}
		if (empty($email_2)) { 
			array_push($errors, "confirm email is required"); 
		}
		if ($email_1 != $email_2) {
			array_push($errors, "The email do not match");
		}
		 $sql="SELECT email FROM users WHERE email='$email_1'";
         $query = mysqli_query($db,$sql);

         if (mysqli_num_rows($query) != 0){
                array_push($errors,"Email already exists");
        }

  
		// register user if there are no errors in the form
		if (count($errors) == 0) {
			
	
            //A  function for generate password
                function getMeRandomPwd($length){
                   $a = str_split("abcdefghijklmnopqrstuvwxyABCDEFGHIJKLMNOPQRSTUVWXY0123456789"); 
                        shuffle($a);
                      return substr( implode($a), 0, $length );
                     }
                $password=getMeRandomPwd(8);
			
         
			if (isset($_POST['user_type'])) {
				
				$user_type = e($_POST['user_type']);
				$query = "INSERT INTO users (username, email, user_type, password) 
						  VALUES('$username', '$email_1', '$user_type', '$password')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: home.php');
			}else{
				
				//mail send functionalities
			require 'php-mailer-master/php-mailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com;';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'kanchanzinjade5555@gmail.com';                 // SMTP username
$mail->Password = '9527036596';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('kanchanzinjade5555@gmail.com', 'Savitribai Phule Pune University');
$mail->addAddress($email_1, 'CIF');     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'www.unipune.cif.com request password';
$mail->Body    = "<p style='color:#080;font-size:20px;'>Your Password is:<b style='color:red;font-size:20px;'>$password</b></p>";

if(!$mail->send()) {
   array_push($errors, $mail->ErrorInfo);
   
} else {
  

				$query = "INSERT INTO users (username, email, user_type, password,profile_status) 
						  VALUES('$username', '$email_1', 'user', '$password','0')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: ./UserType.php');				
			}
       }   
		}

	}

	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);
		// make sure form is filled properly
		if (empty($username)) {
			
			array_push($errors, "Email is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}
		// attempt login if no errors on form
		if (count($errors) == 0) {
			  
			$query = "SELECT * FROM users WHERE email='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {
                      echo"check if user is admin or user00000000000";
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: admin/home.php');		  
				}else{
					
					
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					$uid=$_SESSION['user']['id']; 
                     $sql="SELECT profile_status FROM users WHERE profile_status='1' and id='$uid' ";
                      $query = mysqli_query($db,$sql);
					   if (mysqli_num_rows($query) != 0){
                            header('location: dashboard.php');
                           }
					       else{
							   header('location: UserType.php');
						       }
				}
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

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
	
	function user_type()
	{   global $db, $errors;
		$type_of_user = e($_POST['type_of_user']);
            
		if (empty($type_of_user)) { 
		  
			array_push($errors, "Please Select type of user"); 
		}
		else
		{  $sql="select * from user_types where user_type='$type_of_user'";
	       $query = mysqli_query($db,$sql);

            while($row = mysqli_fetch_array($query))
			{
				$utid=$row['utid'];	
			}
			
			$id=$_SESSION['user']['id']; 
			$data="update users  SET user_type = '$utid' where id=$id";
			     mysqli_query($db,$data);
			if ($type_of_user=="SPPU Campus")
			{	
			header('location: SPPUCampus.php');	
			}
			if ($type_of_user=="SPPU Affiliated College")
			{
			header('location: SPPUCollege.php');	
			}
			if ($type_of_user=="Other University")
			{
			header('location: OtherUniversity.php');	
			}
		}
		
	}
	
	function sppucampus(){
		global $db, $errors;
		
		   $fullname    =  e($_POST['fullname']);
		   $contact     =  e($_POST['contact']);
		   $dept_name   =  e($_POST['dept_name']);
	    $contact_guide  =  e($_POST['contact_guide']);
	      $guidename    =  e($_POST['guidename']);
		   $state       =  e($_POST['stateslist']);
		 $guideemail    =  e($_POST['guideemail']);
		$newpassword    =  e($_POST['newpassword']);
	  $confirmPassword  =  e($_POST['confirmPassword']);
	$Bill_genrate_name  =  e($_POST['Bill_genrate_name']);
		
	   
			
				
				if (empty($state)) { 
			array_push($errors, "state is required"); 
		    }else{
			
				if($newpassword != $confirmPassword){
					array_push($errors, "Password Not Match"); 
				}
				else{

					$uid=$_SESSION['user']['id']; 
					 $query = "INSERT INTO user_details (name, contact, department_name,guide_contact,guidename,guide_emailid,state,bill_genrate_name,user_utid) 
						  VALUES('$fullname', '$contact', '$dept_name','$contact_guide','$guidename','$guideemail','$state','$Bill_genrate_name','$uid' )";
				        if(mysqli_query($db, $query))
						{
                        $data="update users  SET profile_status ='1',password ='$newpassword'  where id='$uid'";
			             mysqli_query($db,$data);
	                     header('location: dashboard.php');	
							
						}
						
				
					}
				}
			}
		
	

?>