$(document).ready(function(){
	// starting parameters
	selectionStep();
	
});

function selectionStep() {

	//renderTemplateFirstStep();

	getTemplateGames('./backend/index.php/serviceMH', function() {
		//after initialize games
		var game_name = $('.mission-container.selected').attr('id');
		$('.waiting').addClass('active');
		$('.mission-container.selected > .mission-image-container > .players').attr('disabled', 'disabled');
		$('.mission-container.selected > .mission-image-container > .langs').attr('disabled', 'disabled');

		getTemplateDays('./backend/index.php/reservations?game=' + game_name + '&amount=2', function() {
			$('.waiting').removeClass('active');
			$('.mission-container.selected > .mission-image-container > .players').removeAttr('disabled', 'disabled');
			$('.mission-container.selected > .mission-image-container > .langs').removeAttr('disabled', 'disabled');
		});

		$('.book-button').on('click', function() {

			if($(this).hasClass('enabled')) {
				var game = $('.mission-container.selected').attr('id');
				game = game.replace("_", " ");
				//var lang = $('.mission-container.selected').find('.langs')[0].value;
				var lang = "CZK";
				var date = $('.day-container.selected').find('.day-title').text();
				var hour = $('.day-container.selected').find('.time-slot.selected').text();
				//var players = $('.mission-container.selected').find('.players')[0].value;
				var players = 6;
				//var price = $('.mission-container.selected').find('.money').text();
				var price = 0;
				//total_cost
				//var bkcode = "TP";
				var data = [game, lang, date, hour, players,0];

				$('#game-selection-step').remove();
				reservationStep(data);
			}
		});

		///NEW!!!!!!!
		//$.datepicker.setDefaults($.datepicker.regional["ru"]);
		$('.datepicker').datepicker({
			dateFormat: 'd MM, yy',
			firstDay: 1,
			minDate: 0,
     		maxDate: '+12m'
		}).datepicker('setDate', new Date());
	});
};




function reservationStep(data) {
	renderTemplateSecondStep(data, function() {
		$('.back-button').on('click', function() {
			if($(this).hasClass('enabled')) {
				selectionStep();
			}
		});

		$('.close').on('click', function() {
			$('.alert').removeClass('active');
			selectionStep();
		});



		$('.info-input-group > input').on('keyup', function() {

			var first_name = $('#first_name').val();
			var last_name = $('#last_name').val();
			var email = $('#email').val();
			var phone = $('#phone').val();

			if(first_name !== '' && last_name !== '' && email !== '' && phone !== '' && isPhone(phone) && isEmail(email)) {
				$('.reserve').addClass('enabled');
			} else {
				$('.reserve').removeClass('enabled');
			}
		});

		$('.reserve').on('click', function() {
			
			if($(this).hasClass('enabled')) {
				var date = $('#date').text();
				var time = $('#time').text();
				var people = 6;
				var total_cost = 0;
				var game_name = $('#game_name').text().replace(" ", "_");
				var lang_name = "CZK";
				var firstname = $('#first_name').val();
				var lastname = $('#last_name').val();
				var email = $('#email').val();
				var phone = $('#phone').val();
				var bkcode = "";
				var voucher = "";
				
				//voucher = "TPs";
				$("#reserveButton").addClass("loading");
				$('.reserve').removeClass('enabled');
			
				$.ajax({
				    type: 'POST',
				    url: './backend/index.php/reservation',
				    data: { 
				        reservation: JSON.stringify({date, time, people, total_cost, game_name, lang_name, voucher, bkcode}),
				        contactinfo: JSON.stringify({firstname, lastname, email, phone})
				       // code: JSON.stringify({code})
				    },
				    success: function(message){
				    	var status = $.trim(message);
				    	$('.reserve').removeClass('enabled');
				    	$('.back-button').removeClass('enabled');
				    	$('.info-input-group > input').attr('disabled', 'disabled');
				    	
				    	if(status == 'peak') {
				    		$('.alert.peak').addClass('active');
				    	} else {
				    		//$('.alert.info').addClass('active'); // here redirect
				    		//window.scrollTo(0,0);
				    		$("#reserveButton").removeClass("loading");
				    		//$('.reserve').addClass('enabled');
				    		window.top.location.href = "https://thrillparkprague.com/booked-solve.html"; 
				    		//window.location.href = "https://thrillparkprague.com/booked-solve.html";
				    	}
				    	//Reservation done SUCCESS
				    	/*dataLayer.push({'event':'ga.event', 'eventCategory':'Reservation','eventAction': game_name, 'eventValue': total_cost}); 
				    	gtag('event', 'conversion', {
					      'send_to': 'AW-830935336/eLixCLHV74UBEKiinIwD',
					      'value': total_cost,
					      'currency': 'CZK',
					      'transaction_id': status
					  	});
					  	console.log(status);
					  	console.log(total_cost);
					  	console.log(game_name);*/
				    }
				});
			}
		});
	});

}

