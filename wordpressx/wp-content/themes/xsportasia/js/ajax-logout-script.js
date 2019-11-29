jQuery(document).ready(function($) {'use strict';

    var logout_url = $('#logout-url').text();

    $('#navigation ul li.signup-signin a').text('Logout').attr("href", logout_url );

});