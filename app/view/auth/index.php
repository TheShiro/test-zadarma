<?php
	$this->title = "Авторизация";
?>

<div id="auth">
	<div class="logo">
		<img src="/public/img/logo.png">
	</div>
	<form class="form" method="POST">
		<h2>Пожалуйста войдите</h2>
		<?php if(!empty($errors)): ?>
			<div class="error-login alert alert-danger">
				<p><?=$errors?></p>
			</div>
		<?php endif; ?>
		<input type="text" name="login" placeholder="Логин" class="form-control login">
		<input type="password" name="password" placeholder="Пароль" class="form-control password">
		<div class="g-recaptcha" data-sitekey="6Lcca7YZAAAAAHHKsGv-DNI_GiuVD2i0rUDyGYOY"></div>
		<button class="btn btn-lg btn-primary btn-block">Войти</button>
	</form>

	<a href="/signup">Регистрация</a>
</div>

<script>
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
				$(field).addClass('valid').removeClass('invalid')
				sendError(field + '-error', '')
			} else {
				console.log(response)
				$(field).addClass('invalid').removeClass('valid')
				sendError(field + '-error', response)
			}
		}
	})
}

function sendError(field, message) {
	console.log('error')
	$(field).html(message).addClass('error-alert')
}

function validateRepeat() {
	if($('.password').val() == $('.repeat').val()) {
		$('.repeat').addClass('valid').removeClass('invalid')
		sendError('.repeat-error', '')
	} else {
		$('.repeat').addClass('invalid').removeClass('valid')
		sendError('.repeat-error', 'Не совпадают пароли')
	}
}
</script>