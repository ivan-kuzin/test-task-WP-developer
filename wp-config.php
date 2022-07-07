<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'eugsolwx_newsite' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'eugsolwx_newsite' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '*qt2oY&z' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'h ex7q*c0W#[ijBf46DV}^S>:#es.}F`3tBL}E|>n!(ESkzr9D%5!U/xZsZZP^F5' );
define( 'SECURE_AUTH_KEY',  '8PT8SY-&|X7Rg{-Suo#0h]WSaBN|so~TQlr8TqB!YHfvC$8Uhr~UHOj$5Jnl</cb' );
define( 'LOGGED_IN_KEY',    'Y(V;Io.DqZX @veO)=XBg++jSc?Z8E`ZngrcL%QADK|Jxh[Q0lJec!d:%H7:zoQ:' );
define( 'NONCE_KEY',        'knK oSXF?[&>W#hz:TuLz`;hu=o*FltCm:{`3Sd.Z$t.6pbHYd1O9Oc3r5_ogw+T' );
define( 'AUTH_SALT',        '85}pt{3M&VoB65IwO&{o@ $+uhc4OS^3=qc?jSt=^!#7I6xdxsT_KGL@v=[Fh8*s' );
define( 'SECURE_AUTH_SALT', '+12Dv!TQ7yBd+{BN0|~W(dtCP~$p u,VvAIHZJ6;-B^ oPA7G`aNO1d`>=(1;|2S' );
define( 'LOGGED_IN_SALT',   ' {a_bKRx?jaJww.tX[]c|f@DFOZ{uHY%B@Z76H9XNVS 2TpVXlTpBYqj+bynHq4H' );
define( 'NONCE_SALT',       'sGV1 G OV?;(iYVRM<yg)*SdAii%O *2eD}O+YXkQ.hb6IjBc;D5Izo`:63Sa$-+' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'nwste_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
