<?php
namespace MagentoEse\Wysiwygdesign\Model\ResourceModel;
class Elements extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('themecustomizer_elements','element_id');
    }
    public function loadByTCode($code){
        $table = $this->getMainTable();
        $where = $this->getConnection()->quoteInto("element_code = ?", $code);
        $sql = $this->getConnection()->select()->from($table,array('element_id'))->where($where);
        $id = $this->getConnection()->fetchOne($sql);
        return $id;
    }
}