<?php
namespace MagentoEse\ThemeCustomizer\Controller\Adminhtml\Skin;



class Apply extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'MagentoEse_ThemeCustomizer::skins';
    protected $skinDirectory ='/static/frontend/Magento/luma/en_US/MagentoEse_ThemeCustomizer/css/';
    protected $cssFilename = 'demo.css';
    protected $context;
    protected $elementRepository;


    public function _construct(
        \Magento\Backend\App\Action\Context $context

    ){
        //$this->elementRepository = $elementRepository;
      // parent::__construct($context,$elementRepository);
    }

    public function execute()
    {
        // check if we know what should be deleted
        $skinId = $this->getRequest()->getParam('object_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($skinId) {
            $title = "";
            try {
                // init model
                $model = $this->_objectManager->create('MagentoEse\ThemeCustomizer\Model\Skin');
                $model->load($skinId);
                $this->deploy($model);
                // display success message
                $this->messageManager->addSuccess(__('You have applied the skin.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['skin_id' => $skinId]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can not find a skin to apply.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');

    }

    /**
     * @param $model \MagentoEse\ThemeCustomizer\Model\Skin
     */
    private function deploy($model){
        $css_content = $this->generateCssContent($model);
        $this->_createCSSFile($css_content);
    }

    private function generateCssContent($skinModel)
    {
        $elementData = $this->_objectManager->create('MagentoEse\ThemeCustomizer\Model\Element');
        $elements = $elementData->load(1);
        $css_content = '/* THIS FILE IS AUTO-GENERATED, DO NOT MAKE MODIFICATIONS DIRECTLY */' . "\n";
        foreach ($elements->getCollection()->getData() as $element )
        {
            $inString = $element['css_code'];
            $toFind = "$".$element['element_code'];
            $replaceWith = $skinModel->getData($element['element_code']);
            if($replaceWith != null){
                $css_content.= str_replace($toFind,$replaceWith,$inString). "\n";
            }
        }

        $css_content .= $skinModel->getData('additional_css');
        return $css_content;
    }
    public function _createCSSFile($contents)
    {
        if ($contents != NULL) {
            $filename = '';
            $filename = $_SERVER['DOCUMENT_ROOT'].$this->skinDirectory . $this->cssFilename;
            //$filename = str_replace("pub","",$_SERVER['DOCUMENT_ROOT']).$filename;
            if (!file_exists($filename)) {
                mkdir($_SERVER['DOCUMENT_ROOT'].$this->skinDirectory,0744,true);
                $fh = fopen($filename, 'w');
                fclose($fh);
            }
            //reset the file
            file_put_contents($filename, "");
            //create new file and prep for insertion
            $current = file_get_contents($filename);
            $current .= $contents;
            //rewrite it out
            file_put_contents($filename, $current);
        }
    }

}