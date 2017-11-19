<?php

$returned_message = null;
if ( !empty($_SERVER['CONTENT_LENGTH']) && empty($_FILES) && empty($_POST) ) {
    $message_buf_rum = 'Fisierul atasat este prea mare (se accepta o dimensiune de maxim ' . ini_get("upload_max_filesize") . ')';
    $returned_message =
        '<div class="col-xs-12 col-sm-12">
			<div class="alert alert-danger" style="margin-bottom:15px; padding: 6px 12px 6px 12px;">
				' .  $message_buf_rum . '
			</div>
		</div>';
}
$action = isset($_POST['action']) && in_array($_POST['action'], array('client', 'teacher')) ? trim($_POST['action']) : null;
if ( isset($_POST) && ! empty($_POST) && $action ) {
	$full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $message = isset($_POST['message']) ? $_POST['message'] : '';
	
	$to = get_option( 'admin_email', 'laurcalin@yahoo.com' );
	if ($action == 'teacher')
        $subject = '[Notificare] Completare formular - tip profesor';
    else
        $subject = '[Notificare] Completare formular - tip client';
	$body = "\n";
	$body .= "Nume: $full_name\n";
	$body .= "Email: $email\n";
	$body .= "Telefon: $phone\n";
	
	$newsletter = ( isset($_POST['newsletter']) && $_POST['newsletter'] == 'on' ) ? true : false;
    $newsletter_email_content = $newsletter ? "Doresc sa primesc noutati pe email" : "Nu doresc sa primesc noutati pe email";
    $body .= "$newsletter_email_content\n";
	if ($newsletter) {
		processing_mailchimp_registration($email);
	}
	
	$body .= "---------\n";
	$body .= "Mesaj: " . $message . "\n";
	
	$headers[] = 'Contact <contact@bufnitadintei.ro>';

    $attachments = array();  // initialize attachment array
    if ($action == 'teacher') {
        $upload_dir = wp_upload_dir();  // look for this function in wordpress documentation at codex
        $upload_dir = $upload_dir['basedir'];

        foreach ($_FILES as $presentation_file => $file) {
            if ($file['error'] == UPLOAD_ERR_OK) {
                $tmp_name = $file["tmp_name"]; // Get temp name of uploaded file
                $name = time() . '_' . $file["name"];  // rename it to whatever
                $status = move_uploaded_file($tmp_name, "$upload_dir/attachments/$name"); // move file to new location
                $attachments[] = "$upload_dir/attachments/$name";  //  push the new uploaded file in attachment array
            }
        }
    }

    //echo '<pre>';print_R($_FILES);print_R($_FILES['presentation_file']); print_r($attachments);die;
	$mesaj_eroare =
		'<div class="col-xs-12 col-sm-12">
			<div class="alert alert-danger" style="margin-bottom:15px; padding: 6px 12px 6px 12px;">
				A aparut o eroare! Va rugam incercati mai tarziu!
			</div>
		</div>';
	$mesaj_success = 
		'<div class="col-xs-12 col-sm-6">
			<div class="alert alert-success" style="margin-bottom:15px; padding: 6px 12px 6px 12px;">
				Mesajul dumneavoastra a fost transmis.
			</div>
		</div>';
	$email_message = wp_mail( $to, $subject, $body, $headers, $attachments ) ? true : false;

    //remove all attachments file;
    if(!empty($attachments)) {
        foreach($attachments as $attachment) {
            @unlink($attachment); // delete files after sending them
        }
    }

	$returned_message = $email_message ? $mesaj_success : $mesaj_eroare;
}


