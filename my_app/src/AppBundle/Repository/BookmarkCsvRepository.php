<?php
/**
 * Created by PhpStorm.
 * User: adrianna
 * Date: 19.03.17
 * Time: 20:08
 */
/**
 * Bookmark CSV repository.
 */
namespace AppBundle\Repository;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

/**
 * Class BookmarkRepository.
 *
 * @package AppBundle\Repository
 */
class BookmarkCsvRepository
{
    /**
     * Bookmarks array
     *
     * @var array $bookmarks
     */

    function csv_to_array($csv, $delimiter=',')
    {
        $csv = array_map('str_getcsv', file(data.csv));
    }

    /**
     * Find all bookmarks.
     *
     * @return array Result
     */
    public function findAll($page)
    {
        $adapter = new ArrayAdapter($this->bookmarks);
        $pagerfanta = new Pagerfanta($adapter);


        $pagerfanta->setMaxPerPage(2);
        $pagerfanta ->setCurrentPage($page);

        return $pagerfanta;


    }

    /**
     * Find single record by its id.
     *
     * @param integer $id Single record index
     *
     * @return array Result
     */
    public function findOneById($id)
    {
        return isset($this->bookmarks[$id]) && count($this->bookmarks)
            ? $this->bookmarks[$id] : null;
    }

}