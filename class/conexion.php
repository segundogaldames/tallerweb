<?php
$usuario = 'root';
$clave = 1234;

try {
    $mbd = new PDO('mysql:host=localhost;dbname=tallerweb', $usuario, $clave);
    // foreach($mbd->query('SELECT * from FOO') as $fila) {
    //     print_r($fila);
    // }
    // $mbd = null;
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}