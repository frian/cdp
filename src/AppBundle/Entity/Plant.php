<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Plant
 *
 * @ORM\Table(name="plant")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlantRepository")
 */
class Plant
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
     * @Assert\Count(
     *      min = 1,
     *      minMessage = "You must specify at least one soil property",
     * )
     * @ORM\ManyToMany(targetEntity="Soil")
     */
    private $soil;

    /**
     * @var int
     *
     * @ORM\Column(name="seedsQuantity", type="integer", nullable=true)
     */
    private $seedsQuantity;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="SeedsQuantityUnit")
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
     * @ORM\ManyToOne(targetEntity="Watering")
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
     * @ORM\Column(name="harvestStart", type="integer")
     */
    private $harvestStart;

    /**
     * @var int
     *
     * @ORM\Column(name="harvestEnd", type="integer")
     */
    private $harvestEnd;

    /**
     * @var int
     *
     * @ORM\Column(name="timeToSproutStart", type="integer", nullable=true)
     */
    private $timeToSproutStart;

    /**
     * @var int
     *
     * @ORM\Column(name="timeToSproutEnd", type="integer", nullable=true)
     */
    private $timeToSproutEnd;

    /**
     * @var int
     *
     * @ORM\Column(name="timeToHarvestStart", type="integer", nullable=true)
     */
    private $timeToHarvestStart;

    /**
     * @var int
     *
     * @ORM\Column(name="timeToHarvestEnd", type="integer", nullable=true)
     */
    private $timeToHarvestEnd;

    /**
     * @var int
     *
     * @ORM\ManyToMany(targetEntity="Plant")
     * @ORM\JoinTable(name="plant_friandlyplants")
     */
    private $friendlyPlants;

    /**
     * @var int
     *
     * @ORM\ManyToMany(targetEntity="Plant")
     * @ORM\JoinTable(name="plant_enemyplants")
     */
    private $enemyPlants;

    /**
     * @var int
     *
     * @ORM\Column(name="tips", type="integer", nullable=true)
     */
    private $tips;


    public function __toString() {
        return $this->name;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->soil = new \Doctrine\Common\Collections\ArrayCollection();
        $this->friendlyPlants = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enemyPlants = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     *
     * @return Plant
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
     * Set seedsQuantity
     *
     * @param integer $seedsQuantity
     *
     * @return Plant
     */
    public function setSeedsQuantity($seedsQuantity)
    {
        $this->seedsQuantity = $seedsQuantity;

        return $this;
    }

    /**
     * Get seedsQuantity
     *
     * @return integer
     */
    public function getSeedsQuantity()
    {
        return $this->seedsQuantity;
    }

    /**
     * Set seedingDepth
     *
     * @param integer $seedingDepth
     *
     * @return Plant
     */
    public function setSeedingDepth($seedingDepth)
    {
        $this->seedingDepth = $seedingDepth;

        return $this;
    }

    /**
     * Get seedingDepth
     *
     * @return integer
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
     * @return Plant
     */
    public function setLineDistance($lineDistance)
    {
        $this->lineDistance = $lineDistance;

        return $this;
    }

    /**
     * Get lineDistance
     *
     * @return integer
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
     * @return Plant
     */
    public function setLineInterval($lineInterval)
    {
        $this->lineInterval = $lineInterval;

        return $this;
    }

    /**
     * Get lineInterval
     *
     * @return integer
     */
    public function getLineInterval()
    {
        return $this->lineInterval;
    }

    /**
     * Set underCoverStart
     *
     * @param integer $underCoverStart
     *
     * @return Plant
     */
    public function setUnderCoverStart($underCoverStart)
    {
        $this->underCoverStart = $underCoverStart;

        return $this;
    }

    /**
     * Get underCoverStart
     *
     * @return integer
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
     * @return Plant
     */
    public function setUnderCoverEnd($underCoverEnd)
    {
        $this->underCoverEnd = $underCoverEnd;

        return $this;
    }

    /**
     * Get underCoverEnd
     *
     * @return integer
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
     * @return Plant
     */
    public function setInGroundStart($inGroundStart)
    {
        $this->inGroundStart = $inGroundStart;

        return $this;
    }

    /**
     * Get inGroundStart
     *
     * @return integer
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
     * @return Plant
     */
    public function setInGroundEnd($inGroundEnd)
    {
        $this->inGroundEnd = $inGroundEnd;

        return $this;
    }

    /**
     * Get inGroundEnd
     *
     * @return integer
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
     * @return Plant
     */
    public function setPlantingStart($plantingStart)
    {
        $this->plantingStart = $plantingStart;

        return $this;
    }

    /**
     * Get plantingStart
     *
     * @return integer
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
     * @return Plant
     */
    public function setPlantingEnd($plantingEnd)
    {
        $this->plantingEnd = $plantingEnd;

        return $this;
    }

    /**
     * Get plantingEnd
     *
     * @return integer
     */
    public function getPlantingEnd()
    {
        return $this->plantingEnd;
    }

    /**
     * Set harvestStart
     *
     * @param integer $harvestStart
     *
     * @return Plant
     */
    public function setHarvestStart($harvestStart)
    {
        $this->harvestStart = $harvestStart;

        return $this;
    }

    /**
     * Get harvestStart
     *
     * @return integer
     */
    public function getHarvestStart()
    {
        return $this->harvestStart;
    }

    /**
     * Set harvestEnd
     *
     * @param integer $harvestEnd
     *
     * @return Plant
     */
    public function setHarvestEnd($harvestEnd)
    {
        $this->harvestEnd = $harvestEnd;

        return $this;
    }

    /**
     * Get harvestEnd
     *
     * @return integer
     */
    public function getHarvestEnd()
    {
        return $this->harvestEnd;
    }

    /**
     * Set timeToSproutStart
     *
     * @param integer $timeToSproutStart
     *
     * @return Plant
     */
    public function setTimeToSproutStart($timeToSproutStart)
    {
        $this->timeToSproutStart = $timeToSproutStart;

        return $this;
    }

    /**
     * Get timeToSproutStart
     *
     * @return integer
     */
    public function getTimeToSproutStart()
    {
        return $this->timeToSproutStart;
    }

    /**
     * Set timeToSproutEnd
     *
     * @param integer $timeToSproutEnd
     *
     * @return Plant
     */
    public function setTimeToSproutEnd($timeToSproutEnd)
    {
        $this->timeToSproutEnd = $timeToSproutEnd;

        return $this;
    }

    /**
     * Get timeToSproutEnd
     *
     * @return integer
     */
    public function getTimeToSproutEnd()
    {
        return $this->timeToSproutEnd;
    }

    /**
     * Set timeToHarvestStart
     *
     * @param integer $timeToHarvestStart
     *
     * @return Plant
     */
    public function setTimeToHarvestStart($timeToHarvestStart)
    {
        $this->timeToHarvestStart = $timeToHarvestStart;

        return $this;
    }

    /**
     * Get timeToHarvestStart
     *
     * @return integer
     */
    public function getTimeToHarvestStart()
    {
        return $this->timeToHarvestStart;
    }

    /**
     * Set timeToHarvestEnd
     *
     * @param integer $timeToHarvestEnd
     *
     * @return Plant
     */
    public function setTimeToHarvestEnd($timeToHarvestEnd)
    {
        $this->timeToHarvestEnd = $timeToHarvestEnd;

        return $this;
    }

    /**
     * Get timeToHarvestEnd
     *
     * @return integer
     */
    public function getTimeToHarvestEnd()
    {
        return $this->timeToHarvestEnd;
    }

    /**
     * Set tips
     *
     * @param integer $tips
     *
     * @return Plant
     */
    public function setTips($tips)
    {
        $this->tips = $tips;

        return $this;
    }

    /**
     * Get tips
     *
     * @return integer
     */
    public function getTips()
    {
        return $this->tips;
    }

    /**
     * Add soil
     *
     * @param \AppBundle\Entity\Soil $soil
     *
     * @return Plant
     */
    public function addSoil(\AppBundle\Entity\Soil $soil)
    {
        $this->soil[] = $soil;

        return $this;
    }

    /**
     * Remove soil
     *
     * @param \AppBundle\Entity\Soil $soil
     */
    public function removeSoil(\AppBundle\Entity\Soil $soil)
    {
        $this->soil->removeElement($soil);
    }

    /**
     * Get soil
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSoil()
    {
        return $this->soil;
    }

    /**
     * Set seedsQuantityUnit
     *
     * @param \AppBundle\Entity\SeedsQuantityUnit $seedsQuantityUnit
     *
     * @return Plant
     */
    public function setSeedsQuantityUnit(\AppBundle\Entity\SeedsQuantityUnit $seedsQuantityUnit = null)
    {
        $this->seedsQuantityUnit = $seedsQuantityUnit;

        return $this;
    }

    /**
     * Get seedsQuantityUnit
     *
     * @return \AppBundle\Entity\SeedsQuantityUnit
     */
    public function getSeedsQuantityUnit()
    {
        return $this->seedsQuantityUnit;
    }

    /**
     * Set watering
     *
     * @param \AppBundle\Entity\Watering $watering
     *
     * @return Plant
     */
    public function setWatering(\AppBundle\Entity\Watering $watering = null)
    {
        $this->watering = $watering;

        return $this;
    }

    /**
     * Get watering
     *
     * @return \AppBundle\Entity\Watering
     */
    public function getWatering()
    {
        return $this->watering;
    }

    /**
     * Add friendlyPlant
     *
     * @param \AppBundle\Entity\Plant $friendlyPlant
     *
     * @return Plant
     */
    public function addFriendlyPlant(\AppBundle\Entity\Plant $friendlyPlant)
    {
        $this->friendlyPlants[] = $friendlyPlant;

        return $this;
    }

    /**
     * Remove friendlyPlant
     *
     * @param \AppBundle\Entity\Plant $friendlyPlant
     */
    public function removeFriendlyPlant(\AppBundle\Entity\Plant $friendlyPlant)
    {
        $this->friendlyPlants->removeElement($friendlyPlant);
    }

    /**
     * Get friendlyPlants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFriendlyPlants()
    {
        return $this->friendlyPlants;
    }

    /**
     * Add enemyPlant
     *
     * @param \AppBundle\Entity\Plant $enemyPlant
     *
     * @return Plant
     */
    public function addEnemyPlant(\AppBundle\Entity\Plant $enemyPlant)
    {
        $this->enemyPlants[] = $enemyPlant;

        return $this;
    }

    /**
     * Remove enemyPlant
     *
     * @param \AppBundle\Entity\Plant $enemyPlant
     */
    public function removeEnemyPlant(\AppBundle\Entity\Plant $enemyPlant)
    {
        $this->enemyPlants->removeElement($enemyPlant);
    }

    /**
     * Get enemyPlants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnemyPlants()
    {
        return $this->enemyPlants;
    }
}
