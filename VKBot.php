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

foreach(glob("plugins/*") as $file){
    require_once($file);
    $plugin = explode("/", explode(".", $file)[0])[1];
    if(class_exists($plugin)){
        $plugins[$plugin] = new $plugin;
    }
}

require_once("src/Command.php");
require_once("src/VKUser.php");
require_once("utils/Utils.php");

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
        $list = [];
        $i = 0;
            foreach($data->object->message->attachments as $attachment){
                $type = $attachment->type;
                $list[$i] = ($type . $attachment->$type->owner_id ."_". $attachment->$type->id ."_". $attachment->$type->access_key);
                $i++;
            }
        $utils = new utils($token, $peer_id);
        $user = new user($user_id, $peer_id, $utils);
        $cmd = new cmd($msg, $list);
        foreach($plugins as $pl) $pl->onMessage($cmd, $user, $utils);
        header("HTTP/1.1 200 OK");
        echo "ok";
    break;
}
?>