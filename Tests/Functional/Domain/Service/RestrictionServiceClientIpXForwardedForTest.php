<?php
namespace Aoe\FeloginBruteforceProtection\Tests\Functional\Domain\Service;

/***************************************************************
 * Copyright notice
 *
 * (c) 2019 AOE GmbH <dev@aoe.com>
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * @package Aoe\FeloginBruteforceProtection\Domain\Service
 */
class RestrictionServiceClientIpXForwardedForTest extends RestrictionServiceClientIpAbstract
{
    /**
     * (non-PHPdoc)
     */
    public function setUp()
    {
        parent::setUp();
        $this->configuration->expects($this->any())->method('getXForwardedFor')->will($this->returnValue(true));
    }

    /**
     * @test
     * @dataProvider dataProviderIsClientRestrictedWithExcludedIp
     * @param string $clientIp
     * @param array $excludedIPs
     * @param boolean $shouldClientRestricted
     */
    public function isClientRestrictedWithExcludedIpWithoutCIRD($clientIp, array $excludedIPs, $shouldClientRestricted)
    {
        $this->configuration->expects($this->any())->method('getExcludedIps')->will($this->returnValue($excludedIPs));
        $this->inject($this->restriction, 'configuration', $this->configuration);

        $_SERVER['HTTP_X_FORWARDED_FOR'] = $clientIp;

        $this->assertNotEquals($shouldClientRestricted, $this->restrictionIdentifier->checkPreconditions());
    }
}
