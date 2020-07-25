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
		<input type="text" name="login" placeholder="Логин">
		<input type="password" name="pass" placeholder="Пароль">
		<button>Войти</button>
	</form>

	<a href="/signup">Регистрация</a>
</div>