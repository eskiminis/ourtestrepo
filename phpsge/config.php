<?php //config.php
define("conf_ver", "053");
//not changable
define("SERVER_NAME", "zaibas");
define("SUB_DESC", "supergeimas");
define("MAIN_DESC", "nu tu supranti ane");
define("MAP_SYS", "1");    // 1 ogame/drogame, 2 travian/devana/tribals, 3 grepolis/ikariam
define("CITY_SYS", "1");  // 1 ogame, 2 travian/grepolis/ikariam
define("MAX_FIELDS", "10");  //only if city sys = 2

//registration page
define("REG_PAGE", "register.php");

//changable
define("LANG", "en");
define("TEMPLATE", "sge5-future");
define("CSS", TEMPLATE."/css/style.css");

//magazzine
// ATTENTION: if you use it you must add a magazine building whit mag_e func!!!
define("MAG_E", "0"); //mag engine ( 0 = off, 1 = on )
define("MG_max_cap", "800"); //max resource capacity at level 0, must be moltiplied x mag level: $r_max=$mag_lv*100+MG_max_cap;

//pop sys
// ATTENTION: if you use it you must add a pop building whit pop_e func!!!
define("POP_E", "0"); //pop engine ( 0 = off, 1 = on )

//images
define("IRACE", "./img/races/");
define("IBUD", "./img/bud/");
define("IUNT", "./img/unt/");
define("IRSC", "./img/research/");

//SQL Server Defination (not changable)
define("SQL_SERVER", "localhost");
define("SQL_USER", "phpsge");
define("SQL_PASS", "mFnQCYZFFeUV7eex");
define("SQL_DB", "phpsge");
define("TB_PREFIX", "gme_");
?>
