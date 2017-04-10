<?php

namespace AppBundle\Form;

use AppBundle\Repository\TagRepository;
use Symfony\Component\Form\DataTransformerInterface;

class TagTransformer implements DataTransformerInterface
{
    protected $repository;

    public function __construct(TagRepository $repository)
    {
        $this->repository = $repository;
    }

    public  function transform($value)
    {

        $result = '';
        foreach ($value as $tag) {
              $result .= $tag->getName().', ';
        }
        return $result;






    }

    public function reverseTransform($value)
    {
        dump('RT');
        dump($value);
        return explode(', ', $value);

    }
}