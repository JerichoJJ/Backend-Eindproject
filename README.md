# Backend-Eindproject
## Projectbeschrijving
Dit project is een eenvoudig voorbeeld van een registratiepagina in PHP met beveiliging tegen zwakke wachtwoorden en SQL-injectie. Gebruikers kunnen zich registreren door hun gebruikersnaam, wachtwoord en bevestiging van het wachtwoord in te voeren. De pagina controleert vervolgens of het wachtwoord voldoet aan de minimale eisen van lengte, bevat ten minste één cijfer en één hoofdletter, en of beide wachtwoorden overeenkomen. Als aan deze eisen is voldaan, wordt het wachtwoord gehasht en opgeslagen in een MySQL-database. Als er al een gebruiker bestaat met dezelfde gebruikersnaam, krijgt de gebruiker een foutmelding te zien en wordt de registratie geannuleerd.

## Gebruik
Om dit project te gebruiken, moet u de bestanden op een webserver plaatsen die PHP en MySQL ondersteunt. Maak vervolgens een database aan en voer het users.sql script uit om de benodigde tabel aan te maken. Pas ten slotte de config.php aan met de juiste databasegegevens en bezoek de registratiepagina in uw webbrowser om het project te gebruiken.

## Vereisten
Dit project vereist een webserver met PHP 7 of hoger en MySQL 5.6 of hoger. Ook moet de webserver toegang hebben tot de PDO extensie en de bcrypt hashing functie.

## Auteurs
Dit project is gemaakt door Jericho Clare student aan de Bit-academie(locatie amsterdam).

