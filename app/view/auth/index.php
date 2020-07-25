<?php
	$this->title = "Авторизация";
?>

<div id="auth">
	<?php if(!empty($errors)): ?>
		<div class="error-login">
			<p><?=$errors?></p>
		</div>
	<?php endif; ?>
	<form class="login" method="POST">
		<h2>Пожалуйста войдите</h2>
		<input type="text" name="login" placeholder="Логин" class="form-control">
		<input type="password" name="pass" placeholder="Пароль" class="form-control">
		<button class="btn btn-lg btn-primary btn-block">Войти</button>
	</form>

	<a href="/signup">Регистрация</a>
</div>