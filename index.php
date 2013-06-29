<?php
?>


<html>
	<title>Movies</title>
	<head>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" href="extjs/examples/writer/writer.css" />
	<script type="text/javascript" src="extjs/examples/shared/include-ext.js"></script>
	<script type="text/javascript" src="extjs/examples/shared/options-toolbar.js"></script>
<script type="text/javascript">
Ext.onReady(function() 
{
	Ext.define('movie', {
    				extend: 'Ext.data.Model',
    				fields: [
						{name:'id', type: 'int'},
						{name:'title',type: 'string'}, 
						{name:'director',type: 'string'}, 
						{name:'released',type: 'string'},
						{name:'genre', type: 'int'},
						{name:'tagline',type:'string'}
					] } );
	
	var mystore = Ext.create('Ext.data.JsonStore', 
	{
		model: 'movie',
		autoSync: true,
		autoLoad: true,
		proxy: {
        			type: 'ajax',
        			api: {
                				read: 'db.php',
						update:'update.php',
						create: 'create.php',
						Delete:'delete.php',


           			     },        							     					reader: {
            					type: 'json',
						root: 'data'
        				},
				 writer:{
					 	encode: true,
        				  	writeAllFields: true,
						type: 'json',
					 	root: 'data'
					}
        		},
	});//store completed
	var grid = Ext.create('Ext.grid.Panel', 
	{
		style: 'margin-top: 1%; margin-left: 24%',
		store: mystore,
		id:'grid',
		width: 700,
		height: 300,
		title: 'Movie Details',
		collapsible: true,
		closable:true,
		maximizable: true,
		frame:true,
		dirty:false,
		draggable: true,
		stripedRows: true,
		columns: 
		[
			{header: 'MovieName', width: 100, sortable: true, dataIndex: 'title',editor:{xtype:  'textfield',allowBlank:false} },
			{header: 'Director Name', width: 100, sortable: true, dataIndex: 'director',editor: 'textfield',allowBlank:false},
	{header: 'Released Date', width: 150, sortable: true, dataIndex: 'released',editor: 'datefield'},
{header:'Genre', width:150, sortable:true, dataIndex:'genre',editor:'numberfield',},
			{header: 'Tagline', width: 200, sortable: true, dataIndex: 'tagline',editor: 'textfield'},				 
		],
		plugins: 
		[
        		Ext.create('Ext.grid.plugin.CellEditing',
				{
          				clicksToEdit: 2,       				
				})
    		],				
            dockedItems: 
		[{
                	xtype: 'toolbar',
                	items: [
				{
                    			iconCls: 'icon-add',
                    			text: 'Add',
					scope: this,
                    			handler:function()
						{
	
//this.cellEditing.startEditByPosition({row: 0, column: 0});
						mystore.insert(0,{id:'yourid',title:'new movie',director:'director',released:'',genre:'0',tagline:'yourtagline'});
						Ext.Ajax.request({
						url:'insert.php',
						method: 'POST',					
						failure: function(f,a)
						{
								//Ext.Msg.alert('row failure');
						},
						success: function(f,a)
						{
						Ext.Msg.alert('row Added successfully');
						mystore.load(); 
						}
						
					});
					         },
               		 	}, 
				{
                    			iconCls: 'icon-delete',
					text: 'Delete',
                    			itemId: 'delete',
					handler: function()
					{
                    			var selection = grid.getView().getSelectionModel().getSelection()[0];
				var did=grid.getView().getSelectionModel().getSelection()[0].get('id');
					if (selection)
					{
						Ext.Ajax.request({
						url:'delete.php',
						params: 'did=' +did ,	
						method: 'POST',

						});
                        				mystore.remove(selection);
                    			}
                    			
                			}
					
                                 },
				{
					iconCls: 'icon-save',
					text: 'Update',
                    			itemId: 'update',
					handler : function() {
						var grid = Ext.getCmp('grid');
				var id=grid.getView().getSelectionModel().getSelection()[0].get('id');
				var title=grid.getView().getSelectionModel().getSelection()[0].get('title');
			var director=grid.getView().getSelectionModel().getSelection()[0].get('director');
var released=grid.getView().getSelectionModel().getSelection()[0].get('released');
	var genre=grid.getView().getSelectionModel().getSelection()[0].get('genre');
	var tagline=grid.getView().getSelectionModel().getSelection()[0].get('tagline');
	if(id == '' && title == '' && relased == '')
	{
		Ext.Msg.alert('fill blank fields');

	}
	else
	{
	var data = 'id=' + id + '&title=' + title + '&director=' + director + '&released=' + released + '&genre=' +genre+ '&tagline='+tagline;
					Ext.Ajax.request({
						url:'update.php',
						params: data ,	
						method: 'GET',
						failure: function(f,a)
						{
								Ext.Msg.alert('data cannot be Saved');
						},
						success: function(f,a)
						{
						Ext.Msg.alert('data has been Saved');
						//mystore.load(); 
						 //grid.mystore.load();
						//grid.mystore.reload();
						Ext.getCmp('grid').getView().refresh(); 
						}
						
						});
	}

					}
			}

                		
                	],
        
		}]
					
	});
				mystore.load(); 
				grid.render('table')
			
}); 

		
	</script>

	<style>
		.inputbox {
			width:100px !important;
		}
		input {
			width:100px !important;
		}
		.x-grid-dirty-cell 
		{
  background: none;
}
	</style>

	</head>
	<body>
	<div id='table'> </div>
	</body>
</html>
