<?php include 'database.php'; ?>
<?php 
$numero = trim($_POST['numero-da-aggiornare']);
$nome = trim($_POST['nome-aggiornato']);
$cognome = trim($_POST['cognome-aggiornato']);
$email = trim($_POST['email-aggiornata']); 
$dati_aggiornati = [$nome, $cognome, $email]; 
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rubrica Telefonica</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    </head>
    <body class="overflow-hidden">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-4 offset-4">
                    <?php if (edit('rubrica_telefonica', 'contatti', $numero, $dati_aggiornati)): ?>
                    <div class="alert alert-success text-center" role="alert">
                        <i class="bi bi-emoji-smile mx-2 h1"></i>
                        <br />
                        <span class="h1">Contatto modificato con successo!</span>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <i class="bi bi-emoji-frown mx-2 h1"></i>
                        <br />
                        <span class="h1">Errore! Contatto non modificato.</span>
                    </div>
                    <?php endif; ?>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary" onclick="location.href='index.php'">
                            <i class="bi bi-house-door-fill me-2"></i>Torna alla Home
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
