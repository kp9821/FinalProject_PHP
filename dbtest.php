
<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');
$dbc = mysqli_connect("localhost", "root", "sesame");
if (!$dbc) {
    echo "<p>Unable to connect to MySQL</p>";
} else if (!mysqli_select_db($dbc, "CLUB")) {
    echo "<p>Inside MySQL: No HenryBooks found</p>";
} else {
    echo "<p>Connected to Club Database!</p>";
}

