<?php
/**
 * fbLogin setup resolver script
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

$success= false;
$packagename = 'fbLogin';
switch ($options[xPDOTransport::PACKAGE_ACTION]) {
    case xPDOTransport::ACTION_INSTALL:
		/* appId */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'facebook_app_id'));
        if ($setting != null) {
            $setting->set('value',$options['appId']);
            $setting->save();
			$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] facebook_app_id setting was updated successfully.');
       	} else {
            $setting = $object->xpdo->getObject('modSystemSetting');
			$setting->set('key','facebook_app_id');
			$setting->set('name','facebook_app_id');	
            $setting->set('value',trim($options['appId']));
            $setting->save();
       		$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] facebook_app_id setting was added successfully.');
    	}
		
		/* secret */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'facebook_app_secret'));
        if ($setting != null) {
           	$setting->set('value',$options['secret']);
            $setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] facebook_app_secret setting was added successfully updated.');
        } else {
        	$setting = $object->xpdo->getObject('modSystemSetting');	
        	$setting->set('name','facebook_app_secret');
			$setting->set('key', 'facebook_app_secret');
            $setting->set('value',trim($options['secret']));
            $setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] facebook_app_secret setting was added successfully added.');
        }
		
		/* usergroups */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'fblogin_usergroups'));
        if ($setting != null) {
           	$setting->set('value',trim($options['usergroups']));
            $setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] fbLogin_usergroups setting was added successfully.');
        } else {
        	$setting = $object->xpdo->newObject('modSystemSetting');
			$setting->set('key','fbLogin_usergroups');
			$setting->set('name','fbLogin_usergroups');
			$setting->set('value',trim($options['usergroups']));
			$setting->save();
			$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] '.$packagename.'_usergroups setting updated successfully.');
		}

		/* do we need to add a new user group */
		$chosengroups = explode(',',$options['usergroups']);
		$groupname = '';
		foreach($chosengroups as $chosengroup){
			$chosengroup = trim($chosengroup);
			$group = $object->xpdo->getObject('modUserGroup',array('name'=>$chosengroup));
			if($group == NULL)
			{
				$newgroup = $object->xpdo->newObject('modUserGroup');
				$newgroup->set('name',$chosengroup);
				$newgroup->save();
				unset($newgroup);
				$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] '.$packagename.' '.$chosengroup.' group added to usergroups.');
			}
		}
		unset($groups);
		unset($chosengroups);
		unset($groupname);
		
		/* perms */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'facebook_user_perms'));
        if ($setting != null) {
        	$setting->set('value',trim($options['perms']));
			$setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] facebook_user_perms setting updated successfully.');
		}else{
        	$setting = $object->xpdo->newObject('modSystemSetting');
        	$setting->set('key','facebook_user_perms');
			$setting->set('name','facebook_user_perms');
        	$setting->set('value',trim(str_replace(' ','',$options['perms'])));
        	$setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] facebook_user_perms setting added successfully.');
        }
        /* loginResourceId */
        $setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'fbLogin_resource_id'));
        if ($setting != null) {
        	$setting->set('value',$options['loginResourceId']);
			$setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] fbLogin_login_resource_id setting updated successfully.');
		}else{
			$setting = $object->xpdo->newObject('modSystemSetting');
        	$setting->set('key', $packagename.'_login_resource_id');
        	$setting->set('name', $packagename.'_login_resource_id');
        	$setting->set('value',$options['loginResourceId']);
        	$setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] '.$packagename.'_login_resource_id setting added successfully.');
		}
        /* accountResourceId */
		 $setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'fbLogin_account_resource_id'));
        if ($setting != null) {
        	$setting->set('value',$options['accountResourceId']);
			$setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] fbLogin_account_resource_id setting updated successfully.');
		}else{
			$setting = $object->xpdo->newObject('modSystemSetting');
        	$setting->set('key',$packagename.'_account_resource_id');
        	$setting->set('name',$packagename.'_account_resource_id');
       		$setting->set('value',$options['accountResourceId']);
        	$setting->save();
       		$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] '.$packagename.'_account_resource_id setting added successfully.');
		}
       	/* firstloginResourceId */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'fbLogin_firstlogin_resource_id'));
        if ($setting != null) {
        	$setting->set('value',$options['firstloginResourceId']);
			$setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] fbLogin_firstlogin_resource_id setting updated successfully.');
		}else{
			$setting = $object->xpdo->newObject('modSystemSetting');
        	$setting->set('key',$packagename.'_firstlogin_resource_id');
        	$setting->set('name',$packagename.'_firstlogin_resource_id');
        	$setting->set('value',$options['firstloginResourceId']);
        	$setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] '.$packagename.'_firstlogin_resource_id setting added successfully.');
		}
        /* cancelResourceId */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'fbLogin_cancel_resource_id'));
        if ($setting != null) {
        	$setting->set('value',$options['cancelloginResourceId']);
			$setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] fbLogin_cancel_resource_id setting updated successfully.');
		}else{
			$setting = $object->xpdo->newObject('modSystemSetting');
        	$setting->set('key',$packagename.'_cancel_resource_id');
        	$setting->set('name',$packagename.'_cancel_resource_id');
        	$setting->set('value',$options['cancelResourceId']);
        	$setting->save();
        	$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] '.$packagename.'_cancel_resource_id setting added successfully.');
        }
        $success = true;
		break;
    case xPDOTransport::ACTION_UPGRADE:
        /* appId */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'facebook_app_id'));
        if ($setting != null) {
            $setting->set('value',trim($options['appId']));
            $setting->save();
        } else {
            $object->xpdo->log(xPDO::LOG_LEVEL_ERROR,'['.$packagename.'] facebook_app_id setting could not be found, so the setting could not be updated.');
        }
		/* secret */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'facebook_app_secret'));
        if ($setting != null) {
            $setting->set('value',trim($options['secret']));
            $setting->save();
        } else {
            $object->xpdo->log(xPDO::LOG_LEVEL_ERROR,'['.$packagename.'] facebook_app_secret setting could not be found, so the setting could not be updated.');
        }
		/* usergroups */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key'=> $packagename.'_usergroups'));
		if($setting != null){
			$setting->set('value',trim($options['usergroups']));
			$setting->save();
		}
		else {
			$object->xpdo->log(xPDO::LOG_LEVEL_ERROR,'['.$packagename.'] '.$packagename.'_usergroups setting could not be found, so the setting could not be updated.');
		}
		
		/* do we need to add a new user group */
		$chosengroups = explode(',',trim($options['usergroups']));
		foreach($chosengroups as $chosengroup){
			$chosengroup = trim($chosengroup);
			$group = $object->xpdo->getObject('modUserGroup',array('name'=>$chosengroup));
			if($group == NULL)
			{
				$newgroup = $object->xpdo->newObject('modUserGroup');
				$newgroup->set('name',$chosengroup);
				$newgroup->save();
				unset($newgroup);
				$object->xpdo->log(xPDO::LOG_LEVEL_INFO,'['.$packagename.'] '.$packagename.' '.$chosengroup.' group added to usergroups.');
			}
		}
		unset($group);
		unset($chosengroup);
		unset($chosengroups);
		
		/* perms */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => 'facebook_user_perms'));
        if ($setting != null) {
            $setting->set('value',trim(str_replace(' ', '',$options['perms'])));
            $setting->save();
        } else {
            $object->xpdo->log(xPDO::LOG_LEVEL_ERROR,'['.$packagename.'] facebook_user_perms setting could not be found, so the setting could not be updated.');
        }
		/* loginResourceId */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => $packagename.'_login_resource_id'));
        if ($setting != null) {
            $setting->set('value',$options['loginResourceId']);
            $setting->save();
        } else {
            $object->xpdo->log(xPDO::LOG_LEVEL_ERROR,'['.$packagename.'] '.$packagename.'_login_resource_id setting could not be found, so the setting could not be updated.');
        }
		/* accountResourceId */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => $packagename.'_account_resource_id'));
        if ($setting != null) {
            $setting->set('value',$options['accountResourceId']);
            $setting->save();
        } else {
            $object->xpdo->log(xPDO::LOG_LEVEL_ERROR,'['.$packagename.'] '.$packagename.'_account_resource_id setting could not be found, so the setting could not be updated.');
        }
		/* firstloginResourceId */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => $packagename.'_firstlogin_resource_id'));
        if ($setting != null) {
            $setting->set('value',$options['firstloginResourceId']);
            $setting->save();
        } else {
            $object->xpdo->log(xPDO::LOG_LEVEL_ERROR,'['.$packagename.'] '.$packagename.'_firstlogin_resource_id setting could not be found, so the setting could not be updated.');
        }
 		/* cancelResourceId */
		$setting = $object->xpdo->getObject('modSystemSetting',array('key' => $packagename.'_cancel_resource_id'));
        if ($setting != null) {
            $setting->set('value',$options['cancelResourceId']);
            $setting->save();
        } else {
            $object->xpdo->log(xPDO::LOG_LEVEL_ERROR,'['.$packagename.'] '.$packagename.'_cancel_resource_id setting could not be found, so the setting could not be updated.');
        }
		$success= true;
        break;
    case xPDOTransport::ACTION_UNINSTALL:
		/* clean up our resources - good housekeeping */
		$resource = $object->xpdo->getObject('modResource',array('alias'=>'fbd'));
		if($resource != NULL){
			$resource->remove();
			$resource->save();
		}
		unset($resource);
		$resource = $object->xpdo->getObject('modResource',array('alias'=>'fbc'));
		if($resource != NULL){
			$resource->remove();
			$resource->save();
		}
		unset($resource);
		$resource = $object->xpdo->getObject('modResource',array('alias'=>'fbr'));
		if($resource != NULL){
			$resource->remove();
			$resource->save();
		}
		unset($resource);
        $success= true;
        break;
}


return $success;