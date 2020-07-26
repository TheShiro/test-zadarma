<?php
	$this->title = "Регистрация";
?>

<div id="auth">
	<div class="logo">
		<img src="/public/img/logo.png">
	</div>
	<form class="form" method="POST">
		<h2>Регистрация</h2>
		<?php if(!empty($errors)): ?>
			<div class="error-registration alert alert-danger">
				<p><?=$errors?></p>
			</div>
		<?php endif; ?>
		<input type="text" name="login" placeholder="Логин" class="form-control login" oninput="validateField('.login')">
		<p class="login-error"></p>
		<input type="password" name="password" placeholder="Пароль" class="form-control password" oninput="validateField('.password');validateRepeat()">
		<p class="password-error"></p>
		<input type="password" name="repeat" placeholder="Повторите пароль" class="form-control repeat" oninput="validateRepeat()">
		<p class="repeat-error"></p>
		<input type="text" name="name" placeholder="Имя" class="form-control name" oninput="validateField('.name')">
		<p class="name-error"></p>
		<input type="text" name="email" placeholder="Почта" class="form-control email" oninput="validateField('.email')">
		<p class="email-error"></p>
		<button class="btn btn-lg btn-primary btn-block">Зарегистрироваться</button>
	</form>
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