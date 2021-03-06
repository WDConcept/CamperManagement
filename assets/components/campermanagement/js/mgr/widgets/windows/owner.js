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

CamperMgmt.newOwnerWindow = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        title: _('campermgmt.owner.new'),
        url: CamperMgmt.config.connectorUrl,
        baseParams: {
            action: 'mgr/index/saveowner'
        },
        fields: [{
            xtype: 'hidden',
            name: 'id'
        },{
            xtype: 'textfield',
            fieldLabel: _('campermgmt.field.firstname'),
            name: 'firstname',
            allowBlank: false
        },{
            xtype: 'textfield',
            fieldLabel: _('campermgmt.field.lastname'),
            name: 'lastname',
            allowBlank: false
        },{
            xtype: 'textfield',
            fieldLabel: _('campermgmt.field.address'),
            name: 'address'
        },{
            xtype: 'textfield',
            fieldLabel: _('campermgmt.field.email'),
            name: 'email'
        },{
            xtype: 'textfield',
            fieldLabel: _('campermgmt.field.phone1'),
            name: 'phone1'
        },{
            xtype: 'textfield',
            fieldLabel: _('campermgmt.field.phone2'),
            name: 'phone2'
        },{
            xtype: 'textfield',
            fieldLabel: _('campermgmt.field.postal'),
            name: 'postal'
        },{
            xtype: 'textfield',
            fieldLabel: _('campermgmt.field.city'),
            name: 'city'
        },{
            xtype: 'textfield',
            fieldLabel: _('campermgmt.field.country'),
            name: 'country',
            value: _('campermgmt.field.country.default')
        },{
            xtype: 'numberfield',
            fieldLabel: _('campermgmt.field.bank'),
            name: 'bank'
        }]
    });
    CamperMgmt.newOwnerWindow.superclass.constructor.call(this,config);
};
Ext.extend(CamperMgmt.newOwnerWindow,MODx.Window);
Ext.reg('campermgmt-newownerwindow',CamperMgmt.newOwnerWindow);