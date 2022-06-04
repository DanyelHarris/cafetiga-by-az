(function() {
    tinymce.PluginManager.add('custom_mce_button', function(editor, url) {
        editor.addButton('custom_mce_button', {
            image: url + '/mce-img/tooltip.png',
            title: 'Tooltip Shortcode',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Insert Tooltip',
                    body: [{
                        type: 'textbox',
                        name: 'textboxtooltipName',
                        label: 'Tooltip Text',
                        value: ''
                    }, {
                        type: 'listbox',
                        name: 'placementName',
                        label: 'Position',
                        values: [{
                            text: 'Top Tooltip',
                            value: 'top'
                        }, {
                            text: 'Left Tooltip',
                            value: 'left'
                        }, {
                            text: 'Right Tooltip',
                            value: 'right'
                        }, {
                            text: 'Bottom Tooltip',
                            value: 'bottom'
                        }]
                    }, ],
                    onsubmit: function(e) {
                        editor.insertContent(
                            '[tooltip placement="' +
                            e.data.placementName +
                            '" title="' +
                            e.data.textboxtooltipName +
                            '"]' +
                            editor.selection
                            .getContent() +
                            '[/tooltip]'
                        );
                    }
                });
            }
        });
    });
})();