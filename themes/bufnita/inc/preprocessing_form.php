<?php
$returned_message = null;
$data_from_course = array(
	'render_footer_mic' => false,
	'render_footer_mijlociu' => false,
	'render_footer_mare' => false,
	'render_footer_dummy' => true,
	'id' => get_the_ID(),
	'c' => @$_REQUEST['c'],
);
$returned_message = null;
$CPTCourseFieldsIDMapping = getCPTCourseFieldsIDMapping();
foreach ($CPTCourseFieldsIDMapping as $meta_data_key) {
	$data_from_course[$meta_data_key] = null;
}

if ( isset($_REQUEST['c']) && $_REQUEST['c']) {
	$post = get_page_by_path($_REQUEST['c'], OBJECT, 'course');
	$meta_data = get_post_meta( get_the_ID() );
	$data_from_course['id'] = get_the_ID();
	foreach ($CPTCourseFieldsIDMapping as $meta_data_key) {
		$data_from_course[$meta_data_key] = isset($meta_data[$meta_data_key][0]) ? $meta_data[$meta_data_key][0] : null;
	}
}
if ( isset($_POST) && ! empty($_POST) ) {
    $captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null;
    if (!$captcha) {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfE5QwTAAAAAMg5ufrw-KlM0A8MLiOIFERrKyN5&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    $resp = json_decode($response);
    if ($resp && !$resp->success) {
        echo '<h2>You are spammer ! Get the @$%K out</h2>';
        exit;
    }
    $full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $child_last_name = isset($_POST['child_last_name']) ? $_POST['child_last_name'] : '';
    $child_birthday = isset($_POST['child_birthday']) ? $_POST['child_birthday'] : '';
    $child_category = isset($_POST['child_category']) ? $_POST['child_category'] : '';
    $child_description = isset($_POST['child_description']) ? $_POST['child_description'] : '';
    $course_post_id = isset($_POST['course_post_id']) ? $_POST['course_post_id'] : '';

    $course_c = isset($_POST['c']) ? $_POST['c'] : '';

    $request_course = get_post($course_post_id);
    $days = $intervals = array();
    if ($child_category && in_array($child_category, array('mic', 'mare', 'mijlociu'))) {
        $subcateg = getCPTCourseFieldsIDMappingLabels();
        $subcateg = $subcateg[$child_category];

        foreach ($subcateg['zile'] as $key => $meta_data_key) {
            if (isset($_POST[$key]))
                $days[] = $meta_data_key;
        }
        foreach ($subcateg['interval'] as $key => $meta_data_key) {
            if (isset($_POST[$key]))
                $intervals[] = $meta_data_key;
        }
    }
    $days = implode(', ', $days);
    $intervals = implode(', ', $intervals);

    $to = get_option('admin_email', 'laurcalin@yahoo.com'); //laurcalin@yahoo.com

    $cismigiu = substr($course_c, -8);
    if ($cismigiu == "cismigiu") {
    $subject = ($request_course && $request_course->post_title) ?
        ('[Notificare] Cerere inscriere pentru cursul ' . $request_course->post_title) . " - CISMIGIU" :
        '[Notificare] Cerere inscriere curs';
    }else{
        $subject = ($request_course && $request_course->post_title) ?
            ('[Notificare] Cerere inscriere pentru cursul ' . $request_course->post_title) :
            '[Notificare] Cerere inscriere curs';
    }

	$body = "\n";
	$body .= "Nume: $full_name\n";
	$body .= "Email: $email\n";
	$body .= "Telefon: $phone\n";
	
	$newsletter = ( isset($_POST['newsletter']) && $_POST['newsletter'] == 'on' ) ? true : false;
    $newsletter_email_content = $newsletter ? "Doresc sa primesc noutati pe email" : "Nu doresc sa primesc noutati pe email";
	if ($newsletter) {
		processing_mailchimp_registration($email);
	}
    $body .= "$newsletter_email_content\n";
	$body .= "---------\n";
	$body .= "Zi/Zile de curs solicitata(e): " . ($days ? $days : 'nespecificat') . "\n";
	$body .= "Interval(e) de curs solicitat(e): " . ($intervals ? $intervals : 'nespecificat') . "\n";
	$body .= "---------\n";
	$body .= "Numele copilului: $child_last_name\n";
	$body .= "Data de nastere a copilului: $child_birthday\n";
	$body .= "Categoria de varsta: $child_category\n";
	$body .= "Despre copil: $child_description\n";	
	//wp_mail( $to, $subject, $body );
	
	$mesaj_eroare = 
		'<div class="col-xs-12 col-sm-12">
			<div class="alert alert-danger" style="margin-bottom:15px; padding: 6px 12px 6px 12px;">
				A aparut o eroare! Va rugam incercati mai tarziu!
			</div>
		</div>';
	$mesaj_success = 
		'<div class="col-xs-12 col-sm-6">
			<div class="alert alert-success" style="margin-bottom:15px; padding: 6px 12px 6px 12px;">
				Formularul dumneavoastra a fost transmis.
			</div>
		</div>';

	$debug = '<div class="col-xs-12 col-sm-6"><div class="alert alert-success" style="margin-bottom:15px; padding: 6px 12px 6px 12px;">'.$subject.'.</div></div>';

	$email_message = wp_mail( $to, $subject, $body ) ? true : false;

	$returned_message = $email_message ? $mesaj_success : $mesaj_eroare;
    //$returned_message = $email_message ? $debug : $mesaj_eroare;
}


