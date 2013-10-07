<?php

/**
 * LICENSE: This source file is subject to version 3.01 of the GPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/gpl.html. If you did not receive a copy of
 * the GPL License and are unable to obtain it through the web, please
 *
 * @package phpScheduleIt-CAS
 * @author Jason Gerfen <jason.gerfen@gmail.com>
 * @license http://www.gnu.org/licenses/gpl.html GPL License 3
 */

class CASUser
{
	/*
	 * @var $userDetails Array
	 */
	private $userDetails;

	/*
	 * @var $inetOrgPerson Array
	 * Array of SAML object attributes per RFC-2798
	 */
	private $inetOrgPerson = array('audio' => null,
								   'commonName' => null,
								   'description' => null,
								   'displayName' => null,
								   'facsimileTelephoneNumber' => null,
								   'givenName' => null,
								   'homePhone' => null,
								   'homePostalAddress' => null,
								   'initials' => null,
								   'jpegPhoto' => null,
								   'localityName' => null,
								   'labeledURI' => null,
								   'mail' => null,
								   'manager' => null,
								   'mobile' => null,
								   'organizationName' => null,
								   'organizationalUnitName' => null,
								   'pager' => null,
								   'postalAddress' => null,
								   'postalCode' => null,
								   'postOfficeBox' => null,
								   'preferredLanguage' => null,
								   'seeAlso' => null,
								   'surname' => null,
								   'stateOrProvinceName' => null,
								   'street' => null,
								   'telephoneNumber' => null,
								   'title' => null,
								   'uid' => null,
								   'uniqueIdentifier' => null,
								   'userCertificate' => null,
								   'userPassword' => null,
								   'userSMIMECertificate' => null,
								   'x500uniqueIdentifier' => null);

	/*
	 * @var $eduPerson Array
	 * Array of common Internet2 object attributes
	 * http://middleware.internet2.edu/eduperson/docs/internet2-mace-dir-eduperson-201203.html
	 */
	private $eduPerson = array('eduPersonAffiliation' => null,
							   'eduPersonNickname' => null,
							   'eduPersonOrgDN' => null,
							   'eduPersonOrgUnitDN' => null,
							   'eduPersonPrimaryAffiliation' => null,
							   'eduPersonPrincipalName' => null,
							   'eduPersonEntitlement' => null,
							   'eduPersonPrimaryOrgUnitDN' => null,
							   'eduPersonScopedAffliation' => null,
							   'eduPersonTargetedID' => null,
							   'eduPersonAssurance' => null);

	public function __construct($SAMLResults = null)
	{
		$this->userDetails = array_merge($this->eduPerson, $this->inetOrgPerson);
		$this->Set($SAMLResults);
		return $this->userDetails;
	}

	private function Set($attributes)
	{
		foreach($attributes as $key => $value) {
			if ((!empty($value)) && (in_array($value, $this->userDetails))) {
				$this->userDetails[$key] = $value;
			}
		}
	}	
}

