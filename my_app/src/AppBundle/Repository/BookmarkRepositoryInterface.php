<?php

namespace AppBundle\Repository;

interface BookmarkRepositoryInterface
{
    public function findAll($page);
    public function findOneById($id);



}