<?php
/**
 * Bookmark entity.
 */
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Class Bookmark.
 *
 * @package AppBundle\Entity
 *
 * @ORM\Table(
 * name="bookmarks"
 * )
 * @ORM\Entity(
 * repositoryClass="AppBundle\Repository\BookmarkRepository"
 * )
 * @UniqueEntity(
 * groups={"bookmark-default"},
 * fields={"url"}
 * )
 */
class Bookmark
{

    /**
     * Tags.
     *
     * @var \Doctrine\Common\Collections\ArrayCollection $tags
     *
     * @ORM\ManyToMany(
     *     targetEntity="Tag",
     *     inversedBy="bookmarks",
     * )
     * @ORM\JoinTable(
     *     name="bookmarks_tags"
     * )
     */
    /*inversedBy- wlsciciel, maptby w drugim*/
    protected $tags;

    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See http://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;
    /**
     * Primary key.
     *
     * @var integer $id
     *
     * @ORM\Id
     * @ORM\Column(
     * name="id",
     * type="integer",
     * nullable=false,
     * options={"unsigned"=true},
     * )
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;



    /**
     * Url.
     *
     * @var string $url
     *
     * @ORM\Column(
     * name="url",
     * type="string",
     * length=255,
     * nullable=false,
     * )
     *
     * @Assert\NotBlank(
     * groups={"url-default"}
     * )
     * @Assert\Length(
     * groups={"url-default"},
     * min="3",
     * max="255",
     * )
     */
    protected $url;




    /**
     * Created at.
     *
     * @var \DateTime $createdAt
     *
     * @ORM\Column(
     *     name="created_at",
     *     type="datetime",
     *     nullable=true,
     * )
     * @Gedmo\Timestampable(
     *     on="create",
     * )
     */
    protected $createdAt;

    /**
     * Modified at.
     *
     * @var \DateTime $modifiedAt
     *
     * @ORM\Column(
     *     name="modified_at",
     *     type="datetime",
     *     nullable=true,
     * )
     * @Gedmo\Timestampable(
     *     on="update",
     * )
     */
    protected $modifiedAt;

    /**
     * Is_public.
     *
     * @var string $is_public
     *
     * @ORM\Column(columnDefinition="TINYINT DEFAULT 1"
     * )
     *
     */
    protected $is_public;


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
     * Set url
     *
     * @param string $url
     * @return Bookmark
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }
    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tags
     *
     * @param \AppBundle\Entity\Tag $tags
     * @return Bookmark
     */
    public function addTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \AppBundle\Entity\Tag $tags
     */
    public function removeTag(\AppBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}
