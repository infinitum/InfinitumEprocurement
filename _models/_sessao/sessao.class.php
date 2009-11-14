<?php
	/**
	 * Classe de percistencia para gerenciamento de sessão
	 * @name sessionAdmin
	 * @access  Public
	 * @author Paulo Teixeira 
	 */
	
	class SessionAdmin
	{
		/**
		 * Método para criação de variáveis de sessão
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
		 * Método de deleção de variáveis de sessão
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
		 * Método para dar update nos valores das variáveis de sessão
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
		 * Método recupera o valor da sessão que o usuário chamar
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
		 * Método para listar todas as variáveis de sessão definidas na aplicação
		 * @name  sessionList
		 * @access  Public
		 * @return Array
		 */
		public function SessionList()
		{
			print_r($_SESSION);
		}
		
		/**
		 * Método destroi a sessão atual
		 * @name sessionDestroy
		 * @return Bolean
		 */
		public function SessionDestroy()
		{
			return session_destroy();
		}
	}
?>
