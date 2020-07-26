function validateField(field) {
	// let str = $('.login').attr('name')
	let obj = '.' + field
	let data = [
		{
			name: $(field).attr('name'),
			value: $(field).val()
		}
	]
	console.log(data)
	$.ajax({
		url: '/api/validation/user',
		type: 'POST',
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		data: JSON.stringify(data),
		success: (response) => {
			if(response == true) {
				console.log(response)
				$('.new-item ' + field).addClass('valid').removeClass('invalid')
				$('.edit-item ' + field).addClass('valid').removeClass('invalid')
				sendError(field + '-error', '')
			} else {
				console.log(response)
				$('.new-item ' + field).addClass('invalid').removeClass('valid')
				$('.edit-item ' + field).addClass('invalid').removeClass('valid')
				sendError(field + '-error', response)
			}
		}
	})
}

function sendError(field, message) {
	// console.log('error')
	$(field).html(message).addClass('error-alert')
}