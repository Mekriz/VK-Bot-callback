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
   
    /* хз зачем публик я написал */
   
    public int $button = 0;
    public int $line = 0;
   
    public function __construct(bool $inline = false, bool $one_time = false): void{
        $this->kb["inline"] = $inline;
        $this->kb["one_time"] = $one_time;
    }
    public function addTextButton(string $label, string $color, string $payload = "", string $type = "text"): void{
        $this->kb["buttons"][$this->line][$this->button]["action"]["type"] = $type;
        $this->kb["buttons"][$this->line][$this->button]["action"]["label"] = $label;
        $this->kb["buttons"][$this->line][$this->button]["action"]["payload"] = $payload;
        $this->kb["buttons"][$this->line][$this->button]["color"] = $color;
        $this->button++;
    }
    public function addOpenLinkButton(string $link, string $label, string $payload = ""): void{
        $this->kb["buttons"][$this->line][$this->button]["action"]["type"] = "open_link";
        $this->kb["buttons"][$this->line][$this->button]["action"]["label"] = $label;
        $this->kb["buttons"][$this->line][$this->button]["action"]["payload"] = $payload;
        $this->kb["buttons"][$this->line][$this->button]["action"]["link"] = $link;
        $this->button++;
    }
    public function addLine(): void{
        $this->line++;
    }
    public function getAll(): array{
        return $this->kb;
    }
}
