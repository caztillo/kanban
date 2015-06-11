#Acerca de

# Guía de Instalación

El siguiente tutorial tiene como objetivo instalar SCB en Linux, en concreto se explica 

cómo realizar la instalación en Ubuntu 12.04. El proceso de instalación no es complicado, 

pero es necesario instalar primero unos cuantos paquetes en el sistema operativo 

incluyendo: el servidor web Apache, el lenguaje PHP y la bases de datos MySQL que, como 

en todo CMS, son necesarias para guardar los contenidos que subamos a la red.
Nota: Los comandos que se muestran deben ser ejecutados en la Terminal/Consola de Ubuntu 

la cual se encuentra en Aplicaciones + Accesorios + Terminal. Los comandos que estén 

precedidos por un “#” deben ser ejecutados como súper usuario (usuario ROOT).

Paso 1: Instalación del servidor web con Apache2:
# apt-get install apache2-mpm-prefork

Este comando va a instalar desde Internet el servidor Apache, después de resolver las 

dependencias necesarias, preguntará si desea  continuar, para ello se teclea la letra “S” 

(Mayúscula). Esto lo realizará para la mayoría de los paquetes que va a instalar mediante 

apt-get.

Paso 2: Una vez que el proceso termine es necesario especificar la asociación que tendrá 

el nombre del PC/Servidor con el nombre de dominio, esto se llama FQDN y lo hace de la siguiente manera:

1.- Cree el archivo fqdn dentro de la configuración de apache con su editor de texto  (nano en este caso):
# nano /etc/apache2/conf.d/fqdn

2.- Dentro de ese archivo escriba lo siguiente:
ServerName localhost

Nota: Por “ServerName” no se refiere al nombre del servidor, si se personaliza esta 

sentencia Apache causará error.

Paso 3: Como se va a usar PHP es necesario especificar que el servidor use al archivo 

index.php así que lo que se tiene que hacer es otra edición del archivo 

/etc/apache2/sites-available/default agregando la siguiente línea:
DirectoryIndex index.php index.html index.htm

 
Paso 4: Se procede a instalar MySQL (durante la instalación el sistema  va a pedir una 

contraseña la cual es muy importante ya que será la contraseña del login administrador 

del servidor de base de datos).
# apt-get install mysql-server

Paso 5: Una vez que se tiene instalado el servidor de base de datos es necesario instalar 

el lenguaje de programación (PHP versión 5) y el módulo para el servidor que se va a usar 

(php5-mysql).
# apt-get install php5 php5-mysql

Paso 6: Aunque Apache ya está instalado no ha reconocido todavía ninguno de los cambios 

que se han hecho en él, y es por eso que se tiene que reiniciar el servicio de la 

siguiente manera:
# /etc/init.d/apache2 restart

 
Paso 7: Ahora que se ha verificado la correcta instalación de Apache toca verificar la 

correcta instalación de PHP y eso lo hace mediante la creación de un archivo dentro de 

/var/www:
# nano /var/www/inicio.php

Y dentro se agrega la siguiente línea:
<? phpinfo(); ?>

Una vez hecho esto, se verifica la instalación ingresando lo siguiente en el navegador: 

http://127.0.0.1/inicio.php
 
Paso 8: Copie la carpeta que contiene al sistema web SCB y la coloca dentro de /var/www 

con nombre scb:
# cp /directorio/origen/* /var/www/scb


Paso 9: Instalar la base de datos 
mysql -u SuUsuarioMySQL -p < /Ruta/Del/Archivo/scb_db.sql

Nota: El sistema le va a pedir el password que definió en el paso 4.
Y listo, se inicia sesión con el usuario admin y contraseña patito en 

http://localhost/scb y podrá comenzar a utilizar el sistema.
