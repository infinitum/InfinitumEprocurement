<?php
	/**
	* Classe de exibição de mensagens de alerta
	* @name Flash
	* @return HTMLObject
	* @author Infinitum
	**/
	class Flash
	{
		private $HtmlContent;
		private $MessageString;
		private $FlashMessageResult;
		private $FolderPath;
		
		private function FolderPath()
		{
			return $this->FolderPath = "_models/";
		}
		/**
		 * Show alert's messages to informe a error ocurrency (String Obrigatories Param)
		 * @name FlashMessageError
		 * @access Public
		 * @param String
		 * @return HTML Message
		 */
		public function FlashMessageError($StringMessage)
		{
    	   $this -> MessageString = $StringMessage;
    		    
    	   $this -> HtmlContent  = "<div class=\"FlashError\">\n";
           $this -> HtmlContent .= "    <table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n";
           $this -> HtmlContent .= "    	<tr>\n";
           $this -> HtmlContent .= "    		<td width=\"15\"><img alt=\"Error Image\" title=\"Alerta de Erro do Sistema\" name=\"errorIcon\" src=\"" . $this->FolderPath() . "/_flash/imgFiles/errorIcon.gif\" /></td>\n";
           $this -> HtmlContent .= "			<td align=\"left\" valig\"middle\">&nbsp;&nbsp;" . $this -> MessageString . "</td>\n";
           $this -> HtmlContent .= "    	</tr>\n";
           $this -> HtmlContent .= "    </table>\n";
    	   $this -> HtmlContent .= "</div>\n";
    			
    	   return $this -> FlashMessageResult = $this -> HtmlContent;
		}
	    /**
         * Show alert's messages to informe a warning ocurrency (String Obrigatories Param)
         * @name FlashMessageWarning
         * @access Public
         * @param String
         * @return HTML Message
         */
        public function FlashMessageWarning($StringMessage)
	    {
           $this -> MessageString = $StringMessage;
                
           $this -> HtmlContent  = "<div class=\"FlashWarning\">\n";
           $this -> HtmlContent .= "    <table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n";
           $this -> HtmlContent .= "    	<tr>\n";
           $this -> HtmlContent .= "    		<td width=\"15\"><img alt=\"Warning Image\" title=\"Alerta de Warning do Sistema\" name=\"warningIcon\" src=\"" . $this->FolderPath() . "/_flash/imgFiles/warningIcon.gif\" /></td>\n";
           $this -> HtmlContent .= "			<td align=\"left\" valig\"middle\">&nbsp;&nbsp;" . $this -> MessageString . "</td>\n";
           $this -> HtmlContent .= "    	</tr>\n";
           $this -> HtmlContent .= "    </table>\n";
           $this -> HtmlContent .= "</div>\n";
                
           return $this -> FlashMessageResult = $this -> HtmlContent;
        }
        /**
         * Show alert's messages to informe a notice ocurrency (String Obrigatories Param)
         * @name FlashMessageNotice
         * @access Public
         * @param String
         * @return HTML Message
         */
        public function FlashMessageNotice($StringMessage)
        {
           $this -> MessageString = $StringMessage;
                
           $this -> HtmlContent  = "<div class=\"FlashNotice\">\n";
           $this -> HtmlContent .= "    <table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n";
           $this -> HtmlContent .= "    	<tr>\n";
           $this -> HtmlContent .= "    		<td width=\"15\"><img alt=\"Notice Image\" title=\"Alerta de Notice do Sistema\" name=\"noticeIcon\" src=\"" . $this->FolderPath() . "/_flash/imgFiles/noticeIcon.gif\" /></td>\n";
           $this -> HtmlContent .= "			<td align=\"left\" valig\"middle\">&nbsp;&nbsp;" . $this -> MessageString . "</td>\n";
           $this -> HtmlContent .= "    	</tr>\n";
           $this -> HtmlContent .= "    </table>\n";
           $this -> HtmlContent .= "</div>\n";
                
           return $this -> FlashMessageResult = $this -> HtmlContent;
        }
        /**
         * Show alert's messages to informe a information ocurrency (String Obrigatories Param)
         * @name FlashMessageInfo
         * @access Public
         * @param String
         * @return HTML Message
         */
        public function FlashMessageInfo($StringMessage)
        {
           $this -> MessageString = $StringMessage;
                
           $this -> HtmlContent  = "<div class=\"FlashInfo\">\n";
           $this -> HtmlContent .= "    <table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">\n";
           $this -> HtmlContent .= "    	<tr>\n";
           $this -> HtmlContent .= "    		<td width=\"15\"><img alt=\"Info Image\" title=\"Alerta de Informação do Sistema\" name=\"infoIcon\" src=\"" . $this->FolderPath() . "/_flash/imgFiles/infoIcon.gif\" /></td>\n";
           $this -> HtmlContent .= "			<td align=\"left\" valig\"middle\">&nbsp;&nbsp;" . $this -> MessageString . "</td>\n";
           $this -> HtmlContent .= "    	</tr>\n";
           $this -> HtmlContent .= "    </table>\n";
           $this -> HtmlContent .= "</div>\n";
                
           return $this -> FlashMessageResult = $this -> HtmlContent;
        }
	}
?>