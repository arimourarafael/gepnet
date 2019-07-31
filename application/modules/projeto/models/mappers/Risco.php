<?php

/**
 * Automatically generated data model
 *
 * This class has been automatically generated based on the dbTable "" @ 14-05-2013
 * 18:02
 */
class Projeto_Model_Mapper_Risco extends App_Model_Mapper_MapperAbstract {

    /**
     * Set the property
     *
     * @param string $value
     * @return Projeto_Model_Risco
     */
    public function insert(Projeto_Model_Risco $model)
    {
        $data = array(
            "idrisco" => $this->maxVal('idrisco'),
            "idprojeto" => $model->idprojeto,
            "idorigemrisco" => $model->idorigemrisco,
            "idetapa" => $model->idetapa,
            "idtiporisco" => $model->idtiporisco,
            "norisco" => $model->norisco,
            "datdeteccao" => new Zend_Db_Expr("to_date('" . $model->datdeteccao . "','DD-MM-YYYY')"),
            "desrisco" => $model->desrisco,
            "domcorprobabilidade" => $model->domcorprobabilidade,
            "domcorimpacto" => $model->domcorimpacto,
            "domcorrisco" => $model->domcorrisco,
            "descausa" => $model->descausa,
            "desconsequencia" => $model->desconsequencia,
            "domtratamento" => $model->domtratamento,
            "flariscoativo" => $model->flariscoativo,
            "flaaprovado" => $model->flaaprovado,
            "datinatividade" => $model->datinatividade ? new Zend_Db_Expr("to_date('" . $model->datinatividade . "','DD-MM-YYYY')"): NULL,
            "datencerramentorisco" => $model->datinatividade ? new Zend_Db_Expr("to_date('" . $model->datencerramentorisco . "','DD-MM-YYYY')") : NULL,
            "idcadastrador" => $model->idcadastrador,
            "datcadastro" => new Zend_Db_Expr('now()'),
        );
        return $this->getDbTable()->insert($data);
    }

    /**
     * Set the property
     *
     * @param string $value
     * @return Projeto_Model_Risco
     */
    public function update(Projeto_Model_Risco $model)
    {
        $data = array(
            "idorigemrisco" => $model->idorigemrisco,
            "idetapa" => $model->idetapa,
            "idtiporisco" => $model->idtiporisco,
            "norisco" => $model->norisco,
            "datdeteccao" => new Zend_Db_Expr("to_date('" . $model->datdeteccao . "','DD-MM-YYYY')"),
            "desrisco" => $model->desrisco,
            "domcorprobabilidade" => $model->domcorprobabilidade,
            "domcorimpacto" => $model->domcorimpacto,
            "domcorrisco" => $model->domcorrisco,
            "descausa" => $model->descausa,
            "desconsequencia" => $model->desconsequencia,
            "domtratamento" => $model->domtratamento,
            "flariscoativo" => $model->flariscoativo,
            "flaaprovado" => $model->flaaprovado,
            "datinatividade" => $model->datinatividade ? new Zend_Db_Expr("to_date('" . $model->datinatividade . "','DD-MM-YYYY')"): NULL,
            "datencerramentorisco" => $model->datencerramentorisco ? new Zend_Db_Expr("to_date('" . $model->datencerramentorisco . "','DD-MM-YYYY')") : NULL,
        );
        return $this->getDbTable()->update($data, array("idrisco = ?" => $model->idrisco));
    }

    public function delete($params)
    {
       $where =  $this->quoteInto('idrisco = ?', (int)$params['idrisco']);        
       $result =  $this->getDbTable()->delete($where);
       return $result;
    }
    
    public function getForm()
    {
        return $this->_getForm(Projeto_Form_Risco);
    }

