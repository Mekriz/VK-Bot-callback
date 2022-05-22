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
class plugin{
    
    public function __construct(){
    }
    public function onMessage($command, $user, $utils){
        require_once("Config.php");
        $cmd = $command->getName();
        $args = $command->getArgs();
        $id = $user->getID();
        //пример работы с конфигом
        $this->test = new Config("test.json", Config::JSON);
        if(!$this->test->exists($id)){
            $this->test->set($id, 0);
            $this->test->save();
        }
        //пример выполнения комманд
        if($cmd == "/привет"){
            $user->sendMessage("Здраствуй, ". $user->getFirstName());
            if($args[0] == "моряк"){
                $user->sendMessage("Отдать швортовый!");
            }
        }
        
    }
    
}