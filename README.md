# phpScheduleIt2-CAS
A simple to configure & use authentication plugin for the phpScheduleIt2 software
that uses the latest phpCAS distribution.

## Installation
The steps below outline the current installation method for this plugin.

### Working directory
First we will need to change our working directory to our phpScheduleIt2 plugins
folder which handles Authentication.

```
shell> cd /path/to/phpscheduleit/plugins/Authentication/
```

### Get plugin
Now you will need to get this plugin, the easiest method is to clone
it recursively. This will ensure the latest commit for the phpCAS software
gets installed too.

```
shell> git clone --recursively https://github.com/jas-/phpScheduleIt2.git
```

## Configuration
There are two files that will need to be configured for this plugin to work. First you
should configure the example configuration file that accompanies this plugin.

### CAS.config.php
The configuration settings for this can be seen here. (Simply copy the CAS.config.dist.php
to CAS.config.php then make your changes)

```php
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
```

### phpscheduleit2/config/config.php
Now you will need to ensure that your installation is aware that
you will want to begin using the phpScheduleIt2 Authentication plugin.

```php
$conf['settings']['plugins']['Authentication'] = 'CAS';
```
