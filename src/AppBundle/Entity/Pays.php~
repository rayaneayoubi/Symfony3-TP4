<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pays
 *
 * @ORM\Table(name="pays")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PaysRepository")
 */
class Pays
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Pays
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Producers", inversedBy="pays")
     *@ORM\JoinColumn(name="producers_id", referencedColumnName="id")
     */
    private $producers;


    /**
     * Set producers
     *
     * @param \AppBundle\Entity\Producers $producers
     *
     * @return Pays
     */
    public function setProducers(\AppBundle\Entity\Producers $producers = null)
    {
        $this->producers = $producers;

        return $this;
    }

    /**
     * Get producers
     *
     * @return \AppBundle\Entity\Producers
     */
    public function getProducers()
    {
        return $this->producers;
    }
}
