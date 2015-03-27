<?php
//if (!defined('BASEPATH'))
//    exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('masteraccount');
$this->load->view('masterkelompokaccount');

?>
<script type="text/javascript" language="javascript">
    //    Ext.require(['*']);
    Ext.onReady(function() {
        var treedata = new Ext.data.TreeStore({
            root: {
                expanded: true
            },
            proxy: {
                type: 'ajax',
                url: '<?php echo base_url(); ?>' + 'main/getMainMenu'
            }
        });
        function addTab(vid,vtitle,vhtml){
            var tabs=Ext.getCmp('id_tabmain');
            var tm=null;
                  
            var widgetname="Tab" + vtitle.toString().replace(" ","");
            try{
                console.log('sampai sini');
                tm=Ext.createWidget(widgetname);     
                tabs.add(tm); 
                tm.show();                 
                
            }catch(ex){                
                tabs.add({
                id: vid,
                title: vtitle,                
                //                                iconCls: 'tabs',
                html: vhtml ,
//                items:[tabchilds],
                closable: true
            }).show();
            }  
//            var tc=Ext.createWidget(widgetname); 
//            console.log(widgetname);
//          var tabchilds=Ext.getCmp(vid);        
//            if (tabchilds == null){
//            
//                tabs.add({
//                id: vid,
//                title: vtitle,                
//                //                                iconCls: 'tabs',
//                html: vhtml ,
////                items:[tabchilds],
//                closable: true
//            }).show();
//                
//            }else{                   
//                
//                tabs.add(tm);
//                tm.show();
//            }
            
        }
        var treePanel = new Ext.tree.Panel({
            id: 'id_treepanel',
            //title: 'Sample Layouts',
            region:'north',
            split: true,
            border:false,
            //        height: 360,
            height:'auto',
            minSize: 150,
            rootVisible: false,
            autoScroll: true,
            store: treedata,
            listeners: {
                itemclick:function(view,rec,item,index,eventObj){        
                    if(rec.get('leaf')){
                        var tabid='tab' + rec.getId();
                        var tabs=Ext.getCmp('id_tabmain');
                        console.log(tabid);
                        if (tabs.getComponent(tabid)==null){
                            //                            this.addTab(rec.getId(),true);
                            var vhtml='Tab Body ' + rec.get('text');
                            addTab(tabid,rec.get('text'),vhtml );
                        }else{
                            var tabget=tabs.getComponent(tabid);
                            tabget.show();
                            //                tabs.setActiveTab(tabid)
                        }
                    }
               
          

                }
            }
        });
    
        var tabMain= new Ext.tab.Panel({
            id: 'id_tabmain',
            width: '100%',
            //            border:false,
            enableTabScroll: true,
            defaults: {
                autoScroll:true,
                bodyPadding: 2
            }
            ,
            items: [
                {
                    title: 'Home',
                    //            iconCls: 'tabs',
                    html:  '<div id="start-div">'+
                        '<div style="float:left;" ><img src="iconcss/logo.jpg" /></div>'+
                        '<div style="margin-left:100px; padding-left:10px;">'+
                        '    <h2>Welcome!</h2>'+
                        '    <p>There are many sample layouts to choose from that should give you a good head start in building your own'+
                        '    application layout.  Just like the combination examples, you can mix and match most layouts as'+
                        '    needed, so dont be afraid to experiment!</p>'+
                        '    <p>Select a layout from the tree to the left to begin.</p>'+
                        '</div>'+
                        '</div>' ,
                    closable: false
                }
            ]
            ,plugins: Ext.create('Ext.ux.TabCloseMenu', {
//                    extraItemsTail: [
//                '-',
//                {
//                    text: 'Closable',
//                    checked: true,
//                    hideOnClick: true,
//                    handler: function (item) {
//                        currentItem.tab.setClosable(item.checked);
//                    }
//                }
//            ],
//            listeners: {
//                aftermenu: function () {
//                    currentItem = null;
//                },
//                beforemenu: function (menu, item) {
//                    var menuitem = menu.child('*[text="Closable"]');
//                    currentItem = item;
//                    menuitem.setChecked(item.closable);
//                }
//            }
            })
            
        });
    
        var viewport = new Ext.Viewport({
            layout: {
                type: 'border',
                padding: 5
            },
            defaults: {
                split: true
            },
            items: [{
                    region: 'north',
                    collapsible: false,
                    //            title: 'North',
                    split: false,
                    height: 60,
                    minHeight: 40,
                    html: 'north'
                },{
                    region: 'west',
                    collapsible: true,
                    title: 'Main Menu',
                    split: true,
                    width: '20%',
                    minWidth: 100,
                    minHeight: 140,
                    items:[treePanel]
                    //            html: 'west<br>I am floatable'
                },{
                    region: 'center',
                    border: false,
                    layout: 'border',
                    //                    html: 'center center',
                    //                    title: 'Center',
                    minHeight: 140,                    
                    items: [
                        {
                            xtype   : 'container',
                            region  : 'center',
                            layout  : 'fit',
                            items   : [tabMain]}
                    ]
                    //            bbar: []
                },{
                    region: 'east',
                    collapsible: true,
                    floatable: true,
                    split: true,
                    width: 200,
                    minWidth: 120,
                    minHeight: 140,
                    title: 'East',
                    layout: {
                        type: 'vbox',
                        padding: 5,
                        align: 'stretch'
                    },
                    items: [{
                            xtype: 'textfield',
                            labelWidth: 70,
                            fieldLabel: 'Text field'
                        }, {
                            xtype: 'component',
                            html: 'I am floatable'
                        }]
                }
            ]
            //        ,
            //        listeners:
            //            {
            //            render:function(){
            //                treedata.load();
            //            }
            //            }
        });
    });
</script>
</head>
<body>
    <!--        <h1>Welcome to CodeIgniter!</h1>-->
    <?php
    // put your code here
    ?>
</body>
</html>
