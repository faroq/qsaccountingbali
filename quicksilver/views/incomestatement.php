<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    
    var incsUrl='<?php echo base_url(); ?>' + 'income_statement/get_rows';  
    var incs_store = createStoreGroup(false,'mincs_store',['jenis','nama_jenis','rekening',
        {name:'thbl_t', type:'float'},
        {name:'thbl', type:'float'},
        {name:'tahunberjalan', type:'float'},
        'cls'],'jenis',incsUrl);
    Ext.define('incsprint_wind', {
        extend          : 'Ext.window.Window',
        title           : 'Income Statement Preview',
        width           : 900,
        height          : 450,
        layout          : 'fit',
        autoShow        : true,
        modal           : true,
        alias           : 'widget.incs_print',
        id              : 'incsprint_wind',
        maximizable     :true,
        html:'<iframe style="width:100%;height:100%;" id="incsprint" src=""></iframe>'

    });
    var vincsthbl;
    Ext.define('MyTabIncomeStatement', {
        extend: 'Ext.container.Container',
        xtype: 'TabIncomeStatement',
        alias: 'widget.TabIncomeStatement',
        title: 'Income Statement',
        id: 'tab1i',
        closable: true,        
        layout: 'border',
        items: [ {xtype: 'panel',
                autoShow: true,
                id: 'panelIncomeStatement',
                title:'Tahun Bulan Laporan',
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
                                name: 'incs_thbl',                                        
                                //                                        vtype:'daterange',
                                //                                        startDateField:  'gl_tgl_awal',
                                afterLabelTextTpl: required_css,
                                fieldLabel: 'Tahun Bulan',
                                anchor: '90%',
                                format:'Y-F'
                                ,id:'incs_thbl',scope:this,
                                listeners:{
                                    select:function(m, d){
                                        vincsthbl=d;m.setValue(vincsthbl); 
                                    },
                                            change:function(m,n,o,opt){
//                                                m.setValue(new Date(n.getFullYear(),n.getMonth(),1));
//                                                console.log(n);
                                                  m.setValue(vincsthbl); 
                                            },
                                            writeablechange:function( me, Read, eOpts ){                                                
                                                me.setValue(vincsthbl); 
                                            },
                                            dirtychange:function( me, isDirty, eOpts ){                                               
                                                me.setValue(vincsthbl); 
                                            }
                                }
                                //                                        ,maxValue:new Date()
                            }]
                    }
                ]
                
            },{
                xtype: 'panel',
                autoShow: true,
                //                id: 'gridIncomeStatement',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'grid1h',
                        store: incs_store,
                        stripeRows: true,
                        loadMask: true,
                        stateful:true,
                        stateId:'stateGridIS',
                        columns:[
                            {
                                text: 'Jenis',
                                dataIndex: 'jenis',
                                sortable: false,
                                //                                flex:1,
                                width: 80
                            },{
                                text: 'nama_jenis',
                                dataIndex: 'nama_jenis',
                                sortable: false,
                                //                                locked: true,
                                //                                flex:1,
                                width: 150
                            },{                               
                                text: 'Rekening',
                                dataIndex: 'rekening',
                                sortable: false,
                                flex:1,
                                width: 250,
                                //                                locked: true,
                                hideable: false
                            },{
//                                xtype:'numbercolumn',
                                text: 'Bulan-1',
                                dataIndex: 'thbl_t',
                                sortable: false,
                                align:'right',
                                //                                format:'0,0',                                       
                                width: 100,
                                renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                                    if(!record.get('cls')){
                                        return Ext.util.Format.number(value, '0,000');
                                    }else{
                                        var str='TOTAL';                                        
                                        if(record.get('nama_jenis').substring(0, str.length)==str){                                            
                                            return Ext.util.Format.number(value, '0,000');
                                        }else{
                                            return value;
                                        }
                                        
                                    }
                                    
                                }
                            }
                            ,{
//                                xtype:'numbercolumn',
                                text: 'Bulan Berjalan',
                                dataIndex: 'thbl',
                                sortable: false,
                                align:'right',
//                                format:'0,0',
                                width: 100,
                                renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                                    if(!record.get('cls')){
                                        return Ext.util.Format.number(value, '0,000');
                                    }else{
                                        var str='TOTAL';                                        
                                        if(record.get('nama_jenis').substring(0, str.length)==str){                                            
                                            return Ext.util.Format.number(value, '0,000');
                                        }else{
                                            return value;
                                        }
                                    }
                                    
                                }
                            },{
//                                xtype:'numbercolumn',
                                text: 'Tahun Berjalan',
                                dataIndex: 'tahunberjalan',
                                sortable: false,
                                align:'right',
//                                format:'0,0',
                                width: 100,
                                renderer: function(value, metaData, record, rowIndex, colIndex, store) {
                                    if(!record.get('cls')){
                                        return Ext.util.Format.number(value, '0,000');
                                    }else{
                                        var str='TOTAL';                                        
                                        if(record.get('nama_jenis').substring(0, str.length)==str){                                            
                                            return Ext.util.Format.number(value, '0,000');
                                        }else{
                                            return value;
                                        }
                                    }
                                    
                                }
                            }
                        ],                        
                        tbar:[
                            {xtype: 'button',
                                text: 'Load Data',
                                iconCls: 'icon-preview',
                                handler:function(){
                                    if (!Ext.getCmp('incs_thbl').getValue()){
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    var vthbl=Ext.Date.format(Ext.getCmp('incs_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('incs_thbl').getValue()!=vincsthbl){
                                      vthbl=  Ext.Date.format(vincsthbl,'Ym');
                                      Ext.getCmp('incs_thbl').setValue(vincsthbl);
                                    }
                                    setDefaultStoreProxy(incs_store,incsUrl);
                                    incs_store.load({params:{thbl:vthbl}});
                
                                }
                            },
                            {xtype: 'button',
                                text: 'Preview PDF',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('incs_thbl').getValue()){
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    var vthbl=Ext.Date.format(Ext.getCmp('incs_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('incs_thbl').getValue()!=vincsthbl){
                                      vthbl=  Ext.Date.format(vincsthbl,'Ym');
                                      Ext.getCmp('incs_thbl').setValue(vincsthbl);
                                    }
                                    //incs_store.load({params:{thbl:vthbl}});
                                    var winprintincs=Ext.create('incsprint_wind');
                                    winprintincs.show();
                                    Ext.getDom('incsprint').src ='<?php echo base_url(); ?>' +'income_statement/instat_pdf?thbl='+vthbl;
//                                    window.open('<?php echo base_url(); ?>' +'income_statement/instat_pdf?thbl='+vthbl);

                                }
                            },
                            {xtype: 'button',
                                text: 'Load Data Kelompok',
                                iconCls: 'icon-preview',
                                handler:function(){
                                    if (!Ext.getCmp('incs_thbl').getValue()){
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
//                                    get_rows_header
                                    var vthbl=Ext.Date.format(Ext.getCmp('incs_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('incs_thbl').getValue()!=vincsthbl){
                                      vthbl=  Ext.Date.format(vincsthbl,'Ym');
                                      Ext.getCmp('incs_thbl').setValue(vincsthbl);
                                    }
                                    setDefaultStoreProxy(incs_store,'<?php echo base_url(); ?>' + 'income_statement/get_rows_header');
                                    incs_store.load({params:{thbl:vthbl}});
                
                                }
                            },
                            {xtype: 'button',
                                text: 'Preview PDF Kelompok',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('incs_thbl').getValue()){
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    
                                    var vthbl=Ext.Date.format(Ext.getCmp('incs_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('incs_thbl').getValue()!=vincsthbl){
                                      vthbl=  Ext.Date.format(vincsthbl,'Ym');
                                      Ext.getCmp('incs_thbl').setValue(vincsthbl);
                                    }
                                    //incs_store.load({params:{thbl:vthbl}});
                                    var winprintincs=Ext.create('incsprint_wind');
                                    winprintincs.show();
                                    Ext.getDom('incsprint').src ='<?php echo base_url(); ?>' +'income_statement/instat_pdf_header?thbl='+vthbl;
//                                    window.open('<?php echo base_url(); ?>' +'income_statement/instat_pdf?thbl='+vthbl);

                                }
                            },
                            {xtype: 'button',
                                text: 'Load Data Kelompok Level 1',
                                iconCls: 'icon-preview',
                                handler:function(){
                                    if (!Ext.getCmp('incs_thbl').getValue()){
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
//                                    get_rows_header
                                    var vthbl=Ext.Date.format(Ext.getCmp('incs_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('incs_thbl').getValue()!=vincsthbl){
                                      vthbl=  Ext.Date.format(vincsthbl,'Ym');
                                      Ext.getCmp('incs_thbl').setValue(vincsthbl);
                                    }
                                    setDefaultStoreProxy(incs_store,'<?php echo base_url(); ?>' + 'income_statement/get_rows_lv1');
                                    incs_store.load({params:{thbl:vthbl}});
                
                                }
                            },
                            {xtype: 'button',
                                text: 'Preview PDF Kelompok Level 1',
                                iconCls: 'icon-preview_report',
                                handler:function(){
                                    if (!Ext.getCmp('incs_thbl').getValue()){
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    
                                    var vthbl=Ext.Date.format(Ext.getCmp('incs_thbl').getValue(),'Ym');
                                    if(Ext.getCmp('incs_thbl').getValue()!=vincsthbl){
                                      vthbl=  Ext.Date.format(vincsthbl,'Ym');
                                      Ext.getCmp('incs_thbl').setValue(vincsthbl);
                                    }
                                    //incs_store.load({params:{thbl:vthbl}});
                                    var winprintincs=Ext.create('incsprint_wind');
                                    winprintincs.show();
                                    Ext.getDom('incsprint').src ='<?php echo base_url(); ?>' +'income_statement/instat_pdf_lv1?thbl='+vthbl;
//                                    window.open('<?php echo base_url(); ?>' +'income_statement/instat_pdf?thbl='+vthbl);

                                }
                            }
                            ]
                        ,features:[{
                                ftype: 'grouping',
                                //                                groupHeaderTpl: '{columnName}: {name} ({rows.length} Item{[values.rows.length > 1 ? "s" : ""]})',
                                groupHeaderTpl: '{name}',
                                hideGroupedHeader: true,
                                startCollapsed: false,
                                enableGroupingMenu: false,
                                
                                id: 'incs_grid_Grouping'
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