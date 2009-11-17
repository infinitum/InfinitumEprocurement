<?php
	require_once("_models/_db/connectionDb.class.php");
    	require_once("_models/_db/queryBuilder.class.php");
	require_once("_models/_sessao/sessao.class.php");
        

        //business
        require_once("business/sequency.php");
        require_once("business/CategoriasProdutosDAO.php");
        require_once("business/ClientesDAO.php");
        require_once("business/CotacoesDAO.php");
        require_once("business/FornecedoresDAO.php");
        require_once("business/MarcasDAO.php");
        require_once("business/OrcamentosDAO.php");
        require_once("business/ProdutosCotacoesDAO.php");
        require_once("business/ProdutosDAO.php");
        require_once("business/ProdutosOrcamentosDAO.php");
        require_once("business/TiposUsuariosDAO.php");
        require_once("business/UsernamesDAO.php");
        require_once("business/UsuariosDAO.php");

	include('vo/autenticationVO.php');
        include('vo/categoriaprodutoVO.php');
        include('vo/clienteVO.php');
        include('vo/cotacaoVO.php');
        include('vo/fornecedorVO.php');
        include('vo/marcaVO.php');
        include('vo/orcamentoVO.php');
        include('vo/produtoVO.php');
        include('vo/produtocotacaoVO.php');
        include('vo/produtoorcamentoVO.php');
        include('vo/tipousuarioVO.php');
        include('vo/usernameVO.php');
        include('vo/usuarioVO.php');
?>