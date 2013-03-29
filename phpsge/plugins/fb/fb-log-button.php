<?php 
$fbqr=mysql_query("SELECT * FROM `".TB_PREFIX."plugins` WHERE `name` = 'fblog' AND `active` =1 LIMIT 1;");
if( mysql_num_rows($fbqr)>=1 ){ ?>
    <fb:login-button></fb:login-button>

    <div id="fb-root"></div>
    <script src="http://connect.facebook.net/en_US/all.js"></script>
    <script>
      FB.init({appId: '<?=FACEBOOK_APP_ID;?>', status: true,
               cookie: true, xfbml: true});
      FB.Event.subscribe('auth.login', function(response) {
        window.location.reload();
      });
    </script>
<?php } ?>