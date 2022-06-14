<?php
/* Author — Me Kriz
   Website — vk.com/m.kriz & github.com/Mekriz
   VKBot — VK API 1.131
   Created — 10:30 AM 24.05.2022

   ███╗░░░███╗███████╗  ██╗░░██╗██████╗░██╗███████╗
   ████╗░████║██╔════╝  ██║░██╔╝██╔══██╗██║╚════██║
   ██╔████╔██║█████╗░░  █████═╝░██████╔╝██║░░███╔═╝
   ██║╚██╔╝██║██╔══╝░░  ██╔═██╗░██╔══██╗██║██╔══╝░░
   ██║░╚═╝░██║███████╗  ██║░╚██╗██║░░██║██║███████╗
   ╚═╝░░░░░╚═╝╚══════╝  ╚═╝░░╚═╝╚═╝░░╚═╝╚═╝╚══════╝
*/
class keyboard{
    
    public function __construct($inline = false, $one_time = false){
        $this->kb["inline"] = $inline;
        $this->kb["one_time"] = $one_time;
        $this->button = 0;
        $this->line = 0;
    }
    public function addTextButton($label = "text", $color = "primary", $payload = ""){
        $this->kb["buttons"][$this->line][$this->button]["action"]["type"] = "text";
        $this->kb["buttons"][$this->line][$this->button]["action"]["label"] = $label;
        $this->kb["buttons"][$this->line][$this->button]["action"]["payload"] = $payload;
        $this->kb["buttons"][$this->line][$this->button]["color"] = $color;
        $this->button++;
    }
    public function addOpenLinkButton($link = "https://vk.com/m.kriz", $label = "link", $payload = ""){
        $this->kb["buttons"][$this->line][$this->button]["action"]["type"] = "open_link";
        $this->kb["buttons"][$this->line][$this->button]["action"]["label"] = $label;
        $this->kb["buttons"][$this->line][$this->button]["action"]["payload"] = $payload;
        $this->kb["buttons"][$this->line][$this->button]["action"]["link"] = $link;
        $this->button++;
    }
    public function addLine(){
        $this->line++;
    }
    public function getAll(){
        return $this->kb;
    }
}