To use this EE boilerplate:
====================================

1. Copy the latest EE files to /system/
1. Create EE cp directory name as /public_html/[something-non-obvious], rename admin.php to index.php and put it there
1. Correct the path to system directory in both public_html/index.php and /public_html/[control-panel-name]/index.php (../system and ../../system respectively)
1. Create empty database for EE
1. Install EE via the installer (visit the control panel url in a browser)

1. Add EE CP directory name in /config/config.master.php
1. Add environment vars to /config/config.env.php and environment specific files
1. Edit /system/expressionengine/config/config.php and /system/expressionengine/config/database.php to include the FLMC files with `require $_SERVER['DOCUMENT_ROOT'] . '/../config/config.master.php';` at the bottom

1. Edit domains in /public_html/.htaccess and /gulpfile.js
1. Edit client name in package.json
1. If you have installed npm-check-updates plugin, run `npm-check-updates -u` to update all version numbers in package.json to their latest versions. (If not, install it with `sudo npm install -g npm-check-updates`)
1. Run `npm install` to install Gulp & dependencies
1. Run `gulp` to start working