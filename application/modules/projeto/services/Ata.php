<?php

class Projeto_Service_Ata extends App_Service_ServiceAbstract
{

    public $_mapper = null;
    protected $_form = null;
    protected $auth = null;

    /**
     * @var array
     */
    public $errors = array();

    public function init()
    {
        $login = App_Service_ServiceAbstract::getService('Default_Service_Login');
        $this->auth = $login->retornaUsuarioLogado();
        $this->_mapper = new Projeto_Model_Mapper_Ata();
    }

    public function getFormAta()
    {
        $this->_form = new Projeto_Form_Ata();
        return $this->_form;
    }
    
    public function getFormPesquisar()
    {
        $this->_form = new Projeto_Form_AtaPesquisar();
        return $this->_form;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function retornaAtaByProjeto($params = null)
    {
        $dados = $this->_mapper->retornaPorProjetoToGrid($params);
        $service = new App_Service_JqGrid();
        $service->setPaginator($dados);
        return $service;
    }

    public function retornaAtaImprimir($params)
    {
        $projetoMapper = new Projeto_Model_Mapper_Gerencia();
        $projeto = $projetoMapper->retornaProjetoPorId($params);
        
        $ata = $this->_mapper->getByIdImprimir($params);
        
        return array('projeto'=>$projeto, 'ata'=>$ata);        
    }
    
    public function imprmimirTodasAtas($params)
    {
        $projetoMapper = new Projeto_Model_Mapper_Gerencia();
        $projeto = $projetoMapper->retornaProjetoPorId($params);
        
        $ata = $this->_mapper->findAllByProjeto($params);
        return array('projeto'=>$projeto, 'ata'=>$ata);    
    }

    public function getById($params)
    {
        return $this->_mapper->getById($params);
    }
    
    public function getByIdDetalhar($params)
    {
        return $this->_mapper->getByIdDetalhar($params);
    }

    public function insert($dados)
    {
        $form = $this->getFormAta();

        if ( $form->isValid($dados) ) {
            $model = new Projeto_Model_Ata();
            $model->setFromArray($form->getValidValues($dados));
            $model->idcadastrador = $this->auth->idpessoa;
            $model->idata = $this->_mapper->insert($model);
            return $model;
        } else {
            $this->errors = $form->getMessages();
            return false;
        }
    }

    public function update($params)
    {
        $form = $this->getFormAta();
        if ( $form->isValid($params) ) {
            $model = new Projeto_Model_Ata($form->getValidValues($params));
            $model->idcadastrador = $this->auth->idpessoa;
            $retorno = $this->_mapper->update($model);
            return $retorno;
        } else {
            $this->errors = $form->getMessages();
            return false;
        }
    }

    public function excluir($params)
    {
        try {
            return $this->_mapper->delete($params);
        } catch ( Zend_Db_Statement_Exception $exc ) {
            if ( $exc->getCode() == 23503 ) {
                $this->errors = App_Service_ServiceAbstract::ERRO_VIOLACAO_FK_CODE_23503;
            }
        } catch ( Exception $exc ) {
            $this->errors = $exc->getMessage();
            return false;
        }
    }

}
