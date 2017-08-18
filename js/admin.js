$(document).ready(function(e) {
	try {
		// add icons to messages divs
		$('div.message').prepend('<span class="iconset" />');
		AddZebra();
		$(".withoutborders").unbind("hover");
		$('.withoutborders tr').removeClass('even').removeClass('odd');
		CreateButtons();
		
		$('a.lightbox:has(img)').lightbox();
		
		// blur & focus events on inputs
		var inputTitled = $('input.titled');
		inputTitled.focus(function() {
			if ($(this).val() == $(this).attr('title')) {
				$(this).removeClass('grayed').val('');
			}
		})
		inputTitled.blur(function() {
			if ($(this).val() == '') {
				$(this).addClass('grayed').val($(this).attr('title'));
			}
		});
		// handle all form submits
		$('form').submit(function() {
			var inputTitled = $('input.titled');
			inputTitled.each(function () {
				if ($(this).val() == $(this).attr('title')) {
					$(this).val('');
				}
			});
 		});
		// run blur event an all inputs
		inputTitled.blur();
		// hundle #content resize
		$(window).resize(function() {
			FixWidth();
		});
		FixWidth();

	} catch(e) {	}
});

function CreateButtons(elid) {
	elid = elid || '#content';
	$(elid+' input[type="submit"], '+elid+' input[type="button"]').wrap('<span class="button" />');
	$(elid+' input[type="button"]').each(function () {
		if ($(this).val() == '') $(this).addClass('without_text');
	});
	// iconize buttons
	$('.iconize').css('background-position', function() {
		return '2px -' + ( ( parseInt( $(this).attr('rel') ) *16 ) -1 ) + 'px';
	});
}

function AddZebra() {
	// add zebra styles to tables
	$('.bordered > tbody > tr:even').addClass('odd');
	$('.bordered > tbody > tr:odd').addClass('even');
	// add hovers to tables
	$('.bordered tr').hover(
		function() {
			$(this).addClass('hovered');
		},
		function() {
			$(this).removeClass('hovered');
		}
	);
	// add hovers to stars
	$('.rating_star').hover(
		function() {
			$(this).addClass('star_hovered').prev().addClass('star_hovered').prev().addClass('star_hovered').prev().addClass('star_hovered').prev().addClass('star_hovered');
		},
		function() {
			$(this).removeClass('star_hovered').prev().removeClass('star_hovered').prev().removeClass('star_hovered').prev().removeClass('star_hovered').prev().removeClass('star_hovered');
		}
	);
}

function bordered() {
	var i = 2;
	$('#bordered tr').each(
		function() {
			if ( ++i%2 ) $(this).attr('class','odd');
			else $(this).attr('class','even');
		}
	);

	$('#bordered tr').hover(
		function() {
			$(this).addClass('hovered');
		},
		function() {
			$(this).removeClass('hovered');
		}
	);
}

function FixWidth() {
	$('#contentBar').width($('#contentTable').width());
}

function HilightElement(e) {
	$(e).css('border', '1px solid red');
}

function OnDelete(url, txt) {
	txt = txt || "Вы действительно хотите удалить запись?";
	if (confirm(txt)) Go(url);
}

function Go(url) {
	document.location.href = url;
}

function loadPage(pagenum, prefix){
	$('#'+prefix+'page').val(pagenum).parent().parent('form').submit();
}

function rateThat(s, m, e) {
	$('#'+e).html('секундочку...');
	$('#'+e).load('/rate.php', {"score": s, "movie": m});
}

/* for images */

function upload() {
	if ( ! empty($("#varFile").val()) ){
		$("#event").val('upload');
		$("#editForm").submit();
	}
}
/**
 * Отправка запроса на сортировку
 * @param type image(изображение) | movie (видео)
 * @param ids индентификаторы
 */
function sort(ids){
	url = "gallerys.edit.php?event=sort&ids="+ids;
	$.post(url, null, function(data){});
}

/**
 * Удаление изображение
 * @param id
 * @param name
 */
function deleteImage(id, name) {
	var msg = "Вы действительно хотите удалить изображение "+name+"?";
	if (confirm(msg)) {
		$('#'+id).remove();
		$.post("gallerys.edit.php?event=deleteImage&intImageID="+id);
	}
}

/**
 *
 */
function sortable() {
	$("#imagesListsortable").sortable({
	   stop: function(event, ui) {
			var result = $("#imagesListsortable").sortable('toArray').toString();
			sort(result);
		}
	});
}

function finds(te, id){
	var text = te;
	if(text == ''){
	  $('#'+id+' option').css('display',''); 
	  return; 	
	} 
	$('#'+id+' option').each(function(){
		var vals = $(this).text();
		regV = new RegExp(text,'gi');
		var result = vals.match(regV); 
		//console.log(result);
		if (result) {
			$(this).css('display','');
		}else{
			$(this).css('display','none');
		}
	
	})
}