<?php
	class produtoVO
	{	
		public $id;
                public $nome;
                public $decricao;
                public $pesomedida;
                public $caracteristica;
                public $cor;
                public $categoria;
                public $marca;

                //collection
                public $categoriaproduto;
		
		public $_explicitType = "vo.produtoVO";
	}
?>