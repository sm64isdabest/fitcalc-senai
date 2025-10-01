<?php
$password = '123456';

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo $hashedPassword;
// PARA RODAR BASTA ABRIR O TERMINAL (CTRL+J) E RODAR O COMANDO ABAIXO:
// php test.php

// RESULTADO:
// $2y$12$JFsscNxgtdEMaOBF6gILYuaIqSgn.5BaDL7cJMs4PCL1zyUnF5lnm
?>