<?php

$_CONFIG = array(
    'qrcodes_dir' => 'qrcodes',                 // qr codes directory
    'delete_old_files' => true,                 // delete periodically old files
    'file_lifetime' => 24,                      // delete files older than..(hours) from /uploads_dir and /qrcodes_dir
    'uploader' => true,                         // let users upload their own logo
    'qr_bgcolor' => '#FFFFFF',                  // default background
    'qr_color' => '#000000',                    // default foreground
    'placeholder' => 'images/placeholder.svg',  // default placeholder
    'color_primary' => false,                   // main color, used for buttons and header background. set a #hex color or false to get random colors
    );
