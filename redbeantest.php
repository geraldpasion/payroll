<?php

require 'rb.php';


     R::setup( 'mysql:host=localhost;dbname=payroll','root', '' ); //for both mysql or mariaDB
    R::setAutoResolve( TRUE );        //Recommended as of version 4.2

    //turns debugging ON (recommended way)
    R::fancyDebug( TRUE );

    $post = R::dispense( 'rb' );
    $post-> name = 'Hello World';

    $id = R::store( $post );          //Create or Update
    echo "id: ".$id;

    $post2 = R::load( 'rb', $id );   //Retrieve
    $post2 -> name = "xxx";
    $post2 -> id = $id;				//always add id

    $id = R::store( $post2 );
    //R::trash( $post );                //Delete


?>