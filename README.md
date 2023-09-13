# Rubrica Telefonica
Applicazione per la gestione della rubrica di contatti telefonici.

## Tecnologie usate

**Front-end:** HTML, CSS, Bootstrap

**Back-end:** PHP

**Database:** MySQL

**Version Control System:** Git
## Prerequisiti

Aver installato i seguenti software:

- [XAMPP](https://www.apachefriends.org/it/download.html)
- [Git Bash](https://git-scm.com/)

## Installazione

Scarica il progetto

```bash
  git clone https://github.com/MatteoT92/rubrica-telefonica.git
```

Copiare la cartella "rubrica-telefonica" in XAMPP

```bash
  mv rubrica-telefonica /C/xampp/htdocs
```

Creare un file .env

```bash
  cd /C/xampp/htdocs/rubrica-telefonica
  touch .env
```

Aprire il file .env appena creato e inserisci le seguenti chiavi riguardanti i propri dati per la connessione a MySQL

```bash
  HOST = INSERIRE QUI IL PROPRIO HOST (es. localhost)
  USER = INSERIRE QUI IL NOME DELLO USER CON CUI CONNETTERSI A MySQL (es. root)
  PASSWORD = INSERIRE QUI LA PASSWORD DELLO USER CON CUI CONNETTERSI A MySQL
```

Infine, accedi al pannello di controllo di XAMPP e clicca Start su Apache e MySQL

## Esecuzione nel browser

Per testare la web-app occorre andare sul browser e digitare il seguente URL

```http
  http://localhost/rubrica-telefonica
```

## Autore:
Matteo Tartaglione
## 🔗 Links
[![github](https://img.shields.io/github/followers/MatteoT92?style=for-the-badge&logo=github&logoColor=white)](https://github.com/MatteoT92)

[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/matteotartaglione/)