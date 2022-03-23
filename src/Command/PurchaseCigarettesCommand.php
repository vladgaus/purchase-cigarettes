<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Machine\{
    CigaretteFactory,
    InvalidAmountException
};

/**
 * Class CigaretteMachine
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    /**
     * @param InputInterface   $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $itemCount = (int) $input->getArgument('packs');
        $amount = (float) \str_replace(',', '.', $input->getArgument('amount'));

        // here implement factory pattern. If in future we will change product from cigarette to some another - just implement it
        $cigaretteFactory =  new CigaretteFactory();
        $purchaseTransaction = $cigaretteFactory->setPurchaseTransaction($itemCount, $amount);
        $cigaretteMachine = $cigaretteFactory->setMachine();
    
        // Checking possible to buy cigarette packs with some money or no
        try {
            
            // Calculate data
            $purchaseItem = $cigaretteMachine->execute($purchaseTransaction);
            $change = $purchaseItem->getChange();
            $quantity = $purchaseItem->getItemQuantity();
            $totalAmount = $purchaseItem->getTotalAmount();
            $price = $purchaseItem->getPrice();

            // outpuut data
            $output->writeln("You bought <info>$quantity</info> packs of cigarettes for <info>$totalAmount</info>, each for <info>$price</info>. ");
            $output->writeln('Your change is:');
            $table = new Table($output);
            $table
                ->setHeaders(['Coins', 'Count'])
                ->setRows($change)
            ;
            $table->render();
        } catch (InvalidAmountException $e) {
            $missingMoney = $e->getCoins();
            $output->writeln("You can't buy $itemCount packs. You need €$missingMoney more.");
        }
    }
}
