<?php
	session_start();
	// include das classes
	require_once('../includes.php');

	/**
	 * Classe de autenticaчуo de usuсrios
	 * @name Autentication
	 * @todo Faz a autenticaчуo dos usuсrios
	 * @version 1.0
	 * @author Infinitum Technologies
	 */
	class Autenticacao
	{
		/* PRIVATES VARIABLES */
		private $strLogin;
		private $strSenha;
		private $EntUsuario;
                private $EntUsername;
		private $Session;
                private $dados;
		private $tableData;
		private $rsLogin;
		private $rsData;
		/* PUBLIC VARIABLES */
		public $boolLogin;
		public $boolAcesso;
		
		public function __construct()
		{
			$this->EntUsuario = new UsuariosDAO();
			$this->EntUsername = new UsernamesDAO();
			$this->Session = new SessionAdmin();
		}
		
		/**
		 * Autenticaчуo do usuсrio
		 * @name doAutentication
		 * @access Public
		 * @param String Username
		 * @param String Password
		 * @return Bolean
		 */
		public function doAutentication($arrDados)
		{
			$this->dados = new autenticationVO();
			$this->dados->username = $arrDados["username"];
			$this->dados->password = $arrDados["password"];
			
			$this->boolLogin = false;
			$this->strLogin = isset($this->dados->username) ? addslashes(trim($this->dados->username)) : FALSE;
			$this->strSenha = isset($this->dados->password) ? addslashes(trim($this->dados->password)) : FALSE;
			
			if($this->strLogin != false && $this->strSenha != false)
			{
                            $statement = " SELECT
                                                    u.int_idusuario as usuario,
                                                    u.tx_nomeusuario as nome,
                                                    l.int_idusername as id,
                                                    l.tx_username as username,
                                                    l.tx_senha as senha,
                                                    l.rx_roles as roles,
                                                    t.int_idtipo_usuario,
                                                    t.tx_tipo_usuario as tipo
                                            FROM
                                                    (
                                                            (
                                                                    tbusuarios u INNER JOIN tbusername l ON (u.int_idusuario = l.int_idusuario)
                                                            )
                                                            INNER JOIN tbtipousuario t ON (u.int_idtipo_usuario = t.int_idtipo_usuario)
                                                    )
                                            WHERE
                                                    l.tx_username = '{$this->strLogin}' AND
                                                    l.tx_senha = MD5('{$this->strLogin}{$this->strSenha}') ";

				$this->rsData = $this->EntUsername->_HQL($statement);
				
				if(count($this->rsData) != 1)
					$this->boolLogin = false;
				else
				{
					$this->tableData = $this->rsData;
					
					// user session
					$this->Session->SessionCreate("Aut",true);
					$this->Session->SessionCreate("usuario",$this->tableData[0]['usuario']);
					$this->Session->SessionCreate("id",$this->tableData[0]["id"]);
					$this->Session->SessionCreate("nome",$this->tableData[0]["name"]);
					$this->Session->SessionCreate("tipoacesso",$this->tableData[0]["idtipo"]);
                                        $this->Session->SessionCreate("perfil",$this->tableData[0]["tipo"]);
                                        $this->Session->SessionCreate("roles",$this->tableData[0]["roles"]);

										
					$this->boolLogin = true;

                                        $this->dados->nome = $this->tableData[0]['nome'];
                                        $this->dados->id = $this->tableData[0]['id'];
                                        $this->dados->idtipo = $this->tableData[0]['idtipo'];
                                        $this->dados->tipo = $this->tableData[0]['tipo'];
                                        $this->dados->usuario = $this->tableData[0]['usuario'];
                                        $this->dados->boolAcesso = $this->tableData[0]['roles'];
                                        $this->dados->boolLogin = true;
				}
			}
			
			return $this->boolLogin;
		}
		
		/**
		 * Desconecta o usuсrio
		 * @name LogoutUser
		 * @access Public
		 * @return Bolean
		 */
		public function LogoutUser()
		{
			$this->Session->SessionDestroy();
                        $this->dados = new autenticationVO();

			return true;
		}
	}
	
?>