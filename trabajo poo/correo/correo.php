<?php
function correo($email, $asunto, $mensaje){
	//error_reporting(E_ALL);
	//error_reporting(E_STRICT);
	
	//date_default_timezone_set('America/Toronto');
	
	require_once('./class.phpmailer.php');
	//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	
	$mail             = new PHPMailer();
	
	$body             = $mensaje;
	
	$mail->IsSMTP(); // telling the class to use SMTP
	//$mail->Host       = "ssl://smtp.gmail.com"; // SMTP server
	//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;            // sets the prefix to the servier
	$mail->Host       = "smtp.live.com";      // sets GMAIL as the SMTP server
	$mail->Username   = "murquijo@uniempresarial.edu.co";  // GMAIL username
	$mail->Password   = "Valcitauni005__";            // GMAIL password
	
	$mail->SetFrom('murquijo@uniempresarial.edu.co', 'Valcitauni005__');
	
	//$mail->AddReplyTo("correo@gmail.com","GGG GmaiL");
	
	$mail->Subject    = $asunto;
	
	//$mail->AltBody    = ; // optional, comment out and test
	
	$mail->MsgHTML($body);
	
	$address = explode(",",$email);
	foreach($address as $raddress){
	$mail->AddAddress($raddress, "");
	}
	
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

	if(!$mail->Send()) {
	  echo "Error de envio: " . $mail->ErrorInfo;
	} else {
	  return "1";
	}
}
?>

