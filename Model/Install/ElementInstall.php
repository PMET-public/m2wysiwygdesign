<?php
/**
 * Created by PhpStorm.
 * User: jbritts
 * Date: 11/13/17
 * Time: 3:14 PM
 */

namespace MagentoEse\Wysiwygdesign\Model\Install;
use Magento\Framework\Setup\SampleData\Context as SampleDataContext;

class ElementInstall
{
    protected $_testFactory;
    public function __construct(
        SampleDataContext $sampleDataContext,
        \MagentoEse\Wysiwygdesign\Model\ElementsFactory $elementsFactory
    )
    {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
        $this->elementsFactory = $elementsFactory;

    }


    public function install(array $elementFixtures)
    {

        foreach ($elementFixtures as $fileName) {
            $fileName = $this->fixtureManager->getFixture($fileName);
            if (!file_exists($fileName)) {
                throw new Exception('File not found: '.$fileName);
            }

            $rows = $this->csvReader->getData($fileName);
            $header = array_shift($rows);

            foreach ($rows as $row) {
                $_productsArray[] = array_combine($header, $row);
            }
            $test = $this->elementsFactory->create();
            $test->setData('element_code','foo1');
            $test->setFrontendLabel('Test Title');
            $test->save();
            unset ($_productsArray);
        }

    }
}