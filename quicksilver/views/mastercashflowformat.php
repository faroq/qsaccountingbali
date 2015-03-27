<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript"> 
    var mcff_store=createStore(false, 'mmcff_store', [
        'id',
        'keterangan',
        'mutasi'        
    ], '<?php echo base_url(); ?>' + 'master_cashflow/get_rows_format');
    
    var mutasi_store=createStore(false, 'mmutasi_store', [
        'status',
        'default'        
    ], '<?php echo base_url(); ?>' + 'global_reference/get_plusmin');
    //=================================================================
    
  
    
    Ext.define('mcff_form', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.mcff_form',
        id              : 'mcff_form',
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
        url: '<?php echo base_url(); ?>' + 'master_cashflow/update_rows_format',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                {
                    //                    xtype: 'numericfield',
                    name: 'id',
                    id: 'mcff_id',
//                    tooltip: 'Field tidak boleh kosong',
//                    afterLabelTextTpl: required_css,
                    fieldLabel: 'ID',
                    anchor: '50%',
                    hiddenName:'id',
                    allowBlank: true,
                    hidden:true
//                    ,maxLength:4
//                    ,maskRe:/\d/
                },
                {
                    name: 'keterangan',
                    id: 'mcff_keterangan',                    
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldStyle: 'text-transform:uppercase;',
                    fieldLabel: 'Keterangan',
                    anchor:'100%',
                    listeners: {
                        change: function(field, newValue, oldValue) {
                            field.setValue(newValue.toUpperCase());
                        }
                    }
                }
                ,                
                {
                    xtype: 'combo',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Mutasi',
                    id: 'mcff_mutasi',
                    name: 'mutasi',
                    store: mutasi_store,
                    valueField: 'status',
                    displayField: 'default',
                    typeAhead: true,
                    triggerAction: 'all',
                    allowBlank: false,
                    editable: false,
                    anchor: '60%',
                    hiddenName: 'mutasi',
                    emptyText: ' +/- '
//                    ,width: 50
                }
                     
                
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'mcff_simpan',
                    id:'mcff_simpan_btn',
                    iconCls: 'save',
                    formBind: true,
                        scope: this,
                    handler: this.submit
                },
                {
                    text: 'Batal',
                    action: 'cancel',
                    itemId: 'mcff_batal',
                    iconCls: 'icon-cancel',
                    handler: function(){
                        this.up('window').close();
                    }
                }
            ];
            this.callParent(arguments);
        },
        submit: function(){
            var parcmd=Ext.getCmp('mcff_simpan_btn').getText();
            if(parcmd === 'Simpan'){               
                parcmd='insert';
            }else if(parcmd === 'Edit'){
                parcmd='update';
            }
            if(!Ext.getCmp('mcff_form').getForm().isValid()){
                set_message(2,'Masih Ada Field Yang Salah!!!');
                return;
            }
            
            Ext.getCmp('mcff_form').getForm().submit({
                url: this.url,
                scope: this,
                params: {
                    cmd: parcmd                    
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    set_message(0,action.result.msg);
                    Ext.getCmp('mcff_grid').store.reload();
                    Ext.getCmp('mcff_form').getForm().reset();
                    Ext.getCmp('mcff_wind').close();
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

    Ext.define('mcff_wind', {
        extend          : 'Ext.window.Window',
        title           : 'Form Edit User',
        width           : 400,
        height          : 150,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.mcff_edit',
        id              : 'mcff_wind',
        initComponent   : function(){
            this.items = [
                Ext.widget('mcff_form')
            ];
            this.callParent(arguments);
        }

    });
    
    //=================================================================
    Ext.define('MyTabMasterCashFlowFormat',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabMasterCashFlowFormat',
        alias: 'widget.MasterCashFlowFormat',
        title: 'Master CashFlow Format',
        id: 'tab1c4',
        closable: true,        
        layout: 'border',
        items: [{
                xtype: 'panel',
                autoShow: true,
                id: 'mcff_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'mcff_grid',
                        stateful:true,
                        stateId:'stateGridMCF',
                        store: mcff_store,//Ext.data.StoreManager.lookup('acc_master_posting_store'),
                        stripeRows: true,
                        loadMask: true,
                        //                        sm:sm_acc_master_posting,
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
                                            var winmpacc=Ext.create('mcff_wind');
                                            winmpacc.setTitle('Edit Form');
                                            Ext.getCmp('mcff_simpan_btn').setText('Edit');
                                            Ext.getCmp('mcff_simpan_btn').setIconCls('icon-edit-record');
//                                            Ext.getCmp('mcff_id').setReadOnly(true);
//                                            Ext.getCmp('mcff_id').setFieldStyle('readonly-input');
                                            Ext.getCmp('mcff_id').setValue(rec.get('id'));
                                            Ext.getCmp('mcff_keterangan').setValue(rec.get('keterangan'));
                                            Ext.getCmp('mcff_mutasi').getStore().load();
                                            Ext.getCmp('mcff_mutasi').setValue(rec.get('mutasi'));
                                            
                                            winmpacc.show();
                                            //                                            Ext.Msg.alert('Edit', 'Edit ' + rec.get('id'));
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
//                                            console.log(rec.data);
//                                            Ext.Msg.alert('Delete', 'Delete ' + rec.get('rekening'));
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
                                                            url: '<?php echo base_url(); ?>' +'master_cashflowt/delete_row_format',
                                                            method: 'POST',
                                                            params: {
                                                                cmd: 'delete',
                                                                postdata: data
                                                            },
                                                            success: function(obj) {
                                                                var   resp = Ext.decode(obj.responseText);                                                                
                                                                if(resp.success==true){
                                                                    set_message(0,resp.msg);
                                                                    Ext.getCmp('mcff_grid').store.reload();
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
                                    }
                                ]
                            },
                            {
                                header: "ID",
                                dataIndex: 'id',
                                sortable: true,
                                align:'center',
                                width: 50
                            },
                            {
                                header: "Keterangan",
                                dataIndex: 'keterangan',
                                sortable: true,
                                flex:1,
                                width: 250
                            },                            
                            {
                                header: "Mutasi",
                                dataIndex: 'mutasi',
                                sortable: true,
                                align:'center',
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
                                        var winmpacc=Ext.create('mcff_wind');
                                        winmpacc.setTitle('Add Form');
                                        Ext.getCmp('mcff_simpan_btn').setText('Simpan');
                                        Ext.getCmp('mcff_simpan_btn').setIconCls('icons-add');
                                        //                                        
                                        winmpacc.show();
                                    }
                                },'-',{
                                    width: 300,
                                    xtype: 'searchfield',
                                    store: mcff_store,
                                    emptyText: 'Quick Search...'
                                }]
                        }
                        ,bbar:{                        
                            xtype: 'pagingtoolbar',
                            store: mcff_store,
                            pageSize: ENDPAGE,
                            displayInfo: true
                        }

                    }
                ]
            
            }
        
        ],
        listeners:{
            show:function(){
                var storegrid=Ext.getCmp('mcff_grid').store;
                storegrid.loadPage(1);
                    
                
            }
        }
        , initComponent: function() {
            this.callParent(arguments);
        }
    });
</script>

