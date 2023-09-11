<?php include 'database.php'; ?>
<?php
$numero = $_GET['numero'];
$dati_contatto = select_by_number('rubrica_telefonica', 'contatti', $numero);
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
            <form name="aggiorna-contatto" action="edit.php" method="post">
                <input type="hidden" name="numero-da-aggiornare" value="<?php echo $dati_contatto[0] ?>" />
                <label for="nome-aggiornato">Nome</label>
                <input type="text" id="nome-aggiornato" name="nome-aggiornato" class="form-control" maxlength="50" required value="<?php echo $dati_contatto[1] ?>" />
                <label for="cognome-aggiornato">Cognome</label>
                <input type="text" id="cognome-aggiornato" name="cognome-aggiornato" class="form-control" maxlength="50" value="<?php echo $dati_contatto[2] ?>" />
                <label for="email-aggiornata">Email</label>
                <input type="email" id="email-aggiornata" name="email-aggiornata" inputmode="email" class="form-control" maxlength="50" value="<?php echo $dati_contatto[3] ?>" />
                <div class="text-center">
                    <button type="submit" class="btn btn-success" id="aggiorna">Salva</button>
                </div>
            </form>
        </div>
    </body>
</html>