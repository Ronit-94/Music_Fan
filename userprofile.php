<?php 
include "db_connection.php";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<style>
 body {
   background-image: url("https://images.pexels.com/photos/164716/pexels-photo-164716.jpeg?w=940&h=650&auto=compress&cs=tinysrgb");
   background-repeat:no-repeat;
   background-size:cover;
} 
div.a {
color:#00FFE8;
font-weight:bold;
font-size:15px;
}
div.b{
	color:red;
	font-weight:bold;
	font-size:25px;
}

</style>
<body>

<?php
$query="select * from profile where username='$_POST[uname]' ";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
	echo "<div class=b>"." This username already exists . Please Try again "."</div>";
}
else
{
	$file = $_FILES['file']['name'];
	$file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	move_uploaded_file($file_loc,$file);
	//$target_file = $file . basename($_FILES["file"]["name"]);
	//echo pathinfo($target_file,PATHINFO_EXTENSION);
	$sql = "INSERT into profile (firstname, lastname, birthdate, gender, username, email, password, picture)
	VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[dob]','$_POST[gender]','$_POST[uname]','$_POST[email]','$_POST[password]','$file') ";
	
	if (mysqli_query($con, $sql)) {
	    echo "<div class=a>"."<br>User Profile has been created successfully."."</div>";
	} else {
	    echo "<div class=b>"."Error: " . $sql . "<br>" . mysqli_error($con)."</div>";
	}
	mysqli_close($con);
}
?>

<form action='login.php' method=''>
		<div class=a>Click here to Login Now :<input type='submit' name= "login" value="Login Now"></div>
</form>


</body>
</html>