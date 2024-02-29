<?php
include 'db.php';

if(isset($_POST['username'])) {
    $username = $_POST['username'];
    $query = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute([$username]);

    if($query->rowCount() > 0) {
        echo "taken";
    } else {
        echo "available";
    }
}
?>
