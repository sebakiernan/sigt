<?php
include ("../../conecta.php");
include ("../../funciones/funciones_generales.php");
		$txt = "select * from tb_cursos_externos order by ce_name";
		$query = mysql_query($txt);
			$res = "";
			$res .= '<option></option>';
			
			$res .= '<optgroup label="Accion">';
			$res .= '<option>Agregar</option>';
			
			$res .= '<optgroup label="Cursos">';
			while($a=mysql_fetch_array($query)){
				$res .= '<option value="'.$a['ce_id'].'">'.utf8_encode($a['ce_name']).' | '.utf8_encode($a['ce_dictado']).'</option>';
			}
	echo $res;
	?>