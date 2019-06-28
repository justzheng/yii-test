<?php
//$socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
//$con = socket_connect($socket,'127.0.0.1',8889);
//if($con){
//    while($buff = socket_read($socket,1024)){
//        echo "收到消息 ".$buff.PHP_EOL;
//    }
//}
//socket_close($socket);

error_reporting(E_ALL);
set_time_limit(0);
echo "<h2>TCP/IP Connection</h2>\n";
$port = 1935;
$ip = "127.0.0.1";
/*
 +-------------------------------
 *    @socket连接整个过程
 +-------------------------------
 *    @socket_create
 *    @socket_connect
 *    @socket_write
 *    @socket_read
 *    @socket_close
 +--------------------------------
*/
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
// 第一个参数”AF_INET”用来指定域名;
// 第二个参数”SOCK_STREM”告诉函数将创建一个什么类型的Socket(在这个例子中是TCP类型),UDP是SOCK_DGRAM

if ($socket < 0) {
    echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
} else {
    echo "OK.\n";
}
//echo "try access '.$ip.' port '$port'...\n";
$result = socket_connect($socket, $ip, $port);
if ($result < 0) {
    echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
} else {
    echo "access OK\n";
}
$in = "Ho\r\n";
$in.= "first blood\r\n";
$out = '';
if (!socket_write($socket, $in, strlen($in))) {
    echo "socket_write() failed: reason: " . socket_strerror($socket) . "\n";
} else {
    echo "send to server text !\n";
    echo $in."\n";
}
while ($out = socket_read($socket, 8192)) {
    echo "recive access!\n";
    echo "recive text:", $out;
}
echo "close SOCKET...\n";
socket_close($socket);
echo "close OK\n";
?>