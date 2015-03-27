<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>
            <?php echo $this->config->item('app_title'); ?>
        </title>
        <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/extjs/resources/ext-theme-classic/ext-theme-classic-all.css'); ?>">-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/extjs/resources/ext-theme-gray/ext-theme-gray-all.css'); ?>">
            <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style/mainstyle.css'); ?>">            

                <script type="text/javascript" src="<?php echo base_url('assets/extjs/ext-all.js'); ?>"></script>
                <script type="text/javascript" src="<?php echo base_url('assets/extjs/ux/TabCloseMenu.js'); ?>"></script>
                <script type="text/javascript" src="<?php echo base_url('assets/extjs/ux/SlidingPager.js'); ?>"></script>
                <script type="text/javascript" src="<?php echo base_url('assets/extjs/ux/form/SearchField.js'); ?>"></script>
                <script type="text/javascript" src="<?php echo base_url('assets/extjs/ux/form/NumericField.js'); ?>"></script>
                <script type="text/javascript" src="<?php echo base_url('assets/extjs/ux/form/TwinCombo.js'); ?>"></script>
                <script type="text/javascript" src="<?php echo base_url('assets/extjs/ux/grid/FiltersFeature.js'); ?>"></script>
                <script type="text/javascript" src="<?php echo base_url('assets/extjs/ux/MonthPicker.js'); ?>"></script>


                <script type="text/javascript">
                    var STARTPAGE = 0;
                    var ENDPAGE = <?= $this->config->item('length_records') ?>;
                    var required_css = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';
                    //            var BASE_ICONS = BASE_PATH + 'assets/icons/';
                    var month_data=[
                        ['01',"Januari"],
                        ['02',"Februari"],
                        ['03',"Maret"],
                        ['04',"April"],
                        ['05',"Mei"],
                        ['06',"Juni"],
                        ['07',"Juli"],
                        ['08',"Augustus"],
                        ['09',"September"],
                        ['10',"Oktober"],
                        ['11',"November"],
                        ['12',"Desember"]
                    ];
                    
                    var yesno_data=[
                        ['Y',"Yes"],
                        ['N',"No"]
                    ];
                    function session_expired(err){
                        Ext.Msg.show({
                            title: 'Error',
                            msg: err,
                            modal: true,
                            closable: false,
                            icon: Ext.Msg.ERROR,
                            buttons: Ext.Msg.OK,
                            fn: function(btn){
                                if (btn == 'ok') {
                                    window.location = '<?= site_url("auth/login") ?>';
                                }
                            }
                        });
                    }	
                    function set_message(opt,vmsg){
                        if (opt==0){
                            Ext.Msg.show({
                                title:'Message Info',
                                msg: vmsg,
                                buttons: Ext.Msg.OK,
                                icon: Ext.Msg.INFO
                            });
                        }else if (opt==1){
                            Ext.Msg.show({
                                title:'Message Error',
                                msg: vmsg,
                                buttons: Ext.Msg.OK,
                                icon: Ext.Msg.ERROR
                            });
                        }else if (opt==2){
                            Ext.Msg.show({
                                title:'Message Warning',
                                msg: vmsg,
                                buttons: Ext.Msg.OK,
                                icon: Ext.Msg.WARNING
                            });
                        }
                    
                    }
                    function createStore(vautoload,vstoreId,vfields,vurl,listen){
                        return Ext.create('Ext.data.Store',{
                            //        pageSize: ENDPAGE,
                            autoLoad	: vautoload,
                            autoSync	: false,
                            storeId		: vstoreId,
                            fields: vfields,
                            proxy		: {
                                type: 'ajax',
                                api: {
                    
                                    read    : vurl
		   
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
                                        }
                                        else{
                                            console.log(err.errMsg);
                                        }                                       
                                    }
                                }
                            }
                        });
                    }
                    
                    function createStoreGroup(vautoload,vstoreId,vfields,vgroup,vurl,listen){
                        return Ext.create('Ext.data.Store',{
                            //        pageSize: ENDPAGE,
                            autoLoad	: vautoload,
                            autoSync	: false,
                            storeId		: vstoreId,
                            fields: vfields,
                            groupField:vgroup,
                            proxy		: {
                                type: 'ajax',
                                api: {
                    
                                    read    : vurl
		   
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
                                        }
                                        else{
                                            console.log(err.errMsg);
                                        }                                       
                                    }
                                }
                            }
                        });
                    }
            
                    function createStoreGroupers(vautoload,vstoreId,vfields,vgroup,vurl,listen){
                        return Ext.create('Ext.data.Store',{
                            //        pageSize: ENDPAGE,
                            autoLoad	: vautoload,
                            autoSync	: false,
                            storeId		: vstoreId,
                            fields: vfields,
                            groupers:vgroup,
                            proxy		: {
                                type: 'ajax',
                                api: {
                    
                                    read    : vurl
		   
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
                                        }
                                        else{
                                            console.log(err.errMsg);
                                        }                                       
                                    }
                                }
                            }
                        });
                    }
            
                    function createArrayStore(vdata){
                        return Ext.create('Ext.data.ArrayStore',{
                            fields: [
                                {name: 'mid'},
                                {name: 'mtext'}
                            ],
                            data:vdata
                        });
                    } 
                    
                    function setDefaultStoreProxy(store,urlProxy){
                        store.proxy.api.read=urlProxy;
                    }
    
    
                    function defineTwinAkun_windows(winname,winid,storeakun,func_doubleklik){
                        Ext.define(winname, {
                            extend          : 'Ext.window.Window',
                            title           : 'Search Rekening',
                            width           : 410,
                            height          : 300,
                            layout          : 'fit',
                            autoShow        : true,
                            modal           : true,
                            alias           : 'widget.search_rekening',
                            id              : winid,
                            items:[{
                                    //            regin:'center',
                                    xtype:'panel',
                                    frameHeader:false,
                                    //                    title: 'Pilih Akun',
                                    layout: 'fit',
                                    buttonAlign: 'left',
                                    modal: true,
                                    width: 400,
                                    height: 300,
                                    closeAction: 'hide',
                                    plain: true,
                                    items: [{
                                            xtype:'grid',
                                            store: storeakun,
                                            stripeRows: true,
                                            frame: true,
                                            border:true,        
                                            columns: [{
                                                    header: 'Rekening',
                                                    dataIndex: 'rekening',
                                                    width: 80,
                                                    sortable: true			
                
                                                },{
                                                    header: 'Nama Rekening',
                                                    dataIndex: 'nama_rekening',
                                                    width: 300,
                                                    sortable: true         
                                                }],
                                            tbar: {
                    
                                                //                                regin:'north',
                                                xtype: 'toolbar',
                                                items: [{xtype: 'searchfield',
                                                        store: storeakun,
                                                        width: 380,
                                                        emptyText: 'Quick Search...'
                                                    }]
                                            },
                                            bbar: {
                                                xtype: 'pagingtoolbar',
                                                pageSize: ENDPAGE,
                                                store: storeakun,
                                                displayInfo: true
                                            },
                                            listeners: {
                                                'itemdblclick': func_doubleklik
                                            }
                                        }]
                                }],
                            initComponent   : function(){
                                this.callParent(arguments);
                            }

                        });
                    }
                    
                    //--------------------------------------------------------------------
    Ext.define('update_password_form', {
        extend          : 'Ext.form.Panel',
        alias           : 'widget.update_password_form',
        id              : 'update_password_form',
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
        url: '<?php echo base_url(); ?>' + 'user_setting/update_password',
        buttonAlign     : 'center',
        padding         : 5,
        style           : 'background-color: #fff;',
        border          : false,
        initComponent   : function(){
            this.items = [
                
                   
                        {
                            name: 'user_id',
                            fieldLabel:'User Id',
                            id: 'update_user_id',
                            tooltip: 'Field tidak boleh kosong',
                            afterLabelTextTpl: required_css, 
                            allowBlank:false,
                            maxLength:10,
                            width: 50,
                            readOnly:true,
                            anchor:'90%'
                        },{
                            name: 'user_password',
                            id: 'update_user_password',
                            fieldLabel:'Old Password',
                            inputType:'password',
                            tooltip: 'Field tidak boleh kosong',
                            afterLabelTextTpl: required_css,   
                            allowBlank:false,                            
                            width: 200,
                            anchor:'90%'
//                            margins: '0 0 0 5'
                            
                        },{
                            name: 'new_password',
                            id: 'update_new_password',
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
                    itemId: 'update_simpan',
                    id:'update_simpan_respwd_btn',
                    iconCls: 'icon-list-accept',
                    handler: this.submit
                },
                {
                    text: 'Batal',
                    action: 'cancel',
                    itemId: 'update_respwd_batal',
                    iconCls: 'icon-cancel',
                    handler: function(){
                        this.up('window').close();
                    }
                }
            ];
            this.callParent(arguments);
        },
        submit: function(){
            var parcmd='updatepassword';            
            
            if(!Ext.getCmp('update_password_form').getForm().isValid()){
                set_message(2,'Masih Ada Field Yang Salah!!!');
                return;
            }            
                                    
            Ext.getCmp('update_password_form').getForm().submit({
                url: this.url,
                scope: this,
                params: {
                    cmd: parcmd
                },
                waitMsg: 'Saving Data...',
                success: function(form, action) {
                    var vmsg=action.result.msg;
//                    set_message(0,action.result.msg);
                    Ext.Msg.show({
                                title:'Message Info',
                                msg: vmsg,
                                buttons: Ext.Msg.OK,
                                icon: Ext.Msg.INFO,
                                fn:function(btn){
                                    if (btn == 'ok'){
                                        Ext.Ajax.request({
                                            url: '<?= site_url("auth/logout") ?>',
                                            method: 'POST',
                                            success: function(xhr){
                                                window.location = '<?= site_url("auth/login") ?>';
                                            }
                                        });
                                    }
                                }
                            });
                    
                },
                failure: function(form, action) {
                    var resp=action.response.responseText;
                    set_message(2,action.result.msg);

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
    Ext.define('update_password_win', {
        extend          : 'Ext.window.Window',
        title           : 'Change Password',
        width           : 300,
        height          : 170,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.update_password_edit',
        id              : 'update_password_win',
        //        maximizable     :true,
        initComponent   : function(){
            this.items = [
                Ext.widget('update_password_form')
            ];
            this.callParent(arguments);
        }

    });
    //--------------------------------------------------------------------
                </script>









