<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Gedmo\Mapping\Annotation as Gedmo;
use AppBundle\Entity\Bookmark;
/**
 * BookmarkRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BookmarkRepository extends EntityRepository
{

    /**
     * Gets all records paginated.
     *
     * @param int $page Page number
     *
     * @return \Pagerfanta\Pagerfanta Result
     */
    public function findAllPaginated($page)
    {

        $adapter = new DoctrineORMAdapter(
            $this->queryAll()
        );

        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(2);
        $pagerfanta ->setCurrentPage($page);

        return $pagerfanta;
    }

    protected function queryAll()
    {
        return $this -> _em -> createQueryBuilder()
            ->select('t')
            ->from('AppBundle:Bookmark', 't');
    }


    /**
     * Save entity.
     *
     * @param Bookmark $bookmark Bookmark entity
     */
    public function save(Bookmark $bookmark)
    {
        $this->_em->persist($bookmark);
        $this->_em->flush();
    }

    /**
     * Delete entity.
     *
     * @param Bookmark $bookmark Bookmark entity
     */
    public function delete(Bookmark $bookmark)
    {
        $this->_em->remove($bookmark);
        $this->_em->flush();
    }
}