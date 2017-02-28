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
use AppBundle\Entity\Watering;

/**
 * User fixture
 *
 * @author André Friedli <a@frian.org>
 */
class LoadWateringData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

    	$data = array(
    		0 => array(
    			'name' => 'modéré',
    		),
    		1 => array(
    			'name' => 'régulier',
    		),
            2 => array(
    			'name' => 'important',
    		),
            4 => array(
                'name' => 'limité',
            ),
            5 => array(
                'name' => 'très peu',
            ),
    	);

    	/**
    	 * Add users
    	 */
    	foreach ( $data as $index => $item ) {

	    	// create user
	        $entity = new Watering();
	        $entity->setName($item['name']);

	        // add reference for further fixtures
	        $this->addReference('Watering'.$index, $entity);

	    	$manager->persist($entity);
	    	$manager->flush();
    	}

    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
    	return 3; // the order in which fixtures will be loaded
    }
}
