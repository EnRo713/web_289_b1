<?php
$adminPassword = password_hash("Amcb1017!", PASSWORD_BCRYPT);
$userPassword = password_hash("Ears0713?", PASSWORD_BCRYPT);

echo "Admin Hashed Password: " . $adminPassword . "\n";
echo "User Hashed Password: " . $userPassword . "\n";
?>
