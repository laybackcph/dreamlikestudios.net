(function( $ ) {
    "use strict";
    wp.customize( 'link_color', function( value ) {
        value.bind( function( to ) {
            $( 'a' ).css( 'color', to );
        } );
    });
 
})( jQuery );