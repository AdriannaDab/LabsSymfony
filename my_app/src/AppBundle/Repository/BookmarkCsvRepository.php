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
    public function findAll($page)
    {
       /* $csvData = file_get_contents("/home/adrianna/PhpstormProjects/LabsSymfony/my_app/src/AppBundle/Repository/data.csv");
        $lines = explode(PHP_EOL, $csvData);
        $bookmarks = array();
        foreach ($lines as $line) {
            $bookmarks[] = str_getcsv($line);
        }
        var_dump($bookmarks);
        return $bookmarks;*/
        $adapter = new ArrayAdapter($this->loadDate("/home/adrianna/PhpstormProjects/LabsSymfony/my_app/src/AppBundle/Repository/data.csv"));
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
        /*$csvData = file_get_contents("/home/adrianna/PhpstormProjects/LabsSymfony/my_app/src/AppBundle/Repository/data.csv");
        $lines = explode(PHP_EOL, $csvData);
        $bookmarks = array();
        foreach ($lines as $line) {
            $bookmarks[] = str_getcsv($line);
        }
        print_r($bookmarks);
        return isset($bookmarks[$id]) && count($bookmarks)
            ? $bookmarks[$id] : null;*/
        $bookmarks= $this->loadDate("/home/adrianna/PhpstormProjects/LabsSymfony/my_app/src/AppBundle/Repository/data.csv");

        return isset($bookmarks[$id]) && count($bookmarks)
            ? $bookmarks[$id] : null;
    }

    /**
     * Load bookmarks from csv file.
     *
     * @return array Result
     */
    public function loadDate($link)
    {
        $csvData = file_get_contents($link);
        $lines = explode(PHP_EOL, $csvData);
        $bookmarks = array();

        //  utworz tablicę z kluczami
        $keys = array();
        foreach (str_getcsv($lines[0]) as $value)
        {
            $keys[] = $value;
        }
        unset($lines[0]); // usuń linię z etykietami aby mieć same dane do wprowadzenia

        // wczytywanie danych do tablicy
        foreach ($lines as $line) {
            $date = str_getcsv($line);
            $ready = array();

            // zrób tablice asocjacyjną
            for($i = 0; $i<count($date); $i++)
            {
                $ready[$keys[$i]] = $date[$i];
            }

            // stworzenie array dla tag
            $ready["tags"] = split(",", $ready["tags"]);
            $bookmarks[] = $ready; // dodaj poprawny element do zbiorczej tablicy

            // wyczyść tablice tymczasowe
            $date = [];
            $ready = [];
        }

        return $bookmarks;
    }
}