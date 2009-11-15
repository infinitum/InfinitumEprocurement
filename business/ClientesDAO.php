<?php
/**
 * Description of Produtos
 *
 * @author Paulo Teixeira
 * @access public
 * @copyright Infinitum
 */
 require_once('../includes.php');
class Clientes {
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
    public function FindOne($Cliente){
        $this->sqlStatement = "SELECT
                                    int_idcliente as id,
                                    int_ddd as ddd,
                                    tx_telefone as telefone,
                                    tx_ramal as ramal,
                                    int_idusuario as usuario
                                FROM
                                    tbcliente
                                WHERE
                                        int_idcliente = {$Cliente}";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find cliente()");
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
                                    int_idcliente as id,
                                    int_ddd as ddd,
                                    tx_telefone as telefone,
                                    tx_ramal as ramal,
                                    int_idusuario as usuario
                                FROM
                                    tbcliente   ";
        if(strlen($Expression) >= '1') $this->sqlStatement .= " WHERE {$Expression} ";
        if(strlen($Order) >= '1') $this->sqlStatement .= " ORDER BY {$Order} ";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find cliente()");
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
            $this->sqlStatement = " UPDATE tbcliente SET ";
            $this->sqlStatement .= " int_ddd = '{$dados->ddd}', ";
            $this->sqlStatement .= " tx_telefone = '{$dados->telefone}', ";
            $this->sqlStatement .= " tx_ramal = '{$dados->ramal}', ";
            $this->sqlStatement .= " int_idusuario = {$dados->usuario} ";
            $this->sqlStatement .= " WHERE int_idcliente = {$dados->id} ";
        }
        else
        {
            $this->valueID = $this->sequence->getSequence('tbcliente');
            $this->sqlStatement .= " INSERT INTO tbcliente
                                    (
                                        int_idcliente,
                                        int_ddd,
                                        tx_telefone,
                                        tx_ramal,
                                        int_idusuario
                                    )";
            $this->sqlStatement .= "VALUES
                                    (
                                        {$this->valueID},
                                        '{$dados->ddd}',
                                        '{$dados->telefone}',
                                        '{$dados->ramal}',
                                        {$dados->usuario}
                                    )";
        }

        try{
            $this->dbInstance->Execute($this->sqlStatement,"Save cliente()");
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