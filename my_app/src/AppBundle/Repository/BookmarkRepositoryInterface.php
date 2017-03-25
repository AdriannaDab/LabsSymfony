<?php

namespace AppBundle\Repository;

interface BookmarkRepositoryInterface
{
    public function findAll();
    public function findOneById($id);



}