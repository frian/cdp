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

    	$data = array(
    		0 => array(
    			'name' => 'riche',
    		),
    		1 => array(
    			'name' => 'léger',
    		),
            2 => array(
    			'name' => 'profond',
    		),
            3 => array(
    			'name' => 'bien drainé',
    		),
            5 => array(
                'name' => 'frais',
            ),
            6 => array(
                'name' => 'lourd',
            ),
            7 => array(
    			'name' => 'drainé',
    		),
            8 => array(
    			'name' => 'peu calcaire',
    		),
            9 => array(
    			'name' => 'ferme',
    		),
            10 => array(
                'name' => 'meuble',
            ),
            11 => array(
                'name' => 'neutre',
            ),
    	);

    	/**
    	 * Add users
    	 */
    	foreach ( $data as $index => $item ) {

	    	// create user
	        $entity = new Soil();
	        $entity->setName($item['name']);

	        // add reference for further fixtures
	        $this->addReference('Soil'.$index, $entity);

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
