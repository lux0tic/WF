<?php
// (A) HOST
define("SITE_NAME", "WF - Lager");
define("HOST_BASE", "http://localhost/"); // CHANGED BY INSTALLER
define("HOST_NAME", parse_url(HOST_BASE, PHP_URL_HOST));
define("HOST_BASE_PATH", parse_url(HOST_BASE, PHP_URL_PATH));
define("HOST_ASSETS", HOST_BASE . "assets/");

// (B) API ENDPOINT
define("HOST_API", "api/");
define("HOST_API_BASE", HOST_BASE . HOST_API);
define("API_HTTPS", false); // CHANGED BY INSTALLER
define("API_CORS", false); // CHANGED BY INSTALLER
// define("API_CORS", false); // no cors, accept host_name only
// define("API_CORS", true); // any domain + mobile apps
// define("API_CORS", "site-a.com"); // this domain only
// define("API_CORS", ["site-a.com", "site-b.com"]); // multiple domains

// (C) DATABASE
define("DB_HOST", "localhost"); // CHANGED BY INSTALLER
define("DB_NAME", "storageboxx"); // CHANGED BY INSTALLER
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root"); // CHANGED BY INSTALLER
define("DB_PASSWORD", ""); // CHANGED BY INSTALLER

// (D) AUTOMATIC SYSTEM PATH
define("PATH_LIB", __DIR__ . DIRECTORY_SEPARATOR);
define("PATH_BASE", dirname(PATH_LIB) . DIRECTORY_SEPARATOR);
define("PATH_ASSETS", PATH_BASE . "assets" . DIRECTORY_SEPARATOR);
define("PATH_PAGES", PATH_BASE . "pages" . DIRECTORY_SEPARATOR);

// (E) JSON WEB TOKEN
define("JWT_ALGO", "HS256");
define("JWT_EXPIRE", 0);
define("JWT_ISSUER", "localhost"); // CHANGED BY INSTALLER
define("JWT_SECRET", "d7T.KqhwRRWhRs6m0OYYxghLOn~Znso4zD2S~~~NbVr7ribz"); // CHANGED BY INSTALLER

// (F) ERROR HANDLING
/* (F1) RECOMMENDED FOR LIVE SERVER
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 0);
ini_set("log_errors", 1);
ini_set("error_log", "PATH/error.log");
define("ERR_SHOW", false); */

// (F2) RECOMMENDED FOR DEVELOPMENT SERVER
error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);
ini_set("log_errors", 0);
define("ERR_SHOW", true);

// (G) TIMEZONE
// https://www.php.net/manual/en/timezones.php
define("SYS_TZ", "UTC"); // CHANGED BY INSTALLER
define("SYS_TZ_OFFSET", "+00:00"); // CHANGED BY INSTALLER
date_default_timezone_set(SYS_TZ);

// (H) USER LEVELS - IF YOU WANT TO INCLUDE ROLES IN THE FUTURE
define("USR_LVL", [
  "A" => "Admin", "U" => "User", "S" => "Suspended"
]);

// (I) PUSH NOTIFICATION
define("PUSH_PUBLIC", "BNM4dm4xgPqFOGawRgxDcMsrG0wFYPUCc99xiPA17mOfcDKNANwb-10uRals6ELNRvvqZnaesWbhO2hVreGNKdw"); // CHANGED BY INSTALLER
define("PUSH_PRIVATE", "utfbqzIrAAQWYvwEQNgn--5E22gZwIpBKyLSjzIWp5M"); // CHANGED BY INSTALLER
