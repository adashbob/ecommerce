<?php


namespace Ecommerce\FrontBundle\Services;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class GenerateFacture
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

    }

    /**
     * @param $view
     * @param array $parameters
     * @return Response
     * @throws \HTML2PDF_exception
     */
    public function genratePdf($view, array $parameters  = array('author' => '', 'title' => '', 'subject' => '', 'filename' => '', 'keywords' => ''))
    {
        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
        $html2pdf->pdf->SetAuthor('');
        $html2pdf->pdf->SetTitle('');
        $html2pdf->pdf->SetSubject('');
        $html2pdf->pdf->SetKeywords($parameters['filename']);
        $html2pdf->pdf->SetDisplayMode('real');
        $html2pdf->writeHTML($view);

        $html2pdf->Output(sprintf('%s.pdf', $parameters['filename']));
        $response = new Response();
        $response->headers->set('Content-type' , 'application/pdf');

        return $response;
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