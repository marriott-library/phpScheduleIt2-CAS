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

require_once(ROOT_DIR . 'lib/Application/Authentication/namespace.php');
require_once(ROOT_DIR . 'plugins/Authentication/CAS/namespace.php');

class CAS extends Authentication implements IAuthentication
{
	private $authToDecorate;
	private $_registration;
	private $user = null;
	private $username = false;
	private $loggedin = false;
	protected $options = false;

	public function SetRegistration($registration)
	{
		$this->_registration = $registration;
	}

	private function GetRegistration()
	{
		if ($this->_registration == null) {
			$this->_registration = new Registration();
		}
		return $this->_registration;
	}

	public function SetEncryption($passwordEncryption)
	{
		$this->_encryption = $passwordEncryption;
	}

	private function GetEncryption()
	{
		if ($this->_encryption == null) {
			$this->_encryption = new PasswordEncryption();
		}

		return $this->_encryption;
	}

	public function __construct(IAuthentication $authentication)
	{
		$this->setCASSettings();
		$this->authToDecorate = $authentication;
	}

	private function setCASSettings()
	{
		$this->options = CASConfig::getOptions();

		if (!empty($this->options['log'])) {
			phpCAS::setDebug($this->options['log']);
		}

		phpCAS::client($this->options['version'], $this->options['url'],
					   $this->options['port'], $this->options['path']);

		if (!empty($this->options['ca'])) {
			phpCAS::setCasServerCACert('', false);
		} else {
			phpCAS::setNoCasServerValidation();
		}
	}

	public function Validate($username, $password)
	{
		$this->loggedin = phpCAS::isAuthenticated();

		if (isset($_SERVER["phpCAS"])){
			$this->loggedin = true;
			$username = $_SERVER["phpCAS"]["user"];
		} else {
			if (!$this->loggedin) {
				phpCAS::forceAuthentication();
			}
		}
		$this->username = phpCAS::getUser();

		if ($this->username){
			$this->Synchronize($username);
			return true;
		}
		return $this->authToDecorate->Validate($this->loggedin, $this->loggedin);
	}

	public function Login($username, $loginContext)
	{
		if ($this->username){
			$this->Synchronize($username);
		}

		$this->authToDecorate->Login($this->username, $loginContext);
	}

	public function Logout(UserSession $user)
	{
		$this->authToDecorate->Logout($user);
		phpCAS::logoutWithUrl($this->options['logout']);
	}

	public function CookieLogin($cookieValue, $loginContext)
	{
		$this->authToDecorate->CookieLogin($cookieValue, $loginContext);
	}

	public function AreCredentialsKnown()
	{
		return true;
	}

	public function HandleLoginFailure(ILoginPage $loginPage)
	{
		$this->authToDecorate->HandleLoginFailure($loginPage);
	}

	public function ShowUsernamePrompt()
	{
		return false;
	}

	public function ShowPasswordPrompt()
	{
		return false;
	}

	public function ShowPersistLoginPrompt()
	{
		return false;
	}

	public function ShowForgotPasswordPrompt()
	{
		return false;
	}

	private function Synchronize($username)
	{
		$registration = $this->GetRegistration();

		$userDetails = new CASUser(phpCAS::getAttributes());

		$userDetails->mail = (!empty($userDetails->mail)) ?
			$userDetails->mail : $this->username . $this->options['email_suffix'];

		$registration->Synchronize(
			new AuthenticatedUser(
                $this->username,
                $userDetails->mail,
                $userDetails->commonName,
                $userDetails->surname,
                '', // password? maybe a random non-guessable value?
                Configuration::Instance()->GetKey(ConfigKeys::LANGUAGE),
				Configuration::Instance()->GetKey(ConfigKeys::SERVER_TIMEZONE),
				$userDetails->telephoneNumber,
				$userDetails->eduPersonAffiliation,
                $userDetails->title)
		);
	}
}
