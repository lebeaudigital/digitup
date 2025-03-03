<?php
function removeEmoji( $string ) {
    $string = str_replace( "?", "{%}", $string );
    $string  = mb_convert_encoding( $string, "ISO-8859-1", "UTF-8" );
    $string  = mb_convert_encoding( $string, "UTF-8", "ISO-8859-1" );
    $string  = str_replace( array( "?", "? ", " ?" ), array(""), $string );
    $string  = str_replace( "{%}", "?", $string );
    return trim( $string );
}