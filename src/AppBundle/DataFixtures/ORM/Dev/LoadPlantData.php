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


            $watering = $manager->getRepository('AppBundle:Watering')->findOneByName($item[7]);


	    	// create entity
	        $entity = new PLant();
	        $entity->setName($item[0]);

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
