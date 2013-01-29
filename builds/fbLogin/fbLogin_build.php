<?php
ini_set('display_errors','on');    
/**
 * fbLogin build script
 * 
 * fbLogin brings Facebook Login to MODX Revolution (2.2+) (http://www.modxcms.com)
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

$packagename = 'fbLogin';

$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0); /* makes sure our script doesnt timeout */

$root = dirname(dirname(dirname(__FILE__))).'/';
$sources= array (
    'root' => $root,
    'build' => $root .'builds/fbLogin/',
    'resolvers' => $root . 'builds/'.$packagename.'/resolvers/',
    'data' => $root . 'builds/'.$packagename.'/data/',
    'source_core' => $root.'core/components/'.$packagename,
    'lexicon' => $root . 'core/components/'.$packagename.'/lexicon/',
    'source_assets' => $root.'assets/components/'.$packagename,
    'docs' => $root.'core/components/'.$packagename.'/docs/',
);
require_once dirname(__FILE__) . '/build.config.php';
define('MODX_CORE_PATH', $_SERVER['DOCUMENT_ROOT'].'/core/');
define('MODX_CONFIG_KEY','config');
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
 
$modx= new modX();
$modx->initialize('mgr');
$modx->setLogLevel(modX::LOG_LEVEL_INFO);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');

$modx->loadClass('transport.modPackageBuilder','',false, true);
$builder = new modPackageBuilder($modx);
$builder->createPackage($packagename,'1.0','rc4');
$builder->registerNamespace($packagename,false,true,MODX_CORE_PATH.'components/'.$packagename.'/');

/* load system settings */
$settings = include $sources['data'].'transport.settings.php';
 
$attributes= array(
    xPDOTransport::UNIQUE_KEY => 'key',
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => false,
);

$modx->log(modX::LOG_LEVEL_INFO,'Packaging in settings...');
foreach ($settings as $setting) {
    $vehicle = $builder->createVehicle($setting,$attributes);
    $builder->putVehicle($vehicle);
}
unset($settings,$setting,$attributes);
$modx->log(modX::LOG_LEVEL_INFO,'Settings packaged');

/* load resources */
$modx->log(modX::LOG_LEVEL_INFO,'Packaging in resources...');
$resources = include $sources['data'].'transport.resources.php';
 
$attributes= array(
    xPDOTransport::UNIQUE_KEY => 'alias',
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => false,
);
foreach ($resources as $resource) {
    $vehicle = $builder->createVehicle($resource,$attributes);
    $builder->putVehicle($vehicle);
}
unset($resources,$resource,$attributes);
$modx->log(modX::LOG_LEVEL_INFO,'Resources packaged');

/* create category */
$modx->log(modX::LOG_LEVEL_INFO,'Creating category...');
$category= $modx->newObject('modCategory');
$category->set('id',1);
$category->set('category',$packagename);
$modx->log(modX::LOG_LEVEL_INFO,'Category created');

/* add snippets */
$modx->log(modX::LOG_LEVEL_INFO,'Packaging in snippets...');
$snippets = include $sources['data'].'transport.snippets.php';
if (empty($snippets)) $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in snippets.');
$category->addMany($snippets);

/* add chunks */
$modx->log(modX::LOG_LEVEL_INFO,'Packaging in chunks...');
$chunks = include $sources['data'].'transport.chunks.php';
if (empty($chunks)) $modx->log(modX::LOG_LEVEL_ERROR,'Could not package in chunks');
$category->addMany($chunks);

/* create category vehicle */
$attr = array(
    xPDOTransport::UNIQUE_KEY => 'category',
    xPDOTransport::PRESERVE_KEYS => false,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => true,
    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array (
        'Snippets' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => 'name',
        ),
        'Chunks' => array(
            xPDOTransport::PRESERVE_KEYS => false,
            xPDOTransport::UPDATE_OBJECT => true,
            xPDOTransport::UNIQUE_KEY => 'name',
        )
    ),
);
$vehicle = $builder->createVehicle($category,$attr);

/* Attach our resolvers */
$vehicle->resolve('file',array(
    'source' => $sources['source_core'],
    'target' => "return MODX_CORE_PATH . 'components/';",
));
$vehicle->resolve('php',array(
    'source' => $sources['resolvers'] . 'setupoptions.resolver.php',
));
$builder->putVehicle($vehicle);


/* now pack in the license file, readme and setup options */
$builder->setPackageAttributes(array(
    'license' => file_get_contents($sources['docs'] . 'license.txt'),
    'readme' => file_get_contents($sources['docs'] . 'readme.txt'),
    'setup-options' => array(
        'source' => $sources['build'] . 'setup.options.php'
    ),
));

/* zip up package */
$modx->log(modX::LOG_LEVEL_INFO,'Packing up '.$packagename.' transport package zip...');
$builder->pack();

$tend= explode(" ", microtime());
$tend= $tend[1] + $tend[0];
$totalTime= sprintf("%2.4f s",($tend - $tstart));
$modx->log(modX::LOG_LEVEL_INFO,"\n<br />".$packagename."Package Built.<br />\nExecution time: {$totalTime}\n");
exit ();
?>