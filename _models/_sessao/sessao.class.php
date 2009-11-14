<?php
	/**
	 * Classe de percistencia para gerenciamento de sess�o
	 * @name sessionAdmin
	 * @access  Public
	 * @author Paulo Teixeira 
	 */
	
	class SessionAdmin
	{
		/**
		 * M�todo para cria��o de vari�veis de sess�o
		 * @name  sessionCreate
		 * @access  Public
		 * @param String $strNameSession
		 * @param String $strValueSession
		 * @return Bolean
		 */
		public function SessionCreate($strNameSession, $strValueSession)
		{
			if($this->GetSession($strNameSession))
				return false;
			else
			{
				$_SESSION[$strNameSession] = $strValueSession;
				return true;
			}
		}
		
		/**
		 * M�todo de dele��o de vari�veis de sess�o
		 * @name  sessionDelete
		 * @access  Public
		 * @param String $strNameSession
		 * @return Bolean;
		 */
		public function SessionDelete($strNameSession)
		{
			if($this->GetSession($strNameSession))
			{
				unset($_SESSION[$strNameSession]);
				return true;
			}
			else
				return false;
		}
		
		/**
		 * M�todo para dar update nos valores das vari�veis de sess�o
		 * @name  sessionUpdate
		 * @access  Public
		 * @param String $strNameSession
		 * @param String $strValueSession
		 * @return Bolean
		 */
		public function SessionUpdate($strNameSession, $strValueSession)
		{
			if($this->GetSession($strNameSession))
			{
				$_SESSION[$strNameSession] = $strValueSession;
				return true;
			}
			else
				return false;
		}
		
		/**
		 * M�todo recupera o valor da sess�o que o usu�rio chamar
		 * @name  getSession
		 * @access  Public
		 * @param String $strNameSession
		 * @return SessionValue
		 */
		public function GetSession($strNameSession)
		{
			if(isset($_SESSION[$strNameSession]))
				return $_SESSION[$strNameSession];
			else
				return false;
		}
		
		/**
		 * M�todo para listar todas as vari�veis de sess�o definidas na aplica��o
		 * @name  sessionList
		 * @access  Public
		 * @return Array
		 */
		public function SessionList()
		{
			print_r($_SESSION);
		}
		
		/**
		 * M�todo destroi a sess�o atual
		 * @name sessionDestroy
		 * @return Bolean
		 */
		public function SessionDestroy()
		{
			return session_destroy();
		}
	}
?>
