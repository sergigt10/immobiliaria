(function($) {
  'use strict';
  $(function() {
    $('#order-listing').DataTable({
      "aLengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "Tots"]
      ],
      "order": [[ 0, "asc" ]],
      "iDisplayLength": 15,
      "language": {
        "processing": "Processant...",
        "lengthMenu": "Mostrant _MENU_ registres",
        "zeroRecords": "No s'han trobat registres",
        "emptyTable": "No hi ha registres disponibles en aquesta taula",
        "info": "Mostrant del _START_ al _END_ d'un total de _TOTAL_ registre/s",
        "infoEmpty": "No hi ha registres disponibles",
        "infoFiltered": "(filtrat de _MAX_ registres)",
        "search": "Buscador: ",
        "infoThousands": ".",
        "decimal": ",",
        "loadingRecords": "Carregant...",
        "paginate": {
            "first": "Primer",
            "previous": "Anterior",
            "next": "Següent",
            "last": "Últim"
        },
        "aria": {
            "sortAscending": ": Activa per ordenar la columna de manera ascendent",
            "sortDescending": ": Activa per ordenar la columna de manera descendent"
        },
        "buttons": {
            "print": "Imprimeix",
            "copy": "Copia",
            "colvis": "Columnes",
            "copyTitle": "Copia al portapapers",
            "copySuccess": {
                "_": "%d files copiades",
                "1": "1 fila copiada"
            },
            "pageLength": {
                "-1": "Mostra totes les files",
                "_": "Mostra %d files"
            }
        },
        "select": {
            "rows": {
                "_": "%d files seleccionades",
                "0": "Cap fila seleccionada",
                "1": "1 fila seleccionada"
            }
        }
      }
    });
    $('#order-listing').each(function() {
      var datatable = $(this);
      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
      search_input.attr('placeholder', 'Search');
      search_input.removeClass('form-control-sm');
      // LENGTH - Inline-Form control
      var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
      length_sel.removeClass('form-control-sm');
    });
    $('.dataTables_filter input').attr("placeholder", "Buscar ...");
  });
})(jQuery);