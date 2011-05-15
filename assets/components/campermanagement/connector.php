<?php

require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('campermgmt.core_path',null,$modx->getOption('core_path').'components/campermanagement/');
require_once $corePath.'model/campermanagement/campermanagement.class.php';
$modx->campermgmt = new CamperManagement($modx);

$modx->lexicon->load('campermgmt:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->campermgmt->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));