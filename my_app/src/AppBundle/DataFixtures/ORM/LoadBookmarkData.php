<?php
/**
 * Data fixtures for bookmarks.
 */
namespace AppBundle\DataFixtures\ORM;
use AppBundle\Entity\Bookmark;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * Class LoadBookmarkData.
 *
 * @package AppBundle\DataFixtures\ORM
 */
class LoadBookmarkData extends AbstractFixture implements ContainerAwareInterface
{
    /**
     * Service container.
     *
     * @var \Symfony\Component\DependencyInjection\ContainerInterface|null $container
     */
    protected $container = null;
    /**
     * Set container.
     *
     * @param ContainerInterface|null $container Service container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $data = [
            'http://symfony.com',
            'http://learngitbranching.js.org',
            'https://www.jetbrains.com/phpstorm','url' => 'http://twig.sensiolabs.org',
        ];
        foreach ($data as $item) {
            $bookmark = new Bookmark();
            $bookmark->setUrl($item);
            $manager->persist($bookmark);
        }
        $manager->flush();
    }
}