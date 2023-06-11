$(function() {
	"use strict";
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    $('.select-min').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
        minimumInputLength: 3,
    })

    $('.select-provinces').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
        // minimumInputLength: 3,
    }).on("select2:select", function (e) {
        var selected = e.params.data;
        var province_id = e.params.data.id;
        console.log(province_id)
        if (typeof selected !== "undefined") {
            $('.select-cities').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
                ajax: {
                    url: "/api/data-kota/"+province_id,
                    type: "GET",
                    dataType: 'json',
                    delay: 250,
                    data: function (term) {
                        return {
                            term: term
                        }
                    },
                    results: function (data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        }
                    },
                },
                formatResult: function (data, term) {
                    return data;
                },
                formatSelection: function (data) {
                    return data;
                },
                escapeMarkup: function (m) {
                    return m;
                }
            })
            // $("[name='creditor_id']").val(selected.creditor_id);
            $("#allocationsDiv").hide();
          }
      }).on("select2:unselecting", function (e) {
          $("form").each(function () {
              this.reset()
          });
          ("#allocationsDiv").hide();
          $("[name='creditor_id']").val("");
      }).val(initial_creditor_id);

    $('.select-wards').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
        minimumInputLength: 3,
        ajax: {
            url: "/api/data-kelurahan",
            type: "GET",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    _token: CSRF_TOKEN,
                    search: params.term // search term
                };
            },
            processResults: function (response) {
                console.log(response)
                return {
                    results: response
                }
            },
            cache: true
        },
        templateResult: locationResultTemplater,
        templateSelection: locationSelectionTemplater
    })

    function locationResultTemplater(location) {
        return "[" + location.post_code + "] " + location.name;
    } 
    
    function locationSelectionTemplater(location) {
        if (typeof location.name !== "undefined") {
            return locationResultTemplater(location);
        }
        return location.text; // I think its either text or label, not sure.
    }
});