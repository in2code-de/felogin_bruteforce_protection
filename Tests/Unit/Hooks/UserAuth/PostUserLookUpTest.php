<?php
namespace Aoe\FeloginBruteforceProtection\Tests\Unit\Hooks\UserAuth;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2019 AOE GmbH <dev@aoe.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use Aoe\FeloginBruteforceProtection\Hooks\UserAuth\PostUserLookUp;
use Nimut\TestingFramework\TestCase\UnitTestCase;

/**
 * Test case for class Tx_FeloginBruteforceProtection_Hooks_UserAuth_PostUserLookUp.
 *
 * @package TYPO3
 * @subpackage brute force protection
 *
 */
class PostUserLookUpTest extends UnitTestCase
{
    /**
     * @var PostUserLookUp
     */
    private $postUserLookUp;

    /**
     * (non-PHPdoc)
     */
    public function setUp()
    {
        $this->postUserLookUp = $this
            ->getMockBuilder('Aoe\\FeloginBruteforceProtection\\Hooks\\UserAuth\\PostUserLookUp')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * with backend login
     * @test
     * @doesNotPerformAssertions
     */
    public function handlePostUserLookUpWithBackendLogin()
    {
        $feUserAuth = $this->getMockBuilder('\\TYPO3\\CMS\\Frontend\\Authentication\\FrontendUserAuthentication')
            ->disableOriginalConstructor()
            ->getMock();
        $feUserAuth->loginType = 'BE';
        $params = [];
        $params['pObj'] = $feUserAuth;
        $this->postUserLookUp->handlePostUserLookUp($params);
    }
}
