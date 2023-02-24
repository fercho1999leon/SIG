<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => '"'.env('PDF_BINARY', '/usr/local/bin/wkhtmltopdf').'"',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => '"'.env('IMAGE_BINARY', '/usr/local/bin/wkhtmltoimage').'"',
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
