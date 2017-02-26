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
use AppBundle\Entity\Soil;

/**
 * User fixture
 *
 * @author André Friedli <a@frian.org>
 */
class LoadSoilData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

    	$Soils = array(
    		0 => array(
    			'name' => 'riche',
    		),
    		1 => array(
    			'name' => 'léger',
    		),
            2 => array(
    			'name' => 'profond',
    		)
    	);

    	/**
    	 * Add users
    	 */
    	foreach ( $Soils as $index => $SoilData ) {

	    	// create user
	        $Soil = new Soil();
	        $Soil->setName($SoilData['name']);

	        // add reference for further fixtures
	        $this->addReference('Soil'.$index, $Soil);

	    	$manager->persist($Soil);
	    	$manager->flush();
    	}

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
    	return 2; // the order in which fixtures will be loaded
    }
}
