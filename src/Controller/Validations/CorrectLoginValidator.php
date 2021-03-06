<?php
/**
 * Created by PhpStorm.
 * User: Erik
 * Date: 05/05/2017
 * Time: 14:03
 */

namespace SilexApp\Controller\Validations;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class CorrectLoginValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if($this->isValid($value)){
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ string}}',$value)
                ->addViolation();
        }
    }

    public function isValid($value)
    {
        $correct = false;
        //Html - string conversion
        $value = htmlentities($value);
        //ToDo: only alphanumeric characters
        //First check if it's mail filter_var (VALIDATE_EMAIL)
        if(filter_var($value,FILTER_VALIDATE_EMAIL)){
            return $correct;
        }
        else{
            if(strlen($value) > 20) {
                $correct = true;
            }
            return $correct;
        }
    }
}