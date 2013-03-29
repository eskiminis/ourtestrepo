
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php if($incmen!="off"){
	echo SERVER_NAME;}
	else{echo "phpSGE Installer";} ?></title>

    <link rel="stylesheet" href="style.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="../templates/sge5-future/style.css" type="text/css" media="screen" />
    <!--[if IE 6]><link rel="stylesheet" href="style.ie6.css" type="text/css" media="screen" /><![endif]-->
    <!--[if IE 7]><link rel="stylesheet" href="style.ie7.css" type="text/css" media="screen" /><![endif]-->

    <script type="text/javascript" src="templates/sge5-future/script.js"></script>
    <script src='http://js.nicedit.com/nicEdit-latest.js' type='text/javascript'></script>
	<script type='text/javascript'>bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
    <script type="text/javascript">
	function showHide(id)
	{
	if (id.style.display != 'block')
	id.style.display = 'block';
	else
	id.style.display = 'none';
	}
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
                        <h1 id="name-text" class="art-logo-name"><a href="#"><?php if($incmen!="off") echo "Admin panel Of ".SERVER_NAME; else echo "phpSGE Installer"; ?></a></h1>
                        <div id="slogan-text" class="art-logo-text"><span class="bar-r"><?php if($incmen!="off") echo"phpSGE Admin Control Panel"; ?></span></div>
                    </div>
                </div>
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <?php if($incmen!="off") include "menu.php"; ?>
                        
                        <div class="art-layout-cell art-content">
                            <div class="art-post">
                                <div class="art-post-body">
                            <div class="art-post-inner art-article">
                                            <h2 class="art-postheader">&nbsp;</h2>
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
                        <?include "../templates/sge5-future/footer.php"; ?>
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
