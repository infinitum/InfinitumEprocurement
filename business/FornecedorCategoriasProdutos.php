<?php
/**
 * Description of Produtos
 *
 * @author Paulo Teixeira
 * @access public
 * @copyright Infinitum
 */
 require_once('../includes.php');
class FornecedorCategoriasProdutos {
    private $dbInstance;
    private $sqlStatement;
    private $result;
    private $sequence;
    private $valueID;

    /**
     * Constructor method
     * @name construct()
     * @access public
     * @author Paulo Teixeira
     * @copyrightInfinitum
     * @todo do instance of framework and sequency class
     * @version 1.0
     * @return void
     */
    public function  __construct() {
        $this->dbInstance = new queryBuilder();
        $this->sequence = new Sequency();
    }

    /**
     * Find one Method
     * @name FindOne()
     * @access public
     * @param PrimaryKey
     * @author Paulo Teixeira
     * @copyrightInfinitum
     * @todo get one collection of records
     * @version 1.0
     * @return RecordSet
     */
    public function FindOne($fornecedor,$Categoria){
        $this->sqlStatement = "SELECT
                                    int_idfornecedor as idfornecedor,
                                    int_idcategoriaProduto as idcategoria
                                FROM
                                    tbfornecedorrelcategoriaproduto
                                WHERE
                                    int_idfornecedor = {$fornecedor} AND
                                    int_idcategoriaProduto = {$Categoria}";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find fornecedorcategoria()");
            $this->result[] = $this->dbInstance->Fetch($tmpRs);
        }
        catch (Exception $e)
        {
             echo "<b>Erro de query: </b>" . $e -> getMessage() . "\n <b>Linha: </b>" . $e -> getLine() . "\n";
             exit;
        }

        return $this->result;
    }

    /**
     * Find all Method
     * @name FindAll()
     * @access public
     * @param Expression
     * @param OrderBy
     * @author Paulo Teixeira
     * @copyrightInfinitum
     * @todo get a list of records
     * @version 1.0
     * @return RecordSet
     */
    public function FindAll($Expression='',$Order=''){
        $this->sqlStatement = " SELECT
                                    int_idfornecedor as idfornecedor,
                                    int_idcategoriaProduto as idcategoria
                                FROM
                                    tbfornecedorrelcategoriaproduto    ";
        if(strlen($Expression) >= '1') $this->sqlStatement .= " WHERE {$Expression} ";
        if(strlen($Order) >= '1') $this->sqlStatement .= " ORDER BY {$Order} ";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find fornecedorcategoria()");
            $this->result[] = $this->dbInstance->Fetch($tmpRs);
        }
        catch (Exception $e)
        {
             echo "<b>Erro de query: </b>" . $e -> getMessage() . "\n <b>Linha: </b>" . $e -> getLine() . "\n";
             exit;
        }
        return $this->result;
    }

    /**
     * Save or update Method
     * @name Save()
     * @access public
     * @param EntityObject
     * @author Paulo Teixeira
     * @copyrightInfinitum
     * @todo Insert or edite at the database one record
     * @version 1.0
     * @return Boolean
     */
    public function Save($dados){
        $this->sqlStatement .= " INSERT INTO tbfornecedorrelcategoriaproduto
                                (
                                    int_idfornecedor,
                                    int_idcategoriaProduto
                                )";
        $this->sqlStatement .= "VALUES
                                (
                                    {$this->idfornecedor},
                                    {$dados->idcategoria}
                                )";
        
        try{
            $this->dbInstance->Execute($this->sqlStatement,"Save fornecedorcategoria()");
        }
        catch (Exception $e)
        {
                echo "<b>Erro de query: </b>" . $e -> getMessage() . "\n <b>Linha: </b>" . $e -> getLine() . "\n";
                exit;
        }
        return true;
    }

    /**
     * Custom SQL Method
     * @name HQL()
     * @access public
     * @author Paulo Teixeira
     * @copyrightInfinitum
     * @todo get a list of records with an custom SQL (HQL)
     * @version 1.0
     * @return RecordSet
     */
    public function _HQL($statement){
        $this->sqlStatement = $statement;

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"HQL()");
            $this->result[] = $this->dbInstance->Fetch($tmpRs);
        }
        catch (Exception $e)
        {
             echo "<b>Erro de query: </b>" . $e -> getMessage() . "\n <b>Linha: </b>" . $e -> getLine() . "\n";
             exit;
        }

        return $this->result;
    }
}
?>