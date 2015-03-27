<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript"> 
    var mst_reporting_account_store=createStore(false, 'mmst_reporting_account_store', [
        'id',
        'report_type',
        'rekening',
        'nama_rekening'
    ], '<?php echo base_url(); ?>' + 'report_account/get_rows');
    
    
    var cmb_reporting_account_store=createStore(false, 'mcmb_reporting_account_store', [
        'id',
        'report_type',        
    ], '<?php echo base_url(); ?>' + 'global_reference/get_report_type');
    
    //=========================================================
    var store_mrepacc_akun = createStore(false,'store_mrepacc_akun',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
    
        
    defineTwinAkun_windows('Window_mrepacc_akun','window_mrepacc_akun',store_mrepacc_akun,
    function(){
        var sm = this.getSelectionModel();
        var sel = sm.getSelection();
        if (sel.length > 0) {				
            Ext.getCmp('mp_mrepacc_akun').setValue(sel[0].get('rekening'));
            Ext.getCmp('id_mrepacc_akun').setValue(sel[0].get('nama_rekening'));                    
            Ext.getCmp('window_mrepacc_akun').close();
            //                                        Ext.getCmp('ej_grid_debet').focus();
        }
    }
);
    
    Ext.define('FormMREPACC', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.mrepaccForm',
        id              : 'FormMREPACC_id',
        requires        : [
            'Ext.form.Field'
        ],
        defaultType     : 'textfield',
        defaults        : {
            allowBlank: false,
            labelAlign: 'left',
            labelWidth: 80
        },
        monitorValid: true,
        url: '<?php echo base_url(); ?>' + 'report_account/update_rows',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                //                    cbjenis,                
                {
                    name: 'id',
                    anchor:'90%',
                    id: 'id_mrepacc',
//                    tooltip: 'Field tidak boleh kosong',
//                    afterLabelTextTpl: required_css,
                    fieldLabel: 'ID',
//                    fieldStyle: 'text-transform:uppercase;',
                    maxLength:20,
                    allowBlank:true,
                    hidden:true
//                    listeners: {
//                        change: function(field, newValue, oldValue) {
//                            field.setValue(newValue.toUpperCase());
//                        }
//                    }

                }
                ,{
                    xtype: 'combo',                        
                    name:'report_type',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Report_type',                        
                    id: 'mrepacc_report_type',
                    mode:'local',
                    store: cmb_reporting_account_store,
                    valueField: 'report_type',
                    displayField: 'report_type',
                    typeAhead: true,
                    triggerAction: 'all',                    
                    allowBlank: false,
                    editable: false,
                    anchor: '90%',
                    hiddenName: 'report_type'
                    ,
                    emptyText: 'Report Type'              
                },
                {
                    xtype: 'fieldcontainer',
                    fieldLabel: 'Rekening',
                    afterLabelTextTpl: required_css,
                    //                    labelStyle: 'font-weight:bold;padding:0;',
                    layout: 'hbox',
                    defaultType: 'textfield',

                    fieldDefaults: {
                        labelAlign: 'top'
                    },

                    items: [{
                            xtype: 'twincombo',
                            id:'mp_mrepacc_akun',
                            store:store_mrepacc_akun,
                            menu:'Window_mrepacc_akun',
                            width: 95,
                            name: 'rekening',
                            itemId: 'rekening',
                            afterLabelTextTpl: required_css,//                        fieldLabel: 'First',
                            allowBlank: false
                        }, {
                            flex: 1,
                            itemId: 'nama_rekening',
                            id:'id_mrepacc_akun',
                            name: 'nama_rekening',
                            readOnly:true

                        }]
                }                
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'simpan',
                    id:'btn_mrepacc_simpan',
                    iconCls: 'save',
                    formBind: true,
                        scope: this,
                    handler: this.submit
                },
                {
                    text: 'Batal',
                    action: 'cancel',
                    itemId: 'batal',
                    iconCls: 'icon-cancel',
                    handler: function(){
                        this.up('window').close();
                    }
                }
            ];
            this.callParent(arguments);
        },
        submit: function(){
            var parcmd=Ext.getCmp('btn_mrepacc_simpan').getText();
            if(parcmd === 'Simpan'){
                parcmd='insert';
            }else if(parcmd === 'Edit'){
                parcmd='update';
//                console.log(parcmd);
            }
        
                    
            Ext.getCmp('FormMREPACC_id').getForm().submit({
                url: this.url,
                scope: this,
                //                success: this.onSuccess,
                //                failure: this.onFailure,
                params: {
                    cmd: parcmd                  
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    //                    console.log(action);
                    set_message(0,action.result.msg);
                    //                    Ext.Msg.alert('Success', action.result.msg);
                    Ext.getCmp('mst_reporting_account_grid').store.reload(); 
                    Ext.getCmp('FormMREPACC_id').getForm().reset();
                    Ext.getCmp('WindowMREPACC_id').close();
                },
                failure: function(form, action) {
                    if(action.result.msg=='Session Expired') {
                        session_expired(action.result.msg);
                    }else{
                        set_message(1, action.result.msg);
                    }
                                            
                    
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

    Ext.define('WindowMREPACC', {
        extend          : 'Ext.window.Window',
        title           : 'Form Edit User',
        width           : 400,
        height          : 200,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.MREPACCEdit',
        id              : 'WindowMREPACC_id',
        initComponent   : function(){
            this.items = [
                Ext.widget('mrepaccForm')
            ];
            this.callParent(arguments);
        }

    });
    
    
    Ext.define('MyTabMasterReportingAccount',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabMasterReportingAccount',
        alias: 'widget.MasterReportingAccount',
        title: 'Master Reporting Account',
        id: 'tab1c3',
        closable: true,        
        layout: 'border',
        items: [
            {
                xtype: 'panel',
                autoShow: true,
                id: 'mst_reporting_account_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'mst_reporting_account_grid',
                        stateful:true,
                        stateId:'stateGridMREP',
                        store: mst_reporting_account_store,//Ext.data.StoreManager.lookup('mst_account_kel_store'),
                        stripeRows: true,
                        loadMask: true,
                        //                        sm:sm_mst_account_kel,
                        columns:[
                            {
                                header: 'Edit/Delete',
                                menuDisabled: true,
                                sortable: false,
                                xtype: 'actioncolumn',
                                width: 70,
                                items: [
                                    {
                                        iconCls: 'icon-edit-record',
                                        tooltip: 'Edit Row',
                                        handler: function(grid, rowIndex, colIndex) {
                                            var rec = grid.getStore().getAt(rowIndex);
                                            var winmacc=Ext.create('WindowMREPACC');
                                            winmacc.setTitle('Edit Form');
                                            Ext.getCmp('mrepacc_report_type').getStore().reload();
                                            Ext.getCmp('btn_mrepacc_simpan').setText('Edit');
                                            Ext.getCmp('btn_mrepacc_simpan').setIconCls('icon-edit-record');                                            
                                            Ext.getCmp('id_mrepacc').setValue(rec.get('id'));
                                            Ext.getCmp('mrepacc_report_type').setValue(rec.get('report_type')); 
                                            Ext.getCmp('mp_mrepacc_akun').setValue(rec.get('rekening'));
                                            Ext.getCmp('id_mrepacc_akun').setValue(rec.get('nama_rekening'));
                                            
//                                            if (rec.get('flag') == '*')
//                                                Ext.getCmp('mst_account_kel_flag_txt').setValue(true);
//                                            else
//                                                Ext.getCmp('mst_account_kel_flag_txt').setValue(false);
                                            winmacc.show();
                                            //                                            Ext.Msg.alert('Edit', 'Edit ' + rec.get('rekening'));
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
                                            console.log(rec.data);
                                            //                                            Ext.Msg.alert('Delete', 'Delete ' + rec.get('rekening'));
//                                            Ext.Msg.show({
//                                                title: 'Confirm',
//                                                msg: 'Are you sure delete selected row ?',
//                                                buttons: Ext.Msg.YESNO,
//                                                icon: Ext.Msg.QUESTION,
//                                                fn: function(btn){
//                                                    if (btn == 'yes') {
//                    
//                                                        var data = '';
//                                                        data = Ext.JSON.encode(rec.data);
//                        
//                                                        Ext.Ajax.request({                                                            
//                                                            url: '<?php echo base_url(); ?>' +'mst_account_kel/delete_row',
//                                                            method: 'POST',
//                                                            params: {
//                                                                cmd: 'delete',
//                                                                postdata: data
//                                                            },
//                                                            success: function(obj) {
//                                                                var   resp = Ext.decode(obj.responseText);                                                                
//                                                                if(resp.success==true){
//                                                                    set_message(0,resp.msg);
//                                                                    Ext.getCmp('mst_account_kel_grid').store.reload();
//                                                                }else{
//                                                                    Ext.Msg.show({
//                                                                        title: 'Error',
//                                                                        msg: resp.msg,
//                                                                        modal: true,
//                                                                        icon: Ext.Msg.ERROR,
//                                                                        buttons: Ext.Msg.OK,
//                                                                        fn: function(btn){
//                                                                            if (btn == 'ok' && resp.msg == 'Session Expired') {
//                                                                                window.location = '<?= site_url("auth/login") ?>';
//                                                                            }
//                                                                        }
//                                                                    });
//                                                                }
//                                                            },
//                                                            failure: function(obj) {
//                                                                var  resp = Ext.decode(obj.responseText);
//                                                                Ext.Msg.alert('info',resp.reason);
//                                                            }
//                                                        });                 
//                                                    } 
//                                                }
//                                            });
                                        }
                                    }
                                ]
                            },
                            {
                                header: "ID",
                                dataIndex: 'id',
                                sortable: true,
                                width: 70,
                                hidden:true
                            },
                            {
                                header: "Report Type",
                                dataIndex: 'report_type',
                                sortable: true,
                                width: 80
                            },
                            {
                                header: "Rekening",
                                dataIndex: 'rekening',
                                sortable: true,
                                width: 100                                
                            },
                            {
                                header: "Nama Rekening",
                                dataIndex: 'nama_rekening',
                                sortable: true,
                                width: 150
                            }
                        ]
                        ,tbar:{
                            xtype: 'toolbar',
                            padding:'2 0 2 5',
                            items: [{
                                    xtype: 'button',
                                    text: 'Add',
                                    iconCls: 'icons-add',
                                    onClick: function(){
                                        var winmacc=Ext.create('WindowMREPACC');
                                        winmacc.setTitle('Add Form');
                                        Ext.getCmp('btn_mrepacc_simpan').setText('Simpan');
                                        Ext.getCmp('btn_mrepacc_simpan').setIconCls('icons-add');//                                        
                                        winmacc.show();
                                    }
                                },'-',{
                                    width: 300,
                                    xtype: 'searchfield',
                                    store: mst_reporting_account_store,
                                    emptyText: 'Quick Search...'
                                }
                            ]
                        }
                        ,bbar:{                        
                            xtype: 'pagingtoolbar',
                            store: mst_reporting_account_store,pageSize: ENDPAGE,
                            displayInfo: true
                        }

                    }
                ]
            
            }
        ]
        ,listeners:{
            show:function(){
                var storegrid=Ext.getCmp('mst_reporting_account_grid').store;                
                storegrid.loadPage(1);
                cmb_reporting_account_store.load();
                //                KelompokAccountStore.load();    
                
            }
        
        }
        , initComponent: function() {
            this.callParent(arguments);
        }
        
    });
</script>