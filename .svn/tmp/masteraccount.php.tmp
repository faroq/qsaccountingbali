<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript"> 
    var MasterAccountStore = Ext.create('Ext.data.Store',{
        //        pageSize: ENDPAGE,
        autoLoad	: false,
        autoSync	: false,
        storeId		: 'mMasterAccountStore',
        fields: [ 
            'rekening','nama_rekening','default','nama_kelompok','nama_jenis','kelompok','jenis'
        ],
        proxy		: {
            type: 'ajax',
            api: {
                    
                read    : '<?php echo base_url(); ?>' + 'masteraccount/get_rows'
		   
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
            listeners: {//                {
                exception: function(proxy, response, operation){
                    var err = Ext.decode(response.responseText);                    
                    if (err.errMsg == 'Session Expired') {
                        session_expired(err.errMsg);
                    }else{
                        set_message(1,err.errMsg);
                    }                                       
                }
            }
        }
    });
    
    
    var JenisAccountStore = Ext.create('Ext.data.Store',{        
        autoLoad	: false,
        autoSync	: false,
        storeId		: 'mJenisAccountStore',
        fields: [ 
            'jenis','nama_jenis'
        ],
        proxy		: {
            type: 'ajax',
            api: {
                    
                read    : '<?php echo base_url(); ?>' + 'masteraccount/get_jenis'
		   
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
            listeners: {//                {
                exception: function(proxy, response, operation){
                    var err = Ext.decode(response.responseText);                    
                    if (err.errMsg == 'Session Expired') {
                        session_expired(err.errMsg);
                    }else{
                        set_message(1,err.errMsg);
                    }                                       
                }
            }
        }
    });
    var urlKelompok='<?php echo base_url(); ?>' + 'masteraccount/get_kelompok/""';
    var KelompokAccountStore = Ext.create('Ext.data.Store',{        
        autoLoad	: false,
        autoSync	: false,
        storeId		: 'mKelAccountStore',
        fields: [ 
            'kelompok','nama_kelompok'
        ],
        proxy		: {
            type: 'ajax',
            api: {
                    
                read    : '<?php echo base_url(); ?>' + 'masteraccount/get_kelompok/""'
		   
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
            listeners: {//                {
                exception: function(proxy, response, operation){
                    var err = Ext.decode(response.responseText);                    
                    if (err.errMsg == 'Session Expired') {
                        session_expired(err.errMsg);
                    }else{
                        set_message(1,err.errMsg);
                    }                                       
                }
            }
        }
    });  
    
    Ext.define('FormMacc', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.maccForm',
        id              : 'FormMacc_id',
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
        url: '<?php echo base_url(); ?>' + 'masteraccount/update_rows',
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
                    id: 'macc_jenis',
                    store: JenisAccountStore,
                    valueField: 'jenis',
                    displayField: 'nama_jenis',
                    typeAhead: true,
                    triggerAction: 'all',                    
                    // allowBlank: false,
                    editable: false,
                    anchor: '90%',
                    hiddenName: 'jenis',
                    emptyText: 'Jenis Rekening',
                    listeners: {
                        select: function(combo, records) {
                            var jenisValue = this.getValue();
                            var cmbkelompok=Ext.getCmp('macc_kelompok');
                            cmbkelompok.setValue('');  
                            cmbkelompok.store.proxy.api.read='<?php echo base_url(); ?>' + 'masteraccount/get_kelompok/'+jenisValue;
                            cmbkelompok.store.load();
                            
                        }
                    }
                },
                {
                    xtype: 'combo',                        
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Kelompok',                        
                    id: 'macc_kelompok',
                    mode:'local',
                    store: KelompokAccountStore,
                    valueField: 'kelompok',
                    displayField: 'nama_kelompok',
                    typeAhead: true,
                    triggerAction: 'all',                    
                    allowBlank: false,
                    editable: false,
                    anchor: '90%',
                    hiddenName: 'kelompok',
                    emptyText: 'Nama Kelompok'
               
                },
                {
                    name: 'rekening',
                    id: 'macc_rekening',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Rekening'                        
                }
                ,{
                    name: 'nama_rekening',
                    id: 'macc_namarekening',
                    tooltip: 'Field tidak boleh kosong',
                    afterLabelTextTpl: required_css,
                    fieldLabel: 'Nama Rekening'                        
                }                    
            ];
            this.buttons = [
                {
                    text: 'Simpan',                    
                    itemId: 'simpan',
                    id:'btn_macc_simpan',
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
            var parcmd=Ext.getCmp('btn_macc_simpan').getText();
            if(parcmd === 'Simpan'){
                parcmd='insert';
            }else if(parcmd === 'Edit'){
                parcmd='update';
            }
        
            //        var prekening=Ext.getCmp('macc_rekening').getValue();
            //        var pnamarekening=Ext.getCmp('macc_namarekening').getValue();
            var pjenis=Ext.getCmp('macc_jenis').getValue();
            var pkelompok=Ext.getCmp('macc_kelompok').getValue();
        
            Ext.getCmp('FormMacc_id').getForm().submit({
                url: this.url,
                scope: this,
                //                success: this.onSuccess,
                //                failure: this.onFailure,
                params: {
                    cmd: parcmd,
                    jenis: pjenis,
                    kelompok:pkelompok
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    //                    console.log(action);
                    set_message(0,action.result.msg);
                    //                    Ext.Msg.alert('Success', action.result.msg);
                    Ext.getCmp('gridid').store.reload(); 
                    Ext.getCmp('FormMacc_id').getForm().reset();
                    Ext.getCmp('WindowMacc_id').close();
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

    Ext.define('WindowMacc', {
        extend          : 'Ext.window.Window',
        title           : 'Form Edit User',
        width           : 400,
        height          : 200,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.MaccEdit',
        id              : 'WindowMacc_id',
        initComponent   : function(){
            this.items = [
                Ext.widget('maccForm')
            ];
            this.callParent(arguments);
        }

    });
      
    

    
    Ext.define('MyTabMasterAccount', {
        extend: 'Ext.container.Container',
        xtype: 'TabMasterAccount',
        alias: 'widget.TabMasterAccount',
        title: 'Master Account',
        id: 'tab1b',
        closable: true,        
        layout: 'border',
        items: [{
                xtype: 'panel',
                autoShow: true,
                id: 'panelmasteracc',            
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'gridid',
                        stateful:true,
                        stateId:'stateGrid',
                        store: MasterAccountStore,//Ext.data.StoreManager.lookup('mMasterAccountStore'),
                        stripeRows: true,
                        loadMask: true,
                        //                        sm:sm_masteraccount,
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
                                            var winmacc=Ext.create('WindowMacc');
                                            winmacc.setTitle('Edit Form');
                                            Ext.getCmp('btn_macc_simpan').setText('Edit');
                                            Ext.getCmp('btn_macc_simpan').setIconCls('icon-edit-record');
                                            Ext.getCmp('macc_rekening').setReadOnly(true);
                                            Ext.getCmp('macc_rekening').setFieldStyle('readonly-input');
                                            Ext.getCmp('macc_rekening').setValue(rec.get('rekening'));
                                            Ext.getCmp('macc_namarekening').setValue(rec.get('nama_rekening'));
                                            var jenisval=rec.get('jenis');
                                            Ext.getCmp('macc_jenis').setValue(jenisval);
                                            Ext.getCmp('macc_kelompok').store.proxy.api.read='<?php echo base_url(); ?>' + 'masteraccount/get_kelompok/'+jenisval;
                                            Ext.getCmp('macc_kelompok').store.load();
                                            Ext.getCmp('macc_kelompok').setValue(rec.get('kelompok'));
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
                                                            url: '<?php echo base_url(); ?>' +'masteraccount/delete_row',
                                                            method: 'POST',
                                                            params: {
                                                                cmd: 'delete',
                                                                postdata: data
                                                            },
                                                            success: function(obj) {
                                                                var   resp = Ext.decode(obj.responseText);                                                                
                                                                if(resp.success==true){
                                                                    //                                                                    Ext.Msg.alert('info',resp.msg);
                                                                    set_message(0,resp.msg);
                                                                    Ext.getCmp('gridid').store.reload();                                                                                                                                     
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
                                                            //                                                            ,
                                                            //                                                            callback:function(opt,success,responseObj){
                                                            //                                                                var de = Ext.util.JSON.decode(responseObj.responseText);
                                                            //                                                                if(de.success==true){
                                                            //                                                                    Ext.getCmp('gridid').store.reload();                                                                                                                                     
                                                            //                                                                }else{
                                                            //                                                                    Ext.Msg.show({
                                                            //                                                                        title: 'Error',
                                                            //                                                                        msg: de.errMsg,
                                                            //                                                                        modal: true,
                                                            //                                                                        icon: Ext.Msg.ERROR,
                                                            //                                                                        buttons: Ext.Msg.OK,
                                                            //                                                                        fn: function(btn){
                                                            //                                                                            if (btn == 'ok' && de.errMsg == 'Session Expired') {
                                                            //                                                                                window.location = '<?= site_url("auth/login") ?>';
                                                            //                                                                            }
                                                            //                                                                        }
                                                            //                                                                    });
                                                            //                                                                }
                                                            //                                                            }
                                                        });                 
                                                    } 
                                                }
                                            });
                                        }
                                    }
                                ]
                            }
                           
                            ,
                            {
                                header: "Rekening",
                                dataIndex: 'rekening',
                                sortable: true,
                                width: 70
                            }
                            ,{
                                header: "Nama Rekening",
                                dataIndex: 'nama_rekening',
                                sortable: true,
                                width: 120
                            },{
                                header: "Debet/Kredit",
                                dataIndex: 'default',
                                sortable: true,
                                width: 70
                            },{
                                header: "Kelompok",
                                dataIndex: 'nama_kelompok',
                                sortable: true,
                                width: 120
                            },{
                                header: "Jenis Rekening",
                                dataIndex: 'nama_jenis',
                                sortable: true,
                                width: 100
                            },{
                                header: "Kelompok",
                                dataIndex: 'kelompok',
                                sortable: true,
                                width: 50,
                                hidden:true
                            },{
                                header: "Jenis",
                                dataIndex: 'jenis',
                                sortable: true,
                                width: 50,
                                hidden:true
                            }
                        
                        ]
                        ,tbar:{
                            xtype: 'toolbar',
                            padding:'2 0 2 5',
                            items: [
                                {
                                    xtype: 'button',
                                    text: 'Add',
                                    iconCls: 'icons-add',
                                    onClick: function()
                                    {
                                        var winmacc=Ext.create('WindowMacc');
                                        winmacc.setTitle('Add Form');
                                        Ext.getCmp('btn_macc_simpan').setText('Simpan');
                                        Ext.getCmp('btn_macc_simpan').setIconCls('icons-add');
                                        setDefaultStoreProxy(KelompokAccountStore, urlKelompok);
                                        winmacc.show();
                                    }
                                    //                                    ,action: 'add'
                                },
                                {
                                    xtype: 'button',
                                    text: 'Repot',
                                    iconCls: 'icons-add',
                                    onClick: function()
                                    {
                                        //Ext.Ajax.request({url: '<?php echo base_url(); ?>' +'masteraccount/create_pdf'});
                                        //Ext.Ajax.request({url: 'http://localhost/fpdf16/tutorial/tuto1.php'});
                                        window.open('<?php echo base_url(); ?>' +'masteraccount/create_pdf');
                                    }
                                    //                                    ,action: 'add'
                                },
                                '-',
                                {
                                    width: 300,
                                    //                                fieldLabel: 'Search',
                                    //                                labelWidth: 50,
                                    xtype: 'searchfield',
                                    store: MasterAccountStore,
                                    emptyText: 'Quick Search...'
                                }
                            ]
                        }
                        ,bbar:{                        
                            xtype: 'pagingtoolbar',
                            store: MasterAccountStore,pageSize: ENDPAGE,
                            displayInfo: true
                            //                    plugins: Ext.create('Ext.ux.SlidingPager', {})
                        }

                    }
                ]
            
            }
        
        ],
        listeners:{
            show:function(){
                var storegrid=Ext.getCmp('gridid').store;                
                storegrid.loadPage(1);
                JenisAccountStore.load();
                //                KelompokAccountStore.load();    
                
            }
        }
        , initComponent: function() {
            this.callParent(arguments);
        }
    });

    
</script>
