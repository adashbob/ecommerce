<?php


namespace Pages\PagesBundle\Validator\Constraints;

use Pages\PagesBundle\Services\CurlUrl;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintsCheckUrlValidator extends ConstraintValidator
{
    private $curl;

    public function __construct(CurlUrl $curlUrl)
    {
        $this->curl = $curlUrl;
    }

    public function validate($value, Constraint $constraint)
    {
        if ($this->curl->findUrl($value)) {
            $this->context->addViolation($constraint->message);
        }
    }
}