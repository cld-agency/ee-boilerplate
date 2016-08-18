<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ----------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------
/**
 * Focus Lab, LLC Master Config
 *
 * This is the master config file for our ExpressionEngine sites
 * The settings will contain database credentials and numerous "config overrides"
 * used throughout the site. This file is used as first point of configuration
 * but there are environment-specific files as well. The idea is that the environment
 * config files contain config overrides that are specific to a single environment.
 *
 * Some config settings are used in multiple (but not all) environments. You will
 * see the use of conditionals around the ENV constant in this file. This constant is
 * defined in ./config/config.env.php
 *
 * All config files are stored in the ./config/ directory and this master file is "required"
 * in system/expressionengine/config/config.php and system/expressionengine/config/database.php
 *
 * require $_SERVER['DOCUMENT_ROOT'] . '/../config/config.master.php';
 *
 * This config setup is a combination of inspiration from Matt Weinberg and Leevi Graham
 * @link       http://eeinsider.com/articles/multi-server-setup-for-ee-2/
 * @link       http://ee-garage.com/nsm-config-bootstrap
 *
 * @package    Focus Lab Master Config
 * @version    1.1.1
 * @author     Focus Lab, LLC <dev@focuslabllc.com>
 * @see        https://github.com/focuslabllc/ee-master-config
 */
// ----------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------

$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);

// --------------------------------------------
// Require our environment declaration file if it hasn't
// already been loaded in index.php or admin.php
// --------------------------------------------

if ( ! defined('ENV'))
{
	require 'config.env.php';
}

// --------------------------------------------
// Setup our initial arrays
// --------------------------------------------

$env_db = $env_config = $env_global = $master_global = array();

// --------------------------------------------
// Database override magic
// --------------------------------------------

if (isset($db['expressionengine']))
{
	/**
	 * Load our environment-specific config file
	 * which contains our database credentials
	 *
	 * @see config/config.local.php
	 * @see config/config.dev.php
	 * @see config/config.stage.php
	 * @see config/config.prod.php
	 */
	require 'config.' . ENV . '.php';

	// Dynamically set the cache path (Shouldn't this be done by default? Who moves the cache path?)
	$env_db['cachedir'] = APPPATH . 'cache/db_cache/';

	// Merge our database setting arrays
	$db['expressionengine'] = array_merge($db['expressionengine'], $env_db);

	// No need to have this variable accessible for the rest of the app
	unset($env_db);
}

// --------------------------------------------
// Config override magic
// --------------------------------------------

