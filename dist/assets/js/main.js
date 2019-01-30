$(document).ready(function () {


/*Валидация формы "добавление записи"*/
$('#addSection').submit(function(e){

	var input = $(this).find('input'),
		select = $(this).find('select'),
		val_input = input.val(),
		val_select = select.val();

		if(!val_input ){
			input.addClass('required').attr('placeholder','Заполните поле');
			console.log('val_input' +val_input);
			e.preventDefault();
		}

});
/*/Валидация формы "добавление записи"*/

/*Удаляем элемент списка*/
function delete_section(btn){
	var id = btn.val(),
		innerItem = btn.parent().find('[data-id]'),
		arr_inner_id=[];


	/*Собираем id элементов*/
	function collect_element(inner_id){
		arr_inner_id.push(id);
		innerItem.each(function(){
			inner_id = $(this).attr('data-id');
			arr_inner_id.push(inner_id);
			return arr_inner_id;
		});
	}
	/*/Собираем id элементов*/

	/*Передаем на сервер id*/
	function send_id(){
		var package,
			count_element = arr_inner_id.length,
			unit;


			if(count_element == 1 )
				{
					unit = 'элемент';
				}
			else if(count_element <= 4)
				{
					unit = 'элемента';
				}
			else
				{
					unit = 'элементов';
				}

			if(confirm('Вы действительно хотите удалить ' + count_element + ' '+unit +' ?'))
				{
					package = arr_inner_id.join(',');

				   var request = $.ajax({
			            type: "POST",
			            url: "index.php",
			            data: {btnDelete:package},
			            success: function(data){
			                console.log('запрос отправлен');

			                arr_inner_id.forEach(function(value,key,arr){
								$('.catalog [data-id='+value+ ']').remove();
								console.log(arr);
							});
			            },
			            error: function(e){
			                console.log('запрос не отправлен' + e);
			            }
			    	});
				}
	}
	/*/Передаем на сервер id*/

	var del_item = $.Callbacks();
		del_item.add(collect_element());
		del_item.fire(id);
		del_item.add(send_id());
		del_item.fire(arr_inner_id);

}
/*/Удаляем элемент списка*/
$('body').on('click', '.btnDelete',function(){
	delete_section($(this));
	});

$('.btnDelete').hover(function(){
	$(this).parent().toggleClass('active');
	});
}); /*конец ready*/
