<?php
include("../secure.php");
include ("../../conecta.php");
include ("../../funciones/funciones_generales.php");
include ("../../funciones/funciones_form.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/estilos_ss.css">
</head>

<body>

    <?php
if (!empty($_GET['fe_id'])){
  $titulo = "Modificar Feria";
  $titulo_boton = "Hacer Cambios";
  $us_form = InputGeneralVal("text", "fe_name", "form-control", "usuario", "nombre de la ferian", "Nombre de la Feria:",BuscaRegistro ("tb_ferias", "fe_id", $_GET['fe_id'], "fe_name"));
 /* $valor = BuscaRegistro ("tb_usuarios", "us_id", $_GET['us_id'], "us_tipo");
  $us_tipo = SelectGeneralVal("funcion", "form-control", "funcion", "Tipo de Usuario:","tb_tipo_usuarios", "tus_id", "tus_name",$valor,BuscaRegistro ("tb_tipo_usuarios", "tus_id", $valor, "tus_name"));*/
  if (BuscaRegistro ("tb_ferias", "fe_id", $_GET['fe_id'], "fe_municipal") == 1) {
    $fe_muni ='checked="checked"';
  } else {
    $fe_muni = '';
  };
  $propia = '<input type="checkbox" value="1" '.$fe_muni.' name="fe_municipal">Es una feria municipal';
  $accion = "M";
} else {
  $titulo = "Nueva Feria";
  $titulo_boton = "Guardar";
  $us_form = InputGeneral("text", "fe_name", "form-control", "usuario", "nombre de la feria", "Nombre de la Feria:");
  $propia = '<input type="checkbox" value="1" checked="checked" name="fe_municipal">Es una feria municipal';
  $accion = "A";
}
  ?>
  <div class="container">
  <h3><?php echo $titulo; ?></h3>
    <form id="parte1" action="agrega_modifica_general.php" method="post" role="form">

    <div class="form-group">
   <?php echo $us_form; ?>
<div class="requerido" id="falta_nombre"></div>
</div>

  <div class="checkbox">
  <label>
    <?php echo $propia; ?>
  </label>
</div>


<button type="submit" class="btn btn-info" id="envia1"><?php echo $titulo_boton; ?></button>

<input type="hidden" name="fe_id" value="<?php echo $_GET['fe_id']; ?>" />
<input type="hidden" name="accion" value="<?php echo $accion; ?>" />
<input type="hidden" name="tabla" value="tb_ferias" />
</form>
</div>

<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $("#envia1").click(function() {
            if($("#usuario").val()==""){
            $("#falta_nombre").show();
            $('#falta_nombre').text("Debe completar este campo");
            return false;
            }

        });

            $("#usuario").focusout(function() {
                    if($("#usuario").val().length >= 3) {
                          $.get("comprobar.php", {dnii: $("#usuario").val(), tabla: "tb_ferias", valorbusc: "fe_name"}, function(respuesta){
                    if (respuesta == 1){
                        $("#falta_nombre").show();
                        $('#falta_nombre').text("Ya existe una feria con ese nombre");
                        $('#envia1').attr("disabled", true);
                    } else {
                        $("#falta_nombre").hide();
                        $('#envia1').attr("disabled", false);
                    }
              })
                    }

                  });
    });
</script>
</body>
</html>
