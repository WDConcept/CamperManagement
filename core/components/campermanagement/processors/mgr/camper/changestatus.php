<?php
/*
 * CamperManagement
 *
 * Copyright 2011 by Mark Hamstra <business@markhamstra.nl>
 *
 * This file is part of CamperManagement, a camper/caravan inventory management
 * addon for MODX Revolution.
 *
 * CamperManagement is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * CamperManagement is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * CamperManagement; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
 * Suite 330, Boston, MA 02111-1307 USA
 *
 */
if (empty($scriptProperties['id'])) {
    return $modx->error->failure($modx->lexicon('campermgmt.error.noid'));
}
if (!is_numeric($scriptProperties['id'])) {
    return $modx->error->failure($modx->lexicon('campermgmt.error.id_invalid'));
}

if ((empty($scriptProperties['newstatus']) && ($scriptProperties['newstatus'] != 0)) || (!is_numeric($scriptProperties['newstatus']))) {
    return $modx->error->failure($modx->lexicon('campermgmt.error.status_nf'));
}
$camper = $modx->getObject('cmCamper',(int)$scriptProperties['id']);
if (!($camper instanceof cmCamper)) {
    return $modx->error->failure($modx->lexicon('campermgmt.error.camper_nf',array('id' => $scriptProperties['id'])));
}

if (in_array($newstatus,array(0,5))) {
    if ($camper->get('status') != 5) {
        $camper->set('archived',time());
    }
} else {
    if (in_array($camper->get('status'),array(0,5))) {
        $camper->set('archived',0);
    }
}

$camper->set('status',$scriptProperties['newstatus']);

$result = $camper->save();
if ($result !== true) {
    return $modx->error->failure($modx->lexicon('campermgmt.error.undefined'));
}

return $modx->error->success();