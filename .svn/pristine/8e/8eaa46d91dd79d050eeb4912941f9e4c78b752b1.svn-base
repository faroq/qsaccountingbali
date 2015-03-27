<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>
            <?php echo $this->config->item('app_title'); ?>
        </title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/extjs/resources/ext-theme-gray/ext-theme-gray-all.css'); ?>">
            
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/style/mainstyle.css'); ?>">            
        <script type="text/javascript" src="<?php echo base_url('assets/extjs/ext-all.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/extjs/ux/TabCloseMenu.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/extjs/ux/SlidingPager.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('assets/extjs/ux/form/SearchField.js'); ?>"></script>
        
        <script type="text/javascript">
            var STARTPAGE = 0;
            var ENDPAGE = <?= $this->config->item('length_records') ?>;
            var required_css = '<span style="color:red;font-weight:bold" data-qtip="Required">*</span>';
//            var BASE_ICONS = BASE_PATH + 'assets/icons/';
            function session_expired(err){
                Ext.Msg.show({
                    title: 'Error',
                    msg: err,
                    modal: true,
                    closable: false,
                    icon: Ext.Msg.ERROR,
                    buttons: Ext.Msg.OK,
                    fn: function(btn){
                        if (btn == 'ok') {
                            window.location = '<?= site_url("auth/login") ?>';
                        }
                    }
                });
            }	
            function set_message(opt,vmsg){
                if (opt==0){
                    Ext.Msg.show({
                    title:'Message Info',
                    msg: vmsg,
                    buttons: Ext.Msg.OK,
                    icon: Ext.Msg.INFO
                    });
                }else if (opt==1){
                    Ext.Msg.show({
                    title:'Message Error',
                    msg: vmsg,
                    buttons: Ext.Msg.OK,
                    icon: Ext.Msg.ERROR
                    });
                }else if (opt==2){
                    Ext.Msg.show({
                    title:'Message Warning',
                    msg: vmsg,
                    buttons: Ext.Msg.OK,
                    icon: Ext.Msg.WARNING
                    });
                }
                    
            }
            
        </script>
        
    

        
        
        
        
        
        
        