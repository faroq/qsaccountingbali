<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    var roleset_master_store = createStore(false,'mroleset_master_store',[
        'role_id',
        'role_name',
        {name:'active',type:'boolean'}],
    '<?php echo base_url(); ?>' + 'role_setting/get_rows');
    var url_roleset_detail='<?php echo base_url(); ?>' + 'role_setting/get_detail';
    var roleset_detail_store = Ext.create('Ext.data.TreeStore',{
        autoLoad :false,
        fields:[{name:'text',type:'string'}],
        root: {
            expanded: true
        },
        proxy: {
            type: 'ajax',
            url: url_roleset_detail
        }
        //            ,folderSort: true

    });
    //,{name:'selected',type:'boolean'},{name:'id',type:'string'}
    var roleset_detail_edit= Ext.create('Ext.data.TreeStore',{
        autoLoad :false,
        fields:[{name:'text',type:'string'}],
        root: {
            expanded: true
        },
        proxy: {
            type: 'ajax',
            url: '<?php echo base_url(); ?>' + 'role_setting/get_detail_edit'
        }
        //            ,folderSort: true

    });
    Ext.define('roleset_form', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.roleset_form',
        id              : 'roleset_form',
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
        url: '<?php echo base_url(); ?>' + 'role_setting/update_rows',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                {
                    xtype: 'fieldcontainer',
                    //                    fieldLabel: 'Department',
                    afterLabelTextTpl: required_css,
                    //                    labelStyle: 'font-weight:bold;padding:0;',
                    layout: 'hbox',
                    defaultType: 'textfield',

                    fieldDefaults: {
                        labelAlign: 'top'
                    },

                    items: [{
                            name: 'role_id',
                            fieldLabel:'Role Id',
                            id: 'roleset_role_id',
                            tooltip: 'Field tidak boleh kosong',
                            afterLabelTextTpl: required_css, 
                            allowBlank:false,
                            maxLength:2,
                            maskRe:/\d/,
                            //                            readOnly:true,
                            width: 50
                    
                        },
                        {
                            name: 'role_name',
                            id: 'roleset_role_name',
                            fieldLabel:'Role Name',
                            tooltip: 'Field tidak boleh kosong',
                            afterLabelTextTpl: required_css,   
                            allowBlank:false,
                            //                            flex:2,
                            width: 200,
                            margins: '0 0 0 5'
                            
                        },{
                            xtype:'checkbox',
                            name: 'active',
                            id: 'roleset_role_active',
                            fieldLabel:'Active',
                            tooltip: 'Field tidak boleh kosong',
                            afterLabelTextTpl: required_css,                               //                         
                            width: 50,
                            margins: '0 0 0 5'
                          
                        }
                    ]
                    
                },{                        
                    xtype:'treepanel',
                    title: 'Menu Detail',
                    height: 320,
                    id:'roleset_menu_id',
                    //                        collapsible: true,
                    useArrows: true,
                    rootVisible: false,
                    store: roleset_detail_edit,
                    multiSelect: true,
                    autoScroll:true,
                    expandAll:true,
                    columns:[
                        {xtype: 'treecolumn', //this is so we know which column will show the tree
                            text: 'Main Menu',
                            flex: 1,
                            sortable: false,
                            dataIndex: 'text'
                        }
                    ]                   
                }      
                
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'roleset_simpan',
                    id:'roleset_simpan_btn',
                    iconCls: 'save',
                    handler: this.submit
                },
                {
                    text: 'Batal',
                    action: 'cancel',
                    itemId: 'roleset_batal',
                    iconCls: 'cancel',
                    handler: function(){
                        this.up('window').close();
                    }
                }
            ];
            this.callParent(arguments);
        },
        submit: function(){
            var parcmd=Ext.getCmp('roleset_simpan_btn').getText();
            if(parcmd === 'Simpan'){               
                parcmd='insert';
            }else if(parcmd === 'Edit'){
                parcmd='update';
            }
            
            if(!Ext.getCmp('roleset_form').getForm().isValid()){
                set_message(2,'Masih Ada Field Yang Salah!!!');
                return;
            }
            var parroleid=Ext.getCmp('roleset_role_id').getValue();
            if(parcmd==='insert'){                                
                var retval=true;
                roleset_master_store.each(function(node){                    
                    if(node.data.role_id === parroleid){                                               
                        retval=false;                           
//                        return false;
                    };                    
                });  
                if (!retval){
                    set_message(2,'Role ID Sudah Terdaftar!!!');
                    return;
                }
            }
            var arr_menu=new Array();
            var vtree=Ext.getCmp('roleset_menu_id').getChecked();           
            if(vtree){
                Ext.each(vtree,function(node){                        
                    arr_menu.push({role_id:parroleid,idmenu:node.data.id});                
                });
            }
                        
            Ext.getCmp('roleset_form').getForm().submit({
                url: this.url,
                scope: this,
                params: {
                    cmd: parcmd,
                    rolemenu:Ext.JSON.encode(arr_menu)
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    set_message(0,action.result.msg);
                    Ext.getCmp('roleset_master').store.reload();
                    Ext.getCmp('roleset_form').getForm().reset();
                    Ext.getCmp('roleset_wind').close();
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
    
    
    Ext.define('roleset_wind', {
        extend          : 'Ext.window.Window',
        title           : 'Form Edit Role',
        width           : 400,
        height          : 450,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.roleset_edit',
        id              : 'roleset_wind',
        maximizable     :true,
        initComponent   : function(){
            this.items = [
                Ext.widget('roleset_form')
            ];
            this.callParent(arguments);
        }

    });
    
    Ext.define('MyTabRoleSetting',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabRoleSetting',
        alias: 'widget.RoleSetting',
        title: 'Role Setting',
        id: 'tab2a',
        closable: true,        
        layout: 'border',
        items: [{
                xtype: 'panel',
                autoShow: true,
                id: 'roleset_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'border',
                items:[{
                        xtype:'grid',
                        region:'center',                           
                        id:'roleset_master',
                        //                        width:450,
                        store: roleset_master_store,
                        stripeRows: true,
                        loadMask: true,
                        stateful:true,
                        stateId:'stateGrid'                        
                        ,columns:[
                            {
                                xtype: 'actioncolumn',
                                header: 'Edit/Delete',
                                menuDisabled: true,
                                sortable: false,                                
                                width: 70,
                                items: [
                                    {
                                        iconCls: 'icon-edit-record',
                                        tooltip: 'Edit Row',
                                        handler: function(grid, rowIndex, colIndex) {   
                                            var rec = grid.getStore().getAt(rowIndex);
                                            var winroleset=Ext.create('roleset_wind');
                                            winroleset.setTitle('Edit Form');
                                            Ext.getCmp('roleset_simpan_btn').setText('Edit');
                                            Ext.getCmp('roleset_simpan_btn').setIconCls('icon-edit-record');
                                            Ext.getCmp('roleset_role_id').setValue(rec.get('role_id'));
                                            Ext.getCmp('roleset_role_id').setReadOnly(true);
                                            Ext.getCmp('roleset_role_id').setFieldStyle('readonly-input');
                                            Ext.getCmp('roleset_role_name').setValue(rec.get('role_name'));
                                            Ext.getCmp('roleset_role_active').setValue(rec.get('active'));
                                            roleset_detail_edit.load({params:{roleid:rec.get('role_id'),checked:1}});
                                            winroleset.show();
                                        }
                                    },{
                                        getClass: function(v, meta, rec) {
                                            return 'icon-delete';
                                        },
                                        getTip: function(v, meta, rec) {
                                            return 'Delete Plant';
                                        },
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
                                                                    
                                                        Ext.Ajax.request({                                                            
                                                            url: '<?php echo base_url(); ?>' +'role_setting/delete_row',
                                                            method: 'POST',
                                                            params: {
                                                                cmd: 'delete',
                                                                postdata: data
                                                            },
                                                            success: function(obj) {
                                                                var   resp = Ext.decode(obj.responseText);                                                                
                                                                if(resp.success==true){
                                                                    set_message(0,resp.msg);
                                                                    Ext.getCmp('roleset_master').store.reload();
                                                                    Ext.getCmp('roleset_detail').store.load();
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
                                                }
                                            });
                                        }
                                    }]
                                
                            },{
                                header:'Role ID',
                                dataIndex:'role_id',
                                sortable: true,
                                width: 50
                            },{
                                header:'Role Name',
                                dataIndex:'role_name',
                                sortable: true,
                                width: 250
                            },{
                                xtype:'checkcolumn',
                                header:'Active',
                                dataIndex:'active',
                                sortable: false,
                                width: 50,
                                disabled:true
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
                                            var winroleset=Ext.create('roleset_wind');
                                            winroleset.setTitle('Add Form');
                                            Ext.getCmp('roleset_simpan_btn').setText('Simpan');
                                            Ext.getCmp('roleset_simpan_btn').setIconCls('icons-add');
                                            roleset_detail_edit.load();                                      
                                            winroleset.show();
                                        }
                                    },
                                    {
                                        xtype: 'searchfield',
                                        store: roleset_master_store,
                                        width: 380,
                                        emptyText: 'Quick Search...'
                                    }]
                            }]
                        ,bbar: 
                            {xtype: 'pagingtoolbar',   
                            pageSize: ENDPAGE,
                            store: roleset_master_store,
                            displayInfo: true
                        }   
                        ,listeners:{
                            itemclick:function( scope, record, item, index, e, eOpts ){
                                //                                console.log(record.data.role_id);
                                var vroleid=record.data.role_id;                                
                                roleset_detail_store.load({params:{roleid:vroleid}});                                
                            }
                        }
                   
                    },{
                        region:'east',
                        xtype:'treepanel',
                        title: 'Menu Detail',
                        id:'roleset_detail',
                        width: 500,
                        collapsible: true,
                        useArrows: true,
                        rootVisible: false,
                        store: roleset_detail_store,
                        multiSelect: false,
                        expandAll:true,
                        columns:[
                            {xtype: 'treecolumn', //this is so we know which column will show the tree
                                text: 'Main Menu',
                                flex: 1,
                                sortable: true,
                                dataIndex: 'text'}
                        ]
                    }
                        
                ]
            }]
        ,listeners:{
            show:function(){
                var storegrid=Ext.getCmp('roleset_master').store;
                storegrid.load();
                    
                
            }
        }
        
    });
    
</script>
