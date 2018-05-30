<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'twituni_local');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', '');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '4nmv@Ae2eiZG#.2-%>5_9u H>;o%c^8]L3q`P>_-ew3lz-E9<>.V8dNV76v6K{Rq');
define('SECURE_AUTH_KEY', ')]lT`pXK2A9qKYJO+<N `7J0%&u|Q^~Lt}nQ4NzZKCzgUWU ?DZg.^Qa,syfCAQ:');
define('LOGGED_IN_KEY', '*q@{HKZ+#>%{BiT}TW$@nOn(ovpyyb,F3~~ye+a{^{;>8@}(tAaq@=P3a=RA;6+Q');
define('NONCE_KEY', 'r$;N;lyPeW)jvowasX(U_k5F*w~#pF{?XtA@gzc:FK=*;e,v))M( H61T0K/na)w');
define('AUTH_SALT', 'x<.IVryg`v|CUmbe7R48qUBP*8|f :+Y 08|W*>p0yuGL<y>w4*RWvxX!u)+$+ET');
define('SECURE_AUTH_SALT', ',dq4o[;ak9DY(fgcZGjdM}I-.gw9:JrI{qIU1Lc/0(t:jYGjAFgB=yGh*$_09ope');
define('LOGGED_IN_SALT', 'RU(lM23NZd~@P.CLTq,IK45jf@fanaHOuZ1aiO3d!>b~w/7<x2i/e78mNq#mr*A{');
define('NONCE_SALT', '18TnpHB{*Mi#<5x|=eErvh*F.H+*UyfI*DQn,r:&Z`8[FHlS0,/FlXiuGTelWi</');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

