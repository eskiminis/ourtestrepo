<?php	

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
	
	function updateDB($old_ver) {
		mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
		mysql_select_db(SQL_DB);
		
		if((int)$old_ver<36){
			$str = file_get_contents("./adm/updater/026-035/".$old_ver.".sql");
		}
		else{
			$str = file_get_contents("./adm/updater/".$old_ver.".sql");
		}
		$str = preg_replace("'%PREFIX%'",TB_PREFIX,$str);

		$result = mysql_exec_batch($str);
		
	}
	
?>