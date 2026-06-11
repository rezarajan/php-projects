<?php
putenv('LANG=en_US.UTF-8');
putenv('LC_ALL=en_US.UTF-8');
putenv('LANGUAGE=fr_FR');

setlocale(LC_ALL, 'en_US.UTF-8');

bindtextdomain('messages', __DIR__ . '/locale');
bind_textdomain_codeset('messages', 'UTF-8');
textdomain('messages');

echo gettext("Hello World") . PHP_EOL;
