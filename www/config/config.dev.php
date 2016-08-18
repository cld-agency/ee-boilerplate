<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Development config overrides & db credentials
 *
 * Our database credentials and any environment-specific overrides
 *
 * @package    Focus Lab Master Config
 * @version    1.1.1
 * @author     Focus Lab, LLC <dev@focuslabllc.com>
 */

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

$env_config['webmaster_email'] = '';
$env_config['webmaster_name'] = '';

// smtp for system emails
// $config['email_crlf']    = "\r\n"; // this MUST be double-quoted
// $config['email_newline'] = "\r\n"; // this MUST be double-quoted
// $config['mail_protocol'] = "smtp";
// $config['smtp_server'] = "";
// $config['smtp_username'] = "";
// $config['smtp_password'] = "";
// $config['smtp_port'] = "25";

// --------------------------------------------
// GLOBAL VARS
// --------------------------------------------

$env_global['global:future_entries'] = 'yes';
$env_global['global:entry_statuses'] = 'open|Draft';
$env_global['global:stash_cache_replace'] = 'no';

// --------------------------------------------
// 3rd PARTY CONFIGS. Will mostly belong in config.master unless environment-specific
// --------------------------------------------


/* End of file config.prod.php */
/* Location: ./config/config.prod.php */