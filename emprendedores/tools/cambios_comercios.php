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
if (!empty($_GET['or_id'])){
  $titulo = "Modificar Comercio";
  $titulo_boton = "Hacer Cambios";
  $us_form = InputGeneralVal("text", "co_name", "form-control", "usuario", "nombre de la organizacion", "Nombre del Comercio:",BuscaRegistro ("tb_organizaciones", "or_id", $_GET['or_id'], "or_name"));
  

  $accion = "M";
} else {
  $titulo = "Nuevo Comercio";
  $titulo_boton = "Guardar";
  $us_form = InputGeneral("text", "co_name", "form-control", "usuario", "nombre del comercio", "Nombre del Comercio:");
  $depto_provincial = SelectFiltro("co_depto_provincial", "form-control", "iddepartamento", "Departamento Provincial:","tb_departamentos", "dep_id", "dep_name","dep_mostrar","1"); 
  $localidad = '<select name="co_localidad" class="form-control" id="idlocalidad"></select>';
  $calle = '<input id="dpcalle" type="text" class="form-control" placeholder="escriba la calle" autocomplete="off" name="co_calle"/>';
  $numero = InputGeneral("number", "co_altura", "form-control", "nrolocac", "escriba el nro del domicilio", "Altura:","");
  $piso = InputGeneral("text", "co_piso", "form-control", "idpiso", "escriba el piso", "Piso:","");
  $departamento = InputGeneral("text", "co_depto", "form-control", "iddepto", "escriba el departamento", "Departamento:","");
  $cuil = '<input type="text" class="form-control" id="nrocuil" name="co_cuit"
           placeholder="escriba el nro de CUIT" maxlength="13">';
  $accion = "A";
}
  ?>
  <div class="container">
  <h3><?php echo $titulo; ?></h3>
    <form id="parte1" action="agrega_modifica_general.php" method="post" role="form">

    <div class="form-group has-success">
   <?php echo $us_form; ?>
<div class="requerido" id="falta_nombre"></div>
</div>


<div class="row">
  <div class="col-xs-12 col-md-6">
  <div class="form-group has-success">
   <?php echo $depto_provincial; ?>
   <div class="requerido" id="falta_depto"></div>
</div>
   </div>

   <div class="col-xs-12 col-md-6">
   <div class="form-group has-success">
   <label>Localidad:</label>
    <?php echo $localidad; ?>
    <div class="requerido" id="falta_localidad"></div>
</div>
   </div>
   </div>

<div class="form-group">
  <label>Calle:</label>
  <?php echo $calle; ?>
</div>

<div class="row">
  <div class="col-xs-12 col-md-4">
<div class="form-group">
   <?php echo $numero; ?>
  </div>
  </div>
  <div class="col-xs-12 col-md-4">
<div class="form-group">
   <?php echo $piso; ?>
  </div>
  </div>
  <div class="col-xs-12 col-md-4">
<div class="form-group">
   <?php echo $departamento; ?>
  </div>
  </div>
  </div>

 <div class="form-group">
  <label for="nrocuil">Nro de CUIT:</label>
    <?php echo $cuil; ?>
    
    </div>


  <button type="submit" class="btn btn-info" id="envia1"><?php echo $titulo_boton; ?></button>
  


<input type="hidden" name="or_id" value="<?php echo $_GET['or_id']; ?>" />

<input type="hidden" name="accion" value="<?php echo $accion; ?>" />

<input type="hidden" name="co_dp_id" value="<?php echo $_GET['co_dp_id']; ?>" />

<input type="hidden" name="tabla" value="tb_comercios" />
</form>
</div>
   <script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/bootstrap.min.js"></script>
 <script src="../../js/bootstrap-typeahead.js"></script>
 <script src="../../js/jquery.mask.min.js"></script>
<script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $("#envia1").click(function() {
            if($("#usuario").val()==""){
            $("#falta_nombre").show();
            $('#falta_nombre').text("Debe completar este campo");
            return false;
            }

            if($("#iddepartamento").val()==""){
            $("#falta_depto").show();
            $('#falta_depto').text("Debe completar este campo");
            return false;
            }

            if($("#idlocalidad").val()==""){
            $("#falta_localidad").show();
            $('#falta_localidad').text("Debe completar este campo");
            return false;
            }

            
            
        });

           $("#iddepartamento").change(function () {  
                $("#iddepartamento option:selected").each(function () {
            elegido=$(this).val();
            $.post("localidades.php", { elegido: elegido }, function(data){
            $("#idlocalidad").html(data);
            });           
        }); 
      });
           $('#nrocuil').mask('00-00000000-0');

    });
</script>
<script>
            $(function() {
                function displayResult(item) {
                    $('.alert').show().html('You selected <strong>' + item.value + '</strong>: <strong>' + item.text + '</strong>');
                }
                $('#dpcalle').typeahead({
                    ajax: {
                        url: 'autocom.php?query=%QUERY',
                        method: 'post',
                        triggerLength: 1
                    },
                    onSelect: displayResult
                });

  });
        </script>
</body>
</html>