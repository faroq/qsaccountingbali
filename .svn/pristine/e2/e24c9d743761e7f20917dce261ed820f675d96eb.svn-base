<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript"> 
    
    var journalMonitor_store = createStore(false,'jmon_store',['id_jurnal','nomor_jurnal','tgl_jurnal',{name: 'referensi', type: 'string'},'keterangan','transaksi_cd','rekening','nama_rekening','debet','kredit','kode_posting','jurnal_by','jurnal_date','update_date'],'<?php echo base_url(); ?>' + 'jurnal_monitor/get_row_monitor');
    //    var jmon_account_store = createStore(true,'jmon_account_store',['rekening','nama_rekening'],'<?php echo base_url(); ?>' + 'masteraccount/get_rows');

  
    Ext.define('MyTabJournalMonitor',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabJournalMonitor',
        alias: 'widget.JournalMonitor',
        title: 'Journal Monitor',
        id: 'tab1f',
        closable: true,  
        layout: 'border',
        items: 
            [
            /*bos panel filter*/
            {
                xtype: 'panel',
                autoShow: true,
                id: 'panelfiltermonitor',
                region: 'north',
                margins: '5 5 5 5',
                layout: 'column',                
                items:
                    [
                    {
                        xtype: 'form',
                        columnWidth: .4,
                        layout: 'form',
                        border: false,
                        labelWidth: 80,
                        bodyPadding: '5 5 5 5',
                        defaults: { labelSeparator: ''},
                        items :[
                            {
                                xtype:'fieldset',
                                id:'jmon_tgl',
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
                                        endDateField: 'jmon_tgl_akhir',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tanggal Awal',
                                        format:'Y-m-d',
                                        anchor: '90%'
                                        ,id:'jmon_tgl_awal'
                                    },
                                    {
                                        xtype: 'datefield',
                                        name: 'tgl_Akhir',
                                        vtype:'daterange',
                                        startDateField:  'jmon_tgl_awal',
                                        afterLabelTextTpl: required_css,
                                        fieldLabel: 'Tanggal Akhir',
                                        anchor: '90%',
                                        format:'Y-m-d'
                                        ,id:'jmon_tgl_akhir'
                                    }]
                            
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
                        defaults: { labelSeparator: ''},
                        items :[
                            {
                                xtype:'fieldset'
                                ,id:'jmon_filter'
                                ,checkboxToggle:true,
                                title: 'Filter Referensi/Keterangan/Rekening',
                                defaultType: 'textfield',
                                collapsed: false,                                
                                layout: 'anchor',
                                defaults: {
                                    anchor: '100%'
                                },
                                items :[{
                                        xtype: 'radiogroup',
                                        fieldLabel: 'Filter By',
                                        //            cls: 'x-check-group-alt',
                                        items: [
                                            {boxLabel: 'Referensi', name: 'rbfilter', inputValue: 1},
                                            {boxLabel: 'Keterangan', name: 'rbfilter', inputValue: 2, checked: true},
                                            {boxLabel: 'Rekening', name: 'rbfilter', inputValue: 3},
                
                                        ],id:'jmon_filter_by'
                                    },{
                                        xtype:'textfield',
                                        fieldLabel: 'Filter Value',
                                        //                                        afterLabelTextTpl: required_css,
                                        name: 'last'
                                        ,id:'jmon_filter_value'
                                    }]
                            }
                        ]
                    }
                ]
            },
            /*eos panel filter*/

            /*bos panel grid*/
            {
                xtype: 'panel',
                autoShow: true,
                id: 'JournalMonitor_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'gridexporter',
                        id:'jmon_grid',
                        stateful:true,
                        stateId:'stateGridJMON',
                        store: journalMonitor_store,//Ext.data.StoreManager.lookup('JournalMonitor_store'),
                        stripeRows: true,
                        loadMask: true,                                                
                        columns:
                            [
                            {
                                header: "ID Jurnal",
                                dataIndex: 'id_jurnal',
                                sortable: true,
                                width: 70,
                                hidden:true
                            },
                            {
                                header: "Nomor Jurnal",
                                dataIndex: 'nomor_jurnal',
                                sortable: true,
                                width: 80
                            },
                            {
                                header: "Tgl Jurnal",
                                dataIndex: 'tgl_jurnal',
                                sortable: true,
                                width: 80
                            },
                            {
                                header: "Referensi",
                                dataIndex: 'referensi',
                                sortable: true,
                                width: 70
                                //                                }
                            },
                            {
                                header: "Keterangan",
                                dataIndex: 'keterangan',
                                //                                flex:1,
                                sortable: true,
                                width: 200
                            },
                            {
                                header: "Rekening",
                                dataIndex: 'rekening',
                                sortable: true,
                                width: 70
                            },{
                                header: "Nama Rekening",
                                dataIndex: 'nama_rekening',
                                sortable: true,
                                width: 120
                            },
                            {
                                xtype:'numbercolumn',
                                text: 'Debet',
                                dataIndex: 'debet',
                                sortable: false,                                
                                width: 120,
                                align:'right',
                                format: '0,0'
                            }
                            ,{
                                xtype:'numbercolumn',
                                text: 'Kredit',
                                dataIndex: 'kredit',
                                sortable: false,                                
                                width: 120,
                                align:'right',
                                format: '0,0'                                
                            },
                            {
                                header: "Transaksi Cd",
                                dataIndex: 'transaksi_cd',
                                sortable: true,
                                width: 100
                            },
                            {
                                header: "Jurnal By",
                                dataIndex: 'jurnal_by',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Jurnal Date",
                                dataIndex: 'jurnal_date',
                                sortable: true,
                                width: 70
                            },{
                                header: "Kode Posting",
                                dataIndex: 'kode_posting',
                                sortable: true,
                                width: 100
                            }
                        ],
                        tbar:{
                            xtype:'toolbar',
                            items:[{
                                    xtype: 'button',
                                    text: 'Load Data',
                                    iconCls: 'icon-preview',                            
                                    handler:function(){
                                        //validasi                                
                                        if (!Ext.getCmp('jmon_tgl').collapsed){
                                            if (!Ext.getCmp('jmon_tgl_awal').getValue()){
                                                set_message(2,'Tanggal Awal Belum Dipilih');
                                                return;
                                            }
                                            if (!Ext.getCmp('jmon_tgl_akhir').getValue()){
                                                set_message(2,'Tanggal Akhir Belum Dipilih');
                                                return;
                                            }
                                            if (Ext.getCmp('jmon_tgl_awal').getValue()>Ext.getCmp('jmon_tgl_akhir').getValue()){
                                                set_message(2,'Tanggal Akhir kurang dari Tanggal Awal');
                                                return;
                                            }
                                        }
                                        //set parameter query
                                        var parquery=new Array();
                                        if (!Ext.getCmp('jmon_tgl').collapsed){
                                            parquery.push({name:'tgl_awal',value:Ext.Date.format(Ext.getCmp('jmon_tgl_awal').getValue(), 'Y-m-d')});
                                            parquery.push({name:'tgl_akhir',value:Ext.Date.format(Ext.getCmp('jmon_tgl_akhir').getValue(), 'Y-m-d')});
                                       
                                        }
                                        if (!Ext.getCmp('jmon_filter').collapsed){                                    
                                    
                                            if (Ext.getCmp('jmon_filter_by').getValue().rbfilter==1){                                        
                                                parquery.push({name:'referensi',value:Ext.getCmp('jmon_filter_value').getValue()});
                                            }else if (Ext.getCmp('jmon_filter_by').getValue().rbfilter==2){
                                                parquery.push({name:'keterangan',value:Ext.getCmp('jmon_filter_value').getValue()});                                                                                
                                            }else if (Ext.getCmp('jmon_filter_by').getValue().rbfilter==3){
                                                parquery.push({name:'rekening',value:Ext.getCmp('jmon_filter_value').getValue()});                                        
                                            }
                                        }
                                
                                        //                                 console.log(parquery.length);
                                        if (parquery.length>0){
                                            journalMonitor_store.removeAll();
                                            journalMonitor_store.reload({params:{query:Ext.JSON.encode(parquery)}});
                                        }
                                        //                                
                                    }
                                },{
                                
                                    xtype: 'button',
                                    text: 'Export Data To Excel',
                                    iconCls: 'icon-export',   
                                    handler:function(){
                                        var gridstr=Ext.getCmp('jmon_grid').getStore();
                                        var vtitle='Jurnal Monitor';
                                        if(gridstr.getTotalCount()>0 ){
                                            if (!Ext.getCmp('jmon_tgl').collapsed){                                                
                                                vtitle='Filter By Date ' + Ext.Date.format(Ext.getCmp('jmon_tgl_awal').getValue(), 'Y-m-d') +' s/d ' + Ext.Date.format(Ext.getCmp('jmon_tgl_akhir').getValue(), 'Y-m-d');
                                       
                                            }
                                            if (!Ext.getCmp('jmon_filter').collapsed){                                    
                                    
                                                if (Ext.getCmp('jmon_filter_by').getValue().rbfilter==1){                                        
                                                    vtitle=+ vtitle + ' Filter By Referensi ' + Ext.getCmp('jmon_filter_value').getValue();
                                                    
                                                }else if (Ext.getCmp('jmon_filter_by').getValue().rbfilter==2){
                                                    vtitle=+ vtitle + ' Filter By Keterangan ' + Ext.getCmp('jmon_filter_value').getValue();
                                                    
                                                }else if (Ext.getCmp('jmon_filter_by').getValue().rbfilter==3){
                                                    vtitle=+ vtitle + ' Filter By Rekening ' + Ext.getCmp('jmon_filter_value').getValue();
                                                   
                                                }
                                            }
                                            var mdata = Ext.getCmp('jmon_grid').exportGrid(Ext.getCmp('jmon_grid'),'excel',
                                            {title:vtitle});
                                            //                                           console.log(mdata);
                                            document.location= mdata;
                                        }else{
                                            set_message(2, "No Data Found to Export");
                                            return;
                                        }
                                    }
                                }
                            ]
                            
                        },
                        bbar:{
                            xtype: 'pagingtoolbar',
                            store: journalMonitor_store,
                            pageSize: ENDPAGE,
                            displayInfo: true
                        }
                        //                        viewConfig:{
                        //                            getRowClass: function(record, rowIndex, rp, ds){
                        //                                if(record.get('jurnal_by')=='fnn'){
                        //                                    console.log(record.get('jurnal_by'));
                        //                                    return "x-grid-warna";
                        //                                }
                        //                            }
                        //                        }
                    }
                ]
            }        
        ],
        /*eos panel grid*/

        listeners:
            {
            show:function()
            {
                var parquery=new Array();
                parquery.push({name:'tgl_awal',value:Ext.Date.format(new Date(), 'Y-m-d')});
                parquery.push({name:'tgl_akhir',value:Ext.Date.format(new Date(), 'Y-m-d')});
                var storegrid=Ext.getCmp('jmon_grid').store;
                storegrid.load({params:{query:Ext.JSON.encode(parquery)}});
            }
        }, 
        initComponent: function()
        {
            this.callParent(arguments);
        }
    });
</script>
