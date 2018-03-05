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
    <meta http-equiv="refresh" content="60">
<?php }else{ ?>
    <meta http-equiv="refresh" content="5">
<?php } ?>
