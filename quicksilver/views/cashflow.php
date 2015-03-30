<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    var periode_store = createStore(false,'periode_store',['id','default'],'<?php echo base_url(); ?>' + 'global_reference/get_periode');
    //    var cashflow_store1 = createStoreGroup(false,'mcashflow_store1',['recgroup','groupname','nomor','keterangan','jan','feb','mar','apr','mei','jun'],'groupname','<?php echo base_url(); ?>' + 'cashflow_report/get_row');
    //    var cashflow_store2 = createStoreGroup(false,'mcashflow_store2',['recgroup','groupname','nomor','keterangan','jul','agust','sept','okt','nov','des'],'groupname','<?php echo base_url(); ?>' + 'cashflow_report/get_row');
    var cashflow_store1 = createStore(false,'mcashflow_store1',['recgroup','groupname','nomor','keterangan','jan','feb','mar','apr','mei','jun'],'<?php echo base_url(); ?>' + 'cashflow_report/get_row');
    var cashflow_store2 = createStore(false,'mcashflow_store2',['recgroup','groupname','nomor','keterangan','jul','agust','sept','okt','nov','des'],'<?php echo base_url(); ?>' + 'cashflow_report/get_row');
        
    var cflow_date=new Date();
    
    
    Ext.define('MyTabCashFlow', {
        extend: 'Ext.container.Container',
        xtype: 'TabCashFlow',
        alias: 'widget.TabCashFlow',
        title: 'Cash Flow',
        id: 'tab1k3',
        closable: true,        
        layout: 'border',
        items: [
            {xtype: 'panel',
                autoShow: true,
                id: 'panelcashflow',
                region: 'north',
                margins: '5 5 5 5',
                layout: 'column',
                items:[
                    {
                        xtype: 'form',
                        columnWidth: .3,
                        layout: 'form',
                        border: false,
                        labelWidth: 80,
                        bodyPadding: '5 5 5 5',
                        defaults: { labelSeparator: ''}
                        ,items :[{
                                xtype: 'datefield',
                                name: 'tahun',                                        
                                afterLabelTextTpl: required_css,
                                fieldLabel: 'Tahun Periode',
                                format:'Y',
                                anchor: '50%'
                                //                                        value:new Date()
                                ,id:'cflow_tahun'
                            },{
                                xtype: 'combo',
                                tooltip: 'Field tidak boleh kosong',
                                afterLabelTextTpl: required_css,
                                fieldLabel: 'Periode',
                                id: 'cflow_periode',
                                name: 'periode',
                                store: periode_store,
                                valueField: 'default',
                                displayField: 'default',
                                typeAhead: true,
                                triggerAction: 'all',
                                allowBlank: false,
                                editable: false,
                                anchor: '50%',
                                hiddenName: 'periode'                    
                                ,width: 50
                            }
                            
                                
                        
                        ]
                    }
                    
                ]
                
            }
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
                        id:'gridcashflow1f',
                        store: cashflow_store1,
                        columnLines:true,
                        //                        stripeRows: true,
                        //                        loadMask: true,
                        stateful:true,
                        stateId:'stateGridcflow',
                        columns:[
                            {
                                text: 'Rec Group',
                                dataIndex: 'recgroup',
                                sortable: false,
                                //                                flex:1,
                                width: 70,hidden:true
                            }
                            ,
                            {
                                text: 'Group Name',
                                dataIndex: 'groupname',
                                sortable: false,
                                //                                flex:1,
                                width: 80,hidden:true
                            }
                            , 
                            {
                                text: 'Nomor',
                                dataIndex: 'nomor',
                                sortable: false,
                                //                                flex:1,
                                width: 120,hidden:true
                            }, {
                                text: 'Keterangan',
                                dataIndex: 'keterangan',
                                sortable: false,
                                flex:1,
                                width: 100
                            }, {
                                xtype:'numbercolumn',
                                text: 'Januari',
                                dataIndex: 'jan',
                                sortable: false,
                                align:'right',
                                //                                flex:1,
                                width: 100,
                                format:'0,0'
                            }
                            , {
                                xtype:'numbercolumn',
                                text: 'Februari',
                                dataIndex: 'feb',
                                sortable: false,
                                align:'right',
                                //                                flex:1,
                                width: 100,
                                format:'0,0'
                            }
                            ,{
                                xtype:'numbercolumn',
                                text: 'Maret',
                                dataIndex: 'mar',
                                sortable: false,
                                align:'right',
                                //                                flex:1,
                                width: 100
                                ,format:'0,0'
                            },{
                                xtype:'numbercolumn',
                                text: 'April',
                                dataIndex: 'apr',
                                sortable: false,
                                align:'right',
                                //                                flex:1,
                                width: 100,
                                format:'0,0'
                            },{
                                xtype:'numbercolumn',
                                text: 'Mei',
                                dataIndex: 'mei',
                                sortable: false,
                                align:'right',
                                //                                flex:1,
                                width: 100
                                ,format:'0,0'
                            },{
                                xtype:'numbercolumn',
                                text: 'Juni',
                                dataIndex: 'jun',
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
                                    if (!Ext.getCmp('cflow_tahun').getValue()){
                                        set_message(1,'Tahun Periode Belum Diisi!!');
                                        return;
                                    }
                                    if (!Ext.getCmp('cflow_periode').getValue()){
                                        set_message(1,'Periode belum diisi!!');
                                        return;
                                    }               
                                    var parquery=new Array();
                                    
                                    parquery.push({name:'tahun',value:Ext.getCmp('cflow_tahun').getValue().getFullYear()});
                                    parquery.push({name:'periode',value:Ext.getCmp('cflow_periode').getValue()});
                                                                        
                                    if(Ext.getCmp('cflow_periode').getValue()=='PERIODE I'){
                                        Ext.getCmp('gridcashflow1f').reconfigure(cashflow_store1,getColums_cashflow(1));
                                        cashflow_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        Ext.getCmp('gridcashflow1f').reconfigure(cashflow_store2,getColums_cashflow(2));
                                        cashflow_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                        
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Preview PDF',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    
                                    if (!Ext.getCmp('cflow_tahun').getValue()){
                                        set_message(1,'Tahun Periode Belum Diisi!!');
                                        return;
                                    }
                                    if (!Ext.getCmp('cflow_periode').getValue()){
                                        set_message(1,'Periode belum diisi!!');
                                        return;
                                    }               
                                    var parquery=new Array();
                                    
                                    parquery.push({name:'tahun',value:Ext.getCmp('cflow_tahun').getValue().getFullYear()});
                                    parquery.push({name:'periode',value:Ext.getCmp('cflow_periode').getValue()});
                                                                        
                                    if(Ext.getCmp('cflow_periode').getValue()=='PERIODE I'){
                                        Ext.getCmp('gridcashflow1f').reconfigure(cashflow_store1,getColums_cashflow(1));
//                                        cashflow_store1.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }else{
                                        Ext.getCmp('gridcashflow1f').reconfigure(cashflow_store2,getColums_cashflow(2));
//                                        cashflow_store2.load({params:{query:Ext.JSON.encode(parquery)}});
                                    }
                                    var winprintcashflow=Ext.create('winprinttemp');
                                    winprintcashflow.show();
                                    to_print('printoutpdf', 'cashflow_report/cashflow_pdf?query='+Ext.JSON.encode(parquery)); 
                                }
                            } 
                          
                        ]
                        ,features:[{
                                ftype: 'grouping',
                                //                                groupHeaderTpl: '{columnName}: {name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})',
                                groupHeaderTpl: '{columnName}: {name}',
                                hideGroupedHeader: true,
                                startCollapsed: false,
                                id: 'cashflow_grid_Grouping'
                            }]
                        ,viewConfig: {
                            //                        function(record, rowIndex, rowParams, store){
                            getRowClass: function(record, rowIndex, rp, ds){
                                //                                console.log('sampai sini')
                                if(record.get('keterangan').toLowerCase() == 'saldo awal' || record.get('keterangan').toLowerCase() == 'saldo akhir' 
                                    || record.get('keterangan').toLowerCase() == 'laba/rugi periode berjalan' || 
                                    record.get('keterangan').toLowerCase() == 'mutasi ( + )' || record.get('keterangan').toLowerCase() == 'mutasi ( - )' || 
                                    record.get('keterangan').toLowerCase() == 'total mutasi ( + )' || 
                                    record.get('keterangan').toLowerCase() == 'total mutasi ( - )') 
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
                //                Ext.getCmp('cflow_filter_tgl').collapse(true);
            }  
        },
        initComponent: function() {
            this.callParent(arguments);
        }});
    function getColums_cashflow(opt){
        if(opt==1){
            return    [
                {
                    text: 'Rec Group',
                    dataIndex: 'recgroup',
                    sortable: false,
                    //                                flex:1,
                    width: 70,hidden:true
                }
                ,
                {
                    text: 'Group Name',
                    dataIndex: 'groupname',
                    sortable: false,
                    //                                flex:1,
                    width: 80,hidden:true
                }
                , {
                    text: 'Nomor',
                    dataIndex: 'nomor',
                    sortable: false,
                    //                                flex:1,
                    width: 120,hidden:true
                }, {
                    text: 'Keterangan',
                    dataIndex: 'keterangan',
                    sortable: false,
                    flex:1,
                    width: 100
                }, {
                    xtype:'numbercolumn',
                    text: 'Januari',
                    dataIndex: 'jan',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100,
                    format:'0,0'
                }
                , {
                    xtype:'numbercolumn',
                    text: 'Februari',
                    dataIndex: 'feb',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100,
                    format:'0,0'
                }
                ,{
                    xtype:'numbercolumn',
                    text: 'Maret',
                    dataIndex: 'mar',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100
                    ,format:'0,0'
                },{
                    xtype:'numbercolumn',
                    text: 'April',
                    dataIndex: 'apr',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100,
                    format:'0,0'
                },{
                    xtype:'numbercolumn',
                    text: 'Mei',
                    dataIndex: 'mei',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100
                    ,format:'0,0'
                },{
                    xtype:'numbercolumn',
                    text: 'Juni',
                    dataIndex: 'jun',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100,
                    format:'0,0'
                }
            ]
        }else{
            return [
                {
                    text: 'Rec Group',
                    dataIndex: 'recgroup',
                    sortable: false,
                    //                                flex:1,
                    width: 70,hidden:true
                }
                ,
                {
                    text: 'Group Name',
                    dataIndex: 'groupname',
                    sortable: false,
                    //                                flex:1,
                    width: 80,hidden:true
                }
                , {
                    text: 'Nomor',
                    dataIndex: 'nomor',
                    sortable: false,
                    //                                flex:1,
                    width: 120,hidden:true
                }, {
                    text: 'Keterangan',
                    dataIndex: 'keterangan',
                    sortable: false,
                    flex:1,
                    width: 100
                }, {
                    xtype:'numbercolumn',
                    text: 'Juli',
                    dataIndex: 'jul',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100,
                    format:'0,0'
                }
                , {
                    xtype:'numbercolumn',
                    text: 'Agustus',
                    dataIndex: 'agust',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100,
                    format:'0,0'
                }
                ,{
                    xtype:'numbercolumn',
                    text: 'September',
                    dataIndex: 'sept',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100
                    ,format:'0,0'
                },{
                    xtype:'numbercolumn',
                    text: 'Oktober',
                    dataIndex: 'okt',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100,
                    format:'0,0'
                },{
                    xtype:'numbercolumn',
                    text: 'November',
                    dataIndex: 'nov',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100
                    ,format:'0,0'
                },{
                    xtype:'numbercolumn',
                    text: 'Desember',
                    dataIndex: 'des',
                    sortable: false,
                    align:'right',
                    //                                flex:1,
                    width: 100,
                    format:'0,0'
                }
            ]
        }
    }
</script>
