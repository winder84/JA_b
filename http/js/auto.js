var hit_img_id = 0;
var firm_img_id = 0;
var sl_id = 1;
var hit_id;
var firm_id;
var top_slider_id;
function hit_right() {
	img_all = $('.hit_prod img');

	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');

	img_shown.animate({opacity:0},500);
	text_shown.animate({opacity:0},500);

	if(hit_img_id == img_all.length-1) {
		hit_img_id = 0;
	} else {
		hit_img_id = hit_img_id+1;
	}

	hit_link = $('.hit_link[id='+hit_img_id+']').attr('href');
	$('.hit_link_up:last').attr('href', hit_link);
	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');
	img_shown.animate({opacity:1},500);
	text_shown.animate({opacity:1},500);

	if(window.location.href == ('http://' + document.domain + '/catalog')){
		document.getElementById('category_title').innerHTML = $('#title_' + hit_img_id).html();
		document.getElementById('category_desc').innerHTML = $('#desc_' + hit_img_id).html();
	}
}

function hit_left() {
	img_all = $('.hit_prod img');

	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');

	img_shown.animate({opacity:0},500);
	text_shown.animate({opacity:0},500);

	if(hit_img_id == 0) {
		hit_img_id =  img_all.length - 1;
	} else {
		hit_img_id = hit_img_id-1;
	}

	hit_link = $('.hit_link[id='+hit_img_id+']').attr('href');
	$('.hit_link_up:last').attr('href', hit_link);
	img_shown = $('.hit_prod img[id='+hit_img_id+']');
	text_shown = $('.hit_prod div[id='+hit_img_id+']');
	img_shown.animate({opacity:1},500);
	text_shown.animate({opacity:1},500);
}


function firm_right() {
	img_all = $('.firm_prod img');

	img_shown = $('.firm_prod img[id='+firm_img_id+']');
	text_shown = $('.firm_prod div[id='+firm_img_id+']');

	img_shown.animate({opacity:0},500);
	text_shown.animate({opacity:0},500);

	if(firm_img_id == img_all.length-1) {
		firm_img_id = 0;
	} else {
		firm_img_id = firm_img_id+1;
	}

	firm_link = $('.firm_link[id='+firm_img_id+']').attr('href');
	$('.firm_link_up:last').attr('href', firm_link);
	img_shown = $('.firm_prod img[id='+firm_img_id+']');
	text_shown = $('.firm_prod div[id='+firm_img_id+']');
	img_shown.animate({opacity:1},500);
	text_shown.animate({opacity:1},500);

	if(window.location.href == ('http://' + document.domain + '/catalog')){
		document.getElementById('category_title').innerHTML = $('#title_' + firm_img_id).html();
		document.getElementById('category_desc').innerHTML = $('#desc_' + firm_img_id).html();
	}
}

function firm_left() {
	img_all = $('.firm_prod img');

	img_shown = $('.firm_prod img[id='+firm_img_id+']');
	text_shown = $('.firm_prod div[id='+firm_img_id+']');

	img_shown.animate({opacity:0},500);
	text_shown.animate({opacity:0},500);

	if(firm_img_id == 0) {
		firm_img_id =  img_all.length - 1;
	} else {
		firm_img_id = firm_img_id-1;
	}

	firm_link = $('.firm_link[id='+firm_img_id+']').attr('href');
	$('.firm_link_up:last').attr('href', firm_link);
	img_shown = $('.firm_prod img[id='+firm_img_id+']');
	text_shown = $('.firm_prod div[id='+firm_img_id+']');
	img_shown.animate({opacity:1},500);
	text_shown.animate({opacity:1},500);
}


function interval () {
	hit_right();
	clearInterval(hit_id);
	hit_id = setInterval(interval, 5000);
}

function firm_interval () {
	firm_right();
	clearInterval(firm_id);
	firm_id = setInterval(firm_interval, 10000);
}

$(document).ready(function() {
	hit_id = setInterval(interval, 5000);
	firm_id = setInterval(firm_interval, 5000);
	top_slider_id = setInterval(top_slider_right, 7000);

	if(window.location.href == ('http://' + document.domain + '/')){
		$('.menu_block a[href="/"]').attr({class:'current'});
	};
	if(window.location.href.indexOf('catalog') !== -1){
		$('.menu_block a[href="/catalog"]').attr({class:'current'});
	};
	if(window.location.href.indexOf('onas') !== -1){
		$('.menu_block a[href="/onas"]').attr({class:'current'});
	};
	if(window.location.href.indexOf('contacts') !== -1){
		$('.menu_block a[href="/contacts"]').attr({class:'current'});
	};

	hit_link = $('.hit_link[id='+hit_img_id+']').attr('href');
	$('.hit_link_up:last').attr('href', hit_link);

	firm_link = $('.firm_link[id='+firm_img_id+']').attr('href');
	$('.firm_link_up:last').attr('href', firm_link);
});

function top_slider_right () {
	$('#sl_i_' + sl_id).animate({"margin-left":"-=200", opacity:0},500);
	$('#sl_txt_' + sl_id).animate({opacity:0},500);
	if(sl_id==5){
		sl_id=0;
	}
	sl_id++;
	$('#sl_i_' + sl_id).animate({"margin-left":"+=200", opacity:1},500);
	$('#sl_txt_' + sl_id).animate({opacity:1},500);
	clearInterval(top_slider_id);
	top_slider_id = setInterval(top_slider_right, 7000);
};

function top_slider_left () {
	$('#sl_i_' + sl_id).animate({"margin-left":"-=200", opacity:0},500);
	$('#sl_txt_' + sl_id).animate({opacity:0},500);
	if(sl_id==1){
		sl_id=6;
	}
	sl_id--;
	$('#sl_i_' + sl_id).animate({"margin-left":"+=200", opacity:1},500);
	$('#sl_txt_' + sl_id).animate({opacity:1},500);
	clearInterval(top_slider_id);
	top_slider_id = setInterval(top_slider_right, 7000);
};

function firm_toggle(id) {
	$('#list_center ul').slideUp();
	$('#list_center ul.firm_' + id).slideDown();
}

function mail_submit() {
	$.post('mail_submit.php', {name: $('#mail_name').val(), email : $('#mail_email').val(), topic: $('#mail_topic').val(), text: $('#mail_text').val()})
		.done(function(data) {
			alert(data);
		});
	$('#mail_name').val('');
	$('#mail_email').val('');
	$('#mail_topic').val('');
	$('#mail_text').val('');
}