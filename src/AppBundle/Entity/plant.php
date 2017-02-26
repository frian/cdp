<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * plant
 *
 * @ORM\Table(name="plant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\plantRepository")
 */
class plant
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="soil", type="integer")
     */
    private $soil;

    /**
     * @var int
     *
     * @ORM\Column(name="seedsQuantity", type="integer")
     */
    private $seedsQuantity;

    /**
     * @var int
     *
     * @ORM\Column(name="seedsQuantityUnit", type="integer")
     */
    private $seedsQuantityUnit;

    /**
     * @var int
     *
     * @ORM\Column(name="seedingDepth", type="integer")
     */
    private $seedingDepth;

    /**
     * @var int
     *
     * @ORM\Column(name="lineDistance", type="integer")
     */
    private $lineDistance;

    /**
     * @var int
     *
     * @ORM\Column(name="lineInterval", type="integer")
     */
    private $lineInterval;

    /**
     * @var int
     *
     * @ORM\Column(name="watering", type="integer")
     */
    private $watering;

    /**
     * @var int
     *
     * @ORM\Column(name="underCoverStart", type="integer", nullable=true)
     */
    private $underCoverStart;

    /**
     * @var int
     *
     * @ORM\Column(name="underCoverEnd", type="integer", nullable=true)
     */
    private $underCoverEnd;

    /**
     * @var int
     *
     * @ORM\Column(name="inGroundStart", type="integer", nullable=true)
     */
    private $inGroundStart;

    /**
     * @var int
     *
     * @ORM\Column(name="inGroundEnd", type="integer", nullable=true)
     */
    private $inGroundEnd;

    /**
     * @var int
     *
     * @ORM\Column(name="plantingStart", type="integer", nullable=true)
     */
    private $plantingStart;

    /**
     * @var int
     *
     * @ORM\Column(name="plantingEnd", type="integer", nullable=true)
     */
    private $plantingEnd;

    /**
     * @var int
     *
     * @ORM\Column(name="harverstStart", type="integer")
     */
    private $harverstStart;

    /**
     * @var int
     *
     * @ORM\Column(name="harvestEnd", type="integer")
     */
    private $harvestEnd;

    /**
     * @var int
     *
     * @ORM\Column(name="friendlyPlants", type="integer", nullable=true)
     */
    private $friendlyPlants;

    /**
     * @var int
     *
     * @ORM\Column(name="enemyPlants", type="integer", nullable=true)
     */
    private $enemyPlants;

    /**
     * @var int
     *
     * @ORM\Column(name="tips", type="integer", nullable=true)
     */
    private $tips;


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
     * @return plant
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
     * Set soil
     *
     * @param integer $soil
     *
     * @return plant
     */
    public function setSoil($soil)
    {
        $this->soil = $soil;

        return $this;
    }

    /**
     * Get soil
     *
     * @return int
     */
    public function getSoil()
    {
        return $this->soil;
    }

    /**
     * Set seedsQuantity
     *
     * @param integer $seedsQuantity
     *
     * @return plant
     */
    public function setSeedsQuantity($seedsQuantity)
    {
        $this->seedsQuantity = $seedsQuantity;

        return $this;
    }

    /**
     * Get seedsQuantity
     *
     * @return int
     */
    public function getSeedsQuantity()
    {
        return $this->seedsQuantity;
    }

    /**
     * Set seedsQuantityUnit
     *
     * @param integer $seedsQuantityUnit
     *
     * @return plant
     */
    public function setSeedsQuantityUnit($seedsQuantityUnit)
    {
        $this->seedsQuantityUnit = $seedsQuantityUnit;

        return $this;
    }

    /**
     * Get seedsQuantityUnit
     *
     * @return int
     */
    public function getSeedsQuantityUnit()
    {
        return $this->seedsQuantityUnit;
    }

    /**
     * Set seedingDepth
     *
     * @param integer $seedingDepth
     *
     * @return plant
     */
    public function setSeedingDepth($seedingDepth)
    {
        $this->seedingDepth = $seedingDepth;

        return $this;
    }

    /**
     * Get seedingDepth
     *
     * @return int
     */
    public function getSeedingDepth()
    {
        return $this->seedingDepth;
    }

    /**
     * Set lineDistance
     *
     * @param integer $lineDistance
     *
     * @return plant
     */
    public function setLineDistance($lineDistance)
    {
        $this->lineDistance = $lineDistance;

        return $this;
    }

    /**
     * Get lineDistance
     *
     * @return int
     */
    public function getLineDistance()
    {
        return $this->lineDistance;
    }

    /**
     * Set lineInterval
     *
     * @param integer $lineInterval
     *
     * @return plant
     */
    public function setLineInterval($lineInterval)
    {
        $this->lineInterval = $lineInterval;

        return $this;
    }

    /**
     * Get lineInterval
     *
     * @return int
     */
    public function getLineInterval()
    {
        return $this->lineInterval;
    }

    /**
     * Set watering
     *
     * @param integer $watering
     *
     * @return plant
     */
    public function setWatering($watering)
    {
        $this->watering = $watering;

        return $this;
    }

    /**
     * Get watering
     *
     * @return int
     */
    public function getWatering()
    {
        return $this->watering;
    }

    /**
     * Set underCoverStart
     *
     * @param integer $underCoverStart
     *
     * @return plant
     */
    public function setUnderCoverStart($underCoverStart)
    {
        $this->underCoverStart = $underCoverStart;

        return $this;
    }

    /**
     * Get underCoverStart
     *
     * @return int
     */
    public function getUnderCoverStart()
    {
        return $this->underCoverStart;
    }

    /**
     * Set underCoverEnd
     *
     * @param integer $underCoverEnd
     *
     * @return plant
     */
    public function setUnderCoverEnd($underCoverEnd)
    {
        $this->underCoverEnd = $underCoverEnd;

        return $this;
    }

    /**
     * Get underCoverEnd
     *
     * @return int
     */
    public function getUnderCoverEnd()
    {
        return $this->underCoverEnd;
    }

    /**
     * Set inGroundStart
     *
     * @param integer $inGroundStart
     *
     * @return plant
     */
    public function setInGroundStart($inGroundStart)
    {
        $this->inGroundStart = $inGroundStart;

        return $this;
    }

    /**
     * Get inGroundStart
     *
     * @return int
     */
    public function getInGroundStart()
    {
        return $this->inGroundStart;
    }

    /**
     * Set inGroundEnd
     *
     * @param integer $inGroundEnd
     *
     * @return plant
     */
    public function setInGroundEnd($inGroundEnd)
    {
        $this->inGroundEnd = $inGroundEnd;

        return $this;
    }

    /**
     * Get inGroundEnd
     *
     * @return int
     */
    public function getInGroundEnd()
    {
        return $this->inGroundEnd;
    }

    /**
     * Set plantingStart
     *
     * @param integer $plantingStart
     *
     * @return plant
     */
    public function setPlantingStart($plantingStart)
    {
        $this->plantingStart = $plantingStart;

        return $this;
    }

    /**
     * Get plantingStart
     *
     * @return int
     */
    public function getPlantingStart()
    {
        return $this->plantingStart;
    }

    /**
     * Set plantingEnd
     *
     * @param integer $plantingEnd
     *
     * @return plant
     */
    public function setPlantingEnd($plantingEnd)
    {
        $this->plantingEnd = $plantingEnd;

        return $this;
    }

    /**
     * Get plantingEnd
     *
     * @return int
     */
    public function getPlantingEnd()
    {
        return $this->plantingEnd;
    }

    /**
     * Set harverstStart
     *
     * @param integer $harverstStart
     *
     * @return plant
     */
    public function setHarverstStart($harverstStart)
    {
        $this->harverstStart = $harverstStart;

        return $this;
    }

    /**
     * Get harverstStart
     *
     * @return int
     */
    public function getHarverstStart()
    {
        return $this->harverstStart;
    }

    /**
     * Set harvestEnd
     *
     * @param integer $harvestEnd
     *
     * @return plant
     */
    public function setHarvestEnd($harvestEnd)
    {
        $this->harvestEnd = $harvestEnd;

        return $this;
    }

    /**
     * Get harvestEnd
     *
     * @return int
     */
    public function getHarvestEnd()
    {
        return $this->harvestEnd;
    }

    /**
     * Set friendlyPlants
     *
     * @param integer $friendlyPlants
     *
     * @return plant
     */
    public function setFriendlyPlants($friendlyPlants)
    {
        $this->friendlyPlants = $friendlyPlants;

        return $this;
    }

    /**
     * Get friendlyPlants
     *
     * @return int
     */
    public function getFriendlyPlants()
    {
        return $this->friendlyPlants;
    }

    /**
     * Set enemyPlants
     *
     * @param integer $enemyPlants
     *
     * @return plant
     */
    public function setEnemyPlants($enemyPlants)
    {
        $this->enemyPlants = $enemyPlants;

        return $this;
    }

    /**
     * Get enemyPlants
     *
     * @return int
     */
    public function getEnemyPlants()
    {
        return $this->enemyPlants;
    }

    /**
     * Set tips
     *
     * @param integer $tips
     *
     * @return plant
     */
    public function setTips($tips)
    {
        $this->tips = $tips;

        return $this;
    }

    /**
     * Get tips
     *
     * @return int
     */
    public function getTips()
    {
        return $this->tips;
    }
}
