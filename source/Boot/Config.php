<?php
/**
 * PROJECT URLs
 */
define("CONF_URL_BASE", "https://www.siageoba.com/sosmulher");
define("CONF_URL_TEST", "https://www.localhost/sosmulher");

/**
 * SITE
 */
define("CONF_SITE_NAME", "SOS Mulher Juá");
define("CONF_SITE_TITLE", "A guerra nunca acaba");
define("CONF_SITE_DESC", "A guerra do mercado financeiro, notícias do Brasil e do mundo e sua guerra financeira");
define("CONF_SITE_LANG", "pt_BR");
define("CONF_SITE_DOMAIN", "sosmulher.com.br");
define("CONF_SITE_COMPANY", "Polícia Militar da Bahia");
define("CONF_SITE_ADDR_STREET", "CPRN - Comando de Policiamento Regional Norte");
define("CONF_SITE_ADDR_NUMBER", "");
define("CONF_SITE_ADDR_COMPLEMENT", "");
define("CONF_SITE_ADDR_CITY", "Juazeiro");
define("CONF_SITE_ADDR_STATE", "BA");
define("CONF_SITE_ADDR_ZIPCODE", "");

/**
 * SOCIAL
 */
define("CONF_SOCIAL_TWITTER_CREATOR", "@giluanS");//conta pessoal
define("CONF_SOCIAL_TWITTER_PUBLISHER", "@giluanS");//conta da empresa
define("CONF_SOCIAL_FACEBOOK_APP", "626590460695980");//gestao de comentarios
define("CONF_SOCIAL_FACEBOOK_PAGE", "giluansouza");
define("CONF_SOCIAL_FACEBOOK_AUTHOR", "giluansouza");
define("CONF_SOCIAL_GOOGLE_PAGE", "107305124528362639842");
define("CONF_SOCIAL_GOOGLE_AUTHOR", "103958419096641225872");
define("CONF_SOCIAL_INSTAGRAM_PAGE", "giluans");
define("CONF_SOCIAL_YOUTUBE_PAGE", "gs");

/**
 * DATES
 */
define("CONF_DATE_BR", "d/m/Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * PASSWORD
 */
define("CONF_PASSWD_MIN_LEN", 4);
define("CONF_PASSWD_MAX_LEN", 20);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION", ["cost" => 10]);

/**
 * MESSAGE
 */
define("CONF_MESSAGE_INFO", "alert-info");
define("CONF_MESSAGE_SUCCESS", "alert-success");
define("CONF_MESSAGE_WARNING", "alert-warning");
define("CONF_MESSAGE_ERROR", "alert-danger");
/**
 * VIEW
 */
define("CONF_VIEW_PATH", __DIR__ . "/../../shared/views");
define("CONF_VIEW_EXT", "php");
define("CONF_VIEW_WAR", "war");
define("CONF_VIEW_SUPER", "superadmin");

/**
 * UPLOAD
 */
define("CONF_UPLOAD_DIR", "storage");
define("CONF_UPLOAD_IMAGE_DIR", "images");
define("CONF_UPLOAD_FILE_DIR", "files");
define("CONF_UPLOAD_MEDIA_DIR", "medias");

/**
 * IMAGES
 */
define("CONF_IMAGE_CACHE", CONF_UPLOAD_DIR . "/" . CONF_UPLOAD_IMAGE_DIR . "/cache");
define("CONF_IMAGE_SIZE", 2000);
define("CONF_IMAGE_QUALITY", ["jpg" => 75, "png" => 5]);

/**
 * MAIL
 */
define("CONF_MAIL_SENDER", ["name" => "Giluan Souza", "address" => "giluanjsouza@gmail.com"]);
define("CONF_MAIL_SUPPORT", "giluanjsouza@gmail.com");
define("CONF_MAIL_CONTACT", "giluan65@hotmail.com");
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");

