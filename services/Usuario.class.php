<?php
	/**
	* Classe de usu�rios
	* @name Usuario
	*/
	class Usuario
	{
		private $Query;
		private $Sql;
		private $tableData;
		
		public $QueryReturn;
		/**
		* M�todo construtor
		* @name __construct
		* @access Public
		*/
		public function __construct()
		{
			$this->Query = new queryBuilder();
		}
		
		/**
		 * Carrega os usu�rios do banco de acordo com um username e password passado
		 * @name GetAutenticationUsers
		 * @access Public
		 * @return Query
		 */
		public function GetAutenticationUser($strUsername,$strPassword)
		{
			$this->Sql = "";
			$this->Sql .= "SELECT \n";
			$this->Sql .= "	userdata_id \n";
			$this->Sql .= "	,user_id \n";
			$this->Sql .= "	,name \n";
			$this->Sql .= "	,lastname \n";
			$this->Sql .= "	,username \n";
			$this->Sql .= "	,pass_word \n";
			$this->Sql .= "FROM \n";
			$this->Sql .= "	vw_epro_employer_autentication \n";
			$this->Sql .= "WHERE \n";
			$this->Sql .= "	username = '" . $strUsername . "' AND \n";
			$this->Sql .= "	pass_word = MD5('" . $strPassword . "') AND \n"; 
			$this->Sql .= "	roles = '1'; \n";
			
			$this->QueryReturn = $this->Query->Execute($this->Sql,"Autentication User");
			
			return $this->QueryReturn;
		}
		
	/**
		 * Recuperar nivel de permiss�o do usu�rio
		 * @name GetUserLevel
		 * @access Public
		 * @param Int User Id
		 * @return Query
		 */
		public function GetUserLevel($intUserId)
		{
			$this->Sql = "";
			$this->Sql .= "SELECT \n"; 
			$this->Sql .= "	,lv.ind_level \n";
			$this->Sql .= "FROM \n";
			$this->Sql .= "	( \n";
			$this->Sql .= "		( \n";
			$this->Sql .= "			epro_access_level_has_epro_autentication lHa INNER JOIN epro_access_level lv ON lHa.id_evel = lv.level_id \n";
			$this->Sql .= "		) \n";
			$this->Sql .= "		INNER JOIN epro_autentication u ON lHa.id_user = u.user_id \n";
			$this->Sql .= "	) \n";
			$this->Sql .= "WHERE \n";
			$this->Sql .= "	u.user_id = " . $intUserId . "; \n";
			
			$this->QueryReturn = $this->Query->Execute($this->Sql,"GetUserLevel");
			
			return $this->QueryReturn;
		}
	}
?>