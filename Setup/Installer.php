<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MagentoEse\Wysiwygdesign\Setup;

use Magento\Framework\Setup;

class Installer implements Setup\SampleData\InstallerInterface
{


    public function __construct(
        \MagentoEse\Wysiwygdesign\Model\Install\ElementInstall $elementInstall
    ) {
        $this->elementInstall = $elementInstall;

    }

    /**
     * {@inheritdoc}
     */
    public function install()
    {
        $this->elementInstall->install();
    }
}
