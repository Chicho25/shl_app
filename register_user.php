<?php ob_start();
      session_start();
      include("include/config.php");
      include("include/defs.php");
      $link = "";
      $nombre_titulo = "SHL - Registro de Usuario";

      if(!isset($_SESSION['USER_ID']))
         {
              header("Location: login.php");
              exit;
         }

         $MSG ="";

         if (isset($_POST['register'])) {

           $ifUserExist = RecCount("users", "Email = '".$_POST['email']."'");
           if($ifUserExist > 0)
           {
             $MSG = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                       <strong>Este usuario ya esta registrado!</strong>
                     </div>';
           }else{

            $registro = array("Name"=>$_POST['name'],
                              "Last_name"=>$_POST['last_name'],
                              "Email"=>$_POST['email'],
                              "Pass"=>$_POST['pass'],
                              "Type_user"=>$_POST['type_user'],
                              "Addres"=>$_POST['addres'],
                              "Phone"=>$_POST['phone'],
                              "Stat"=>2,
                              "Date_create"=>date("Y-m-d H:i:s"),
                              "User_register"=>$_SESSION['USER_ID']);

            $id_rec = InsertRec("users", $registro);

            if ($id_rec!="") {
              $MSG = '<div class="alert alert-success bg-success"><a href="#" class="close" style="color:white;" data-dismiss="alert">&times;</a><strong style="color:white;">Usuario Registrado...!</strong></div>';
            }

         }

       }

      ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Gruas SHL</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-warning" id="page-top">
  <!-- Navigation-->
  <?php include("menu.php"); ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <?php echo $MSG; ?>
          <i class="fa fa-user"></i> Registrar un usuario</div>
        <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="exampleInputName">Nombre</label>
                    <input class="form-control" id="exampleInputName" required type="text" name="name" aria-describedby="nameHelp" placeholder="Nombre">
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputLastName">Apellido</label>
                    <input class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Apellido" name="last_name">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Correo Electronico</label>
                <input class="form-control" id="exampleInputEmail1" required type="email" aria-describedby="emailHelp" placeholder="Correo Electronico" name="email">
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input class="form-control" id="exampleInputPassword1" required type="password" placeholder="Contrasena" name="pass">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="exampleConfirmPassword">Tipo de Usuario</label>
                    <select class="form-control" name="type_user" required>
                      <option value="">Seleccionar</option>
                      <?php $type_user = GetRecords("SELECT * FROM type_user WHERE Stat = 2"); ?>
                      <?php foreach ($type_user as $key => $value) { ?>
                      <option value="<?php echo $value['Id']; ?>"><?php echo $value['Name']; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="exampleConfirmPassword">Telefono</label>
                    <input class="form-control" id="exampleConfirmPassword" type="text" name="phone" placeholder="Telefono">
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Direccion</label>
                <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Direccion" name="addres"></textarea>
              </div>
              <div class="text-center">
                <button class="btn btn-warning btn-block" name="register">Registrar</button>
              </div>
            </form>
      </div>
      <div class="card-footer small text-muted">Gruas SHL Todos los Derechos Reservados</div>
    </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>
</html>
