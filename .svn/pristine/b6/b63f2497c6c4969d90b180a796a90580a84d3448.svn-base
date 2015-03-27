<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript"> 
    var mst_account_kel_store = Ext.create('Ext.data.Store',
    {
        autoLoad	: false,
        autoSync	: false,
        storeId		: 'mst_account_kel_store',
        fields          : ['jenis','nama_jenis','dk','default','kelompok','nama_kelompok','kode_asosiasi','nilai','flag'],
        proxy		: {
            type: 'ajax',
            api: {                    
                read    : '<?php echo base_url(); ?>' + 'mst_account_kel/get_rows'
		   
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
    
    var mst_account_kel_jenis_store = Ext.create('Ext.data.Store',{
        autoLoad	: true,
        autoSync	: false,
        storeId		: 'mst_account_kel_jenis_store',
        fields: [ 
            'jenis','nama_jenis'
        ],
        proxy		: {
            type: 'ajax',
            api: {
                    
                read    : '<?php echo base_url(); ?>' + 'global_reference/get_jenis'
		   
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

    var mst_account_kel_dk_store = Ext.create('Ext.data.Store',{
        autoLoad	: true,
        autoSync	: false,
        storeId		: 'mst_account_kel_dk_store',
        fields: [
            'dk','default'
        ],
        proxy		: {
            type: 'ajax',
            api: {

                read    : '<?php echo base_url(); ?>' + 'global_reference/get_dk'

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
    
    Ext.define('mst_account_kel_form', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.mst_account_kel_form',
        id              : 'mst_account_kel_form',
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
        url: '<?php echo base_url(); ?>' + 'mst_account_kel/update_rows',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                //                    cbjenis,
                {
                    xtype: 'combo',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Jenis Rekening',                        
                    id: 'mst_account_kel_jenis_cb',
                    store: mst_account_kel_jenis_store,
                    valueField: 'jenis',
                    displayField: 'nama_jenis',
                    typeAhead: true,
                    triggerAction: 'all',                    
                    // allowBlank: false,
                    editable: false,
                    anchor: '90%',
                    hiddenName: 'jenis',
                    emptyText: 'Jenis Rekening'
                },
                {
                    xtype: 'combo',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Debet Kredit',
                    id: 'mst_account_kel_dk_cb',
                    store: mst_account_kel_dk_store,
                    valueField: 'dk',
                    displayField: 'default',
                    typeAhead: true,
                    triggerAction: 'all',
                    // allowBlank: false,
                    editable: false,
                    anchor: '90%',
                    hiddenName: 'dk',
                    emptyText: 'Debet Kredit'
                },
                {
                    name: 'kelompok',
                    id: 'mst_account_kel_kelompok_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Kelompok'
                },
                {
                    name: 'nama_kelompok',
                    id: 'mst_account_kel_nama_kelompok_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Nama Kelompok'
                },
                {
                    name: 'kode_asosiasi',
                    id: 'mst_account_kel_kode_asosiasi_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Kode Asosiasi'
                },
                {
                    name: 'nilai',
                    id: 'mst_account_kel_nilai_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Nilai'
                },
                {
                    name: 'flag',
                    id: 'mst_account_kel_flag_txt',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Flag'
                }
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'simpan',
                    id:'mst_account_kel_simpan_btn',
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
            var parcmd=Ext.getCmp('mst_account_kel_simpan_btn').getText();
            if(parcmd === 'Simpan'){
                parcmd='insert';
            }else if(parcmd === 'Edit'){
                parcmd='update';
            }
        
            //        var prekening=Ext.getCmp('macc_rekening').getValue();
            //        var pnamarekening=Ext.getCmp('macc_namarekening').getValue();
            var pjenis=Ext.getCmp('mst_account_kel_jenis_cb').getValue();
            var pdk=Ext.getCmp('mst_account_kel_dk_cb').getValue();
        
            Ext.getCmp('mst_account_kel_form').getForm().submit({
                url: this.url,
                scope: this,
//                success: this.onSuccess,
//                failure: this.onFailure,
                params: {
                    cmd: parcmd,
                    jenis: pjenis,
                    dk:pdk
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
//                    console.log(action);
                    set_message(0,action.result.msg);
//                    Ext.Msg.alert('Success', action.result.msg);
                    Ext.getCmp('mst_account_kel_grid').store.reload();
                    Ext.getCmp('mst_account_kel_form').getForm().reset();
                    Ext.getCmp('mst_account_kel_wind').close();
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

    Ext.define('mst_account_kel_wind', {
        extend          : 'Ext.window.Window',
        title           : 'Form Edit User',
        width           : 400,
        height          : 200,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.MaccEdit',
        id              : 'mst_account_kel_wind',
        initComponent   : function(){
            this.items = [
                Ext.widget('mst_account_kel_form')
            ];
            this.callParent(arguments);
        }

    });
    //
    Ext.define('MyTabMasterKelompokAccount',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabMasterKelompokAccount',
        alias: 'widget.MasterKelompokAccount',
        title: 'Master Kelompok Account',
        id: 'tab1j',
        closable: true,        
        layout: 'border',
        items: [{
                xtype: 'panel',
                autoShow: true,
                id: 'mst_account_kel_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'mst_account_kel_grid',
                        stateful:true,
                        stateId:'stateGrid',
                        store: mst_account_kel_store,//Ext.data.StoreManager.lookup('mst_account_kel_store'),
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
                                            var winmacc=Ext.create('mst_account_kel_wind');
                                            winmacc.setTitle('Edit Form');
                                            Ext.getCmp('mst_account_kel_simpan_btn').setText('Edit');
                                            Ext.getCmp('mst_account_kel_simpan_btn').setIconCls('icon-edit-record');
                                            Ext.getCmp('mst_account_kel_kelompok_txt').setReadOnly(true);
                                            Ext.getCmp('mst_account_kel_kelompok_txt').setFieldStyle('readonly-input');
                                            Ext.getCmp('mst_account_kel_kelompok_txt').setValue(rec.get('kelompok'));
                                            Ext.getCmp('mst_account_kel_jenis_cb').setValue(rec.get('jenis'));
                                            Ext.getCmp('mst_account_kel_dk_cb').setValue(rec.get('dk'));
                                            Ext.getCmp('mst_account_kel_nama_kelompok_txt').setValue(rec.get('nama_kelompok'));
                                            Ext.getCmp('mst_account_kel_kode_asosiasi_txt').setValue(rec.get('kode_asosiasi'));
                                            Ext.getCmp('mst_account_kel_nilai_txt').setValue(rec.get('nilai'));
                                            Ext.getCmp('mst_account_kel_flag_txt').setValue(rec.get('flag'));
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
                                                            url: '<?php echo base_url(); ?>' +'mst_account_kel/delete_row',
                                                            method: 'POST',
                                                            params: {
                                                                cmd: 'delete',
                                                                postdata: data
                                                            },
                                                            success: function(obj) {
                                                                var   resp = Ext.decode(obj.responseText);                                                                
                                                                if(resp.success==true){
                                                                    set_message(0,resp.msg);
                                                                    Ext.getCmp('mst_account_kel_grid').store.reload();
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
                                header: "Jenis",
                                dataIndex: 'jenis',
                                sortable: true,
                                width: 70,
                                hidden:true
                            },
                            {
                                header: "Jenis",
                                dataIndex: 'nama_jenis',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "DK",
                                dataIndex: 'dk',
                                sortable: true,
                                width: 70,
                                hidden:true
                            },
                            {
                                header: "Debet Kredit",
                                dataIndex: 'default',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Kelompok",
                                dataIndex: 'kelompok',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Nama Kelompok",
                                dataIndex: 'nama_kelompok',
                                sortable: true,
                                width: 120
                            },
                            {
                                header: "Kode Asosiasi",
                                dataIndex: 'kode_asosiasi',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Nilai",
                                dataIndex: 'nilai',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Flag",
                                dataIndex: 'flag',
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
                                        var winmacc=Ext.create('mst_account_kel_wind');
                                        winmacc.setTitle('Add Form');
                                        Ext.getCmp('mst_account_kel_simpan_btn').setText('Simpan');
                                        Ext.getCmp('mst_account_kel_simpan_btn').setIconCls('icons-add');
                                        
                                        winmacc.show();
                                    }
                                },'-',{
                                    width: 300,
                                    xtype: 'searchfield',
                                    store: mst_account_kel_store,
                                    emptyText: 'Quick Search...'
                                }]
                        }
                        ,bbar:{                        
                            xtype: 'pagingtoolbar',
                            store: mst_account_kel_store,pageSize: ENDPAGE,
                            displayInfo: true
                        }

                    }
                ]
            
            }
        
        ],
        listeners:{
            show:function(){
                var storegrid=Ext.getCmp('mst_account_kel_grid').store;
                storegrid.loadPage(1);
                    
                
            }
        }
        , initComponent: function() {
            this.callParent(arguments);
        }
    });

    
</script>
