<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript"> 
    var mcf_store=createStore(false, 'mmcf_store', [
        'id','idformat',
        'keterangan',
        'mutasi',
        'rekening_debet',
        'rekening_kredit',
        'nama_rekening_debet',
        'nama_rekening_kredit'
    ], '<?php echo base_url(); ?>' + 'master_cashflow/get_rows');
    
    var mcfformat_store=createStore(false, 'mcfformat_store', [
        'id',
        'keterangan'        
    ], '<?php echo base_url(); ?>' + 'master_cashflow/get_cashflowformat');
    //=================================================================
    //=========================================================
    var store_mcf_akun = createStore(false,'store_mcf_akun',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
    
        
    defineTwinAkun_windows('Window_mcf','window_mcf',store_mcf_akun,
    function(){
        var sm = this.getSelectionModel();
        var sel = sm.getSelection();
        if (sel.length > 0) {				
            Ext.getCmp('mcf_rekening_debet').setValue(sel[0].get('rekening'));
            Ext.getCmp('id_mcf_nama_rekening_debet').setValue(sel[0].get('nama_rekening'));                    
            Ext.getCmp('window_mcf').close();
            //                                        Ext.getCmp('ej_grid_debet').focus();
        }
    }
);
        
    var store_mcf_akun_k = createStore(false,'store_mcf_akun_k',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
    
        
    defineTwinAkun_windows('Window_mcf_k','window_mcf_k',store_mcf_akun_k,
    function(){
        var sm = this.getSelectionModel();
        var sel = sm.getSelection();
        if (sel.length > 0) {				
            Ext.getCmp('mcf_rekening_kredit').setValue(sel[0].get('rekening'));
            Ext.getCmp('id_mcf_nama_rekening_kredit').setValue(sel[0].get('nama_rekening'));                    
            Ext.getCmp('window_mcf_k').close();
            //                                        Ext.getCmp('ej_grid_debet').focus();
        }
    }
);
        
    
    //============================================================
    
    
    Ext.define('mcf_form', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.mcf_form',
        id              : 'mcf_form',
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
        url: '<?php echo base_url(); ?>' + 'master_cashflow/update_rows',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                {
                    //                    xtype: 'numericfield',
                    name: 'id',
                    id: 'mcf_id',
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
                    xtype: 'combo',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Keterangan',
                    id: 'mcf_idformat',
                    name: 'idformat',
                    store: mcfformat_store,
                    valueField: 'id',
                    displayField: 'keterangan',
                    typeAhead: true,
                    triggerAction: 'all',
                    allowBlank: false,
                    editable: false,
                    anchor: '100%',
                    hiddenName: 'idformat',
                    emptyText: 'Keterangan Format'
                    ,width: 50
                }
                ,
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
                            id:'mcf_rekening_debet',
                            store:store_mcf_akun,
                            menu:'Window_mcf',
                            width: 100,
                            name: 'rekening_debet',
                            itemId: 'rekening_debet',
                            afterLabelTextTpl: required_css,//                        fieldLabel: 'First',
                            allowBlank: false
                        }, {
                            flex: 1,
                            itemId: 'nama_rekening_debet',
                            id:'id_mcf_nama_rekening_debet',
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
                            id:'mcf_rekening_kredit',
                            store:store_mcf_akun_k,
                            menu:'Window_mcf_k',
                            width: 100,
                            name: 'rekening_kredit',
                            itemId: 'rekening_kredit',
                            afterLabelTextTpl: required_css,//                        fieldLabel: 'First',
                            allowBlank: false
                        }, {
                            flex: 1,
                            itemId: 'nama_rekening_kredit',
                            id:'id_mcf_nama_rekening_kredit',
                            name: 'nama_rekening_kredit',
                            readOnly:true

                        }]
                }              
                
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'mcf_simpan',
                    id:'mcf_simpan_btn',
                    iconCls: 'save',
                    formBind: true,
                        scope: this,
                    handler: this.submit
                },
                {
                    text: 'Batal',
                    action: 'cancel',
                    itemId: 'mcf_batal',
                    iconCls: 'icon-cancel',
                    handler: function(){
                        this.up('window').close();
                    }
                }
            ];
            this.callParent(arguments);
        },
        submit: function(){
            var parcmd=Ext.getCmp('mcf_simpan_btn').getText();
            if(parcmd === 'Simpan'){               
                parcmd='insert';
            }else if(parcmd === 'Edit'){
                parcmd='update';
            }
            if(!Ext.getCmp('mcf_form').getForm().isValid()){
                set_message(2,'Masih Ada Field Yang Salah!!!');
                return;
            }
            
            if(Ext.getCmp('mcf_rekening_kredit').getValue()==Ext.getCmp('mcf_rekening_debet').getValue()){
                set_message(2,'Rekening Debet Dan Kredit Tidak boleh sama!');
                return;
            }
            Ext.getCmp('mcf_form').getForm().submit({
                url: this.url,
                scope: this,
                params: {
                    cmd: parcmd                    
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    set_message(0,action.result.msg);
                    Ext.getCmp('mcf_grid').store.reload();
                    Ext.getCmp('mcf_form').getForm().reset();
                    Ext.getCmp('mcf_wind').close();
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

    Ext.define('mcf_wind', {
        extend          : 'Ext.window.Window',
        title           : 'Form Edit User',
        width           : 400,
        height          : 200,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.mcf_edit',
        id              : 'mcf_wind',
        initComponent   : function(){
            this.items = [
                Ext.widget('mcf_form')
            ];
            this.callParent(arguments);
        }

    });
    
    //=================================================================
    Ext.define('MyTabMasterCashFlow',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabMasterCashFlow',
        alias: 'widget.MasterCashFlow',
        title: 'Master CashFlow',
        id: 'tab1c5',
        closable: true,        
        layout: 'border',
        items: [{
                xtype: 'panel',
                autoShow: true,
                id: 'mcf_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'mcf_grid',
                        stateful:true,
                        stateId:'stateGridMCF',
                        store: mcf_store,//Ext.data.StoreManager.lookup('acc_master_posting_store'),
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
                                            var winmpacc=Ext.create('mcf_wind');
                                            winmpacc.setTitle('Edit Form');
                                            Ext.getCmp('mcf_simpan_btn').setText('Edit');
                                            Ext.getCmp('mcf_simpan_btn').setIconCls('icon-edit-record');
//                                            Ext.getCmp('mcf_id').setReadOnly(true);
//                                            Ext.getCmp('mcf_id').setFieldStyle('readonly-input');
                                            Ext.getCmp('mcf_id').setValue(rec.get('id'));                                            
                                            Ext.getCmp('mcf_idformat').getStore().load();
                                            Ext.getCmp('mcf_idformat').setValue(rec.get('idformat'));
                                            Ext.getCmp('mcf_rekening_debet').setValue(rec.get('rekening_debet'));
                                            Ext.getCmp('mcf_rekening_kredit').setValue(rec.get('rekening_kredit'));                                                                                       
                                            Ext.getCmp('id_mcf_nama_rekening_debet').setValue(rec.get('nama_rekening_debet'));
                                            Ext.getCmp('id_mcf_nama_rekening_kredit').setValue(rec.get('nama_rekening_kredit'));                                                                                       
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
                                                            url: '<?php echo base_url(); ?>' +'master_cashflow/delete_row',
                                                            method: 'POST',
                                                            params: {
                                                                cmd: 'delete',
                                                                postdata: data
                                                            },
                                                            success: function(obj) {
                                                                var   resp = Ext.decode(obj.responseText);                                                                
                                                                if(resp.success==true){
                                                                    set_message(0,resp.msg);
                                                                    Ext.getCmp('mcf_grid').store.reload();
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
                                width: 40
                            },
                            {
                                header: "IDFORMAT",
                                dataIndex: 'id',
                                sortable: true,
                                align:'center',
                                width: 65
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
                                width: 50
                            },{
                                text:'Rekening Debet',
                                columns:[
                                    {
                                        header: "Kode",
                                        dataIndex: 'rekening_debet',
                                        sortable: true,
                                        width: 75
                                    },{
                                        header: "Nama Rekening",
                                        dataIndex: 'nama_rekening_debet',
                                        flex:1,
                                        sortable: true,
                                        width: 130
                                    }
                                ]
                            },{
                                text:'Rekening Kredit',
                                columns:[
                                    {
                                        header: "Kode",
                                        dataIndex: 'rekening_kredit',
                                        sortable: true,
                                        width: 75
                                    },{
                                        header: "Nama Rekening",
                                        dataIndex: 'nama_rekening_kredit',
                                        sortable: true,
                                        flex:1,
                                        width: 130
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
                                        var winmpacc=Ext.create('mcf_wind');
                                        winmpacc.setTitle('Add Form');
                                        Ext.getCmp('mcf_simpan_btn').setText('Simpan');
                                        Ext.getCmp('mcf_simpan_btn').setIconCls('icons-add');
                                        //                                        
                                        winmpacc.show();
                                    }
                                },'-',{
                                    width: 300,
                                    xtype: 'searchfield',
                                    store: mcf_store,
                                    emptyText: 'Quick Search...'
                                }]
                        }
                        ,bbar:{                        
                            xtype: 'pagingtoolbar',
                            store: mcf_store,
                            pageSize: ENDPAGE,
                            displayInfo: true
                        }

                    }
                ]
            
            }
        
        ],
        listeners:{
            show:function(){
                var storegrid=Ext.getCmp('mcf_grid').store;
                storegrid.loadPage(1);
                    
                
            }
        }
        , initComponent: function() {
            this.callParent(arguments);
        }
    });
</script>

