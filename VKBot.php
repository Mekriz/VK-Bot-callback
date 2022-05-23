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
    echo 'ok';
return;
}

require_once("Command.php");
require_once("Plugin.php");
require_once("VKUser.php");
require_once("Utils.php");

//ключ подтверждения
$confirmation_token = 'd3555c77';

//Ключ доступа сообщества
$token = '945e966f42317a8af406325916e5b4da1cddd084d43f604a864609cd8b5ac04b1671753793bca022a8ed0';

$data = json_decode(file_get_contents('php://input'));
switch ($data->type) {
    case 'confirmation':
        echo $confirmation_token;
    break;
    case 'message_new':
        $user_id = $data->object->message->from_id;
        $peer_id = $data->object->message->peer_id;
        $msg = $data->object->message->text;
        $list = [];
        $i = 0;
            foreach($data->object->message->attachments as $attachment){
                $type = $attachment->type;
                $list[$i] = ($type . $attachment->$type->owner_id ."_". $attachment->$type->id ."_". $attachment->$type->access_key);
                $i++;
            }
        $plugin = new plugin();
        $utils = new utils($token, $peer_id);
        $user = new user($user_id, $peer_id, $utils);
        $cmd = new cmd($msg, $list);
        $plugin->onMessage($cmd, $user, $utils);
        header("HTTP/1.1 200 OK");
        echo "ok";
    break;
}
?>