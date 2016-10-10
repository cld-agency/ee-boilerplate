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

1. Install required ExpressionEngine add-ons Stash and Revved.

-------------------------------------------

MIT License

Copyright &copy; 2016 Clever Little Design Ltd.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.