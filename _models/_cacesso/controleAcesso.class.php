<?php
	
	/**
	 * Classe de controle de acesso da aplicação
	 * @name  controleAcesso
	 * @package  sessionAdmin
	 * @access Public
	 * @author Paulo Teixeira
	 */
	class controleAcesso 
	{	
		private $arControles;
		private $arValues;
		private $session;
		
		public function __construct()
		{
			$this->sessao = new SessionAdmin();
		}
		
		/**
		 * Método de criação de controles de acesso
		 * @name controleCreate
		 * @param StringList $lstControles
		 * @param List $lstValuesControles
		 * @return Session
		 */
		public function ControleCreate($lstControles, $lstValuesControles)
		{
			// declarando os arrays para criar os controles de acesso
			$arControles = Array();
			$arValues	 = Array();
			
			// gravando os controles nos arrays
			$arControles = explode(",",$lstControles);
			$arValues = explode(",",$lstValuesControles);
			
			// gravando os controles de acesso e seus valores
			if(count($arControles) == count($arValues))
			{
				for($i = 0; $i == count($arControles); $i++)
				{
					if($this->sessao->SessionCreate($arControles[$i],$arValues[$i]))
					{
						// apagando os arrays
						unset($arControles);
						unset($arValues);
						return true;
					}
					else
					{
						// apagando os arrays
						unset($arControles);
						unset($arValues);
						return false;
					}
				}
			}
		}
		
		/**
		 * Método Edita status do controle de acesso
		 * @name  controleUpdate
		 * @param String $strNomeControle
		 * @return Bolean
		 */
		public function ControleUpdate($strNomeControle)
		{
			return $this->sessao->SessionUpdate($strNomeControle);
		}
		
		/**
		 * Método de deleção de controles de acesso
		 * @name controleDelete
		 * @param String $strNomeControle
		 * @return Bolean
		 */
		public function ControleDelete($strNomeControle)
		{
			return $this->sessao->SessionDelete($strNomeControle);
		}
		
		/**
		 * Método recupera o status da sessão
		 * @name getControle
		 * @param String $strNomeControle
		 * @return Int
		 */
		public function GetControle($strNomeControle)
		{
			return $this->sessao->GetSession($strNomeControle);
		}
	
		/**
		 * Método valida a autenticação do usuário
		 * @name validaPercistence
		 * @param String $strNomeSession
		 * @param String $strRedirectLocation
		 * @return Int
		 */
		public function ValidaPercistence($strNomeSession="Aut",$strRedirectLocation="?carregar=login")
		{
			if(!$this->sessao->GetSession($strNomeSession))
			{
				echo "<script>\n";
				echo "	location.href = '{$strRedirectLocation}';\n";
				echo "</script>\n";
			}
		}
	}
?>