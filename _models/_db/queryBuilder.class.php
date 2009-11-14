<?php
	/** Classe de abstra��o de fun��es de manipula��o de sql
	* @name queryBuilder
	* @package connectionDb
	* @var $result
	* @return Object 
	**/	
	class queryBuilder
	{
		# inicializando atributos da classe relacionadas aos m�todos de execu��o de querys
		public $result;
		private $conn;
		const NAME_QUERY = "QUERY EXECUTE";
		
		public function __construct()
		{
			$this->conn = new connectionDb("mysql");
		}
		
		/**
		*Execu��o de comandos padr�es de consulta a banco (SELECT, INSERT, UPDATE, DELETE, CREATE...)
		*@name execute()
		*@return ObjectQuery
		**/
		public function Execute($argSql, $argName = NAME_QUERY)
		{
			global $result;
			# call the connect database method
			$sqli = $this->conn->__conecta();
						
			# instancia as vari�veis
			$this -> sql = $argSql;
			$this -> name = $argName;
			//echo $this->dbtype;
			//exit;
						
			if($this->conn->typedb == "mysql")
			{
				try
				{
					# execute sql command
					$result = $sqli->query($this->sql);
					
					# fecha a conex�o com o banco de dados
					$sqli -> close();
					
					# retorno do m�todo
					return $result;
				}
				catch (Exception $e) 
				{
					echo "<b>Erro de query: </b>" . $e -> getMessage() . "\n <b>Linha: </b>" . $e -> getLine() . "\n"; 
				}
			}
			
			if($this->conn->typedb == "oracle")
			{
				try
				{
					$result = oci_parse($sqli,$this->sql);
					
				 	oci_execute($result);
					oci_commit($sqli);
					OCILogoff($sqli);
					
					return $result;
				}
				catch (Exception $e) 
				{
					OCILogoff($sqli);
					echo "<b>Erro de query: </b>" . $e -> getMessage() . "\n <b>Linha: </b>" . $e -> getLine() . "\n"; 
				}
			}
		}
		
		/**
		* Execu��o de stored procedures
		* @name call()
		* @return ObjectQuery
		**/
		public function Call($argSql)
		{
			# disponibiliza o resultado para toda a aplica��o para o caso da utiliza��o n�o oop
			global $store;
			
			# call the connect database method
			$sqli = $this -> conn -> __conecta();
			
			if($this -> CheckConnection())
			{
				$this -> sql = $argSql;
				
				# execute sql command
				if($sqli -> multi_query($this -> sql))
				{
				
					$store = $sqli -> store_result();
					
					# fecha a conex�o com o banco de dados
					$sqli -> close();
				
					return $store;
				}
				else
					echo "Falha na conex�o";
					exit;
			}
		}
		
		private function CheckConnection()
		{
			if (mysqli_connect_errno()) 
			{
			    printf("Connect failed: %s\n", mysqli_connect_error());
			    exit();
			}
			else
				return true;
		}
				
		/**
		* Cria um array com os dados da consulta realizada pelo m�todo execute()
		* @name fetch()
		* @return Array
		* @var $fetch
		**/
		
		public function Fetch($argQuery)
		{
			global $fetch;
			
			$objQuery = $argQuery;
			
			if($this->conn->typedb == "mysql")
				$fetch = $objQuery->fetch_array(MYSQLI_BOTH);
			
			if($this->conn->typedb == "oracle")
				$fetch = oci_fetch_array($argQuery,OCI_BOTH);
				
			return $fetch;
		}
		
		/**
		* Cria um array com os dados da consulta realizada pelo m�todo call()
		* @name store()
		* @return Array
		* @var $store
		**/
		public function Store()
		{
			# disponibiliza o resultado para toda a aplica��o para o caso da utiliza��o n�o oop
			global $store;
			
			$sqli = $this -> conn -> __conecta();
			# convert the param in the lower case
			
			# define array with number index
			$store = $sqli -> use_result();
						
			return $store;
		}
		
		/**
		* Cria um array com os nomes dos campos da tabela consultada pelos m�todos de query
		*@name fields()
		*@return Array
		**/
		public function Fields($argQuery)
		{
			# disponibiliza o resultado para toda a aplica��o para o caso da utiliza��o n�o oop
			global $arFields;
			
			$objQuery = $argQuery;
			
			$arFields = $objQuery -> fetch_fields();
			
			return $arFields;
		}
		
		/**
		* Retorna a quantidade de linhas geradas pela consulta ao banco de dados
		*@name numRows()
		*@return Int
		**/
		public function NumRows($argQuery)
		{
			# disponibiliza o resultado para toda a aplica��o para o caso da utiliza��o n�o oop
			global $count;
			
			$objQuery = $argQuery;
			$count = $objQuery -> num_rows;
			
			return $count;
		}
		
		/**
		* Retorna a quantidade de linhas afetadas numa determinada a��o no banco de dados
		*@name afected()
		*@return Int
		**/		
		public function Afected($argQuery)
		{
			# disponibiliza o resultado para toda a aplica��o para o caso da utiliza��o n�o oop
			global $afected;
			
			$sqli = $this -> conn -> __conecta();
			
			$objQuery = $argQuery;
			$afected = $sqli -> affected_rows;
			
			return $afected;
		}
		
		/**
		* Retorna a quantidade de colunas que tem uma determinada tabela
		*@name fieldsCount()
		*@return Int
		**/
		public function FieldsCount($argQuery)
		{
			# disponibiliza o resultado para toda a aplica��o para o caso da utiliza��o n�o oop
			global $countFields;
			
			$objQuery = $argQuery;
			
			$countFields = $objQuery -> field_count;
			
			return $countFields;
		}
		
		/**
		* Gera um arquivo com uma table contendo todos os registros contidos na tabela do banco 
		*@name tableView()
		*@return FileStruct
		**/
		######################################################## */
		
		public function tableView($argTable)
		{
			# disponibiliza o resultado para toda a aplica��o para o caso da utiliza��o n�o oop
			global $nameFile;
			
			$this -> table = $argTable;
			# call the connect database method
			$sqli = $this -> conn -> __conecta();
			
			# exectute a select at a table submited
			$rsField = $this -> execute("select * from {$this -> table} ", "Query table: {$this -> table}");
			
			# get a quantity of coluns from table
			$numFields = $this -> fieldsCount($rsField);
			
			# create file and open with write permission
			$nameFile = "view_{$this -> table}.php";
			
			$file = fopen($nameFile,"a");
			
			# criar tabela de view
			$strFile = "<table width=\"774\" border=\"1\" cellspacing=\"1\" cellpadding=\"1\">\n";
			$strFile .= "<tr>\n";
			$arFields = $this -> fields($rsField);
			
			
			foreach($arFields as $field)
			{
				$strFile .= "	<th scope=\"col\">{$field->name}</th>\n";
			}
			$strFile .= "</tr>\n";
			
			$cntLoop = 1;
			
			$strData = "";
			
			
			while($arRow = $this -> fetch($rsField))
			{
				if($cntLoop == 1)
					$strData .= "<tr>\n";
				
				for ($i = 0; $i < $numFields; $i++)
				{
					if($arRow[$i] != '')
						$strData .= "<td>{$arRow[$i]}</td>\n";
					else
						$strData .= "<td>&nbsp;</td>\n";
				}
					
				$strData .= "</tr>\n";
					
				if($cntLoop == $numFields)
				{
					$cntLoop = 1;	
				}
				else
				{
					$cntLoop++;
				}
				$numIndex++;
			}
			$strData .= "</table>\n";
			
			fwrite($file,$strFile);
			fwrite($file,$strData);
			fclose($file);
			# finalizar tabela de view
			
			return $nameFile;
		}
	}
?>