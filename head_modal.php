<?php /* Modal update */
if(isset($_POST['modal_leido'], $_POST['id_modal'])){
$array_modal = array("Stat"=>4);
UpdateRec("messajes", "Id=".$_POST["id_modal"], $array_modal);
}
if(isset($_POST['modal_evento'], $_POST['id_evento'])){
$array_modal = array("Stat"=>4);
UpdateRec("events_registered", "Id=".$_POST["id_evento"], $array_modal);
}

?>

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>
 $(document).ready(function()
 {
    $("#mostrarmodal").modal("show");
 });
</script>
<script>
 $(document).ready(function()
 {
    $("#mostrarModalEvent").modal("show");
 });
</script>
