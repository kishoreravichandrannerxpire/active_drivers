<!-- DataTables JS and CSS link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
$(document).ready(function () {
    if ($.fn.DataTable.isDataTable('#table')) {
        $('#table').DataTable().destroy();
    }

    if($('#table tbody tr').length > 1 || !$('#table tbody td').attr('colspan')) {
        $('#table').DataTable({
            info: false,
        });
    }
});
</script>
