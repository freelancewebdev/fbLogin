<?php
/**
 * fbLogin chunks transport script
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

		$chunks = array();
		
		$myChunk = $modx->getObject('modChunk',array('name'=>'fbLinks'));
		$content = $myChunk->get('snippet');
		$chunks[0] = $modx->newObject('modChunk');
		$chunks[0]->fromArray(array(
			'name' => 'fbLinks',
			'description' => 'Sample chunk to output your login related links & \'Connect to Facebook\' button',
			'snippet' => $content
		));
		unset($myChunk);
		unset($content);
		
		$myChunk = $modx->getObject('modChunk',array('name'=>'fbLoginTpl'));
		$content = $myChunk->get('snippet');
		$chunks[1] = $modx->newObject('modChunk');
		$chunks[1]->fromArray(array(
			'name' => 'fbLoginTpl',
			'description' => 'Chunk displayed when user is not logged in',
			'snippet' => $content
		));
		unset($myChunk);
		unset($content);
		
		$myChunk = $modx->getObject('modChunk',array('name'=>'fbLoggedinTpl'));
		$content = $myChunk->get('snippet');
		$chunks[2] = $modx->newObject('modChunk');
		$chunks[2]->fromArray(array(
			'name' => 'fbLoggedinTpl',
			'description' => 'chunk displayed when user is logged in',
			'snippet' => $content
		));
		unset($myChunk);
		unset($content);
		
		return $chunks;
		
?>