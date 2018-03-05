<?php ob_start();
      session_start();
      include("include/config.php");
      include("include/defs.php");
      /* confi cabezera de pagina */
      $link = "";
      $nombre_titulo = "SHL - Registrar Servicio";
      /////////////////////////////////

      if(!isset($_SESSION['USER_ID']))
         {
              header("Location: login.php");
              exit;
         }

         $MSG ="";

      if (isset($_POST['name'],
                  $_POST['date_service'],
                    $_POST['id_customer'],
                      $_POST['description'],
                        $_POST['addres'])) {

            $registro = array("Name"=>$_POST['name'],
                              "Date_service"=>$_POST['date_service'].date(" H:i:s"),
                              "Id_customer"=>$_POST['id_customer'],
                              "Id_operator"=>$_POST['id_operator'],
                              "Description"=>$_POST['description'],
                              "addres"=>$_POST['addres'],
                              "Stat"=>2,
                              "Date_create"=>date("Y-m-d H:i:s"),
                              "User_register"=>$_SESSION['USER_ID']);

            $id_rec = InsertRec("services", $registro);

            if ($id_rec!="") {
              $MSG = '<div class="alert alert-success bg-success"><a href="#" class="close" style="color:white;" data-dismiss="alert">&times;</a><strong style="color:white;">Servicio Registrado...!</strong></div>';
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
</head>

<body class="fixed-nav sticky-footer bg-warning" id="page-top">
  <!-- Navigation-->
  <?php include("menu.php"); ?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="card mb-3">
        <div class="card-header">
          <?php echo $MSG; ?>
          <i class="fa fa-sliders"></i> Registrar un Servicio</div>
        <div class="card-body">
            <form action="" method="post">
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="exampleInputName">Nombre del Servicio</label>
                    <input class="form-control" id="exampleInputName" required type="text" name="name" aria-describedby="nameHelp" placeholder="Nombre del Servicio">
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Fecha del Servicio</label>
                    <input class="form-control" id="exampleInputEmail1" required type="text" aria-describedby="emailHelp" placeholder="Fecha del Servicio" name="date_service">
                  </div>
                </div>
              </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label for="exampleConfirmPassword">Cliente</label>
                        <select class="form-control" name="id_customer" required>
                          <option value="">Seleccionar</option>
                          <?php $customer = GetRecords("SELECT * FROM users WHERE Stat = 2 and Type_user = 3"); ?>
                          <?php foreach ($customer as $key => $value) { ?>
                          <option value="<?php echo $value['Id']; ?>"><?php echo $value['Name']." ".$value['Last_name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label for="exampleConfirmPassword">Operador</label>
                        <select class="form-control" name="id_operator" required>
                          <option value="">Seleccionar</option>
                          <?php $operator = GetRecords("SELECT * FROM users WHERE Stat = 2 and Type_user = 2"); ?>
                          <?php foreach ($operator as $key => $value) { ?>
                          <option value="<?php echo $value['Id']; ?>"><?php echo $value['Name']." ".$value['Last_name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="exampleInputPassword1">Descripcion</label>
                    <textarea class="form-control" id="exampleInputPassword1" required placeholder="Descripcion" name="description"></textarea>
                  </div>
                  <div class="col-md-6">
                  <label for="exampleInputEmail1">Direccion del Servicio</label>
                  <textarea class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Direccion" name="addres"></textarea>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button class="btn btn-warning btn-block" name="register_service">Registrar</button>
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function(){
          var date_input=$('input[name="date_service"]'); //our date input has the name "date"
          var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
          var options={
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true
          };
          date_input.datepicker(options);
        })
    </script>
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
