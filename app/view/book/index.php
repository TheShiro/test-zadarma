<?php

?>
	
<h2>Телефонная книга</h2>

<div class="message alert">
	
</div>

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
		<td><img src="<?= $row['photo'] ?>" class="photo"></td>
		<td>
			<p>Имя: <span class="name"><?=$row['name']?></span></p>
			<p>Фамилия: <span class="surname"><?=$row['surname']?></span></p>
			<p>Телефон: <span class="phone"><?=$row['phone']?></span></p>
			<p>Почта: <span class="email"><?=$row['email']?></span></p>
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
		<td class="upload-image">
			<input type="file" class="upload" name="photo" onchange="uploadFile('.upload')">
			<input type="hidden" class="upphoto" name="photo">
			<img src=":photo" class="photo">
		</td>
		<td>
			<input type="hidden" class="user_id" name="user_id" value="<?=$id?>">
			<p>Имя: <input type="text" class="name" name="name" oninput="validateField('.name')"></p>
			<p class="name-error"></p>
			<p>Фамилия: <input type="text" class="surname" name="surname" oninput="validateField('.surname')"></p>
			<p class="surname-error"></p>
			<p>Телефон: <input type="text" class="phone" name="phone" oninput="validateField('.phone');setCurPhone(this)"></p>
			<p class="phone-error"></p>
			<p>Почта: <input type="text" class="email" name="email" oninput="validateField('.email')"></p>
			<p class="email-error"></p>
		</td>
		<td>
			<button onclick="save(0)" class="btn btn-success">Сохранить</button>
			<button onclick="cansel(0)" class="btn btn-danger">Отмена</button>
		</td>
	</tr>
</template>

<template class="edit">
	<tr class="edit-item">
		<td class="upload-image">
			<input type="file" class="upload" name="photo" onchange="uploadFile('.upload')">
			<input type="hidden" class="upphoto" name="photo">
			<img src=":photo" class="photo">
		</td>
		<td>
			<p class="hidden safe">:safe</p>
			<input type="hidden" class="user_id" name="user_id" value="<?=$id?>">
			<p>Имя: <input type="text" class="name" name="name" value=":name" oninput="validateField('.name')"></p>
			<p class="name-error"></p>
			<p>Фамилия: <input type="text" class="surname" name="surname" value=":surname" oninput="validateField('.surname')"></p>
			<p class="surname-error"></p>
			<p>Телефон: <input type="text" class="phone" name="phone" value=":phone" oninput="validateField('.phone');setCurPhone(this)"></p>
			<p class="phone-error"></p>
			<p>Почта: <input type="text" class="email" name="email" value=":email" oninput="validateField('.email')"></p>
			<p class="email-error"></p>
		</td>
		<td>
			<button onclick="save(:id)" class="btn btn-success">Сохранить</button>
			<button onclick="cansel(:id)" class="btn btn-danger">Отмена</button>
		</td>
	</tr>
</template>

<template class="normal">
	<tr class="item:id">
		<td><img src=":photo" class="photo"></td>
		<td>
			<p>Имя: <span class="name">:name</span></p>
			<p>Фамилия: <span class="surname">:surname</span></p>
			<p>Телефон: <span class="phone">:phone</span></p>
			<p>Почта: <span class="email">:email</span></p>
		</td>
		<td>
			<a href="/view/:id" class="btn btn-primary">Просмотр</a>
			<button onclick="edit(:id)" class="btn btn-warning">Редактировать</button>
			<button onclick="del(:id)" class="btn btn-danger">Удалить</button>
		</td>
	</tr>
</template>

<script type="text/javascript" src="/js/phone.js"></script>
<script type="text/javascript" src="/js/field.js"></script>

<script>
function add() {
	if(!$('.table').hasClass('editable')) {
		let str = $('.add').html()
		$(str).prependTo('table > tbody')
		$('.table').addClass('editable')
	} else {
		sendMessage('alert-danger', 'Нельзя добавить несколько новых записей одновременно!')
	}
}

