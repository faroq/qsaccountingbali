
<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    var store_payable_akunfind = createStore(false,'store_payable_akunfind',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'payable_report/get_report_account');
    var payable_store1 = createStoreGroup(false,'mpayable_store1',['tanggal','rekening','keterangan','referensi','debet','kredit','jumlah'],'rekening','<?php echo base_url(); ?>' + 'payable_report/get_row_d');
    var payable_store2 = createStore(false,'mpayable_store2',['tanggal','keterangan','referensi','debet','kredit','jumlah'],'<?php echo base_url(); ?>' + 'payable_report/get_row_d');
    
    defineTwinAkun_windows('Window_payable_akunfind','window_payable_akunfind',store_payable_akunfind,
    function(){
        var sm = this.getSelectionModel();
        var sel = sm.getSelection();
        if (sel.length > 0) {				
            Ext.getCmp('payable_rekening').setValue(sel[0].get('rekening'));
            Ext.getCmp('id_nama_payable_rekening').setValue(sel[0].get('nama_rekening'));                    
            Ext.getCmp('window_payable_akunfind').close();
            //                                        Ext.getCmp('ej_grid_debet').focus();
        }
    }
);
    var pay_date=new Date();
    Ext.define('MyTabPayable', {
        extend: 'Ext.container.Container',
        xtype: 'TabPayable',
        alias: 'widget.TabPayable',
        title: 'Payable',
        id: 'tab1k2',
        closable: true,        
        layout: 'border',
        items: [
            {xtype: 'panel',
                autoShow: true,
                id: 'panelPayable',
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
                                id:'pay_filter_bulantahun',
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
                                        name: 'pay_thbl',                                        
                                        //                                        vtype:'daterange',
                                        //                                        startDateField:  'gl_tgl_awal',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tahun Bulan',
                                        anchor: '90%',
                                        format:'Y-F'
                                        ,id:'pay_thbl'
                                        ,listeners:{
                                            select:function(m, d){
                                                pay_date=d;      
                                                m.setValue(pay_date); 
                                            },
                                            change:function(m,n,o,opt){
                                                  m.setValue(pay_date); 
                                            },
                                            writeablechange:function( me, Read, eOpts ){                                                
                                                me.setValue(pay_date); 
                                            },
                                            dirtychange:function( me, isDirty, eOpts ){                                               
                                                me.setValue(pay_date); 
                                            }
                                          
                                        }
                                        //                                        ,maxValue:new Date()
                                    }
                                    
                                ],listeners:{
                                    collapse:function(){
                                        Ext.getCmp('pay_filter_tgl').expand(true);
                                    },
                                    expand:function(){
                                        if(!Ext.getCmp('pay_filter_tgl').collapsed){
                                            Ext.getCmp('pay_filter_tgl').collapse(true);
                                        }
                                    }
                                }
                            },
                            {
                                xtype:'fieldset',
                                id:'payable_filter_rekening',
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
                                                id:'payable_rekening',
                                                store:store_payable_akunfind,
                                                menu:'Window_payable_akunfind',
                                                width: 95,
                                                name: 'rekening',
                                                itemId: 'rekening',
                                                afterLabelTextTpl: required_css,//                        fieldLabel: 'First',
                                                allowBlank: false
                                            }, {
                                                flex: 1,
                                                itemId: 'nama_rekening',
                                                id:'id_nama_payable_rekening',
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
                                id:'pay_filter_tgl',
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
                                        endDateField: 'pay_tgl_akhir',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tanggal Awal',
                                        format:'Y-m-d',
                                        anchor: '90%'
                                        //                                        value:new Date()
                                        ,id:'pay_tgl_awal'
                                    },
                                    {
                                        xtype: 'datefield',
                                        name: 'tgl_Akhir',
                                        vtype:'daterange',
                                        startDateField:  'pay_tgl_awal',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tanggal Akhir',
                                        anchor: '90%',
                                        //                                        value:new Date(),
                                        format:'Y-m-d'
                                        ,id:'pay_tgl_akhir'
                                    }
                                ]
                                ,listeners:{
                                    collapse:function(){
                                        Ext.getCmp('pay_filter_bulantahun').expand(true);
                                    },
                                    expand:function(){
                                        if(!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                            Ext.getCmp('pay_filter_bulantahun').collapse(true);
                                        }
                                        
                                    }
                                }
                            }
                        ]
                    }
                ]
                
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
                        id:'gridpayable1f',
                        store: payable_store1,
                        columnLines:true,
                        //                        stripeRows: true,
                        //                        loadMask: true,
                        stateful:true,
                        stateId:'stateGridGLpay',
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
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('pay_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        if (!Ext.getCmp('pay_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('pay_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        if(!Ext.getCmp('payable_rekening').getValue()){
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
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('pay_thbl').getValue(),'Ym');                                       
                                        if(Ext.getCmp('pay_thbl').getValue()!=pay_date){
                                            Ext.getCmp('pay_thbl').setValue(pay_date);
                                            parquery[2]['value']=  Ext.Date.format(pay_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';                                        
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_awal').getValue(), 'Y-m-d');  
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_akhir').getValue(), 'Y-m-d');                                                                                 
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('payable_rekening').getValue();
                                        
                                        setDefaultStoreProxy(payable_store2,'<?php echo base_url(); ?>' + 'payable_report/get_row_d');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store2,getColums_payable(2));
                                        payable_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        setDefaultStoreProxy(payable_store1,'<?php echo base_url(); ?>' + 'payable_report/get_row_d');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store1,getColums_payable(1));
                                        payable_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Preview PDF',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('pay_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        if (!Ext.getCmp('pay_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('pay_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        if(!Ext.getCmp('payable_rekening').getValue()){
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
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('pay_thbl').getValue(),'Ym');                                       
                                        if(Ext.getCmp('pay_thbl').getValue()!=pay_date){
                                            Ext.getCmp('pay_thbl').setValue(pay_date);
                                            parquery[2]['value']=  Ext.Date.format(pay_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';                                        
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_awal').getValue(), 'Y-m-d');  
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_akhir').getValue(), 'Y-m-d');                                                                                 
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('payable_rekening').getValue();
                                        
//                                        setDefaultStoreProxy(payable_store2,'<?php echo base_url(); ?>' + 'payable_report/get_row_d');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store2,getColums_payable(2));
//                                        payable_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
//                                        setDefaultStoreProxy(payable_store1,'<?php echo base_url(); ?>' + 'payable_report/get_row_d');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store1,getColums_payable(1));
//                                        payable_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                    
                                    var winprintpayable=Ext.create('winprinttemp');
                                    winprintpayable.show();
                                    to_print('printoutpdf', 'payable_report/payable_d_pdfA3?query='+Ext.JSON.encode(parquery)); 
                                }
                            } 
                            // --------------------------REKAp pertanggal
                            ,{
                                xtype: 'button',
                                text: 'Rekap PerTanggal',
                                iconCls: 'icon-preview',
                                handler:function(){
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('pay_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        if (!Ext.getCmp('pay_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('pay_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        if(!Ext.getCmp('payable_rekening').getValue()){
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
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('pay_thbl').getValue(),'Ym');                                       
                                        if(Ext.getCmp('pay_thbl').getValue()!=pay_date){
                                            Ext.getCmp('pay_thbl').setValue(pay_date);
                                            parquery[2]['value']=  Ext.Date.format(pay_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';                                        
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_awal').getValue(), 'Y-m-d');  
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_akhir').getValue(), 'Y-m-d');                                                                                 
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('payable_rekening').getValue();
                                        
                                        setDefaultStoreProxy(payable_store2,'<?php echo base_url(); ?>' + 'payable_report/get_row_tgl');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store2,getColums_payable(2));
                                        payable_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        setDefaultStoreProxy(payable_store1,'<?php echo base_url(); ?>' + 'payable_report/get_row_tgl');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store1,getColums_payable(1));
                                        payable_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Rekap PerTanggal PDF',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('pay_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        if (!Ext.getCmp('pay_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('pay_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        if(!Ext.getCmp('payable_rekening').getValue()){
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
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('pay_thbl').getValue(),'Ym');                                       
                                        if(Ext.getCmp('pay_thbl').getValue()!=pay_date){
                                            Ext.getCmp('pay_thbl').setValue(pay_date);
                                            parquery[2]['value']=  Ext.Date.format(pay_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';                                        
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_awal').getValue(), 'Y-m-d');  
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_akhir').getValue(), 'Y-m-d');                                                                                 
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('payable_rekening').getValue();
                                        
//                                        setDefaultStoreProxy(payable_store2,'<?php echo base_url(); ?>' + 'payable_report/get_row_d');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store2,getColums_payable(2));
//                                        payable_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
//                                        setDefaultStoreProxy(payable_store1,'<?php echo base_url(); ?>' + 'payable_report/get_row_d');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store1,getColums_payable(1));
//                                        payable_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                    
                                    var winprintpayable=Ext.create('winprinttemp');
                                    winprintpayable.show();
                                    to_print('printoutpdf', 'payable_report/payable_tgl_pdfA3?query='+Ext.JSON.encode(parquery)); 
                                }
                            }
                            // ---------------------- rekap perrekening
                            ,{
                                xtype: 'button',
                                text: 'Rekap PerRekening',
                                iconCls: 'icon-preview',
                                handler:function(){
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('pay_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        if (!Ext.getCmp('pay_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('pay_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        if(!Ext.getCmp('payable_rekening').getValue()){
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
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('pay_thbl').getValue(),'Ym');                                       
                                        if(Ext.getCmp('pay_thbl').getValue()!=pay_date){
                                            Ext.getCmp('pay_thbl').setValue(pay_date);
                                            parquery[2]['value']=  Ext.Date.format(pay_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';                                        
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_awal').getValue(), 'Y-m-d');  
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_akhir').getValue(), 'Y-m-d');                                                                                 
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('payable_rekening').getValue();
                                        
                                        setDefaultStoreProxy(payable_store2,'<?php echo base_url(); ?>' + 'payable_report/get_row_rek');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store2,getColums_payable(2));
                                        payable_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        setDefaultStoreProxy(payable_store1,'<?php echo base_url(); ?>' + 'payable_report/get_row_rek');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store1,getColums_payable(1));
                                        payable_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Rekap PerRekening PDF',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        if (!Ext.getCmp('pay_thbl').getValue()){
                                            set_message(1,'Tahun Bulan belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        if (!Ext.getCmp('pay_tgl_awal').getValue()){
                                            set_message(1,'Tanggal Awal belum diisi!!');
                                            return;
                                        }
                                        if (!Ext.getCmp('pay_tgl_akhir').getValue()){
                                            set_message(1,'Tanggal Akhir belum diisi!!');
                                            return;
                                        }
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        if(!Ext.getCmp('payable_rekening').getValue()){
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
                                    if (!Ext.getCmp('pay_filter_bulantahun').collapsed){
                                        parquery[0]['value']='bln';
                                        parquery[2]['value']=Ext.Date.format(Ext.getCmp('pay_thbl').getValue(),'Ym');                                       
                                        if(Ext.getCmp('pay_thbl').getValue()!=pay_date){
                                            Ext.getCmp('pay_thbl').setValue(pay_date);
                                            parquery[2]['value']=  Ext.Date.format(pay_date,'Ym');
                                          }
                                    }
                                    if (!Ext.getCmp('pay_filter_tgl').collapsed){
                                        parquery[0]['value']='tgl';                                        
                                        parquery[3]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_awal').getValue(), 'Y-m-d');  
                                        parquery[4]['value']=Ext.Date.format(Ext.getCmp('pay_tgl_akhir').getValue(), 'Y-m-d');                                                                                 
                                    }
                                    if (!Ext.getCmp('payable_filter_rekening').collapsed){
                                        parquery[1]['value']='on';
                                        parquery[5]['value']=Ext.getCmp('payable_rekening').getValue();
                                        
//                                        setDefaultStoreProxy(payable_store2,'<?php echo base_url(); ?>' + 'payable_report/get_row_d');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store2,getColums_payable(2));
//                                        payable_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
//                                        setDefaultStoreProxy(payable_store1,'<?php echo base_url(); ?>' + 'payable_report/get_row_d');
                                        Ext.getCmp('gridpayable1f').reconfigure(payable_store1,getColums_payable(1));
//                                        payable_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                    
                                    var winprintpayable=Ext.create('winprinttemp');
                                    winprintpayable.show();
                                    to_print('printoutpdf', 'payable_report/payable_rek_pdfA3?query='+Ext.JSON.encode(parquery)); 
                                }
                            }
                        ]
                        ,features:[{
                                ftype: 'grouping',
                                //                                groupHeaderTpl: '{columnName}: {name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})',
                                groupHeaderTpl: '{columnName}: {name}',
                                hideGroupedHeader: true,
                                startCollapsed: false,
                                id: 'payable_grid_Grouping'
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
                Ext.getCmp('pay_filter_tgl').collapse(true);
            }  
        },
        initComponent: function() {
            this.callParent(arguments);
        }});
    
    function getColums_payable(opt){
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

