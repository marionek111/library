<?php

namespace Charczuk\Library\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Books
 *
 * @ORM\Table(name="lib_books")
 * @ORM\Entity(repositoryClass="Charczuk\Library\BackendBundle\Entity\BooksRepository")
 */
class Books
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=150)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=150)
     */
    private $author;

    /**
     * @var integer
     *
     * @ORM\Column(name="yearRelease", type="integer")
     */
    private $yearRelease;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=64)
     */
    private $publisher;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * @param  string $name
     * @return Books
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
     * Set author
     *
     * @param  string $author
     * @return Books
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set yearRelase
     *
     * @param  integer $yearRelease
     * @return Books
     */
    public function setYearRelease($yearRelease)
    {
        $this->yearRelease = $yearRelease;

        return $this;
    }

    /**
     * Get yearRelase
     *
     * @return integer
     */
    public function getYearRelease()
    {
        return $this->yearRelease;
    }

    /**
     * Set publisher
     *
     * @param  string $publisher
     * @return Books
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set description
     *
     * @param  string $description
     * @return Books
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
