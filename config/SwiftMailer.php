<?php

return [
    Swift_SmtpTransport::class => function () {
        return  new Swift_SmtpTransport( 'localhost',1025);
    }
];
