<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    var store_gl_akun = createStore(true,'makun_gl_Store',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');
    //    var gl_store1 = createStore(false,'mgl_Store1',['tanggal','rekening','nama_rekening','keterangan','referensi','debet','kredit','jumlah'],'<?php echo base_url(); ?>' + 'base_report/get_row_gl');
    var gl_store1 = createStoreGroup(false,'mgl_Store1',['tanggal','rekening','keterangan','referensi','debet','kredit','jumlah'],'rekening','<?php echo base_url(); ?>' + 'base_report/get_row_gl');
    var gl_store2 = createStore(false,'mgl_Store2',['tanggal','keterangan','referensi','debet','kredit','jumlah'],'<?php echo base_url(); ?>' + 'base_report/get_row_gl');
   
    Ext.define('MyTabGeneralLedger', {
        extend: 'Ext.container.Container',
        xtype: 'TabGeneralLedger',
        alias: 'widget.TabGeneralLedger',
        title: 'General Ledger',
        id: 'tab1f',
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
                                        ,id:'gl_thbl'
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
                            },{
                                xtype:'fieldset',
                                id:'gl_filter_rekening',
                                checkboxToggle:true,
                                title: 'Filter Rekening',
                                defaultType: 'datefield',
                                collapsed: true,
                                layout: 'anchor',
                                defaults: {
                                    anchor: '100%'
                                },
                                items:[{
                                        xtype: 'combo',                        
                                        //                    tooltip: 'Field tidak boleh kosong',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Rekening',                        
                                        id: 'gl_rekening',
                                        store: store_gl_akun,
                                        valueField: 'rekening',
                                        displayField: 'nama_rekening',
                                        typeAhead: true,
                                        triggerAction: 'all',                    
                                        // allowBlank: false,
                                        editable: false,
                                        anchor: '90%',
                                        hiddenName: 'rekening',
                                        emptyText: 'Pilih Rekening'
                    
                                    }]}
                                
                        
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
                        stateId:'stateGrid',
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
                                
                            }]
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
                Ext.getCmp('gl_rekening').getStore().reload();
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