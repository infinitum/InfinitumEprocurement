<?php
/**
 * Description of Produtos
 *
 * @author Paulo Teixeira
 * @access public
 * @copyright Infinitum
 */
 require_once('../includes.php');
class Fornecedores {
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
    public function FindOne($Cotacao){
        $this->sqlStatement = "SELECT
                                    int_idfornecedor as id,
                                    tx_cnpj as cnpj,
                                    tx_empresa as nome,
                                    tx_endereco_rua as rua,
                                    tx_endereco_num as numero,
                                    tx_endereco_bairro as bairro,
                                    tx_endereco_uf as uf,
                                    tx_endereco_cep as cep,
                                    tx_ddd as ddd,
                                    tx_telefone as telefone,
                                    tx_ramal as ramal,
                                    tx_site as site,
                                    tx_roles as roles,
                                    int_idusuario as usuario
                            FROM
                                    tbfornecedores
                                WHERE
                                        int_idfornecedor = {$Fornecedor}";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find fornecedor()");
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
                                    int_idfornecedor as id,
                                    tx_cnpj as cnpj,
                                    tx_empresa as nome,
                                    tx_endereco_rua as rua,
                                    tx_endereco_num as numero,
                                    tx_endereco_bairro as bairro,
                                    tx_endereco_uf as uf,
                                    tx_endereco_cep as cep,
                                    tx_ddd as ddd,
                                    tx_telefone as telefone,
                                    tx_ramal as ramal,
                                    tx_site as site,
                                    tx_roles as roles,
                                    int_idusuario as usuario
                            FROM
                                    tbfornecedores  ";
        if(strlen($Expression) >= '1') $this->sqlStatement .= " WHERE {$Expression} ";
        if(strlen($Order) >= '1') $this->sqlStatement .= " ORDER BY {$Order} ";

        try{
            $tmpRs = $this->dbInstance->Execute($this->sqlStatement,"Find fornecedor()");
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
            $this->sqlStatement = " UPDATE tbfornecedores SET ";
            $this->sqlStatement .= " tx_cnpj = '{$dados->cnpj}' ,
                                     tx_empresa = '{$dados->nome}' ,
                                     tx_endereco_rua = '{$dados->rua}' ,
                                     tx_endereco_num = '{$dados->numero}' ,
                                     tx_endereco_bairro = '{$dados->bairro}' ,
                                     tx_endereco_uf = '{$dados->uf}' ,
                                     tx_endereco_cep = '{$dados->cep}' ,
                                     tx_ddd = '{$dados->ddd}' ,
                                     tx_telefone = '{$dados->telefone}' ,
                                     tx_ramal = '{$dados->ramal}' ,
                                     tx_site = '{$dados->site}' ,
                                     tx_roles = '{$dados->roles}' ,
                                     int_idusuario  = {$dados->usuario} ";
            $this->sqlStatement .= " WHERE int_idfornecedor = {$dados->id} ";
        }
        else
        {
            $this->valueID = $this->sequence->getSequence('tbfornecedores');
            $this->sqlStatement .= " INSERT INTO tbfornecedores
                                    (
                                        int_idfornecedor,
                                        tx_cnpj, 
                                        tx_empresa,
                                        tx_endereco_rua,
                                        tx_endereco_num,
                                        tx_endereco_bairro,
                                        tx_endereco_uf,
                                        tx_endereco_cep,
                                        tx_ddd,
                                        tx_telefone,
                                        tx_ramal,
                                        tx_site,
                                        tx_roles,
                                        int_idusuario
                                    )";
            $this->sqlStatement .= "VALUES
                                    (
                                        {$this->valueID},
                                        '{$dados->cnpj}',
                                        '{$dados->nome}',
                                        '{$dados->rua}',
                                        '{$dados->numero}',
                                        '{$dados->bairro}',
                                        '{$dados->uf}',
                                        '{$dados->cep}',
                                        '{$dados->ddd}',
                                        '{$dados->telefone}',
                                        '{$dados->ramal}',
                                        '{$dados->site}',
                                        '{$dados->roles}',
                                        {$dados->usuario}
                                    )";
        }

        try{
            $this->dbInstance->Execute($this->sqlStatement,"Save cotacao()");
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