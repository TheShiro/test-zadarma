<?php

?>
	
<p>Телефонная книга</p>

<button onclick="add()" class="btn btn-success">Добавить</button>

<table class="table">
	<thead>
		<tr>
			<td>Фото</td>
			<td>Данные</td>
			<td>Действие</td>
		</tr>
	</thead>
	<tbody>
<?php foreach($rows as $row): ?>
	<tr class="item<?=$row['id']?>">
		<td><?= $row['photo'] ?></td>
		<td>
			<p>Имя: <span><?=$row['name']?></span></p>
			<p>Фамилия: <span><?=$row['surname']?></span></p>
			<p>Телефон: <span><?=$row['phone']?></span></p>
			<p>Почта: <span><?=$row['email']?></span></p>
		</td>
		<td>
			<a href="/view/<?=$row['id']?>" class="btn btn-primary">Просмотр</a>
			<button onclick="edit(<?=$row['id']?>)" class="btn btn-warning">Редактировать</button>
			<button onclick="del(<?=$row['id']?>)" class="btn btn-danger">Удалить</button>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
</table>

<template class="add">
	<tr class="new-item">
		<td class="upload-image"><input type="file" name="photo"></td>
		<td>
			<p>Имя: <input type="text" name="name"></p>
			<p>Фамилия: <input type="text" name="surname"></p>
			<p>Телефон: <input type="text" name="phone"></p>
			<p>Почта: <input type="text" name="email"></p>
		</td>
		<td>
			<button onclick="save(0)" class="btn btn-success">Сохранить</button>
			<button onclick="cansel(0)" class="btn btn-danger">Отмена</button>
		</td>
	</tr>
</template>

<template class="edit">
	<tr class="edit-item">
		<td class="upload-image"><input type="file" name="photo"><img src=":image"></td>
		<td>
			<p>Имя: <input type="text" name="name" value=":name"></p>
			<p>Фамилия: <input type="text" name="surname" value=":surname"></p>
			<p>Телефон: <input type="text" name="phone" value=":value"></p>
			<p>Почта: <input type="text" name="email" value=":value"></p>
		</td>
		<td>
			<button onclick="save(<?=$row['id']?>)" class="btn btn-success">Сохранить</button>
			<button onclick="cansel(<?=$row['id']?>)" class="btn btn-danger">Отмена</button>
		</td>
	</tr>
</template>

<template class="normal">
	<tr class="item:id">
		<td><img src=":image"></td>
		<td>
			<p>Имя: <input type="text" name="name" value=":name"></p>
			<p>Фамилия: <input type="text" name="surname" value=":surname"></p>
			<p>Телефон: <input type="text" name="phone" value=":value"></p>
			<p>Почта: <input type="text" name="email" value=":value"></p>
		</td>
		<td>
			<a href="/view/<?=$row['id']?>" class="btn btn-primary">Просмотр</a>
			<button onclick="edit(<?=$row['id']?>)" class="btn btn-warning">Редактировать</button>
			<button onclick="del(<?=$row['id']?>)" class="btn btn-danger">Удалить</button>
		</td>
	</tr>
</template>

<script>
	function add() {
		if(!$('.table').hasClass('editable')) {
			let str = $('.add').html()
			$(str).prependTo('table > tbody')
			$('.table').addClass('editable')
		} else {
			sendMessage('Нельзя добавить несколько новых записей одновременно!')
		}
	}

	function edit(id) {
		if(!$('.table').hasClass('editable')) {
			//
		} else {
			sendMessage('Нельзя редактировать и добавлять новую запись одновременно!')
		}
	}

	function del(id) {
		//
	}

	function save(id) {
		if(id == 0) {
			let data = ''
			$.ajax({
				url: '/api/book/create',
				type: 'POST',
				dataType: "JSON",
				data: data,
				success: (response) => {
					sendMessage('Изменения сохранены!')
				},
				error: (response) => {
					console.log(response)
					sendMessage('Ошибка сохранения записи!')
				}
			})
		} else {
			let data = ''
			$.ajax({
				url: '/api/book/update',
				type: 'POST',
				dataType: "JSON",
				data: data,
				success: (response) => {

				},
				error: (response) => {

				}
			})
		}
	}

	function cansel(id) {
		if(id == 0) {
			$('.new-item').remove()
		} else {
			$('.edit-item').remove()
		}

		$('.table').removeClass('editable')
	}

	function sendMessage(message) {
		console.log(message)
	}
</script>