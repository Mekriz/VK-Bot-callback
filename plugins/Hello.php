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

class Hello{
    
    public function __construct(){
    }
    public function onMessage($command, $user, $utils){
        require_once("utils/Config.php");
        require_once("src/Keyboard.php");
        $cmd = $command->getName();
        $args = $command->getArgs();
        $fname = $user->getFirstName();
        $id = $user->getID();
        //пример работы с конфигом
        $this->test = new Config("test.json", Config::JSON);
        if(!$this->test->exists($id)){
            $this->test->set($id, 0);
            $this->test->save();
        }
        //пример выполнения комманд
        if($cmd == "/клава"){
            $kb = new keyboard(true);
            $kb->addTextButton("🍏 яблоко", "positive");
            $kb->addTextButton("🍎 яблоко", "negative");
            $kb->addLine();
            $kb->addTextButton("Выбирай");
            $user->sendKeyboard("Клавиатура", $kb->getAll());
        }
        if($cmd == "/привет"){
            if(isset($command->getAttachments()[0])){
                //в случае присутствия изображения - пересылает его
                $user->sendMessage("Здраствуй, ". $user->getFirstName(), $command->getAttachments()[0]);
            }else{
                $user->sendMessage("Здраствуй, ". $user->getFirstName());
            }
            
            if($args[0] == "моряк"){
                $user->sendMessage("Отдать швортовый!");
            }
        }
    }
    
}
