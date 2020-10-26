<ol type="inherit">Requisitos:
    <li>Php 7.2+</li>
    <li>MySQL 5.5+</li>
    <li>Apache 2 con Mod Rewrite activado</li>
</ol>

<ol type=”A”>Instalar: 
  <li>Correr el comando: <strong>composer install</strong></li>
  <li>Correr el comando: <strong>npm install && npm run dev</strong></li>
  <li>Modificar los atributos en el archivo .env:
  			- DB_DATABASE=directorio
            - DB_USERNAME=root
            - DB_PASSWORD=root 
  </li>
  <li>Correr el script ubicado en database/scripts/create_schema.sql</li>
  <li>Correr el comando: <strong>php artisan migrate</strong></li>
  <li>Correr el comando: <strong>php artisan key:generate</strong></li>
  <li>Otorgarle permisos de lectura y escritura a la carpeta storage/</li>
  <li>Correr el comando: <strong>php artisan serve</strong></li>
</ol>
