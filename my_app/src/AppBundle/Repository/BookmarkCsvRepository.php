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
 * Class BookmarkCsvRepository.
 *
 * @package AppBundle\Repository
 */
class BookmarkCsvRepository implements BookmarkRepositoryInterface
{
    /**
     * Find all bookmarks.
     *
     * @return array Result
     */
    public function findAll()
    {
        $csvData = file_get_contents("/home/adrianna/PhpstormProjects/LabsSymfony/my_app/src/AppBundle/Repository/data.csv");
        $lines = explode(PHP_EOL, $csvData);
        $bookmarks = array();
        foreach ($lines as $line) {
            $bookmarks[] = str_getcsv($line);
        }
        var_dump($bookmarks);
        return $bookmarks;
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
        $csvData = file_get_contents("/home/adrianna/PhpstormProjects/LabsSymfony/my_app/src/AppBundle/Repository/data.csv");
        $lines = explode(PHP_EOL, $csvData);
        $bookmarks = array();
        foreach ($lines as $line) {
            $bookmarks[] = str_getcsv($line);
        }
        print_r($bookmarks);
        return isset($bookmarks[$id]) && count($bookmarks)
            ? $bookmarks[$id] : null;
    }
}