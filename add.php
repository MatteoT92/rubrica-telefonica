<?php include 'database.php'; ?>
<?php
$numero = $_POST['numero'];
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$email = $_POST['email'];
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rubrica Telefonica</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <?php if (insert('rubrica_telefonica', 'contatti', ['numero', 'nome', 'cognome', 'email'], [$numero, $nome, $cognome, $email])): ?>
            <div class="alert alert-success text-center" role="alert">
                Contatto aggiunto con successo!
            </div>
            <?php else: ?>
            <div class="alert alert-danger text-center" role="alert">
                Errore! Contatto non inserito.
            </div>
            <?php endif; ?>
            <div class="text-center">
                <button type="button" class="btn btn-primary" onclick="location.href='index.php'">Torna alla Home</button>
            </div>
        </div>
    </body>
</html>
