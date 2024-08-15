<?php
$hostname_turnos = "localhost";
$database_turnos = "tur_lb";
$username_turnos = "root";
$password_turnos = "admin";

// Crear la conexión usando mysqli
$turnos = mysqli_connect($hostname_turnos, $username_turnos, $password_turnos, $database_turnos);

// Verificar si la conexión fue exitosa
if (!$turnos) {
    die("Connection failed: " . mysqli_connect_error());
}

// Establecer el conjunto de caracteres a utf8
mysqli_set_charset($turnos, "utf8");

// Si quieres ejecutar alguna consulta inicial, puedes hacerlo aquí.
// mysqli_query($turnos, "SET NAMES 'utf8'");

?>
