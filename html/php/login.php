<?php
$link = mysqli_connect("localhost", "root", "", "database");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$usr = $_POST['user'];
$pwd = $_POST['password'];

/* prepare */
if (!($stmt = $link->prepare("SELECT password FROM users WHERE username = ?"))) {
    echo "Prepare failed: (" . $link->errno . ") " . $link->error;
}

/* bind and execute */
if (!$stmt->bind_param("s", $usr)) {
   echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
   echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}

$res = $stmt->get_result();

$erg = mysqli_fetch_array($res); 
$pwd_db = $erg['password'];

if (password_verify($pwd, $pwd_db)) {
    echo "http://localhost/webseite_ba_sicher/html/success.html";
} 

/* explicit close recommended */
$stmt->close();

?>