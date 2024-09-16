<?php

return [
	'mode'                  => 'utf-8',
	'format'                => 'A4',
	'author'                => '',
	'subject'               => '',
	'keywords'              => '',
	'creator'               => 'M2 Technology',
	'display_mode'          => 'fullpage',
	'tempDir'               => base_path('storage/app/mpdf'),
	'pdf_a'                 => false,
	'pdf_a_auto'            => false,
	'icc_profile_path'      => '',
	'defaultCssFile'        => false,
	'pdfWrapper'            => 'misterspelik\LaravelPdf\Wrapper\PdfWrapper',
	// 'defaultCssFile'				=> base_path('public/assets/vendor/css/core.css')
];
