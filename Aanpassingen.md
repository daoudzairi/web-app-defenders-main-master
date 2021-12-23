# TEGEN DEMO 2

### Evaluatiecriteria wachtwoorden en aanmelden
# Conclusie/Aanbevelingen
1.	**Controle bij de creatie van een nieuw wachtwoord moet aangepast worden zodat dit controlleert op een minimale lenge van 8 karakters.**
**X** Wachtwoord kan minder dan 8 tekens bevatten. \ 
ASHOT

### Applications on Webserver enumeration
**Niet gebruikte poorten op de server te sluiten, of open laten mits gebruik van IP whitelisting.**
-	https://ehbdefendersblog.com:8443/login geeft een 522 response
-	Open poorten: 80, 443, 8080, 8443 
ASHOT

### Conclusie/aanbevelingen
1.	**APP_DEBUG op false zodat de debug pagina niet meer zichtbaar is**
3.	**CSFR token kan eventueel als variabele worden meegeven, bijvoorbeeld als volgt: ```<input type="hidden" name="_token" value="{{ csrf_token() }}"/>``` in plaats van hard coded in de html te plaatsen.**
4.	**https://ehbdefendersapp.azurewebsites.net eventueel laten redirecten naar https://ehbdefendersblog.com**
SONER 

### Webpage Content Information Leakage	
-	Wanneer een aangemelde gebruiker op één van de volgende links klikt komt een debug pagina tevoorschijn waar een deel van de source code te lezen is: \
		- 'Workspace' in de navigation bar \
		- 'Find out more' op de home pagina
SONER

- ssl labs report grade: A.
De toepassing is ook in grote lijnen conform met de Europese privacy regelgeving. 
DAOUD

ADMIN PANNEL AANMAKEN
SONER & TISCHA

ACCEPTATIE C. AANPASSEN
THREAD MODEL AANPASSEN
TISCHA


Mailtrap oplossen om direct met mail te werken



