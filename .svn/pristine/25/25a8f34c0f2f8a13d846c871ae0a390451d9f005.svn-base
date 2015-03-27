<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript"> 
    var acc_master_posting_store = Ext.create('Ext.data.Store',
    {
        autoLoad	: false,
        autoSync	: false,
        storeId		: 'acc_master_posting_store',
        fields          : ['id', 'tablefrom', 'validation', 'debet', 'debet', 'kredit', 'akun_selisih', 'created_date', 'update_date'],
        proxy		: {
            type: 'ajax',
            api: {                    
                read    : '<?php echo base_url(); ?>' + 'acc_master_posting/get_rows'
		   
            },
            actionMethods: {                    
                read    : 'POST'
            },
            reader: {
                type            : 'json',
                root            : 'data',
                rootProperty    : 'data',
                successProperty : 'success',
                totalProperty   : 'record'
                //                    messageProperty : 'message'
            },
            writer: {
                type            : 'json',
                writeAllFields  : true,
                root            : 'data',
                encode          : true
            },
            listeners: {
                exception: function(proxy, response, operation){
                    Ext.MessageBox.show({
                        title: 'REMOTE EXCEPTION',
                        msg: operation.getError(),
                        icon: Ext.MessageBox.ERROR,
                        buttons: Ext.Msg.OK
                    });
                },
                loadexception: function(event, options, response, error){
                    var err = Ext.util.JSON.decode(response.responseText);
                    if (err.errMsg == 'Session Expired') {
                        session_expired(err.errMsg);
                    }
                }
            }
        }
    });
    
    Ext.define('acc_master_posting_form', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.acc_master_posting_form',
        id              : 'acc_master_posting_form',
        requires        : [
            'Ext.form.Field'
        ],
        defaultType     : 'textfield',
        defaults        : {
            allowBlank: false,
            labelAlign: 'left',
            labelWidth: 150
        },
        monitorValid: true,
        url: '<?php echo base_url(); ?>' + 'acc_master_posting/update_rows',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                {
                    name: 'id',
                    id: 'acc_master_posting_id_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'id'
                },
                {
                    name: 'tablefrom',
                    id: 'acc_master_posting_tablefrom_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Table From'
                },
                {
                    name: 'validation',
                    id: 'acc_master_posting_validation_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Validation'
                },
                {
                    name: 'isselisih',
                    id: 'acc_master_posting_isselisih_txt',
                    xtype:'checkbox',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Selisih'
                },
                {
                    name: 'debet',
                    id: 'acc_master_posting_debet_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Debet'
                },
                {
                    name: 'kredit',
                    id: 'acc_master_posting_kredit_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Kredit'
                },
                {
                    name: 'akun_selisih',
                    id: 'acc_master_posting_akun_selisih_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Akun Selisih'
                },
                {
                    name: 'created_date',
                    id: 'acc_master_posting_created_date_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Created Date'
                },
                {
                    name: 'update_date',
                    id: 'acc_master_posting_update_date_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Update Date'
                }
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'simpan',
                    id:'acc_master_posting_simpan_btn',
                    iconCls: 'save',
                    handler: this.submit
                },
                {
                    text: 'Batal',
                    action: 'cancel',
                    itemId: 'batal',
                    iconCls: 'cancel',
                    handler: function(){
                        this.up('window').close();
                    }
                }
            ];
            this.callParent(arguments);
        },
        submit: function(){
            var parcmd=Ext.getCmp('acc_master_posting_simpan_btn').getText();
            if(parcmd === 'Simpan'){
                parcmd='insert';
            }else if(parcmd === 'Edit'){
                parcmd='update';
            }
        
            Ext.getCmp('acc_master_posting_form').getForm().submit({
                url: this.url,
                scope: this,
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    set_message(0,action.result.msg);
                    Ext.getCmp('acc_master_posting_grid').store.reload();
                    Ext.getCmp('acc_master_posting_form').getForm().reset();
                    Ext.getCmp('acc_master_posting_wind').close();
                },
                failure: function(form, action) {
                    Ext.Msg.alert('Failed', action.result.msg);
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

    Ext.define('acc_master_posting_wind', {
        extend          : 'Ext.window.Window',
        title           : 'Form Edit User',
        width           : 400,
        height          : 275,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.MaccEdit',
        id              : 'acc_master_posting_wind',
        initComponent   : function(){
            this.items = [
                Ext.widget('acc_master_posting_form')
            ];
            this.callParent(arguments);
        }

    });
    //
    Ext.define('MyTabMasterPosting',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabMasterPosting',
        alias: 'widget.MasterPosting',
        title: 'Master Posting',
        id: 'tab1b',
        closable: true,        
        layout: 'border',
        items: [{
                xtype: 'panel',
                autoShow: true,
                id: 'acc_master_posting_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'acc_master_posting_grid',
                        stateful:true,
                        stateId:'stateGrid',
                        store: acc_master_posting_store,//Ext.data.StoreManager.lookup('acc_master_posting_store'),
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
                                            var winmacc=Ext.create('acc_master_posting_wind');
                                            winmacc.setTitle('Edit Form');
                                            Ext.getCmp('acc_master_posting_simpan_btn').setText('Edit');
                                            Ext.getCmp('acc_master_posting_simpan_btn').setIconCls('icon-edit-record');
                                            Ext.getCmp('acc_master_posting_id_txt').setReadOnly(true);
                                            Ext.getCmp('acc_master_posting_id_txt').setFieldStyle('readonly-input');
                                            Ext.getCmp('acc_master_posting_id_txt').setValue(rec.get('id'));
                                            Ext.getCmp('acc_master_posting_tablefrom_txt').setValue(rec.get('tablefrom'));
                                            Ext.getCmp('acc_master_posting_validation_txt').setValue(rec.get('validation'));
                                            Ext.getCmp('acc_master_posting_debet_txt').setValue(rec.get('debet'));

                                            Ext.getCmp('acc_master_posting_kredit_txt').setValue(rec.get('kredit'));
                                            Ext.getCmp('acc_master_posting_akun_selisih_txt').setValue(rec.get('akun_selisih'));
                                            Ext.getCmp('acc_master_posting_created_date_txt').setValue(rec.get('created_date'));
                                            Ext.getCmp('acc_master_posting_update_date_txt').setValue(rec.get('update_date'));

                                            if (rec.get('isselisih') == '1')
                                                Ext.getCmp('acc_master_posting_isselisih_txt').setValue(true);
                                            else
                                                Ext.getCmp('acc_master_posting_isselisih_txt').setValue(false);
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
                                                            url: '<?php echo base_url(); ?>' +'acc_master_posting/delete_row',
                                                            method: 'POST',
                                                            params: {
                                                                cmd: 'delete',
                                                                postdata: data
                                                            },
                                                            success: function(obj) {
                                                                var   resp = Ext.decode(obj.responseText);                                                                
                                                                if(resp.success==true){
                                                                    set_message(0,resp.msg);
                                                                    Ext.getCmp('acc_master_posting_grid').store.reload();
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
                                header: "id",
                                dataIndex: 'id',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Table From",
                                dataIndex: 'tablefrom',
                                sortable: true,
                                width: 120
                            },
                            {
                                header: "Validation",
                                dataIndex: 'validation',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Selisih",
                                dataIndex: 'isselisih',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Debet",
                                dataIndex: 'debet',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Kredit",
                                dataIndex: 'kredit',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Akun Selisih",
                                dataIndex: 'akun_selisih',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Created Date",
                                dataIndex: 'created_date',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Update Date",
                                dataIndex: 'update_date',
                                sortable: true,
                                width: 70
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
                                        var winmacc=Ext.create('acc_master_posting_wind');
                                        winmacc.setTitle('Add Form');
                                        Ext.getCmp('acc_master_posting_simpan_btn').setText('Simpan');
                                        Ext.getCmp('acc_master_posting_simpan_btn').setIconCls('icons-add');
                                        
                                        winmacc.show();
                                    }
                                },'-',{
                                    width: 300,
                                    xtype: 'searchfield',
                                    store: acc_master_posting_store,
                                    emptyText: 'Quick Search...'
                                }]
                        }
                        ,bbar:{                        
                            xtype: 'pagingtoolbar',
                            store: acc_master_posting_store,pageSize: ENDPAGE,
                            displayInfo: true
                        }

                    }
                ]
            
            }
        
        ],
        listeners:{
            show:function(){
                var storegrid=Ext.getCmp('acc_master_posting_grid').store;
                storegrid.loadPage(1);
                    
                
            }
        }
        , initComponent: function() {
            this.callParent(arguments);
        }
    });

    
</script>
