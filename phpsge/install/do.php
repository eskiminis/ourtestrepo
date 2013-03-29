<?php
mysql_connect($_POST['sserver'], $_POST['suser'], $_POST['spass']) or die('<a href="install.php"><br />Unable to install phpsge go back<br />and correct the errors in the database connection<br />CLIK ON THIS TEXT TO GO BACk</a>');
	require "proc.php";
	if($_POST['ccdb']=="on"){
		mysql_connect($_POST['sserver'], $_POST['suser'], $_POST['spass']);
		mysql_query("CREATE DATABASE ".$_POST['sdb']." DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;");
	}
	
mysql_select_db($_POST['sdb']) or die('<a href="install.php"><br />Unable to install phpsge go back<br />and correct the errors in the database connection<br />database name in wrog or not exist!CLICK ON THIS TEXT TO GO BACK</a>'); 
	
		constForm();
		require "../config.php";

		createDB();
	
		switch($_POST['map']){		
			case 1:
				createTBmap1();
				$myFile = "../map.php";
				$fh = fopen($myFile, 'w') or die("can't open file. set chmod to 777! or do <a href='http://sourceforge.net/apps/mediawiki/phpstrategygame/index.php?title=Manual_installation'>manual installation</a>");
				$text = file_get_contents("script/map.php");	
				fwrite($fh, $text);
				fclose($fh);
			break;
			
			case 2:
				createTBmap2();
				$myFile = "../map2.php";
				$fh = fopen($myFile, 'w') or die("can't open file. set chmod to 777! or do <a href='http://sourceforge.net/apps/mediawiki/phpstrategygame/index.php?title=Manual_installation'>manual installation</a>");
				$text = file_get_contents("script/map2.php");	
				fwrite($fh, $text);
				fclose($fh);
			break;
			
			case 3:
				createTBmap3();
			break;
		}
		
		if($_POST['cts']=="2"){
			$str = file_get_contents("./sql/city_sys2.sql");
			$str = preg_replace("'%PREFIX%'",$_POST['prefix'],$str);

			$result = mysql_exec_batch($str);
		}
		
		if($_POST['pope']=="1"){
			mysql_query("ALTER TABLE `".TB_PREFIX."t_builds` ADD `pop_req` SMALLINT( 3 ) NOT NULL DEFAULT '0' COMMENT 'pop requested' AFTER `desc` ,ADD `pop_mpl` DOUBLE NOT NULL DEFAULT '0' COMMENT 'pop moltiplier per level' AFTER `pop_req` ;");
			mysql_query("ALTER TABLE `".TB_PREFIX."t_unt` ADD `pop_req` SMALLINT( 3 ) NOT NULL DEFAULT '1' COMMENT 'pop requested' AFTER `vel`;");	
			mysql_query("ALTER TABLE `".TB_PREFIX."city` ADD `pop` SMALLINT( 3 ) NOT NULL DEFAULT '100' AFTER `name` ;");
		}
		
		mysql_close();
		
		//add your game to phpSGE official list - 	DO NOT REMOVE OR YOUR PHPSGE WILL BE LOCKED!
		include("../adm/Snoopy.class.php");
		$snoopy = new Snoopy;
	
		$submit_url = "http://rpvg.altervista.org/phpsge/do.php";
	
		//site name
		$submit_vars["q"] = $_POST['gname'];
		//path
		$submit_vars["a"] = $_SERVER["HTTP_HOST"].$_SERVER["PHP_SELF"];
		
		$snoopy->submit($submit_url,$submit_vars);
		
		
		header("Location: adm_register.php");
?>
