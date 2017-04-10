<?php
/**
 * Created by PhpStorm.
 * User: adrianna
 * Date: 19.03.17
 * Time: 20:03
 */

/**
 * Tag entity.
 */
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Tag.
 *
 * @package AppBundle\Entity
 *
 * @ORM\Table(
 *     name="tags"
 * )
 * @ORM\Entity(
 *     repositoryClass="AppBundle\Repository\TagRepository"
 * )
 * @UniqueEntity(
 *     groups={"tag-default"},
 *     fields={"name"}
 * )
 */
class Tag
{

    /**
     * Bookmarks.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $bookmarks
     *
     * @ORM\ManyToMany(
     *     targetEntity="Bookmark",
     *     mappedBy="tags",
     * )
     */
    protected $bookmarks;

    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10; // ile tagow na str wyswietlam (stala)

    /**
     * Primary key.
     *
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(
     *     name="id",
     *     type="integer",
     *     nullable=false,
     *     options={"unsigned"=true},
     * )
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * Name.
     *
     * @var string $name
     *
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=128,
     *     nullable=false,
     * )
     *
     * @Assert\NotBlank(
     *     groups={"tag-default"}
     * )
     * @Assert\Length(
     *     groups={"tag-default"},
     *     min="3",
     *     max="128",
     * )
     */
    protected $name;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Tag
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->bookmarks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add bookmarks
     *
     * @param \AppBundle\Entity\Bookmark $bookmarks
     * @return Tag
     */
    public function addBookmark(\AppBundle\Entity\Bookmark $bookmarks)
    {
        $this->bookmarks[] = $bookmarks;

        return $this;
    }

    /**
     * Remove bookmarks
     *
     * @param \AppBundle\Entity\Bookmark $bookmarks
     */
    public function removeBookmark(\AppBundle\Entity\Bookmark $bookmarks)
    {
        $this->bookmarks->removeElement($bookmarks);
    }

    /**
     * Get bookmarks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBookmarks()
    {
        return $this->bookmarks;
    }
}
