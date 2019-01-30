<ul>

	<?foreach($main_arr as $k1 => $item){?>
		<li class="catalog__item" data-id="<?=$item['id']?>" data-parent_id='<?=$item['parent_id']?>'>
			<span class="catalog__name"><?=$item['name']?></span>
			<button type="submit" class="btnDelete" name='btnDelete' value='<?=$item['id']?>'>Удалить</button>
			<?if(count($item['children']) > 0) {
				echo renderTemplate('cat_path.php',['main_arr'=>$item['children']]);

			}?>
		</li>

		
	<?}?>	

</ul>