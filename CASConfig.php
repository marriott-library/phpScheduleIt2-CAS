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

class CASConfig
{
	function __construct()
	{
		if (!file_exists(ROOT_DIR . 'plugins/Authentication/CAS/CAS.config.php')){
			throw new Exception('Please copy CAS.config.dist.php to CAS.config.php & define options for your environment');
		}
	}

	function getOptions()
	{
		include_once(ROOT_DIR . 'plugins/Authentication/CAS/CAS.config.php');
		return $conf;
	}
}
