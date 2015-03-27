/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Ext.Loader.setPath('Ext.ux', 'assets/extjs/ux');
//Ext.Loader.setPath('Ext.ux.exporter', 'extjs/ux/exporter/excelFormatter');
Ext.define('Ext.ux.grid.GridExporter', {
    extend:'Ext.grid.Panel',
    alias: 'widget.gridexporter',
    width: 1000,
    autoHeight: true,
    downloadName: "download",
//    uses:[
//        "Ext.ux.exporter.Base64",
////        "Ext.excel.Cell",
////        "Ext.excel.Style",
////        "Ext.excel.Worksheet",
////        "Ext.excel.Workbook",
////        'Ext.excel.ExcelFormatter'
//    ],
    constructor : function (config) {
        var me = this;
        
        config = config || {};
        Ext.apply(me, config);
        me.callParent(arguments);
    }
    ,getFormatterByName: function(formatter) {
            formatter = formatter ? formatter : "excel";
            formatter = !Ext.isString(formatter) ? formatter : Ext.create("Ext.ux.exporter." + formatter + "Formatter." + Ext.String.capitalize(formatter) + "Formatter");
            return formatter;
        },
    exportGrid:function(grid, formatter, config) {
          config = config || {};
          formatter = this.getFormatterByName('excel');

          var columns = Ext.Array.filter(grid.columns, function(col) {
              return !col.hidden; // && (!col.xtype || col.xtype != "actioncolumn");
          });

          Ext.applyIf(config, {
            title  : grid.title,
            columns: columns
          });
      
//        Ext.ux.exporter.Base64
          return 'data:application/vnd.ms-excel;base64,' + Base64.statics.encode(formatter.format(grid.store, config));
        }
//        ,
//    setDownload:function(){
//        Downloadify.create(this.el.down('p').id,{
//            filename: function() {
//              return this.getDownloadName() + "." + this.getFormatterByName('excel').extension;
//            },
//            data: function() {
//              return this.exportGrid(this, 'excel',this.config);
//            }
//            ,
//            transparent: false,
//            swf: this.getSwfPath(),
//            downloadImage: this.getDownloadImage(),
//            width: this.getWidth(),
//            height: this.getHeight(),
//            transparent: true,
//            append: false
//        });
//    }
    
});

