<?php
$link = mysqli_connect("localhost", "root", "", "database");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$input = $_POST["action"];

if (!($stmt = $link->prepare("SELECT id, username FROM users WHERE username = ?"))) {
    echo "Prepare failed: (" . $link->errno . ") " . $link->error;
}

if (!$stmt->bind_param("s", $input)) {
   echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$output = "<h4>Gefundene Einträge:</h4><table class='usertable'><tr style='background-color: #1c8adb;color: white;'><td>ID</td><td>Username</td></tr>";
$res = $stmt->get_result();
while ($row = mysqli_fetch_array($res)) {
    $output .= "<tr><td>".$row['id']."</td><td>".$row['username']."</td></tr>";
}
$output .= "</table>";
echo $output;

/* explicit close recommended */
$stmt->close();

?>