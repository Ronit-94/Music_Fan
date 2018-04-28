<!DOCTYPE HTML>
<?php session_start();?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="favicon.png">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<style type="text/css">
 body {
   background-image:url(https://images.pexels.com/photos/164716/pexels-photo-164716.jpeg?w=940&h=650&auto=compress&cs=tinysrgb);
   background-repeat:no-repeat;
   background-size:100% 150%;
   background-position:fixed;
} 
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
	
    //border: 1px solid #e7e7e7;
    //background-color: #f3f3f3
}
li {
    float: left;
}
li a {
    display: block;
    color: #666;
    text-align: left;
    padding: 14px 16px;
    text-decoration: none;
	color: #00FFE8;
	top:100px;
	bottom:50px;
}
li a:hover:not(.active) {
    background-color: #ddd;
}
li a.active {
    color: white;
    background-color: #4CAF50;
}
html,body
{
  height: 100%;
  margin: 0px;
}
div.time
{
  position: fixed;
  bottom: 0px;
  right: 0px;
  font-weight:bold;
  border-bottom: 1px solid;
  color: #00FFE8;
}
div.f_list {
    float: left;
    width: 200px;
    height: 200px;
    margin: 10px;
    
    }
div.search_box
{
 /* position: absolute;
  top: 50px;
  right: 5px;
  font-weight:bold;*/
  padding-top: 10px;
  padding-left: 10px;
}
div.welcome
{
	color:#00FFE8;
	font-weight:bold;
	font-size:14px;
}
}
</style>
</head>
<body>

<?php
echo"<div class=welcome>". "<h4><strong>Welcome! $_SESSION[firstname]  $_SESSION[lastname]</strong></h4>" ."</div>";
?>

<form action='search.php' method='post'>
   <b style="color :#00FFE8">Search:</b><input type="text" name="keyword"  Placeholder="Keyword" >
   <b style="color :#00FFE8">By</b>
   <select name="key">
    <option value='post'> Posts </option>
    <option value='people'> User Profile </option>
    <option value='interests'> Interests </option>
    <input type='submit' value='Search' name='Search'>
</form>
<div style="font-weight:bold">
<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="profile.php">Profile</a></li>
  <li><a href="editprofile.php">Edit Profile</a></li>
  <li><a href="diary.php">Add Posts</a></li>
  <li><a href="friend_request.php">Requests</a></li>
  <li><a href="friends.php">Friends</a></li>
  <li><a href="messages.php">Messages</a></li>
  <li><a href="logout.php">LogOut</a></li>
  <li style="padding-right: 200px;"><div class="search_box">
</div></li>
</ul>
</div>


<?php
include "db_connection.php";
$query="select timestampdiff(second, logout_time, login_time) as timediff from profile  where user_id=$_SESSION[user_id]";
$result = mysqli_query($con,$query);
if (mysqli_num_rows($result) > 0) 
{
    while($row = mysqli_fetch_assoc($result))
     {
      $timediff=$row["timediff"];
      if ($timediff<60)
      {
        echo "<div class=time>"."Last Active: ".$timediff." seconds ago "."</div>";
      } 
      else if ($timediff>=60 and $timediff<3600)
      {
        echo "<div class=time>"."Last Active: ". (int)($timediff/60) ." minutes ago "."</div>";
      } 
      else if ($timediff>=3600 and $timediff<86400)
      {
        echo "<div class=time>"."Last Active: ". (int)($timediff/3600) ." hours ago "."</div>";
      } 
      else if ($timediff>=86400)
      {
        echo "<div class=time>"."Last Active: ". (int)($timediff/86400) ." days ago "."</div>";
      } 
    }
}
?>
