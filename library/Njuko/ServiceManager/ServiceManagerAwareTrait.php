<?php
/**
 * ServiceManagerAwareTrait
 *
 * @package     ${NAMESPACE}
 * @author      Amélie Husson < amelie.husson@njuko.com >
 * @creation    26/03/13
 * @copyright   Copyright (c) Anewco - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Njuko\ServiceManager;

use Zend\ServiceManager\ServiceManager;

/**
 * ServiceManagerAwareTrait
 * Concrete implementation of the ServiceManagerAwareInterface
 *
 * @package     Njuko\ServiceManager
 * @author      Amélie Husson < amelie.husson@njuko.com >
 * @copyright   Copyright (c) Anewco - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
trait ServiceManagerAwareTrait
{
    /**
     * @var ServiceManager
     */
    protected $sm = null;

    /**
     * Set service manager
     *
     * @param ServiceManager $sm
     *
     * @return $this
     */
    public function setServiceManager(ServiceManager $sm)
    {
        $this->sm = $sm;
        return $this;
    }

    /*
     * Get service manager
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->sm;
    }
}