function edit(id) {
	if(!$('.table').hasClass('editable')) {
		let safe = {
			"name": $('.item' + id + ' .name').html(),
			"surname": $('.item' + id + ' .surname').html(),
			"phone": $('.item' + id + ' .phone').html(),
			"email": $('.item' + id + ' .email').html(),
			"photo": $('.item' + id + ' .photo').attr('src')
		}
		let template = $('.edit').html()
			.replace(/:id/g, id)
			.replace(/:name/g, safe.name)
			.replace(/:surname/g, safe.surname)
			.replace(/:phone/g, safe.phone)
			.replace(/:email/g, safe.email)
			.replace(/:photo/g, safe.photo)
			.replace(/:safe/g, JSON.stringify(safe))
		$('table > tbody > tr.item' + id).after(template)
		$('.item' + id).remove()
	} else {
		sendMessage('alert-danger', 'Нельзя редактировать и добавлять новую запись одновременно!')
	}
}

function del(id) {
	$.ajax({
		url: '/api/book/delete/' + id,
		type: 'DELETE',
		success: (response) => {
			sendMessage('alert-success', 'Запись удалена!')
			$('.item' + id).remove()
		},
		error: (response) => {
			sendMessage('alert-danger', 'Ошибка удаления изменений!')
		}
	})
}

function save(id) {
	if(id == 0) { //при добавлении новой
		let data = {
			"user_id": $('.new-item .user_id').val(),
			"name": $('.new-item .name').val(),
			"surname": $('.new-item .surname').val(),
			"phone": $('.new-item .phone').val(),
			"email": $('.new-item .email').val(),
			"photo": $('.new-item .upphoto').val()
		}
		$.ajax({
			url: '/api/book/create',
			type: 'POST',
			contentType: "application/json; charset=utf-8",
			dataType: "json",
			data: JSON.stringify(data),
			success: (response) => {
				data.id = response
				sendMessage('alert-success', 'Изменения сохранены!')

				let template = $('.normal').html()
					.replace(/:id/g, data.id)
					.replace(/:name/g, data.name)
					.replace(/:surname/g, data.surname)
					.replace(/:phone/g, data.phone)
					.replace(/:email/g, data.email)
					.replace(/:photo/g, data.photo)
				// template = replaceData(template, data)
				$(template).prependTo('table > tbody')
				cansel(0)
			},
			error: (response) => {
				console.log(response)
				sendMessage('alert-danger', 'Ошибка сохранения записи!')
			}
		})
	} else { //при редактировании
		let data = {
			"id": id,
			"user_id": $('.edit-item .user_id').val(),
			"name": $('.edit-item .name').val(),
			"surname": $('.edit-item .surname').val(),
			"phone": $('.edit-item .phone').val(),
			"email": $('.edit-item .email').val(),
			"photo": $('.edit-item .upphoto').val()
		}
		console.log(data)
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
				// template = replaceData(template, data)
				$('table > tbody > tr.edit-item').after(template)
				$('.edit-item').remove()
			},
			error: (response) => {
				console.log(response)
				sendMessage('alert-danger', 'Ошибка сохранения изменений!')
			}
		})
	}
}

function cansel(id) {
	if(id == 0) { //при добавлении новой
		$('.new-item').remove()

	} else { //при редактировании
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
	}

	$('.table').removeClass('editable')
}

function sendMessage(className, message) {
	$('.message').html(message).addClass(className)
	// console.log(message)
	setTimeout(() => {
		$('.message').html("").removeClass(className)
	}, 3000);
}

function uploadFile(photo) {
	var file_data = $('input' + photo).prop('files')[0];   
	var form_data = new FormData();                  
	form_data.append('file', file_data);
	// alert(form_data);                             
	$.ajax({
		url: '/api/file/upload',
		dataType: 'text',
		cache: false,
		contentType: false,
		processData: false,
		data: form_data,                         
		type: 'POST',
		success: function(response){
			// alert(response);
			let answ = response.replace(/\"/g, '').replace(/\\/g, '')
			$('.edit-item .upphoto').val(answ)
			$('.new-item .upphoto').val(answ)
			$('.edit-item .photo').attr('src', answ)
			$('.new-item .photo').attr('src', answ)
		}
	});
}
</script>