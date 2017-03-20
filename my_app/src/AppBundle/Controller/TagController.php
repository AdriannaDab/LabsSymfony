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
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     name="tag_index",
     * )
     * @Method("GET")
     */
    public function indexAction()
    {
        $tags = $this->get('app.repository.tag')->findAll();

        return $this->render(
            'tag/index.html.twig',
            ['tags' => $tags]
        );
    }

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