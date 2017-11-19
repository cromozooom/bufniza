<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bufnita
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<link rel="icon" href="<?php echo get_template_directory_uri()?>/assets/favicon.ico">
	<!-- Bootstrap core CSS-->
	<link href="<?php echo get_template_directory_uri()?>/assets/css/app.css" rel="stylesheet">
	<meta name="geo.placename" content="Serg. Nitu Vasile nr. 26, Sector4. Bucuresti, Romania." />
	<meta name="geo.position" content="44.392531, 26.119870" />
	<meta name="geo.region" content="RO-B" />
	<meta name="ICBM" content="44.392531, 26.119870" />
</head>

<body class="undefined">
        <svg style="display: none;">
            <symbol id="logo">
                <defs>
                    <style type="text/css">
                        /* latin */
                        @font-face
                        font-family: 'Montserrat'
                        font-style: normal
                        font-weight: 400
                        src: local('Montserrat-Regular'), url(https://fonts.gstatic.com/s/montserrat/v6/zhcz-_WihjSQC0oHJ9TCYAzyDMXhdD8sAj6OAJTFsBI.woff2) format('woff2')
                        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000
                        /* latin */
                        @font-face
                        font-family: 'Montserrat'
                        font-style: normal
                        font-weight: 700
                        src: local('Montserrat-Bold'), url(https://fonts.gstatic.com/s/montserrat/v6/IQHow_FEYlDC4Gzy_m8fcmaVI6zN22yiurzcBKxPjFE.woff2) format('woff2')
                        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000
                        /* latin */
                        @font-face
                        font-family: 'Old Standard TT'
                        font-style: normal
                        font-weight: 400
                        src: local('Old Standard TT Regular'), local('OldStandardTT-Regular'), url(https://fonts.gstatic.com/s/oldstandardtt/v7/n6RTCDcIPWSE8UNBa4k-DJDiI8zI8NGcbDOKyTTsY20.woff2) format('woff2')
                        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000
                        /* latin */
                        @font-face
                        font-family: 'Old Standard TT'
                        font-style: italic
                        font-weight: 400
                        src: local('Old Standard TT Italic'), local('OldStandardTT-Italic'), url(https://fonts.gstatic.com/s/oldstandardtt/v7/QQT_AUSp4AV4dpJfIN7U5LFe6RXWndt-yIBvO8h3x9Q.woff2) format('woff2')
                        unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215, U+E0FF, U+EFFD, U+F000
                    </style>
                </defs>
                <text transform="matrix(1 0 0 1 187.1919 62.7202)" fill="#414042" font-family="'Montserrat'" font-size="19.0323" font-weight="700" font-size="19.0323">descopera lumea</text>
                <text transform="matrix(1 0 0 1 186.2866 39.7115)" fill="#ffffff" font-family="'Montserrat'" font-size="29.9079">BUFNITA DIN TEI</text>
                <path id="hand_1_" fill="#0C6E63" d="M160.965,25.855c-1.314-2.276-4.223-3.054-6.5-1.742l-25.789,14.889l0,0
                    c-0.635,0.368-1.241,0.287-1.547,0.204c-0.305-0.081-0.871-0.313-1.239-0.951c-0.367-0.636-0.285-1.242-0.203-1.547
                    c0.082-0.305,0.313-0.871,0.95-1.238l29.322-16.929c2.275-1.314,3.055-4.224,1.742-6.5c-1.314-2.276-4.222-3.055-6.5-1.742
                    L121.879,27.23c0,0,0,0,0,0l-0.001,0l-2.354,1.359c-0.637,0.368-1.244,0.285-1.547,0.204c-0.305-0.081-0.871-0.313-1.238-0.95
                    c-0.562-0.974-0.228-2.223,0.746-2.785c0.115-0.066,0.208-0.153,0.315-0.227l22.943-13.246c2.275-1.314,3.055-4.224,1.742-6.5
                    c-1.314-2.276-4.224-3.054-6.5-1.742l-26.496,15.298c0.841-5.602-0.226-11.283-3.101-16.262c-1.314-2.276-4.224-3.055-6.5-1.742
                    c-2.275,1.314-3.055,4.224-1.742,6.5c2.088,3.616,2.643,7.829,1.562,11.863c-1.081,4.034-3.668,7.405-7.284,9.493
                    c-0.23,0.133-0.433,0.292-0.631,0.455c-11.491,7.113-15.358,22.151-8.555,33.935c3.359,5.817,8.783,9.979,15.271,11.718
                    c2.167,0.58,4.365,0.868,6.55,0.868c4.358,0,8.659-1.143,12.534-3.38l19.104-11.03c0,0,0.001,0,0.001-0.001
                    c0,0,0.001,0,0.001-0.001l16.214-9.361c2.275-1.314,3.055-4.224,1.742-6.5c-1.314-2.276-4.224-3.055-6.5-1.742l-16.22,9.365
                    c-0.973,0.555-2.218,0.222-2.78-0.751c-0.367-0.636-0.285-1.242-0.203-1.547c0.082-0.305,0.313-0.87,0.949-1.238l29.322-16.929
                    C161.499,31.041,162.279,28.131,160.965,25.855z"/>
                <path id="hand" fill="#0C6E63" d="M69.811,28.948c-0.198-0.163-0.402-0.322-0.631-0.455c-3.616-2.088-6.203-5.459-7.284-9.492
                    c-1.081-4.034-0.526-8.247,1.562-11.863c1.314-2.275,0.534-5.186-1.742-6.5c-2.275-1.312-5.185-0.533-6.5,1.742
                    c-2.952,5.113-3.898,10.841-3.086,16.27L25.619,3.344c-2.275-1.312-5.186-0.533-6.5,1.742c-1.314,2.275-0.534,5.186,1.742,6.5
                    l22.947,13.249c0.106,0.073,0.198,0.159,0.311,0.224c0.974,0.562,1.309,1.812,0.747,2.786c-0.367,0.637-0.933,0.868-1.238,0.95
                    c-0.305,0.082-0.91,0.165-1.547-0.203l0,0l-2.355-1.359l-0.001,0c0,0,0,0,0,0L10.403,10.301c-2.276-1.311-5.186-0.534-6.5,1.742
                    c-1.314,2.275-0.534,5.186,1.742,6.5l29.322,16.929c0.973,0.562,1.309,1.811,0.746,2.785c-0.367,0.637-0.933,0.868-1.238,0.95
                    c-0.305,0.081-0.911,0.164-1.548-0.204l0,0L7.138,24.114c-2.275-1.312-5.185-0.533-6.5,1.742c-1.314,2.275-0.534,5.186,1.742,6.5
                    l29.322,16.929c0.636,0.367,0.868,0.933,0.949,1.238c0.082,0.305,0.164,0.911-0.204,1.548c-0.56,0.972-1.806,1.306-2.779,0.749
                    l-16.22-9.365c-2.275-1.312-5.185-0.533-6.5,1.742c-1.314,2.275-0.534,5.186,1.742,6.5l16.214,9.361c0,0,0.001,0,0.001,0
                    l0.002,0.001l19.104,11.03c3.875,2.237,8.176,3.38,12.534,3.38c2.185,0,4.384-0.287,6.55-0.868
                    c6.489-1.738,11.912-5.9,15.271-11.718C85.168,51.099,81.301,36.061,69.811,28.948z"/>
                <circle id="cover_hand" fill="#0D6E63" cx="80.802" cy="62.939" r="7.552"/>
                <circle id="bulb_1_" fill="#FFFFFF" cx="105.018" cy="50.308" r="16.993"/>
                <circle id="bulb" fill="#FFFFFF" cx="56.585" cy="50.308" r="16.993"/>
                <path id="glases" fill="#51BAAC" d="M122.089,40.452c-3.511-6.081-10.058-9.859-17.087-9.859c-3.442,0-6.844,0.914-9.84,2.644
                    c-5.303,3.062-8.645,8.233-9.581,13.848c-1.409-0.814-3.038-1.288-4.779-1.288c-1.741,0-3.371,0.474-4.78,1.288
                    c-0.936-5.615-4.277-10.786-9.581-13.848c-2.996-1.73-6.398-2.644-9.84-2.644c-7.029,0-13.576,3.778-17.087,9.859
                    c-2.633,4.56-3.332,9.872-1.969,14.958s4.625,9.336,9.184,11.969c2.995,1.729,6.398,2.644,9.84,2.644h0.001
                    c7.028,0,13.575-3.778,17.086-9.859c1.417-2.454,2.231-5.089,2.513-7.741c0.981-1.527,2.686-2.547,4.633-2.547
                    c1.946,0,3.651,1.02,4.632,2.547c0.282,2.652,1.096,5.287,2.513,7.741c3.511,6.081,10.058,9.859,17.087,9.859
                    c3.442,0,6.844-0.914,9.84-2.644c4.56-2.633,7.822-6.883,9.185-11.969S124.722,45.011,122.089,40.452z M68.947,57.445
                    c-2.543,4.404-7.286,7.14-12.378,7.14c-2.489,0-4.951-0.662-7.121-1.915c-3.302-1.906-5.664-4.984-6.651-8.668
                    c-0.987-3.683-0.481-7.529,1.426-10.831c2.543-4.404,7.286-7.14,12.378-7.14c2.489,0,4.951,0.662,7.121,1.915
                    C70.539,41.881,72.882,50.628,68.947,57.445z M118.806,54.002c-0.987,3.683-3.349,6.761-6.651,8.668
                    c-2.17,1.253-4.633,1.915-7.121,1.915c-5.092,0-9.835-2.736-12.378-7.14c-3.935-6.817-1.592-15.563,5.225-19.499
                    c2.171-1.253,4.633-1.915,7.121-1.915c5.092,0,9.835,2.735,12.378,7.14C119.287,46.472,119.793,50.319,118.806,54.002z"/>
                <circle id="iris_1_" fill="#FED208" cx="105.018" cy="50.308" r="10.876"/>
                <circle id="iris" fill="#FED208" cx="56.585" cy="50.308" r="10.876"/>
                <circle id="pupils_1_" cx="105.018" cy="50.308" r="5.438"/>
                <circle id="pupils" cx="56.585" cy="50.308" r="5.438"/>
                <path id="ciocRight" fill="#FED208" d="M80.738,80c0,0,6.953-16.965,0-21.111c-7.49,0-14.543,5.118-14.543,5.118L80.738,80z"/>
                <path id="ciocLeft" fill="#F1B147" d="M80.865,80c0,0-6.953-16.965,0-21.111c7.49,0,14.543,5.118,14.543,5.118L80.865,80z"/>
            </symbol>
        </svg>
        <div role="navigation" class="navbar navbar-inverse navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" data-toggle="collapse" data-target=".navbar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                    <a href="<?=site_url()?>" class="navbar-brand">
                        <svg viewBox="0 0 445 80" width="332" height="60" class="hidden-xs hidden-sm hidden-md">
                            <use xlink:href="#logo" x="0" y="0"></use>
                        </svg>
                        <svg viewBox="0 0 170 80" width="170" height="60" class="hidden-lg">
                            <use xlink:href="#logo" x="0" y="0"></use>
                        </svg>
                    </a>
                </div>
                <div class="collapse navbar-collapse navbar-right">
				<?php 
					$defaults = array(
						'container'       => '',
						'menu_class'      => 'nav navbar-nav',
					);
				?>
					<?php wp_nav_menu( $defaults ); ?>
					  <div class="col-xs-12 navbar-form">
						<div class="input-group">
						  <form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
							  <input name="s" type="text" placeholder="cauta..." class="form-control" value="<?=get_search_query()?>"><span class="input-group-btn">
							  <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button></span>
						  </form>
						</div>
					</div>
				  </div>
                <!-- /.nav-collapse-->
            </div>
        </div>