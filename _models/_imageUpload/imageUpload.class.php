<?php
	/**
	* Gerenciamento de arquivos e imagens
	* @name UploadManager
	*/
	
	class UploadManager
	{
		private $objBuilder;
		private $fileString;
		private $fileDestinationString;
		private $locate;
		private $maximumSizeUpload;
		private $disabledExtensions;
		private $fileSize;
		private $resultSize;
		private $unit;
		private $classLocationPath;
			    
		public $resultUpload;
		public $error;
		public $FileName;
		public $FileDirectory;
		
		const DESTINATION = "upload/";
		const DIVISOR = 250;
		
		/**
		 * Método construtor da classe
		 * @name  __construct
		 * @return Void
		 * @access  Public
		 * @author  Infinitum
		 */
		public function __construct()
		{
			$this->classLocationPath = "_imageUpload/";
			$this->objBuilder = new queryBuilder();
			$this->locate = "../";
			$this->disabledExtensions = Array();
			$this->disabledExtensions[0] = ".exe";
			$this->disabledExtensions[1] = ".php";
			$this->disabledExtensions[2] = ".cfm";
			$this->disabledExtensions[3] = ".htm";
			$this->disabledExtensions[4] = "html";
			$this->disabledExtensions[5] = ".inc";
			$this->disabledExtensions[6] = ".sql";
		}
		
		/**
		 * Gerenciamento de imagens
		 * @name ManagerImage
		 * @access Public
		 * @param String Path Image
		 * @param Int image size
		 * @return String
		 */
		public function ManagerImage($argStringSrcImage,$argIntDivisor=DIVISOR)
		{
			return $this->classLocationPath."fn_upload.php?src=".$this->locate.$argStringSrcImage."&num=".$argIntDivisor;
		}
		
		/**
		 * Arredonda o tamanho de um arquivo
		 * @name GetFileSize
		 * @access Private
		 * @param Float File Size
		 * @param Bolean Unit
		 * @return Decimal precision(2)
		 */
		private function GetFileSize($argSizeFile,$argUnit=false)
		{
			$i = 0;
		    $this->fileSize = $argSizeFile;
		    while($this->fileSize >= 1024) {
		    	$this->fileSize /= 1024;
		    	$i++;
		    }
		    
		    $unit = "b";
		    switch($i) {
				case 1: $this->unit = "kb".$this->unit; break;  
				case 2: $this->unit = "mb".$this->unit; break;
				case 3: $this->unit = "gb".$this->unit; break;
		    }
		    
		    if($argUnit)
		    	$this->resultSize = round($this->fileSize,2).$this->unit;
		    else
		    	$this->resultSize = round($this->fileSize,2);
		    	
		    return $this->resultSize;
		}
		
		/**
		 * Método para fazer upload de arquivos
		 * @name UploadImage
		 * @access Public
		 * @param Objeto FileUploaded
		 * @param String Destination Path
		 * @param String FileName
		 * @return Bolean
		 */
		public function UploadImage($argFileString, $argDestination = DESTINATION, $argStringNome=NULL)
		{
			$this->fileString = $argFileString;
			$this->fileDestinationString = trim($argDestination);
			$this->resultUpload = false;
			$this->maximumSizeUpload = 5242880;
			
			if(!empty($this->fileString))
			{
				for($i=0;$i<count($this->disabledExtensions);$i++)
				{
					if(substr($this->fileString["name"],(strlen($this->fileString["name"])-4),4) == $this->disabledExtensions[$i])
					{
						$this -> error = "A extensão do arquivo, não é permitida para gravação no servidor.";
						return $this->resultUpload;
					}
				}
			    if($argStringNome == NULL)
			    {
			    	$argStringNome = $this->fileString["name"];
			    }
			    	
				$uploaddir = $this->fileDestinationString;
			    $uploaddir.= $argStringNome;
			   	
			    $this->FileName = $argStringNome;
			    $this->FileDirectory = $this->fileDestinationString;
			    
			    if($this->GetFileSize($this->fileString["size"]) <= $this->GetFileSize($this->maximumSizeUpload))
			    {
				    if(move_uploaded_file($this->fileString["tmp_name"],$uploaddir))
				    {
				      $this->resultUpload = true;
				    }
			    }
			    else
			    {
			    	$totalFile = round($filesize, 2) . $unit;
			    	$this -> error = "Seu arquivo tem {$totalFile}, mais do que o permitido.";
			    }
			 }
			 return $this->resultUpload;
		}
	}
?>