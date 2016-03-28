<?php


namespace Ecommerce\FrontBundle\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;

class GenerateFacture
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function facture($facture)
    {
        $html = $this->container->get('templating')->render('@User/User/facturePDF.html.twig', array('facture' => $facture));

        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetAuthor('Ecommerce');
        $html2pdf->pdf->SetTitle('Facture '.$facture->getReference());
        $html2pdf->pdf->SetSubject('Facture Ecommerce');
        $html2pdf->pdf->SetKeywords('facture, ecommerce');
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($html);

        return $html2pdf;
    }
}