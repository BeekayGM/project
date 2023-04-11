<?php
require('connection.inc.php');
require('functions.inc.php');
$msg='';
if(isset($_POST['submit'])){
	$username=get_safe_value($con,$_POST['username']);
	$password=get_safe_value($con,$_POST['password']);
	$sql="select * from admin_users where username='$username' and password='$password'";
	$res=mysqli_query($con,$sql);
	$count=mysqli_num_rows($res);
	if($count>0){
		$row=mysqli_fetch_assoc($res);
		if($row['status']=='0'){
			$msg="Account deactivated";
		}else{
			$_SESSION['ADMIN_LOGIN']='yes';
			$_SESSION['ADMIN_ID']=$row['id'];
			$_SESSION['ADMIN_USERNAME']=$username;
			$_SESSION['ADMIN_ROLE']=$row['role'];
			header('location:index.php');
			die();
		}
	}else{
		$msg="PLEASE ENTER CORRECT LOGIN DETAILS";
	}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #0d0d0d;
            color: #f1f1f1;
        }
        .container {
            width: 400px;
            background-color: #212121;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(255,255,255,0.1);
        }
        .form-control {
            background-color: #2b2b2b;
            color: #f1f1f1;
        }
        .form-btn {
            text-align: center;
        }
        .btn-primary {
            background-color: #ffeb3b;
            border-color: #ffeb3b;
        }
    </style>
</head>
<body>
<body class="bg-dark">
      <div class="sufee-login d-flex align-content-center flex-wrap">
         <div class="container">
					 	
            <div class="login-content">
               <div class="login-form mt-140">
					
                  <form method="post">
                     <div class="form-group">
                        
                        <input type="text" name="username" class="form-control" placeholder="    username    " required>
                     </div>
                     <div class="form-group">
                        
                        <input type="password" name="password" class="form-control" placeholder="      password    " required>
                     </div>
                     <button type="submit" name="submit" style="background-color:#008080" class="btn btn-success btn-flat m-b-30 m-t-30">
											 Login</button>
					</form>
					<div class="field_error"><?php echo $msg?></div>
               </div>
            </div>
         </div>
      </div>
      <script src="assets/js/vendor/jquery-2.1.4.min.js" type="text/javascript"></script>
      <script src="assets/js/popper.min.js" type="text/javascript"></script>
      <script src="assets/js/plugins.js" type="text/javascript"></script>
      <script src="assets/js/main.js" type="text/javascript"></script>
   </body>
</html>
