<?php include('php/php/functions.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>University CIF</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark  static-top" style="box-shadow: 0 0 10px black;">

    <a class="navbar-brand mr-1" href="index.html">
	<img src="images/logo.png" class="headederlogo img-thumbnail" alt="Cinque Terre"></a>
     <style>
	 @media only screen and (max-width: 768px) {
  /* For mobile phones: */

.header {
  color: #ffffff;
  padding: 15px;
}
	 }
	 </style>
	
     <h1 class="header" style="font-size: 14px;margin: 0 0 0px 0;
   
    font-family: Impact,sans-serif;
    text-decoration: none;
    font-weight: normal;
    color: #4D6879;
    text-shadow: 
	
	">Central Instrumentation Facility<br>
Savitribai Phule Pune University<br>
Pune - 411007.<br>
Ph No.(020) 2560 1442
Email:	cif@unipune.ac.in </h1>


    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <div class="input-group">
       
      </div>
    </form>
	
    <!-- Navbar -->
    <img src="images/unilogo.png" class="headederlogo" alt="Cinque Terre">

  </nav>



  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form method="post" action="registration.php">
		<?php echo display_error(); ?>
          <div class="form-group">
            <div class="form-row">
             <div class="input-group">
			     <input type="text" name="username" class="form-control" placeholder="Full Name" value="<?php echo $username; ?>">
		     </div>
         
              </div>
            </div>
          
          <div class="form-group">
		  <div class="form-row">
			  <div class="input-group">
			     <input type="email" name="email_1" class="form-control" placeholder="Email" value="<?php echo $username; ?>">
		     </div>
          </div>
		  </div>
		  
		   <div class="form-group">
		  <div class="form-row">
			  <div class="input-group">
			     <input type="email" name="email_2" class="form-control" placeholder="Email Confirm" value="<?php echo $username; ?>">
		     </div>
          </div>
		  </div> 
		  <div class="text-center">
		  <button type="submit" class="btn btn-primary " name="register_btn">Submit</button><br>
          Already have an account?<a  href="index.php">Login here</a>
		  </div>
        </form>
       
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
