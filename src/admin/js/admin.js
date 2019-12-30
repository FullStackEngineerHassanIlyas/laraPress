$ = jQuery.noConflict();
function ajaxForm(form, options = {}, callback) {
	let cb = $(form).data('cb');
	if (options.beforeSubmit === undefined) {
		options.beforeSubmit = function(arr, form, options) {
			let inputVal = form.find('[type=submit]').val();
			$(form).find('[type=submit]').val('Please Wait...').html('Please Wait...').prop('disabled', true).data('val', inputVal);
		}
	}
	if (options.success === undefined) {
		options.success = function(res, status, xhr, form) {
			let input = $(form).find('[type=submit]');
			$(form).find('[type=submit]').val(input.data('val')).html(input.data('val')).prop('disabled', false);
			if (callback !== undefined && typeof callback == 'function') {
				callback(res, form);
			}
			if (window[cb] !== undefined && typeof window[cb] == 'function') {
				window[cb](res, form);
			}
		}
	}
	if (options.error === undefined) {
		options.error = function(res) {
			let input = $(form).find('[type=submit]');
			$(form).find('[type=submit]').val(input.data('val')).html(input.data('val')).prop('disabled', false);
			if (callback !== undefined && typeof callback == 'function') {
				callback(res, form);
			}
			if (window[cb] !== undefined && typeof window[cb] == 'function') {
				window[cb](res, form);
			}
		}
	}
	$(form).ajaxForm(options);
}

function ajax_cb(res, form) {
	res = JSON.parse(res);
	console.log(res);
}
$(function() {
	ajaxForm('[data-form="ajax"]');
});