function checkVoucher() {
	
	var voucher = $("#voucherCode").val();
	//loading sequnce
	jQuery.ajax({
	url: "voucher/check_availability.php",
	data:{voucher: $("#voucherCode").val(),
		  gamename:$("#game_name").text().replace(" ", "_"),
		  date:$("#date").text(),
		  time:$("#time").text(),
		  ppl: $("#players").text().charAt(0)
		},
	//data: { code: code, userid: userid }
	type: "POST",
	success:function(data){
		var dataArray = $.parseJSON(data);

		
		$("#cost_number").text(dataArray.extra_price);
		if (dataArray.message == 200) {
			$("#voucherCode").prop('disabled', true);
			$("#voucherCode").addClass("voucher-success");
		}
		else{
		$("#voucherCode").val(getMessageByCode(dataArray.message));
		}	
		

		
	},
	error:function (){}
	});
}

function getMessageByCode(code){
	switch (code) { 
	case 205: 
		return('Nesprávný kód voucheru');
		break;
	case 207: 
		return('Voucher byl již uplatněn');
		break;
	case 222: 
		return('Voucher je určen pro jinou hru');
		break;	
	case 208: 
		return('voucher již vypršel');
		break;
	case 209: 
		return('Voucher byl již uplatněn');
		break;
	case 203: 
		return('Voucher není možné uplatnit ve vybraný den');
		break;
	case 204: 
		return('Vyberte jiný čas rezervace');
		break;
	case 200: 
		return('');
		break;	
	default:
		console.log(code);
		return('Chyba voucheru. Kontaktuje obsluhu');
	}
}

function isPhone(phone) {
	var regex = /^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/;
	return regex.test(phone);
}

function isEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

function checkReservationButton() {
	if ($('.time-slot').hasClass('selected')) {
		$('.book-button').addClass('enabled');
	} else {
		$('.book-button').removeClass('enabled');
	}
};

function checkArrows(container, index, type) {
	
	if (index == 0) 
	{
		$('.' + type + '.scroll-arrow-left').removeClass('active');
		$('.' + type + '.scroll-arrow-right').addClass('active');
	} 

	if (index == ($('.' + container).length-1)) 
	{
		$('.' + type + '.scroll-arrow-right').removeClass('active');
		$('.' + type + '.scroll-arrow-left').addClass('active');
	}

	if (index > 0 && index < ($('.' + container).length-1)) 
	{	
		if (!$('.' + type + '.scroll-arrow-left').hasClass('active')) {
			$('.' + type + '.scroll-arrow-left').addClass('active');
		}

		if (!$('.' + type + '.scroll-arrow-right').hasClass('active')) {
			$('.' + type + '.scroll-arrow-right').addClass('active');
		}
	}
};


