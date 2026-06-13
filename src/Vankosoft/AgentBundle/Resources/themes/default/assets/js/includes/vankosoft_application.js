
$( '#btnShowVirtualHostForm' ).on( 'click', function( e )
{
    /** Bootstrap 5 Modal Toggle */
    const myModal = new bootstrap.Modal( '#btnShowVankosoftApplicationForm', {
        keyboard: false
    });
    myModal.show( $( '#btnShowVankosoftApplicationForm' ).get( 0 ) );
});
