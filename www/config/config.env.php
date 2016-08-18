<?php

/**
 * Environment Declaration
 *
 * This switch statement sets our environment. The environment is used primarily
 * in our custom config file setup. It is also used, however, in the front-end
 * index.php file and the back-end admin.php file to set the debug mode
 *
 * @package    Focus Lab Master Config
 * @version    1.1.1
 * @author     Focus Lab, LLC <dev@focuslabllc.com>
 */

if ( ! defined('ENV'))
{
	switch (strtolower($_SERVER['HTTP_HOST'])) {
		case 'www.example.co.uk' :
			define('ENV', 'prod');
			define('ENV_FULL', 'Production');
			define('ENV_DEBUG', FALSE);
			define('ENV_HTTP_HOST_SAFE', $_SERVER['HTTP_HOST']);
		break;

		case 'dev.example.co.uk' :
		case 'www2.example.co.uk' :
			define('ENV', 'dev');
			define('ENV_FULL', 'Development');
			define('ENV_DEBUG', TRUE);
			define('ENV_HTTP_HOST_SAFE', $_SERVER['HTTP_HOST']);
		break;

		default :
			define('ENV', 'local');
			define('ENV_FULL', 'Local');
			define('ENV_DEBUG', TRUE);
			// don't define ENV_HTTP_HOST_SAFE here! keep it in config.local.php, which must never be pushed to the server.
		break;
	}
}

/* End of file config.env.php */
/* Location: ./config/config.env.php */