function addEventsForGames() {
	$('.players').on('change', function() {
		if(!$('.waiting').hasClass('active')) {
			var game_name = $('.mission-container.selected').attr('id');
			//NEW!!!!!!!!
			var date = $('.mission-container.selected .datepicker').datepicker('getDate').toJSON();
			var i = $('.day-container.selected').index('.day-container');

			//change days and times to selected game
			$('.waiting').addClass('active');
			$('.mission-container.selected > .mission-image-container > .players').attr('disabled', 'disabled');
			$('.mission-container.selected > .mission-image-container > .langs').attr('disabled', 'disabled');
			$('.mission-container.selected > .mission-image-container > .datepicker').attr('disabled', 'disabled');

			getTemplateDays('./backend/index.php/reservations?game=' + game_name + '&amount=' + this.value + '&date=' + date, function() {
				$('.waiting').removeClass('active');
				$('.mission-container.selected > .mission-image-container > .players').removeAttr('disabled', 'disabled');
				$('.mission-container.selected > .mission-image-container > .langs').removeAttr('disabled', 'disabled');
				$('.mission-container.selected > .mission-image-container > .datepicker').removeAttr('disabled', 'disabled');
			});
		}	
	});

	//NEW!!!!!!!!!!
	$('.datepicker').on('change', function() {
		if(!$('.waiting').hasClass('active')) {
			var game_name = $('.mission-container.selected').attr('id');
			var amount = $('.mission-container.selected .players').val();
			//NEW!!!!!!!!
			var date = $('.mission-container.selected .datepicker').datepicker('getDate').toJSON();
			var i = $('.day-container.selected').index('.day-container');

			//change days and times to selected game
			$('.waiting').addClass('active');
			$('.mission-container.selected > .mission-image-container > .players').attr('disabled', 'disabled');
			$('.mission-container.selected > .mission-image-container > .langs').attr('disabled', 'disabled');
			$('.mission-container.selected > .mission-image-container > .datepicker').attr('disabled', 'disabled');

			getTemplateDays('./backend/index.php/reservations?game=' + game_name + '&amount=' + amount + '&date=' + date, function() {
				$('.waiting').removeClass('active');
				$('.mission-container.selected > .mission-image-container > .players').removeAttr('disabled', 'disabled');
				$('.mission-container.selected > .mission-image-container > .langs').removeAttr('disabled', 'disabled');
				$('.mission-container.selected > .mission-image-container > .datepicker').removeAttr('disabled', 'disabled');
			});
		}
	});

	//event listener : onclick-scroll by click on element
	$('.mission-container').on('click', function(event) {
		//this -> clicked object with class '.mission-container'
		if (!$(this).hasClass('selected') && !$('.waiting').hasClass('active')) {
			var i = $('.mission-container').index(this);
			var pixels = i * parseInt($('.mission-container').css('max-width'));

			var game_name = $(this).attr('id');

			$('.mission-container').attr('style', 'left: -' + pixels + 'px;');

			$(this).siblings('.selected').find('.price').css(
				{ "visibility" : "hidden" }
			);

			$(this).siblings('.selected').removeClass('selected');
			$(this).addClass('selected');

			$('.mission-container.selected').find('.price').css(
				{"visibility" : "visible"}
			);

			var players = $('.mission-container.selected').find('.players')[0];
			//NEW!!!!!!!
			var date = $('.mission-container.selected .datepicker').datepicker('getDate').toJSON();

			//change days and times to selected game
			$('.waiting').addClass('active');
			$('.mission-container.selected > .mission-image-container > .players').attr('disabled', 'disabled');
			$('.mission-container.selected > .mission-image-container > .langs').attr('disabled', 'disabled');
			$('.mission-container.selected > .mission-image-container > .datepicker').attr('disabled', 'disabled');

			getTemplateDays('./backend/index.php/reservations?game=' + game_name + '&amount=' + players.value + '&date=' + date, function() {
				$('.waiting').removeClass('active');
				$('.mission-container.selected > .mission-image-container > .players').removeAttr('disabled', 'disabled');
				$('.mission-container.selected > .mission-image-container > .langs').removeAttr('disabled', 'disabled');
				$('.mission-container.selected > .mission-image-container > .datepicker').removeAttr('disabled', 'disabled');
			});

			checkArrows('mission-container', i, 'game');
			$('.book-button').removeClass('enabled');
		}
	});

	//event listener : onclick-scroll by click on arrows
	$('.mission-carousel').on('click', function(event) {
		if ($(event.target).hasClass('scroll-arrow') && !$('.waiting').hasClass('active')) {
			var selected_game_onfocus = $(this).find('.mission-container.selected');
			
			//remove old selection
			var i = $('.mission-container').index(selected_game_onfocus);

			//press the left arrow
			if($(event.target).hasClass('scroll-arrow-left') && (i-1) >= 0) {
				$('.mission-container').siblings('.selected').find('.price').css(
					{ "visibility" : "hidden" }
				);

				selected_game_onfocus.removeClass('selected');

				var pixels = (i-1) * parseInt($('.mission-container').css('max-width'));

				selected_game_onfocus = $('.mission-container').get(i-1);

				var game_name = $(selected_game_onfocus).attr('id');
				$(selected_game_onfocus).addClass('selected');

				$('.mission-container').attr('style', 'left: -' + pixels + 'px;');

				var players = $('.mission-container.selected').find('.players')[0];
				//NEW!!!!!!!
				var date = $('.mission-container.selected .datepicker').datepicker('getDate').toJSON();
				//change days and times to selected game
				$('.waiting').addClass('active');
				$('.mission-container.selected > .mission-image-container > .players').attr('disabled', 'disabled');
				$('.mission-container.selected > .mission-image-container > .langs').attr('disabled', 'disabled');
				$('.mission-container.selected > .mission-image-container > .datepicker').attr('disabled', 'disabled');

				getTemplateDays('./backend/index.php/reservations?game=' + game_name + '&amount=' + players.value + '&date=' + date, function() {
					$('.waiting').removeClass('active');
					$('.mission-container.selected > .mission-image-container > .players').removeAttr('disabled', 'disabled');
					$('.mission-container.selected > .mission-image-container > .langs').removeAttr('disabled', 'disabled');
					$('.mission-container.selected > .mission-image-container > .datepicker').removeAttr('disabled', 'disabled');
				});

				checkArrows('mission-container', (i-1), 'game');
				$('.book-button').removeClass('enabled');
			}

			//press the right arrow
			if($(event.target).hasClass('scroll-arrow-right') && (i+1) < $('.mission-container').length) {
				$('.mission-container').siblings('.selected').find('.price').css(
					{ "visibility" : "hidden" }
				);

				selected_game_onfocus.removeClass('selected');

				var pixels = (i+1) * parseInt($('.mission-container').css('max-width'));

				selected_game_onfocus = $('.mission-container').get(i+1);

				var game_name = $(selected_game_onfocus).attr('id');
				$(selected_game_onfocus).addClass('selected');

				$('.mission-container').attr('style', 'left: -' + pixels + 'px;');

				var players = $('.mission-container.selected').find('.players')[0];
				//NEW!!!!!!!
				var date = $('.mission-container.selected .datepicker').datepicker('getDate').toJSON();
				//change days and times to selected game

				$('.waiting').addClass('active');
				$('.mission-container.selected > .mission-image-container > .players').attr('disabled', 'disabled');
				$('.mission-container.selected > .mission-image-container > .langs').attr('disabled', 'disabled');
				$('.mission-container.selected > .mission-image-container > .datepicker').attr('disabled', 'disabled');

				getTemplateDays('./backend/index.php/reservations?game=' + game_name + '&amount=' + players.value + '&date=' + date, function() {
					$('.waiting').removeClass('active');
					$('.mission-container.selected > .mission-image-container > .players').removeAttr('disabled', 'disabled');
					$('.mission-container.selected > .mission-image-container > .langs').removeAttr('disabled', 'disabled');
					$('.mission-container.selected > .mission-image-container > .datepicker').removeAttr('disabled', 'disabled');
				});

				checkArrows('mission-container', (i+1), 'game');
				$('.book-button').removeClass('enabled');
			}

			$('.mission-container.selected').find('.price').css(
				{"visibility" : "visible"}
			);
		}
	});
};

