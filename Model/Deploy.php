<?php


namespace MagentoEse\Wysiwygdesign\Model;


class Deploy

{

   protected $output;
   public function __construct(
       \Magento\Framework\App\State $appState,
        \Magento\Deploy\Model\Filesystem $fileSystem,
        \Magento\Setup\Model\Cron\JobStaticRegenerate $regenerate

   ) {
        $this->appState = $appState;
        $this->fileSystem = $fileSystem;
        $this->regenerate = $regenerate;
    }

    public function staticContentDeploy()
    {
        $mode = $this->appState->getMode();
        if ($mode == \Magento\Framework\App\State::MODE_PRODUCTION) {
            exec('php ./bin/magento setup:static-content:deploy');
        }
        //$this->fileSystem->regenerateStatic($this->getOutputObject());
        $this->regenerate->execute();
    }


}

