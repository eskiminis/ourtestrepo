<?php //config.php
define("conf_ver", "045");
//not changable
define("SERVER_NAME", "%SERVERNAME%");
define("SUB_DESC", "%SDESC%");
define("MAIN_DESC", "%SMANDESC%");
define("MAP_SYS", "%MAP%");    // 1 ogame/drogame, 2 travian/devana/tribals, 3 grepolis/ikariam
define("CITY_SYS", "%CTS%");  // 1 ogame, 2 travian/grepolis/ikariam
define("MAX_FIELDS", "10");  //only if city sys = 2

//registration page
define("REG_PAGE", "register.php");

//changable
define("LANG", "%LANG%");
define("TEMPLATE", "%TEMP%");
define("CSS", TEMPLATE."/css/%CSS%");

//magazzine
// ATTENTION: if you use it you must add a magazine building whit mag_e func!!!
define("MAG_E", "%MGS%"); //mag engine ( 0 = off, 1 = on )
define("MG_max_cap", "800"); //max resource capacity at level 0, must be moltiplied x mag level: $r_max=$mag_lv*100+MG_max_cap;

//images
define("IRACE", "./img/races/");
define("IBUD", "./img/bud/");
define("IUNT", "./img/unt/");
define("IRSC", "./img/research/");

//SQL Server Defination (not changable)
define("SQL_SERVER", "%SSERVER%");
define("SQL_USER", "%SUSER%");
define("SQL_PASS", "%SPASS%");
define("SQL_DB", "%SDB%");
define("TB_PREFIX", "%PREFIX%");
?>