function getTemplateGames(path, callback) {
	//get data from URL and render template
    $.ajax({
    	type: 'GET',
        url: path,
        dataType: 'json',
        cache: false,
        success: function(data) {
        	renderTemplateGames(data, callback); 
        }
    });
}

function renderTemplateGames(data, callback) {
	var source = $('#firstSelectTemplate').html();
	var template = Handlebars.compile(source);

	//add rendered template
	$('#booking-container').html(template(data));

	//game 
	$('.mission-container').attr('style', 'left: 0px;');
	$('.mission-container').first().addClass('selected');
	//$('.game.scroll-arrow-right').addClass('active');

	$('.mission-container.selected').find('.price').css(
		{"visibility" : "visible"}
	);
	
	//add events
	addEventsForGames();

	//add some aditional logic after rendering template days
	if (callback) callback();
};

function getTemplateDays(path, callback) {
	reset();
	//get data from URL and render template
    $.ajax({
    	type: 'GET',
        url: path,
        dataType: 'json',
        cache: false,
        success: function(data) {
        	renderTemplateDays(data, callback); 
        }
    });
};

function reset() {
	$('.book-button').removeClass('enabled');
	$('.handlebar').empty();
	$('.handlebar').append('<div class="load-box"><div class="load"></div></div>');
};

