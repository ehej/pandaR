{literal}
<script type="text/javascript" src="/js/colorpicker.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#varColorBG').ColorPicker({
	  		onSubmit: function(hsb, hex, rgb) {
	    		$('#varColorBG').val(hex);
	  		},
	  		onBeforeShow: function () {
	    		$(this).ColorPickerSetColor(this.value);
	  		},
	  		onChange: function (hsb, hex, rgb) {
	  			$('#varColorBG').val(hex);
	  		}
	 	}).bind('keyup', function(){
		  	$(this).ColorPickerSetColor(this.value);
		});
        $('#varColorRO').ColorPicker({
              onSubmit: function(hsb, hex, rgb) {
                $('#varColorRO').val(hex);
              },
              onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
              },
              onChange: function (hsb, hex, rgb) {
                  $('#varColorRO').val(hex);
              }
         }).bind('keyup', function(){
              $(this).ColorPickerSetColor(this.value);
        });
        
        $('#varColorBGBody').ColorPicker({
              onSubmit: function(hsb, hex, rgb) {
                $('#varColorBGBody').val(hex);
              },
              onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
              },
              onChange: function (hsb, hex, rgb) {
                  $('#varColorBGBody').val(hex);
              }
         }).bind('keyup', function(){
              $(this).ColorPickerSetColor(this.value);
        });
	});
	function SaveForm() {
		$('#event').val('save');
		$('#editForm').submit();
	}
</script>
{/literal}

<h1>{$pagetitle}</h1>

<form action="preferences.php" method="POST" id="editForm" name="editForm" enctype="multipart/form-data">
<input type="hidden" name="event" id="event" value="" />
<input type="hidden" name="intPrefID" id="intPrefID" value="{$pref.intPrefID}" />

<table width="100%" class="container"><tr><td valign="top">
	<table class="bordered" width="100%">
		<thead><tr><th colspan="2">Настройки</th></tr></thead>
		<tbody>
			<tr>
				<td>{$pref.varPrefDescr}</td>
				<td><input style="width: 95%;" type="text" name="korregKoeff" id="{$pref.varPrefName}" value="{$pref.varPrefValue}" /></td>
			</tr>
			<tr>
				<td>Цвет фона СПО на Главной</td>
				<td><input type="text" id="varColorBG" name="varColorBG" value="{$spoPref.varColorBG}" title="Лучший выбор: #e7e7e7" /></td>
			</tr>
			<tr>
				<td>Цвет фона СПО на Главной при наведении</td>
				<td><input type="text" id="varColorRO" name="varColorRO" value="{$spoPref.varColorRO}" title="Лучший выбор: #96c7f7" /></td>
			</tr>
            <tr>
                <td>Изображение в верху сайта (высота 197px) {if $spoPref.varImgBGTop != ''}<img src="{$path_file}{$spoPref.varImgBGTop}" width="100" style="float:right" /> {/if}</td>
                <td><input type="file" id="varImgBGTop" name="varImgBGTop" /><input type="checkbox" name="varImgBGTop_Clear" value="1">Очистить</td>
            </tr>
            <tr>
                <td>Изображение бекграунда сайта{if $spoPref.varImgBGBody != ''}<img src="{$path_file}{$spoPref.varImgBGBody}" width="100" style="float:right" /> {/if}</td>
                <td><input type="file" id="varImgBGBody" name="varImgBGBody"  /><input type="checkbox" name="varImgBGBody_Clear" value="1">Очистить</td>
            </tr>
            <tr>
                <td>Цвет бекграунда сайта</td>
                <td><input type="text" id="varColorBGBody" name="varColorBGBody" value="{$spoPref.varColorBGBody}" title="Лучший выбор: #f5f5f5" /></td>
            </tr>
		</tbody>
	</table>
</td></tr></table>

<div>
	<input type="submit" class="iconize" rel="82" value="Сохранить" onclick='SaveForm()'/>
</div>
</form>