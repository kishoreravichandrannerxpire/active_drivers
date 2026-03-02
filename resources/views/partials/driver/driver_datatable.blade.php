<!-- DataTables JS and CSS link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
$(document).ready(function () {
    var table;

    function initDataTable() {
        if ($.fn.DataTable.isDataTable('#drivertable')) {
            $('#drivertable').DataTable().destroy();
        }

        if($('#drivertable tbody tr').length > 1 || !$('#drivertable tbody td').attr('colspan')) {
            table = $('#drivertable').DataTable({
                info: true,
                searching: true,
                dom: 't<"bottom"ip>'   // removes top-right search box
            });

            // attach column-specific search handlers
            $('#drivertable thead tr.filters th').each(function (i) {
                var $field = $('input, select', this);
                $field.on('keyup change clear', function () {
                    var val = this.value;
                    // if the user only types a number, pad to two digits
                    if (/^\d+$/.test(val)) {
                        val = val.padStart(2, '0');
                    }
                    // use plain text search (no regex) for reliable column filtering
                    if (table.column(i).search() !== val) {
                        table.column(i).search(val).draw();
                    }
                });
            });
        }
    }

    initDataTable();
});
</script>