
CKEDITOR.editorConfig = function( config )
{
	config.forcePasteAsPlainText = true;
	// Define changes to default configuration here. For example:

	config.language = 'pt-br';
    config.uiColor = '#dfdfdf';

	// A CONFIGURAÇÃO DO TEXTO, FUNDO, ETC ESTA NO ARQUIVO CONTENTS.CSS

    config.filebrowserBrowseUrl = 'editor/ckfinder/ckfinder.html',
    config.filebrowserImageBrowseUrl = 'editor/ckfinder/ckfinder.html?type=Images',
    config.filebrowserFlashBrowseUrl = 'editor/ckfinder/ckfinder.html?type=Flash',
    config.filebrowserUploadUrl = 'editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&amp;type=Files',
    config.filebrowserImageUploadUrl = 'editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&amp;type=Images',
    config.filebrowserFlashUploadUrl = 'editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&amp;type=Flash'

	// A CONFIGURAÇÃO DO TEXTO, FUNDO, ETC ESTA NO ARQUIVO CONTENTS.CSS

	config.toolbar = 'MyToolbar';
	config.toolbar_MyToolbar =
	[
		//{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
		{ name: 'document', items : [ 'Source'] },

		//{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'clipboard', items : [ 'Paste','PasteText','PasteFromWord',] },
		
		//{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
		//{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },

		//{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
		//{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
		//'/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
		
		
		//{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
		
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		
		//{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
		
		'/',
		{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','-','Templates'] },
		//{ name: 'tools', items : [ 'Maximize', 'ShowBlocks','-','About' ] }
	];



};

