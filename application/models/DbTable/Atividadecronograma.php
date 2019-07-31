<?php

/**
 * Automatically generated data model
 *
 * This class has been automatically generated based on the dbTable "" @ 16-05-2013
 * 17:21
 */
class Default_Model_DbTable_Atividadecronograma extends Zend_Db_Table_Abstract
{
    protected $_schema  = 'agepnet200';
    protected $_name    = 'tb_atividadecronograma';
    protected $_primary = array(
        'idatividadecronograma',
        'idprojeto'
    );
    protected $_dependentTables = array();
    protected $_referenceMap = array(
        'Pessoa' => array(
            'refTableClass'   => 'tb_pessoa',
            'columns'         => 'idresponsavel',
            'refColumns'      => 'idpessoa'
        ),
        'Elementodespesa' => array(
            'refTableClass' => 'tb_elementodespesa',
            'columns'       => 'idelementodespesa',
            'refColumns'    => 'idelementodespesa'
        )
    );

}

