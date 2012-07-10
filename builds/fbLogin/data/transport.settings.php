<?php
/**
 * fbLogin settings transport script
 * 
 * FbLogin brings Facebook Login to MODX Revolution (2.2+) (http://www.modxcms.com)
 * 
 * fbLogin is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation; either version 2 of the License, or (at your option) any
 * later version.
 *
 * fbLogin is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * fbLogin; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * Joe Molloy (http://hyper-typer.com)
 * 
 * @package fbLogin
 * @subpackage build
 * 
 */

$settings = array();
$settings[0] = $modx->newObject('modSystemSetting');
$settings[0]->fromArray(array(
	'name' => 'settings_facebook_app_id',
	'key' => 'facebook_app_id',
	'description' => 'The app ID assigned by Facebook for your app'
));
$settings[1] = $modx->newObject('modSystemSetting');
$settings[1]->fromArray(array(
	'name' => 'settings_facebook_app_secret',
 	'key' => 'facebook_app_secret',
 	'description' => 'The secret assigned by Facebook for your app'
));
$settings[5] = $modx->newObject('modSystemSetting');
$settings[5]->fromArray(array(
	'name' => 'fbLogin_usergroups',
	'key' => 'fbLogin_usergroups',
	'description' => 'A comma delimited list of usergroups Facebook users should be added to on registration'
));
$settings[2] = $modx->newObject('modSystemSetting');
$settings[2]->fromArray(array(
	'name' => 'facebook_user_perms',
	'key' => 'facebook_user_perms',
	'value' => 'email',
	'description' => 'The comma delimited list of permissions your app needs to request from your user on Facebook' 
 ));
$settings[3] = $modx->newObject('modSystemSetting');
$settings[3]->fromArray(array(
	'name' => 'fbLogin_login_resource_id',
	'key' => 'fbLogin_login_resource_id',
	'description' => 'The ID of your dedicated login resource'
));  

$settings[4] = $modx->newObject('modSystemSetting');
$settings[4]->fromArray(array(
	'name' => 'fbLogin_account_resource_id',
	'key' => 'fbLogin_account_resource_id',
	'description' => 'The ID of resource to redirect returning Facebook users to when they login in'
));

$settings[5] = $modx->newObject('modSystemSetting');
$settings[5]->fromArray(array(
	'name' => 'fbLogin_firstlogin_resource_id',
	'key' => 'fbLogin_firstlogin_resource_id',
	'description' => 'The ID of the resource to redirect Facebook users on their first login - perhaps to complete their profile'
));
return $settings;
?>