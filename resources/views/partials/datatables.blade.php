<!-- DataTables JS and CSS link -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script>
$(document).ready(function () {

    let initializedTables = [];

    function initDataTable(table) {
        let tableId = $(table).attr('id');

        // Skip if no ID (safety)
        if (!tableId) return;

        // Prevent duplicate initialization
        if (initializedTables.includes(tableId)) return;

        // Initialize ALWAYS (let DataTables handle empty state)
        $(table).DataTable({
            info: true,
            paging: true,
            searching: true,
            lengthChange: true,
            destroy: true
        });

        initializedTables.push(tableId);
    }

    // ✅ Initialize ALL visible tables on load
    $('table').each(function () {
        if ($(this).is(':visible')) {
            initDataTable(this);
        }
    });

    // ✅ Initialize tables when tab is shown
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function () {

        $('.tab-pane.active table').each(function () {
            initDataTable(this);
        });

        // Fix column width issue
        $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
    });

});
</script>
