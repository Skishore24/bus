<?php
error_reporting(0);
$con=mysqli_connect("localhost","root","","bus_booking");
if($con->connect_error){
    echo $con->error;
    die();
}
if("__METHOD__==POST"){
    $ROUTE=strtoupper($_POST['route']);
    $SEATNO=$_POST['seats'];
    $AMOUNT=12;
    $NAME=strtoupper($_POST['name']);
    $EMAIL=$_POST['email'];
$sql="INSERT INTO tickets(NAME,SEATS,EMAIL,BUSROUTE,AMOUNT) VALUES('$NAME','$SEATNO','$EMAIL','$ROUTE','')";
$result=$con->query($sql);
if($result)
{
header("location:http://localhost/proj/booking-success.html");
}
}

?>