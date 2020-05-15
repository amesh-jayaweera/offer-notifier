<?php
include("includes/header.php");
include("includes/config.php");
session_start();
include("includes/functions.php");

if (isset($_POST['submit']))
{

}

if(logged_in())
{
  header("location:login.php");
}
else if(isset($_COOKIE['name']))
{
  //echo '<span style="color:#AFA;">You have logged in through cookies</span>';
  $email=$_COOKIE['name'];
$result=mysqli_query($con,"SELECT id,registered_name,business_form,img FROM users WHERE mail='$email'");
$retrive=mysqli_fetch_array($result);
//print_r($retrive);
$id=$retrive['id'];
$registeredname=$retrive['registered_name'];
$formofbusiness=$retrive['business_form'];
$image=$retrive['img'];
?>
<title>Profile Page</title>
<style type="text/css">
#body-bg
{
  background-image: linear-gradient(#000428, #bdc3c7);
}

</style>
</head>
<body id='body-bg'>
<div class='container' style='padding-top:10px;background-image: linear-gradient(180deg, #F1FFFD, #141e30); margin-top:20px;
margin-bottom:20px;width:1200px;height:640px'>
<h2 align='center'>Welcome <?php echo ucfirst($registeredname)." ".ucfirst($formofbusiness)?>
</h2>
<a href='logout.php'><button class='btn btn-outline-success' style='float:right;'>
Log Out</button></a>
<a href='change-password.php?id=<?php echo $id; ?>'><button class='btn btn-outline-primary' style='float:left;'>
Change Password</button></a></br></br>
<center><img src='images/<?php echo $image ?>' class='img-fluid img-thumbnail'
  style='width:350px;'></center>
</div>
</body>
</html>
<?php
}
else
{
//echo '<span style="color:#AFA;">You have logged in through session</span>';
$email=$_SESSION['mail'];
$result=mysqli_query($con,"SELECT id,registered_name,business_form,img FROM users WHERE mail='$email'");
$retrive=mysqli_fetch_array($result);
//print_r($retrive);
$id=$retrive['id'];
$registeredname=$retrive['registered_name'];
$formofbusiness=$retrive['business_form'];
$image=$retrive['img'];
?>
<title>Offer~Notifier - Profile Page</title>
<style type="text/css">
#body-bg
{
  background-image: linear-gradient(#000428, #bdc3c7);
}

</style>
</head>
<body id='body-bg'>
<div class='container' style='padding-top:10px;background-image: linear-gradient(180deg, #F1FFFD, #141e30); margin-top:20px;
margin-bottom:20px;width:1200px;height:640px'>
<h2 align='center'>Welcome <?php echo ucfirst($registeredname)." ".ucfirst($formofbusiness)?>
</h2>
<a href='logout.php'><button class='btn btn-outline-success' style='float:right;'>
Log Out</button></a>
<a href='change-password.php?id=<?php echo $id; ?>'><button class='btn btn-outline-primary' style='float:left;'>
Change Password</button></a>
</br></br>
<center><img src='images/<?php echo $image ?>' class='img-fluid img-thumbnail'
  style='width:250px;'></center>

</br>
<p class="font-weight-bold">Place you offer here: </p>
<div class="form-group">
<label>Plave your offer here: </label>
<input type="text" name='offer' class='form-control';"font-weight-bold">
</div>

</div>
</body>
</html>
<?php
}
?>
