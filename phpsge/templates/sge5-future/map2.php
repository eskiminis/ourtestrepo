<?php 
//if there isn't a requst for wiewing a city
if(!$_GET['wci']){
	if(!$_GET['x']){
		$x=0;
		$y=0;
	}
	else{
		$x=(int)$_GET['x'];
		$y=(int)$_GET['y'];
	}

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US" xml:lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo SERVER_NAME; ?></title>

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="templates/sge5-future/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

    <script type="text/javascript" src="templates/sge5-future/script.js"></script>
    <script type="text/javascript">
	<!--//
	function vlinf(vl,pl,al){
		var p_vl = document.getElementById("vl");
		var p_pl = document.getElementById("pl"); 
		var p_al = document.getElementById("al");
		p_vl.innerHTML = vl;
		p_pl.innerHTML = pl;
		p_al.innerHTML = al;
	}
	//-->
	</script>
</head>
<body>
<div id="art-page-background-simple-gradient">
        <div id="art-page-background-gradient"></div>
    </div>
    <div id="art-page-background-glare">
        <div id="art-page-background-glare-image"></div>
    </div>
    <div id="art-main">
        <div class="art-sheet">
            <div class="art-sheet-tl"></div>
            <div class="art-sheet-tr"></div>
            <div class="art-sheet-bl"></div>
            <div class="art-sheet-br"></div>
            <div class="art-sheet-tc"></div>
            <div class="art-sheet-bc"></div>
            <div class="art-sheet-cl"></div>
            <div class="art-sheet-cr"></div>
            <div class="art-sheet-cc"></div>
            <div class="art-sheet-body">
                <div class="art-header">
                    <div class="art-header-png"></div>
                    <div class="art-header-jpeg"></div>
                    <div class="art-logo">
                        <h1 id="name-text" class="art-logo-name"><a href="#"><?php echo SERVER_NAME; ?></a></h1>
                        <div id="slogan-text" class="art-logo-text"><span class="bar-r"><?php echo SUB_DESC; ?></span></div>
                    </div>
                </div>
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <?php include "menu.php"; ?>
                        
                        <div class="art-layout-cell art-content">
                            <div class="art-post">
                                <div class="art-post-body">
                            <div class="art-post-inner art-article">
                                            <h2 class="art-postheader">
                                              <?php include "ubar.php"; ?></h2>
                                            <div class="art-postcontent">
                                                <!-- article-content -->
                                               <p><form action="" method="get">X: <input name="x" type="text" value="<?=$x;?>" size="3" /> y: <input name="y" type="text" value="<?=$y;?>" size="3" /> 
	<input name="" value="OK" type="submit" /></form></p>
<p>
<table width="100%" border="0">
<table width="200" border="0">
  <tr>
    <td>&nbsp;</td>
    <td><div align="center"><a href="?x=<?=(int)$_GET['x'];?>&y=<?=((int)$_GET['y']-1);?>"><img src="./templates/sge5-future/map2/map_n.png" /></a></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="center"><a href="?x=<?=((int)$_GET['x']-1);?>&y=<?=(int)$_GET['y'];?>"><img src="./templates/sge5-future/map2/map_w.png" /></a></div></td>
    <td><table border="0" align="left" cellpadding="0" cellspacing="0">
  <?php Conect(); 
  $mplarge=7;
  $k=0; 
  while($k!=$mplarge){
	echo "<tr>";
  	$i=0;		  
  	while($i!=$mplarge){
		$mqf=mysql_query("SELECT * FROM `".TB_PREFIX."map` WHERE `x` =$x AND `y` =$y");
		if(mysql_num_rows($mqf)!=0){
			$mpd=mysql_fetch_array($mqf); 
			$cinfo=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."city` WHERE `id` =".$mpd['city']." LIMIT 1;") );
			$usrinfo=mysql_fetch_array( mysql_query("SELECT * FROM `".TB_PREFIX."users` WHERE `id` =".$cinfo['owner']." LIMIT 1;") );
			
			?><a title="<?=$x;?>,<?=$y;?> | <?=$cinfo['name'];?>" href="?wci=<?=$mpd['city'];?>" onMouseOut="vlinf('','','');" onMouseOver="vlinf('<?=$cinfo['name'];?>','<?=$usrinfo['username'];?>','<?=$usrinfo['ally_id'];?>');"><img src='templates/sge5-future/map2/<?=$mpd['type'];?>.png' width='53' height='38' border="0" /></a><?php 
		}
		else{
		?><a title="<?=$x;?>,<?=$y;?>" href="?x=<?=$x;?>&y=<?=$y;?>"><img border='0' src='templates/sge5-future/map2/gras1.png' width='53' height='38' /></a></td><?php 
		}
		$x++; $i++;}
	echo "</tr>";
	$y++; $x=$x-$mplarge; $k++;
  }
  ?>
</table>
    <td><div align="center"><a href="?x=<?=((int)$_GET['x']+1);?>&y=<?=(int)$_GET['y'];?>"><img src="./templates/sge5-future/map2/map_e.png" /></a></div></td>
  
  <tr>
    <td>&nbsp;</td>
    <td><div align="center"><a href="?x=<?=(int)$_GET['x'];?>&y=<?=((int)$_GET['y']+1);?>"><img src="./templates/sge5-future/map2/map_s.png" /></a></div></td>
    <td>&nbsp;</td>
  </tr>
</table></td>

</tr></table>
</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
<?php }else{ echo '<script>window.open("./templates/sge5-future/map2/about.php","mywindow","menubar=0,resizable=1,width=600,height=400");</script>'}
	  ?>
                                                <div class="cleared"></div>
                                                <div class="art-content-layout overview-table">
                                                	<div class="art-content-layout-row"><!-- end cell --><!-- end cell --><!-- end cell -->
                                                	</div><!-- end row -->
                                                </div><!-- end table -->
                                                    
                                                <!-- /article-content -->
                                            </div>
                                            <div class="cleared"></div>
                            </div>
                            
                            		<div class="cleared"></div>
                                </div>
                            </div>
                            <div class="art-post"></div>
                        </div>
                    </div>
                </div>
                <div class="cleared"></div><div class="art-footer">
                    <div class="art-footer-t"></div>
                    <div class="art-footer-l"></div>
                    <div class="art-footer-b"></div>
                    <div class="art-footer-r"></div>
                    <div class="art-footer-body">
                        <div class="art-footer-text">
                          <?include './templates/sge5-future/footer.php';?>
                          </div>
                		<div class="cleared"></div>
                    </div>
                </div>
        		<div class="cleared"></div>
            </div>
        </div>
        <div class="cleared"></div>
    </div>
    
</body>
</html>
