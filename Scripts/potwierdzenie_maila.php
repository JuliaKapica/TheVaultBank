<form method="POST">
    Podaj twój adres e-mail: <br><br>
    <input type="text" name="email"><br><br>
    <input type="submit" value="POTWIERDŹ"><br>
</form>

<?php
session_start();
if(isset($_GET['code'])){
    $verificationCode = $_GET['code'];
    require_once "./Connect.php";

    $sql = "UPDATE users SET IsVerified = '1' WHERE VerificationCode = '$verificationCode'";
    $conn->query($sql);

    if ($conn->affected_rows == 0){
        echo 'Nieprawidłowy kod weryfikacyjny';
    } else {
        echo 'Konto zostało zweryfikowane';
    }
}
?>
<a href="../logowanie.php">powrot do strony glownej </a>
