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
        var taskId = $( this ).attr( 'data-taskId' );
        
        $.ajax({
            type: "GET",
            url: VsPath( 'vs_issue_tracking_project_issues_kanbanboard_task_assign_member_form', {'taskId': taskId } ),
            success: function( response )
            {
                $( '#AssignMemberModalBody' ).html( response );
                
                /** Bootstrap 5 Modal Toggle */
                const myModal = new bootstrap.Modal( '#inviteMembersModal', {
                    keyboard: false
                });
                myModal.show( $( '#inviteMembersModal' ).get( 0 ) );
            },
            error: function()
            {
                alert( "SYSTEM ERROR!!!" );
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
