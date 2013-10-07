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

/*
 * @var {Object} CAS version specification
 * @example CAS_VERSION_2_0
 */
$conf['version'] = CAS_VERSION_2_0;

/*
 * @var {String} CAS service URL
 */
$conf['url'] = '';

/*
 * @var {Number} CAS service tcp port
 */
$conf['port'] = 443;

/*
 * @var {String} CAS service path (FQDN path component)
 */
$conf['path'] = '';

/*
 * @var {String} FQDN for redirection after logout
 */
$conf['logout'] = '';

/*
 * @var {String} Certificate authority file
 */
$conf['ca'] = '';

/*
 * @var {String} CAS client log (optional)
 */
$conf['log'] = '';

/*
 * @var {String} Email suffix (optional)
 */
$conf['email_suffix'] = '';
