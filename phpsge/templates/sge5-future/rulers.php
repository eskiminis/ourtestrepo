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
                        <div class="art-layout-cell art-sidebar1">
                            <div class="art-vmenublock">
                                <div class="art-vmenublock-body">
                                            <div class="art-vmenublockheader">
                                                <div class="l"></div>
                                                <div class="r"></div>
                                                 <div class="t"><?=$lang['navigation'];?></div>
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
                                                            	<li>
                                                            		<a href="index.php"><span class="l"></span><span class="r"></span><span class="t"><?=$lang['index'];?></span></a>
                                                            	</li>
                                                            	<li>
                                                            		<a title="Rulers" href="rulers.php"><span class="l"></span><span class="r"></span><span class="t"><?=$lang['rulers'];?></span></a>
                                                            	</li>
                                                                <li>
                                                            		<a title="Register" href="<?php echo REG_PAGE; ?>"><span class="l"></span><span class="r"></span><span class="t"><?=$lang['register'];?></span></a>
                                                            	</li>
                                                                <li>
                                                            		<a title="credits" href="credits.php"><span class="l"></span><span class="r"></span><span class="t">Credits</span></a>
                                                            	</li>
                                                                
                                                            	</ul>
                                            <!-- /block-content -->
                                            
                                            		<div class="cleared"></div>
                                                </div>
                                            </div>
                            		<div class="cleared"></div>
                                </div>
                            </div>
                            <div class="art-block">
                                <div class="art-block-body">
                                  <div class="cleared"></div>
                              </div>
                            </div>
                            
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
                                                            <div>phpSGE Version: <?php echo sge_ver(); ?></div>
                                            <!-- /block-content -->
                                            
                                            		<div class="cleared"></div>
                                                </div>
                                  </div>
                            		<div class="cleared"></div>
                              </div>
                            </div>
                            
                            
                    </div>
                        
                        <div class="art-layout-cell art-content">
                            <div class="art-post">
                                <div class="art-post-body">
                            <div class="art-post-inner art-article">
                                            <h2 class="art-postheader">
                                              <?php //include "ubar.php"; ?></h2>
                                            <div class="art-postcontent">
                                                <!-- article-content -->
                                               <?=$body;?>
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
                        <? include "footer.php" ?>
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
