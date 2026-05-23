// bin/console fos:js-routing:dump --format=json --target=public/shared_assets/js/fos_js_routes_admin.json
import { VsPath } from '@@/js/includes/fos_js_routes.js';
import { VsSpinnerShow, VsSpinnerHide } from '@@/js/includes/vs_spinner.js';

$( function()
{
    $( '#btnShowVirtualHostForm' ).on( 'click', function( e )
    {
        /** Bootstrap 5 Modal Toggle */
        const myModal = new bootstrap.Modal( '#brokeVirtualHostModal', {
            keyboard: false
        });
        myModal.show( $( '#brokeVirtualHostModal' ).get( 0 ) );
    });

    $( '#btnShowBrokenVirtualHost' ).on( 'click', function( e )
    {
        VsSpinnerShow();
        $.ajax({
            type: 'GET',
            url: VsPath( 'vs_agent_actions_show_broken_virtual_host' ),
            success: function ( response ) {
                VsSpinnerHide();
                
                if ( response.status == 'ok' ) {
                    alert( response.data.filecontents );
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
    
	$( '#btnBrokeVirtualHost' ).on( 'click', function ( e )
    {
        VsSpinnerShow();
        $.ajax({
            type: 'GET',
            url: VsPath( 'vs_agent_actions_broke_virtual_host' ),
            success: function ( response ) {
                VsSpinnerHide();
                
                if ( response.status == 'ok' ) {
                    alert( response.data.filecontents );
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
});
