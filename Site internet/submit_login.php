<?php

$conn = mysqli_connect("localhost", "root", "", "test");

if (!$conn) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

$sql = "SELECT * FROM comptes WHERE username = ?";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    $username = $_POST['username'];

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    $passwordHash = sha1($_POST['password']);

    if ($user && $passwordHash === $user['password']) {
        header("Location: https://angusnicneven.com/");
        exit;
    } else {
        echo "Identifiants incorrects";
    }

} else {
    echo "Erreur lors de la préparation de la requête.";
}

mysqli_close($conn);
?>
