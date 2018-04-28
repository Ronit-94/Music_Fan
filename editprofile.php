<?php
include 'db_connection.php';
include "header.php";
if(!$_SESSION['username']){header('Location: http://localhost:81/login.php');}
$query="SELECT *
  FROM profile
 WHERE user_id = $_SESSION[user_id]";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
	$row = mysqli_fetch_assoc($result);
}
?>
<style>
 #button {
     
     position:absolute;
     top:0;
     right:0;
 }
</style>
<?php
if (isset($_POST['apply']))
{
    $sql = "update profile set firstname='$_POST[firstname]',
    lastname='$_POST[lastname]', gender='$_POST[gender]',
    password='$_SESSION[password]',
    email='$_POST[email]',address='$_POST[address]',
    country='$_POST[country]', fgenre='$_POST[f_genre]', fsinger='$_POST[f_singer]',fsong='$_POST[f_song]', privacy_P='$_POST[privacy_P]'
    where user_id=$_SESSION[user_id]";
    if (mysqli_query($con, $sql)) {
        header('Location: http://localhost:81/profile.php');
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['lastname'] = $_POST['lastname'];
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
    mysqli_close($con);
 }   
?>
<div style="font-weight:bold;color:#FA2F76;font-size:16px;">
<form style="text-align:center"   method='post' action=''  enctype="multipart/form-data" > 
Firstname:<input type="text" name="firstname"  value='<?php echo $row['firstname']; ?>'   placeholder='First Name' required> 
    <br><br>
Lastname:<input type="text" name="lastname" value='<?php echo $row['lastname']; ?>' placeholder='Last Name' required> 
    <br><br>
DOB:<input type="date" name="dob" placeholder='DOB(MM-DD-YYYY)' value='<?php echo $row['birthdate']; ?>' required > 
    <br><br>
    Gender:<input type="radio" name="gender" value="M" required <?php if($row['gender'] == 'M'){echo "checked";} ?> > Male 
    <input type="radio" name="gender" value="F" required <?php if($row['gender'] == 'F'){echo "checked";} ?> > Female  
    <br><br>
Email:<input type="email" name='email' placeholder='Email' value='<?php echo $row['email']; ?>'required> 
    <br> <br>
Address:<input type="text" name='address' placeholder='Address' value='<?php echo $row['address']; ?>'required> 
    <br> <br>
Country:<input type="text" name='country' placeholder='Country' value='<?php echo $row['country']; ?>'required> 
    <br> <br>
Favourite Genre:<input type="text" name='f_genre' placeholder=' Genre ' value='<?php echo $row['fgenre']; ?>'required> 
    <br><br>    
Favourite Singer:<input type="text" name='f_singer' placeholder=' Singer ' value='<?php echo $row['fsinger']; ?>'required> 
    <br> <br>
Favourite Song:<input type="text" name='f_song' placeholder=' Song ' value='<?php echo $row['fsong']; ?>'required> 
    <br><br>
<br>
Privacy:
  <select name='privacy_P' value='<?php echo $row['privacy_P']; ?>' > 
  <option value='0' <?php if($row['privacy_P'] =='0'){echo "selected";} ?>>Eveyone</option>
  <option value='1' <?php if($row['privacy_P'] =='1'){echo "selected";} ?>>Only Friends</option>
  <option value='2' <?php if($row['privacy_P'] =='2'){echo "selected";} ?>>Friends of Friends</option>
  <option value='3' <?php if($row['privacy_P'] =='3'){echo "selected";} ?>>Private</option>

</select>
<br><br>
<input type="submit" name="apply" value="Apply" >
<input type="reset" name ="reset" value="Reset" >

</form>
<form style="text-align:center" action="changepassword.php">
  <input type="submit" name="changepassword" value="Change Password" >
</form>
</div>