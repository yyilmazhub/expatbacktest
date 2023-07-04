<?php

namespace App\Service;

use Symfony\Component\Form\FormInterface;

class FormErrorService
{
    public function getErrorMessages(FormInterface $form): array
    {
        $errors = [];

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $childForm) {
            if (!$childForm->isValid()) {
                $errors[$childForm->getName()] = $this->getErrorMessages($childForm);
            }
        }

        return $errors;
    }
}
