<?php $ventana_modal = GetRecords("SELECT * FROM messajes WHERE Id_user = '".$_SESSION['USER_ID']."' AND Stat = 2"); ?>
<?php if(isset($ventana_modal[0]["Id"]) && $ventana_modal[0]["Id"] !=""){ ?>
    <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
              <h3>Mensaje de la Central</h3>
           </div>
           <div class="modal-body">
             <h4>SHL</h4>
              <?php echo $ventana_modal[0]["Messaje"]; ?>
           </div>
             <div class="modal-footer">
               <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
               <form class="" action="" method="post">
                 <button type="submit" name="modal_leido" class="btn btn-success">Leido</button>
                 <input type="hidden" name="id_modal" value="<?php echo $ventana_modal[0]["Id"]; ?>">
               </form>
             </div>
          </div>
       </div>
    </div>
<?php } ?>

<?php /////////////////////////////////////////////////////////////////////////////////////////////// ?>
<?php /* ?>
<?php $ventana_modal_event = GetRecords("SELECT
                                          events_registered.Id as id_detalle_evento,
                                          event.Id as id_evento,
                                          event.Name,
                                          event.Detail,
                                          events_registered.Id_service,
                                          events_registered.Id_user,
                                          events_registered.Id_event,
                                          events_registered.Date_register,
                                          events_registered.Id_phase,
                                          events_registered.Stat,
                                          FROM
                                          events_registered
                                          inner join
                                          event on events_registered.Id_event = event.Id
                                          WHERE
                                          events_registered.id_service = '".$_SESSION['USER_ID']."'
                                          AND
                                          events_registered.Stat = 2"); ?>
<?php if(isset($ventana_modal_event[0]["Id"]) && $ventana_modal_event[0]["Id"] !=""){ ?>
    <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->
              <h3>Evento Registrado por el Operador</h3>
           </div>
           <div class="modal-body">
             <h4><?php echo $ventana_modal_event[0]["Name"]; ?></h4>
              <?php echo $ventana_modal_event[0]["Detail"]; ?>
           </div>
             <div class="modal-footer">
               <form class="" action="" method="post">
                 <button type="submit" name="modal_acept_event" class="btn btn-success">Aceptar</button>
                 <input type="hidden" name="id_modal_event" value="<?php echo $ventana_modal_event[0]["Id"]; ?>">
               </form>
             </div>
          </div>
       </div>
    </div>
<?php } */ ?>
