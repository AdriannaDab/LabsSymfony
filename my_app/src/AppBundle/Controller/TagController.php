<?php
/**
 * Tag controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TagType;

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

//        dump($tags);

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

    /**
     * Add action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/add",
     *     name="tag_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
        //get jak pierwszy raz wyswietlam, post za kazdym razem jak ciskam zapisz
    {
        $tag = new Tag(); //tworze encje pusta
        $form = $this->createForm(TagType::class, $tag); //tworze nowy form klasy tagtype i przekazuje encje
        $form->handleRequest($request);//hydracja

        if ($form->isSubmitted() && $form->isValid()) { //jesli jest wyslany i poprawny
            $this->get('app.repository.tag')->save($tag);//to zapiszemy
            $this->addFlash('success_created', 'message.created_successfully');//pojawia sie flash success

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'tag/add.html.twig',
            [
                'tag' => $tag,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Edit action.
     *
     * @param Tag $tag Tag entity
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/edit",
     *     requirements={"id": "[1-9]\d*"},
     *     name="tag_edit",
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tag $tag)
    {
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.tag')->save($tag);
            $this->addFlash('success_edited', 'message.edited_successfully');

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'tag/edit.html.twig',
            [
                'tag' => $tag,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param Tag $tag Tag entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     requirements={"id": "[1-9]\d*"},
     *     name="tag_delete",
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request, Tag $tag)
    {
        $form = $this->createForm(FormType::class, $tag);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.tag')->delete($tag);
            $this->addFlash('danger', 'message.deleted_successfully');

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'tag/delete.html.twig',
            [
                'tag' => $tag,
                'form' => $form->createView(),
            ]
        );

    }
}