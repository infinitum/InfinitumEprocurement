<?php
	/**
	 * Classe de conexão com o banco de dados mysql
	 * @name  connectionDb
	 * @return Object
	 * @access  Protected
	 * @author  Paulo Teixeira
	 * @var  $database
	 * @var  $host
	 * @var  $username
	 * @var  $senha
	 * @var  $dbName
	 * @var  $port
	 * @var $mysql
	 */
	class connectionDb 
	{
		private $datasource;
		private $host;
		private $username;
		private $senha;
		private $dbName;
		private $port;
		private $dbDescription;
		public  $typedb;
		public 	$err; 
		public  $mysql;
		public  $oracle;
		
		public function __construct($argBanco="mysql")
		{
			return $this->typedb = $argBanco;
		}
		# método construtor que faz a conexão com o banco de dados
		/**
		 * Método de conexão com o banco de dados mysql
		 * @name  __conecta
		 * @return Object
		 * @access  Protected
		 * @author  Paulo Teixeira
		 * @package  connectionDb
		 */
		public function __conecta()
		{	
			global $typedb;
			$this -> datasource = "FW";
			$this -> host = "localhost";
			//$this -> username = "framework";
			$this -> username = "root";
			$this -> senha = "090302";
			//$this -> dbName = "xe";
			//$this -> port = 1521;
			$this -> dbName = "eprocurement";
			$this -> port = 3306;
						
			if($this->typedb == "mysql")
			{
				$this->mysql = new mysqli($this->host,$this->username,$this->senha,$this->dbName,$this->port);
				return $this->mysql;
			}
			
			if($this->typedb == "oracle")
			{
				$this->dbDescription ="(DESCRIPTION=";
				$this->dbDescription.=" (ADDRESS_LIST=";
				$this->dbDescription.="     (ADDRESS=(PROTOCOL=TCP)";
				$this->dbDescription.="        (HOST={$this->host})(PORT={$this->port})";
				$this->dbDescription.="     )";
				$this->dbDescription.=" )";
				$this->dbDescription.=" (CONNECT_DATA=(SERVICE_NAME={$this->dbName}))";
				$this->dbDescription.=")";
				
				if($this->oracle = OCILogon($this->username,$this->senha,$this->dbDescription)) 
				{
				  return $this->oracle;
				} 
				else 
				{
				  $this->err = OCIError();
				  return false;
				}
			}
		}
	}
?>