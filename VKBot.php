<?php
/* Author — Me Kriz
   Website — vk.com/m.kriz & github.com/Mekriz
   VKBot — VK API 1.131
   Created — 5:12 AM 22.05.2022

   ███╗░░░███╗███████╗  ██╗░░██╗██████╗░██╗███████╗
   ████╗░████║██╔════╝  ██║░██╔╝██╔══██╗██║╚════██║
   ██╔████╔██║█████╗░░  █████═╝░██████╔╝██║░░███╔═╝
   ██║╚██╔╝██║██╔══╝░░  ██╔═██╗░██╔══██╗██║██╔══╝░░
   ██║░╚═╝░██║███████╗  ██║░╚██╗██║░░██║██║███████╗
   ╚═╝░░░░░╚═╝╚══════╝  ╚═╝░░╚═╝╚═╝░░╚═╝╚═╝╚══════╝
*/

if (!isset($_REQUEST)) {
return;
}

require_once("Command.php");
require_once("Plugin.php");
require_once("VKUser.php");
require_once("Utils.php");

/*ini_set("log_errors", 1);
ini_set("error_log", "vk.log");
error_log( "Hello, errors!" );*/

//ключ подтверждения
$confirmation_token = '';

//Ключ доступа сообщества
$token = '';

$data = json_decode(file_get_contents('php://input'));
switch ($data->type) {
    case 'confirmation':
        echo $confirmation_token;
    break;
    case 'message_new':
        $user_id = $data->object->message->from_id;
        $peer_id = $data->object->message->peer_id;
        $msg = $data->object->message->text;
        $plugin = new plugin();
        $utils = new utils($token, $peer_id);
        $user = new user($user_id, $peer_id, $utils);
        $cmd = new cmd($msg);
        $plugin->onMessage($cmd, $user, $utils);
        header("HTTP/1.1 200 OK");
        echo "ok";
    break;
}
?>
