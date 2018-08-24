/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */


CKEDITOR.editorConfig = function( config ) {
	config.language = 'zh';
	config.uiColor = '#DEE2E5';
	config.height = 300;

	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
	];

	config.extraPlugins = 'youtube';
	config.youtube_responsive = true;
	config.removeButtons = 'About,ShowBlocks,Form,Checkbox,TextField,ImageButton,HiddenField,Select,Textarea,Radio,CreateDiv,BidiLtr,BidiRtl,Language,Flash,PageBreak,SpecialChar,Format,Font,Button,Scayt,SelectAll,Save,NewPage,Preview,Print';
		// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
	config.height='30em';
	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
		//開啟圖片上傳功能
	config.filebrowserBrowseUrl = 'plug/CKEdit/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = 'plug/CKEdit/ckfinder/ckfinder.html?Type=Images';
	config.filebrowserFlashBrowseUrl = 'plug/CKEdit/ckfinder/ckfinder.html?Type=Flash';
	config.filebrowserUploadUrl = 'plug/CKEdit/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = 'plug/CKEdit/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = 'plug/CKEdit/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';

};