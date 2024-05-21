<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!empty($arResult)) {
?>
<div class="form_body">
	<span class="form_header">Обратная связь</span>
	<span class="form_response"></span>
	<form name="form_feedback" class="form_feedback">
		<div class="form_inputs">
			<input type="hidden" name="formid" id="formid" value="<?=$arParams['FORM_ID']?>">
			<?=bitrix_sessid_post()?>
			<?php
			foreach ($arResult['FIELDS'] as $fieldCode => $field) {
				switch ($field['TYPE']) {
					case 'S':
						?>
						<input class="form_input" name="<?=$fieldCode?>" type="text" placeholder="<?=$field['NAME']?>" <?=$field['REQUIRED'] == 'Y' ? 'required' : ''?>>
						<?php
						break;
					case 'N':
						?>
						<input class="form_input" name="<?=$fieldCode?>" type="number" placeholder="<?=$field['NAME']?>" <?=$field['REQUIRED'] == 'Y' ? 'required' : ''?>>
						<?php
						break;
					case 'L':
						?>
						<?=$field['NAME']?> <select name="<?=$fieldCode?>">
						<?php
						foreach ($field['OPTIONS'] as $option) {
							?>
							<option value="<?=$option['ID']?>">
								<?=$option['VALUE']?>
							</option>
							<?php
						}
						?>
						</select>
						<?php
						break;
					case 'F':
						?>
						<?=$field['NAME']?> <input class="form_input" name="<?=$fieldCode?>[]" type="file" <?=$field['REQUIRED'] == 'Y' ? 'required' : ''?> <?=$field['MULTIPLE'] == 'Y' ? 'multiple' : ''?> accept="image/*">
						<?php
						break;
				}
			}
			?>
			<button class="form_submit" type="submit">Отправить</button>
		</div>
	</form>
</div>
<?php
}