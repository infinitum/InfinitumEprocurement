<?php
	
	/**
	 * Classe de envio de e-mail
	 * @name  mail
	 * @return  String
	 * @author Paulo Teixeira
	 * @var $from
	 * @var $to
	 * @var $subject
	 * @var $message
	 * @var $cc 
	 * @var $bcc 
	 * @var $data
	 * @var $cc  
	 */
	class mail
	{
		private $from;
		private $to;
		private $subject;
		private $message;
		private $cc;
		private $bcc;
		private $data;
		private $header;
		private $jsScript;
		public $strResult;
		
		/**
		 * Método de envio de mensagens
		 * @name  sendMail
		 * @access public
		 * @return String
	 	 * @global String
		 */
		public function Mail($strTo, $strFrom, $strSubject = NULL, $strMessage = NULL, $strCc = NULL, $strBcc = NULL, $strUrlResult = NULL)
		{
			try 
			{
				$this->data = getdate();
				$header  = $this->From($strFrom);
				if($this->Cc($strCc) != NULL)
					$header .= ", " . $this->Cc($strCc);
					
				if($this->Bcc($strBcc) != NULL)
					$header .= ", " . $this->Bcc($strBcc);
					
				$header .= ", " . $this->data;
					
			    mail($this->To($strTo), $this->Subject($strSubject), $this->Message($strMessage), $header);
				
			    $strResult = "E-mail enviado com sucesso";
			} 
			catch (Exception $e) 
			{
				$strResult = "Exceção pega: " .  $e -> getMessage() . "\n";
			}

			if($strUrlResult != NULL)
				echo $this -> JsScript($strResult, $strUrlResult);
			else
				return $strResult;
		}
		
		/**
		 * Método que armazena o from da do e-mail
		 * @name  from
		 * @param string $strFrom
		 * @return String
		 */
		private function From($strFrom){
			return $this->from = $strFrom;
		}
		
		/**
		 * Método que armazena o to da do e-mail
		 * @name  to
		 * @param string $strTo
		 * @return String
		 */
		private function To($strTo){
			return $this->to = $strTo;
		}
		
		/**
		 * Método que armazena o subject da do e-mail
		 * @name  subject
		 * @param string $strSubject
		 * @return String
		 */
		private function Subject($strSubject){
			return $this->subject = $strSubject;
		}
		
		/**
		 * Método que armazena o message da do e-mail
		 * @name  message
		 * @param string $strMessage
		 * @return String
		 */
		private function Message($strMessage){
			return $this->subject = $strMessage;
		}
		
		/**
		 * Método que armazena o cc da do e-mail
		 * @name  cc
		 * @param file $strCc
		 * @return String
		 */
		private function Cc($strCc = NULL){
			return $this->cc = $strCc;
		}
		
		/**
		 * Método que armazena o bcc da do e-mail
		 * @name  bcc
		 * @param file $strBcc
		 * @return String
		 */
		private function Bcc($strBcc = NULL){
			return $this->bcc = $strBcc;
		}
		
		/**
		 * Método que faz o resultado após o envio do e-mail
		 * @name  attachment
		 * @param file $strBcc
		 * @return String
		 */
		private function JsScript($strMensagem = NULL, $strPage = NULL){
			$strScriptTemp = "<script>\n";
			
			if($strMensagem != NULL)
				$strScriptTemp .= "	alert({$strMensagem});\n";
				
			if($strPage != NULL)
				$strScriptTemp .= " location.href = '{$strPage}';\n";
				
			$strScriptTemp .= "</script>\n";
			
			return $this->jsScript = $strScriptTemp;
		}
	}
	
?>