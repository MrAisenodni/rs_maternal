$(function() {
	"use strict";

    $(document).ready(function() {
        $('#default').DataTable({
            "columnDefs": [{
                "orderable": false,
                "targets": -1,
            }],
            "drawCallback": function() {
                var path = $('#url').val()
                var curpath = location.pathname
                
                $('tbody>tr').hover(function() {
                    var id = $(this).attr('data-id')

                    $('a', this).addClass('text-white').removeClass('text-primary')
                    $('form>button[id="delete"]', this).addClass('text-white').removeClass('text-danger')
                    $('form>button[id="restore"]', this).addClass('text-white').removeClass('text-primary')
                    $(this).addClass('bg-primary text-white')

                    if (curpath == path+'/'+id) {
                        $('a', this).addClass('text-white').removeClass('text-primary')
                        $('form>button[id="delete"]', this).addClass('text-white').removeClass('text-danger')
                        $('form>button[id="restore"]', this).addClass('text-white').removeClass('text-primary')
                        $(this).addClass('bg-primary text-white')
                    }
                }, function() {
                    var id = $(this).attr('data-id')
                    
                    $('a', this).addClass('text-primary').removeClass('text-white')
                    $('form>button[id="delete"]', this).addClass('text-danger').removeClass('text-white')
                    $('form>button[id="restore"]', this).addClass('text-primary').removeClass('text-white')
                    $(this).removeClass('bg-primary text-white')

                    if (curpath == path+'/'+id) {
                        $('a', this).addClass('text-white').removeClass('text-primary')
                        $('form>button[id="delete"]', this).addClass('text-white').removeClass('text-danger')
                        $('form>button[id="restore"]', this).addClass('text-white').removeClass('text-primary')
                        $(this).addClass('bg-primary text-white')
                    }
                })
            }
        });
    });


    $(document).ready(function() {
        var table = $('#example2').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'print']
        } );
     
        table.buttons().container()
            .appendTo( '#example2_wrapper .col-md-6:eq(0)' );
    });


});