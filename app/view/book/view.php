<?php
$this->title = "Просмотр";
?>

<h2><?=$this->title?> <?=$entry['name']?></h2>

<a href="/" class="btn btn-primary">Назад</a>

<table class="table">
	<thead>
		<tr>
			<td>Фото</td>
			<td>Данные</td>
		</tr>
	</thead>
	<tbody>
		<tr class="item">
			<td><img src="<?= $entry['photo'] ?>" class="image"></td>
			<td>
				<p>Имя: <span class="name"><?=$entry['name']?></span></p>
				<p>Фамилия: <span class="surname"><?=$entry['surname']?></span></p>
				<p>Телефон: <span class="phone"><?=$entry['phone']?></span></p>
				<p>Почта: <span class="email"><?=$entry['email']?></span></p>
			</td>
		</tr>
	</tbody>
</table>

<button onclick="edit(<?=$entry['id']?>)" class="btn btn-warning btn-edit">Редактировать</button>
<button onclick="del(<?=$entry['id']?>)" class="btn btn-danger btn-del">Удалить</button>

<template class="edit">
	<tr class="edit-item">
		<td class="upload-image"><input type="file" name="photo"><img src=":image" class="photo"></td>
		<td>
			<p class="hidden safe">:safe</p>
			<input type="hidden" class="user_id" name="user_id" value="<?=$id?>">
			<p>Имя: <input type="text" class="name" name="name" value=":name"></p>
			<p>Фамилия: <input type="text" class="surname" name="surname" value=":surname"></p>
			<p>Телефон: <input type="text" class="phone" name="phone" value=":phone"></p>
			<p>Почта: <input type="text" class="email" name="email" value=":email"></p>
		</td>
		<td>
			<button onclick="save(:id)" class="btn btn-success">Сохранить</button>
			<button onclick="cansel(:id)" class="btn btn-danger">Отмена</button>
		</td>
	</tr>
</template>

<template class="normal">
	<tr class="item">
		<td><img src=":image" class="photo"></td>
		<td>
			<p>Имя: <span class="name">:name</span></p>
			<p>Фамилия: <span class="surname">:surname</span></p>
			<p>Телефон: <span class="phone">:phone</span></p>
			<p>Почта: <span class="email">:email</span></p>
		</td>
	</tr>
</template>

<script>
function edit(id) {
	let safe = {
		"name": $('.item .name').html(),
		"surname": $('.item .surname').html(),
		"phone": $('.item .phone').html(),
		"email": $('.item .email').html(),
		"photo": $('.item .photo').html()
	}
	let template = $('.edit').html()
		.replace(/:id/g, id)
		.replace(/:name/g, safe.name)
		.replace(/:surname/g, safe.surname)
		.replace(/:phone/g, safe.phone)
		.replace(/:email/g, safe.email)
		.replace(/:photo/g, safe.photo)
		.replace(/:safe/g, JSON.stringify(safe))
	// $('table > tbody').after(template)
	$(template).prependTo('table > tbody')
	$('.item').remove()

	$('.btn-edit').addClass('hidden')
	$('.btn-del').addClass('hidden')
}

function del(id) {
	$.ajax({
		url: '/api/book/delete/' + id,
		type: 'DELETE',
		success: (response) => {
			sendMessage('alert-success', 'Запись удалена!')
			$('.item').remove()
		},
		error: (response) => {
			sendMessage('alert-danger', 'Ошибка удаления изменений!')
		}
	})
}

function save(id) {
	let data = {
		"id": id,
		"user_id": $('.edit-item .user_id').val(),
		"name": $('.edit-item .name').val(),
		"surname": $('.edit-item .surname').val(),
		"phone": $('.edit-item .phone').val(),
		"email": $('.edit-item .email').val(),
		"photo": $('.edit-item .photo').val()
	}
	$.ajax({
		url: '/api/book/update',
		type: 'PUT',
		contentType: "application/json; charset=utf-8",
		dataType: "json",
		data: JSON.stringify(data),
		success: (response) => {
			sendMessage('alert-success', 'Изменения сохранены!')

			let template = $('.normal').html()
				.replace(/:id/g, data.id)
				.replace(/:name/g, data.name)
				.replace(/:surname/g, data.surname)
				.replace(/:phone/g, data.phone)
				.replace(/:email/g, data.email)
				.replace(/:photo/g, data.photo)
			// $('table > tbody > tr.edit-item').after(template)
			$(template).prependTo('table > tbody')
			$('.edit-item').remove()

			$('.btn-edit').removeClass('hidden')
			$('.btn-del').removeClass('hidden')
		},
		error: (response) => {
			sendMessage('alert-danger', 'Ошибка сохранения изменений!')
		}
	})
}

function cansel(id) {
	let safe = $('.edit-item .safe').html()
	safe = JSON.parse(safe)
	let template = $('.normal').html()
		.replace(/:id/g, id)
		.replace(/:name/g, safe.name)
		.replace(/:surname/g, safe.surname)
		.replace(/:phone/g, safe.phone)
		.replace(/:email/g, safe.email)
		.replace(/:photo/g, safe.photo)
	$('table > tbody > tr.edit-item').after(template)
	$('.edit-item').remove()

	$('.btn-edit').removeClass('hidden')
	$('.btn-del').removeClass('hidden')
}

function sendMessage(className, message) {
	$('.message').html(message).addClass(className)
	// console.log(message)
	setTimeout(() => {
		$('.message').html("").removeClass(className)
	}, 3000);
}
</script>