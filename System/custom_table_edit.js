$(document).ready(

    function() {

    $('#data_table').Tabledit({
        deleteButton: false,
        editButton: false,
        columns: {
            identifier: [0, 'plate_id'],
            editable: [[1, 'model'], [2, 'body'], [3, 'brand'], [4, 'color'], [5, 'year'], [6, 'status'], [7, 'office_id']]
        },
        hideIdentifier: false,
        url: 'live_edit.php'
    });

    }
);