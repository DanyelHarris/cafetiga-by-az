(function() {
    tinymce.PluginManager.add('map_mce_button', function(editor, url) {
        editor.addButton('map_mce_button', {
			image: url + '/mce-img/locator.png',
            title: 'Map Shortcode',
            onclick: function() {
                editor.windowManager.open({
                    title: 'Insert Shortcode',
                    body: [{
                        type: 'label',
                        label: 'Location Map',
                    }],
                    onsubmit: function(e) {
                        editor.insertContent('[store_map]');
					}
                });
            }
        });
    });
})();