<?php
/**
 * Description of Produtos
 *
 * @author Paulo Teixeira
 * @access public
 * @copyright Infinitum
 */
 require_once('../includes.php');
class ProdutosCotacoesDAO {
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
    public function FindOne($Cotacoes,$Produtos){
        $this->sqlStatement = "SELECT
                                    int_idcotacao as idcotacao,
                                    int_idproduto as idproduto,
                                    int_quantidade as quantidade
                                FROM
                                    tbprodutoscotacoes
                                WHERE
                                    int_idcotacao = {$Cotacoes} AND
                                    int_idproduto = {$Produtos}";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find produtoscotacoes()");
            if($this->dbInstance->NumRows($tmpRs))
            {
              if($this->dbInstance->NumRows($tmpRs) == 1)
                $this->result[] = $this->dbInstance->Fetch($tmpRs);
              else
                while($this->result[] = $this->dbInstance->Fetch($tmpRs));
            }
            else $this->result = null;
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
                                    int_idcotacao as idcotacao,
                                    int_idproduto as idproduto,
                                    int_quantidade as quantidade
                                FROM
                                    tbprodutoscotacoes   ";
        if(strlen($Expression) >= '1') $this->sqlStatement .= " WHERE {$Expression} ";
        if(strlen($Order) >= '1') $this->sqlStatement .= " ORDER BY {$Order} ";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find produtocotacao()");
            if($this->dbInstance->NumRows($tmpRs))
            {
              if($this->dbInstance->NumRows($tmpRs) == 1)
                $this->result[] = $this->dbInstance->Fetch($tmpRs);
              else
                while($this->result[] = $this->dbInstance->Fetch($tmpRs));
            }
            else $this->result = null;
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
        $this->sqlStatement .= " INSERT INTO tbprodutoscotacoes
                                (
                                    int_idcotacao,
                                    int_idproduto,
                                    int_quantidade
                                )";
        $this->sqlStatement .= "VALUES
                                (
                                    {$this->idcotacao},
                                    {$dados->idproduto},
                                    {$dados->quantidade}
                                )";
        
        try{
            $this->dbInstance->Execute($this->sqlStatement,"Save produtocotacoes()");
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
            if($this->dbInstance->NumRows($tmpRs))
            {
              if($this->dbInstance->NumRows($tmpRs) == 1)
                $this->result[] = $this->dbInstance->Fetch($tmpRs);
              else
                while($this->result[] = $this->dbInstance->Fetch($tmpRs));
            }
            else $this->result = null;
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