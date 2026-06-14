// bin/console fos:js-routing:dump --format=json --target=public/shared_assets/js/fos_js_routes_admin.json
import { VsPath } from '@@/js/includes/fos_js_routes.js';
import { VsSpinnerShow, VsSpinnerHide } from '@@/js/includes/vs_spinner.js';

$( '#btnShowVankosoftApplicationsForm' ).on( 'click', function( e )
{
    /** Bootstrap 5 Modal Toggle */
    const myModal = new bootstrap.Modal( '#deleteVankosoftApplicationModal', {
        keyboard: false
    });
    myModal.show( $( '#deleteVankosoftApplicationModal' ).get( 0 ) );
});

$( '#btnDeleteApplication' ).on( 'click', function ( e )
{
    let formData    = new FormData();
    formData.set( "application", $( '#vankosoft_application_form_application' ).val() );
    
    VsSpinnerShow();
    $.ajax({
        type: 'GET',
        url: VsPath( 'vs_agent_actions_delete_application' ),
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function ( response ) {
            VsSpinnerHide();
            
            if ( response.status == 'ok' ) {
                alert( 'Application Deleted.' );
                document.location = document.location;
            } else {
                alert( 'RESPONSE ERROR!!!' );
            }
        }, 
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            VsSpinnerHide();
            
            alert( 'FATAL ERROR!!!' );
        }
    });
});
