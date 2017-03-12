<?php
/**
 * Bookmark controller.
 */

namespace AppBundle\Controller;

use AppBundle\Repository\BookmarkRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

/**
 * Class BookmarkController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/bookmark") # wszystkie a potem doprecyzuje
 */
class BookmarkController extends Controller //rozszerza bazowy kontroler
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     name="bookmark_index"
     * )
     */
    public function indexAction()
    {
        $bookmarks = $this->get('app.repository.bookmark')->findAll();

        return $this->render(
            'bookmark/index.html.twig',
            ['bookmarks' => $bookmarks]
        );
    }

    /**
    public function indexAction()
    {
        $bookmarkRepository = new BookmarkRepository();
        $bookmarks = $bookmarkRepository->findAll();

        return $this->render(
            'bookmark/index.html.twig',
            ['bookmarks' => $bookmarks]
        );
    }
     **/

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
     *     name="bookmark_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="bookmark_index_paginated",
     * )
     * @Method("GET")
     *//**
    public function indexAction($page)
    {
        $bookmarkRepository = new BookmarkRepository();
        $bookmarks = $bookmarkRepository->findAll();

        return $this->render(
            'bookmark/index.html.twig',
            ['bookmarks' => $bookmarks]
        );
    }
    **/

    /**
     * View action.
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/{id}",
     *     name="bookmark_view"
     * )
     */
    public function viewAction($id)
    {

        $bookmark = $this->get('app.repository.bookmark')->findOneById($id);

        return $this->render(
            'bookmark/view.html.twig',
            [
                'bookmark' => $bookmark,
                'id' => $id,
            ]
        );
    }

}