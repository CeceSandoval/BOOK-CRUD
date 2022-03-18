<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "http://localhost/phpmyadmin/index.php"; $usuario = "root"; $contrasenia = "1234"; $nombreBaseDatos = "libros";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sql_libros = mysqli_query($conexionBD,"SELECT * FROM libros WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sql_libros) > 0){
        $libros = mysqli_fetch_all($sql_libros,MYSQLI_ASSOC);
        echo json_encode($libros);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sql_libros = mysqli_query($conexionBD,"DELETE FROM libros WHERE id=".$_GET["borrar"]);
    if($sql_libros){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $titulo=$data->titulo;
    $autor=$data->autor;
    $ISBN=$data->ISBN;
    $num_paginas =$data->num_paginas;
    $editorial=$data->editorial;
    $fecha_publicacion=$data->fecha_publicacion;

    if(($titulo!="")&&($autor!="")&&($ISBN!="")&&($num_paginas!="")&&($editorial!="")&&($fecha_publicacion!="")){

    $sql_libros = mysqli_query($conexionBD,"INSERT INTO libros(titulo,autor,ISBN,num_paginas,editorial,fecha_publicacion) VALUES('$titulo','$autor','$ISBN','$num_paginas','$editorial','$fecha_publicacion') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){

  $data = json_decode(file_get_contents("php://input"));
  $titulo=$data->titulo;
  $autor=$data->autor;
  $ISBN=$data->ISBN;
  $num_paginas =$data->num_paginas;
  $editorial=$data->editorial;
  $fecha_publicacion=$data->fecha_publicacion;

    $sql_libros = mysqli_query($conexionBD,"UPDATE libros SET titulo='$titulo',autor='$autor',ISBN='$ISBN',num_paginas='$num_paginas',editorial='$editorial',fecha_publicacion='$fecha_publicacion' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sql_libros = mysqli_query($conexionBD,"SELECT * FROM libros ");
if(mysqli_num_rows($sql_libros) > 0){
    $libros = mysqli_fetch_all($sql_libros,MYSQLI_ASSOC);
    echo json_encode($libros);
}
else{ echo json_encode([["success"=>0]]); }


?>
