<?php
ob_start();
session_start();
include("db_config.php");
if (!$_SESSION["username"]){
header('Location:login1.php?msg=1');
}
ini_set('display_errors', 1);
?>
<!-- Enable debug using ?debug=true" -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Grosary Store</title>

    <link href="./css/htmlstyles.css" rel="stylesheet">
	</head>
	<header>
	<div class="overlay">
<h1>You can search the products here <a href="/">Click here to go to Home page</a></h1>

</header>
  <body>
  <div class="container-narrow">
		
		<div class="jumbotron">
			<p class="lead" style="color:white">
				Welcome <?php echo $_SESSION["username"]; ?>!! Search for products here</a>
			</p>
        </div>
		
		<div class="response">
		
			<p style="color:white">
			<table class="response">
			<form method="POST" autocomplete="off">
			
			<tr>
				<td>
					Search for a product:  
				</td>
				<td>
					<input type="text" id="searchitem" name="searchitem" placeholder="pillow">&nbsp;&nbsp;
				</td>
				<td>
					<input type="submit" value="Search!"/> 
				</td>
			</tr>
	</table>
				
			</p>

		</form>
        </div>
    
        
		<br />

<?php
if (isset($_POST["searchitem"])) {
$search_query=$_POST["searchitem"];
// $search_query = filter_var($search_query, FILTER_SANITIZE_STRING);
$q = "Select * from products where product_name like '".$search_query."%'";

if (isset($_GET['debug']))
{
	if ($_GET['debug']=="true")
{
	$msg="<div style=\"border:1px solid #4CAF50; padding: 10px\">".$q."</div><br/>";
	echo $msg;
	}
}
}

?>

<div class="searchheader" style="color:white">
<table>	
    
	<tr>
    <td style="width:200px " >
        <b>Product Name</b>
    </td>
    
    <td style="width:200px " >
        <b>Product Type</b>
    </td>
    
    <td style="width:450px " >
        <b>Description</b>
    </td>
    
    <td style="width:110px " >
        <b>Price</b>
    </td>
 
</tr>

<?php

if (isset($_POST["searchitem"])) {
$result = mysqli_query($con,$q);
if (!$result)
{
		echo("</table></div>".mysqli_error($con));
}else{

while($row = mysqli_fetch_array($result))
  {
  echo "<tr><td style=\"width:200px\">".$row[1]."</td><td style=\"width:200px\">".$row[2]."</td><td style=\"width:450px\">".$row[3]."</td><td style=\"width:110px\">".$row[4]."</td></tr>";
  }

}
}
?>
</table>
	</div>

	  
	  
  
</body>
</html>