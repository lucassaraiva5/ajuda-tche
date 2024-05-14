<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateStringToDateTimeTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof \DateTime) {
            throw new TransformationFailedException('Expected a \DateTime.');
        }

        return $value->format('d/m/Y');
    }

    public function reverseTransform($value)
    {
        if (!$value) {
            return null;
        }

        $date = \DateTime::createFromFormat('d/m/Y', $value);

        if (!$date || $date->format('d/m/Y') !== $value) {
            throw new TransformationFailedException('Invalid date format.');
        }

        return $date;
    }
}