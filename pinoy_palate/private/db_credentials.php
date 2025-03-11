<?php

// Keep database credentials in a separate file
// 1. Easy to exclude this file from source code managers
// 2. Unique credentials on development and production servers
// 3. Unique credentials if working with multiple developers

if ($_SERVER['SERVER_NAME'] == 'localhost') {
  define("DB_SERVER", "localhost");
  define("DB_USER", "pinoyUser");
  define("DB_PASS", "Fdt777rez%");
  define("DB_NAME", "pinoy_palate");
} elseif ($_SERVER['SERVER_NAME'] == 'web250.noidofbuenavista.click') {
  define("DB_SERVER", "localhost");
  define("DB_USER", "uxoizzgxokrha");
  define("DB_PASS", "1^<DB_f@2;s8");
  define("DB_NAME", "dbbtfvfvva7qig");
}

?>
