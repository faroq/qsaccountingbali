
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    
    var store_glreceiv_akunfind = createStore(false,'store_glreceiv_akunfind',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'receivable_report/get_report_account');
    var glreceiv_store1 = createStoreGroup(false,'mglreceiv_Store1',['tanggal','rekening','keterangan','referensi','debet','kredit','jumlah'],'rekening','<?php echo base_url(); ?>' + 'receivable_report/get_row_d');
    var glreceiv_store2 = createStore(false,'mglreceiv_Store2',['tanggal','keterangan','referensi','debet','kredit','jumlah'],'<?php echo base_url(); ?>' + 'receivable_report/get_row_d');
        
    defineTwinAkun_windows('Window_glreceiv_akunfind','window_glreceiv_akunfind',store_glreceiv_akunfind,
    function(){
        var sm = this.getSelectionModel();
        var sel = sm.getSelection();
        if (sel.length > 0) {				
            Ext.getCmp('glreceiv_rekening').setValue(sel[0].get('rekening'));
            Ext.getCmp('id_nama_glreceiv_rekening').setValue(sel[0].get('nama_rekening'));                    
            Ext.getCmp('window_glreceiv_akunfind').close();
            //                                        Ext.getCmp('ej_grid_debet').focus();
        }
    }
);
    var rv_date=new Date();
    var app_date=new Date();
    Ext.define('MyTabReceivable', {
        extend: 'Ext.container.Container',
        xtype: 'TabReceivable',
        alias: 'widget.TabReceivable',
        title: 'Receivable',
        id: 'tab1k1',
        closable: true,        
        layout: 'border',
        items: [
            {xtype: 'panel',
                autoShow: true,
                id: 'panelReceivable',
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
                                id:'rv_filter_bulantahun',
                                checkboxToggle:true,
                                title: 'Filter Year Month',
                                defaultType: 'textfield',
                                collapsed: false,
                                layout: 'anchor',
                                width:390,
                                defaults: {
                                    anchor: '100%'
                                },
                                items :[
                                    {
                                        xtype: 'monthfield',
                                        name: 'rv_thbl',                                        
                                        //                                        vtype:'daterange',
                                        //                                        startDateField:  'gl_tgl_awal',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tahun Bulan',
                                        anchor: '90%',
                                        format:'Y-F'
                                        ,id:'rv_thbl'
//                                       ,maxValue :new Date(app_date.getFullYear(),app_date.getMonth(),1)                                        
                                        ,listeners:{
                                            select:function(m, d){
                                                rv_date=d;      
                                                m.setValue(rv_date); 
                                            },
                                            change:function(m,n,o,opt){
//                                                m.setValue(new Date(n.getFullYear(),n.getMonth(),1));
//                                                console.log(n);
                                                  m.setValue(rv_date); 
                                            },
                                            writeablechange:function( me, Read, eOpts ){                                                
                                                me.setValue(rv_date); 
                                            },
                                            dirtychange:function( me, isDirty, eOpts ){                                               
                                                me.setValue(rv_date); 
                                            }
                                          
                                        }
                                        //                                        ,maxValue:new Date()
                                    },
                                    
                                    
                                ],listeners:{
                                    collapse:function(){
                                        Ext.getCmp('rv_filter_tgl').expand(true);
                                    },
                                    expand:function(){
                                        if(!Ext.getCmp('rv_filter_tgl').collapsed){
                                            Ext.getCmp('rv_filter_tgl').collapse(true);
                                        }
                                    }
                                }
                            }
                            ,
                            {
                                xtype:'fieldset',
                                id:'glreceiv_filter_rekening',
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
                                                id:'glreceiv_rekening',
                                                store:store_glreceiv_akunfind,
                                                menu:'Window_glreceiv_akunfind',
                                                width: 95,
                                                name: 'rekening',
                                                itemId: 'rekening',
                                                afterLabelTextTpl: required_css,//                        fieldLabel: 'First',
                                                allowBlank: false
                                            }, {
                                                flex: 1,
                                                itemId: 'nama_rekening',
                                                id:'id_nama_glreceiv_rekening',
                                                name: 'nama_rekening',
                                                readOnly:true

                                            }
                                        ]
                                    }

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
                                id:'rv_filter_tgl',
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
                                        endDateField: 'rv_tgl_akhir',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tanggal Awal',
                                        format:'Y-m-d',
                                        anchor: '90%'
                                        //                                        value:new Date()
                                        ,id:'rv_tgl_awal'
                                    },
                                    {
                                        xtype: 'datefield',
                                        name: 'tgl_Akhir',
                                        vtype:'daterange',
                                        startDateField:  'rv_tgl_awal',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tanggal Akhir',
                                        anchor: '90%',
                                        //                                        value:new Date(),
                                        format:'Y-m-d'
                                        ,id:'rv_tgl_akhir'
                                    }
                                ]
                                ,listeners:{
                                    collapse:function(){
                                        Ext.getCmp('rv_filter_bulantahun').expand(true);
                                    },
                                    expand:function(){
                                        if(!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                            Ext.getCmp('rv_filter_bulantahun').collapse(true);
                                        }
                                        
                                    }
                                }
                            }
                        ]
                    }
                ],listeners:{
                change:function(){
                Ext.getCmp('rv_thbl').setValue(rv_date);
                }
                }
                
            },
            ,{
                xtype: 'panel',
                autoShow: true,
                //                id: 'gridGeneralLedger',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'gridreceiv1f',
                        store: glreceiv_store1,
                        columnLines:true,
                        //                        stripeRows: true,
                        //                        loadMask: true,
                        stateful:true,
                        stateId:'stateGridGLRECEIV',
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
                        ]
                        ,tbar:[
                            {
                                xtype: 'button',
                                text: 'Load Data',
                                iconCls: 'icon-preview',
                                handler:function(){
                                    
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('rv_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        if (!Ext.getCmp('rv_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('rv_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        if(!Ext.getCmp('glreceiv_rekening').getValue()){
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
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('rv_thbl').getValue(),'Ym');                                       
//                                        console.log(rv_date);
//                                        console.log(Ext.getCmp('rv_thbl').getValue())
                                        if(Ext.getCmp('rv_thbl').getValue()!=rv_date){
                                            Ext.getCmp('rv_thbl').setValue(rv_date);
                                            parquery[2]['value']=  Ext.Date.format(rv_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';                                        
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_awal').getValue(), 'Y-m-d');  
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_akhir').getValue(), 'Y-m-d');                                                                                 
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('glreceiv_rekening').getValue(); 
                                        setDefaultStoreProxy(glreceiv_store2,'<?php echo base_url(); ?>' + 'receivable_report/get_row_d');
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store2,getColums_glreceiv(2));
                                        glreceiv_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        setDefaultStoreProxy(glreceiv_store1,'<?php echo base_url(); ?>' + 'receivable_report/get_row_d');
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store1,getColums_glreceiv(1));
                                        glreceiv_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Preview PDF A3',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('rv_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        if (!Ext.getCmp('rv_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('rv_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        if(!Ext.getCmp('glreceiv_rekening').getValue()){
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
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('rv_thbl').getValue(),'Ym');
                                         if(Ext.getCmp('rv_thbl').getValue()!=rv_date){
                                            Ext.getCmp('rv_thbl').setValue(rv_date);
                                            parquery[2]['value']=  Ext.Date.format(rv_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_awal').getValue(), 'Y-m-d');
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_akhir').getValue(), 'Y-m-d');
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('glreceiv_rekening').getValue();
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store2,getColums_gl(2));
                                        //gl_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store1,getColums_gl(1));
                                        //gl_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                    
                                    var winprintreceivable=Ext.create('winprinttemp');
                                    winprintreceivable.show();
                                    to_print('printoutpdf', 'receivable_report/receivable_d_pdfA3?query='+Ext.JSON.encode(parquery)); 
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Rekap PerTanggal',
                                iconCls: 'icon-preview',
                                handler:function(){
                                    
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('rv_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        if (!Ext.getCmp('rv_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('rv_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        if(!Ext.getCmp('glreceiv_rekening').getValue()){
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
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('rv_thbl').getValue(),'Ym');                                       
//                                        console.log(rv_date);
//                                        console.log(Ext.getCmp('rv_thbl').getValue())
                                        if(Ext.getCmp('rv_thbl').getValue()!=rv_date){
                                            Ext.getCmp('rv_thbl').setValue(rv_date);
                                            parquery[2]['value']=  Ext.Date.format(rv_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';                                        
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_awal').getValue(), 'Y-m-d');  
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_akhir').getValue(), 'Y-m-d');                                                                                 
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('glreceiv_rekening').getValue(); 
                                        setDefaultStoreProxy(glreceiv_store2,'<?php echo base_url(); ?>' + 'receivable_report/get_row_tgl');
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store2,getColums_glreceiv(2));
                                        glreceiv_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        setDefaultStoreProxy(glreceiv_store1,'<?php echo base_url(); ?>' + 'receivable_report/get_row_tgl');
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store1,getColums_glreceiv(1));
                                        glreceiv_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Rekap PerTanggal PDF A3',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('rv_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        if (!Ext.getCmp('rv_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('rv_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        if(!Ext.getCmp('glreceiv_rekening').getValue()){
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
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('rv_thbl').getValue(),'Ym');
                                         if(Ext.getCmp('rv_thbl').getValue()!=rv_date){
                                            Ext.getCmp('rv_thbl').setValue(rv_date);
                                            parquery[2]['value']=  Ext.Date.format(rv_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_awal').getValue(), 'Y-m-d');
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_akhir').getValue(), 'Y-m-d');
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('glreceiv_rekening').getValue();
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store2,getColums_gl(2));
                                        //gl_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store1,getColums_gl(1));
                                        //gl_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                    
                                    var winprintreceivable=Ext.create('winprinttemp');
                                    winprintreceivable.show();
                                    to_print('printoutpdf', 'receivable_report/receivable_tgl_pdfA3?query='+Ext.JSON.encode(parquery)); 
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Rekap PerRekening',
                                iconCls: 'icon-preview',
                                handler:function(){
                                    
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('rv_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        if (!Ext.getCmp('rv_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('rv_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        if(!Ext.getCmp('glreceiv_rekening').getValue()){
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
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('rv_thbl').getValue(),'Ym');                                       
//                                        console.log(rv_date);
//                                        console.log(Ext.getCmp('rv_thbl').getValue())
                                        if(Ext.getCmp('rv_thbl').getValue()!=rv_date){
                                            Ext.getCmp('rv_thbl').setValue(rv_date);
                                            parquery[2]['value']=  Ext.Date.format(rv_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';                                        
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_awal').getValue(), 'Y-m-d');  
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_akhir').getValue(), 'Y-m-d');                                                                                 
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('glreceiv_rekening').getValue(); 
                                        setDefaultStoreProxy(glreceiv_store2,'<?php echo base_url(); ?>' + 'receivable_report/get_row_rek');
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store2,getColums_glreceiv(2));
                                        glreceiv_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        setDefaultStoreProxy(glreceiv_store1,'<?php echo base_url(); ?>' + 'receivable_report/get_row_rek');
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store1,getColums_glreceiv(1));
                                        glreceiv_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Rekap PerRekening PDF A3',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('rv_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        if (!Ext.getCmp('rv_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('rv_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        if(!Ext.getCmp('glreceiv_rekening').getValue()){
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
                                    if (!Ext.getCmp('rv_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('rv_thbl').getValue(),'Ym');
                                         if(Ext.getCmp('rv_thbl').getValue()!=rv_date){
                                            Ext.getCmp('rv_thbl').setValue(rv_date);
                                            parquery[2]['value']=  Ext.Date.format(rv_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('rv_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_awal').getValue(), 'Y-m-d');
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('rv_tgl_akhir').getValue(), 'Y-m-d');
                                    }
                                    if (!Ext.getCmp('glreceiv_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('glreceiv_rekening').getValue();
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store2,getColums_gl(2));
                                        //gl_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        Ext.getCmp('gridreceiv1f').reconfigure(glreceiv_store1,getColums_gl(1));
                                        //gl_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                    
                                    var winprintreceivable=Ext.create('winprinttemp');
                                    winprintreceivable.show();
                                    to_print('printoutpdf', 'receivable_report/receivable_rek_pdfA3?query='+Ext.JSON.encode(parquery)); 
                                }
                            }
                        ]
                        ,features:[{
                                ftype: 'grouping',
                                //                                groupHeaderTpl: '{columnName}: {name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})',
                                groupHeaderTpl: '{columnName}: {name}',
                                hideGroupedHeader: true,
                                startCollapsed: false,
                                id: 'glreceiv_grid_Grouping'
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
                Ext.getCmp('rv_filter_tgl').collapse(true);
//                this.setMaxValue( new Date(app_date.getFullYear(),app_date.getMonth(),1) ); 
//                var m=new Date();
//                Ext.getCmp('rv_thbl').setMaxValue(new Date(m.getFullYear(), m.getMonth(), 28));
            }  
        },
        initComponent: function() {
            this.callParent(arguments);
        }});
    
    function getColums_glreceiv(opt){
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

