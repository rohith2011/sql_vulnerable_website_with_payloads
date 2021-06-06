<?php
ob_start();
session_start();
include("db_config.php");
ini_set('display_errors', 1);
?>
<style>
<?php include './styling.css'; ?>
</style>

<!-- Enable debug using ?debug=true" -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>You reached the login page</title>

    <link href="./css/htmlstyles.css" rel="stylesheet">
	</head>

  <body>
  <header>
	<div class="overlay">
<h1>You reached the Login page</h1>
<h3>Manage orders, track orders </h3>
<p>And what not!</p>
	<br>
	<button><a href="/">Home Page</a></button>
</header>

  <div class="bg">
  </div>
  <div class="bg bg2"></div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="container-narrow">
		
		<div class="jumbotron">
			<p class="lead" style="color:white">
				Login
				<?php 
					if (!empty($_REQUEST['msg'])){
						if ($_REQUEST['msg']==="1"){
							$_SESSION['next']='searchproducts.php';
							echo "<br />Please login to continue to Search Products";
						}elseif ($_REQUEST['msg']==="2"){
							$_SESSION['next']='blindsqli.php';
							echo "<br />Please login to continue to visit User Details";
							}elseif ($_REQUEST['msg']==="3"){
								$_SESSION['next']='os_sqli.php';
								echo "<br />Please login to continue to OS Command Injection Page";
								}else{
									$_SESSION['next']='searchproducts.php';
								}
					} 
				?>
			</p>
        </div>
		
		<div class="response">
		<form method="POST" autocomplete="off">
			<p style="color:white">
				Username:  <input type="text" id="uid" name="uid"><br /></br />
				Password: <input type="password" id="password" name="password">
			</p>
			<br />
			<p>
			<input type="submit" value="Submit"/> 
			<input type="reset" value="Reset"/>
			</p>
		</form>
        </div>
    
        
		<br />
		
      <div class="row marketing">
        <div class="col-lg-6">

<?php
//echo md5("pa55w0rd");

if (!empty($_REQUEST['uid'])) {
$username = ($_REQUEST['uid']);
$username = filter_var($username, FILTER_SANITIZE_STRING);
$pass = $_REQUEST['password'];

$q = "SELECT * FROM users where username='".$username."' AND password = '".md5($pass)."'" ;

if (isset($_GET['debug']))
{
	if ($_GET['debug']=="true")
{
	$msg="<div style=\"border:1px solid #4CAF50; padding: 10px\">".$q."</div><br />";
	echo $msg;
	}
}

		if (!mysqli_query($con,$q))
	{
		echo 'Error: ' . mysqli_error($con);
		echo "<font style=\"color:#FF0000\">Invalid userID or password !</font\>";
	}else{
	
	$result = mysqli_query($con,$q);

	if (!$result) {
    		printf("%s\n", mysqli_error($con));
    		echo "error";
	}

if (mysqli_warning_count($con)) { 
   $e = mysqli_get_warnings($con); 
   if ($e){
   do { 
       echo "Warning: $e->errno: $e->message\n"; 
   } while ($e->next()); }
} 

	echo "<br /><br />";
	$row = mysqli_fetch_array($result);

	
	if ($row){
	//$_SESSION["id"] = $row[0];
	$_SESSION["username"] = $row[1];
	$_SESSION["name"] = $row[3];
	//ob_clean();
	
	if ($_SESSION['next']=="searchproducts.php"){
	header('Location: searchproducts.php');
	}elseif ($_SESSION['next']=="blindsqli.php"){
		// header('Location: blindsqli.php?user='.$_SESSION["username"]);
		}elseif ($_SESSION['next']=="os_sqli.php"){
			echo "<font style=\"color:#FF0000\">LOGGGGEEDDDD in!</font\>";
			// header('Location: os_sqli.php?user='.$_SESSION["username"]);
			}
	echo "<font style=\"color:#FF0000\">LOGGGGEEDDDD INNNN!!!!</font\>";
	}
	else{
		echo "<font style=\"color:#FF0000\">Invalid password!</font\>";
	}
}
}

//}
?>

	</div>
	</div>
	  

	  
	</div> <!-- /container -->
  
</body>
</html>