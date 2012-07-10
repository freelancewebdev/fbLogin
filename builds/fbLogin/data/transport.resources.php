<?php

/**
 * fbLogin resources transport script
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

$resources = array();
$packagename = 'fbLogin';

$resources[0] = $modx->newObject('modResource');
$resources[0]->fromArray(array(
	'pagetitle' => $packagename.' - Facebook De-authorised Ping Target',
	'content' => '[[!fbDeauthorised]]',
	'alias' => 'fbd',
	'published' => true,
	'description' => 'This resource is the target for Facebook to ping when a user de-authorises your app',
	'template' => 0,
	'richtext' => 0,
	'searchable' => 0,
	'cacheable' => 0,
	'hidemenu' => 1
));

$resources[1] = $modx->newObject('modResource');
$resources[1]->fromArray(array(
	'pagetitle' => $packagename.' - Facebook Redirect',
	'content' => '[[!fbRedirect]]',
	'alias' => 'fbr',
	'published' => true,
	'description' => 'This resource redirects users to Facebook for authorisation and login',
	'template' => 0,
	'richtext' => 0,
	'searchable' => 0,
	'cacheable' => 0,
	'hidemenu' => 1
));

$resources[2] = $modx->newObject('modResource');
$resources[2]->fromArray(array(
	'pagetitle' => $packagename.' - Facebook Receiver',
	'content' => '[[!fbLogin]]',
	'alias' => 'fbc',
	'published' => true,
	'description' => 'This resource captures responses from Facebook following user actions',
	'template' => 0,
	'richtext' => 0,
	'searchable' => 0,
	'cacheable' => 0,
	'hidemenu' => 1
));

return $resources;
?>