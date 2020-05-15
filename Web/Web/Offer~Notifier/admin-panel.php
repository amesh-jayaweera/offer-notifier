<?php
include("includes/header.php");
include("includes/config.php");
session_start();
$name=$_SESSION['name'];
if(isset($name))
{
  $result=mysqli_query($con,"SELECT id,registered_name,business_form,mail,dor,img FROM users");
  $row=mysqli_num_rows($result);
 echo "<div class='container'>";
 echo "<center><h3></br>Welcome to Offer~Notifier Admin Panel</h3></center>";
 echo "</br></br>";
 echo "Total Registered Users: ".$row;
 //
 echo "<table class='table table-striped table-bordered table-responsive'>";
 echo "<tr align='center'>";
 echo "<th>Serial#</th>";
 echo "<th>Registered Name</th>";
 echo "<th>Business Form</th>";
 echo "<th>Email</th>";
 echo "<th>Registered Date</th>";
 echo "<th>Trademark</th>";
 echo "<th>Remove User</th>";
 echo "<th>Edit User Details</th>";
 echo "</tr>";
 $i=0;
 while($retrive=mysqli_fetch_array($result))
 {
 $id=$retrive['id'];
 $rname=$retrive['registered_name'];
 $bform=$retrive['business_form'];
 $mail=$retrive['mail'];
 $date=$retrive['dor'];
 $pro=$retrive['img'];
    echo "<tr align='center'>";
    echo "<th>".$i=$i+1;"</th>";
    echo "<th>$rname</th>";
    echo "<th>$bform</th>";
    echo "<th>$mail</th>";
    echo "<th>$date</th>";
    echo "<th><img src='images/$pro' height='100px' width='100px'></th>";
    echo "<th><a href='remove-users.php?del=$id'><button class='btn btn-danger'>Remove</button></a></th>";
    echo "<th><a href='update-users.php?user=$id'><button class='btn btn-success'>Update</button></a></th>";
echo "</tr>";
 }
 echo "</table>";echo "</br>";
 echo "<a href=admin-logout.php><button class='btn btn-primary'style='float:right;margin-left:50px;'>Log Out</button></a>";
 }
else
{
  header("location:admin.php");
}
?>