if (isset($config))
{
	// --------------------------------------------
	// Dynamic path settings
	// --------------------------------------------

	$protocol                          = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 'https://' : 'http://';
	$base_url                          = $protocol . ENV_HTTP_HOST_SAFE;
	$base_path                         = $_SERVER['DOCUMENT_ROOT'];
	$system_folder                     = APPPATH . '../';
	$images_folder                     = 'images';
	$images_path                       = $base_path . '/' . $images_folder;
	$images_url                        = $base_url . '/' . $images_folder;
	$cp                                = 'CHANGE-ME-TO-SOMETHING-MEMORABLE';

	//---------------------------------------------

	$env_config['index_page']          = '';
	$env_config['site_index']          = '';
	$env_config['base_url']            = $base_url . '/';
	$env_config['site_url']            = $env_config['base_url'];
	$env_config['cp_url']              = $env_config['base_url'] . $cp . '/index.php';
	$env_config['theme_folder_path']   = $base_path   . '/themes/';
	$env_config['theme_folder_url']    = $base_url    . '/themes/';
	$env_config['emoticon_path']       = $images_url  . '/smileys/';
	$env_config['emoticon_url']        = $images_url  . '/smileys/';
	$env_config['captcha_path']        = $images_path . '/captchas/';
	$env_config['captcha_url']         = $images_url  . '/captchas/';
	$env_config['avatar_path']         = $images_path . '/avatars/';
	$env_config['avatar_url']          = $images_url  . '/avatars/';
	$env_config['photo_path']          = $images_path . '/member_photos/';
	$env_config['photo_url']           = $images_url  . '/member_photos/';
	$env_config['sig_img_path']        = $images_path . '/signature_attachments/';
	$env_config['sig_img_url']         = $images_url  . '/signature_attachments/';
	$env_config['prv_msg_upload_path'] = $images_path . '/pm_attachments/';
	$env_config['third_party_path']    = $base_path . '/../third_party/';

	// --------------------------------------------
	// Upload path settings
	// NB: The array keys must match the ID from exp_upload_prefs
	// --------------------------------------------

	$env_config['upload_preferences'] = array(
	    // 1 => array(
	    //     'name'        => 'Images directory',
	    //     'server_path' => $images_path . '/',
	    //     'url'         => '/' . $images_folder . '/'
	    // ),
	    // 2 => array(
	    //     'name'        => 'Downloads directory',
	    //     'server_path' => $base_path . '/downloads/',
	    //     'url'         => '/downloads/'
	    // ),
	);

	$env_config['xss_clean_member_group_exception'] = "6";

	// --------------------------------------------
	// Template settings
	// --------------------------------------------

	$env_config['save_tmpl_files']           = 'y';
	// $env_config['save_tmpl_files']           = (ENV == 'prod') ? 'n' : 'y';
	$env_config['tmpl_file_basepath']        = $base_path . '/../templates';
	$env_config['hidden_template_indicator'] = '_';
	$env_config['strict_urls'] = 'y';

	// --------------------------------------------
	// Debugging settings
	// --------------------------------------------

	$env_config['is_system_on']         = 'y';
	$env_config['allow_extensions']     = 'y';
	$env_config['email_debug']          = (ENV_DEBUG) ? 'y' : 'n' ;
	// If we're not in production show the profile on the front-end but not in the CP
	$env_config['show_profiler']        = ( ! ENV_DEBUG OR ($segments[1] == $cp)) ? 'n' : 'y' ;
	// Show template debugging if we're not in production
	$env_config['template_debugging']   = (ENV_DEBUG) ? 'y' : 'n' ;
	/**
	 * Set debug to '2' if we're in dev mode, otherwise just '1'
	 *
	 * 0: no PHP/SQL errors shown
	 * 1: Errors shown to Super Admins
	 * 2: Errors shown to everyone
	 */
	$env_config['debug']                = (ENV_DEBUG) ? '2' : '1' ;

	// --------------------------------------------
	// Tracking & Performance settings
	// --------------------------------------------

	$env_config['disable_all_tracking']        = 'y'; // If set to 'y' some of the below settings are disregarded
	$env_config['enable_sql_caching']          = 'n';
	$env_config['disable_tag_caching']         = 'n';
	$env_config['enable_online_user_tracking'] = 'n';
	$env_config['dynamic_tracking_disabling']  = '500';
	$env_config['enable_hit_tracking']         = 'n';
	$env_config['enable_entry_view_tracking']  = 'n';
	$env_config['log_referrers']               = 'n';
	$env_config['gzip_output']                 = 'y'; // Set to 'n' if your host is EngineHosting

	// --------------------------------------------
	// Third Party Add-on config items as needed
	// --------------------------------------------

	// CE IMG
	$env_config['ce_image_quality'] = '92';
	$env_config['ce_image_cache_dir'] = '/assets/img/made';
	$env_config['ce_image_remote_dir'] = '/assets/img/made/remote/';
	$env_config['ce_image_add_dims'] = 'no';

	// STASH
	$env_config['stash_file_basepath'] = $base_path . '/../stash_templates/';
	$env_config['stash_file_sync'] = (ENV == 'prod') ? FALSE : TRUE; // set to FALSE for production
	$env_config['stash_file_extensions'] = array('html', 'md', 'css', 'js', 'rss', 'xml');

	$env_config['stash_static_basepath'] = $base_path . '/static_cache/';
	$env_config['stash_static_url'] = '/static_cache/'; // should be a relative url
	$env_config['stash_static_cache_enabled'] = FALSE; // set to TRUE to enable static caching

	$env_config['stash_cookie'] = 'stashid'; // the stash cookie name
	$env_config['stash_cookie_expire'] = 0; // seconds - 0 means expire at end of session
	$env_config['stash_default_scope'] = 'local'; // default variable scope if not specified

	$env_config['stash_limit_bots'] = TRUE; // stop database writes by bots to reduce load on busy sites
	$env_config['stash_bots'] = array('bot', 'crawl', 'spider', 'archive', 'search', 'java', 'yahoo', 'teoma');

	// Resource Router: https://github.com/rsanchez/resource_router
	// $config['resource_router'] = array(
	// 	'news/:url_title' => 'news/_single',
	// 	'blog/:url_title' => 'blog/_single',
	// 	'blog/:url_title/:any' => 'blog/_single',
	// 	'events/:url_title' => 'events/_single',
	// );

	//$env_config['cp_theme'] = 'nerdery';

	// --------------------------------------------
	// Member-based settings
	// --------------------------------------------

	$env_config['profile_trigger']          = rand(0,time()); // randomize the member profile trigger word because we'll never need it

	// --------------------------------------------
	// Other system settings
	// --------------------------------------------

	$env_config['multiple_sites_enabled']	= 'y';
	$env_config['new_version_check']        = 'n'; // no slowing my CP homepage down with this
	$env_config['daylight_savings']         = ((bool) date('I')) ? 'y' : 'n'; // Autodetect DST
	$env_config['use_category_name']        = 'y';
	$env_config['reserved_category_word']   = 'category';
	$env_config['word_separator']           = 'dash'; // dash|underscore
	$env_config['encryption_key'] 			= 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

	// --------------------------------------------
	// Load our environment-specific config file for
	// overriding any of the above values
	// --------------------------------------------

	require $_SERVER['DOCUMENT_ROOT'] . '/../config/config.' . ENV . '.php';

	// --------------------------------------------
	// Setup our template-level global variables
	// --------------------------------------------

	global $assign_to_config;
	if( ! isset($assign_to_config['global_vars']))
	{
		$assign_to_config['global_vars'] = array();
	}

	// Start our array with environment variables. This gives us {global:env} and {global:env_full} tags for our templates.
	$master_global = array(
		'global:env'      => ENV,
		'global:env_full' => ENV_FULL,
	);

	// --------------------------------------------
	// Merge arrays to form final datasets
	// --------------------------------------------

	$assign_to_config['global_vars'] = array_merge($assign_to_config['global_vars'], $master_global, $env_global); // global var arrays
	$config = array_merge($config, $env_config); // config setting arrays

}

/* End of file config.master.php */
/* Location: ./config/config.master.php */