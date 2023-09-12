<?php include 'database.php'; ?>
<?php
$numero = trim($_GET['numero']);
$dati_contatto = select_by_number('rubrica_telefonica', 'contatti', $numero);
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
            <div class="row text-center d-inline-flex" onclick="location.href='index.php'">
                <h1 style="cursor: pointer;"><i class="bi bi-journal-bookmark-fill"></i>Rubrica Telefonica</h1>
            </div>
            <div class="row align-items-center min-vh-100">
                <div class="col-4 offset-4">
                    <div class="text-center">
                        <h2><i class="bi bi-pencil-square me-2"></i>Modifica Contatto</h2><br>
                        <h3><i class="bi bi-telephone-fill mx-2"></i><?php echo $dati_contatto[0] ?></h3>
                    </div>
                    <form name="aggiorna-contatto" action="edit.php" method="post">
                        <input type="hidden" name="numero-da-aggiornare" value="<?php echo $dati_contatto[0] ?>" />
                        <label for="nome-aggiornato">Nome</label>
                        <input type="text" id="nome-aggiornato" name="nome-aggiornato" class="form-control" maxlength="50" required value="<?php echo $dati_contatto[1] ?>" />
                        <label for="cognome-aggiornato">Cognome</label>
                        <input type="text" id="cognome-aggiornato" name="cognome-aggiornato" class="form-control" maxlength="50" value="<?php echo $dati_contatto[2] ?>" />
                        <label for="email-aggiornata">Email</label>
                        <input type="email" id="email-aggiornata" name="email-aggiornata" inputmode="email" class="form-control" maxlength="50" value="<?php echo $dati_contatto[3] ?>" />
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-square-fill me-2"></i>Salva
                            </button>
                            <button type="button" class="btn btn-danger" onclick="location.href='index.php'">
                                <i class="bi bi-x-square-fill me-2"></i>Annulla
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>