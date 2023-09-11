<?php include 'database.php'; ?>
<?php create_db('rubrica_telefonica'); ?>
<?php create_table('rubrica_telefonica', 'contatti', ['id int primary key auto_increment', 'numero varchar(10) not null unique', 'nome varchar(50) not null', 'cognome varchar(50)', 'email varchar(50)']); ?>
<?php $contatti = select_all('rubrica_telefonica', 'contatti'); ?>
<?php $filtrati = []; ?>
<?php if (isset($_GET['ricerca'])): ?>
<?php $filtrati = select_by_anything('rubrica_telefonica', 'contatti', $_GET['ricerca']); ?>
<?php endif; ?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rubrica Telefonica</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <div class="row my-2">
                <div class="col text-center d-inline-flex" onclick="location.href='index.php'">
                    <h1><i class="bi bi-journal-bookmark-fill"></i>Rubrica Telefonica</h1>
                </div>
                <div class="col-3 text-right d-inline">
                    <form name="cerca" action="index.php" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control" id="ricerca" name="ricerca" placeholder="Cerca" />
                            <button type="submit">
                                <div class="input-group-append">
                                    <i class="bi bi-search"></i>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <ul class="list-group">
                    <?php if (count($contatti) > 0 && count($filtrati) == 0): ?>
                    <?php for ($i = 0; $i < count($contatti); $i++): ?>
                        <li class="list-group-item">
                            <div class="col-1 text-left d-inline-flex">
                                <span class="fw-bold"><?php echo strtoupper(substr($contatti[$i][1], 0, 1)) ?></span>
                            </div>
                            <div class="col text-right d-inline-flex">
                                <span class="mx-2"><i class="bi bi-telephone-fill mx-2"></i><?php echo $contatti[$i][0] ?></span>
                                <span class="mx-2"><i class="bi bi-person-fill mx-2"></i><?php echo $contatti[$i][1] . ' ' . $contatti[$i][2] ?></span>
                                <span class="mx-2"><i class="bi bi-envelope-at-fill mx-2"></i><?php echo $contatti[$i][3] ?></span>
                                <button type="button" class="btn btn-warning btn-sm mx-2" onclick="location.href='form-edit.php?numero=<?php echo $contatti[$i][0] ?>'">Modifica</button>
                                <button type="button" class="btn btn-danger btn-sm mx-2" onclick="location.href='delete.php?numero=<?php echo $contatti[$i][0] ?>'">Elimina</button>
                            </div>
                        </li>
                    <?php endfor; ?>
                    <?php elseif (count($contatti) > 0 && count($filtrati) > 0): ?>
                    <?php for ($i = 0; $i < count($filtrati); $i++): ?>
                        <li class="list-group-item">
                            <div class="col-1 text-left d-inline-flex">
                                <span class="fw-bold"><?php echo strtoupper(substr($filtrati[$i][1], 0, 1)) ?></span>
                            </div>
                            <div class="col text-right d-inline-flex">
                                <span class="mx-2"><i class="bi bi-telephone-fill mx-2"></i><?php echo $filtrati[$i][0] ?></span>
                                <span class="mx-2"><i class="bi bi-person-fill mx-2"></i><?php echo $filtrati[$i][1] . ' ' . $filtrati[$i][2] ?></span>
                                <span class="mx-2"><i class="bi bi-envelope-at-fill mx-2"></i><?php echo $filtrati[$i][3] ?></span>
                                <button type="button" class="btn btn-warning btn-sm mx-2" onclick="location.href='form-edit.php?numero=<?php echo $filtrati[$i][0] ?>'">Modifica</button>
                                <button type="button" class="btn btn-danger btn-sm mx-2" onclick="location.href='delete.php?numero=<?php echo $filtrati[$i][0] ?>'">Elimina</button>
                            </div>
                        </li>
                    <?php endfor; ?>
                    <?php else: ?>
                        <li class="list-group-item">Nessun contatto presente</li>
                    <?php endif; ?>
                    </ul>
                </div>
                <div class="col-3">
                    <div class="text-center">
                        <h2><i class="bi bi-person-plus-fill mx-2"></i>Nuovo Contatto</h2>
                    </div>
                    <form name="salva-contatto" action="add.php" method="post">
                        <label for="numero">Numero</label>
                        <input type="text" id="numero" name="numero" inputmode="tel" class="form-control" required maxlength="10" />
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" class="form-control" maxlength="50" required />
                        <label for="cognome">Cognome</label>
                        <input type="text" id="cognome" name="cognome" class="form-control" maxlength="50" />
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" inputmode="email" class="form-control" maxlength="50" />
                        <div class="text-center mt-2">
                            <button type="submit" class="btn btn-success" id="salva">Salva</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="script.js"></script>
    </body>
</html>