function renderTemplateSecondStep(data, callback) {
	var game = {game: data[0], lang: data[1], date: data[2], hour: data[3], players: data[4], price: data[5]};
	var source = $('#secondSelectTemplate').html();
	var template = Handlebars.compile(source);

	$('#booking-container').html(template(game));
	// console.log(data[0]);
	if (callback) callback();
}

function renderTemplateDays(data, callback) {
	//var i = $('.day-container.selected').index('.day-container');
	
	var source = $('#dayTemplate').html();
	var template = Handlebars.compile(source);
	//add rendered template
	$('.handlebar').html(template(data));

	// day
	$('.day-container').attr('style', 'left: 0px;');
	$('.day-container').first().addClass('selected');
	//arrow
	$('.day.scroll-arrow-right').addClass('active');
		
	addEventsForTemplateDays();

	//add some aditional logic after rendering template days
	if (callback) callback();
};

function addEventsForTemplateDays() {
	//event listener : onclick-scroll by click on element
	$('.day-container').on('click', function(event) {
		
		// do something only if day is free
		if($(event.target).hasClass('available peak') 
									|| $(event.target).hasClass('available')
														|| $(event.target).hasClass('day-title')) {
			/*
			*	the same day
			*/
			if ($(this).hasClass('selected')) {

				if(!$(event.target).hasClass('time-slot selected')) {	
					$(event.target).siblings('.time-slot').removeClass('selected');
					$(event.target).addClass('selected');
				}
			}
		}

		/*
		*	different day
		*/
		if (!$(this).hasClass('selected')) {
			//$('.day-container.selected').children().animate({"zoom": "100%"}, 80);
			//remove old selection
			$(this).siblings('.selected').children('.time-slot').removeClass('selected');
			$(this).siblings('.selected').removeClass('selected');

			//add new selection
			$(this).addClass('selected');
			if($(event.target).hasClass('available')) {
				$(event.target).addClass('selected');
			}

			var i = $('.day-container').index(this);

			//change pixels of elements to make animation
			var pixels = i * 200;
			//$('.day-container.selected').children().animate({"zoom": "130%"}, 300);
      		$('.day-container').attr('style', 'left: -' + pixels + 'px;');
 			checkArrows('day-container', i, 'day');
		}

		checkReservationButton();
		//}
	});

	//event listener : onclick-scroll by click on arrows
	$('.day-carousel').on('click', function(event) {

		if ($(event.target).hasClass('scroll-arrow')) {
			var selected_time_onfocus = $(this).find('.day-container.selected');
			//$(selected_time_onfocus).children().animate({"zoom": "100%"}, 70);

			var i = $('.day-container').index(selected_time_onfocus);

			//press the left arrow
			if($(event.target).hasClass('scroll-arrow-left') && (i-1) >= 0) {
				selected_time_onfocus.children('.time-slot').removeClass('selected');
				selected_time_onfocus.removeClass('selected');

				var pixels = (i-1) * 200;

				selected_time_onfocus = $('.day-container').get(i-1);
				$(selected_time_onfocus).addClass('selected');

				//$('.day-container.selected').children().animate({"zoom": "130%"}, 180);
				$('.day-container').attr('style', 'left: -' + pixels + 'px;');

				checkArrows('day-container', (i-1), 'day');
			}

			//press the right arrow
			if($(event.target).hasClass('scroll-arrow-right') && (i+1) < $('.day-container').length) {
				//console.log(selected_time);

				selected_time_onfocus.children('.time-slot').removeClass('selected');
				selected_time_onfocus.removeClass('selected');

				var pixels = (i+1) * 200;
				
				selected_time_onfocus = $('.day-container').get(i+1);
				$(selected_time_onfocus).addClass('selected');

				//$('.day-container.selected').children().animate({"zoom": "130%"}, 180);
				$('.day-container').attr('style', 'left: -' + pixels + 'px;');

				checkArrows('day-container', (i+1), 'day');
			}

			checkReservationButton();
		}
	});
};






















