<?php
    include 'vendor/autoload.php';
 
    $ssh = new \phpseclib3\Net\SSH2('192.168.11.183');
    if (!$ssh->login('vpn', 'vpn903')) {
        exit('Login Failed');
    }
 
    echo $ssh->exec('pwd');
    echo $ssh->exec('ls -la \');
?>