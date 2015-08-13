<?php

namespace TestAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personel
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Personel
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
     * @ORM\Column(name="imie", type="string", length=255)
     */
    private $imie;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwisko", type="string", length=255)
     */
    private $nazwisko;

    /**
     * @var integer
     *
     * @ORM\Column(name="wiek", type="integer")
     */
    private $wiek;


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
     * Set imie
     *
     * @param string $imie
     * @return Personel
     */
    public function setImie($imie)
    {
        $this->imie = $imie;

        return $this;
    }

    /**
     * Get imie
     *
     * @return string 
     */
    public function getImie()
    {
        return $this->imie;
    }

    /**
     * Set nazwisko
     *
     * @param string $nazwisko
     * @return Personel
     */
    public function setNazwisko($nazwisko)
    {
        $this->nazwisko = $nazwisko;

        return $this;
    }

    /**
     * Get nazwisko
     *
     * @return string 
     */
    public function getNazwisko()
    {
        return $this->nazwisko;
    }

    /**
     * Set wiek
     *
     * @param integer $wiek
     * @return Personel
     */
    public function setWiek($wiek)
    {
        $this->wiek = $wiek;

        return $this;
    }

    /**
     * Get wiek
     *
     * @return integer 
     */
    public function getWiek()
    {
        return $this->wiek;
    }
}
