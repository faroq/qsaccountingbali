<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
?>

<script type="text/javascript" language="javascript">

    var mst_account_kel_jenis_store = Ext.create('Ext.data.Store',{
        autoLoad	: true,
        autoSync	: false,
        storeId		: 'mst_account_kel_jenis_store',
        fields: [
            'jenis','nama_jenis'
        ],
        proxy		: {
            type: 'ajax',
            api: {

                read    : '<?php echo base_url(); ?>' + 'global_reference/get_jenis'

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

    var mst_account_kel_dk_store = Ext.create('Ext.data.Store',{
        autoLoad	: true,
        autoSync	: false,
        storeId		: 'mst_account_kel_dk_store',
        fields: [
            'dk','default'
        ],
        proxy		: {
            type: 'ajax',
            api: {

                read    : '<?php echo base_url(); ?>' + 'global_reference/get_dk'

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

    var mst_account_store = Ext.create('Ext.data.Store',{
        autoLoad	: true,
        autoSync	: false,
        storeId		: 'mst_account_store',
        fields: [
            'rekening','nama_rekening'
        ],
        proxy		: {
            type: 'ajax',
            api: {

                read    : '<?php echo base_url(); ?>' + 'global_reference/get_mst_account'

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
</script>