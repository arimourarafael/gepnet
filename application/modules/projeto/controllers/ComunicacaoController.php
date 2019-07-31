<?php

class Projeto_ComunicacaoController extends Zend_Controller_Action
{

    public function init()
    {
        $ajaxContext = $this->_helper->getHelper('AjaxContext');
        $ajaxContext
                ->addActionContext('excluir', 'json')
                ->addActionContext('add', 'json')
                ->addActionContext('edit', 'json')
                ->initContext();
    }

    public function listarAction()
    {
       
        $idprojeto = $this->getRequest()->getParam('idprojeto');
        $service = App_Service_ServiceAbstract::getService('Projeto_Service_Comunicacao');
        $form = $service->getFormComunicacaoPesquisar();
        
        $parteInteressadaService = App_Service_ServiceAbstract::getService('Projeto_Service_ParteInteressada');
        $comboParteInteressada = $parteInteressadaService->fetchPairsPorProjeto(array('idprojeto'=>$idprojeto));
        $form->getElement('idresponsavelpesquisar')->options = $comboParteInteressada;
        
        $form->populate(array('idprojetopesquisar' => $idprojeto));
        $this->view->idprojeto = $idprojeto;
        $this->view->form = $form;
    }

    public function pesquisarParteInteressadaAction()
    {
        //monta a view para ser retornada via ajax
    }

    public function gridParteInteressadaAction()
    {
        $params['idprojeto'] = $this->getRequest()->getParam('idprojeto');
        $params['nomparteinteressada'] = $this->getRequest()->getParam('nomparteinteressada');
        $service = App_Service_ServiceAbstract::getService('Projeto_Service_ParteInteressada');
        $paginator = $service->getParteInteressadaGrid($params, true);
        $this->_helper->json->sendJson($paginator->toJqgrid());
    }

    public function gridComunicacaoAction()
    {
        $params = $this->getRequest()->getParams();
        $service = App_Service_ServiceAbstract::getService('Projeto_Service_Comunicacao');
        $paginator = $service->getGridComunicacao($params, true);
        $this->_helper->json->sendJson($paginator->toJqgrid());
    }

    public function addAction()
    {
        $service = App_Service_ServiceAbstract::getService('Projeto_Service_Comunicacao');
        $form = $service->getFormComunicacaoInserir();
        $request = $this->getRequest();
        $dataForm['idprojeto'] = $request->getParam('idprojeto');

        if ( $request->isPost() ) {
            $comunicacao = $service->insert($request->getPost());
            if ( $comunicacao ) {
                $success = true; ###### AUTENTICATION SUCCESS
                $msg = App_Service_ServiceAbstract::REGISTRO_CADASTRADO_COM_SUCESSO;
            } else {
                $success = false;
                $msg = $service->getErrors();
            }
            //monta a mensagem de resposta do ajax
            if ( $this->_request->isXmlHttpRequest() ) {
                $this->view->success = $success;
                $this->view->msg = array(
                    'text' => $msg,
                    'type' => ($success) ? 'success' : 'error',
                    'hide' => true,
                    'closer' => true,
                    'sticker' => false
                );
            }
        }
        $form->populate($dataForm);
        $this->view->form = $form;
    }

    public function editAction()
    {
        $service = App_Service_ServiceAbstract::getService('Projeto_Service_Comunicacao');
        $form = $service->getFormComunicacaoEdit();
        $request = $this->getRequest();

        $dataForm = $service->getComunicacaoById(array(
                    'idcomunicacao' => $request->getParam('idcomunicacao')
                ))->toArray();

        if ( $request->isPost() ) {
            $comunicacao = $service->update($request->getPost());
            if ( $comunicacao ) {
                $success = true; ###### AUTENTICATION SUCCESS
                $msg = App_Service_ServiceAbstract::REGISTRO_ALTERADO_COM_SUCESSO;
            } else {
                $success = false;
                $msg = $service->getErrors();
            }
            //monta a mensagem de resposta do ajax
            if ( $this->_request->isXmlHttpRequest() ) {
                $this->view->success = $success;
                $this->view->msg = array(
                    'text' => $msg,
                    'type' => ($success) ? 'success' : 'error',
                    'hide' => true,
                    'closer' => true,
                    'sticker' => false
                );
            }
        }
        $form->populate($dataForm);
        $this->view->form = $form;
    }

    public function excluirAction()
    {
        $service = App_Service_ServiceAbstract::getService('Projeto_Service_Comunicacao');
        $request = $this->getRequest();

        if ( $request->isPost() ) {
            $result = $service->delete($request->getPost('idcomunicacao'));
            if ( $result ) {
                $success = true; ###### AUTENTICATION SUCCESS
                $msg = App_Service_ServiceAbstract::REGISTRO_EXCLUIDO_COM_SUCESSO;
            } else {
                $success = false;
                $msg = $service->getErrors();
            }
            //monta a mensagem de resposta do ajax
            if ( $this->_request->isXmlHttpRequest() ) {
                $this->view->success = $success;
                $this->view->msg = array(
                    'text' => $msg,
                    'type' => ($success) ? 'success' : 'error',
                    'hide' => true,
                    'closer' => true,
                    'sticker' => false
                );
                return;
            }
        }
        $comunicacao = $service->getComunicacaoById(array(
                    'idcomunicacao' => $request->getParam('idcomunicacao')
                ));
        $this->view->comunicacao = $comunicacao;
    }

    public function detalharAction()
    {
        $service = App_Service_ServiceAbstract::getService('Projeto_Service_Comunicacao');
        $request = $this->getRequest();

        $comunicacao = $service->getComunicacaoById(array(
                    'idcomunicacao' => $request->getParam('idcomunicacao')
                ));
        $this->view->comunicacao = $comunicacao;
    }

}
