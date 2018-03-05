<?php
    ob_start();
    session_start();
    include("include/config.php");
    include("include/defs.php");

     if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID'] !="")
     {
          if($_SESSION['USER_ROLE'] == 2)
                header("Location: operador.php");
            else if($_SESSION['USER_ROLE'] == 1)
                header("Location: home.php");
                else if($_SESSION['USER_ROLE'] == 3)
                    header("Location: customer.php");
          exit;
     }


    $errMSG="";


     if( isset($_POST['btn-login']) ) {

        $username = $_POST['email'];
        /*$password = encryptIt($_POST['password']);*/
        $password = $_POST['password'];

        $username = strip_tags(trim($username));
        $password = strip_tags(trim($password));

        if(RecCount("users", "Email = '".$username."' and Pass = '".$password."' and Stat = 2"))
        {

            $row = GetRecord("users", "Email = '".$username."' and Pass = '".$password."' and Stat = 2");
            $_SESSION['USER_ID'] = $row['Id'];
            $_SESSION['USER_NAME'] = $row['Name']." ".$row['Last_name'];
            $_SESSION['USER_ROLE'] = $row['Type_user'];
            if($row['Type_user'] == 1)
                header("Location: main.php");
            else if($row['Type_user'] == 2)
                header("Location: operador.php");
            else if($row['Type_user'] == 3)
                header("Location: customer.php");
            else
                echo $_SESSION['USER_ID'].$_SESSION['USER_NAME'].$_SESSION['USER_ROLE'];
                /*header("Location: logout.php");*/
        }
        else
          $errMSG = '<div class="alert alert-danger"><a href="#" class="close" style="color:#000;" data-dismiss="alert">&times;</a><strong>Usuario o Contraseña incorrecta...!</strong></div>';
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="Tayron" content="Programador">
  <meta name="SHL" content="Gruas SHL">
  <title>Gruas SHL</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  <style media="screen">
  .center-block {
        display: flex;
        justify-content: center;
      }
  </style>
</head>

<body class="bg-warning">
  <div class="container">
    <div class="mt-5 center-block">
      <img src="images/logo.png" alt="">
    </div>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login Gruas SHL
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Usuario</label>
            <input class="form-control" id="exampleInputEmail1" type="email" name="email" aria-describedby="emailHelp" placeholder="Usuario">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Contraseña</label>
            <input class="form-control" id="exampleInputPassword1" name="password" type="password" placeholder="Contraseña">
          </div>
          <button class="btn btn-warning btn-block text-white" name="btn-login"><b>Ingresar</b></button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Registrate</a>
          <a class="d-block small" href="forgot-password.html">Olvido su contraseña?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
