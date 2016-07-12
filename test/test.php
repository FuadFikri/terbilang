<?php
include('../src/terbilang.php');

$z = isset($_GET["z"]) ? (($u = strlen((string)$_GET["z"])) > 15 ? substr($_GET["z"], $u-15, 15): $_GET["z"]) : 15234123567;
$t = new Terbilang();
print $t->process($z);
?>
