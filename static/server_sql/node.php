<?php 
require_once ('conectar1.php');
$conexion = conectar1();
// el strip_tags impide que se ejecuten codigo indeseados
$serie = strip_tags($_POST ['SNN']); // el numero de serie que se quiere mostrar
$mes = strip_tags($_POST ['mes']);    // La fecha que se quiere mostrar
$dia = strip_tags($_POST ['dia']);    // El día que se quiere mostrar
$todo = $_POST ['all'];

if ($todo == "todo" ){
$mes = "999";    // La fecha que se quiere mostrar
$dia = "999";    // El día que se quiere mostrar
    echo "Muestra todo el record";
}else{
    echo "Muestra por día";
}
    // mostrar toda la base de datos

$intervalo=0;
//temperatura_diaria("777", "0", "11", "20");
//temperatura_diaria($conexion,$serie, $intervalo, $mes, $dia);

function temperatura_diaria ($conexion,$serie,$intervalo,$mes,$dia,$todo) {
    
    $ano=date("Y");
   
    if ($todo == "todo"){
      $resultado=mysqli_query($conexion, "SELECT UNIX_TIMESTAMP(`fecha`), `Temperatura` FROM data WHERE `Serie`= '$serie'");
    }else{

   $resultado=mysqli_query($conexion, "SELECT UNIX_TIMESTAMP(`fecha`), `Temperatura` FROM data WHERE year(`fecha`) = '$ano' AND month(`fecha`) = '$mes' AND day(`fecha`) = '$dia' AND `Serie`= '$serie'");

    }

    while ($row=mysqli_fetch_array($resultado, MYSQLI_NUM))

    {
        echo "[";
        echo $row[0]*1000;
        echo ",";
        echo $row[1];
        echo "],";

        for ($x=0; $x<$intervalo; $x++)
        {
            $row=mysqli_fetch_array($resultado,MYSQLI_NUM);
        }
    }

    mysqli_close($conexion);
}

?>