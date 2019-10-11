# Ett REST-API

Jag skapade ett enkelt REST API med PHP där jag har stöd för GET-, POST-, PUT- och DELETE-metoderna. Lösningen är objektorienterad och jag har skapat metoder i en klass som heter Course.

*Viktigt:* jag har skapat ett properties.php med constants som innehåller mitt publika lösenord till studentdatabasen. Den ser ut såhär: 

```php
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'course');
define('DB_PASSWORD', 'course123');
define('DB_NAME', 'course');
```
Denna fil har jag valt att inte inkludera i repot för att skydda lösenordet.