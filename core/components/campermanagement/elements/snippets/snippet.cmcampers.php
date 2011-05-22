<?php
/**
 * @package campermanagement
 */

// NOT for production use.
$base_path = !empty($base_path) ? $base_path : $modx->getOption('core_path').'components/campermanagement/';

$modelPath = $base_path.'model/';
$modx->addPackage('campermanagement',$modelPath);

if ($_GET['createtables'] == 'do') {
$manager = $modx->getManager();

$manager->createObjectContainer('cmCamper');
$manager->createObjectContainer('cmCamperOptions');
$manager->createObjectContainer('cmOption');
$manager->createObjectContainer('cmBrand');
$manager->createObjectContainer('cmOwner');
}



echo '<pre>';

$start = $modx->getOption('start',$scriptProperties,0);
$limit = $modx->getOption('limit',$scriptProperties,50);
$sort = $modx->getOption('sort',$scriptProperties,'keynr');
$dir = $modx->getOption('dir',$scriptProperties,'asc');

$results = array();

$query = $modx->newQuery('cmCamper');
$query->sortby($sort,$dir);

$count = $modx->getCount('cmCamper',$query);

$query->limit($limit,$start);
$campers = $modx->getCollectionGraph('cmCamper','{ "Brand":{}, "Owner": {}, "CamperOptions":{"Options":{}}}',$query);

foreach ($campers as $camper) {
    $array = array();
    $array = $camper->toArray();
    $array['brand'] = ($camper->Brand) ? $camper->Brand->get('name') : 'n/a';
    $array['owner'] = ($camper->Owner) ? $camper->Owner->get('lastname') : 'n/a';
    $array['options'] = array();
    foreach ($camper->CamperOptions as $opt) {
        $array['options'][] = $opt->Options->get('name');
    }
    //$array['options'] = implode(", ",$array['options']);
    $results[] = $array;
}
print_r($results);
echo '</pre>';
return;