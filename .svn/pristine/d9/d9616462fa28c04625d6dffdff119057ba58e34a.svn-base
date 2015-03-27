<?php
//if (!defined('BASEPATH'))
//    exit('No direct script access allowed');
$this->load->view('header');
$this->load->view('global_reference_store');
$this->load->view('masteraccount');
$this->load->view('masterkelompokaccount');
$this->load->view('journalmonitor');
$this->load->view('entryjurnal');
$this->load->view('journalapproval');
$this->load->view('generalledger');
$this->load->view('trialbalance');
$this->load->view('incomestatement');
$this->load->view('balancesheet');
$this->load->view('masterpostingaccount');
$this->load->view('masterpostingbiaya');
$this->load->view('userman/userman');
?>
<script type="text/javascript" language="javascript">
    //    Ext.require(['*']);
    Ext.onReady(function() {
        Ext.apply(Ext.form.field.VTypes, {
            daterange: function(val, field) {
                var date = field.parseDate(val);

                if (!date) {
                    return false;
                }
                if (field.startDateField && (!this.dateRangeMax || (date.getTime() != this.dateRangeMax.getTime()))) {
                    var start = field.up('form').down('#' + field.startDateField);
                    start.setMaxValue(date);
                    start.validate();
                    this.dateRangeMax = date;
                }
                else if (field.endDateField && (!this.dateRangeMin || (date.getTime() != this.dateRangeMin.getTime()))) {
                    var end = field.up('form').down('#' + field.endDateField);
                    end.setMinValue(date);
                    end.validate();
                    this.dateRangeMin = date;
                }
                /*
                 * Always return true since we're only using this vtype to set the
                 * min/max allowed values (these are tested for after the vtype test)
                 */
                return true;
            },

            daterangeText: 'Start date must be less than end date',

            password: function(val, field) {
                if (field.initialPassField) {
                    var pwd = field.up('form').down('#' + field.initialPassField);
                    return (val == pwd.getValue());
                }
                return true;
            },

            passwordText: 'Passwords do not match'
        });
        //        Ext.util.Format.thousandSeparator = ',';
        //        Ext.util.Format.decimalSeparator = '.';
        //        var required = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>'
        var treedata = new Ext.data.TreeStore({
            root: {
                expanded: true
            },
            proxy: {
                type: 'ajax',
                url: '<?php echo base_url(); ?>' + 'main/getMainMenu?roleid=' + '<?php echo $roleid; ?>'
            }
        });
        function addTab(vid,vtitle,vhtml){
            var tabs=Ext.getCmp('id_tabmain');
            var tm=null;
                  
            var widgetname="Tab" + vtitle.toString().replace( /\s/g, '' );
            try{
                console.log(widgetname);
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
                type: 'border'
                //                padding: 5
            },
            defaults: {
                split: true
            },
            items: [{
                    region: 'north',
                    //                    xtype:'box',
                    collapsible: false,
                    //            title: 'North',
                    //                    border:false,
                    id:'header-north',
                    //                    style: 'background: blue;',
                    cls:'header-north',
                    //                    margins: '2 2 0 2',
                    split: false,
                    height: 70,
                    minHeight: 40,
                    html: '<div id="header-north"><img src="'+'<?php echo base_url(); ?>'+'/assets/images/bgheader.png" class="stretch" alt="" /></div>'
                    //                    ,bbar:
                }
                ,{
                    region: 'west',
                    collapsible: true,
                    title: 'Main Menu',
                    split: true,
                    width: '20%',
                    minWidth: 100,
                    minHeight: 140,
                    margins: '2 0 5 5',
                    items:[treePanel]
                    //            html: 'west<br>I am floatable'
                },{
                    region: 'center',
                    border: false,
                    layout: 'border',
                    //                    html: 'center center',
                    //                    title: 'Center',
                    minHeight: 140,      
                    margins: '2 5 5 0',
                    items: [
                        {
                            //                           
                            region: 'north',
                            xtype: 'toolbar',                           
                            //                            cls:'my_toolbar',                            //                           
                            items: ['->',
                                {
                                        
                                    xtype:'label',  
                                    //                                    cls:'label-color',
                                    html: 'Welcome <b><?= strtoupper($username) ?></b>, you are login as a <b><?= ucwords(strtolower($rolename)) ?></b>&nbsp;&nbsp;'
                                },'-',' '
                                ,{
                                    text:'<b>Change Password</b>',
                                    scope:this,
                                    cls:'log_out',
                                    iconCls: 'icon-key'
                                    ,handler: do_update_pwd
                                },'-',' '
                                ,{
                                    text:'<b>Logout</b>',
                                    scope:this,
                                    cls:'log_out',
                                    iconCls: 'icon-delete'
                                    ,handler: doLogout
                                },' '                                    
                            ]
                        },
                        {
                            xtype   : 'container',
                            region  : 'center',
                            layout  : 'fit',
                            items   : [tabMain]}
                    ]
                    //            bbar: []
                },
        
                {
                    id      : 'appFooter',
                    xtype   : 'box',
                    region  : 'south',
                    height  : 20,
                    split: false,
                    html    : '<center>Develop By PT. Solusi Informatika Semesta</center>'
                }
                //                ,{
                //                    region: 'east',
                //                    collapsible: true,
                //                    floatable: true,
                //                    split: true,
                //                    width: 200,
                //                    minWidth: 120,
                //                    minHeight: 140,
                //                    title: 'East',
                //                    layout: {
                //                        type: 'vbox',
                //                        padding: 5,
                //                        align: 'stretch'
                //                    },
                //                    items: [{
                //                            xtype: 'textfield',
                //                            labelWidth: 70,
                //                            fieldLabel: 'Text field'
                //                        }, {
                //                            xtype: 'component',
                //                            html: 'I am floatable'
                //                        }]
                //                }
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
    
    function doLogout(){
        Ext.Msg.show({
            title: 'Konfirmasi',
            msg: 'Are you sure to Logout?',
            buttons: Ext.Msg.YESNO,
            icon: Ext.Msg.QUESTION,
            fn: function(btn){
                if (btn == 'yes') {
                    Ext.Ajax.request({
                        url: '<?= site_url("auth/logout") ?>',
                        method: 'POST',
                        success: function(xhr){
                            window.location = '<?= site_url("auth/login") ?>';
                        }
                    });
                }
            }
        });
            
    }
    function do_update_pwd(){
        var winuppwd=Ext.create('update_password_win');
        var param_user_id= '<?= $username ?>';
        Ext.getCmp('update_user_id').setValue(param_user_id);    
//        Ext.getCmp('update_lama_password').setValue(rec.get('user_id'));
        winuppwd.show();
    }
</script>
</head>
<body>
    <!--        <h1>Welcome to CodeIgniter!</h1>-->
    <?php
    // put your code here
    ?>
</body>
</html>
