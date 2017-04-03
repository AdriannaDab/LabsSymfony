<?php
/**
 * Bookmark controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Bookmark;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\BookmarkType;


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
/*
    public function indexAction()
    {
        $bookmarks = $this->get('app.repository.bookmark')->findAll();

        return $this->render(
            'bookmark/index.html.twig',
            ['bookmarks' => $bookmarks]
        );
    }
*/
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
     */

    public function indexAction($page)
    {
        $bookmarks = $this->get('app.repository.bookmark')->findAllPaginated($page);

        return $this->render(
            'bookmark/index.html.twig',
            ['bookmarks' => $bookmarks]
        );
    }


    /**
     * View action.
     *
     * @param Bookmark $bookmark Bookmark entity
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/view/{id}",
     *     name="bookmark_view"
     * )
     */
    public function viewAction(Bookmark $bookmark)
    {
        return $this->render(
            'bookmark/view.html.twig',
            [
                'bookmark' => $bookmark,
            ]
        );
    }


    /**
     * Add action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/add",
     *     name="bookmark_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
        //get jak pierwszy raz wyswietlam, post za kazdym razem jak ciskam zapisz
    {
        $bookmark = new Bookmark(); //tworze encje pusta
        $form = $this->createForm(BookmarkType::class, $bookmark); //tworze nowy form klasy tagtype i przekazuje encje
        $form->handleRequest($request);//hydracja

        if ($form->isSubmitted() && $form->isValid()) { //jesli jest wyslany i poprawny
            $this->get('app.repository.bookmark')->save($bookmark);//to zapiszemy
            $this->addFlash('success_created', 'message.created_successfully');//pojawia sie flash success

            return $this->redirectToRoute('bookmark_index');
        }

        return $this->render(
            'bookmark/add.html.twig',
            [
                'bookmark' => $bookmark,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Edit action.
     *
     * @param Bookmark $bookmark Bookmark entity
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/edit",
     *     requirements={"id": "[1-9]\d*"},
     *     name="bookmark_edit",
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Bookmark $bookmark)
    {
        $form = $this->createForm(BookmarkType::class, $bookmark);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.bookmark')->save($bookmark);
            $this->addFlash('success_edited', 'message.edited_successfully');

            return $this->redirectToRoute('bookmark_index');
        }

        return $this->render(
            'bookmark/edit.html.twig',
            [
                'bookmark' => $bookmark,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Bookmark $bookmark Bookmark entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     requirements={"id": "[1-9]\d*"},
     *     name="bookmark_delete",
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Bookmark $bookmark)
    {
        $form = $this->createForm(FormType::class, $bookmark);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.bookmark')->delete($bookmark);
            $this->addFlash('danger', 'message.deleted_successfully');

            return $this->redirectToRoute('bookmark_index');
        }

        return $this->render(
            'bookmark/delete.html.twig',
            [
                'bookmark' => $bookmark,
                'form' => $form->createView(),
            ]
        );

    }

}