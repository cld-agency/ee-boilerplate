<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Local config overrides & db credentials
 *
 * Our database credentials and any environment-specific overrides
 * This file should be specific to each developer and not tracked in Git
 *
 * @package    Focus Lab Master Config
 * @version    1.1.1
 * @author     Focus Lab, LLC <dev@focuslabllc.com>
 */

define('ENV_HTTP_HOST_SAFE', $_SERVER['HTTP_HOST']);

// --------------------------------------------
// DB
// --------------------------------------------

$env_db['hostname'] = 'localhost';
$env_db['username'] = '';
$env_db['password'] = '';
$env_db['database'] = '';

// --------------------------------------------
// CONFIGS
// --------------------------------------------

$env_config['webmaster_email'] = 'you@example.com';
$env_config['cp_session_type'] = 'c';

// --------------------------------------------
// GLOBAL VARS
// --------------------------------------------

$env_global['global:entry_statuses'] = 'open|Draft';
$env_global['global:stash_cache_replace'] = 'yes';

// --------------------------------------------
// 3rd PARTY CONFIGS
// --------------------------------------------

//

// --------------------------------------------
// PHP CONFIGS
// --------------------------------------------

// sky's the limit on local...
// ini_set("memory_limit", "256M");

/* End of file config.local.php */
/* Location: ./config/config.local.php */