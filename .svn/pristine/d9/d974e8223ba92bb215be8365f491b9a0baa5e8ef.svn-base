<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript"> 
    var JournalMonitor_store = Ext.create('Ext.data.Store',
    {
        autoLoad	: false,
        autoSync	: false,
        storeId		: 'JournalMonitor_store',
        fields          : ['id_jurnal','nomor_jurnal','tgl_jurnal','referensi','keterangan','transaksi_cd','rekening','akun_type','jumlah','jurnal_by','jurnal_date','update_date'],
        proxy		: {
            type: 'ajax',
            api: {                    
                read    : '<?php echo base_url(); ?>' + 'global_reference/rep_JournalMonitor'
		   
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

    
    Ext.define('MyTabJournalMonitor',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabJournalMonitor',
        alias: 'widget.JournalMonitor',
        title: 'Journal Monitor',
        id: 'tab1e',
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
                                xtype: 'datefield',
                                name: 'tgl_Awal',
                                afterLabelTextTpl: required_css,
                                fieldLabel: 'Tanggal Awal',
                                anchor: '90%'
                            },
                            {
                                xtype: 'datefield',
                                name: 'tgl_Akhir',
                                afterLabelTextTpl: required_css,
                                fieldLabel: 'Tanggal Akhir',
                                anchor: '90%'
                            },
                            {
                                xtype: 'combo',
                                tooltip: 'Field tidak boleh kosong',
                                afterLabelTextTpl: required_css,
                                fieldLabel: 'Jenis Akun',
                                id: 'journalmonitor_mst_account_cb',
                                store: mst_account_store,
                                valueField: 'rekening',
                                displayField: 'nama_rekening',
                                typeAhead: true,
                                triggerAction: 'all',
                                // allowBlank: false,
                                editable: false,
                                anchor: '90%',
                                hiddenName: 'rekening',
                                emptyText: 'Akun'
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
                        xtype:'grid',
                        id:'JournalMonitor_grid',
                        stateful:true,
                        stateId:'stateGrid',
                        store: JournalMonitor_store,//Ext.data.StoreManager.lookup('JournalMonitor_store'),
                        stripeRows: true,
                        loadMask: true,
                        //                        sm:sm_JournalMonitor,
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
                                width: 70
                            },
                            {
                                header: "Tgl Jurnal",
                                dataIndex: 'tgl_jurnal',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Referensi",
                                dataIndex: 'referensi',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Keterangan",
                                dataIndex: 'keterangan',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Transaksi Cd",
                                dataIndex: 'transaksi_cd',
                                sortable: true,
                                width: 120
                            },
                            {
                                header: "Rekening",
                                dataIndex: 'rekening',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "Akun Type",
                                dataIndex: 'akun_type',
                                sortable: true,
                                width: 70
                            },
                            {
                                header: "jumlah",
                                dataIndex: 'Jumlah',
                                sortable: true,
                                width: 70
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
                            },
                            {
                                header: "Update Date",
                                dataIndex: 'update_date',
                                sortable: true,
                                width: 70
                            }
                        ],
                        bbar:{
                            xtype: 'pagingtoolbar',
                            store: JournalMonitor_store,pageSize: ENDPAGE,
                            displayInfo: true
                        }
                    }
                ]
            }        
        ],
        /*eos panel grid*/

        listeners:
        {
            show:function()
            {
                var storegrid=Ext.getCmp('JournalMonitor_grid').store;
                //storegrid.loadPage(1);
            }
        }, 
        initComponent: function()
        {
            this.callParent(arguments);
        }
    });
</script>
