/*! -- ^#User Dashboard Page */

if ( $('body').hasClass('page-template-template-userDashboard') ) {

	/* .mainDashView Tab Switching */

	$('.scmTabWrap .labelBar').click(function() {
		$('.scmdropWrapper').slideToggle('2000', 'swing');
		$(this).toggleClass('open');
	});
	
	$('.scmTabWrap .labelBar').click(function() {
		$('.scmDropWrapper').slideToggle('2000', 'swing');
		$(this).toggleClass('open');
	});
		
	$('.scmTabButton').click(function() {
		
		//Switch active Tab Buttons and close the Menu.
		$('.scmTabButton.active').removeClass('active');
		$(this).addClass('active');
		var text = $(this).text();
		$('.scmTabWrap .labelBar .text').text(text);
		$('.scmdropWrapper').slideUp('2000', 'swing');
		$('.scmTabWrap .labelBar').removeClass('open');
		
		//Get the attribute and call function to switch active tabs.
		var attr = '#' + $(this).attr('data-sectionID');
		switchAchTabs(attr);
		
	});
	$('.scmTabButton').click(function() {

		//Switch active Tab Buttons and close the Menu.
		$('.scmTabButton.active').removeClass('active');
			$(this).addClass('active');
			var text = $(this).text();
			$('.scmTabWrap .labelBar .text').text(text);
			$('.scmDropWrapper').slideUp('2000', 'swing');
			$('.scmTabWrap .labelBar').removeClass('open');
			
			//switch active tab on desktop as well
			var attr = $(this).attr('data-sectionID');
			$('.scDeskTabButton.active').removeClass('active');
			$('.scDeskTabButton[data-sectionID="'+attr+'"]').addClass('active');
			
			//Get the attribute and call function to switch active tabs.
			var attr2 = '#' + attr;
			switchDeskTabComplete(attr2);
	});

	/*! -- ^#Insurance Sub Tab Buttons - Desktop */
	$('.scDeskTabButton').click(function() {
		if ( $(this).hasClass('active') ) { return; }
		
		//scroll page to top again
		var dest = $('.scDeskTabWrap').offset().top - $('header').height() - 30;
		$('html,body').animate({scrollTop:dest}, 1000, 'swing');
		
		//switch active buttons and call function to change sections
		$('.scDeskTabButton').removeClass('active');
		$(this).addClass('active');
		var attr = $(this).attr('data-sectionID');
		
		//switch active mobile button
		$('.scmTabButton.active').removeClass('active');
		$('.scmTabButton[data-sectionID="'+attr+'"]').addClass('active');
		var text = $('.scmTabButton[data-sectionID="'+attr+'"]').text();
		$('.scmTabWrap .labelBar .text').text(text);
		
		var attr2 = "#" + attr;
		switchDeskTabComplete(attr2);
	});
	
	/*! -- ^# Switch Achievement Tab Sections */
	function switchAchTabs(newSect) {
		
		//close active section
		$('.sectionSingle.active').slideUp('2000', function() {
			$('.sectionSingle.active').removeClass('active');
			$(newSect).slideDown('2000', function() { 
				$(newSect).addClass('active');
			});
		});
	};
	
	/*! -- ^#Switch Achievement Sub Tab Sections */
	function switchDeskTabComplete(newSect) {
		
		//close active section
		$('.scDeskTabComplete.active').slideUp('2000', function() {
			$('.scDeskTabComplete.active').removeClass('active');
			$(newSect).slideDown('2000', function() { 
				$(newSect).addClass('active');
			});
		});
	};

	/*! --^#Switch between Dashboard/Edit Profile */

	/* slide out and swich sidebar links */
	$('.dashButton').click(function() {
		var attr1 = "#" + $(this).attr("id");
		//Switch active button
		$('.dashButton.active').slideUp('3000', function() {
			$('.dashButton.active').removeClass('active');
			/* $('.wpmem_msg').css("display", "block"); */

			$(attr1).slideDown('3000', function() { 
				$(attr1).addClass('active');
			});
		});
			
		var attr2 = $(this).data("class");
		switchDashViews(attr2);
	});
	
	/*! -- ^#Switch Dashboard Sections */
	function switchDashViews(newSect) {
		/* littleHeroes needs margin to stop from glitching during slide */
		$('.littleHeroes').css("margin-top", "900px");
		$('#wpmem_msg').css("display", "block");
		//close active section
		$('.dashView.open').slideUp('3000', function() {
			$('.dashView.open').removeClass('open');
		//open new section
			$(newSect).slideDown('3000', function() { 
				$(newSect).addClass('open');
			});
		});
	};

	/*! -- ^#Edit Profile Form */
	$('[name="submit"]').attr("id", "editInfo"); 
	/* directs form to edit profile tab */
	$('[name="form"]').attr("action", "/user-profile-page/#Edit");

	/* show confirmation message */
	$('#editInfo').click(function() { 
		$('.wpmem_msg').css("display", "block");
	});
} //if User Dashboard Page


/* Hash URL for Edit Profile */
var hash = window.location.hash;
if ( hash == "#Edit") {
	navTab = $('.editProfile');
	switchTabs(navTab);
}

function switchTabs(navButton) {

	var newSect = $('.dashView:not(.open)');
	var newButton = $('.dashButton:not(.active)');
	
	//remove comments for animated slide up/down
	/* $('.littleHeroes').css("margin-top", "900px"); */
	/* $('.dashView.open').slideUp(500, function() { */
		$('.dashButton.active').removeClass('active');
		$('.dashView.open').removeClass('open');
		/* newSect.slideDown(500); */
		newButton.addClass('active');
		newSect.addClass('open');
	/* }); */
}