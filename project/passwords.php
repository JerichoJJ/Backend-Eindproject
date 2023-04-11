<?php

$input_string = readline("Welk wachtwoord wil je encrypten: ");

// Hash the input string using the default algorithm (currently bcrypt)
$hashed_password = password_hash($input_string, PASSWORD_DEFAULT);

// Print out the hashed password
echo "Hashed password: " . $hashed_password;
?>