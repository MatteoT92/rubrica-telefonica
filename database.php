<?php

$host = "localhost";
$user = "root";
$password = "matteot92";

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

function create_table($db, $name, $columns) {
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $sql = "CREATE TABLE IF NOT EXISTS $name (";
        for ($i = 0; $i < count($columns); $i++) { // per ogni colonna
            $sql .= "$columns[$i], "; // aggiungo la colonna alla query
        }
        $sql = substr($sql, 0, -2); // rimuovo dalla query l'ultimo spazio e virgola
        $sql .= ");"; // aggiungo alla fine della query la parentesi e il punto e virgola
        try {
            $conn->query($sql);
            $conn->close();
        } catch (mysqli_sql_exception $e) {
            echo $e->getMessage();
        }
    }
}

function insert($db, $table, $columns, $values) {
    $conn = new mysqli($GLOBALS['host'], $GLOBALS['user'], $GLOBALS['password'], $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $sql = "INSERT INTO $table (";
        for ($i = 0; $i < count($columns); $i++) { // per ogni colonna
            $sql .= "$columns[$i], "; // aggiungo la colonna alla query
        }
        $sql = substr($sql, 0, -2); // rimuovo dalla query l'ultimo spazio e virgola
        $sql .= ") VALUES ("; // chiudo la parentesi delle colonne e aggiungo la parentesi per inserire i valori
        for ($i = 0; $i < count($values); $i++) { // per ogni valore
            $sql .= "'$values[$i]', "; // aggiungo il valore alla query
        }
        $sql = substr($sql, 0, -2); // rimuovo dalla query l'ultimo spazio e virgola
        $sql .= ");"; // aggiungo alla fine della query la parentesi e il punto e virgola
        try {
            $conn->query($sql);
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