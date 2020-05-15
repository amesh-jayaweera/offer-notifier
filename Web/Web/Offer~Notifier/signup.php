<?php
include("includes/header.php");
include("includes/config.php");
include("includes/functions.php");
$msg1=''; $msg2=''; $msg3=''; $msg4=''; $msg5=''; $msg6=''; $msg7=''; $msg8='';$msg9='';
$registeredname='';$formofbusiness='';$email='';$date='';$password='';$c_password='';$image='';
if(isset($_POST['submit']))
{
$registeredname=($_POST['rname']); //$registeredname=mysql_real_escape_string($_POST['rname']);
$formofbusiness=($_POST['fobusiness']); //$formofbusiness=mysql_real_escape_string($_POST['fobusiness']);
$email=($_POST['mail']); //$email=mysql_real_escape_string($_POST['mail']);
$date=$_POST['dor'];
$password=$_POST['pass'];
$c_password=$_POST['cpass'];
$image=$_FILES['image']['name'];
$tmp_image=$_FILES['image']['tmp_name'];
$size_image=$_FILES['image']['size'];
$checkbox=isset($_POST['check']);
//echo $registeredname."</br>".$formofbusiness."</br>".$email."</br>".$date."</br>".$password."</br>".$c_password."</br>".$image."</br>".$checkbox;
if(strlen($registeredname)<1)
{
    $msg1="<div class='error'>Please provide the 'Registered Name'</div>";
}
else if(strlen($formofbusiness)<1)
{
    $msg2="<div class='error'>Please provide the 'Form of Business'</div>";
}
else if (!filter_var($email,FILTER_VALIDATE_EMAIL))
{
  $msg3="<div class='error'>Please provide a valid email</div>";
}
else if (email_exists($email,$con))
{
  $msg3="<div class='error'>This email already exists</div>";
}
else if (empty($date))
{
  $msg4="<div class='error'>Please provide the Date of Registration</div>";
}
else if (empty($password))
{
  $msg5="<div class='error'>Please provide a Password</div>";
}
else if (strlen($password)<5)
{
  $msg5="<div class='error'>Password must contain at least 5 characters</div>";
}
else if ($password!==$c_password)
{
  $msg6="<div class='error'>Password is not matched</div>";
}
else if ($image=='')
{
  $msg7="<div class='error'>Please provide your Trademark</div>";
}
/*else if ($size_image>=1000000)
{
  $msg7="<div class='error'>Please upload an image file with size under 1 MB</div>";
}*/
else if ($checkbox=='')
{
  $msg8="<div class='error'>Please accept the Terms & Conditions</div>";
}
else
{
  $password=md5($password);
  $img_ext=explode(".",$image);
  $image_ext=$img_ext['1'];
  $image=rand(1,1000).rand(1,1000).time().".".$image_ext;
  if($image_ext=='jpg'||$image_ext=='png'||$image_ext=='JPG'||$image_ext=='PNG')
  {
    move_uploaded_file($tmp_image,"images/$image");
  mysqli_query($con,"INSERT INTO users
    (registered_name,business_form,mail,password,dor,img)
    VALUES ('$registeredname','$formofbusiness','$email','$password','$date','$image')");
  $msg9="<div class='success'><center>Registration Successful</center></div>";
  $registeredname='';$formofbusiness='';$email='';$date='';$password='';$c_password='';$image='';
}
else
{
  $msg7="<div class='error'>Please upload an image file</div>";
}
}}
?>
<title>Offer~Notifier - Sign Up Form</title>
</head>
<style type='text/css'>
#body-bg
{
  background: url("images/bg.jpg");
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.error
{
  color:red;
}
.success
{
  color:green;
  font-weight:bold;
}
</style>
<body id='body-bg'>
<div class='container'>
  <div class='login-form col-md-4 offset-md-4'>
    <div class='jumbotron' style='margin-top:20px;padding-top:20px;padding-bottom:20px;'>
<h3 align='center'>Sign Up Form</h3></br>
<?php echo $msg9;?>
</br>
<form method='post' enctype="multipart/form-data">
  <div class="form-group">
<label>Registered Name: </label>
<input type="text" name='rname' placeholder="Must contain at least 1 character" class='form-control' value='<?php echo $registeredname;?>'>
<?php echo $msg1;?>
</div>
<div class="form-group">
<label>Form of Business: </label>
<input type="text" name='fobusiness' placeholder="Ex: Private Limited Liability" class='form-control' value='<?php echo $formofbusiness;?>'>
<?php echo $msg2;?>
</div>
<div class="form-group">
<label>Business Email Address: </label>
<input type="email" name='mail' placeholder="example@abc.com" class='form-control' value='<?php echo $email;?>'>
<?php echo $msg3;?>
</div>
<div class="form-group">
<label>Date of Registration: </label>
<input type="date" name='dor' placeholder="abcd@hotmail.com" class='form-control' value='<?php echo $date;?>'>
<?php echo $msg4;?>
</div>
<div class="form-group">
<label>Password: </label>
<input type="password" name='pass' placeholder="Must contain at least 5 characters" class='form-control' value='<?php echo $password;?>'>
<?php echo $msg5;?>
</div>
<div class="form-group">
<label>Confirm Password: </label>
<input type="password" name='cpass' placeholder="Re-enter Password" class='form-control' value='<?php echo $c_password;?>'>
<?php echo $msg6;?>
</div>
<div class="form-group">
<label>Trademark: </label>
<input type="file" name='image' value='<?php echo $image;?>'/>
<?php echo $msg7;?>
</div>
<div class="form-group">
<input type="checkbox" name='check'/>
I accept the Terms & Conditions
<?php echo $msg8;?>
</div></br>
<center><input type="submit" value='Submit' name='submit' class='btn btn-success' /></center></br>
<center>Already signed up? Login <a href='login.php'>here</a></center>
</form>
</div>
</div>
</div>
</body>
</html>
