Ext.define('Ext.ux.form.TwinCombo', {
    extend: 'Ext.form.field.Trigger',
    alias: 'widget.twincombo',
    trigger1Cls: Ext.baseCSSPrefix + 'form-search-trigger',
    hasSearch : false,
    paramName : 'query',
    menuSearch: null,    
    initComponent: function() {
        var me = this;        
        me.callParent(arguments);       
    },
    afterRender: function(){
        this.callParent();
        this.triggerCell.item(0).setDisplayed(true);        
    },
    onTrigger1Click : function(){
        var me = this;
            me.setValue('');
            me.store.load();
            var winmenu=Ext.create(me.menu);
            winmenu.showAt([this.getPosition()[0], this.getPosition()[1] + this.getHeight()]);

    }
});