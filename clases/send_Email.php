<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
class send_Email
{

    public function ConfirmEmail($email,$body){
        try {
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.titan.email';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 587;
            $phpmailer->Username = 'Dream@lottery.re';
            $phpmailer->Password = 'Asadi98_';

            //Recipients
            $phpmailer->setFrom('Dream@lottery.re', 'Lottery | Dream');
            $phpmailer->addAddress($email, 'Joe User');     //Add a recipient

            //Content
            $phpmailer->isHTML(true);                                  //Set email format to HTML
            $phpmailer->Subject = 'confirm lottory email';
            $phpmailer->Body    = $body;

            $phpmailer->send();
            return true;
        } catch (Exception $e) {
            echo  $e->getMessage();
            return  false;
        }
    }
    public function forgotPassword($subject,$email,$body){
        try {
            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.titan.email';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 587;
            $phpmailer->Username = 'Dream@lottery.re';
            $phpmailer->Password = 'Asadi98_';

            //Recipients
            $phpmailer->setFrom('Dream@lottery.re', 'Lottery | Dream');
            $phpmailer->addAddress($email, 'Joe User');     //Add a recipient

            //Content
            $phpmailer->isHTML(true);
            $phpmailer->Subject = $subject;
            $phpmailer->Body    = $body;

            $phpmailer->send();
            return true;
        } catch (Exception $e) {
            return  false;
        }
    }
}