    public function getByIdDetalhar($params)
    {
        $sql = "select  
                    to_char(tr.datdeteccao, 'DD/MM/YYYY') as datdeteccao,
                    tr.norisco,
                    tor.desorigemrisco,
                    te.dsetapa,
                    ttr.dstiporisco,
                    tr.desrisco,
                    CASE 
                         WHEN tr.domcorrisco=1 THEN '<span class=\"badge badge-important\">Vermelho</span>'
                         WHEN tr.domcorrisco=2 THEN '<span class=\"badge badge-warning\">Amarelo</span>'
                         WHEN tr.domcorrisco=3 THEN '<span class=\"badge badge-success\">Verde</span>'
                         ELSE '<span class=\"badge\"> - </span>'
                    END as domcorrisco,
                    CASE
                         WHEN tr.domcorprobabilidade=1 THEN 'Alta'
                         WHEN tr.domcorprobabilidade=2 THEN 'Media'
                         WHEN tr.domcorprobabilidade=3 THEN 'Baixa'
                         ELSE '-'
                    END as domcorprobabilidade,
                    CASE
                         WHEN tr.domcorimpacto=1 THEN 'Alta'
                         WHEN tr.domcorimpacto=2 THEN 'Media'
                         WHEN tr.domcorimpacto=3 THEN 'Baixa'
                         ELSE '-'
                    END as domcorimpacto,
                    CASE 
                         WHEN tr.domtratamento=1 THEN 'Conviver'
                         WHEN tr.domtratamento=2 THEN 'Mitigar'
                         WHEN tr.domtratamento=3 THEN 'Neutralizar'
                         WHEN tr.domtratamento=4 THEN 'Potencializar'
                         WHEN tr.domtratamento=5 THEN 'Transferir'
                         ELSE '-'
                    END as domtratamento,
                    CASE 
                         WHEN tr.flariscoativo=1 THEN 'Sim'
                         WHEN tr.flariscoativo=2 THEN 'Não'
                         ELSE '-'
                    END as flariscoativo,
                    to_char(tr.datencerramentorisco, 'DD/MM/YYYY')  as datencerramentorisco,
                    tr.descausa,
                    tr.desconsequencia,                    
                    CASE 
                         WHEN tr.flaaprovado=1 THEN 'Sim'
                         WHEN tr.flaaprovado=2 THEN 'Não'
                         ELSE '-'
                    END as flaaprovado,
                    to_char(tr.datinatividade, 'DD/MM/YYYY')  as datinatividade,
                    tr.idrisco,
                    tr.idprojeto
             from agepnet200.tb_risco tr
                inner join agepnet200.tb_tiporisco ttr on ttr.idtiporisco = tr.idtiporisco
                inner join agepnet200.tb_etapa te on te.idetapa = tr.idetapa
                inner join agepnet200.tb_origemrisco tor on tor.idorigemrisco =  tr.idorigemrisco
             WHERE tr.idrisco = :idrisco";
        $resultado = $this->_db->fetchRow($sql, array('idrisco' => (int) $params['idrisco']));
        return $resultado;
    }

    public function getById($params)
    {
        $sql = "SELECT
                    flariscoativo, 
                    domcorprobabilidade, 
                    idetapa, 
                    idtiporisco, 
                    idorigemrisco, 
                    idrisco, 
                    idprojeto, 
                    to_char(datdeteccao, 'DD/MM/YYYY') as datdeteccao, 
                    norisco, 
                    descausa, 
                    domtratamento, 
                    to_char(datencerramentorisco, 'DD/MM/YYYY')  as datencerramentorisco,
                    domcorimpacto, 
                    domcorrisco, 
                    desconsequencia, 
                    desrisco,
                    flaaprovado,
                    to_char(datinatividade, 'DD/MM/YYYY')  as datinatividade
                FROM agepnet200.tb_risco
                WHERE idrisco = :idrisco";
        $resultado = $this->_db->fetchRow($sql, array('idrisco' => $params['idrisco']));
        return new Projeto_Model_Risco($resultado);
    }

    public function retornaPorProjeto($params)
    {
        $sql = "SELECT * /*
                    idrisco,
                    idprojeto,
                    idorigemrisco,
                    idetapa,
                    idtiporisco,
                    datdeteccao,
                    desrisco,
                    domcorprobabilidade,
                    domcorimpacto,
                    domcorrisco,
                    descausa,
                    desconsequencia,
                    domtratamento,
                    flariscoativo,
                    datencerramentorisco,
                    idcadastrador,
                    datcadastro */
                FROM agepnet200.tb_risco
                WHERE idprojeto = :idprojeto";
        $resultado = $this->_db->fetchRow($sql, array('idprojeto' => $params['idprojeto']));
        return new Projeto_Model_Risco($resultado);
    }
    
