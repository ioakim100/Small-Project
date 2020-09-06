<?php


  //access to data-base
  $servername ="localhost";
  $dBUserName ="root";
  $dBPassword = "";
  $dBName = "test";

  $conn = mysqli_connect($servername,$dBUserName,$dBPassword,$dBName);

  if(!$conn){
    die("Connection Failer".mysqli_connect_error());
  }
  //end access to data-base64_decod

  $Serial = $_POST['Serial'];
  $Product = $_POST['Product'];
  $Description = $_POST['Description'];

  //check if all field is completed
  if(empty($Serial) || empty($Product) || empty($Description)){
    header("Location: add.inc.php?error=emptyfields&Serial=".$Serial."&Product=".$Product."&Description=".$Description);
    exit();
  }else{
    $sql = "SELECT serial_number FROM product WHERE serial_number =?";
    $stmt = mysqli_stmt_init($conn);
    //checking id serial_number is unique
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: add.inc.php?error=serial_number_allready_exist");
      exit();
    }else{
      //add in data base
      $sql = "INSERT INTO product (serial_number, name, description) VALUES (?,?,?)";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt,$sql)){
        header("Location: add.inc.php?error=sqlerror");
        exit();
      }else{
        mysqli_stmt_bind_param($stmt,"iss",$Serial,$Product,$Description);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        // $sql = "SELECT * FROM product ORDERD BY serial_number ASC";
        // mysqli_stmt_execute($stmt);
        // mysqli_stmt_store_result($stmt);
        header("Location: ../index.php?success=add_in_data");
        exit();
      }

    }
  }


mysqli_stmt_close($stmt);
mysqli_close($conn);
header("Location: add.inc.php");





?>
