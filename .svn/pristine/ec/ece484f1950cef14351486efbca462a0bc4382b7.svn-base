<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    
    var GeneralLedgerstore = Ext.create('Ext.data.Store',{
        //        pageSize: ENDPAGE,
        autoLoad	: false,
        autoSync	: false,
        storeId		: 'mGeneralLedgerStore',
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
                
                                xtype: 'datefield',
                                name: 'tgl_jurnal',
                                fieldLabel: 'Tanggal Entry',
                                anchor: '90%'
                                //                                ,afterLabelTextTpl: required_css
                            },{
                                xtype: 'textfield',
                                name: 'referensi',
                                fieldLabel: 'Referensi',
                                anchor: '90%'
            
                            },{
                                xtype: 'textfield',
                                name: 'keterangan',
                                fieldLabel: 'Keterangan',
                                anchor: '90%'
            
                            }]
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
                        //                        store: GeneralLedgerstore,
                        //                        stripeRows: true,
                        //                        loadMask: true,
                        stateful:true,
                        stateId:'stateGrid',
                        columns:[
                            {
                                text: 'Rekening',
                                dataIndex: 'rekening',
                                sortable: false,
                                flex:1,
                                width: 70
                            }
                            , {
                                text: 'Nama Rekening',
                                dataIndex: 'nama_rekening',
                                sortable: false,
                                flex:1,
                                width: 70
                            }
                            , {
                                text: 'Debet',
                                dataIndex: 'debet',
                                sortable: false,
                                flex:1,
                                width: 70
                            }
                            ,{
                                text: 'Kredit',
                                dataIndex: 'kredit',
                                sortable: false,
                                flex:1,
                                width: 70
                            }
                        ]
                        ,bbar:['->' ,
                            {xtype: 'numberfield',fieldLabel: 'Total Debet',currencySymbol: '',id: 'avr_g_debet',fieldClass:'number',readOnly:true },
                            '-',
                            {xtype:'numberfield',fieldLabel: 'Total Kredit',currencySymbol: '',id: 'avr_g_kredit',fieldClass:'number',  readOnly:true }
                        ]
                        
                    }
                ]
            },{
                xtype: 'panel',
                autoShow: true,
                //                id: 'gridGeneralLedger',
                region: 'south',
                margins: '5 5 5 5',
                layout: 'fit',
                items:[
                   { xtype: 'toolbar',
                     height:40,
                            padding:'2 0 2 5',
                            items: ['->',{
                                    xtype: 'button',
                                    text: 'Save',
                                    iconCls: 'icons-add'
                            },{
                                    xtype: 'button',
                                    text: 'Cancel / Reset'
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