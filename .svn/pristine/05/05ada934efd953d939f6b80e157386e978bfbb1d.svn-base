<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript"> 
    
    
    var mp_biaya_store = createStore(false,'mp_biaya_store',[
        'dept','nama_dept',
        'kode_posting',
        'nama_rekening',								
        'debet',	
        'nama_debet',
        'kredit','nama_kredit'],
    '<?php echo base_url(); ?>' + 'masterposting_biaya/get_rows');
    
    
    
    
    //=========================================================
    var store_mp_biaya_akun = createStore(false,'store_mp_biaya_akun',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
    
        
    defineTwinAkun_windows('Window_mp_biaya','window_mp_biaya',store_mp_biaya_akun,
    function(){
        var sm = this.getSelectionModel();
        var sel = sm.getSelection();
        if (sel.length > 0) {				
            Ext.getCmp('mp_biaya_rekening_debet').setValue(sel[0].get('rekening'));
            Ext.getCmp('id_nama_debet').setValue(sel[0].get('nama_rekening'));                    
            Ext.getCmp('window_mp_biaya').close();
            //                                        Ext.getCmp('ej_grid_debet').focus();
        }
    }
);
        
    var store_mp_biaya_akun_k = createStore(false,'store_mp_biaya_akun_k',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
    
        
    defineTwinAkun_windows('Window_mp_biaya_k','window_mp_biaya_k',store_mp_biaya_akun_k,
    function(){
        var sm = this.getSelectionModel();
        var sel = sm.getSelection();
        if (sel.length > 0) {				
            Ext.getCmp('mp_biaya_rekening_kredit').setValue(sel[0].get('rekening'));
            Ext.getCmp('id_nama_kredit').setValue(sel[0].get('nama_rekening'));                    
            Ext.getCmp('window_mp_biaya_k').close();
            //                                        Ext.getCmp('ej_grid_debet').focus();
        }
    }
);
        
    var memorial_store=createArrayStore(yesno_data);
    //============================================================
    var validasiKode = 0;
    
    Ext.define('mp_biaya_form', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.mp_biaya_form',
        id              : 'mp_biaya_form',
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
        url: '<?php echo base_url(); ?>' + 'masterposting_biaya/update_rows',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                {
                    xtype: 'fieldcontainer',
                    fieldLabel: 'Department',
                    afterLabelTextTpl: required_css,
                    //                    labelStyle: 'font-weight:bold;padding:0;',
                    layout: 'hbox',
                    defaultType: 'textfield',

                    fieldDefaults: {
                        labelAlign: 'top'
                    },

                    items: [{
                            xtype: 'combo',
                            tooltip: 'Field tidak boleh kosong',
                            afterLabelTextTpl: required_css,
                            //                    fieldLabel: 'Departement',
                            id: 'mp_biaya_dept',
                            name: 'dept',
                            flex: 1,
                            store: dept_store,
                            valueField: 'dept',
                            displayField: 'nama_dept',
                            typeAhead: true,
                            triggerAction: 'all',
                            allowBlank: false,
                            editable: false,
                            //                    anchor: '50%',
                            hiddenName: 'dept',
                            emptyText: 'Department',
                            listeners:{
                                select:function(combo, records) {
                                    var mval = combo.getValue();
                                    Ext.getCmp('mp_biaya_kode_dept').setValue(mval);
                                }
                            }
                    
                        },
                        {
                            name: 'kode_dept',
                            id: 'mp_biaya_kode_dept',
                            tooltip: 'Field tidak boleh kosong',
                            afterLabelTextTpl: required_css,   
                            readOnly:true,
                            width: 50
                            //                            anchor: '20%'
                        }]
                    
                },
                
                {
                    //                    xtype: 'numericfield',
                    name: 'kode_posting',
                    id: 'mp_biaya_kode_posting',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Kode Posting',
                    anchor: '50%',
                    maxLength:4,maskRe:/\d/
                },                
                {
                    name: 'nama_rekening',
                    id: 'mp_biaya_nama_rekening',                    
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
                            id:'mp_biaya_rekening_debet',
                            store:store_mp_biaya_akun,
                            menu:'Window_mp_biaya',
                            width: 80,
                            name: 'debet',
                            itemId: 'debet',
                            afterLabelTextTpl: required_css,//                        fieldLabel: 'First',
                            allowBlank: false
                        }, {
                            flex: 1,
                            itemId: 'nama_rekening_debet',
                            id:'id_nama_debet',
                            name: 'nama_debet',
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
                            id:'mp_biaya_rekening_kredit',
                            store:store_mp_biaya_akun_k,
                            menu:'Window_mp_biaya_k',
                            width: 80,
                            name: 'kredit',
                            itemId: 'kredit',
                            afterLabelTextTpl: required_css,//                        fieldLabel: 'First',
                            allowBlank: false
                        }, {
                            flex: 1,
                            itemId: 'nama_rekening_kredit',
                            id:'id_nama_kredit',
                            name: 'nama_kredit',
                            readOnly:true

                        }]
                }              
                
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'mp_biaya_simpan',
                    id:'mp_biaya_simpan_btn',
                    iconCls: 'save',
                    handler: this.submit
                },
                {
                    text: 'Batal',
                    action: 'cancel',
                    itemId: 'mp_biaya_batal',
                    iconCls: 'cancel',
                    handler: function(){
                        this.up('window').close();
                    }
                }
            ];
            this.callParent(arguments);
        },
        submit: function(){
            var parcmd=Ext.getCmp('mp_biaya_simpan_btn').getText();
            if(parcmd === 'Simpan'){               
                parcmd='insert';
            }else if(parcmd === 'Edit'){
                parcmd='update';
            }
            if(!Ext.getCmp('mp_biaya_form').getForm().isValid()){
                set_message(2,'Masih Ada Field Yang Salah!!!');
                return;
            }
            Ext.getCmp('mp_biaya_form').getForm().submit({
                url: this.url,
                scope: this,
                params: {
                    cmd: parcmd                    
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    set_message(0,action.result.msg);
                    Ext.getCmp('mp_biaya_grid').store.reload();
                    Ext.getCmp('mp_biaya_form').getForm().reset();
                    Ext.getCmp('mp_biaya_wind').close();
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

    Ext.define('mp_biaya_wind', {
        extend          : 'Ext.window.Window',
        title           : 'Form Edit User',
        width           : 400,
        height          : 230,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.mp_biaya_edit',
        id              : 'mp_biaya_wind',
        initComponent   : function(){
            this.items = [
                Ext.widget('mp_biaya_form')
            ];
            this.callParent(arguments);
        }

    });
    //
    Ext.define('MyTabMasterPostingBiaya',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabMasterPostingBiaya',
        alias: 'widget.MasterPostingBiaya',
        title: 'Master Posting Biaya',
        id: 'tab1b1',
        closable: true,        
        layout: 'border',
        items: [{
                xtype: 'panel',
                autoShow: true,
                id: 'mp_biaya_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'mp_biaya_grid',
                        stateful:true,
                        stateId:'stateGrid',
                        store: mp_biaya_store,//Ext.data.StoreManager.lookup('acc_master_posting_store'),
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
                                            var winmpacc=Ext.create('mp_biaya_wind');
                                            winmpacc.setTitle('Edit Form');
                                            dept_store.load();
                                            Ext.getCmp('mp_biaya_simpan_btn').setText('Edit');
                                            Ext.getCmp('mp_biaya_simpan_btn').setIconCls('icon-edit-record');
                                            Ext.getCmp('mp_biaya_dept').setValue(rec.get('dept'));
//                                            Ext.getCmp('mp_biaya_nama_dept').setValue(rec.get('nama_dept'));
                                            Ext.getCmp('mp_biaya_kode_dept').setValue(rec.get('dept'));
                                            Ext.getCmp('mp_biaya_kode_posting').setReadOnly(true);
                                            Ext.getCmp('mp_biaya_kode_posting').setFieldStyle('readonly-input');
                                            Ext.getCmp('mp_biaya_kode_posting').setValue(rec.get('kode_posting'));                                            
                                            Ext.getCmp('mp_biaya_nama_rekening').setValue(rec.get('nama_rekening'));
                                            Ext.getCmp('mp_biaya_rekening_debet').setValue(rec.get('debet'));
                                            Ext.getCmp('mp_biaya_rekening_kredit').setValue(rec.get('kredit'));                                                                                       
                                            Ext.getCmp('id_nama_debet').setValue(rec.get('nama_debet'));
                                            Ext.getCmp('id_nama_kredit').setValue(rec.get('nama_kredit'));                                                                                       
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
                                                            url: '<?php echo base_url(); ?>' +'masterposting_biaya/delete_row',
                                                            method: 'POST',
                                                            params: {
                                                                cmd: 'delete',
                                                                postdata: data
                                                            },
                                                            success: function(obj) {
                                                                var   resp = Ext.decode(obj.responseText);                                                                
                                                                if(resp.success==true){
                                                                    set_message(0,resp.msg);
                                                                    Ext.getCmp('mp_biaya_grid').store.reload();
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
                            {text:'Department',
                                columns:[
                                    {
                                        header: "Kode",
                                        dataIndex: 'dept',
                                        sortable: true,
                                        width: 50
                                    }    ,
                                    {
                                        header: "Nama Department",
                                        dataIndex: 'nama_dept',
                                        sortable: true,
                                        width: 120
                                    }    
                                ]
                            }
                            ,
                            {
                                header: "Kode Posting",
                                dataIndex: 'kode_posting',
                                sortable: true,
                                width: 100
                            },
                            
                            {
                                header: "Nama Posting",
                                dataIndex: 'nama_rekening',
                                sortable: true,
                                flex:1,
                                width: 250
                            },{
                                text:'Rekening Debet',
                                columns:[
                                    {
                                        header: "Kode",
                                        dataIndex: 'debet',
                                        sortable: true,
                                        width: 80
                                    },{
                                        header: "Nama Rekening",
                                        dataIndex: 'nama_debet',
                                        sortable: true,
                                        width: 120
                                    }
                                ]
                            },{
                                text:'Rekening Kredit',
                                columns:[
                                    {
                                        header: "Kode",
                                        dataIndex: 'kredit',
                                        sortable: true,
                                        width: 80
                                    },{
                                        header: "Nama Rekening",
                                        dataIndex: 'nama_kredit',
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
                                        var winmpacc=Ext.create('mp_biaya_wind');
                                        winmpacc.setTitle('Add Form');
                                        Ext.getCmp('mp_biaya_simpan_btn').setText('Simpan');
                                        Ext.getCmp('mp_biaya_simpan_btn').setIconCls('icons-add');
                                        //                                        
                                        winmpacc.show();
                                    }
                                },'-',{
                                    width: 300,
                                    xtype: 'searchfield',
                                    store: mp_biaya_store,
                                    emptyText: 'Quick Search...'
                                }]
                        }
                        ,bbar:{                        
                            xtype: 'pagingtoolbar',
                            store: mp_biaya_store,
                            pageSize: ENDPAGE,
                            displayInfo: true
                        }

                    }
                ]
            
            }
        
        ],
        listeners:{
            show:function(){
                var storegrid=Ext.getCmp('mp_biaya_grid').store;
                storegrid.loadPage(1);
                    
                
            }
        }
        , initComponent: function() {
            this.callParent(arguments);
        }
    });

    
</script>