    // Retorna todos os riscos por projeto
    public function matrizRisco($params)
    {
        $sql = "SELECT 
                    *,
                    c.notipocontramedida
                FROM agepnet200.tb_risco r
                inner join agepnet200.tb_tipocontramedida c on r.domtratamento = c.idtipocontramedida
                WHERE idprojeto = :idprojeto";
        $resultado = $this->_db->fetchAll($sql, array('idprojeto' => $params['idprojeto']));
        return $resultado;
    }

    /**
     * Retorna a os riscos e suas contramedidas
     * 
     * @param array $params - parametros do request e condicoes
     * @return array - Resultado da busca
     */
    public function retornaRiscoContramedida($params) 
    {
        $params = array_filter($params);
        $sql = "SELECT
                    /*risco*/
                    tr.idrisco,
                    to_char(tr.datdeteccao, 'DD/MM/YYYY') as datdeteccao,
                    tr.norisco,
                    tor.desorigemrisco,
                    te.dsetapa,
                    ttr.dstiporisco,
                    tr.desrisco,
                    CASE 
                         WHEN tr.domcorrisco=1 THEN '<span class=\"badge badge-important\">Vermelho</span>'
                         WHEN tr.domcorrisco=2 THEN '<span class=\"badge badge-warning\">Amarelo</span>'
                         WHEN tr.domcorrisco=3 THEN '<span class=\"badge badge-success\">Verde</span>'
                         ELSE '<span class=\"badge\"> - </span>'
                    END as domcorrisco,
                    CASE
                         WHEN tr.domcorprobabilidade=1 THEN 'Alta'
                         WHEN tr.domcorprobabilidade=2 THEN 'Media'
                         WHEN tr.domcorprobabilidade=3 THEN 'Baixa'
                         ELSE '-'
                    END as domcorprobabilidade,
                    CASE
                         WHEN tr.domcorimpacto=1 THEN 'Alta'
                         WHEN tr.domcorimpacto=2 THEN 'Media'
                         WHEN tr.domcorimpacto=3 THEN 'Baixa'
                         ELSE '-'
                    END as domcorimpacto,
                    CASE 
                         WHEN tr.domtratamento=1 THEN 'Conviver'
                         WHEN tr.domtratamento=2 THEN 'Mitigar'
                         WHEN tr.domtratamento=3 THEN 'Neutralizar'
                         WHEN tr.domtratamento=4 THEN 'Potencializar'
                         WHEN tr.domtratamento=5 THEN 'Transferir'
                         ELSE '-'
                    END as domtratamento,
                    CASE 
                         WHEN tr.flariscoativo=1 THEN 'Sim'
                         WHEN tr.flariscoativo=2 THEN 'Não'
                         ELSE '-'
                    END as flariscoativo,
                    to_char(tr.datencerramentorisco, 'DD/MM/YYYY')  as datencerramentorisco,
                    tr.descausa,
                    tr.desconsequencia,                    
                    CASE 
                         WHEN tr.flaaprovado=1 THEN 'Sim'
                         WHEN tr.flaaprovado=2 THEN 'Não'
                         ELSE '-'
                    END as flaaprovado,
                    to_char(tr.datinatividade, 'DD/MM/YYYY')  as datinatividade,
                     /*contramedida*/
                    tc.nocontramedida,
                    tc.descontramedida,
                    to_char(tc.datprazocontramedida, 'DD/MM/YYYY') as datprazocontramedida, 
                    to_char(tc.datprazocontramedidaatraso, 'DD/MM/YYYY') as datprazocontramedidaatraso, 
                    CASE 
                        WHEN tc.domstatuscontramedida = 1 THEN 'Atrasada'
                        WHEN tc.domstatuscontramedida = 2 THEN 'Cancelada'
                        WHEN tc.domstatuscontramedida = 3 THEN 'Concluída'
                        WHEN tc.domstatuscontramedida = 4 THEN 'Em Andamento'
                        WHEN tc.domstatuscontramedida = 5 THEN 'Não Iniciada'
                        WHEN tc.domstatuscontramedida = 6 THEN 'Paralisada'
                        ELSE '-'
                    END as domstatuscontramedida,
                    CASE 
                        WHEN tc.flacontramedidaefetiva = 1 THEN 'Sim'
                        WHEN tc.flacontramedidaefetiva = 2 THEN 'Não'
                        ELSE '-'
                    END as flacontramedidaefetiva,
                    ttc.notipocontramedida,
                    tc.desresponsavel, 
                    tc.idcontramedida     
                FROM agepnet200.tb_risco tr
                        inner join agepnet200.tb_tiporisco ttr on ttr.idtiporisco = tr.idtiporisco
                        inner join agepnet200.tb_etapa te on te.idetapa = tr.idetapa
                        inner join agepnet200.tb_origemrisco tor on tor.idorigemrisco =  tr.idorigemrisco
                        left join agepnet200.tb_contramedida tc on tc.idrisco =  tr.idrisco
                        left join agepnet200.tb_tipocontramedida ttc on ttc.idtipocontramedida = tc.idtipocontramedida
                WHERE tr.idprojeto = :idprojeto";
        
        //RN
        if(isset($params['ver_nao_aprovados']) && $params['ver_nao_aprovados'] == true) {
            $sql .= " AND ( tr.flaaprovado = 1 OR tr.flaaprovado = 2  )";
        } else {
            $sql .= " AND tr.flaaprovado = 1";
        }
        
        //Retorna o risco por idrisco
        if (isset($params['print']) && $params['print'] == 'one') {
            $sql .=  " AND tr.idrisco = :idrisco ORDER BY tr.datdeteccao, tr.norisco, tc.nocontramedida";
            $resultado = $this->_db->fetchAll($sql, array('idprojeto' => (int)$params['idprojeto'], 'idrisco'=>(int)$params['idrisco'] ));
        }
        //Retorna todos os riscos do projeto
        if (isset($params['print']) && $params['print'] == 'all') {
            $sql .=  " ORDER BY tr.datdeteccao, tr.norisco, tc.nocontramedida";
            $resultado = $this->_db->fetchAll($sql, array('idprojeto' => (int)$params['idprojeto']));
        }
        
        return $resultado;
    }
    
