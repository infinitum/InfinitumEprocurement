<?php
	session_start();
	// include das classes de usuario e suplyer
	require_once('../include.php');
	require_once('Usuario.class.php');
	require_once('Fornecedor.class.php');

	/**
	 * Classe de autenticação de usuários
	 * @name Autentication
	 * @todo Faz a autenticação dos usuários
	 * @version 1.0
	 * @author Infinitum Technologies
	 */
	class Autenticacao
	{
		/* PRIVATES VARIABLES */
		private $strLogin;
		private $strSenha;
		private $Query;
		private $Usuario;
		private $Suplyer;
		private $Session;
		private $tableData;
		private $levelData;
		private $rsLogin;
		private $rsData;
		private $listLevel;
		private $arrLevel;
		/* PUBLIC VARIABLES */
		public $boolLogin;
		public $boolAcesso;
		
		public function __construct()
		{
			$this->Query = new queryBuilder();
			$this->Usuario = new Usuario();
			$this->Suplyer = new Suplyer();
			$this->Session = new SessionAdmin();
		}
		
		/**
		 * Autenticação do usuário
		 * @name AutenticateUsers
		 * @access Public
		 * @param String Username
		 * @param String Password
		 * @return Bolean
		 */
		public function AutenticateUsers($arrDados)
		{
			$dados = new autenticationVO();
			$dados->username = $arrDados["username"];
			$dados->password = $arrDados["password"];
			
			$this->boolLogin = false;
			$this->strLogin = isset($dados->username) ? addslashes(trim($dados->username)) : FALSE;
			$this->strSenha = isset($dados->password) ? addslashes(trim($dados->password)) : FALSE;
			
			if($this->strLogin != false && $this->strSenha != false)
			{
				$this->rsLogin = $this->Usuario->GetAutenticationUser($this->strLogin,$this->strSenha);
				
				if($this->Query->NumRows($this->rsLogin) != 1)
					$this->boolLogin = false;
				else
				{
					$this->tableData = $this->Query->Fetch($this->rsLogin);
					
					$this->rsData = $this->Usuario->GetUserLevel($this->tableData["user_id"]);
					
					$count = 0;
					$this->listLevel = "";
					while($this->levelData = $this->Query->Fetch($this->rsData))
					{
						if(!$count)
							$this->listLevel .= $this->levelData["ind_level"];
						else
							$this->listLevel .= "," . $this->levelData["ind_level"];
							
						$count++;
					} 
					
					$count = 0;
					
					$this->arrLevel = explode(",",$this->listLevel);
					
					// user session
					$this->Session->SessionCreate("Aut",true);
					$this->Session->SessionCreate("Id",$this->tableData["userdata_id"]);
					$this->Session->SessionCreate("IdLogin",$this->tableData["user_id"]);
					$this->Session->SessionCreate("NomeUsuario",$this->tableData["name"]);
					
					// level session
					$this->Session->SessionCreate("viewProcurement",$this->arrLevel[$count]);
					$this->Session->SessionCreate("createProcurement",$this->arrLevel[$count++]);
					$this->Session->SessionCreate("viewAllProcurement",$this->arrLevel[$count++]);
					$this->Session->SessionCreate("updateProcurement",$this->arrLevel[$count++]);
					$this->Session->SessionCreate("updateAllProcurement",$this->arrLevel[$count++]);
					$this->Session->SessionCreate("createUser",$this->arrLevel[$count++]);
					$this->Session->SessionCreate("viewUserData",$this->arrLevel[$count++]);
					$this->Session->SessionCreate("updateUserData",$this->arrLevel[$count++]);
					$this->Session->SessionCreate("delUserData",$this->arrLevel[$count++]);
					$this->Session->SessionCreate("viewSuplyer",$this->arrLevel[$count++]);
					$this->Session->SessionCreate("updateSuplyer",$this->arrLevel[$count++]);
					
					$this->boolLogin = true;
				}
			}
			
			return $this->boolLogin;
		}
		
		
		
		/**
		 * Validação de acesso
		 * @name ValidaAcessoRestrito
		 * @access Public
		 * @param Int UserId
		 * @return Bolean
		 */
		public function ValidaAcessoRestrito($argUserId)
		{
			$this->boolAcesso = false;
			if($this->Session->GetSession("IdTipoUsuario") <= 1)
				echo("<script>location.href = '?carregar=principal&MID=verr'</script>");
			else
				$this->boolAcesso = true;
			
			return $this->boolAcesso;
		}
		
		/**
		 * Desconecta o usuário
		 * @name LogoutUser
		 * @access Public
		 * @return Bolean
		 */
		public function LogoutUser()
		{
			$this->boolAcesso = $this->Session->SessionDestroy();
			return $this->boolAcesso; 
		}
	}
	
?>