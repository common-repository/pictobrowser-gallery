/**
 * @author Mathias Krueger
 * @copyright Copyright © 2009, Mathias Krueger, All rights reserved, License: GPL.
 */

(function() {
	tinymce.PluginManager.requireLangPack('pictoBrowser');

	tinymce.create('tinymce.plugins.PictoBrowser', {
		init : function(ed, url) {
			ed.addCommand('mcePictoBrowser', function() {
				ed.windowManager.open({
					file : url + '/dialog.htm',
					width : 600,
					height : 390,
					inline : 1
				}, {});
			});

			ed.addButton('pictoBrowser', {
				title : 'add a Flickr/Picasa gallery',
				cmd : 'mcePictoBrowser',
				image : url + '/img/pb_flickr.png'
			});

			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('pictoBrowser', n.nodeName == 'IMG');
			});
		},

		createControl : function(n, cm) {
			return null;
		},

		getInfo : function() {
			return {
				longname : "PictoBrowser",
				author : 'Mathias Krueger',
				authorurl : 'http://blog.endlich-wochenen.de/',
				infourl : 'http://blog.endlich-wochenen.de/?p=343',
				version : "0.3.1"
			};
		}
	});

	tinymce.PluginManager.add('pictoBrowser', tinymce.plugins.PictoBrowser);
})();