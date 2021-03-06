<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    var tbUrl='<?php echo base_url(); ?>' + 'base_report/get_row_trialbalance';  
    var tb_store = createStoreGroup(false,'mtb_store',['jenis','kelompok','rekening',
        {name:'debet_awal', type:'float'},
        {name:'kredit_awal', type:'float'},
        {name:'mutasi_d', type:'float'},
        {name:'mutasi_k', type:'float'},
        {name:'debet_akhir', type:'float'},
        {name:'kredit_akhir', type:'float'},
        {name:'debet_rl', type:'float'},
        {name:'kredit_rl', type:'float'},
        {name:'debet_nr', type:'float'},
        {name:'kredit_nr', type:'float'},
        'cls'],'jenis',tbUrl);
    Ext.define('tbprint_wind', {
        extend          : 'Ext.window.Window',
        title           : 'Trial Balance Preview',
        width           : 900,
        height          : 450,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.tb_print',
        id              : 'tbprint_wind',
        maximizable     :true,
        html:'<iframe style="width:100%;height:100%;" id="tbprint" src=""></iframe>'

    });
    var vtrialthbl;
    Ext.define('MyTabTrialBalance', {
        extend: 'Ext.container.Container',
        xtype: 'TabTrialBalance',
        alias: 'widget.TabTrialBalance',
        title: 'Trial Balance',
        id: 'tab1h',
        closable: true,        
        layout: 'border',
        items: [ 
            {xtype: 'panel',
                title:'Tahun Bulan Laporan',
                autoShow: true,
                id: 'panelTrialBalance',
                region: 'north',
                margins: '5 5 5 5',
                layout: 'column',
                collapsible:true,
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
                                xtype: 'monthfield',
                                name: 'tb_thbl',                                        
                                //                                        vtype:'daterange',
                                //                                        startDateField:  'gl_tgl_awal',
                                afterLabelTextTpl: required_css,
                                fieldLabel: 'Tahun Bulan',
                                anchor: '90%',
                                format:'Y-F'
                                ,id:'tb_thbl'
                                ,listeners:{
                                    select:function(m, d){
                                        vtrialthbl=d;m.setValue(vtrialthbl); 
                                    },
                                            change:function(m,n,o,opt){
//                                                m.setValue(new Date(n.getFullYear(),n.getMonth(),1));
//                                                console.log(n);
                                                  m.setValue(vtrialthbl); 
                                            },
                                            writeablechange:function( me, Read, eOpts ){                                                
                                                me.setValue(vtrialthbl); 
                                            },
                                            dirtychange:function( me, isDirty, eOpts ){                                               
                                                me.setValue(vtrialthbl); 
                                            }
                                }
                                //                                        ,maxValue:new Date()
                            }]
                    }
                ]
                
            },{
                xtype: 'panel',
                autoShow: true,
                //                id: 'gridTrialBalance',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'gridexporter',
                        id:'grid1g',
                        store: tb_store,
                        stripeRows: true,
                        loadMask: true,
                        stateful:true,
                        //                        stateId:'stateGrid',
                        autoScroll:true,
                        columnLines:true,                        
                        columns:[
                            {
                                text: 'Jenis',
                                dataIndex: 'jenis',
                                sortable: false,
                                //                                flex:1,
                                width: 80
                            },
                            //                            {
                            //                                text: 'Kelompok',
                            //                                dataIndex: 'kelompok',
                            //                                sortable: false,
                            ////                                flex:1,
                            //                                width: 120
                            //                            },                           
                            {                               
                                text: 'Rekening',
                                dataIndex: 'rekening',
                                sortable: false,
                                //                                flex:1,
                                width: 250,
                                locked: true,
                                hideable: false
                            }
                            ,{
                                text:'Saldo Awal',
                                columns: [{
                                        xtype:'numbercolumn',
                                        text: 'Debet',
                                        dataIndex: 'debet_awal',
                                        sortable: false,
                                        align:'right',
                                        format:'0,0',                                       
                                        width: 100
                                    }
                                    ,{
                                        xtype:'numbercolumn',
                                        text: 'Kredit',
                                        dataIndex: 'kredit_awal',
                                        sortable: false,
                                        align:'right',
                                        format:'0,0',
                                        width: 100
                                    }]
                            },{
                                text:'Mutasi',
                                columns: [{
                                        xtype:'numbercolumn',
                                        text: 'Debet',
                                        dataIndex: 'mutasi_d',
                                        sortable: false,
                                        align:'right',
                                        format:'0,0',
                                        width: 100
                                    }
                                    ,{
                                        xtype:'numbercolumn',
                                        text: 'Kredit',
                                        dataIndex: 'mutasi_k',
                                        sortable: false,
                                        align:'right',
                                        format:'0,0',
                                        width: 100
                                    }]
                            },{
                                text:'Saldo Akhir',
                                columns: [{
                                        xtype:'numbercolumn',
                                        text: 'Debet',
                                        dataIndex: 'debet_akhir',
                                        sortable: false,
                                        align:'right',
                                        format:'0,0',
                                        width: 100
                                    }
                                    ,{
                                        xtype:'numbercolumn',
                                        text: 'Kredit',
                                        dataIndex: 'kredit_akhir',
                                        sortable: false,
                                        align:'right',
                                        format:'0,0',
                                        width: 100
                                    }]
                            }
                            ,{
                                text:'Rugi/Laba',
                                columns: [{
                                        xtype:'numbercolumn',
                                        text: 'Debet',
                                        dataIndex: 'debet_rl',
                                        sortable: false,
                                        align:'right',
                                        format:'0,0',
                                        //                                        summaryType: 'sum',

                                        //                                        flex:1,
                                        width: 100
                                    }
                                    ,{
                                        xtype:'numbercolumn',
                                        text: 'Kredit',
                                        dataIndex: 'kredit_rl',
                                        sortable: false,
                                        align:'right',
                                        format:'0,0',
                                        //                                        summaryType: 'sum',

                                        //                                        flex:1,
                                        width: 100
                                    }]
                            },{
                                text:'Neraca',
                                columns: [{
                                        xtype:'numbercolumn',
                                        text: 'Debet',
                                        dataIndex: 'debet_nr',
                                        sortable: false,
                                        align:'right',
                                        format:'0,0',
                                        //                                        summaryType: 'sum',

                                        //                                        flex:1,
                                        width: 100
                                    }
                                    ,{
                                        xtype:'numbercolumn',
                                        text: 'Kredit',
                                        dataIndex: 'kredit_nr',
                                        sortable: false,
                                        align:'right',
                                        format:'0,0',
                                        //                                        summaryType: 'sum',

                                        //                                        flex:1,
                                        width: 100
                                        
                                    }]
                            }
                            
                        ],
                        tbar:[
                            {xtype: 'button',
                                text: 'Load Data',
                                iconCls: 'icon-preview',
                                handler:function()
                                {
                                    if (!Ext.getCmp('tb_thbl').getValue())
                                    {
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    var vthbl=Ext.Date.format(Ext.getCmp('tb_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('tb_thbl').getValue()!=vtrialthbl){
                                      Ext.getCmp('tb_thbl').setValue(vtrialthbl);
                                      vthbl=  Ext.Date.format(vtrialthbl,'Ym');
                                    }
                                    setDefaultStoreProxy(tb_store,tbUrl);
                                    tb_store.load({params:{thbl:vthbl}});
                
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Preview PDF',
                                iconCls: 'icon-preview_report',
                                onClick: function()
                                {
                                    if (!Ext.getCmp('tb_thbl').getValue())
                                    {
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    var vthbl=Ext.Date.format(Ext.getCmp('tb_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('tb_thbl').getValue()!=vtrialthbl){
                                      Ext.getCmp('tb_thbl').setValue(vtrialthbl);
                                      vthbl=  Ext.Date.format(vtrialthbl,'Ym');
                                    }
                                    var winprinttb=Ext.create('tbprint_wind');
                                    winprinttb.show();
                                    Ext.getDom('tbprint').src ='<?php echo base_url(); ?>' +'base_report/trialbalance_pdf?thbl='+vthbl;
//                                    window.open('<?php echo base_url(); ?>' +'base_report/trialbalance_pdf?thbl='+vthbl);
                                }
                                //                                    ,action: 'add'
                            },
                            //----------------kelompok--------------
                            {xtype: 'button',
                                text: 'Load Data Kelompok',
                                iconCls: 'icon-preview',
                                handler:function()
                                {
                                    if (!Ext.getCmp('tb_thbl').getValue())
                                    {
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    var vthbl=Ext.Date.format(Ext.getCmp('tb_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('tb_thbl').getValue()!=vtrialthbl){
                                      Ext.getCmp('tb_thbl').setValue(vtrialthbl);
                                      vthbl=  Ext.Date.format(vtrialthbl,'Ym');
                                    }
                                    setDefaultStoreProxy(tb_store,'<?php echo base_url(); ?>' + 'base_report/get_row_trialbalance_header');
                                    tb_store.load({params:{thbl:vthbl}});
                
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Preview PDF Kelompok',
                                iconCls: 'icon-preview_report',
                                onClick: function()
                                {
                                    if (!Ext.getCmp('tb_thbl').getValue())
                                    {
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    var vthbl=Ext.Date.format(Ext.getCmp('tb_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('tb_thbl').getValue()!=vtrialthbl){
                                      Ext.getCmp('tb_thbl').setValue(vtrialthbl);
                                      vthbl=  Ext.Date.format(vtrialthbl,'Ym');
                                    }
                                    var winprinttb=Ext.create('tbprint_wind');
                                    winprinttb.show();
                                    Ext.getDom('tbprint').src ='<?php echo base_url(); ?>' +'base_report/trialbalance_header_pdf?thbl='+vthbl;
//                                    window.open('<?php echo base_url(); ?>' +'base_report/trialbalance_pdf?thbl='+vthbl);
                                }
                                //                                    ,action: 'add'
                            }
                            //-----------------------------------kelompok level 1
                            //----------------kelompok--------------
                            ,{xtype: 'button',
                                text: 'Load Data Kelompok Level 1',
                                iconCls: 'icon-preview',
                                handler:function()
                                {
                                    if (!Ext.getCmp('tb_thbl').getValue())
                                    {
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    var vthbl=Ext.Date.format(Ext.getCmp('tb_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('tb_thbl').getValue()!=vtrialthbl){
                                      Ext.getCmp('tb_thbl').setValue(vtrialthbl);
                                      vthbl=  Ext.Date.format(vtrialthbl,'Ym');
                                    }
                                    setDefaultStoreProxy(tb_store,'<?php echo base_url(); ?>' + 'base_report/get_row_trialbalance_header_l1');
                                    tb_store.load({params:{thbl:vthbl}});
                
                                }
                            },
                            {
                                xtype: 'button',
                                text: 'Preview PDF Kelompok Level 1',
                                iconCls: 'icon-preview_report',
                                onClick: function()
                                {
                                    if (!Ext.getCmp('tb_thbl').getValue())
                                    {
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    var vthbl=Ext.Date.format(Ext.getCmp('tb_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('tb_thbl').getValue()!=vtrialthbl){
                                      Ext.getCmp('tb_thbl').setValue(vtrialthbl);
                                      vthbl=  Ext.Date.format(vtrialthbl,'Ym');
                                    }
                                    var winprinttb=Ext.create('tbprint_wind');
                                    winprinttb.show();
                                    Ext.getDom('tbprint').src ='<?php echo base_url(); ?>' +'base_report/trialbalance_header_l1_pdf?thbl='+vthbl;
//                                    window.open('<?php echo base_url(); ?>' +'base_report/trialbalance_pdf?thbl='+vthbl);
                                }
                                //                                    ,action: 'add'
                            }

                            ]
                        ,features:[{
                                ftype: 'grouping',
                                //                                groupHeaderTpl: '{columnName}: {name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})',
                                groupHeaderTpl: '{name}',
                                hideGroupedHeader: true,
                                startCollapsed: false,
                                enableGroupingMenu: false,
                                
                                id: 'tb_grid_Grouping'
                            }]
                        ,viewConfig: {
                            getRowClass: function(record, rowIndex, rp, ds){
                                if(record.get('cls'))
                                {
                                    return record.get('cls');
                                }
                               
                            }
                        }
                        
                        
                    }
                ]
            }
           
        ],
        initComponent: function() {
            this.callParent(arguments);
        }
    });
        
</script>
