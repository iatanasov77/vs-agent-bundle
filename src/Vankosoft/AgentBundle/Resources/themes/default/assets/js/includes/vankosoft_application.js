
$( '#btnShowVankosoftApplicationsForm' ).on( 'click', function( e )
{
    /** Bootstrap 5 Modal Toggle */
    const myModal = new bootstrap.Modal( '#deleteVankosoftApplicationModal', {
        keyboard: false
    });
    myModal.show( $( '#deleteVankosoftApplicationModal' ).get( 0 ) );
});
