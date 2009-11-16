<?php
        // include das classes
	require_once('../includes.php');
	/**
	* Classe de usuários
	* @name Usuario
	*/
	class Usuario
	{
		private $Id;
		private $tableData;
                private $EntUsuarios;
                private $EntTiposUsuario;
		private $dados;
		/**
		* Método construtor
		* @name __construct
		* @access Public
		*/
		public function __construct()
		{
			$this->EntUsuarios = new UsuariosDAO();
                        $this->EntTiposUsuario = new TiposUsuariosDAO();
		}

                public function getTipodeUsuario($id,$idx)
                {
                    $dadosTipo = $this->EntTiposUsuario->FindOne($id);
                    $retorno = $dadosTipo[$idx]['tipo'];
                    
                    return $retorno;
                }

		/**
		 * Carrega uma lista de usuários
		 * @name getListUsers
		 * @access Public
		 * @return usuarioVO
		 */
		public function getListUsers()
		{
			$this->tableData = $this->EntUsuarios->FindAll();

                        unset($this->dados);
                        for($idx=0; $idx < count($this->tableData)-1; $idx++)
			{
				$i = $this->tableData[$idx]['idtipo'];
                                $this->dados[$idx] = new usuarioVO();
				$this->dados[$idx]->id = $this->tableData[$idx]['id'];
				$this->dados[$idx]->idtipo = $this->tableData[$idx]['idtipo'];
                                $this->dados[$idx]->nome = $this->tableData[$idx]['nome'];
				$this->dados[$idx]->datacadastro = $this->tableData[$idx]['datacadastro'];
				$this->dados[$idx]->email = $this->tableData[$idx]['email'];
				$this->dados[$idx]->sobrenome = $this->tableData[$idx]['sobrenome'];
				
                                $this->dados[$idx]->tipo = $this->getTipodeUsuario($i,$idx);
			}
			
			if(!isset($this->dados))
				$this->dados = new usuarioVO();


			return $this->dados;
		}

                /**
		 * Carrega um usuário
		 * @name getUser
                 * @param $Id
		 * @access Public
		 * @return usuarioVO
		 */
		public function getUser($id)
		{
			$this->tableData = $this->EntUsuarios->FindOne($id);

                        unset($this->dados);
                        
                        for($idx=0; $idx < count($this->tableData); $idx++)
			{
                            $this->dados[$idx] = new usuarioVO();
                            $this->dados[$idx]->id = $this->tableData[$idx]['id'];
                            $this->dados[$idx]->nome = $this->tableData[$idx]['nome'];
                            $this->dados[$idx]->datacadastro = $this->tableData[$idx]['datacadastro'];
                            $this->dados[$idx]->email = $this->tableData[$idx]['email'];
                            $this->dados[$idx]->sobrenome = $this->tableData[$idx]['sobrenome'];
                            $this->dados[$idx]->idtipo = $this->tableData[$idx]['idtipo'];
                            $dadosTipo = $this->EntTiposUsuario->FindOne($this->tableData[$idx]['idtipo']);
                            $this->dados[$idx]->tipo = $dadosTipo[0]['tipo'];
			}

			if(!isset($this->dados))
				$this->dados = new usuarioVO();


			return $this->dados;
		}

                /**
		 * Cadastra um usuário
		 * @name doUser
                 * @param usuarioVO
		 * @access Public
		 * @return usuarioVO
		 */
		public function doUse($data)
		{
                    $this->dados = new usuarioVO();
                    $this->dados->id = $data['id'];
                    $this->dados->nome = $data['nome'];
                    $this->dados->sobrenome = $data['sobrenome'];
                    $this->dados->email = $data['email'];
                    $this->dados->idtipo = $data['idtipo'];
                    $this->dados->datacadastro = $data['datacadastro'];

                    $this->tableData = $this->EntUsuarios->Save($this->dados);

                    unset($this->dados);
                    return $this->tableData;
		}
	
	}
?>