<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    var userset_store = createStore(false,'muserset_store',[
        'user_id',
        'user_password',        
        'role_id',
        'role_name',
        {name:'aktif', type:'boolean'}
    ],
    '<?php echo base_url(); ?>' + 'user_setting/get_rows');
    var userset_roleid_store = createStore(false,'muserset_role_store',[               
        'role_id',
        'role_name'        
    ],
    '<?php echo base_url(); ?>' + 'user_setting/get_role');
    
    Ext.define('userset_form', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.userset_form',
        id              : 'userset_form',
        requires        : [
            'Ext.form.Field'
        ],
        defaultType     : 'textfield',
        defaults        : {
            allowBlank: false,
            labelAlign: 'left',
            labelWidth: 100
        },
        monitorValid: true,
        url: '<?php echo base_url(); ?>' + 'user_setting/update_rows',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                //                {
                //                    xtype: 'fieldcontainer',                    
                //                    afterLabelTextTpl: required_css,                    
                //                    layout: 'vbox',
                //                    defaultType: 'textfield',
                //
                //                    fieldDefaults: {
                //                        labelAlign: 'left'
                //                    },
                //
                //                    items: [
                {
                    name: 'user_id',
                    fieldLabel:'User Id',
                    id: 'userset_user_id',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css, 
                    allowBlank:false,
                    maxLength:10,
                    width: 50 ,
                    anchor:'90%'                   
                },{
                    name: 'user_password',
                    id: 'userset_user_password',
                    inputType: 'password',
                    fieldLabel:'Password',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,   
                    allowBlank:false,                            
                    width: 200,
                    margins: '0 0 0 5',
                    anchor:'90%'
                            
                }
                ,{
                    xtype: 'combo',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Role',                        
                    id: 'userset_roleid',
                    store: userset_roleid_store,
                    valueField: 'role_id',
                    displayField: 'role_name',
                    typeAhead: true,
                    triggerAction: 'all',                                       
                    //                    editable: false,
                    anchor: '90%',
                    hiddenName: 'role_id',
                    emptyText: 'Role'
                    
                },{
                    xtype:'checkbox',
                    name: 'aktif',
                    id: 'userset_aktif',
                    fieldLabel:'Active',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,                               //                         
                    width: 50,
                    margins: '0 0 0 5',
                    anchor:'90%',
                    boxLabel:'<span style="color:gray;  ">check to activate</span>'
                          
                }
                //                    ]
                //                    
                //                }
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'userset_simpan',
                    id:'userset_simpan_btn',
                    iconCls: 'icon-simpan',
                    handler: this.submit
                },
                {
                    text: 'Batal',
                    action: 'cancel',
                    itemId: 'userset_batal',
                    iconCls: 'icon-cancel',
                    handler: function(){
                        this.up('window').close();
                    }
                }
            ];
            this.callParent(arguments);
        },
        submit: function(){
            var parcmd='insert';            
            
            if(!Ext.getCmp('userset_form').getForm().isValid()){
                set_message(2,'Masih Ada Field Yang Salah!!!');
                return;
            }
            var paruserid=Ext.getCmp('userset_user_id').getValue();
                                           
            var retval=true;
            userset_store.each(function(node){                    
                if(node.data.user_id === paruserid){                                               
                    retval=false;                           
                    return false;
                };                    
            });  
            if (!retval){
                set_message(2,'User ID Sudah Terdaftar!!!');
                return;
            }
            var parroleid=Ext.getCmp('userset_roleid').getValue() ;                     
            Ext.getCmp('userset_form').getForm().submit({
                url: this.url,
                scope: this,
                params: {
                    cmd: parcmd ,
                    role_id:parroleid
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    set_message(0,action.result.msg);
                    Ext.getCmp('userset_grid').store.reload();
                    Ext.getCmp('userset_form').getForm().reset();
                    Ext.getCmp('userset_wind').close();
                },
                failure: function(form, action) {
                    console.log(action.response.responseText);
                    //                    Ext.Msg.alert('Failed', action.result.msg);
                }
            });
        } // eo function submit        
        ,
        showError: function(msg, title){
            title = title || 'Error';
            Ext.Msg.show({
                title: title,
                msg: msg,
                modal: true,
                icon: Ext.Msg.ERROR,
                buttons: Ext.Msg.OK,
                fn: function(btn){
                    if (btn == 'ok' && msg == 'Session Expired') {
                        window.location = '<?= site_url("auth/login") ?>';
                    }
                }
            });
        }
    });
    
   
    Ext.define('userset_wind', {
        extend          : 'Ext.window.Window',
        title           : 'Form Edit Role',
        width           : 400,
        height          : 200,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.userset_edit',
        id              : 'userset_wind',
        maximizable     :true,
        initComponent   : function(){
            this.items = [
                Ext.widget('userset_form')
            ];
            this.callParent(arguments);
        }

    });
    //--------------------------------------------------------------------
    Ext.define('userset_reset_password_form', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.userset_reset_password_form',
        id              : 'userset_reset_password_form',
        requires        : [
            'Ext.form.Field'
        ],
        defaultType     : 'textfield',
        defaults        : {
            allowBlank: false,
            labelAlign: 'left',
            labelWidth: 100
        },
        monitorValid: true,
        url: '<?php echo base_url(); ?>' + 'user_setting/reset_password',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                
                   
                        {
                            name: 'user_id',
                            fieldLabel:'User Id',
                            id: 'userset_user_respwd_id',
                            tooltip: 'Field tidak boleh kosong',
                            afterLabelTextTpl: required_css, 
                            allowBlank:false,
                            maxLength:10,
                            width: 50,
                            readOnly:true,
                            anchor:'90%'
                        },{
                            name: 'user_password',
                            id: 'userset_user_password_reset',
                            fieldLabel:'New Password',
                            inputType:'password',
                            tooltip: 'Field tidak boleh kosong',
                            afterLabelTextTpl: required_css,   
                            allowBlank:false,                            
                            width: 200,
                            anchor:'90%'
//                            margins: '0 0 0 5'
                            
                        }
                    
               
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'userset_respwd_simpan',
                    id:'userset_simpan_respwd_btn',
                    iconCls: 'icon-list-accept',
                    handler: this.submit
                },
                {
                    text: 'Batal',
                    action: 'cancel',
                    itemId: 'userset_respwd_batal',
                    iconCls: 'icon-cancel',
                    handler: function(){
                        this.up('window').close();
                    }
                }
            ];
            this.callParent(arguments);
        },
        submit: function(){
            var parcmd='resetpassword';            
            
            if(!Ext.getCmp('userset_reset_password_form').getForm().isValid()){
                set_message(2,'Masih Ada Field Yang Salah!!!');
                return;
            }            
                                    
            Ext.getCmp('userset_reset_password_form').getForm().submit({
                url: this.url,
                scope: this,
                params: {
                    cmd: parcmd
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    set_message(0,action.result.msg);
                    Ext.getCmp('userset_grid').store.reload();
                    Ext.getCmp('userset_reset_password_form').getForm().reset();
                    Ext.getCmp('userset_reset_password').close();
                },
                failure: function(form, action) {
                    console.log(action.response.responseText);
                    //                    Ext.Msg.alert('Failed', action.result.msg);
                }
            });
        } // eo function submit        
        ,
        showError: function(msg, title){
            title = title || 'Error';
            Ext.Msg.show({
                title: title,
                msg: msg,
                modal: true,
                icon: Ext.Msg.ERROR,
                buttons: Ext.Msg.OK,
                fn: function(btn){
                    if (btn == 'ok' && msg == 'Session Expired') {
                        window.location = '<?= site_url("auth/login") ?>';
                    }
                }
            });
        }
    });
    Ext.define('userset_reset_password', {
        extend          : 'Ext.window.Window',
        title           : 'Reset Hard Password',
        width           : 300,
        height          : 150,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.userset_reset_password_edit',
        id              : 'userset_reset_password',
        //        maximizable     :true,
        initComponent   : function(){
            this.items = [
                Ext.widget('userset_reset_password_form')
            ];
            this.callParent(arguments);
        }

    });
    //--------------------------------------------------------------------
    Ext.define('MyTabUserSetting',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabUserSetting',
        alias: 'widget.UserSetting',
        title: 'User Setting',
        id: 'tab2b',
        closable: true,        
        layout: 'border',
        items: [
            {
                xtype: 'panel',
                autoShow: true,
                id: 'userset_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'border',
                items:[
                    {
                        xtype:'grid',
                        region:'center',                           
                        id:'userset_grid',
                        //                        width:450,
                        store: userset_store,
                        stripeRows: true,
                        loadMask: true,
                        stateful:true,
                        stateId:'stateGrid'                        
                        ,columns:[
                            {
                                xtype: 'actioncolumn',
                                header: 'Delete',
                                menuDisabled: true,
                                sortable: false,                                
                                width: 50,
                                align:'center',
                                items: [
                                    {
                                        iconCls: 'icon-user-delete',
                                        tooltip: 'Delete User',
                                        handler: function(grid, rowIndex, colIndex) {
                                            var rec = grid.getStore().getAt(rowIndex);
                                            Ext.Msg.show({
                                                title: 'Confirm',
                                                msg: 'Are you sure delete selected row ?',
                                                buttons: Ext.Msg.YESNO,
                                                icon: Ext.Msg.QUESTION,
                                                fn: function(btn){
                                                    if (btn == 'yes') {
                                                                
                                                        var data = '';
                                                        data = Ext.JSON.encode(rec.data);
                                                        set_user_update(rec.data,'delete','delete_row');                                                                                   
                                                    } 
                                                }
                                            });
                                        }
                                    }
                                ]
                                
                            },{
                                header:'User ID',
                                dataIndex:'user_id',
                                sortable: true,
                                width: 100
                            },{
                                header:'Password',
                                dataIndex:'user_password',
                                sortable: true,
                                width: 200
                            },{
                                header:'Role ID',
                                dataIndex:'role_id',
                                sortable: true,
                                width: 50
                            },{
                                header:'Role Name',
                                dataIndex:'role_name',
                                sortable: true,
                                width: 200
                            },{
                                xtype:'checkcolumn',
                                header:'Active',
                                dataIndex:'aktif',
                                sortable: false,
                                width: 50,
                                disabled:false,
                                listeners:{
                                    checkchange:function( grid, rowIndex, checked, eOpts ){
                                        //                                        var rec = Ext.getCmp('userset_grid').getStore().getAt(rowIndex);
                                        if(checked){
                                            Ext.Msg.show({
                                                title: 'Confirm',
                                                msg: 'Are you sure to Enabled this user ?',
                                                buttons: Ext.Msg.YESNO,
                                                icon: Ext.Msg.QUESTION,
                                                fn: function(btn){
                                                    if (btn == 'yes') {
                                                        var rec = Ext.getCmp('userset_grid').getStore().getAt(rowIndex);                                                                                                                
                                                        set_user_update(rec.data,'setaktif','set_aktif');
                                                    }else{
                                                        Ext.getCmp('userset_grid').getStore().reload();
                                                    }
                                                    
                                                }
                                            });
                                        }else{
                                            Ext.Msg.show({
                                                title: 'Confirm',
                                                msg: 'Are you sure to Disabled this user ?',
                                                buttons: Ext.Msg.YESNO,
                                                icon: Ext.Msg.QUESTION,
                                                fn: function(btn){
                                                    if (btn == 'yes') {
                                                        var rec = Ext.getCmp('userset_grid').getStore().getAt(rowIndex);                                                                                                                
                                                        set_user_update(rec.data,'setaktif','set_aktif');
                                                    }else{
                                                        Ext.getCmp('userset_grid').getStore().reload();
                                                    }
                                                }
                                            });
                                        }
                                    }
                                }
                            },{
                                xtype: 'actioncolumn',
                                header: 'Reset Password',
                                menuDisabled: true,
                                sortable: false,                                
                                width: 100,
                                align:'center',
                                items: [
                                    {
                                        iconCls: 'icon-key',
                                        tooltip: 'Reset Password',
                                        handler: function(grid, rowIndex, colIndex) {
                                            var rec = grid.getStore().getAt(rowIndex);
                                            Ext.Msg.show({
                                                title: 'Confirm',
                                                msg: 'Are you sure to reset users password ?',
                                                buttons: Ext.Msg.YESNO,
                                                icon: Ext.Msg.QUESTION,
                                                fn: function(btn){
                                                    if (btn == 'yes') {
                                                       var winrespwd=Ext.create('userset_reset_password');
                                                          Ext.getCmp('userset_user_respwd_id').setValue(rec.get('user_id'));
                                                          winrespwd.show();
//                                                        var data = '';
//                                                        data = Ext.JSON.encode(rec.data);
//                                                        set_user_update(rec.data,'resetpassword','reset_password');                                                                                   
                                                    } 
                                                }
                                            });
                                        }
                                    }
                                ]
                                
                            }
                        ]
                        ,
                        tbar: [{
                                xtype: 'toolbar',
                                items: [
                                    {
                                        xtype: 'button',
                                        text: 'Add',
                                        iconCls: 'icons-add',
                                        onClick: function(){
                                            var winuserset=Ext.create('userset_wind');
                                            winuserset.setTitle('Add Form');
                                            Ext.getCmp('userset_simpan_btn').setText('Simpan');
                                            Ext.getCmp('userset_simpan_btn').setIconCls('icons-add'); 
                                            userset_roleid_store.load();
                                            winuserset.show();
                                        }
                                    },
                                    {
                                        xtype: 'searchfield',
                                        store: userset_store,
                                        width: 380,
                                        emptyText: 'Quick Search...'
                                    }]
                            }]
                        ,bbar: 
                            {xtype: 'pagingtoolbar',   
                            pageSize: ENDPAGE,
                            store: userset_store,
                            displayInfo: true
                        }                           
                   
                    }
                ]
            }
        ]
        ,listeners:{
            show:function(){
                var storegrid=Ext.getCmp('userset_grid').store;
                storegrid.load();
            }   
        }
    });
    
    function set_user_update(rec,cmd,vurl){
    
        var parcmd=cmd;
        var parUrl='<?php echo base_url(); ?>' +'user_setting/' + vurl;
        var data = '';
        data = Ext.JSON.encode(rec);
                                                                    
        Ext.Ajax.request({                                                            
            url: parUrl,
            method: 'POST',
            params: {
                cmd: parcmd,
                postdata: data
            },
            success: function(obj) {
                var   resp = Ext.decode(obj.responseText);                                                                
                if(resp.success==true){
                    set_message(0,resp.msg);
                    Ext.getCmp('userset_grid').store.reload();
                                                                    
                }else{
                    Ext.Msg.show({
                        title: 'Error',
                        msg: resp.msg,
                        modal: true,
                        icon: Ext.Msg.ERROR,
                        buttons: Ext.Msg.OK,
                        fn: function(btn){
                            if (btn == 'ok' && resp.msg == 'Session Expired') {
                                window.location = '<?= site_url("auth/login") ?>';
                            }
                        }
                    });
                }
            },
            failure: function(obj) {
                var  resp = Ext.decode(obj.responseText);
                Ext.Msg.alert('info',resp.reason);
            }
        }); 
    }
</script>