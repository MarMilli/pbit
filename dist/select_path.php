
	<?foreach($main_arr as $k1 => $item){?>
		<option  class="blockAdd__option" data-id="<?=$item['id']?>" value="<?=$item['id']?>" data-parent_id='<?=$item['parent_id']?>'><?=$item['name']?></option>

		<?if(count($item['children']) >0) {
			echo renderTemplate('select_path.php',['main_arr'=>$item['children']]);
		}?>

	<?}?>	

