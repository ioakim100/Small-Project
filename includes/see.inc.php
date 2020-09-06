<!DOCTYPE html>

<html lang="en">
<head>
<link rel="stylesheet" href="../style.css">
</head>


<body>
<div class="container">
<div id= "php">

<?php


$start =0;
$end = 10;


$servername ="localhost";
$dBUserName ="root";
$dBPassword = "";
$dBName = "test";

$conn = mysqli_connect($servername,$dBUserName,$dBPassword,$dBName);


if(!$conn){
  die("Connection Failer".mysqli_connect_error());
}

mysqli_select_db($conn, 'pagination');
$results_per_page = 5;
$sql = "SELECT serial_number,name,description FROM product";
$result = mysqli_query($conn, $sql);
$number_of_results = mysqli_num_rows($result);

$number_of_pages = ceil($number_of_results/$results_per_page);

if (!isset($_GET['page'])) {
  $page = 1;
} else {
  $page = $_GET['page'];
}

$this_page_first_result = ($page-1)*$results_per_page;

$sql='SELECT serial_number,name,description FROM product LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)) {
  echo "<br> id: ". $row["serial_number"]. " - Name: ". $row["name"]. " - Description: " . $row["description"] . "<br>";
}


// display the links to the pages
  echo '<div class="paging">';
for ($page=1;$page<=$number_of_pages;$page++) {

  echo '<a href="see.inc.php?page=' . $page . '">' . $page . '</a> ';

}



mysqli_close($conn);




?>


<div>
  <form action="../index.php" method ="post">
    <button type="sudmit" name"search-sudmit">Go Back</button>
  </form>
</div>




</body>
