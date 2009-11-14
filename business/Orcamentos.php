<?php
/**
 * Description of Produtos
 *
 * @author Paulo Teixeira
 * @access public
 * @copyright Infinitum
 */
 require_once('../includes.php');
class Orcamentos {
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
    public function FindOne($Orcamento){
        $this->sqlStatement = "SELECT
                                    int_idorcamento as id,
                                    int_idfornecedor as fornecedor,
                                    int_idcotacao as cotacao,
                                    tx_nomeorcamento as nome,
                                    tx_status as 'status',
                                    DATE_FORMAT(dt_prazo,'%d/%m/%Y') as prazo
                                FROM
                                    tborcamentocotacao
                                WHERE
                                    int_idfornecedor = {$Orcamento}";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find orcamento()");
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
                                    int_idorcamento as id,
                                    int_idfornecedor as fornecedor,
                                    int_idcotacao as cotacao,
                                    tx_nomeorcamento as nome,
                                    tx_status as 'status',
                                    DATE_FORMAT(dt_prazo,'%d/%m/%Y') as prazo
                                FROM
                                    tborcamentocotacao   ";
        if(strlen($Expression) >= '1') $this->sqlStatement .= " WHERE {$Expression} ";
        if(strlen($Order) >= '1') $this->sqlStatement .= " ORDER BY {$Order} ";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find orcamento()");
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
        if($dados->id != '0')
        {
            $this->sqlStatement = " UPDATE tborcamentocotacao SET ";
            $this->sqlStatement .= " int_idfornecedor = {$dados->fornecedor}, ";
            $this->sqlStatement .= " int_idcotacao = {$dados->cotacao}, ";
            $this->sqlStatement .= " tx_nomeorcamento = '{$dados->nome}', ";
            $this->sqlStatement .= " tx_status = '{$dados->status}', ";
            $this->sqlStatement .= " dt_prazo = {$dados->prazo} ";
            $this->sqlStatement .= " WHERE int_idorcamento = {$dados->id} ";
        }
        else
        {
            $this->valueID = $this->sequence->getSequence('tborcamentocotacao');
            $this->sqlStatement .= " INSERT INTO tborcamentocotacao
                                    (
                                        int_idorcamento,
                                        int_idfornecedor,
                                        int_idcotacao,
                                        tx_nomeorcamento,
                                        tx_status,
                                        dt_prazo
                                    )";
            $this->sqlStatement .= "VALUES
                                    (
                                        {$this->valueID},
                                        {$dados->fornecedor},
                                        {$dados->cotacao},
                                        '{$dados->nome}',
                                        '{$dados->status}',
                                        {$dados->prazo}
                                    )";
        }

        try{
            $this->dbInstance->Execute($this->sqlStatement,"Save orcamentocotacao()");
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