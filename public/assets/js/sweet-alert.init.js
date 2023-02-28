
!function($) {
    "use strict";

    var SweetAlert = function() {};

    //examples 
    SweetAlert.prototype.init = function() {
        // Delete Data
        $('.sa-warning').click(function(e){
            var form = $(this).closest('form')
            e.preventDefault()

            swal({   
                title: "Apakah Anda yakin?",   
                type: "warning",   
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonClass: 'btn btn-success text-white',
                cancelButtonClass: 'btn btn-danger m-1-10',
                confirmButtonText: "Yakin", 
                cancelButtonText: 'Batal',
            }).then(result => {  
                if (result.value) {
                    swal(
                        'Terhapus!',
                        'Data berhasil dihapus.',
                        'success',
                    ).then(function() {
                        form.submit()
                    })
                    return true
                } 
                return false
            });
        });
    },
    //init
    $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.SweetAlert.init()
}(window.jQuery);