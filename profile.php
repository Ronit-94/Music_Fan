<?php include "header.php";
include "db_connection.php";
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script type="text/javascript">
}
</script>

</head>
<body>

<?php 
$comm = "select * from comments inner join profile on profile.user_id=comments.commentor WHERE comments.Status_c=1 ORDER by comments.comment_id";
       $result2= $con->query($comm);
       if ($result2->num_rows > 0) {
            
            while($row = $result2->fetch_assoc()) {
                $comments[]=$row;
            }
        }
        $sql1 = "select concat(profile.firstname,' ', profile.lastname) as Name, diary.post_id, date_format(diary.created_date,'%M %D,%Y') AS cr_date, diary.user_id,diary.diary_title,diary.description,diary.multimedia,diary.created_date, diary.location, profile.picture AS picture from diary inner join profile on profile.user_id= diary.user_id where diary.user_id = $_SESSION[user_id] and diary.status_D=1  order by diary.created_date desc"; 
            
            $result1 = $con->query($sql1);
            if ($result1->num_rows > 0) {
          
            while($row = $result1->fetch_assoc()) {
                $table_names[]=$row;
            }
        } else {
            echo "0 results";
        }
        
 ?>       





<div style="float:left;padding-left:10px;font-weight:bold; color:#00FFE8;" >
<?php
$query="select * from profile where user_id=$_SESSION[user_id]";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
        $picture=$row["picture"];
    }
}
echo "<img src='$picture' width=300 height=300 /><br><br> ";
?>


<form method='post' action=''  enctype="multipart/form-data">

  Change Picture: 
  <input type="file" name="file">
  <input type='submit' name='dp_change' value='Change'>
</form>

<?php  
if (isset($_POST['dp_change']))
{
    $file = $_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    move_uploaded_file($file_loc,$file);
    $sql = "update profile set picture='$file'
    where user_id=$_SESSION[user_id]";
    $result=mysqli_query($con, $sql);
    if($result){
      header("Refresh:0");
    }
 }
?>

<?php
$query="select firstname,date_format(birthdate,'%D %M, %Y') as birthdate,email,country,lastname,country,fgenre,fsinger,fsong,picture from profile where user_id=$_SESSION[user_id]";
$result=mysqli_query($con,$query);
if(mysqli_num_rows($result)>0)
{
    echo "<div class=About>"."<h3 style=text-decoration:underline><strong>About me:  </strong>  </h3> "."<br>"."</div>";
         
    while($row=mysqli_fetch_assoc($result))
    {
        echo "<div class=f_profile>";
        echo "<td>"."Name: ".$row["firstname"].' '.$row["lastname"]."<br>";
        echo "<td>"."Birthday: ".$row["birthdate"]."<br>";
        echo "<td>"."Email: ".$row["email"]."<br>";
        echo "<td>"."Country: ".$row["country"]."<br>";
        echo "<td>"."Genre: ".$row["fgenre"]."<br>";
        echo "<td>"."Singer: ".$row["fsinger"]."<br>";
        echo "<td>"."Song: ".$row["fsong"]."<br>";
        echo "</div>";
    }
}
?>
</div>
</body>
</html>


