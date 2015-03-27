<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    
    var bls_store = createStore(false, 'mbls_store', 
    ['jenis_d',        
        'rekening_d',
        'subtotal_d',
        'total_d',
        'cls_d',
        'jenis_k',        
        'rekening_k',
        'subtotal_k',
        'total_k',
        'cls_k'
    ], 
    '<?php echo base_url(); ?>' + 'balance_sheet/get_rows'
);
    Ext.define('MyTabBalanceSheet', {
        extend: 'Ext.container.Container',
        xtype: 'TabBalanceSheet',
        alias: 'widget.TabBalanceSheet',
        title: 'Balance Sheet',
        id: 'tab1i',
        closable: true,        
        layout: 'border',
        items: [ {xtype: 'panel',
                autoShow: true,
                id: 'panelBalanceSheet',
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
                                xtype: 'monthfield',
                                name: 'bls_thbl',                                        
                                //                                        vtype:'daterange',
                                //                                        startDateField:  'gl_tgl_awal',
                                afterLabelTextTpl: required_css,
                                fieldLabel: 'Tahun Bulan',
                                anchor: '90%',
                                format:'Y-F'
                                ,id:'bls_thbl'
                                //                                        ,maxValue:new Date()
                            }]
                    }
                ]
                
            },{
                xtype: 'panel',
                autoShow: true,
                //                id: 'gridBalanceSheet',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                    {
                        xtype:'grid',
                        id:'grid1i',
                        store: bls_store,
                        //                        stripeRows: true,
                        loadMask: true,
                        stateful:true,
                        stateId:'stateGrid',
                        columnLines:true,
                        columns:[
                            {
                                text:'AKTIVA',
                                columns:[{
                                        text: 'Jenis',
                                        dataIndex: 'jenis_d',
                                        sortable: false,
                                        tdCls:'x-jenisd-cell',                               
                                        width: 110,
                                        renderer:function(value, metaData, record, rowIndex, colIndex, store) {
                                            if(record.get('cls_d')== 'x-bls-header'){
                                                metaData.tdCls=record.get('cls_d');
                                            }
                                            
                                            return value;
                                        }
                                        
                                    },                                    
                                    {                               
                                        text: 'Rekening',
                                        dataIndex: 'rekening_d',
                                        sortable: false,
                                        flex:1,
                                        width: 250,
                                        renderer:function(value, metaData, record, rowIndex, colIndex, store) {
                                            if(record.get('cls_d')){
                                                metaData.tdCls=record.get('cls_d');
                                            }
                                            
                                            return value;
                                        }
                                    },{                                       
                                        text: 'Subtotal',
                                        dataIndex: 'subtotal_d',
                                        sortable: false,
                                        align:'right',                                        
                                        width: 100,
                                        tdCls:'x-subtotald-cell',
                                        renderer:function(value, metaData, record, rowIndex, colIndex, store) {
                                            var str='TOTAL';     
                                            var vstr=record.get('rekening_d');
                                            //                                            vstr=vstr.substring(0, str.length);
                                            if(!record.get('cls_d')){
                                                return Ext.util.Format.number(value, '0,000');
                                            }
                                            else {
                                                metaData.tdCls=record.get('cls_d');
                                                if(vstr){
                                                    if(vstr.substring(0, str.length) === str){
                                                        return Ext.util.Format.number(value, '0,000');
                                                    }else{
                                                        return value;
                                                    }
                                                }else{
                                                    return value;
                                                }
                                                
                                        
                                            }
                                    
                                        }
                                                  
                                    },{
                                        //                                xtype:'numbercolumn',
                                        text: 'Total',
                                        dataIndex: 'total_d',
                                        sortable: false,
                                        align:'right',                                        
                                        width: 100,
                                        tdCls:'x-totald-cell'
                                        ,renderer:function(value, metaData, record, rowIndex, colIndex, store) {
                                            var str='TOTAL';     
                                            var vstr=record.get('rekening_d');
                                            var vstrjenis=record.get('jenis_d');
                                            var newvalue=value;
                                            //                                            vstr=vstr.substring(0, str.length);
                                            if(!record.get('cls_d')){
                                                newvalue= Ext.util.Format.number(value, '0,000');
                                            }
                                            
                                            if(record.get('cls_d')=='x-bls-header'|| record.get('cls_d')=='x-bls-header2' ){
                                                metaData.tdCls=record.get('cls_d');
                                                    
                                            }
                                            //                                                console.log(vstrjenis);
                                            if(vstr){
                                                if(vstr.substring(0, str.length) === str){
                                                    newvalue= Ext.util.Format.number(value, '0,000');
                                                }
                                            }
                                            if(vstrjenis){
                                                if(vstrjenis.substring(0, str.length) === str){//                                                   
                                                    newvalue= Ext.util.Format.number(value, '0,000');
                                                }
                                            }
                                            
                                    
                                            return newvalue;
                                        }
                                                  
                                    }]
                            },{
                                text:'PASSIVA',
                                columns:[
                                    {
                                        text: 'Jenis',
                                        dataIndex: 'jenis_k',
                                        sortable: false,
                                        tdCls:'x-jenisk-cell',   
                                        width: 110,
                                        renderer:function(value, metaData, record, rowIndex, colIndex, store) {
                                            if(record.get('cls_k')== 'x-bls-header'){
                                                metaData.tdCls=record.get('cls_k');
                                            }
                                            
                                            return value;
                                        }
                                    },{                               
                                        text: 'Rekening',
                                        dataIndex: 'rekening_k',
                                        sortable: false,
                                        flex:1,
                                        tdCls:'x-rekeningk-cell',   
                                        width: 250,
                                        renderer:function(value, metaData, record, rowIndex, colIndex, store) {
                                            if(record.get('cls_k')){
                                                metaData.tdCls=record.get('cls_k');
                                            }
                                            
                                            return value;
                                        }
                                        //                                locked: true,
                                        //                                        hideable: false
                                    },{
                                        //                                xtype:'numbercolumn',
                                        text: 'Subtotal',
                                        dataIndex: 'subtotal_k',
                                        sortable: false,
                                        align:'right',           
                                        tdCls:'x-subtotalk-cell',   
                                        width: 100,
                                        renderer:function(value, metaData, record, rowIndex, colIndex, store) {
                                            var str='TOTAL';     
                                            var vstr=record.get('rekening_k');
                                            //                                            vstr=vstr.substring(0, str.length);
                                            if(!record.get('cls_k')){
                                                return Ext.util.Format.number(value, '0,000');
                                            }
                                            else {
                                                metaData.tdCls=record.get('cls_k');
                                                if(vstr){
                                                    if(vstr.substring(0, str.length) === str){
                                                        return Ext.util.Format.number(value, '0,000');
                                                    }else{
                                                        return value;
                                                    }
                                                }else{
                                                    return value;
                                                }
                                                
                                        
                                            }
                                    
                                        }
                                                  
                                    },{
                                        //                                xtype:'numbercolumn',
                                        text: 'Total',
                                        dataIndex: 'total_k',
                                        sortable: false,
                                        tdCls:'x-totalk-cell',   
                                        align:'right',                                        
                                        width: 100
                                        ,renderer:function(value, metaData, record, rowIndex, colIndex, store) {
                                            var str='TOTAL';     
                                            var vstr=record.get('rekening_k');
                                            var vstrjenis=record.get('jenis_k');
                                            var newvalue=value;
                                            //                                            vstr=vstr.substring(0, str.length);
                                            if(!record.get('cls_k')){
                                                newvalue= Ext.util.Format.number(value, '0,000');
                                            }
                                            
                                            if(record.get('cls_k')=='x-bls-header'|| record.get('cls_k')=='x-bls-header2' ){
                                                metaData.tdCls=record.get('cls_k');
                                                    
                                            }
                                            //                                                console.log(vstrjenis);
                                            if(vstr){
                                                if(vstr.substring(0, str.length) === str){
                                                    newvalue= Ext.util.Format.number(value, '0,000');
                                                }
                                            }
                                            if(vstrjenis){
                                                if(vstrjenis.substring(0, str.length) === str){//                                                   
                                                    newvalue= Ext.util.Format.number(value, '0,000');
                                                }
                                            }
                                            
                                    
                                            return newvalue;
                                    
                                        }          
                                    }
                                ]}
                            
                        ],                        
                        tbar:[{xtype: 'button',
                                text: 'Load Data',
                                iconCls: 'icon-preview',
                                handler:function(){
                                    if (!Ext.getCmp('bls_thbl').getValue()){
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    var vthbl=Ext.Date.format(Ext.getCmp('bls_thbl').getValue(),'Ym');
                                    bls_store.load({params:{thbl:vthbl}});
                
                                }
                            },
                            {xtype: 'button',
                                text: 'Save',
                                iconCls: 'icon-simpan',
                                handler:function(){
                                    if (!Ext.getCmp('bls_thbl').getValue()){
                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
                                        return;
                                    }
                                    var vthbl=Ext.Date.format(Ext.getCmp('bls_thbl').getValue(),'Ym');
                                    window.open('<?php echo base_url(); ?>' +'balance_sheet/bs_pdf?thbl='+vthbl);
                                }
                            }]
                        }
                ]
            }
           
        ],
        initComponent: function() {
            this.callParent(arguments);
        }
    });
        
</script>