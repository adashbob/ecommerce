<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';

AnnotationRegistry::registerLoader([$loader, 'loadClass']);

//  html2pdf
$loader->add('Html2Pdf_', __DIR__.'/../vendor/html2pdf/lib');
$loader->register();
// Bobo

return $loader;
