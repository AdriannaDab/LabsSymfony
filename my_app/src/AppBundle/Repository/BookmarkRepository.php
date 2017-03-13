<?php
/**
 * Bookmark repository.
 */
namespace AppBundle\Repository;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;

/**
 * Class BookmarkRepository.
 *
 * @package AppBundle\Repository
 */
class BookmarkRepository implements BookmarkRepositoryInterface
{
    /**
     * Bookmarks array
     *
     * @var array $bookmarks
     */
    protected $bookmarks = [
        [
            'url' => 'http://symfony.com',
            'tags' => [
                'PHP', 'framework', 'Symfony',
            ],
        ],
        [
            'url' => 'http://learngitbranching.js.org',
            'tags' => [
                'tools', 'Git', 'VCS', 'tutorials',
            ],
        ],
        [
            'url' => 'https://www.jetbrains.com/phpstorm',
            'tags' => [
                'tools', 'IDE', 'PHP',
            ],
        ],
        [
            'url' => 'http://twig.sensiolabs.org',
            'tags' => [
                'tools', 'templates', 'Twig', 'Symfony', 'PHP',
            ],
        ],
    ];

    /**
     * Find all bookmarks.
     *
     * @return array Result
     */
    public function findAll($page)
    {
        $adapter = new ArrayAdapter($this->bookmarks);
        $pagerfanta = new Pagerfanta($adapter);


        $pagerfanta->setMaxPerPage(1);
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

    /**
     * @param int $page
     *
     * @return Pagerfanta
     */
   /* public function findLatest($page = 1)
    {
        $paginator = new Pagerfanta(new DoctrineORMAdapter($this->Latest(), false));
        $paginator->setMaxPerPage(Post::NUM_ITEMS);
        $paginator->setCurrentPage($page);

        return $paginator;
    }
*/
}

