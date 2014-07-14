<?php
//get the form elements and store them in variables
$name=$_POST["name"];
$email=$_POST["email"];
$con = mysqli_connect("127.0.0.1","root","","kiev-plus_com");
//on connection failure, throw an error
if(!$con) {
    die('Could not connect: '.mysql_error());
}
$sql="INSERT INTO `kiev-plus_com`.`wp_custom_email` ( `name` , `email_id` ) VALUES ( '$name','$email')";
mysqli_query($con,$sql);
var_dump($sql);
//header("Location: http://kiev-plus.com");

?>