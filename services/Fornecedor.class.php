<?php
	/**
	* Classe de suplyer
	* @name Suplyer
	*/
	class Suplyer
	{
		private $Query;
		private $Sql;
		private $tableData;
		
		public $QueryReturn;
		/**
		* Método construtor
		* @name __construct
		* @access Public
		*/
		public function __construct()
		{
			$this->Query = new queryBuilder();		}
		
		/**
		 * Carrega os suplyers do banco de acordo com um username e password passado
		 * @name GetAutenticationSuplyer
		 * @access Public
		 * @return Query
		 */
		public function GetAutenticationSuplyer($strUsername,$strPassword)
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
			
			$this->QueryReturn = $this->Query->Execute($this->Sql,"Autentication Suplyer");
			
			return $this->QueryReturn;
		}
	}
?>