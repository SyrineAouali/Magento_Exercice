<?php
namespace Exercice\ContactManagement\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class InstallData implements InstallDataInterface
{
    private $configWriter;

    public function __construct(WriterInterface $configWriter)
    {
        $this->configWriter = $configWriter;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $reasons = "J’ai une réclamation concernant l’expédition de ma commande\nJe veux en savoir plus concernant des produits que j’ai achetés\nJe souhaite retourner des produits";

        $this->configWriter->save('contact/contact_reasons/reasons', $reasons, $scope = \Magento\Framework\App\Config\ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);

        $setup->endSetup();
    }
}
