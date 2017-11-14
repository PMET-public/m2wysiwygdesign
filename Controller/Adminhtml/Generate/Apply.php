<?php

namespace MagentoEse\Wysiwygdesign\Controller\Adminhtml\Generate;

use MagentoEse\Wysiwygdesign\Helper\Data as HelperData;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\CacheInterface;


class Apply extends \Magento\Framework\App\Action\Action
{

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \MagentoEse\Wysiwygdesign\Model\CssContent $cssContent
    )
    {
        $this->cssContent = $cssContent;

        return parent::__construct($context);
    }

    /**
     * Default ajax controller for applying settings
     *
     * @return void
     */
    public function execute()
    {
        $css_content = $this->cssContent->generateCssContent();
        $this->cssContent->createCssFile($css_content);

        //$helper = $this->_helperData;

        //if ($helper->getCacheClear()) {
        //    $this->_clearCache();
        //}

        $result = 1;
        $this->getResponse()->setBody($result);
    }
}
