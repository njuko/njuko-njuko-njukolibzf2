<?php
/**
 * ServiceManagerAwareTraitTest
 *
 * @package     Njuko\ServiceManager
 * @author      Amélie Husson < amelie.husson@njuko.com >
 * @creation    26/03/13
 * @copyright   Copyright (c) Anewco - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Njuko\ServiceManager;

class ServiceManagerAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    /*
     * @var ServiceManagerAwareTrait
     */
    protected $instance;

    public function setup()
    {
        $this->instance = $this->getObjectForTrait('Njuko\ServiceManager\ServiceManagerAwareTrait');
    }

    public function testGetServiceManager()
    {
        $sm = $this->getMock('Zend\ServiceManager\ServiceManager');

        $this->assertEquals($sm, $this->instance->getServiceManager());
    }

    public function testSetServiceManager()
    {
        $sm = $this->getMock('Zend\ServiceManager\ServiceManager');

        $this->assertEquals($this->instance->setServiceManager($sm), $this->instance);
    }
}
