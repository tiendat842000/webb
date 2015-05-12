<?php
// BASE CONFIGS (set these to match the values from your BBB server)
/* Public test server values from Blind Side Networks:
url: http://test-install.blindsidenetworks.com/bigbluebutton/
salt: 8cd8ef52e8e101574e400365b55e11a6
*/		

$salt = 'b040d8aa3e2e8fbdda0812c6b607e9eb';
$server = 'http://hni.openmeeting.vn/bigbluebutton/';
define('CONFIG_SECURITY_SALT', $salt);
define('CONFIG_SERVER_BASE_URL', $server);
?>