<?php


namespace Ecommerce\FrontBundle\Twig\Extension;


abstract class BaseTwigExtension extends \Twig_Extension
{
    protected $twig;

    public function setTwigEvironment(\Twig_Environment $twig){
        $this->twig = $twig;
    }


}