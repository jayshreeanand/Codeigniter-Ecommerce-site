<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class pmc{

    function send_email($recipient, $sender, $subject, $message)
    {
        require_once("phpmailer/class.phpmailer.php");
        try{
            $mail = new PHPMailer();
            $body = $message;
            
            $mail->IsSMTP();
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = 587;                    // set the SMTP server port
            $mail->Host       = "pod51022.outlook.com"; // SMTP server
            $mail->Username   = "email@globalgraynz.com";     // SMTP server username
            $mail->Password   = "karthik98";  
            $mail->SMTPSecure = 'tls';
            $mail->WordWrap   = 80; // set word wrap
            $mail->IsHTML(true); // send as HTML

            $mail->FromName = "Global Graynz";
            $mail->From = $sender;
            $mail->Subject = $subject;
            $mail->AltBody = strip_tags($message);
            $mail->MsgHTML($body);
            $mail->AddAddress($recipient);
            $mail->Send();
            return 1;
        } catch (phpmailerException $e) {
            var_dump($e->errorMessage()); exit;
            error_log($e->errorMessage());
            return 0;
        }
    }
}
?>