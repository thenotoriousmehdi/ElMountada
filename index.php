<?php
include_once 'server/db.php';

$db = new Database();
$conn = $db->connectDb();
echo "Connection test completed.";
$db->disconnectDb($conn);
?>
