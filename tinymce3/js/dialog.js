tinyMCEPopup.requireLangPack();

var PictobrowserDialog = {
	init : function() {
	},

	insert : function() {
		var f = document.forms[0];
		var options = "";
		
        for (i = 0; i < 2; i++)
        {
            if (f.platform[i].checked) {
                options += " type=\"" + f.platform[i].value + "\"";
            }
        }
		
		if (f.user_id.value != "") {
			options += " userID=\"" + f.user_id.value + "\"";
		}
        
        options += " albumID=\"" + f.album_id.value + "\"";
		
		var result = "[pictobrowser" + options + "]";

		tinyMCEPopup.editor.execCommand('mceInsertContent', false, result);
		tinyMCEPopup.close();
	}
};

tinyMCEPopup.onInit.add(PictobrowserDialog.init, PictobrowserDialog);
