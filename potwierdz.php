<?php
require_once "./Scripts/Connect.php";

$conn = new mysqli($host, $uzytkownik, $haslo, $baza_danych);
if ($conn->connect_error) {
    die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
}
if (isset($_GET['link'])) {
    $verificationLink = $_GET['link'];

    // Sprawdzenie, czy link istnieje w bazie danych
    $sql = "SELECT email FROM users WHERE link_weryfikacyjny = '$verificationLink'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $email = $row['email'];

        // Aktualizacja wartości kolumny 'IsVerified' na '1' dla danego e-maila
        $updateSql = "UPDATE users SET IsVerified = 1 WHERE email = '$email'";
        if ($conn->query($updateSql) === TRUE) {
            echo "Adres e-mail $email został pomyślnie zweryfikowany.";
        } else {
            echo "Wystąpił błąd podczas weryfikacji adresu e-mail: " . $conn->error;
        }
    } else {
        echo "Nieprawidłowy link weryfikacyjny.";
    }
} else {
    echo "Brak parametru 'link' w adresie URL.";
}

$conn->close();
?>
