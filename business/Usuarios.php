<?php
/**
 * Description of Usuarios
 *
 * @author Paulo Teixeira
 * @access public
 * @copyright Infinitum
 */
 require_once('../includes.php');
class Usuarios {
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
     * @author Paulo Teixeira
     * @copyrightInfinitum
     * @todo get one collection of records
     * @version 1.0
     * @return RecordSet
     */
    public function FindOne($Usuario){
        $this->sqlStatement = "SELECT
                                        int_idusuario as id,
                                        int_idusername as idusername,
                                        int_idtipo_usuario as idtipousuario,
                                        tx_nomeusuario as nome,
                                        tx_sobrenomeusuario as sobrenome,
                                        tx_email as email,
                                        DATE_FORMAT(dt_datacadastro,'%d/%m/%Y') as datacadastro
                                FROM
                                        tbusuarios
                                WHERE
                                        int_idusuario = {$Usuario}";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find usuarios()");
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
        $this->sqlStatement = "SELECT
                                        int_idusuario as id,
                                        int_idtipo_usuario as idtipousuario,
                                        tx_nomeusuario as nome,
                                        tx_sobrenomeusuario as sobrenome,
                                        tx_email as email,
                                        DATE_FORMAT(dt_datacadastro,'%d/%m/%Y') as datacadastro
                                FROM
                                        tbusuarios ";
        if(strlen($Expression) >= '1') $this->sqlStatement .= " WHERE {$Expression} ";
        if(strlen($Order) >= '1') $this->sqlStatement .= " ORDER BY {$Order} ";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find usuarios()");
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
            $this->sqlStatement = " UPDATE tbusuarios SET ";
            $this->sqlStatement .= " int_idtipo_usuario = {$dados->idtipousuario}, ";
            $this->sqlStatement .= " tx_nomeusuario = '{$dados->nome}', ";
            $this->sqlStatement .= " tx_sobrenomeusuario = '{$dados->sobrenome}', ";
            $this->sqlStatement .= " tx_email = '{$dados->email}' ";
            $this->sqlStatement .= " WHERE int_idusername = {$dados->id} ";
        }
        else
        {
            $this->valueID = $this->sequence->getSequence('tbusuarios');
            $this->sqlStatement .= " INSERT INTO tbusuarios
                                    (
                                        int_idusuario,
                                        int_idtipo_usuario,
                                        tx_nomeusuario,
                                        tx_sobrenomeusuario,
                                        tx_email
                                    )";
            $this->sqlStatement .= "VALUES
                                    (
                                        {$this->valueID},
                                        {$dados->idtipousuario},
                                        '{$dados->nome}',
                                        '{$dados->sobrenome}',
                                        '{$dados->email}'
                                    )";
        }

        try{
            $this->dbInstance->Execute($this->sqlStatement,"Save usuarios()");
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