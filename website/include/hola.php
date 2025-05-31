
<?php
//CREATE_USER

// Vulnerable: usa SHA1 para guardar la contraseña
$query = "INSERT INTO `users` (`id`, `login`, `password`, `firstname`, `lastname`, `salt`, `tradebux`, `created_on`, `last_login_on`) VALUES (NULL, '{$username}', SHA1('{$pass}'), '{$firstname}', '{$lastname}','{$salt}', '{$initial_bux}', NOW(), NOW());";
<?php
// Vulnerable: usa SHA1 para guardar la contraseña
$query = sprintf("INSERT INTO `users` (`id`, `login`, `password`, `firstname`, `lastname`, `salt`, `tradebux`, `created_on`, `last_login_on`) VALUES (NULL, '%s', SHA1('%s'), '%s', '%s', '%s','%d', NOW(), NOW());",
    mysql_real_escape_string($username),
    mysql_real_escape_string($pass . $salt),
    mysql_real_escape_string($firstname),
    mysql_real_escape_string($lastname),
    mysql_real_escape_string($salt),
    mysql_real_escape_string($initial_bux)
);
//CHECK_LOGIN
<?php
// Vulnerable: compara la contraseña usando SHA1
$query = sprintf("SELECT * from `users` where `login` like '%s' and `password` = SHA1( CONCAT('%s', `salt`)) limit 1;",
    $username,
    mysql_real_escape_string($pass)
);
// Vulnerable: compara la contraseña usando SHA1
$query = sprintf("SELECT * from `users` where `login` like '%s' and `password` = SHA1( CONCAT('%s', `salt`)) limit 1;",
    mysql_real_escape_string($username),
    mysql_real_escape_string($pass)
);