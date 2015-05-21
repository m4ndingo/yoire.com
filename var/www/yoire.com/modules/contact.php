<?php
class Contact{
	function defaultMethod(){
		$reply="";
		if(Common::getPost("message")){
			$res=Mailer::sendToWebmaster(Common::getPost("email"),Common::getPost("subject"),Common::getPost("message"));
			if($res){
				$reply=Common::Info("Mensaje enviado, gracias por contactar. Responderemos cuando podamos! ".Smiley::build(":-D"));
			}else{
				$reply=Common::Error("Vaya... Se produjo un error al enviar el mensaje ".Smiley::build(":-p"));
			}
		}
		return Template::load(__CLASS__,"default.php",array("reply"=>$reply));
	}
	function title(){return "Contact";}
}
?>