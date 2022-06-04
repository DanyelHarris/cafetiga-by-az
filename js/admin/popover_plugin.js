(function() {
    tinymce.PluginManager.add('popover_mce_button', function(editor, url) {
        editor.addButton('popover_mce_button', {
            image: url + '/mce-img/pop.png',
            title: 'Popover Shortcode',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Insert Popover',
                    body: [{
                        type: 'textbox',
                        name: 'textboxpopoverName',
                        label: 'Popover Title',
                        value: ''
                    }, {
                        type: 'textbox',
                        name: 'textboxpopoverContent',
                        label: 'Popover Content',
                        value: '',
						multiline: true,
						minWidth: 300,
						minHeight: 100
                    },{
                        type: 'listbox',
                        name: 'triggerName',
                        label: 'Trigger',
                        values: [{
                            text: 'Click',
                            value: 'click'
                        }, {
                            text: 'Hover',
                            value: 'hover'
                        }]
                    },{
                        type: 'listbox',
                        name: 'placementName',
                        label: 'Position',
                        values: [{
                            text: 'Top Popover',
                            value: 'top'
                        }, {
                            text: 'Left Popover',
                            value: 'left'
                        }, {
                            text: 'Right Popover',
                            value: 'right'
                        }, {
                            text: 'Bottom Popover',
                            value: 'bottom'
                        }]
                    }, ],
                    onsubmit: function(e) {
                        editor.insertContent(
                            '[popover placement="' +
                            e.data.placementName +
                            '" title="' +
                            e.data.textboxpopoverName +
                            '" trigger="' +
                            e.data.triggerName +
                            '" content="' +
                            e.data.textboxpopoverContent +
                            '"]' +
                            editor.selection
                            .getContent() +
                            '[/popover]'
                        );
                    }
                });
            }
        });
    });
})();