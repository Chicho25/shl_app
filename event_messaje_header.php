<?php

      if (isset($_POST['id_evento'], $_POST['evento'])) {

        $registro = array("Id_service"=>$_REQUEST['id'],
                          "Id_phase"=>$_POST['phase'],
                          "Date_register"=>date("Y-m-d H:i:s"),
                          "Id_user"=>$_SESSION['USER_ID'],
                          "Stat"=>2,
                          "Id_event"=>$_POST['id_evento']);

        $id_rec = InsertRec("events_registered", $registro);

        $MSG = '<div class="alert alert-success bg-success"><a href="#" class="close" style="color:white;" data-dismiss="alert">&times;</a><strong style="color:white;">Evento Registrado...!</strong></div>';

      }

      if(isset($_POST['messaje_operador'])){

        $array_comentary = array("Id_service"=>$_REQUEST['id'],
                                 "Id_phase"=>$_POST['phase'],
                                 "Comentary"=>$_POST['messaje_operador'],
                                 "Stat"=>2,
                                 "Date_register"=>date("Y-m-d H:i:s"),
                                 "Id_user"=>$_SESSION['USER_ID']);

        $ind = InsertRec("phase_comentary", $array_comentary);

        $MSG = '<div class="alert alert-success bg-success"><a href="#" class="close" style="color:white;" data-dismiss="alert">&times;</a><strong style="color:white;">Mensaje Registrado...!</strong></div>';

      }
 ?>
