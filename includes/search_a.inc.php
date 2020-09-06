<?php

$servername ="localhost";
$dBUserName ="root";
$dBPassword = "";
$dBName = "test";

$conn = mysqli_connect($servername,$dBUserName,$dBPassword,$dBName);

if(!$conn){
  die("Connection Failer".mysqli_connect_error());
}

$Serial = $_POST['Serial_Search'];

$sql = "SELECT serial_number,name,description FROM product WHERE serial_number =  $Serial";
$result = mysqli_query($conn, $sql);



if (mysqli_num_rows($result) > 0) {
  echo '<div id = "search_a">';
  echo '<div id= "php">';
  echo "Exist";
  $row = mysqli_fetch_assoc($result);
  echo "<br> id: ". $row["serial_number"]. " - Name: ". $row["name"]. " - Description: " . $row["description"] . "<br>";
}else{
  echo '<div id = "search_a">';
  echo '<div id= "php">';
  echo "Not Exist";
}

mysqli_close($conn);




?>

<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>
<div >
  <form action="../index.php" method ="post">
    <button type="sudmit" name"search-sudmit">Go Back</button>
  </form>
</div>


</body>
