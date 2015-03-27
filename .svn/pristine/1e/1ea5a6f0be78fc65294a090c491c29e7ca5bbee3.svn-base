<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript"> 
    
    var mp_acc_store = Ext.create('Ext.data.Store',
    {
        autoLoad	: false,
        autoSync	: false,
        storeId		: 'mp_acc_store',
        fields          : [
            'kode_posting', 
            'memorial', 
            'dk', 
            'nama_posting', 
            'rekening_debet', 
            'nama_rekening_debet', 
            'rekening_kredit',
            'nama_rekening_kredit'],
        proxy		: {
            type: 'ajax',
            api: {                    
                read    : '<?php echo base_url(); ?>' + 'masterposting_account/get_rows'
		   
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
                    //                    Ext.MessageBox.show({
                    //                        title: 'REMOTE EXCEPTION',
                    //                        msg: operation.getError(),
                    //                        icon: Ext.MessageBox.ERROR,
                    //                        buttons: Ext.Msg.OK
                    //                    });
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
    
    //=========================================================
    var store_mp_acc_akun = createStore(false,'store_mp_acc_akun',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
    
        
    defineTwinAkun_windows('Window_mp_acc','window_mp_acc',store_mp_acc_akun,
    function(){
        var sm = this.getSelectionModel();
        var sel = sm.getSelection();
        if (sel.length > 0) {				
            Ext.getCmp('mp_acc_rekening_debet').setValue(sel[0].get('rekening'));
            Ext.getCmp('id_nama_rekening_debet').setValue(sel[0].get('nama_rekening'));                    
            Ext.getCmp('window_mp_acc').close();
            //                                        Ext.getCmp('ej_grid_debet').focus();
        }
    }
);
        
    var store_mp_acc_akun_k = createStore(false,'store_mp_acc_akun_k',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
    
        
    defineTwinAkun_windows('Window_mp_acc_k','window_mp_acc_k',store_mp_acc_akun_k,
    function(){
        var sm = this.getSelectionModel();
        var sel = sm.getSelection();
        if (sel.length > 0) {				
            Ext.getCmp('mp_acc_rekening_kredit').setValue(sel[0].get('rekening'));
            Ext.getCmp('id_nama_rekening_kredit').setValue(sel[0].get('nama_rekening'));                    
            Ext.getCmp('window_mp_acc_k').close();
            //                                        Ext.getCmp('ej_grid_debet').focus();
        }
    }
);
        
    var memorial_store=createArrayStore(yesno_data);
    //============================================================
    var validasiKode = 0;
    
    Ext.define('mp_acc_form', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.mp_acc_form',
        id              : 'mp_acc_form',
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
        url: '<?php echo base_url(); ?>' + 'masterposting_account/update_rows',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                {
                    //                    xtype: 'numericfield',
                    name: 'kode_posting',
                    id: 'mp_acc_kode_posting',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Kode Posting',
                    anchor: '50%',maxLength:4,maskRe:/\d/
                },
                {
                    xtype: 'combo',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Memorial',
                    id: 'mp_acc_memorial',
                    name: 'memorial',
                    store: memorial_store,
                    valueField: 'mid',
                    displayField: 'mtext',
                    typeAhead: true,
                    triggerAction: 'all',
                    allowBlank: false,
                    editable: false,
                    anchor: '50%',
                    hiddenName: 'memorial',
                    emptyText: 'Memorial'
                },
                {
                    xtype: 'combo',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Debet/Kredit',
                    id: 'mp_acc_dk',
                    name: 'dk',
                    store: mst_account_kel_dk_store,
                    valueField: 'dk',
                    displayField: 'default',
                    typeAhead: true,
                    triggerAction: 'all',
                    allowBlank: false,
                    editable: false,
                    anchor: '50%',
                    hiddenName: 'dk',
                    emptyText: 'Debet Kredit'
                },
                {
                    name: 'nama_posting',
                    id: 'mp_acc_nama_posting',                    
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Nama Posting',
                    anchor:'100%'
                },
                {
                    xtype: 'fieldcontainer',
                    fieldLabel: 'Rekening Debet',
                    afterLabelTextTpl: required_css,
                    //                    labelStyle: 'font-weight:bold;padding:0;',
                    layout: 'hbox',
                    defaultType: 'textfield',

                    fieldDefaults: {
                        labelAlign: 'top'
                    },

                    items: [{
                            xtype: 'twincombo',
                            id:'mp_acc_rekening_debet',
                            store:store_mp_acc_akun,
                            menu:'Window_mp_acc',
                            width: 80,
                            name: 'rekening_debet',
                            itemId: 'rekening_debet',
                            afterLabelTextTpl: required_css,//                        fieldLabel: 'First',
                            allowBlank: false
                        }, {
                            flex: 1,
                            itemId: 'nama_rekening_debet',
                            id:'id_nama_rekening_debet',
                            name: 'nama_rekening_debet',
                            readOnly:true

                        }]
                },  {
                    xtype: 'fieldcontainer',
                    fieldLabel: 'Rekening Kredit',
                    afterLabelTextTpl: required_css,
                    //                    labelStyle: 'font-weight:bold;padding:0;',
                    layout: 'hbox',
                    defaultType: 'textfield',

                    fieldDefaults: {
                        labelAlign: 'top'
                    },

                    items: [{
                            xtype: 'twincombo',
                            id:'mp_acc_rekening_kredit',
                            store:store_mp_acc_akun_k,
                            menu:'Window_mp_acc_k',
                            width: 80,
                            name: 'rekening_kredit',
                            itemId: 'rekening_kredit',
                            afterLabelTextTpl: required_css,//                        fieldLabel: 'First',
                            allowBlank: false
                        }, {
                            flex: 1,
                            itemId: 'nama_rekening_kredit',
                            id:'id_nama_rekening_kredit',
                            name: 'nama_rekening_kredit',
                            readOnly:true

                        }]
                }              
                
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'mp_acc_simpan',
                    id:'mp_acc_simpan_btn',
                    iconCls: 'save',
                    handler: this.submit
                },
                {
                    text: 'Batal',
                    action: 'cancel',
                    itemId: 'mp_acc_batal',
                    iconCls: 'cancel',
                    handler: function(){
                        this.up('window').close();
                    }
                }
            ];
            this.callParent(arguments);
        },
        submit: function(){
            var parcmd=Ext.getCmp('mp_acc_simpan_btn').getText();
            if(parcmd === 'Simpan'){               
                parcmd='insert';
            }else if(parcmd === 'Edit'){
                parcmd='update';
            }
            if(!Ext.getCmp('mp_acc_form').getForm().isValid()){
                set_message(2,'Masih Ada Field Yang Salah!!!');
                return;
            }
            Ext.getCmp('mp_acc_form').getForm().submit({
                url: this.url,
                scope: this,
                params: {
                    cmd: parcmd                    
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    set_message(0,action.result.msg);
                    Ext.getCmp('mp_acc_grid').store.reload();
                    Ext.getCmp('mp_acc_form').getForm().reset();
                    Ext.getCmp('mp_acc_wind').close();
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

    Ext.define('mp_acc_wind', {
        extend          : 'Ext.window.Window',
        title           : 'Form Edit User',
        width           : 400,
        height          : 275,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.mp_acc_edit',
        id              : 'mp_acc_wind',
        initComponent   : function(){
            this.items = [
                Ext.widget('mp_acc_form')
            ];
            this.callParent(arguments);
        }

    });
    //
    Ext.define('MyTabMasterPosting',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabMasterPostingAccount',
        alias: 'widget.MasterPostingAccount',
        title: 'Master Posting Account',
        id: 'tab1b2',
        closable: true,        
        layout: 'border',
        items: [{
                xtype: 'panel',
                autoShow: true,
                id: 'mp_acc_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'mp_acc_grid',
                        stateful:true,
                        stateId:'stateGrid',
                        store: mp_acc_store,//Ext.data.StoreManager.lookup('acc_master_posting_store'),
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
                                            var winmpacc=Ext.create('mp_acc_wind');
                                            winmpacc.setTitle('Edit Form');
                                            Ext.getCmp('mp_acc_simpan_btn').setText('Edit');
                                            Ext.getCmp('mp_acc_simpan_btn').setIconCls('icon-edit-record');
                                            Ext.getCmp('mp_acc_kode_posting').setReadOnly(true);
                                            Ext.getCmp('mp_acc_kode_posting').setFieldStyle('readonly-input');
                                            Ext.getCmp('mp_acc_kode_posting').setValue(rec.get('kode_posting'));
                                            Ext.getCmp('mp_acc_memorial').setValue(rec.get('memorial'));
                                            Ext.getCmp('mp_acc_dk').getStore().load();
                                            Ext.getCmp('mp_acc_dk').setValue(rec.get('dk'));
                                            Ext.getCmp('mp_acc_nama_posting').setValue(rec.get('nama_posting'));
                                            Ext.getCmp('mp_acc_rekening_debet').setValue(rec.get('rekening_debet'));
                                            Ext.getCmp('mp_acc_rekening_kredit').setValue(rec.get('rekening_kredit'));                                                                                       
                                            Ext.getCmp('id_nama_rekening_debet').setValue(rec.get('nama_rekening_debet'));
                                            Ext.getCmp('id_nama_rekening_kredit').setValue(rec.get('nama_rekening_kredit'));                                                                                       
                                            winmpacc.show();
                                            //                                            Ext.Msg.alert('Edit', 'Edit ' + rec.get('kode_posting'));
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
                                                            url: '<?php echo base_url(); ?>' +'masterposting_account/delete_row',
                                                            method: 'POST',
                                                            params: {
                                                                cmd: 'delete',
                                                                postdata: data
                                                            },
                                                            success: function(obj) {
                                                                var   resp = Ext.decode(obj.responseText);                                                                
                                                                if(resp.success==true){
                                                                    set_message(0,resp.msg);
                                                                    Ext.getCmp('mp_acc_grid').store.reload();
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
                                header: "Kode Posting",
                                dataIndex: 'kode_posting',
                                sortable: true,
                                width: 100
                            },
                            {
                                header: "Memorial",
                                dataIndex: 'memorial',
                                sortable: true,
                                align:'center',
                                width: 60
                            },
                            {
                                header: "D/K",
                                dataIndex: 'dk',
                                sortable: true,
                                align:'center',
                                width: 50
                            },
                            {
                                header: "Nama Posting",
                                dataIndex: 'nama_posting',
                                sortable: true,
                                flex:1,
                                width: 250
                            },{
                                text:'Rekening Debet',
                                columns:[
                                    {
                                        header: "Kode",
                                        dataIndex: 'rekening_debet',
                                        sortable: true,
                                        width: 80
                                    },{
                                        header: "Nama Rekening",
                                        dataIndex: 'nama_rekening_debet',
                                        sortable: true,
                                        width: 120
                                    }
                                ]
                            },{
                                text:'Rekening Kredit',
                                columns:[
                                    {
                                        header: "Kode",
                                        dataIndex: 'rekening_kredit',
                                        sortable: true,
                                        width: 80
                                    },{
                                        header: "Nama Rekening",
                                        dataIndex: 'nama_rekening_kredit',
                                        sortable: true,
                                        width: 120
                                    }
                                ]},
                            
                            
                        ]
                        ,tbar:{
                            xtype: 'toolbar',
                            padding:'2 0 2 5',
                            items: [{
                                    xtype: 'button',
                                    text: 'Add',
                                    iconCls: 'icons-add',
                                    onClick: function(){
                                        var winmpacc=Ext.create('mp_acc_wind');
                                        winmpacc.setTitle('Add Form');
                                        Ext.getCmp('mp_acc_simpan_btn').setText('Simpan');
                                        Ext.getCmp('mp_acc_simpan_btn').setIconCls('icons-add');
                                        //                                        
                                        winmpacc.show();
                                    }
                                },'-',{
                                    width: 300,
                                    xtype: 'searchfield',
                                    store: mp_acc_store,
                                    emptyText: 'Quick Search...'
                                }]
                        }
                        ,bbar:{                        
                            xtype: 'pagingtoolbar',
                            store: mp_acc_store,
                            pageSize: ENDPAGE,
                            displayInfo: true
                        }

                    }
                ]
            
            }
        
        ],
        listeners:{
            show:function(){
                var storegrid=Ext.getCmp('mp_acc_grid').store;
                storegrid.loadPage(1);
                    
                
            }
        }
        , initComponent: function() {
            this.callParent(arguments);
        }
    });

    
</script>
