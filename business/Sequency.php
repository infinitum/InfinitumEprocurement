<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sequencyclass
 *
 * @author Administrador
 */
 require_once('../includes.php');
 
 
class Sequency {
    private $dbInstance;
    private $sqlStatement;
    private $result;
    //put your code here
    public function  __construct() {
        $this->dbInstance = new queryBuilder();
    }

    public function getSequence($tableName)
    {
        $this->sqlStatement = "SELECT cod_seq FROM tbseq WHERE nome_table = '{$tableName}' ";
        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,'getSequence({$tableName})');
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
        $retorno = $this->result['cod_seq'];
        
        $this->setSequence($tableName);
        
        return $retorno;
    }

    private function setSequence($tableName)
    {
        $this->sqlStatement = "UPDATE tbseq SET cod_seq = cod_seq+1
                               WHERE nome_table = '{$tableName}' ";

        try{
            $this->dbInstance->Execute($this->sqlStatement, 'Sequencia tabela {$tableName}');
        }
        catch (Exception $e)
        {
             echo "<b>Erro de query: </b>" . $e -> getMessage() . "\n <b>Linha: </b>" . $e -> getLine() . "\n";
             exit;
        }
    }
}
?>
