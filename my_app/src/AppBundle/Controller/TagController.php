<?php
/**
 * Tag controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class TagController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/tag")
 */
class TagController extends Controller
{
    /**
     * Index action.
     *
     * @param integer $page Current page number
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     defaults={"page": 1},
     *     name="tag_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="tag_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $tags = $this->get('app.repository.tag')->findAllPaginated($page);

        #dump($tags);

        return $this->render(
            'tag/index.html.twig',
            ['tags' => $tags]
        );
    }


    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     name="tag_index",
     * )
     * @Method("GET")
     */
   /* public function indexAction()
    {
        $tags = $this->get('app.repository.tag')->findAll();

        return $this->render(
            'tag/index.html.twig',
            ['tags' => $tags]
        );
    }*/

    /**
     * View action.
     *
     * @param Tag $tag Tag entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}",
     *     requirements={"id": "[1-9]\d*"},
     *     name="tag_view",
     * )
     * @Method("GET")
     */
    public function viewAction(Tag $tag)
    {
        return $this->render(
            'tag/view.html.twig',
            ['tag' => $tag]
        );
    }
}