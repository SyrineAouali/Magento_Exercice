<?php
namespace Exercice\ContactManagement\Setup;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.6', '<')) {
            $data = [
                ['reason' => 'J’ai une réclamation concernant l’expédition de ma commande'],
                ['reason' => 'Je veux en savoir plus concernant des produits que j’ai achetés'],
                ['reason' => 'Je souhaite retourner des produits'],
                ['reason' => 'Autre demande']
            ];

            foreach ($data as $bind) {
                $setup->getConnection()->insertForce($setup->getTable('exercice_contactmanagement_customer_reason'), $bind);
            }
        }

        $setup->endSetup();
    }
}
