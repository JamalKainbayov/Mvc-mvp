# Voorbeelduitwerking fase 1

In deze voorbeelduitwerking zie je de basis van een MVC project in PHP. Zet deze files in je htdocs en ga naar de "homepage.php" in de controllers map om de pagina in werking te zien.

## Mapjes

### Models

In de models komen alle php files die databeheer doen. Dat betekend onder andere dingen in de database zetten, ze er uit halen, updaten, deleten etc, maar ook bijvoorbeeld code die niet-database gerelateerde dingen doet met data, zoals fotos opslaan. Validatie van data (bv, is de datum van een aankoop niet in de toekomst, bestaat een id) gebeurt ook allemaal in de model. Files buiten de model folder doen niks met dataverwerking of -opslag.

### Views

In de views komen alle php files die een "view" maken. Dat wil zeggen, wat de gebruiker ziet. Dus, de code die de html maakt die naar de gebruiker gaat. Maar ook API's komen in de views, bijvoorbeeld een api die een JSON bestand teruggeeft (dit kan de controller bijvoorbeeld uit de request afleiden, of er is een aparte controller voor de api). Er kunnen meerdere views zijn voor dezelfde "informatie", bijvoorbeeld een html desktop view, een html mobile view, een api voor de app, een api voor bots, etc. De view doet niks anders dan informatie binnenkrijgen via zijn aanroep en deze op de juiste plek, in de juiste vorm, met de juiste styling, etc zetten. Een view doet niet aan validatie, en verzameld zelf geen extra informatie.

### Controllers

In de controllers komen alle php files die een request afhandelen. De controller krijgt een verzoek van de gebruiker binnen, en op basis van het verzoek, haalt het de benodigde informatie op uit de models, die de controller vervolgens doorgeeft aan de juiste view.