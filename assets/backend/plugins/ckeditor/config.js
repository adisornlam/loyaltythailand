/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
 var protocol = window.location.protocol;
 var base_url_cke = protocol + "//" + document.location.hostname + "/loyaltythailand/assets/backend/plugins/ckeditor/";

 CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
	{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
	{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
	{ name: 'links' },
	{ name: 'insert' },
	{ name: 'forms' },
	{ name: 'tools' },
	{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
	{ name: 'others' },
	'/',
	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	{ name: 'styles' },
	{ name: 'colors' },
	{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	config.height = '400px';
	config.filebrowserBrowseUrl = base_url_cke + 'filemanager/index.html';
	config.filebrowserImageBrowseUrl = base_url_cke + 'filemanager/index.html?Type=Images';
	config.filebrowserFlashBrowseUrl = base_url_cke + 'filemanager/index.html?Type=Flash';
	config.filebrowserUploadUrl = base_url_cke + 'filemanager/connectors/ashx/filemanager.ashx?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = base_url_cke + 'filemanager/connectors/ashx/filemanager.ashx?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = base_url_cke + 'filemanager/connectors/ashx/filemanager.ashx?command=QuickUpload&type=Flash';
	config.allowedContent = true;
    // ALLOW <i></i>
    config.protectedSource.push(/<i[^>]*><\/i>/g);
};
