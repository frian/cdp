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
use AppBundle\Entity\SeedsQuantityUnit;

/**
 * User fixture
 *
 * @author André Friedli <a@frian.org>
 */
class LoadSeedsQuantityUnitData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {

    	$data = array(
    		0 => array(
    			'name' => 'g',
    		),
    		1 => array(
    			'name' => 'kg',
    		),
    	);

    	/**
    	 * Add users
    	 */
    	foreach ( $data as $index => $item ) {

	    	// create user
	        $entity = new SeedsQuantityUnit();
	        $entity->setName($item['name']);

	        // add reference for further fixtures
	        $this->addReference('SeedsQuantityUnit'.$index, $entity);

	    	$manager->persist($entity);
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
