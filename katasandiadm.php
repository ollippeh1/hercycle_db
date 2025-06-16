<?php
$password = 'Admincapek13';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password asli: $password\n";
echo "Hash-nya: $hash\n";
?>
