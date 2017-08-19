CKEDITOR.dialog.add('more', function(editor) {
	return {
		title : 'Создать раскрывающийся блок',
		minWidth : 400,
		minHeight : 200,
		onOk: function() {
			var cuttext = this.getContentElement('more', 'cuttext').getInputElement().getValue();
			var cutsize = this.getContentElement('more', 'cutsize').getInputElement().getValue();
			var selectedText = editor.getSelectedHtml();

			this._.editor.insertHtml('<div class="ckmore" title="'+ cuttext +'" rel="' + cutsize + '">' + selectedText + '</more>');
		},
		contents : [{
			id : 'more',
			label : 'First Tab',
			title : 'First Tab',
			elements : [{
				id : 'cuttext',
				type : 'text',
				label : 'Текст ссылки'
			}, {
				id : 'cutsize',
				type : 'text',
				label : 'Количество символов'
			}
			]
		}]
	};
});

