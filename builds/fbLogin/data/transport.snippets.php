<?php

/**
 * fbLogin snippets transport script
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

$snippets = array();

$mySnippet = $modx->getObject('modSnippet',array('name' => 'fbDe-authorised'));
$content = $mySnippet->get('snippet');
$snippets[0] = $modx->newObject('modSnippet');
$snippets[0]->set('id',0);
$snippets[0]->set('name', 'fbDe-authorised');
$snippets[0]->set('description', 'This snippet deactivates Facebook sourced users who have deactivated your app.');
$snippets[0]->set('snippet',$content);
unset($mySnippet);
unset($content);

$mySnippet = $modx->getObject('modSnippet',array('name' => 'fbLogin'));
$content = $mySnippet->get('snippet');
$snippets[1] = $modx->newObject('modSnippet');
$snippets[1]->set('id',0);
$snippets[1]->set('name', 'fbLogin');
$snippets[1]->set('description', 'This snippet registers and logs in Facebook users. When users are logged in it handles OAuth exceptions and sets some useful placeholders');
$snippets[1]->set('snippet',$content);
unset($mySnippet);
unset($content);

$mySnippet = $modx->getObject('modSnippet',array('name' => 'fbRedirect'));
$content = $mySnippet->get('snippet');
$snippets[2] = $modx->newObject('modSnippet');
$snippets[2]->set('id',0);
$snippets[2]->set('name', 'fbRedirect');
$snippets[2]->set('description', 'This snippet handles redirection to Facebook for Facebook users.');
$snippets[2]->set('snippet',$content);
unset($mySnippet);
unset($content);

$mySnippet = $modx->getObject('modSnippet',array('name' => 'checkForActive'));
$content = $mySnippet->get('snippet');
$snippets[3] = $modx->newObject('modSnippet');
$snippets[3]->set('id',0);
$snippets[3]->set('name', 'checkForActive');
$snippets[3]->set('description', 'This snippet ensures Facebook users are logged out immediately if they de-authorise your app while logged in to your site.');
$snippets[3]->set('snippet',$content);
unset($mySnippet);
unset($content);

return $snippets;
?>