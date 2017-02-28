<?php

/**
 * This file is part of the TimeTM package.
 *
 * (c) TimeTM <https://github.com/timetm>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\DataFixtures\ORM\dev;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Plant;

/**
 * User fixture
 *
 * @author André Friedli <a@frian.org>
 */
class LoadPlantData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

        // -- load csv
        // --   [0]  name
        // --   [1]  soil
        // --   [2]  seedsQuantiy
        // --   [3]  seedsQuantityUnit
        // --   [4]  seedingDepth
        // --   [5]  lineDistance
        // --   [6]  lineInterval
        // --   [7]  watering
        // --   [8]  underCoverStart
        // --   [9]  inGroundStart
        // --   [10] plantingStart
        // --   [11] harvestStart
        // --   [12] timeToSprout
        // --   [13] timeToHarvest

    	$data = array_map('str_getcsv', file('/home/lpa/atinfo/projects/cdp/calendrier-du-potager.csv'));

        // -- remove header
        array_shift($data);

    	/**
    	 * Add entites
    	 */
    	foreach ( $data as $index => $item ) {

            /*
            *  Soils
            */
            $soilStrings = [$item[1]];

            if (strpos($soilStrings[0], ',') !== false) {
                $soilStrings = array_map('trim', explode(",", $soilStrings[0]));
            }

            foreach ($soilStrings as $key => $value) {
                $soilStrings[$key] = $manager->getRepository('AppBundle:Soil')->findOneByName($value);
            }


            /*
            *  Dates
            */
            $underCoverStart = null;
            $underCoverEnd = null;

            if ( ! empty($item[8])) {
                list( $undeCoverStart, $undeCoverEnd ) = array_map('trim', explode("-", $item[8]));
            }

            $inGroundStart = null;
            $inGroundEnd = null;

            if ( ! empty($item[9])) {
                list( $inGroundStart, $inGroundEnd ) = array_map('trim', explode("-", $item[9]));
            }

            $plantationStart = null;
            $plantationEnd = null;

            if ( ! empty($item[10])) {
                list( $plantationStart, $plantationEnd ) = array_map('trim', explode("-", $item[10]));
            }

            $harvestStart = null;
            $harvestEnd = null;

            if ( ! empty($item[11])) {
                list( $harvestStart, $harvestEnd ) = array_map('trim', explode("-", $item[11]));
            }


            // -- seedsQuantity
            if ( empty($item[2])) {
                $item[2] = null;
            }

            // -- timeToSprout
            if ( empty($item[12])) {
                $item[12] = null;
            }

            // -- timeToHarvest
            if ( empty($item[13])) {
                $item[13] = null;
            }


	    	// create entity
	        $entity = new PLant();
	        $entity->setName($item[0]);

            foreach ($soilStrings as $soil) {
                $entity->addSoil($soil);
            }

            $entity->setSeedsQuantity($item[2]);
            $entity->setSeedsQuantityUnit($manager->getRepository('AppBundle:SeedsQuantityUnit')->findOneByName($item[3]));
            $entity->setSeedingDepth($item[4]);
            $entity->setLineDistance($item[5]);
            $entity->setLineInterval($item[6]);
            $entity->setWatering($manager->getRepository('AppBundle:Watering')->findOneByName($item[7]));
            $entity->setUnderCoverStart($underCoverStart);
            $entity->setUnderCoverEnd($underCoverEnd);
            $entity->setInGroundStart($inGroundStart);
            $entity->setInGroundEnd($inGroundEnd);
            $entity->setPlantingStart($plantationStart);
            $entity->setPlantingEnd($plantationEnd);
            $entity->setHarvestStart($harvestStart);
            $entity->setHarvestEnd($harvestEnd);
            $entity->setTimeToSprout($item[12]);
            $entity->setTimeToHarvest($item[13]);

	        // -- add reference for further fixtures
	        $this->addReference('Plant'.$index, $entity);

	    	$manager->persist($entity);
	    	$manager->flush();
    	}

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
    	return 10; // the order in which fixtures will be loaded
    }
}
