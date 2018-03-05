<div id="" style="text-align:center; float:left; margin-top:40px;">
    <label for="">
      <a href="" title="Registrar Evento" data-toggle="modal" data-target="#registrar_evento">
        <i style="font-size:50px;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
      </a>
    </label>
    <h5>Registrar Evento</h5>
</div>
<div id="" style="text-align:center; margin-top:40px;">
    <label for="">
      <a href="" title="Enviar mensaje al operador" data-toggle="modal" data-target="#messaje_oprator">
        <i style="font-size:50px;" class="fa fa-comments" aria-hidden="true"></i>
      </a>
    </label>
    <h5>Enviar Mensaje</h5>
</div>

<div class="modal fade" id="registrar_evento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color:black">
  <div class="modal-dialog" role="document">
    <form class="" action="" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Un Evento</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="col-md-6">
            <select class="form-control" name="id_evento" required>
              <option value="">Seleccionar</option>
              <?php $Eventos = GetRecords("SELECT * FROM events WHERE Stat = 2"); ?>
              <?php foreach ($Eventos as $key => $value) { ?>
              <option value="<?php echo $value['Id']; ?>"><?php echo $value['Name']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-warning" name="evento">Enviar</button>
          <input type="hidden" name="phase" value="<?php echo $phase; ?>">
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="messaje_oprator" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color:black">
  <div class="modal-dialog" role="document">
    <form class="" action="" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Enviar Mensaje</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="exampleInputEmail1">Mensaje</label>
          <textarea class="form-control" name="messaje_operador" rows="8" cols="80"></textarea>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-warning" name="messaje">Enviar</button>
          <input type="hidden" name="phase" value="<?php echo $phase; ?>">
        </div>
      </div>
    </form>
  </div>
</div>
