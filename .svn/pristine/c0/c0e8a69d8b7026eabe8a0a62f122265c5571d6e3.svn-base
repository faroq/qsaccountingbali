<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 


    var strgrid_akun = createStore(false,'makun_ej_Store1',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');

        Ext.define('Windowej', {
        extend          : 'Ext.window.Window',
        title           : 'Search Rekening',
        width           : 410,
        height          : 300,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.search_rekening',
        id              : 'window_ej_id',
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
                            store: strgrid_akun,
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
                                        store: strgrid_akun,
                                        width: 380,
                                        emptyText: 'Quick Search...'
                                    }]
                            },
                            bbar: {
                                xtype: 'pagingtoolbar',
                                pageSize: ENDPAGE,
                                store: strgrid_akun,
                                displayInfo: true
                            },
                            listeners: {
                                'itemdblclick': function(){			
                                    var sm = this.getSelectionModel();
                                    var sel = sm.getSelection();
                                    //                console.log('doublekil');
                                    if (sel.length > 0) {				
                                        Ext.getCmp('ej_grid_rekening').setValue(sel[0].get('rekening'));
                                        Ext.getCmp('ej_grid_nmrekening').setValue(sel[0].get('nama_rekening'));                    
                                        Ext.getCmp('window_ej_id').close();
                                        Ext.getCmp('ej_grid_debet').focus();
                                    }
                                }
                            }
                        }]
                }],
        initComponent   : function(){
//            this.items = [
//                Ext.widget('menu_ej_akun')
//            ];
            this.callParent(arguments);
        }

    });
    
    //============================================================
    var entryjurnalstore = createStore(false,'mEntryJurnalStore',['rekening','nama_rekening','debet','kredit'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
 
    function set_total_ej(){		
        var totaldebet=0;
        var totalkredit=0;
        var totalselisih=0;
                
        entryjurnalstore.each(function(node){			
            totaldebet += parseInt(node.data.debet);
            totalkredit += parseInt(node.data.kredit);
        });
        totalselisih=totaldebet-totalkredit;
        Ext.getCmp('ej_t_debet').setValue(totaldebet);
        Ext.getCmp('ej_t_kredit').setValue(totalkredit);                
    };
    entryjurnalstore.on('update', function(){
        set_total_ej();        
		
    });
    entryjurnalstore.on('remove',  function(){
        set_total_ej();
		
    });
    
    
    Ext.define('Writer.Entryjurnal', {
        extend: 'Ext.data.Model',
        fields: [{
                name: 'rekening',
                type: 'string',
                useNull: false
            }, 'nama_rekening','debet','kredit']
    
    });
    function addrecord_entryjurnal(){
        var vGrid = Ext.getCmp('gridej');
        //        console.log(Plant);
        var rowentryjurnal = new Writer.Entryjurnal({
            rekening: '',
            nama_rekening: '',
            debet: 0,
            kredit: 0

        });
        var edit = vGrid.getPlugin();
        edit.cancelEdit();
        vGrid.getStore().insert(0, rowentryjurnal);
        edit.startEdit(0, 0);
    }
    //    Ext.define('Ext.ux.CustomTrigger', {
    //    extend: 'Ext.form.field.Trigger',
    //    alias: 'widget.customtrigger',
    //
    //    // override onTriggerClick
    //    onTriggerClick: function() {
    //        Ext.Msg.alert('Status', 'You clicked my trigger!');
    //    }
    //});

    Ext.define('MyTabEntryJournal', {
        extend: 'Ext.container.Container',
        xtype: 'TabEntryJournal',
        alias: 'widget.TabEntryJournal',
        title: 'Entry Journal',
        id: 'tab1d',
        closable: true,        
        layout: 'border',
        items: [ {xtype: 'panel',
                autoShow: true,
                id: 'panelentryjurnal',            
                region: 'north',
                margins: '5 5 5 5',
                layout: 'column',
                items:[
                    {
                        xtype: 'form',
                        id:'entry_jurnal_header',
                        columnWidth: .4,
                        //                        monitorValid: true,  
                        layout: 'form',
                        border: false,
                        labelWidth: 80,
                        bodyPadding: '5 5 5 5',
                        defaults: { labelSeparator: ''}
                        ,items :[{
                
                                xtype: 'datefield',
                                name: 'tgl_jurnal',
                                fieldLabel: 'Tanggal Entry',                                
                                anchor: '90%',
                                allowBlank: false
                                ,format:'Y-m-d'
                                ,value:new Date()
                                ,maxValue:new Date()
                                ,afterLabelTextTpl: required_css
                            },{
                                xtype: 'textfield',
                                name: 'referensi',
                                fieldLabel: 'Referensi',
                                anchor: '90%',
                                allowBlank: false
                                ,afterLabelTextTpl: required_css
            
                            },{
                                xtype: 'textfield',
                                name: 'keterangan',
                                fieldLabel: 'Keterangan',
                                anchor: '90%',
                                allowBlank: false
                                ,afterLabelTextTpl: required_css
            
                            }
                            //                                                        ,{xtype: 'twincombo',
                            //                                                            name: 'keterangan',
                            //                                                            fieldLabel: 'Keterangan',
                            //                                                            store:strgrid_akun,
                            //                                                            menu:'Windowej'
                            //                                                        }
                            
                        ]
                        ,listeners:{
                            show:function(){
                                comboakun_entry.load();
                            }
                        }
                    }
                ]
                
            },{
                xtype: 'panel',
                autoShow: true,
                //                id: 'gridentryjurnal',            
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'gridej',
                        store: entryjurnalstore,
                        stripeRows: true,
                        //                        loadMask: true,
                        stateful:true,
                        stateId:'stateGridEJ',   
                        selModel:Ext.create('Ext.selection.RowModel',{
                            listeners:{
                                selectionchange: function( scope, selected, eOpts ){
                                    Ext.getCmp('gridej').down('#delete').setDisabled(selected.length === 0);
                                }
                            }
                        })
                        //                        selType: 'cellmodel',
                        ,plugins: [
                            Ext.create('Ext.grid.plugin.RowEditing', {
                                clicksToMoveEditor: 1,
                                autoCancel: false,
                                listeners: {
                                    cancelEdit: function(rowEditing, context) {
                                        // Canceling editing of a locally added, unsaved record: remove it
                                        if (context.record.phantom) {
                                            Ext.getCmp('gridej').getStore().remove(context.record);
                                        }
                                    }
                                }
                            })
                            //                            Ext.create('Ext.grid.plugin.CellEditing', {
                            //                                clicksToEdit: 1
                            //                            })
                        ],
                        columns:[
                            {
                                text: 'Rekening',
                                dataIndex: 'rekening',
                                sortable: false,
                                //                                flex:1,
                                width: 100,
                                editor:{xtype: 'twincombo',
                                    id:'ej_grid_rekening',
                                    store:strgrid_akun,
                                    menu:'Windowej',
                                    enableKeyEvents:true,
                                    allowBlank:false
                                    ,listeners:{
                                        keyup: function(f,e,opt) { 
                                            if (e.getKey()==113){
                                                f.onTrigger1Click();
                                            }                                            
                                        }
                                    }
                                }                              
                            }
                            , {
                                text: 'Nama Rekening',
                                dataIndex: 'nama_rekening',
                                sortable: false,
                                //                                flex:1,
                                width: 300,
                                editor:
                                    {
                                    xtype:'textfield',
                                    id:'ej_grid_nmrekening',
                                    allowBlank: false,        
                                    readOnly:true
                                    //                                    ,disabled:true
                                
                                }
                            }
                            , {
                                xtype:'numbercolumn',
                                text: 'Debet',
                                dataIndex: 'debet',
                                sortable: false,
                                align:'right',
                                //                                flex:1,
                                width: 120,
                                format: '0,0',                                
                                editor:  {
                                    xtype: 'numberfield',
                                    id: 'ej_grid_debet',
                                    allowBlank: false,   
                                    hideTrigger: true,
                                    minValue: 0,
                                    fieldStyle: 'text-align: right;'
                                    ,listeners:{
                                        'render': function(c) {
                                            c.getEl().on('keyup', function() {                                               
                                                if(Ext.getCmp('ej_grid_debet').getValue()===null){
                                                    
                                                    Ext.getCmp('ej_grid_debet').setValue(0);
                                                }
                                                if(Ext.getCmp('ej_grid_kredit').getValue()>0){
                                                    Ext.getCmp('ej_grid_debet').setValue(0);
                                                }
                                            }
                                        )}
                                    }
                                }
                            }
                            ,{
                                xtype:'numbercolumn',
                                text: 'Kredit',
                                dataIndex: 'kredit',
                                sortable: false,
                                //                                flex:1,
                                width: 120,
                                align:'right',
                                format: '0,0',
                                editor:  {
                                    xtype: 'numberfield',
                                    id: 'ej_grid_kredit',
                                    allowBlank: false,                                                                        
                                    hideTrigger: true,
                                    fieldStyle: 'text-align: right;',
                                    minValue: 0,
                                    listeners:{
                                        'render': function(c) {
                                            c.getEl().on('keyup', function() {                                              
                                                if(Ext.getCmp('ej_grid_kredit').getValue()===null){
                                                    
                                                    Ext.getCmp('ej_grid_kredit').setValue(0);
                                                }
                                                if(Ext.getCmp('ej_grid_debet').getValue()>0){
                                                    Ext.getCmp('ej_grid_kredit').setValue(0);
                                                }
                                            }
                                        )}
                                    }
                                }
                            }
                        ]
                        ,tbar:[{
                                text: 'Add',
                                iconCls: 'icons-add',
                                handler: function(){
                                    addrecord_entryjurnal();
                                }
                            }, '-', {
                                itemId: 'delete',
                                text: 'Delete',
                                iconCls: 'icon-delete',
                                disabled: true,
                                handler: function(){
                                    var vGrid=Ext.getCmp('gridej');
                                    var selection = vGrid.getView().getSelectionModel().getSelection()[0];
                                    if (selection) {
                                        vGrid.getStore().remove(selection);
                                    }
                                }
                            }]
                        ,bbar:['->' ,
                            {   
                                xtype:'numericfield',
                                fieldLabel: 'Total Debet',
                                id: 'ej_t_debet',
                                currencySymbol: null,
                                useThousandSeparator: true,
                                thousandSeparator: ',',
                                alwaysDisplayDecimals: false,
                                fieldStyle: 'text-align: right;',
                                value:0,
                                hideTrigger: true,
                                readOnly:true
                            },
                            '-',
                            {
                                xtype:'numericfield',
                                fieldLabel: 'Total Kredit',
                                id: 'ej_t_kredit',
                                currencySymbol: null,
                                useThousandSeparator: true,
                                thousandSeparator: ',',
                                alwaysDisplayDecimals: false,
                                fieldStyle: 'text-align: right;',
                                value:0,
                                hideTrigger: true,
                                readOnly:true
                            }
                        ]
                        ,listeners: {
                            'afterRender' : function() {                       
                                Ext.getCmp('gridej').getEl().addKeyMap({
                                    eventName: "keyup",
                                    binding: [                                       
                                        {
                                            key: Ext.EventObject.F4,
                                            fn:  addrecord_entryjurnal
                                            
                                        },{
                                            key: Ext.EventObject.F2,
                                            fn:  function(){
                                                var vGrid=Ext.getCmp('gridej');
                                                if(vGrid.getStore().getCount()>0){
                                                    vGrid.getPlugin().startEdit(0, 0);
                                                }
                                                
                                            }
                                            
                                        }]

                                });
                              

                            }

                        }
                        
                    }
                ]
            },{
                xtype: 'panel',
                autoShow: true,
                //                id: 'gridentryjurnal',            
                region: 'south',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    { xtype: 'toolbar',
                        height:40,
                        padding:'2 0 2 5',
                        items: ['->',{
                                xtype: 'button',
                                formBind: true,
                                text: 'Save',
                                iconCls: 'icon-simpan'
                                ,handler: function() {
                                    if (Ext.getCmp('entry_jurnal_header').getForm().isValid()) {
                                        if(Ext.getCmp('gridej').getStore().getCount()>0){
                                            if(Ext.getCmp('ej_t_debet').getValue()==Ext.getCmp('ej_t_kredit').getValue()){
                                                if(Ext.getCmp('ej_t_debet').getValue()==0 && Ext.getCmp('ej_t_kredit').getValue()==0){
                                                    set_message(1,'Value is 0 In entry level!!!');
                                                    return;
                                                }
                                                var vdata=new Array();
                                                var parcmd='entry';
                                                //                                                entryjurnalstore.sort('debet', 'DESC');
                                                entryjurnalstore.each(function(node){			
                                                    vdata.push(node.data);                                                    
                                                });
                                                
                                                Ext.getCmp('entry_jurnal_header').getForm().submit({
                                                    url: '<?php echo base_url(); ?>' + 'entry_jurnal/update_rows',
                                                    scope: Ext.getCmp('entry_jurnal_header'),                                                
                                                    params: {
                                                        cmd: parcmd,
                                                        postdata:Ext.JSON.encode(vdata)
                                                    },
                                                    waitMsg: 'Saving Data...',
                                                    success: function(form, action) {                                                    
                                                        set_message(0,action.result.msg);                                                    
                                                        reset_ej();
                                                    },
                                                    failure: function(form, action) {
                                                        set_message(1,'Execute Aborted');                                                     
                                                    }
                                                });
                                            }else{ 
                                                set_message(1,'Any Gap In entry level!!!');
                                            }
                                            
                                        }else{
                                            set_message(1,'Not Valid Value Grid Data!!!');
                                        }
                                    }else{
                                        set_message(1,'Not Valid Value Header!!!');
                                    }
                                }
                                
                            },{
                                xtype: 'button',
                                text: 'Cancel / Reset',
                                iconCls: 'icon-refresh',
                                handler:function(){
                                    reset_ej();
                                
                                }
                            }]
                    }
                ]
            }
           
        ],
        listeners:{
            show:function(){
            strgrid_akun.load();
            }
        },
        initComponent: function() {
            this.callParent(arguments);
        }
    });
    function reset_ej(){
        Ext.getCmp('entry_jurnal_header').getForm().reset();
        Ext.getCmp('gridej').getStore().removeAll();
        Ext.getCmp('ej_t_debet').setValue(0);
        Ext.getCmp('ej_t_kredit').setValue(0);
    }

</script>