<?php


namespace Ecommerce\FrontBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FactureCommand extends ContainerAwareCommand
{

    /**
     *
     */
    protected function configure()
    {
        $this->setName('ecommerce:facture')
            ->setDescription('Ceci est un premier test')
            ->addArgument('date', InputArgument::OPTIONAL, 'Date pour laquel vous souhaitez récuperer les factures');
    }

    /**
     * Genère les commades dont la date est sup à la date passé en param
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \HTML2PDF_exception
     * @return pdf
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $date = new \DateTime();
        $factures = $this->getContainer()
                ->get('commande_manager')
                ->getRepository()
                ->byDateCommand($input->getArgument('date'));

        $output->writeln(sprintf('%s facture(s)', count($factures)) );

        if (count($factures) > 0) {
            mkdir('Facturation');
            $dir = $date->format('d-m-Y h-i-s');
            mkdir(sprintf('Facturation/%s', $dir));

            foreach($factures as $facture) {

                $this->getContainer()->get('generate_facture_pdf')->facture($facture)
                    ->Output(sprintf('Facturation/%s/facture%s.pdf', $dir, $facture->getReference()),'F');

            }
        }
    }

}