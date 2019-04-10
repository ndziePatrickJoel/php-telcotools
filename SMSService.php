<?php
include_once('SMPPClass.php');


class SMSService extends SMPPClass {

    private $smpphost;
    private $smppport = 18013;//15019;
    private $systemid;
    private $password;
	private $system_type;
	
	public function __construct($user, $pass, $type, $smpphost, $smppport ) 
	{
		$this->systemid = $user;
		$this->password = $pass;
        $this->system_type = $type;
        $this->smpphost = $smpphost;
        $this->smppport = $smppport;
        $this->system_type = $type;

		parent::__construct();
    }
	
	public function setHost($host) {
		$this->smpphost = $host;
	}
	
	public function setPort($port) {
		$this->smppport = $port;
	}
	
	/**
     * Undocumented function
     *
     * @param array $to the list of destination numbers
     * @param string $msg
     * @param string $from
     * @return void
     */
	public function sendOne($to, $msg, $from = null){
		
        set_error_handler(
            create_function(
                '$severity, $message, $file, $line',
                'throw new ErrorException($message, $severity, $severity, $file, $line);'
            )
        );
		

		if($from != null)
		{
			$this->SetSender($from);
		}

		else
		{
			$this->SetSender($this->config->getSmsSender());
		}

		
		/* bind to smpp server */
		$this->Start($this->smpphost, $this->smppport, $this->systemid, $this->password, $this->system_type);
		/* send enquire link PDU to smpp server */
		$this->TestLink();

		/* send message to multiple recipients at once */
		$this->SendMulti(implode("," , $to), $msg);
		/* unbind from smpp server */
		$this->End();

        restore_error_handler();
	}
	
}