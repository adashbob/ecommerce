<?php


namespace Pages\PagesBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintsCheckUrl extends Constraint
{
    public $message = 'Le message contient des liens non valides';

    public function validatedBy()
    {
        return 'validatorCheckUrl';
    }

}