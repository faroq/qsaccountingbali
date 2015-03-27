<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript"> 
    
    var japp_store = createStore(false,'m_to_approve_store',['nomor_entry','tgl_jurnal','referensi','keterangan'],'<?php echo base_url(); ?>' + 'entry_jurnal/get_row_approval');
    var japp_detail_store = createStore(false,'m_detail_approve_store',['rekening','nama_rekening','debet','kredit'],'<?php echo base_url(); ?>' + 'entry_jurnal/get_row_approval_detail');
    
    function set_total_app_ej(){		
        var totaldebet=0;
        var totalkredit=0;
        var totalselisih=0;
                
        japp_detail_store.each(function(node){			
            totaldebet += parseInt(node.data.debet);
            totalkredit += parseInt(node.data.kredit);
        });
        totalselisih=totaldebet-totalkredit;
        Ext.getCmp('app_ej_t_debet').setValue(totaldebet);
        Ext.getCmp('app_ej_t_kredit').setValue(totalkredit);                
    };
    japp_detail_store.on('update', function(){
        set_total_app_ej();        
		
    });
    japp_detail_store.on('remove',  function(){
        set_total_app_ej();
		
    });
    
    japp_detail_store.on('load',  function(){
        set_total_app_ej();
		
    });
    
    Ext.define('MyTabJournalApproval', {
        extend: 'Ext.container.Container',
        xtype: 'TabJournalApproval',
        alias: 'widget.TabJournalApproval',
        title: 'Journal Approval',
        id: 'tab1d',
        closable: true,        
        layout: 'border',
        items: [ 
            {
                xtype: 'panel',
                autoShow: true,
                //                id: 'gridJournalApproval',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'border',
                items:[
                    {
                        xtype:'grid',
                        region:'center',   
                        
                        id:'grid_to_approval',
                        store: japp_store,
                        stripeRows: true,
                        loadMask: true,
                        stateful:true,
                        stateId:'stateGrid',
                        selType: 'checkboxmodel'
                        ,columns:[
                            {
                                text: 'Nomor Entry',
                                dataIndex: 'nomor_entry',
                                sortable: false,
                                //                                flex:1,
                                width: 70
                            },{
                                text: 'Tanggal Entry',
                                dataIndex: 'tgl_jurnal',
                                sortable: false,
                                //                                flex:1,
                                width: 80
                            },{
                                text: 'Referensi',
                                dataIndex: 'referensi',
                                sortable: false,
                                //                                flex:1,
                                width: 90
                            },{
                                text: 'Keterangan',
                                dataIndex: 'keterangan',
                                sortable: false,
                                flex:1,
                                width: 70
                            }
                        ]
                        ,
                        tbar: [{
                    
                                //                                regin:'north',
                                xtype: 'toolbar',
                                items: [{xtype: 'searchfield',
                                        store: japp_store,
                                        width: 380,
                                        emptyText: 'Quick Search...'
                                    }]
                            }]
                        ,bbar: 
                            {xtype: 'pagingtoolbar',   
                            pageSize: ENDPAGE,
                            store: japp_store,
                            displayInfo: true
                        }
                        ,listeners:{
                            itemclick:function( scope, record, item, index, e, eOpts ){
                                console.log(record.data.nomor_entry);
                                var vnoentry=record.data.nomor_entry;
                                Ext.getCmp('grid_detail_approval').getStore().reload({params:{query:vnoentry}});
                                Ext.getCmp('grid_detail_approval').expand();
                                        
                            }
                            //                            select:function( scope, record, index, eOpts ){
                            //                                var vnoentry=record.data.nomor_entry;
                            //                                Ext.getCmp('grid_detail_approval').getStore().reload({params:{query:vnoentry}});
                            //                                Ext.getCmp('grid_detail_approval').expand();
                            //                            },
                            
                        }
                    },
                    {
                        xtype:'grid',
                        id:'grid_detail_approval',
                        title:'Detail Entry Jurnal',
                        region:'east',
                        width: 500,
                        store: japp_detail_store,
                        stripeRows: true,
                        loadMask: true,
                        stateful:true,
                        stateId:'stateGrid',
                        split:true,
                        collapsible: true,
                        collapsed:true,
                        columns:[
                            {
                                text: 'Rekening',
                                dataIndex: 'rekening',
                                sortable: false,
                                //                                        flex:1,
                                width: 60
                            }
                            , {
                                text: 'Nama Rekening',
                                dataIndex: 'nama_rekening',
                                sortable: false,
                                flex:1,
                                width: 70
                            }
                            , {
                                xtype:'numbercolumn',
                                text: 'Debet',
                                dataIndex: 'debet',
                                sortable: false,
                                //                                flex:1,
                                width: 120,
                                align:'right',
                                format: '0,0'
                            }
                            ,{
                                xtype:'numbercolumn',
                                text: 'Kredit',
                                dataIndex: 'kredit',
                                sortable: false,
                                //                                flex:1,
                                width: 120,
                                align:'right',
                                format: '0,0'                                
                            }
                        ]
                        ,bbar:['->' ,
                            {   
                                xtype:'numericfield',
                                fieldLabel: 'Total Debet',
                                id: 'app_ej_t_debet',
                                currencySymbol: null,
                                useThousandSeparator: true,
                                thousandSeparator: ',',
                                alwaysDisplayDecimals: false,
                                fieldStyle: 'text-align: right;',
                                value:0,
                                hideTrigger: true,
                                readOnly:true
                            },
                            '-',
                            {
                                xtype:'numericfield',
                                fieldLabel: 'Total Kredit',
                                id: 'app_ej_t_kredit',
                                currencySymbol: null,
                                useThousandSeparator: true,
                                thousandSeparator: ',',
                                alwaysDisplayDecimals: false,
                                fieldStyle: 'text-align: right;',
                                value:0,
                                hideTrigger: true,
                                readOnly:true
                            }
                        ]
                                
                        
                    }
                ]
            },{
                xtype: 'panel',
                autoShow: true,                
                region: 'south',
                margins: '0 5 0 5',
                layout: 'fit',
                items:[
                    { xtype: 'toolbar',
                        height:40,
                        padding:'2 0 2 5',
                        items: ['->',{
                                xtype: 'button',
                                text: 'Approve',
                                iconCls: 'icon-approval'
                                ,handler:function(){
                                   var reccount=0;
                                    reccount=Ext.getCmp('grid_to_approval').getSelectionModel().getCount();
                                    if (reccount>0){
                                        var dr=Ext.getCmp('grid_to_approval').getSelectionModel().getSelection();
                                        var arr=new Array();
                                        for(var i=0;i<reccount;i++){
                                            arr.push(dr[i].data);
                                        }
                                        aprroval_ej_save(Ext.JSON.encode(arr),1);
                                    }else{
                                        set_message(2,'No Data Selected !!!');
                                        return;
                                    }         
                                }
                            },{
                                xtype: 'button',
                                text: 'Reject',
                                iconCls: 'icon-reject'
                                ,handler:function(){
                                    var reccount=0;
                                    reccount=Ext.getCmp('grid_to_approval').getSelectionModel().getCount();
                                    if (reccount>0){
                                        var dr=Ext.getCmp('grid_to_approval').getSelectionModel().getSelection();
                                        var arr=new Array();
                                        for(var i=0;i<reccount;i++){
                                            arr.push(dr[i].data);
                                        }
                                        aprroval_ej_save(Ext.JSON.encode(arr),2);
                                    }else{
                                        set_message(2,'No Data Selected !!!');
                                        return;
                                    }     

                                }
                            },{
                                xtype: 'button',
                                text: 'Cancel / Reset',
                                iconCls: 'icon-refresh',
                                handler:function(){
                                    japp_detail_store.removeAll();
                                    japp_store.reload();
                                }
                            }]
                    }
                ]
            }
           
        ],
        listeners:{
            afterrender:function(){
                japp_store.loadPage(1);
            },
            show:function(){
                japp_store.loadPage(1);
            }
        },
        initComponent: function() {
            this.callParent(arguments);
        }
            
    });
    
    function aprroval_ej_save(row,appstatus){
       Ext.Ajax.request({
           url: '<?php echo base_url(); ?>' +'entry_jurnal/approval_entryjurnal',
            method: 'POST',
            params: {
                status: appstatus,
                postdata: row
            },
            listeners:{
                requestexception:function( conn, response, options, eOpts ){
                    var err = Ext.util.JSON.decode(response.responseText);
                    console.log(response.responseText);
                    if (err.errMsg == 'Session Expired') {
                        session_expired(err.errMsg);
                    }
                }
            },
            success: function(obj) {
                var   resp = Ext.decode(obj.responseText);                                                                
                if(resp.success==true){
                    //                                                                    Ext.Msg.alert('info',resp.msg);
                    set_message(0,resp.msg);
                    Ext.getCmp('grid_detail_approval').getStore().loadPage(1); 
                    Ext.getCmp('grid_to_approval').getStore().reload();   
                    
                }else{
                    set_message(1,resp.msg);
                }
            },
            failure: function(obj) {
                var  resp = Ext.decode(obj.responseText);
                Ext.Msg.alert('info',resp.msg);
            }
        
       });
    }
        
</script>