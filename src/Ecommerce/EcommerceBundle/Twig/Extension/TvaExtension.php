<?php


namespace Ecommerce\EcommerceBundle\Twig\Extension;


class TvaExtension extends \Twig_Extension
{
    protected $twig;

    public function __construct(\Twig_Environment $twig){
        $this->twig = $twig;
    }

    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('tva', array($this, 'calculTva')));
    }

    public function calculTva($prixHt, $tva){
        return $prixHt / $tva;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'ecommerce_twig_extension';
    }
}