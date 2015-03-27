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
                </script>









