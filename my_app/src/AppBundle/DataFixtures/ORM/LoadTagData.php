<?php
/**
 * Data fixtures for tags.
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class LoadTagData.
 *
 * @package AppBundle\DataFixtures\ORM
 */
class LoadTagData extends AbstractFixture implements ContainerAwareInterface
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
            'framework',
            'Git',
            'IDE',
            'PHP',
            'Symfony',
            'templates',
            'tools',
            'tutorials',
            'Twig',
            'VCS',
        ];

        foreach ($data as $item) {
            $tag = new Tag();
            $tag->setName($item);
            $manager->persist($tag);
        }
        $manager->flush();
    }

}