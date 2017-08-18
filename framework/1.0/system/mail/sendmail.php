<?php
Kernel::Import('classes.html_mime_mail.mail');

class SendMail {

	function SendMail($to, $html, $subject, $headers) {
		// init mime sender
		$mimeMail = new htmlMimeMail();
		$imgurl = FILESTORAGE_URL.'mail/';
		$imgpath = FILESTORAGE.'mail';
		$html = str_replace('src="'.$imgurl, 'src="', $html);
		$html = str_replace('background="'.$imgurl, 'background="', $html);
		// tune settings
		$mimeMail->setHtml($html, str_replace('&nbsp;', ' ', strip_tags($html)), $imgpath.'/');
		$mimeMail->headers['From'] = $headers['From'];
		$mimeMail->headers['FromName'] = SITE_FROM_NAME;
		$mimeMail->headers['Subject'] = $subject;
		// include attachments
		$result = $mimeMail->send(array($to));
		unset($mimeMail);
		return $result;
	}

}