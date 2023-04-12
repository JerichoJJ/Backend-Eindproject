<?php

$input_string = readline("Welk wachtwoord wil je encrypten: ");

// Hash de input_string (bcrypt)
$hashed_password = password_hash($input_string, PASSWORD_DEFAULT);

// Print de nieuwe Hashed_password
echo "Hashed password: " . $hashed_password;
?>