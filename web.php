<?php 
require_once("conexion.php");
class Web{
		//GUARDAR REGISTRO
	static public function guardar($tabla,$data){
		$ex_campos_tag = '';
		$ex_etiquetas_tag = '';

		$sql = "INSERT INTO ".$tabla." (";
			$i=0;
			foreach($data as $key=>$value)://llenamos el string de los campos que se usaron
				if($i==0){
					$sql .= '`'.$key."`";
				}else{
					$sql .= ' ,`'.$key."`";
				}
					$i++;
			endforeach;
			$sql.= ") VALUES (";
			$i=0;
			foreach($data as $key=>$value)://llenamos el string de los valores que tomaran los campos
				if($key==$ex_campos_tag){}else if($ex_campos_tag=='todo'){}else{$ex_etiquetas_tag=='';}
				if($i==0){
				$sql .= "'".addslashes(htmlspecialchars(strip_tags(trim($value),$ex_etiquetas_tag)))."'";
				}else{
					$sql .= " ,'".addslashes(htmlspecialchars(strip_tags(trim($value),$ex_etiquetas_tag)))."'";

				}
				$i++;
			endforeach;
			$sql.= ")";

			$stmt = Conexion::conectar()->prepare($sql);
		if($stmt -> execute()){
					return 1;
				}else{
					return 0;
				}

			$stmt-> close();

			$stmt = null;
	}
}
 ?>