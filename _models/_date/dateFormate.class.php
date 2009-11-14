<?php
	/**
	 * Classe de formata��o de datas
	 * @name dateFormate
	 * @access Public
	 * @author Paulo Teixeira
	 * @copyright Infinitum Inform�tica
	 * @version 1.0
	 */
	class dateFormate
	{
		private $dtString;
		private $separator;
		private $strDateFormat;
		public $dateResult;
		
		/**
		 * M�todo de formata��o simples e brasileira
		 * @name brSimpleDate
		 * @access Public
		 * @example brSimpleDate($data,"/")
		 * @var $dtString
		 * @var $separator
		 * @var $strDateFormat
		 * @param String $strDate
		 * @param String $strSeparator
		 * @return Date
		 */
		public function BrSimpleDate($strDate,$strSeparator = "/")
		{
			setlocale(LC_ALL,'pt_BR');
			$this->dtString = $strDate;
			$this->separator = $strSeparator;
			$this->strDateFormat = 'j' . $this -> separator . 'm' . $this -> separator . 'Y';
			$dateResult = date($this->strDateFormat,strtotime($this->dtString));
			
			return $this->dateResult;
		}
		
	/**
         * M�todo de formata��o dbdate
         * @name dbDate
         * @access Public
         * @example dbDate($data)
         * @var $dtString
         * @var $strDateFormat
         * @param String $strDate
         * @return Date
         */
        public function DbDate($strDate)
        {
            setlocale(LC_ALL,'pt_BR');
        	$this->dtString = str_replace("/","-",$strDate);
            $this->strDateFormat = 'Y-m-d H:i:s';
            
            
            
            $dateResult = date($this->strDateFormat,strtotime($this->dtString));
            
            return $this->dateResult;
        }
	}
?>