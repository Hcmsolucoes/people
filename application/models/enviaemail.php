<?php

require '../../vendor/autoload.php';


/**
* Mail
*/
class EnviaEmail
{
	
	private $transport;

	private $mailer;

	private $subject;

	private $from;

	private $to;

	private $body;

	private $message;

	function __construct()
	{
    	$this->transport = Swift_SmtpTransport::newInstance('ssl://smtp.gmail.com', 465)
        	->setUsername('kadukrause@gmail.com')
        	->setPassword('tnythkldzjmykmyl');
		
		$this->$mailer = Swift_Mailer::newInstance($this->$transport);
	}


	/*
		SET
	*/

	public function setTransport($transport){
		$this->$transport = $transport;
	}

	public function setMailer($mailer){
		$this->$mailer = $mailer;
	}

	public function setSubject($subject){
		$this->$subject = $subject;
	}

	public function setFrom($from){
		$this->$from = $from;
	}

	public function setTo($to){
		$this->$to = $to;
	}

	public function setBody($body){
		$this->$body = $body;
	}

	public function setMessage($message){
		$this->$message = $message;
	}

	/*
		GET
	*/

	public function getTransport(){
		return $this->$transport;
	}

	public function getMailer(){
		return $this->$mailer;
	}

	public function getSubject(){
		return $this->$subject;
	}

	public function getFrom(){
		return $this->$from;
	}

	public function getTo(){
		return $this->$to;
	}

	public function getBody(){
		return $this->$body;
	}

	public function getMessage(){
		return $this->$message;
	}

	/*
		READ
	*/

	public function newMessage(){
		return Swift_Message::newInstance($this->getSubject())
        ->setFrom($this->getFrom())
        ->setTo($this->getTo())
        ->setBody($this->getBody());
	}

	public function sendEmail(){
      	return $this->$mailer->send($this->newMessage());
	}

}
