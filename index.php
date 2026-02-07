<?php

echo "Ciao Gianni <br><br>";
$db = new PDO(
    "mysql:host=192.168.60.144;dbname=riccardo_gianesella_clinica;charset=utf8mb4",
    "riccardo_gianesella",
    "cannucce.salterio.",
    [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]
);

try {
    $stmt = $db->query('SELECT * FROM pazienti');

    while ($user = $stmt->fetch()) {
        echo "nome: {$user->nome}<br>";
        echo "cognome: {$user->cognome}<br>";
        echo "data_nascita: {$user->data_nascita}<br>";
        echo "provincia: {$user->provincia}<br>";
        echo "codice_ASL: {$user->codice_asl}<br><br>";
    }

} catch (PDOException $e) {
    echo "A DB error occurred. Please try again later.";
}




echo "---------------";
echo "<br>";


$query = "SELECT nome,cognome FROM pazienti WHERE nome = :nome";

try{
    $stmt = $db->prepare($query);
    $stmt-> bindValue(":nome","Luca",PDO::PARAM_STR);
    $stmt-> execute();

    while ($user = $stmt->fetch()) {
        echo "nome: {$user->nome}<br>";
        echo "cognome: {$user->cognome}<br>";
        echo "data_nascita: {$user->data_nascita}<br>";
        echo "provincia: {$user->provincia}<br>";
        echo "codice_ASL: {$user->codice_asl}<br><br>";
    }

} catch (PDOException $e) {
    echo "A DB error occurred. Please try again later.";
}

echo "---------------";
echo "<br>";

$query = "INSERT INTO pazienti(nome,cognome,data_iscrizione)
            VALUES ( :nome, :cognome, :data_nascita,NOW())";

try{
    $stmt = $db->prepare($query);
    $stmt-> bindValue(":nome","Luca",PDO::PARAM_STR);
    $stmt-> bindValue(":cognome","",PDO::PARAM_STR);
    $stmt-> bindValue(":data_nascita","2024-03-15",PDO::PARAM_STR);
    $stmt->execute();
    echo "insert successfull";
    $stmt-> closeCursor();
} catch (PDOException $e) {
    echo "A DB error occurred. Please try again later.";
}
