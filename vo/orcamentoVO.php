<?php
	class orcamentoVO
	{	
		public $id;
                public $fornecedor;
                public $cotacao;
                public $nome;
                public $status;
                public $prazo;
                //collection
                public $produtoorcamento;
		
		public $_explicitType = "vo.orcamentoVO";
	}
?>