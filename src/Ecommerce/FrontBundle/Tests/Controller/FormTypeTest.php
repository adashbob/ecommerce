<?php


namespace Ecommerce\FrontBundle\Tests\Controller;


use Ecommerce\FrontBundle\Form\Type\ProduitType;
use Symfony\Component\Form\Test\TypeTestCase;

class FormTypeTest extends TypeTestCase
{

    public function testSubmitValidData()
    {
        $formData = array(
            'test' => 'carotte',
            'description' => 'test2'
        );

        $form = $this->factory->createNamed(ProduitType::class);

        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }

}