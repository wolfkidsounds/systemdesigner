import DataTable from 'datatables.net-bs5';

$(document).ready( function () {
    $('[data-tables]').DataTable({
        responsive: true,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, 'All']
        ],
        dom: '<"data-tables-wrapper"<"row p-1 border-bottom mb-3"<"#t-entries.col d-flex justify-content-start"l><"#t-filter.col d-flex justify-content-end"f>><"data_table"t><"#t-info.row p-1 d-flex justify-content-start text-muted"i><"#t-page.mt-3 d-flex justify-content-center align-content-center align-items-center"p><"#t-proc.row"r>>'
    });
} );