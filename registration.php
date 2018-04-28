<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4..0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="favicon.png">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script type="text/javascript">
  $( document ).ready(function() {
    //alert( "ready!" );
    $('#submit_button').on('click',function(){
      if( $('#pass1').val() ==  $('#pass2').val())
      {
        $('form').submit();
      }
      else
      {
        alert('Passwords do not match');
        return false;
         
      }
    })
});
  </script>
</head>
<style>
 body {
   background-image: url("https://images.pexels.com/photos/164716/pexels-photo-164716.jpeg?w=940&h=650&auto=compress&cs=tinysrgb");  
   background-repeat:no-repeat;
   background-size:cover;	
   }
</style>
<div style="font-weight:bold; color:#1DA9CB">
<body style="text-align: center  ">

<h2>Welcome</h2> 
<p><span class="error"></span></p>
<form method='post' action='userprofile.php' id='form_' enctype="multipart/form-data" style="font-weight:bold;"> 
First Name:<input type="text" name="firstname" placeholder='First Name' required> 
    
    <br><br>
Last Name:<input type="text" name="lastname" placeholder='Last Name' required> 
   
    <br><br>
Date Of Birth:<input type="date" name="dob" placeholder='DOB(YYYY-MM-DD)' required > 
  
    <br><br>
   Gender: <input type="radio" name="gender" value="M" required> Male 
    <input type="radio" name="gender" value="F" required> Female
    <br><br>
   
    Email:<input type="email" name='email' placeholder='Email' required> 

    <br> <br>
Username:<input type="text" name='uname' placeholder='UserName' required> 
    
    <br> <br>
Password:<input type="password" name='password' id="pass1" placeholder='Password(6 char minimum)' pattern=".{6,}" title="Six or More characters" required>
    
    <br><br>
Confirm Password:<input type="password" name='conpassword' id="pass2" placeholder='Confirm Password' pattern=".{6,}" title="Six or More characters" required>
    
    <br><br>
Profile Picture:   <input style="padding-left:600px" type="file" name="file" value='Upload Picture' accept='.png,.mp4,.jpg' />
    <br>
<input type="submit" name="submit" value="SignUp" id="submit_button">
<input type="reset" name ="reset" value="Reset" >

</form>
</body>

</div>