/**
 *
 * This is support code for the Admin pages of the O2s\Users package
 * 
 */

$(document).read(function () {
	o2suser.init();
});

var o2suser = {
	init: function () {
		// Initialize the event handlers
		
		// Delete a user
		$('#btnRemove').on('click', function (e) {
            e.preventDefault();
            var msg = "Please confirm you mean to remove the current user.";
            if (confirm(msg)) {
                $('input[name=_method]').val('DELETE');
                $('form').submit();
            }
            return false;
        });
	}
};


