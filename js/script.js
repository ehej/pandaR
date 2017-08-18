/**
 * @author Sergey Galitskiy
 * @mailto sergiyko911@gmail.com
 * @date    17/06/2011
 */
$(document).ready(function() {
	$('#messages_block').delay(5000).fadeOut(1000);
	
	$('#messages_block').click(function() {
		$(this).hide();
	})
	
	$('.tour_top_description table tr:odd, .tour_bottom_description table tr:odd, table.hovered tr:odd').addClass('odd');
	
})
 
function focused(obj,defaultValue){
	if ($(obj).attr('value') == defaultValue) {
		$(obj).attr('value','');
	}
}
function blured(obj,defaultValue){
	if ($(obj).attr('value').replace(/ /g,'')=='') {
		$(obj).attr('value',defaultValue);
	}
}

function BlockUnsupportedBrowsers() {
	var bver = parseFloat($.browser.version);
	if ( ($.browser.msie && bver == 6)) {
        $.get('/unsupportedbrowser.html', function(data) {
            $('body').html(data);
        });
	}
}

function shlogin() {
    $('.autorlogin').toggle();
}

function alignItems(items, containerWidth){
    if (!($.browser.msie && (parseInt($.browser.version) < 8))) {
        var sum = 0;
        items.css('marginRight','0');
        for (i = 0; i < (items.length-1); i++) {
            sum = sum + items[i].offsetWidth+6;
        }
        var margin = ((containerWidth - sum) / items.length-1);
        items.css('margin-right',margin)
             .filter(':last').css({
                                    'margin-right': '0',
                                    'margin-left':'-'+margin+'px',
                                     float:'right'
                                  });
    }
}
function passwordfieldchange(field) {
    if(field.value=='') {
        field.value='Пароль'; field.type='text';
    } else if(field.value=='Пароль') {
        field.value=''; field.type='password';
    }
}
function loadLogo(){
   if ($('#header').height()>130){
       $('#logo').addClass('logo2');
   }
}
function showExtendParam(){
	$('#ext').slideDown('fast'); 
	$('.subm a').hide();
	$('#extend').val(1);
	return false;
}

function hideExtendParam(){
	$('#ext').slideUp('fast'); 
	$('.subm a').show();
	$('#extend').val(0);
	return false;
}


function filterTour(tval,tV){
    $("#allTours tr").each(function () {
        if ($(this).children('td').eq(tV).text().search(new RegExp(tval, "i")) < 0) {
            $(this).addClass("hidden");
        } else {
            $(this).removeClass("hidden");
        }
    });
}

function loadPage(pagenum, prefix){
	$('#'+prefix+'page').val(pagenum).parents().filter('form').submit();
}

function changecountry() {
    var country = $('#intCountryID option:selected').val();

    $('#intResortID option').show();
    $('#intResortID').val(0);
    $('#intResortID option:not([rel="'+country+'"])').hide();
}


$(document).ready(function(){
	try{
        $.featureList(
            $(".slider-menu li a"),
            $(".slider-content .slide a"), {
                start_item	:	1
            }
        );

        $('.header li').hover (
            function(){
                $(this).addClass('hovered').addClass($(this).children('div').length ? 'hasSub':'');
            },
            function(){
                $(this).removeClass('hovered').removeClass('hasSub');
            }
        )

        alignItems($('.footerCenter p:first a'), 580);
        alignItems($('.footerCenter p:last a'), 580);
        alignItems($('.footerCenter h2 a'), 580);

        $('.country h2 img').click(function(){
			if ( $.browser.msie ) {
				$(this).parent('h2').toggleClass('open','').next('div').toggleClass('open','');
			} else {
				$(this).parent('h2').toggleClass('open','').next('div').slideToggle('slow').toggleClass('open','');
			}
        });
		
//////////////////////////
$('.rounded .info .item h2').click(function(){
    if(!$(this).hasClass('active')){
	    if($('.rounded .info .item h2').hasClass('active')){
		    $('.rounded .info .item h2.active').removeClass('active').next('.text').slideUp();    
		}
        if($(this).parent('.item').find('td').length>0){
		    $(this).addClass('active').next('.text').slideDown();
		}
	}
	else{
		$(this).removeClass('active').next('.text').slideUp();    
	}
    
});
///////////////////////////////////

        $('#from_date, .date').datepick({
            regional : 'ru',
            minDate:0,          // minDate - today
            maxDate: +3*(365) // maxDate = +3years after now

        });
		
		$('.sidebar .has2level div.innerContent p').click(function(){
			if ($(this).next('div').length>0) {
				$(this).toggleClass('thisOpen').next('div').slideToggle('fast');
			}
		});
		
		
        $('.preheader .hasPopup').click(function(){
            $(this).next('form').addClass('hideMeAfter').fadeIn('fast');
            $('.header, .content').click(function(){
               $('.hideMeAfter').fadeOut('fast');
            })
            return false;
        })


        $('#qs').keyup(function () {
        	$('#qss').val('');
            filterTour($(this).val(),0)
        });
        $('#qss').change(function(){
        	$('#qs').val('').trigger('onblur');
            filterTour($(this).val(),1)
        })

        $(document).click(function(event) {
            if ($(event.target).closest(".autent").length) return;
            $(".autorlogin").hide("slow");
            event.stopPropagation();
        });


	} catch (e){
		alert(e)
	}
})

function inquiryvalidate(elem,subm) {
    var form = $(elem);
    //var form =elem;
    var ok = true;
    var fields = new Array();
    var ereg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    var nreg = /[0-9]/ ;
    var lreg = /^([а-яa-zёїійє \-]+)$/i ;
    $(form).find('input').each(function() {
        $(this).css('border', '1px solid #CCCCCC');
        if($(this).attr('type') != 'hidden' && $(this).attr('rel') && !$(this).attr('disabled')) {
            if($(this).val() == '' || $(this).val() == ' ') {
                ok = false;
                $(this).css('border', '1px solid #ff0000');
                fields.push($(this).attr('rel'));
            } else if ($(this).hasClass('literal') && !$(this).val().match(lreg)) {
                ok = false;
                $(this).css('border', '1px solid #ff0000');
                alert('Введите в поле "'+$(this).attr('rel')+'" только буквы');
                return false;
            } else if ($(this).hasClass('numeric') && !$(this).val().match(nreg)) {
                ok = false;
                $(this).css('border', '1px solid #ff0000');
                alert('Введите в поле "'+$(this).attr('rel')+'" только цифры');
                return false;
            }
        }
        if ($(this).hasClass('mail') && !$(this).val().match(ereg) && $(this).val()) {
            ok = false;
            $(this).css('border', '1px solid #ff0000');
            alert('Введенный Вами E-mail некорректный');
            return false;
        }
    });
    if(ok) {
        if(subm) {
            $(form).submit();
        } else {
            return true;
        }
    } else if(fields != '') {
        alert('Заполните, пожалуста, поле(я) "' + fields.join('", "') + '".');
        return false;
    }
}

function changeShowCommentForm() {
	if ($('#commentBlock').css('display') == 'none'){
		$('#commentBlock').slideDown('fast');
	} else {
		$('#commentBlock').slideUp('fast');
	}
}