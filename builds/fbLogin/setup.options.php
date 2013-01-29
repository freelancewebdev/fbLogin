<?php
/**
 * fbLogin setup options script
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

/* set some default values */
$values = array(
    'appId' => '',
    'secret' => '',
    'usergroups' => 'facebook',
    'perms' => 'email',
    'loginResourceId' => '',
    'accountResourceId' => '',
    'firstloginResourceId' => '',
    'cancelResourceId' => ''
);
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
    case xPDOTransport::ACTION_UPGRADE:
        $setting = $modx->getObject('modSystemSetting',array('key' => 'facebook_app_id'));
        if ($setting != null) { $values['appId'] = $setting->get('value'); }
        unset($setting);
 
        $setting = $modx->getObject('modSystemSetting',array('key' => 'facebook_app_secret'));
        if ($setting != null) { $values['secret'] = $setting->get('value'); }
        unset($setting);
		
		$setting = $modx->getObject('modSystemSetting',array('key' => 'fbLogin_usergroups'));
        if ($setting != null) { $values['usergroups'] = $setting->get('value'); }
        unset($setting);
 
        $setting = $modx->getObject('modSystemSetting',array('key' => 'facebook_user_perms'));
        if ($setting != null) { $values['perms'] = $setting->get('value'); }
        unset($setting);
		
		$setting = $modx->getObject('modSystemSetting',array('key' => 'fbLogin_login_resource_id'));
        if ($setting != null) { $values['loginResourceId'] = $setting->get('value'); }
        unset($setting);
		
		$setting = $modx->getObject('modSystemSetting',array('key' => 'fbLogin_account_resource_id'));
        if ($setting != null) { $values['accountResourceId'] = $setting->get('value'); }
        unset($setting);
		
		$setting = $modx->getObject('modSystemSetting',array('key' => 'fbLogin_firstlogin_resource_id'));
        if ($setting != null) { $values['firstloginResourceId'] = $setting->get('value'); }
        unset($setting);
		
		$setting = $modx->getObject('modSystemSetting',array('key' => 'fbLogin_cancel_resource_id'));
        if ($setting != null) { $values['cancelResourceId'] = $setting->get('value'); }
        unset($setting);
    break;
    case xPDOTransport::ACTION_UNINSTALL: break;
}
$resources = $modx->getCollection('modResource',array('published'=>1, 'type' => 'document', 'contentType' => 'text/html', 'deleted' => '0'));
$output = '<p style="padding:10px;">The following settings are required for '.$packagename.':</p>
<p style="padding:10px;"><b style="color:red">All fields are required!</b></p>
<div style="padding:10px;width:48%;float:left;">
<label style="font-weight:bold;padding:5px" for="fbLogin-appId">Facebook App ID:</label>
<br/><i>The App ID assigned to your app in the Facebook Developer app.</i><br/>
<input type="text" name="appId" id="fbLogin-appId" width="300" value="'.$values['appId'].'" />
<br /><br />
</div>
<div style="padding:5px;width:48%;float:left;"> 
<label style="font-weight:bold;padding:5px" for="fbLogin-secret">App Secret:</label>
<br/><i>The App Secret assigned to your app in the Facebook Developer app.</i><br/>
<input type="text" name="secret" id="fbLogin-secret" width="300" value="'.$values['secret'].'" />
<br /><br />
</div>
<div style="clear:both"></div>
<div style="padding:15px;width:48%;float:left;">
<label style="font-weight:bold;padding:5px" for="fbLogin-usergoups">Facebook Usergroup(s):</label>
<br/><i>A comma delimited list of usergroups you want to assign new Facebook users to on registration.</i><br/>
<input type="text" name="usergroups" id="fbLogin-usergroups" width="300" value="'.$values['usergroups'].'" />
<br /><br />
</div>
<div style="padding:5px;width:48%;float:left;">
<label style="font-weight:bold;padding:5px" for="fbLogin-perms">Permissions to Request:</label>
<br/><i>A comma delimited list of permissions your app needs to request from the Facebook user.</i><br/>
<input type="text" name="perms" id="fbLogin-perms" width="300" value="'.$values['perms'].'" />
<br/><br/>
</div>
<div style="clear:both"></div>
<div style="padding:5px;width:48%;float:left;">
<label style="font-weight:bold;padding:5px" for="fbLogin-loginResourceId">Login Resource</label>
<br/><i>Choose the alias of your dedicated login resource.</i><br/>';
$output .= '<select name="loginResourceId" id="fbLogin-loginResourceId" style="width:90%">';
$output .= '<option>Please choose...</option>';
foreach ($resources as $resource){
	$output .= '<option value="'.$resource->get('id').'"';
	if($values['loginResourceId'] == $resource->get('id')){
		$output .= ' selected';
	}
	$output .= '>'.$resource->get('alias').'</option>';
}
$output .='</select><br/><br/>
</div>
<div style="padding:5px;width:48%;float:left;">
<label style="font-weight:bold;padding:5px" for="fbLogin-accountResourceId">Post-login Resource</label>
<br/><i>Choose the alias of the resource returning Facebook users should be directed to after login.</i><br/>
<select name="accountResourceId" id="fbLogin-accountResourceId" style="width:90%">';
$output .= '<option>Please choose...</option>';
foreach ($resources as $resource){
	$output .= '<option value="'.$resource->get('id').'"';
	if($values['accountResourceId'] == $resource->get('id')){
		$output .= ' selected';
	}
	$output .= '>'.$resource->get('alias').'</option>';
}
$output .='</select><br/><br/>
</div>
<div style="clear:both"></div>
<div style="padding:5px;width:48%;float:left;">
<label style="font-weight:bold;padding:5px" for="fbLogin-firstloginResourceId">First Post-login Resource</label>
<br/><i>Choose the alias of the resource new Facebook users should be directed to after their first login - for instance you may want them to complete their profile.</i><br/>';
$output .= '<select name="firstloginResourceId" id="fbLogin-firstloginResourceId" style="width:90%">';
$output .= '<option>Please choose...</option>';
foreach ($resources as $resource){
	$output .= '<option value="'.$resource->get('id').'"';
	if($values['firstloginResourceId'] == $resource->get('id')){
		$output .= ' selected';
	}
	$output .= '>'.$resource->get('alias').'</option>';
}
$output .='</select><br/><br/>
</div>
<div style="padding:5px;width:48%;float:left;">
<label style="font-weight:bold;padding:5px" for="fbLogin-cancelResourceId">Cancellation Resource</label>
<br/><i>Choose the alias of the resource Facebook users should be directed to when they cancel a Facebook action - usually the same as your login resource ID</i><br/>';
$output .= '<select name="cancelResourceId" id="fbLogin-cancelResourceId" style="width:90%">';
$output .= '<option>Please choose...</option>';
foreach ($resources as $resource){
	$output .= '<option value="'.$resource->get('id').'"';
	if($values['cancelResourceId'] == $resource->get('id')){
		$output .= ' selected';
	}
	$output .= '>'.$resource->get('alias').'</option>';
}
$output .='</select><br/><br/>
</div>
<div style="clear:both"></div>
';

return $output;
?>