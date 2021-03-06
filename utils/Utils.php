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
class utils{
    
    public function __construct($token, $peer_id = 0){
        $this->token = $token;
        $this->peer_id = $peer_id;
    }
    public function curlRequest($params, $method = "messages.send"){
        $curl = curl_init("https://api.vk.com/method/{$method}?". http_build_query($params));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($curl);
		curl_close($curl);
		//file_put_contents("vk.log", $response, FILE_APPEND);
		return json_decode($response);
    }
    public function getUserInfo($id, $fields = "first_name,last_name"){
	if(isset($this->info["main"]) && $this->info["fields"] == $fields){
            return $this->info["main"];
	}
	$this->info["fields"] = $fields;
        $this->info["main"] = $this->curlRequest(array(
        'user_ids' => $id,
        'access_token' => $this->token,
        'v' => '5.103',
        'fields' => $fields
        ), "users.get");
	return $this->info["main"];
    }
    public function sendMessage($msg, $peer_id, $attachments = []){
        return $this->curlRequest(array(
        'message' => $msg,
        'peer_id' => $peer_id,
        'access_token' => $this->token,
        'v' => '5.103',
        'random_id' => '0',
        'attachment' => $attachments,
        'disable_mentions' => "1"
        ));
    }
    public function sendKeyboard($msg, $peer_id, $keyboard, $attachments = []){
        return $this->curlRequest(array(
        'message' => $msg,
        'peer_id' => $peer_id,
        'access_token' => $this->token,
        'v' => '5.103',
        'random_id' => '0',
        'attachment' => $attachments,
        'keyboard' => json_encode($keyboard),
        'disable_mentions' => "1"
        ));
    }
}
