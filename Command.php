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
class cmd{
    
    public function __construct($msg, $attachments){
        $this->attachments = $attachments;
        $this->msg = $msg;
        $msg = explode(" ", $msg);
        $cmd = mb_strtolower($msg[0]);
        unset($msg[0]);
        $args = explode(" ", implode(" ", $msg));
        $this->args = $args;
        $this->cmd = $cmd;
    }
    public function getName(){
        return $this->cmd;
    }
    public function getArgs(){
        return $this->args;
    }
    public function getFull(){
        return $this->msg;
    }
    public function getAttachments(){
        return $this->attachments;
    }
}
