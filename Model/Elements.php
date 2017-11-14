<?php
namespace MagentoEse\Wysiwygdesign\Model;
class Elements extends \Magento\Framework\Model\AbstractModel implements  \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'themecustomizer_elements';

    protected function _construct()
    {
        $this->_init('MagentoEse\Wysiwygdesign\Model\ResourceModel\Elements');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function setFrontendLabel($label)
    {
        $this->setData('frontend_label', $label);
    }

    public function setElementCode($code)
    {
        $this->setData('element_code', $code);
    }

    public function setCSSElement($css)
    {
        $this->setData('css_element', $css);
    }
}