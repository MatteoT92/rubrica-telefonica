<?php include 'env.php'; ?>
<?php

$host = host(); // recupera l'host dal file env.php
$user = user(); // recupera l'username database MySQL dal file env.php
$password = password(); // recupera la password utente database MySQL dal file env.php

function create_db($name) {
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password']);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $sql = "CREATE DATABASE IF NOT EXISTS $name;";
        try {
            $conn->query($sql);
            $conn->close();
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}

function create_table($db, $name) {
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $sql = "CREATE TABLE IF NOT EXISTS $name (
                id int primary key auto_increment,
                numero varchar(10) not null unique,
                nome varchar(50) not null,
                cognome varchar(50),
                email varchar(50)
                );";
        try {
            $conn->query($sql);
            $conn->close();
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}

function insert($db, $table, $values) {
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $sql = "INSERT INTO $table (numero, nome, cognome, email) VALUES (?, ?, ?, ?);";
        try {
            $statement = $conn->prepare($sql); // prepara la query creando lo statement
            $statement->bind_param("ssss", $values[0], $values[1], $values[2], $values[3]); // effettua il binding dei parametri
            $statement->execute(); // esegue la query
            $statement->close(); // chiude lo statement
            $conn->close();
            return true; // ritorna true se l'inserimento è andato a buon fine
        } catch (mysqli_sql_exception $e) {
            return false; // ritorna false se l'inserimento ha generato questo errore
        }
    }
}

function select_all($db, $table) {
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $sql = "SELECT numero, nome, cognome, email FROM $table ORDER BY nome;";
        try {
            $result = $conn->query($sql);
            $conn->close();
            return $result->fetch_all(); // restituisce un array di array con tutti i dati ricavati
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}

function select_by_number($db, $table, $number) {
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $sql = "SELECT numero, nome, cognome, email FROM $table WHERE numero = '$number';";
        try {
            $result = $conn->query($sql);
            $conn->close();
            return $result->fetch_all()[0]; // restituisce un array con il singolo record trovato in base al numero telefonico
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}

function select_by_anything($db, $table, $regex) {
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $regex = strtolower($regex);
        $sql = "SELECT numero, nome, cognome, email FROM $table WHERE numero LIKE '%$regex%' OR nome LIKE '%$regex%' OR cognome LIKE '%$regex%' OR email LIKE '%$regex%' ORDER BY nome;";
        try {
            $result = $conn->query($sql);
            $conn->close();
            return $result->fetch_all(); // restituisce un array di array con tutti i dati ricavati in base al criterio di ricerca indicato lato client
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}

function delete($db, $table, $number) {
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $sql = "DELETE FROM $table WHERE numero = '$number';";
        try {
            $conn->query($sql);
            $conn->close();
            return true; // ritorna true se l'eliminazione è andata a buon fine
        } catch (mysqli_sql_exception $e) {
            return false; // ritorna false se l'eliminazione ha generato questo errore
        }
    }
}

function edit($db, $table, $number, $new_data) {
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $sql = "UPDATE $table SET nome = '$new_data[0]', cognome = '$new_data[1]', email = '$new_data[2]' WHERE numero = '$number';";
        try {
            $conn->query($sql);
            $conn->close();
            return true; // ritorna true se l'aggiornamento è andato a buon fine
        } catch (mysqli_sql_exception $e) {
            return false; // ritorna false se l'aggiornamento ha generato questo errore
        }
    }
}

?>