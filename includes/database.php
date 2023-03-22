<?php

$connect = mysqli_connect( "<DB_HOST>","<DB_USER>","<DB_PASSWORD>", "<DB_DATABASE>" );

mysqli_set_charset( $connect, 'UTF8' );

// mysqli_query( $connect, 'SET character_set_results=utf8' );
