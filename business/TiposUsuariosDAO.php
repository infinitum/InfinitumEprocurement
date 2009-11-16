<?php
/**
 * Description of TiposUsuarios
 *
 * @author Paulo Teixeira
 * @access public
 * @copyright Infinitum
 */
 require_once('../includes.php');
class TiposUsuariosDAO {
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
    public function FindOne($Tipo){
        $this->sqlStatement = "SELECT
                                        int_idtipo_usuario as id,
                                        tx_tipo_usuario as tipo
                                FROM
                                        tbtipousuario
                                WHERE
                                        int_idtipo_usuario = {$Tipo} ";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find tiposusuarios()");
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
                                        int_idtipo_usuario as id,
                                        tx_tipo_usuario as tipo,
                                FROM
                                        tbtipousuario ";
        if(strlen($Expression) >= '1') $this->sqlStatement .= " WHERE {$Expression} ";
        if(strlen($Order) >= '1') $this->sqlStatement .= " ORDER BY {$Order} ";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find tiposusuarios()");
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
        if($dados->id != '0')
        {
            $this->sqlStatement = " UPDATE tbtipousuario SET ";
            $this->sqlStatement .= " tx_tipo_usuario = '{$dados->tipo}' ";
            $this->sqlStatement .= " WHERE int_idtipo_usuario = {$dados->id} ";
        }
        else
        {
            $this->valueID = $this->sequence->getSequence('tbtipousuario');
            $this->sqlStatement .= " INSERT INTO tbtipousuario
                                    (
                                        int_idtipo_usuario,
                                        tx_tipo_usuario
                                    )";
            $this->sqlStatement .= "VALUES
                                    (
                                        {$this->valueID},
                                        '{$dados->tipo}'
                                    )";
        }

        try{
            $this->dbInstance->Execute($this->sqlStatement,"Save tipousuarios()");
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