<style>
.name{
	
    width:20%;
    float: left;
}
.title{
    float: left;
    width:80%;
}
.main-container{
	
    //border-width: 1px;
    //border:solid;
    padding-top: 0px;
    margin-top: 10px;
    //background-color: #544828;
	//opacity:0.1;
    margin-left: 50px;
}
.comment-container-inside{
    background-color:  #f0f0f5;
    margin-top: 10px;
}
.glyphicon-remove{
    float:right;
}
diary{
	top:50px;
}
/* div.friend_sugg
{
  background-color: #ffeecc;
  position:fixed;
  top: 100px;
  width:200px;
  right: 5px;
  font-weight:bold;
} */
div.f_profile{
  //position:fixed;
  top: 550px;
  width:220px;
  //right: 5px;
  font-weight:bold;
	
}
div.About{
 // position:fixed;
  top: 500px;
  width:200px;
  //right: 5px;
  font-weight:bold;
	
}
/* div.up_birth
{
  background-color: #ffeecc;
  position: fixed;
  top: 400px;
  width:200px;
  right: 5px;
  font-weight:bold;
} */
.remove-post{
    color:red;
    border: none;
    color: red;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
.red{
    color:red;
}
.white{
	border: black;
}
.img{
    
}
.multimedia{
 padding-left: 100px;   
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).on("click", ".add-comment-button", function(){
           
            var url = "home_functions.php";
            var post_id = $(this).attr('post_val');
           
            var desc = $('#add_comment_'+post_id).val();
            if(desc.trim()!==''){
                formDataComments = {'OPERATION':'add_new_comment','post_id':post_id,'description':desc};
                $.ajax({
                        type:"POST",
                        url : url,
                        data: formDataComments,
                        success:function(data)
                        {
                            
                            var commentHtml = "<div class='comment-container-inside'><span class='name'><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></span><span>" +desc+"</span><span comment_id='"+""+"' class='glyphicon glyphicon-remove'></span></div>";
                            $('#comment-container-'+post_id).append(commentHtml);       
                        }
                    })
            }
            
        });
$(document).on('click', '.glyphicon-remove', function(){
    
    $(this).parent().hide();
    var url = "home_functions.php";
            formDataComments = {'OPERATION':'delete_comment','comment_id':$(this).attr('comment_id')};
            $.ajax({
                        type:"POST",
                        url : url,
                        data: formDataComments,
                        success:function(data)
                        {
                            $(this).parent().hide();        
                        }
                    })
});
$(document).on('click','.remove-post', function(){
    
    var x =$(this).attr("post_id");
    var url = "home_functions.php";
            formDataComments = {'OPERATION':'delete_post','post_id':$(this).attr("post_id")};
            $.ajax({
                        type:"POST",
                        url : url,
                        data: formDataComments,
                        success:function(data)
                        {
                            $('#post_'+x).hide();        
                        }
                    })
})
function get_likes_by_post(post_id){
    var x =post_id;
    var url = "home_functions.php";
            formDataComments = {'OPERATION':'get_likes_by_post','post_id':post_id};
            $.ajax({
                        type:"POST",
                        url : url,
                        data: formDataComments,
                        success:function(data)
                        {
                            var data = JSON.parse(data);
                            $('#like_block_'+x).html("<span id='like_count_value_"+x+"' value='"+data['count_likes']+"'>"+data['count_likes']+"</span>");
                        }
                    })
}
function has_user_liked(post_id){
    var x =post_id;
    var url = "home_functions.php";
            formDataComments = {'OPERATION':'has_user_liked','post_id':post_id};
            $.ajax({
                        type:"POST",
                        url : url,
                        data: formDataComments,
                        success:function(data)
                        {
                            var data = JSON.parse(data);
                            
                            if(data['has_liked']==0){
                                $('#like_symbol_'+x).html("  <span post_id='"+x+"' value='"+data['has_liked']+"' class='glyphicon glyphicon-heart-empty white like-icon'><span>");
                            }
                            else if(data['has_liked']==1){
                                $('#like_symbol_'+x).html("  <span post_id='"+x+"' value='"+data['has_liked']+"' class='glyphicon glyphicon-heart red like-icon'><span>");
                            }
                            else{}
                        }
                    })
}
function get_file_type(abc){
    return abc.split('.').pop();
}
$(document).on('click','.like-icon', function(){
    var x = $(this).attr("post_id");
    var current_value = $(this).attr('value');
    var xyz = $("#like_count_value_"+x).attr('value');

    var url = "home_functions.php";
            formDataComments = {'OPERATION':'change_likes','post_id':x,'current_value':current_value};
            $.ajax({
                        type:"POST",
                        url : url,
                        data: formDataComments,
                        success:function()
                        {
                            if(current_value == 1){
                                $('#like_symbol_'+x).html("  <span post_id='"+x+"' value='0' class='glyphicon glyphicon-heart-empty white like-icon'><span>");
                                var count = parseInt(xyz);
                                count = count-1;
                                $("#like_block_"+x).html("<span id='like_count_value_"+x+"' value='"+count+"'>"+count+"</span>");
                            }
                            else if(current_value == 0){
                            $('#like_symbol_'+x).html("  <span post_id='"+x+"' value='1' class='glyphicon glyphicon-heart red like-icon'><span>");
                                var count = parseInt(xyz);
                                count = count+1;
                                $("#like_block_"+x).html("<span id='like_count_value_"+x+"' value='"+count+"'>"+count+"</span>");
                            }
                            else{}
                        }
                    })
})
        
    
    $(document).ready(function(){
      
        var current_user = <?php echo $_SESSION['user_id'] ?>;
        
        var comments = <?php echo json_encode($comments); ?>;
        for(var key in comments){
            console.log(comments[key]);
        }
        var diaries = <?php echo json_encode($table_names);?>;
        for(var key in diaries){
            console.log(diaries[key]['picture']);
        }
        for(var key in diaries){
           
            has_user_liked(diaries[key]['post_id']);
            var multimedia_file_display="";
            
            if(diaries[key]['multimedia']!=="" && diaries[key]['multimedia']!= null){
            
                if(get_file_type(diaries[key]['multimedia']) === 'mp4'){
                    multimedia_file_display = "<div class='multimedia'>'<video controls><source src='"+diaries[key]['multimedia']+"' type='video/mp4' style='padding-left:px;'></video></div>";
                }
				else if(get_file_type(diaries[key]['multimedia']) === 'mp3'){
                    multimedia_file_display = "<div class='multimedia'>'<audio controls autoplay='autoplay'><source src='"+diaries[key]['multimedia']+"' type='audio/mp3' style='padding-left:100px;'></audio></div>";
                }
                else if(get_file_type(diaries[key]['multimedia']) === 'jpg' || get_file_type(diaries[key]['multimedia']) === 'jpeg' || get_file_type(diaries[key]['multimedia']) === 'png') {
                    multimedia_file_display = "<div class='multimedia'><img class='img' src='"+diaries[key]['multimedia']+"'width=300 height=300/></div>";
                }
                else{}
            }
        
            var html="";
            html += "<div class='main-container' id='post_"+diaries[key]['post_id']+"'><div class='name_title'><div class='name'><a href='friendsprofile.php?id="+diaries[key]['user_id']+"'><div style:'font-size:20px'><strong>"+diaries[key]['Name']+"</strong></div></a><img src='"+diaries[key]['picture']+"' width=30 height=30/></div><div class='title'><span><h3 style='color:#BC68C9'>"+diaries[key]['diary_title']+"</h3><h6 style='color:#ED2BC4; font-weight:bold' class='date'>"+diaries[key]['cr_date']+"</h6><h5>"+(diaries[key]['location']!==""?"<span style='color:blue' class='glyphicon glyphicon-map-marker'></span><a style='font-size:20px' href='http://localhost:81/location.php?loc="+diaries[key]['location']+"'<span class='location'>"+diaries[key]['location']+"</span></a>":"")+"</h5><strong><span post_id='"+diaries[key]['post_id']+"' class='glyphicon glyphicon-remove remove-post' style='float:right;'>Delete</span></strong></div></div><div class='desc_comment'><div class='description'><h5 style= 'color:#BD2727;font-weight:bold; font-size:20px'>"+diaries[key]['description']+"</h5></span>"+multimedia_file_display+"</div><div class='likes_block' style='color:red'>Likes:<span id='like_block_"+diaries[key]['post_id']+"'></span><span class='like_symbol' id='like_symbol_"+diaries[key]['post_id']+"'></span></div><div id='comments_"+diaries[key]['post_id']+"' class='commments'><h6>----comments here----</h6></div></div></div>";
            $("#page-content").append(html);
            get_likes_by_post(diaries[key]['post_id']);
        }
        
        for(var key in diaries){
            var commentHtml = "";
            commentHtml += "<div class='comment-container' id='comment-container-"+diaries[key]['post_id']+"'>";
            for(var key_1 in comments){
                if(diaries[key]['post_id'] == comments[key_1]['post_id']){
                    
                    
                    commentHtml += "<div class='comment-container-inside'><span class='name'><a href='friendsprofile.php?id="+comments[key_1]['commentor']+"'>"+comments[key_1]['firstname']+" "+comments[key_1]['lastname']+"  </span></a><span>" + comments[key_1]['Comment']+"</span>"+(current_user == comments[key_1]['commentor'] ? "<span comment_id='"+comments[key_1]['comment_id']+"' class='glyphicon glyphicon-remove'></span>":"<span comment_id='"+comments[key_1]['comment_id']+"' class='glyphicon glyphicon-remove'></span>" )+"</div>";
                    commentHtml += "";
                    
                }
            }
            commentHtml += "</div><div><input id='add_comment_"+diaries[key]['post_id']+"' post_val='"+diaries[key]['post_id']+"' type='text' style='width:500px'><input class='add-comment-button' type='button' value='Add Comment' post_val='"+diaries[key]['post_id']+"'></div>";
                $("#comments_"+diaries[key]['post_id']).html(commentHtml);
        }
    }); 
</script>

<body>
    <div>
        <div id='page-content' style="width:70%; float:left; overflow-y:auto; height:600px"></div>
    </div>
</body>
</body>
</html>
