<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    
    var bls_store = Ext.create('Ext.data.Store',{
        //        pageSize: ENDPAGE,
        autoLoad	: false,
        autoSync	: false,
        storeId		: 'mBalanceSheetStore',
        fields: [ 
            'rekening','nama_rekening','debet','kredit'
        ],
        proxy		: {
            type: 'ajax',
            api: {
                    
                read    : '<?php echo base_url(); ?>' + 'masteraccount/get_rows'
		   
            },
            actionMethods: {                    
                read    : 'POST'
            },
            reader: {
                type            : 'json',
                root            : 'data',
                rootProperty    : 'data',
                successProperty : 'success',
                totalProperty   : 'record'
                //                    messageProperty : 'message'
            },
            writer: {
                type            : 'json',
                writeAllFields  : true,
                root            : 'data',
                encode          : true
            },
            listeners: {
                exception: function(proxy, response, operation){
                    Ext.MessageBox.show({
                        title: 'REMOTE EXCEPTION',
                        msg: operation.getError(),
                        icon: Ext.MessageBox.ERROR,
                        buttons: Ext.Msg.OK
                    });
                },
                loadexception: function(event, options, response, error){
                    var err = Ext.util.JSON.decode(response.responseText);
                    if (err.errMsg == 'Session Expired') {
                        session_expired(err.errMsg);
                    }
                }
            }
        }
    });
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
                        //                        store: BalanceSheetstore,
                        //                        stripeRows: true,
                        //                        loadMask: true,
                        stateful:true,
                        stateId:'stateGrid',
                        columns:[
                            {
                                text:'AKTIVA',
                                columns:[{
                                text: 'Jenis',
                                dataIndex: 'jenis',
                                sortable: false,
                                //                                flex:1,
                                width: 80
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
                                text: 'Jumlah',
                                dataIndex: 'jumlah',
                                sortable: false,
                                align:'right',
                                //                                format:'0,0',                                       
                                width: 100,
//                                renderer: function(value, metaData, record, rowIndex, colIndex, store) {
//                                    if(!record.get('cls')){
//                                        return Ext.util.Format.number(value, '0,000');
//                                    }else{
//                                        var str='TOTAL';                                        
//                                        if(record.get('nama_jenis').substring(0, str.length)==str){                                            
//                                            return Ext.util.Format.number(value, '0,000');
//                                        }else{
//                                            return value;
//                                        }
//                                        
//                                    }
//                                    
//                                }
                            }]
                            },{
                                text:'PASSIVA',
                                columns:[
                                    {
                                text: 'Jenis',
                                dataIndex: 'jenis',
                                sortable: false,
                                //                                flex:1,
                                width: 80
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
                                text: 'Jumlah',
                                dataIndex: 'jumlah',
                                sortable: false,
                                align:'right',
                                //                                format:'0,0',                                       
                                width: 100,
//                                renderer: function(value, metaData, record, rowIndex, colIndex, store) {
//                                    if(!record.get('cls')){
//                                        return Ext.util.Format.number(value, '0,000');
//                                    }else{
//                                        var str='TOTAL';                                        
//                                        if(record.get('nama_jenis').substring(0, str.length)==str){                                            
//                                            return Ext.util.Format.number(value, '0,000');
//                                        }else{
//                                            return value;
//                                        }
//                                        
//                                    }
//                                    
//                                }
                            }
                                ]}
                            
                        ],                        
                        tbar:[{xtype: 'button',
                                text: 'Load Data',
                                iconCls: 'icon-preview',
                                handler:function(){
//                                    if (!Ext.getCmp('incs_thbl').getValue()){
//                                        set_message(2,'Tahun Bulan Belum Diisi!!!');
//                                        return;
//                                    }
//                                    var vthbl=Ext.Date.format(Ext.getCmp('incs_thbl').getValue(),'Ym');
//                                    incs_store.load({params:{thbl:vthbl}});
                
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