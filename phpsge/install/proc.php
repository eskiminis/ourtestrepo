<?php
	function constForm() {
		$myFile = "../config.php";
		$fh = fopen($myFile, 'w') or die("can't open file. set chmod to 777! or do <a href='http://sourceforge.net/apps/mediawiki/phpstrategygame/index.php?title=Manual_installation'>manual installation</a>");
		$text = file_get_contents("config.tpl");
		$text = preg_replace("'%SERVERNAME%'",$_POST['gname'],$text);
		$text = preg_replace("'%SDESC%'",$_POST['gdesc'],$text);
		$text = preg_replace("'%SMANDESC%'",$_POST['mandesc'],$text);
		$text = preg_replace("'%SSERVER%'",$_POST['sserver'],$text);
		$text = preg_replace("'%SUSER%'",$_POST['suser'],$text);
		$text = preg_replace("'%SPASS%'",$_POST['spass'],$text);
		$text = preg_replace("'%SDB%'",$_POST['sdb'],$text);
		$text = preg_replace("'%PREFIX%'",$_POST['prefix'],$text);
		$text = preg_replace("'%CSS%'", $_POST['css'], $text);
		$text = preg_replace("'%CTS%'", $_POST['cts'], $text);
		$text = preg_replace("'%MAP%'", $_POST['map'], $text);
		$text = preg_replace("'%TEMP%'", $_POST['templ'], $text);
		$text = preg_replace("'%LANG%'", $_POST['lang'], $text);
		$text = preg_replace("'%MGS%'", $_POST['mge'], $text);
		$text = preg_replace("'%PPS%'", $_POST['pope'], $text);
		fwrite($fh, $text);
		fclose($fh);
	}
	
	function mysql_exec_batch ($p_query, $p_transaction_safe = true) {
  if ($p_transaction_safe) {
      $p_query = 'START TRANSACTION;' . $p_query . '; COMMIT;';
    };
  $query_split = preg_split ("/[;]+/", $p_query);
  foreach ($query_split as $command_line) {
    $command_line = trim($command_line);
    if ($command_line != '') {
      $query_result = mysql_query($command_line);
      if ($query_result == 0) {
        break;
      };
    };
  };
  return $query_result;
	} 
	
	function createDB() {
		mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
		mysql_select_db(SQL_DB);
		$str = file_get_contents("./sql/phpsge-base072.sql");
		$str = preg_replace("'%PREFIX%'",$_POST['prefix'],$str);

		$result = mysql_exec_batch($str);
		
	}
	
	function createTBmap1() {
		
		$str = file_get_contents("./sql/map1.sql");
		$str = preg_replace("'%PREFIX%'",$_POST['prefix'],$str);

		$result = mysql_exec_batch($str);
		
	}
	
	function createTBmap2() {
		
		$str = file_get_contents("./sql/map2.sql");
		$str = preg_replace("'%PREFIX%'",$_POST['prefix'],$str);

		$result = mysql_exec_batch($str);
		
	}
	
	function createTBmap3() {
		
		$str = file_get_contents("./sql/map3.sql");
		$str = preg_replace("'%PREFIX%'",$_POST['prefix'],$str);

		$result = mysql_exec_batch($str);
		
	}
?>
