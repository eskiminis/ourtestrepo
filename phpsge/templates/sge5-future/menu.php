<script type="text/javascript">
function showHide(id)
{
if (id.style.display != 'block')
id.style.display = 'block';
else
id.style.display = 'none';
}
</script>
<title><?=$lang['admin-panel-of']?> <?=SERVER_NAME;?>
</title>

<div class="art-layout-cell art-sidebar1">
                            <div class="art-vmenublock">
                                <div class="art-vmenublock-body">
                                            <div class="art-vmenublockheader">
                                                <div class="l"></div>
                                                <div class="r"></div>
                                                 <div class="t"><?=$lang['menu'];?></div>
                                            </div>
                                            <div class="art-vmenublockcontent">
                                                <div class="art-vmenublockcontent-tl"></div>
                                                <div class="art-vmenublockcontent-tr"></div>
                                                <div class="art-vmenublockcontent-bl"></div>
                                                <div class="art-vmenublockcontent-br"></div>
                                                <div class="art-vmenublockcontent-tc"></div>
                                                <div class="art-vmenublockcontent-bc"></div>
                                                <div class="art-vmenublockcontent-cl"></div>
                                                <div class="art-vmenublockcontent-cr"></div>
                                                <div class="art-vmenublockcontent-cc"></div>
                                                <div class="art-vmenublockcontent-body">
                                            <!-- block-content -->
                                                            <ul class="art-vmenu">
                                                            
                                                            	<li class="active">
                                                            		<a href="#" onClick="javascript:showHide(DES);"><span class="l"></span><span class="r"></span><span class="t"><?php echo $lang['usrcp'].$lang['sh']; ?></span></a></li>
                                                            		<ul class="active">
                                                                    <div id="DES" style='display:none'>
                                                            			<li><a  href="settings.php"><?=$lang['settings'];?></a> </li>
     																 <li><a href="profile.php?usr=<?=$sge->id;?>"><?=$lang['profile'];?></a></li> 
      																<li><a href="chat.php"><?=$lang['chat'];?></a> </li>
                                                                    <li><a href="highscore.php"><?=$lang['HighScores'];?></a></li>
                                                                    <li><a href="http://rpvg.altervista.org/viewforum.php?f=8"><?=$lang['forum'];?></a></li>
<?php if (!$cookie) { ?><li><a href="index.php?act=logout"><?=$lang['logout'];?></a> </li><?php } ?>																					</div>
    															
                                                            		</ul>
                                                               
                                                       	    </li>
                                                                
                                                                <li class="active">
                                                            		<a href="main.php"><span class="l"></span><span class="r"></span><span class="t"><?=$lang['index'];?></span></a></li>
                                                            	  <ul class="active">
                                                            		<li><a href="buildings.php"><?=$lang['buildings'];?></a> </li>
                                                                    <li><a href="barraks.php"><?=$lang['barraks'];?></a> </li>
                                                                      <li><a href="research.php"><?=$lang['researches'];?></a> </li>
                                                                      <li><a href='<?=$maps;?>'><?=$lang['map'];?></a>  </li>
                                                                      <li><a href="market.php"><?=$lang['market'];?></a> </li>
                                                                    <li><a href="ally.php"><?=$lang['ally'];?></a> </li>
                                                                    <?php echo $asdm; ?>
                                                                    </ul>
                                                            	</li>
                                                                
                                                            	</ul>
                                            <!-- /block-content -->
                                            
                                            		<div class="cleared"></div>
                                                </div>
                                            </div>
                            		<div class="cleared"></div>
                                </div>
                            </div>
                            <div class="art-block"></div>
                            <div class="art-block">
                                <div class="art-block-body">
                                  <div class="art-blockcontent">
                                    <div class="art-blockcontent-tl"></div>
                                                <div class="art-blockcontent-tr"></div>
                                                <div class="art-blockcontent-bl"></div>
                                                <div class="art-blockcontent-br"></div>
                                                <div class="art-blockcontent-tc"></div>
                                                <div class="art-blockcontent-bc"></div>
                                                <div class="art-blockcontent-cl"></div>
                                                <div class="art-blockcontent-cr"></div>
                                                <div class="art-blockcontent-cc"></div>
                                                <div class="art-blockcontent-body">
                                            <!-- block-content -->
                                                            <div>phpSGE Version: <span class='Stile3'><b><?php echo sge_ver(); ?></b></span></div>
                                            <!-- /block-content -->
                                            
                                            		<div class="cleared"></div>
                                                </div>
                                  </div>
                            		<div class="cleared"></div>
                              </div>
                            </div>
                        </div>
