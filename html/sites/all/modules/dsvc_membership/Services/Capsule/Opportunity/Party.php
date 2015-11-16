<?php
/**
 * +-----------------------------------------------------------------------+
 * | Copyright (c) 2010, David Coallier & echolibre ltd                    |
 * | All rights reserved.                                                  |
 * |                                                                       |
 * | Redistribution and use in source and binary forms, with or without    |
 * | modification, are permitted provided that the following conditions    |
 * | are met:                                                              |
 * |                                                                       |
 * | o Redistributions of source code must retain the above copyright      |
 * |   notice, this list of conditions and the following disclaimer.       |
 * | o Redistributions in binary form must reproduce the above copyright   |
 * |   notice, this list of conditions and the following disclaimer in the |
 * |   documentation and/or other materials provided with the distribution.|
 * | o The names of the authors may not be used to endorse or promote      |
 * |   products derived from this software without specific prior written  |
 * |   permission.                                                         |
 * |                                                                       |
 * | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS   |
 * | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT     |
 * | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR |
 * | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT  |
 * | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, |
 * | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT      |
 * | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, |
 * | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY |
 * | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT   |
 * | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE |
 * | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  |
 * |                                                                       |
 * +-----------------------------------------------------------------------+
 * | Author: David Coallier <david@echolibre.com>                          |
 * +-----------------------------------------------------------------------+
 *
 * PHP version 5
 *
 * @category  Services
 * @package   Services_Capsule
 * @author    David Coallier <david@echolibre.com>
 * @copyright echolibre ltd. 2009-2010
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link      http://github.com/davidcoallier/Services_Capsule
 * @version   GIT: $Id$
 */

/**
 * Services_Capsule
 *
 * @category Services
 * @package  Services_Capsule
 * @author   David Coallier <david@echolibre.com>
 * @license  http://www.opensource.org/licenses/bsd-license.php The BSD License
 * @link     http://github.com/davidcoallier/Services_Capsule
 * @link     http://capsulecrm.com/help/page/javelin_api_opportunity
 * @version  Release: @package_version@
 */
class Services_Capsule_Opportunity_Party extends Services_Capsule_Common
{
    
    /**
     * Get a list of additional parties
     *
     * View additional people & organisations related to this opportunity. 
     *
     * @link    /api/opportunity/{id}/party
     * @throws Services_Capsule_RuntimeException
     *
     * @param  double       $opportunityId The opportunity to retrieve the parties from.
     * @return stdClass     A stdClass object containing the information from
     *                      the json-decoded response from the server.
     */
    public function getAll($opportunityId)
    {
        $url      = '/' . (double)$opportunityId . '/party';
        $response = $this->sendRequest($url);
        
        return $this->parseResponse($response);
    }
    
    /**
     * Add a party to an opportunity
     *
     * This method is used to Add the Person or Organisation 
     * to the opportunity supplied in the $partyId parameter 
     *
     * @link   /api/opportunity/{id}/party/{party-id}
     * @throws Services_Capsule_RuntimeException
     *
     * @param  double       $opportunityId The opportunity to add the party on.
     * @param  string       $partyId       The party/org to add to the opportunity.
     *
     * @return mixed bool|stdClass         A stdClass object containing the information from
     *                                     the json-decoded response from the server.
     */
    public function add($opportunityId, $partyId)
    {
        $url = '/' . (double)$opportunityId . '/party/' . (double)$partyId;
        $response = $this->sendRequest($url, HTTP_Request2::METHOD_POST);
        
        return $this->parseResponse($response);
    }
    /**
     * Delete a party from an opportunity
     *
     * This method is used to delete a Person or Organisation 
     * to the opportunity supplied in the $partyId parameter 
     *
     * @link   /api/opportunity/{id}/party/{party-id}
     * @throws Services_Capsule_RuntimeException
     *
     * @param  double       $opportunityId The opportunity to delete the party from.
     * @param  string       $partyId       The party/org to delete from the opportunity.
     *
     * @return mixed bool|stdClass         A stdClass object containing the information from
     *                                     the json-decoded response from the server.
     */
    public function delete($opportunityId, $partyId)
    {
        $url = '/' . (double)$opportunityId . '/party/' . (double)$partyId;
        $response = $this->sendRequest($url, HTTP_Request2::METHOD_DELETE);
        
        return $this->parseResponse($response);
    }
}