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
class user{
    
    public function __construct($id, $peer_id, $utils){
        $this->utils = $utils;
        $this->id = $id;
        $this->peer_id = $peer_id;
    }
    public function sendMessage($msg, $attachments = []){
        return $this->utils->sendMessage($msg, $this->peer_id, $attachments);
    }
    public function getID(){
        return $this->id;
    }
    public function getPeerID(){
        return $this->peer_id;
    }
    public function getFirstName(){
        return $this->utils->getUserInfo($this->id)->response[0]->first_name;
    }
    public function getLastName(){
        return $this->utils->getUserInfo($this->id)->response[0]->last_name;
    }
}