<?php
	$this->title = "Регистрация";
?>

<div id="auth">
	<?php if(!empty($errors)): ?>
		<div class="error-login">
			<p><?=$errors?></p>
		</div>
	<?php endif; ?>
	<form class="login" method="POST">
		<h2>Регистрация</h2>
		<input type="text" name="login" placeholder="Логин" class="form-control">
		<p></p>
		<input type="password" name="password" placeholder="Пароль" class="form-control">
		<p></p>
		<input type="password" name="repeat" placeholder="Повторите пароль" class="form-control">
		<p></p>
		<input type="text" name="name" placeholder="Имя" class="form-control">
		<p></p>
		<input type="text" name="email" placeholder="Почта" class="form-control">
		<p></p>
		<button class="btn btn-lg btn-primary btn-block">Зарегистрироваться</button>
	</form>
</div>

<script>

</script>