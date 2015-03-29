<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    var store_gl_akun = createStore(false,'makun_gl_Store',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
    //    var gl_store1 = createStore(false,'mgl_Store1',['tanggal','rekening','nama_rekening','keterangan','referensi','debet','kredit','jumlah'],'<?php echo base_url(); ?>' + 'base_report/get_row_gl');
    var gl_store1 = createStoreGroup(false,'mgl_Store1',['tanggal','rekening','keterangan','referensi','debet','kredit','jumlah'],'rekening','<?php echo base_url(); ?>' + 'base_report/get_row_gl');
    var gl_store2 = createStore(false,'mgl_Store2',['tanggal','keterangan','referensi','debet','kredit','jumlah'],'<?php echo base_url(); ?>' + 'base_report/get_row_gl');
   
    Ext.define('glprint_wind', {
        extend          : 'Ext.window.Window',
        title           : 'General Ledger Preview',
        width           : 900,
        height          : 450,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.gl_print',
        id              : 'glprint_wind',
        maximizable     :true,
        html:'<iframe style="width:100%;height:100%;" id="glprint" src=""></iframe>'

    });
    
    var store_gl_akunfind = createStore(false,'store_gl_akunfind',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
    
        
    defineTwinAkun_windows('Window_gl_akunfind','window_gl_akunfind',store_gl_akunfind,
    function(){
        var sm = this.getSelectionModel();
        var sel = sm.getSelection();
        if (sel.length > 0) {				
            Ext.getCmp('gl_rekening').setValue(sel[0].get('rekening'));
            Ext.getCmp('id_nama_gl_rekening').setValue(sel[0].get('nama_rekening'));                    
            Ext.getCmp('window_gl_akunfind').close();
            //                                        Ext.getCmp('ej_grid_debet').focus();
        }
    }
);
    
    var rgroup='';
    var glthbl=new Date();
    Ext.define('MyTabGeneralLedger', {
        extend: 'Ext.container.Container',
        xtype: 'TabGeneralLedger',
        alias: 'widget.TabGeneralLedger',
        title: 'General Ledger',
        id: 'tab1g',
        closable: true,        
        layout: 'border',
        items: [ {xtype: 'panel',
                autoShow: true,
                id: 'panelGeneralLedger',
                region: 'north',
                margins: '5 5 5 5',
                layout: 'column',
                items:[
                    {
                        xtype: 'form',
                        columnWidth: .4,
                        layout: 'form',
                        border: false,
                        labelWidth: 80,
                        bodyPadding: '5 5 5 5',
                        defaults: { labelSeparator: ''}
                        ,items :[{
                                xtype:'fieldset',
                                id:'gl_filter_bulantahun',
                                checkboxToggle:true,
                                title: 'Filter Year Month',
                                defaultType: 'textfield',
                                collapsed: false,
                                width:390,
                                layout: 'anchor',
                                defaults: {
                                    anchor: '100%'
                                },
                                items :[
                                    {
                                        xtype: 'monthfield',
                                        name: 'gl_thbl',                                        
                                        //                                        vtype:'daterange',
                                        //                                        startDateField:  'gl_tgl_awal',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tahun Bulan',
                                        anchor: '90%',
                                        format:'Y-F'
                                        ,id:'gl_thbl',
                                listeners:{
                                    select:function(m, d){
                                        glthbl=d; m.setValue(glthbl); 
                                    },
                                            change:function(m,n,o,opt){
//                                                m.setValue(new Date(n.getFullYear(),n.getMonth(),1));
//                                                console.log(n);
                                                   
                                                  m.setValue(glthbl); 
                                            },
                                            writeablechange:function( me, Read, eOpts ){                                                
                                                me.setValue(glthbl); 
                                            },
                                            dirtychange:function( me, isDirty, eOpts ){                                               
                                                me.setValue(glthbl); 
                                            }
                                }
                                        //                                        ,maxValue:new Date()
                                    }
                                    
                                ],listeners:{
                                    collapse:function(){
                                        Ext.getCmp('gl_filter_tgl').expand(true);
                                    },
                                    expand:function(){
                                        if(!Ext.getCmp('gl_filter_tgl').collapsed){
                                            Ext.getCmp('gl_filter_tgl').collapse(true);
                                        }
                                    }
                                }
                            },
                            {
                                xtype:'fieldset',
                                id:'gl_filter_rekening',
                                checkboxToggle:true,
                                title: 'Filter Rekening',
                                defaultType: 'datefield',
                                collapsed: true,
                                width:390,
                                layout: 'anchor',
                                defaults: {
                                    anchor: '100%'
                                },
                                items:[
                                    {
                                        xtype: 'fieldcontainer',
//                                        fieldLabel: 'Rekening Debet',
                                        afterLabelTextTpl: required_css,
                                        //                    labelStyle: 'font-weight:bold;padding:0;',
                                        layout: 'hbox',
                                        defaultType: 'textfield',

                                        fieldDefaults: {
                                            labelAlign: 'top'
                                        },

                                        items: [
                                            {
                                                xtype: 'twincombo',
                                                id:'gl_rekening',
                                                store:store_gl_akunfind,
                                                menu:'Window_gl_akunfind',
                                                width: 80,
                                                name: 'rekening',
                                                itemId: 'rekening',
                                                afterLabelTextTpl: required_css,//                        fieldLabel: 'First',
                                                allowBlank: false
                                            }, {
                                                flex: 1,
                                                itemId: 'nama_rekening',
                                                id:'id_nama_gl_rekening',
                                                name: 'nama_rekening',
                                                readOnly:true

                                            }
                                        ]
                                    }
//                                                                        {
//                                                                            xtype: 'combo',                        
//                                                                            //                    tooltip: 'Field tidak boleh kosong',
//                                                                            afterLabelTextTpl: required_css,
//                                                                            fieldLabel: 'Rekening',                        
//                                                                            id: 'gl_rekening',
//                                                                            store: store_gl_akun,
//                                                                            valueField: 'rekening',
//                                                                            displayField: 'nama_rekening',
//                                                                            typeAhead: true,
//                                                                            triggerAction: 'all',                    
//                                                                            // allowBlank: false,
//                                                                            editable: false,
//                                                                            anchor: '90%',
//                                                                            hiddenName: 'rekening',
//                                                                            emptyText: 'Pilih Rekening'
//                                                        
//                                                                        }
                                ]
                            }
                                
                        
                        ]
                    },
                    {
                        xtype: 'form',
                        columnWidth: .4,
                        layout: 'form',
                        border: false,
                        labelWidth: 80,
                        bodyPadding: '5 5 5 5',
                        defaults: { labelSeparator: ''}
                        ,items :[{
                                xtype:'fieldset',
                                id:'gl_filter_tgl',
                                checkboxToggle:true,
                                title: 'Filter Date',
                                defaultType: 'datefield',
                                collapsed: false,
                                width:390,
                                layout: 'anchor',
                                defaults: {
                                    anchor: '100%'
                                },
                                items :[
                                    {
                                        xtype: 'datefield',
                                        name: 'tgl_Awal',
                                        vtype:'daterange',
                                        endDateField: 'gl_tgl_akhir',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tanggal Awal',
                                        format:'Y-m-d',
                                        anchor: '90%'
                                        //                                        value:new Date()
                                        ,id:'gl_tgl_awal'
                                    },
                                    {
                                        xtype: 'datefield',
                                        name: 'tgl_Akhir',
                                        vtype:'daterange',
                                        startDateField:  'gl_tgl_awal',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tanggal Akhir',
                                        anchor: '90%',
                                        //                                        value:new Date(),
                                        format:'Y-m-d'
                                        ,id:'gl_tgl_akhir'
                                    }
                                ]
                                ,listeners:{
                                    collapse:function(){
                                        Ext.getCmp('gl_filter_bulantahun').expand(true);
                                    },
                                    expand:function(){
                                        if(!Ext.getCmp('gl_filter_bulantahun').collapsed){
                                            Ext.getCmp('gl_filter_bulantahun').collapse(true);
                                        }
                                        
                                    }
                                }
                            }
                        ]
                    }
                ]
                
            },{
                xtype: 'panel',
                autoShow: true,
                //                id: 'gridGeneralLedger',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'grid1f',
                        store: gl_store1,
                        columnLines:true,
                        //                        stripeRows: true,
                        //                        loadMask: true,
                        stateful:true,
                        stateId:'stateGridGL',
                        columns:[
                            {
                                text: 'Tanggal',
                                dataIndex: 'tanggal',
                                sortable: false,
                                //                                flex:1,
                                width: 70
                            }
                            ,
                            {
                                text: 'Rekening',
                                dataIndex: 'rekening',
                                sortable: false,
                                //                                flex:1,
                                width: 80
                            }
                            , {
                                text: 'Nama Rekening',
                                dataIndex: 'nama_rekening',
                                sortable: false,
                                //                                flex:1,
                                width: 120
                            }, {
                                text: 'Keterangan',
                                dataIndex: 'keterangan',
                                sortable: false,
                                flex:1,
                                width: 100
                            }, {
                                text: 'Referensi',
                                dataIndex: 'referensi',
                                sortable: false,
                                //                                flex:1,
                                width: 100
                            }
                            , {
                                xtype:'numbercolumn',
                                text: 'Debet',
                                dataIndex: 'debet',
                                sortable: false,
                                align:'right',
                                //                                flex:1,
                                width: 100,
                                format:'0,0'
                            }
                            ,{
                                xtype:'numbercolumn',
                                text: 'Kredit',
                                dataIndex: 'kredit',
                                sortable: false,
                                align:'right',
                                //                                flex:1,
                                width: 100
                                ,format:'0,0'
                            },{
                                xtype:'numbercolumn',
                                text: 'Jumlah',
                                dataIndex: 'jumlah',
                                sortable: false,
                                align:'right',
                                //                                flex:1,
                                width: 100,
                                format:'0,0'
                            }
                        ],
                        tbar:[{xtype: 'button',
                                text: 'Load Data',
                                iconCls: 'icon-preview',
                                handler:function(){
                                    if (!Ext.getCmp('gl_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('gl_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('gl_filter_tgl').collapsed){
                                        if (!Ext.getCmp('gl_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('gl_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('gl_filter_rekening').collapsed){
                                        if(!Ext.getCmp('gl_rekening').getValue()){
                                            set_message(1,'Rekening belum diisi!!');
                                            return;
                                        }
                                    }
                                    var parquery=new Array();
                                    parquery.push({name:'opt',value:null});
                                    parquery.push({name:'optrek',value:'off'});
                                    parquery.push({name:'thbl',value:null});
                                    parquery.push({name:'tglawal',value:null});
                                    parquery.push({name:'tglakhir',value:null});
                                    parquery.push({name:'rekening',value:null});
                                    
                                    //                                    'tgl','off','201309','2013-09-26','2013-09-27','1110.10'
                                    if (!Ext.getCmp('gl_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('gl_thbl').getValue(),'Ym');                                       
                                        if(Ext.getCmp('gl_thbl').getValue()!=glthbl){
                                            Ext.getCmp('gl_thbl').setValue(glthbl);
                                            parquery[2]['value']=  Ext.Date.format(glthbl,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('gl_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';                                        
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('gl_tgl_awal').getValue(), 'Y-m-d');  
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('gl_tgl_akhir').getValue(), 'Y-m-d');                                                                                 
                                    }
                                    if (!Ext.getCmp('gl_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('gl_rekening').getValue(); 
                                        Ext.getCmp('grid1f').reconfigure(gl_store2,getColums_gl(2));
                                        gl_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        Ext.getCmp('grid1f').reconfigure(gl_store1,getColums_gl(1));
                                        gl_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                    
                                    
                                    //                                    console.log(Ext.JSON.encode(parquery));
                                    
                                    
                                }
                                
                            },
                            {xtype: 'button',
                                text: 'Preview PDF',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('gl_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('gl_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('gl_filter_tgl').collapsed){
                                        if (!Ext.getCmp('gl_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('gl_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('gl_filter_rekening').collapsed){
                                        if(!Ext.getCmp('gl_rekening').getValue()){
                                            set_message(1,'Rekening belum diisi!!');
                                            return;
                                        }
                                    }
                                    var parquery=new Array();
                                    parquery.push({name:'opt',value:null});
                                    parquery.push({name:'optrek',value:'off'});
                                    parquery.push({name:'thbl',value:null});
                                    parquery.push({name:'tglawal',value:null});
                                    parquery.push({name:'tglakhir',value:null});
                                    parquery.push({name:'rekening',value:null});

                                    //                                    'tgl','off','201309','2013-09-26','2013-09-27','1110.10'
                                    if (!Ext.getCmp('gl_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('gl_thbl').getValue(),'Ym');
                                        if(Ext.getCmp('gl_thbl').getValue()!=glthbl){
                                            Ext.getCmp('gl_thbl').setValue(glthbl);
                                            parquery[2]['value']=  Ext.Date.format(glthbl,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('gl_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('gl_tgl_awal').getValue(), 'Y-m-d');
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('gl_tgl_akhir').getValue(), 'Y-m-d');
                                    }
                                    if (!Ext.getCmp('gl_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('gl_rekening').getValue();
                                        Ext.getCmp('grid1f').reconfigure(gl_store2,getColums_gl(2));
                                        //gl_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        Ext.getCmp('grid1f').reconfigure(gl_store1,getColums_gl(1));
                                        //gl_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                    var winprintgl=Ext.create('glprint_wind');
                                    winprintgl.show();
                                    Ext.getDom('glprint').src ='<?php echo base_url(); ?>' +'base_report/gl_pdf?query='+Ext.JSON.encode(parquery);
                                    //                                    window.open('<?php echo base_url(); ?>' +'base_report/gl_pdf?query='+Ext.JSON.encode(parquery));
                                }
                            },{xtype: 'button',
                                text: 'Preview PDF A3',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('gl_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('gl_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('gl_filter_tgl').collapsed){
                                        if (!Ext.getCmp('gl_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('gl_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('gl_filter_rekening').collapsed){
                                        if(!Ext.getCmp('gl_rekening').getValue()){
                                            set_message(1,'Rekening belum diisi!!');
                                            return;
                                        }
                                    }
                                    var parquery=new Array();
                                    parquery.push({name:'opt',value:null});
                                    parquery.push({name:'optrek',value:'off'});
                                    parquery.push({name:'thbl',value:null});
                                    parquery.push({name:'tglawal',value:null});
                                    parquery.push({name:'tglakhir',value:null});
                                    parquery.push({name:'rekening',value:null});

                                    //                                    'tgl','off','201309','2013-09-26','2013-09-27','1110.10'
                                    if (!Ext.getCmp('gl_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('gl_thbl').getValue(),'Ym');
                                        if(Ext.getCmp('gl_thbl').getValue()!=glthbl){
                                            Ext.getCmp('gl_thbl').setValue(glthbl);
                                            parquery[2]['value']=  Ext.Date.format(glthbl,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('gl_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('gl_tgl_awal').getValue(), 'Y-m-d');
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('gl_tgl_akhir').getValue(), 'Y-m-d');
                                    }
                                    if (!Ext.getCmp('gl_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('gl_rekening').getValue();
                                        Ext.getCmp('grid1f').reconfigure(gl_store2,getColums_gl(2));
                                        //gl_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        Ext.getCmp('grid1f').reconfigure(gl_store1,getColums_gl(1));
                                        //gl_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                    var winprintgl=Ext.create('glprint_wind');
                                    winprintgl.show();
                                    Ext.getDom('glprint').src ='<?php echo base_url(); ?>' +'base_report/gl_pdfA3?query='+Ext.JSON.encode(parquery);
                                    //                                    window.open('<?php echo base_url(); ?>' +'base_report/gl_pdf?query='+Ext.JSON.encode(parquery));
                                }
                            }
                        ]
                        ,features:[{
                                ftype: 'grouping',
                                //                                groupHeaderTpl: '{columnName}: {name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})',
                                groupHeaderTpl: '{columnName}: {name}',
                                hideGroupedHeader: true,
                                startCollapsed: false,
                                id: 'gl_grid_Grouping'
                            }]
                        ,viewConfig: {
                            //                        function(record, rowIndex, rowParams, store){
                            getRowClass: function(record, rowIndex, rp, ds){
                                //                                console.log('sampai sini')
                                if(record.get('keterangan').toLowerCase() == 'saldo awal' || record.get('keterangan').toLowerCase() == 'saldo akhir')
                                {
                                    //                                    console.log('sampai sini')
                                    return "x-grid-warna";
                                }
                               
                            }
                        }
                           
                                
                    }
                ]
            }
           
        ],
        listeners:{
            show:function(){
//                store_gl_akun.load();
//                Ext.getCmp('gl_rekening').getStore().reload();
                Ext.getCmp('gl_filter_tgl').collapse(true);
            }  
        },
        initComponent: function() {
            this.callParent(arguments);
        }
    });
    //    function rendererCol(val){
    //        if(val == 'SALDO AWAL'){
    //            return '<span style="color:green;">' + val + '%</span>';
    //        }
    //        return val;
    //    }    
    function getColums_gl(opt){
        if(opt==1){
            return    [
                {
                    text: 'Tanggal',
                    dataIndex: 'tanggal',
                    sortable: false,
                    width: 80
                }
                ,
                {
                    text: 'Rekening',
                    dataIndex: 'rekening',
                    sortable: false,
                    width: 80,hidden:true
                }
                //                , {
                //                    text: 'Nama Rekening',
                //                    dataIndex: 'nama_rekening',
                //                    sortable: false,
                //                    width: 120
                //                }
                , {
                    text: 'Keterangan',
                    dataIndex: 'keterangan',
                    sortable: false,
                    flex:1,
                    width: 100
                    
                }, {
                    text: 'Referensi',
                    dataIndex: 'referensi',
                    sortable: false,
                    width: 100
                }
                , {
                    xtype:'numbercolumn',
                    text: 'Debet',
                    dataIndex: 'debet',
                    sortable: false,
                    align:'right',
                    width: 100,
                    format:'0,0'
                }
                ,{
                    xtype:'numbercolumn',
                    text: 'Kredit',
                    dataIndex: 'kredit',
                    sortable: false,
                    align:'right',
                    width: 100
                    ,format:'0,0'
                },{
                    xtype:'numbercolumn',
                    text: 'Jumlah',
                    dataIndex: 'jumlah',
                    sortable: false,
                    align:'right',
                    width: 100,
                    format:'0,0'
                }
            ]
        }else{
            return [
                {
                    text: 'Tanggal',
                    dataIndex: 'tanggal',
                    sortable: false,
                    width: 80
                }, {
                    text: 'Keterangan',
                    dataIndex: 'keterangan',
                    sortable: false,
                    flex:1,
                    width: 100
                }, {
                    text: 'Referensi',
                    dataIndex: 'referensi',
                    sortable: false,
                    width: 100
                }
                , {
                    xtype:'numbercolumn',
                    text: 'Debet',
                    dataIndex: 'debet',
                    sortable: false,
                    align:'right',
                    width: 100,
                    format:'0,0'
                }
                ,{
                    xtype:'numbercolumn',
                    text: 'Kredit',
                    dataIndex: 'kredit',
                    sortable: false,
                    align:'right',
                    width: 100
                    ,format:'0,0'
                },{
                    xtype:'numbercolumn',
                    text: 'Jumlah',
                    dataIndex: 'jumlah',
                    sortable: false,
                    align:'right',
                    width: 100,
                    format:'0,0'
                }
            ]
        }
    }
</script>