    public function retornaPorProjetoToGrid($params)
    {
        $params = array_filter($params);
        $sql = "select  
                    to_char(tr.datdeteccao, 'DD/MM/YYYY') as datdeteccao,
                    tr.norisco,
                    tor.desorigemrisco,
                    te.dsetapa,
                    ttr.dstiporisco,
                    CASE 
                         WHEN tr.domcorrisco=1 THEN '<span class=\"badge badge-important\">Vermelho</span>'
                         WHEN tr.domcorrisco=2 THEN '<span class=\"badge badge-warning\">Amarelo</span>'
                         WHEN tr.domcorrisco=3 THEN '<span class=\"badge badge-success\">Verde</span>'
                         ELSE '<span class=\"badge\"> - </span>'
                     END as domcorrisco,
                    CASE 
                         WHEN tr.domtratamento=1 THEN 'Conviver'
                         WHEN tr.domtratamento=2 THEN 'Mitigar'
                         WHEN tr.domtratamento=3 THEN 'Neutralizar'
                         WHEN tr.domtratamento=4 THEN 'Potencializar'
                         WHEN tr.domtratamento=5 THEN 'Transferir'
                         ELSE '-'
                     END as domtratamento,
                    CASE 
                         WHEN tr.flariscoativo=1 THEN 'Sim - '|| to_char(tr.datencerramentorisco, 'DD/MM/YYYY')
                         WHEN tr.flariscoativo=2 THEN 'Não - '|| to_char(tr.datencerramentorisco, 'DD/MM/YYYY')
                         ELSE '-'
                     END as riscoativodat,
                    tr.idrisco,
                    tr.idprojeto
             FROM agepnet200.tb_risco tr
                inner join agepnet200.tb_tiporisco ttr on ttr.idtiporisco = tr.idtiporisco
                inner join agepnet200.tb_etapa te on te.idetapa = tr.idetapa
                inner join agepnet200.tb_origemrisco tor on tor.idorigemrisco =  tr.idorigemrisco
             WHERE tr.idprojeto = ". (int) $params['idprojeto'];
        
        //RN
        if(isset($params['ver_nao_aprovados']) && $params['ver_nao_aprovados'] == true) {
            $sql .= " AND ( tr.flaaprovado = 1 OR tr.flaaprovado = 2  )";
        } else {
            $sql .= " AND tr.flaaprovado = 1";
        }
        
        if(isset($params['datdeteccao']) && $params['datdeteccao'] != "") {
                $sql .= " AND tr.datdeteccao = to_date('{$params['datdeteccao']}','DD/MM/YYYY') ";
        }        
        if(isset($params['norisco']) && $params['norisco'] != "") {
            $sql .= " AND tr.norisco ilike'%{$params['norisco']}%'";
        }
        if(isset($params['idorigemrisco']) && $params['idorigemrisco'] != "") {
            $sql .= " AND tr.idorigemrisco = '{$params['idorigemrisco']}'";
        }
        if(isset($params['idetapa']) && $params['idetapa'] != "") {
            $sql .= " AND tr.idetapa = '{$params['idetapa']}'";
        }
        if(isset($params['idtiporisco']) && $params['idtiporisco'] != "") {
            $sql .= " AND tr.idtiporisco = '{$params['idtiporisco']}'";
        }
        if(isset($params['domcorprobabilidade']) && $params['domcorprobabilidade'] != "") {
            $sql .= " AND tr.domcorprobabilidade = '{$params['domcorprobabilidade']}'";
        }
        if(isset($params['domcorimpacto']) && $params['domcorimpacto'] != "") {
            $sql .= " AND tr.domcorimpacto = '{$params['domcorimpacto']}'";
        }
        if(isset($params['domtratamento']) && $params['domtratamento'] != "") {
            $sql .= " AND tr.domtratamento = '{$params['domtratamento']}'";
        }
        if(isset($params['flariscoativo']) && $params['flariscoativo'] != "") {
            $sql .= " AND tr.flariscoativo = '{$params['flariscoativo']}'";
        }
        if(isset($params['datencerramentorisco']) && $params['datencerramentorisco'] != "") {
                $sql .= " AND tr.datencerramentorisco = to_date('{$params['datencerramentorisco']}','DD/MM/YYYY') ";
        }        
        $sql .= ' order by ' . $params['sidx'] . ' ' . $params['sord'];

        try {
            $page = (isset($params['page'])) ? $params['page'] : 1;
            $limit = (isset($params['rows'])) ? $params['rows'] : 20;
            $paginator = new Zend_Paginator(new App_Paginator_Adapter_Sql_Pgsql($sql));
            $paginator->setItemCountPerPage($limit);
            $paginator->setCurrentPageNumber($page);
            return $paginator;
        } catch ( Exception $exc ) {
            throw new Exception($exc->code());
        }

        return;
    }

    public function retornaRiscos($params)
    {
        $data = null;
        $sql = "SELECT * /*
                    idrisco,
                    idprojeto,
                    idorigemrisco,
                    idetapa,
                    idtiporisco,
                    datdeteccao,
                    desrisco,
                    domcorprobabilidade,
                    domcorimpacto,
                    domcorrisco,
                    descausa,
                    desconsequencia,
                    domtratamento,
                    flariscoativo,
                    datencerramentorisco,
                    idcadastrador,
                    datcadastro */
                FROM agepnet200.tb_risco
                WHERE idprojeto = :idprojeto";
        $resultado = $this->_db->fetchAll($sql, array('idprojeto' => $params['idprojeto']));

//        Zend_Debug::dump($resultado); exit;
        if(count($resultado) > 0){
            foreach($resultado as $r){
                $data.= "Descriçãoo: " . $r["desrisco"] . "\n";
                $data.= "Causa: "	  . $r["descausa"] . "\n";
                $data.= "Consequência: " . $r["desconsequencia"] . "\n\n - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -\n";
            }
        }
        return $data;
    }
}
