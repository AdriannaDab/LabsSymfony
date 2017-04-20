<?php

namespace AppBundle\Form;

use AppBundle\Entity\Tag;
use AppBundle\Repository\TagRepository;
use Symfony\Component\Form\DataTransformerInterface;

class TagTransformer implements DataTransformerInterface
{
    protected $repository;

//    public function __construct(TagRepository $repository)
//    {
//        $this->repository = $repository;
//    }
//
//    public  function transform($value)
//    {
//
//        $result = '';
//        foreach ($value as $tag) {
//              $result .= $tag->getName().', ';
//        }
//        return $result;
//    }

//    public function reverseTransform($value)
//    {
//        dump('RT');
//        dump($value);
//        return explode(', ', $value);
//
//    }


    /**
     * Tag repository.
     *
     * @var TagRepository|null $tagRepository
     */
    protected $tagRepository = null;

    /**
     * TagsDataTransformer constructor.
     *
     * @param TagRepository $tagRepository Tag repository
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * Transform array of tags to string of names.
     *
     * @param array $tags Tags entity array
     *
     * @return string Result
     */
    public function transform($tags)
    {
        if (null == $tags) {
            return '';
        }

        $tagNames = [];

        foreach ($tags as $tag) {
            $tagNames[] = $tag->getName();
        }

        return implode(',', $tagNames);
    }

    /**
     * Transform string of tag names into array of Tag entities.
     *
     * @param string $string String of tag names
     *
     * @return array Result
     */
    public function reverseTransform($string)
    {
        $tagNames = explode(',', $string);

        $tags = [];
        foreach ($tagNames as $tagName) {
            if (trim($tagName) !== '') {
                $tag = $this->tagRepository->findOneByName($tagName);
                if (null == $tag) {
                    $tag = new Tag();
                    $tag->setName($tagName);
                    $this->tagRepository->save($tag);
                }
                $tags[] = $tag;
            }
        }

        return $tags;
    }
}