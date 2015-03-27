<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript">

    

    Ext.define('export_grid', {
        extend: 'Ext.grid.Panel',
        xtype: 'export_grid',
        alias: 'widget.export_grid',
        id:'testexport_grid',
        title: 'Export GRID',
        region:'north',
//                uses: ['Ext.ux.exporter.Exporter'
//                ],

        initComponent: function() {
            this.store = userset_store;

            this.dockedItems = [{
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [
                        {
                            xtype: 'exportbutton',
                            component:Ext.getCmp('testexport_grid')
                            
                        }
                    ]
                }];
        
            this.columns = [{
                    header:'User ID',
                    dataIndex:'user_id',
                    sortable: true,
                    width: 100
                },{
                    header:'Password',
                    dataIndex:'user_password',
                    sortable: true,
                    width: 200
                },{
                    header:'Role ID',
                    dataIndex:'role_id',
                    sortable: true,
                    width: 50
                },{
                    header:'Role Name',
                    dataIndex:'role_name',
                    sortable: true,
                    width: 200
                },{
                    xtype:'checkcolumn',
                    header:'Active',
                    dataIndex:'aktif',
                    sortable: false,
                    width: 50,
                    disabled:false}];
            this.callParent(arguments);
        }
    });

    Ext.define('MyTabTestExport',
    {
        extend: 'Ext.container.Container',
        xtype: 'TabTestExport',
        alias: 'widget.TestExport',
        title: 'Test Export',
        id: 'tab2c',
        closable: true,        
        layout: 'border',
        items: [
            {
                xtype: 'panel',
                autoShow: true,
                id: 'testexport_panel',
                region: 'center',
                margins: '5 5 5 5',
                layout: 'border',
                items:[
                    {
                        xtype:'export_grid',
//                        id:'testexport_grid',
//                        store: userset_store
                        
                    },
                    //                    {
                    //                        xtype:'grid',
                    //                        region:'center',                           
                    //                        id:'testexport_grid',
                    //                        //                        width:450,
                    //                        store: userset_store,
                    //                        stripeRows: true,
                    //                        loadMask: true,
                    //                        stateful:true,
                    //                        stateId:'stateGrid'                        
                    //                        ,columns:[{
                    //                                header:'User ID',
                    //                                dataIndex:'user_id',
                    //                                sortable: true,
                    //                                width: 100
                    //                            },{
                    //                                header:'Password',
                    //                                dataIndex:'user_password',
                    //                                sortable: true,
                    //                                width: 200
                    //                            },{
                    //                                header:'Role ID',
                    //                                dataIndex:'role_id',
                    //                                sortable: true,
                    //                                width: 50
                    //                            },{
                    //                                header:'Role Name',
                    //                                dataIndex:'role_name',
                    //                                sortable: true,
                    //                                width: 200
                    //                            },{
                    //                                xtype:'checkcolumn',
                    //                                header:'Active',
                    //                                dataIndex:'aktif',
                    //                                sortable: false,
                    //                                width: 50,
                    //                                disabled:false}
                    //                        ],
                    //                        tbar:{
                    //                            xtype: 'toolbar',
                    //                            items: [{
                    //                                    xtype: 'button',
                    //                                    text: 'Add',
                    //                                    iconCls: 'icons-add'}]
                    //                        }
                    //                    }
                ]
            }
        ],
        listeners:{
            show:function(){
                var storegrid=Ext.getCmp('testexport_grid').store;
                storegrid.load();
            }
        }
    });
</script>
