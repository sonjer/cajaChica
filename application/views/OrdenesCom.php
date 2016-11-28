
<!DOCTYPE html>
<html>
<head>
    <title>disabled-checkbox</title>
    <meta charset="utf-8">
    
    <link rel="stylesheet" href="//localhost/intranet/assets/bootstrap-table/src/bootstrap-table.css">
    <link rel="stylesheet" href="//localhost/intranet/assets/examples.css">
    <script src="//localhost/intranet/assets/jquery.min.js"></script>
    <script src="//localhost/intranet/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="//localhost/intranet/assets/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="//localhost/intranet/ga.js"></script>
</head>
<body>
    <div class="container">
        <h3>ORDENES DE COMPRA POR AUTORIZAR</h3>
        <p>Use <code>checkboxHeader</code>, <code>checkboxEnable</code> options and <code>formatter</code> column option to disabled select input.</p>
        <table id="table"
               data-toggle="table"
               data-height="420"
               data-click-to-select="true"
               data-detail-view="true"
               data-detail-formatter="detailFormatter"
               data-url="//localhost/table-examples/json/data1.json">
            <thead>
            <tr>

                <th data-field="id">ID</th>
                <th data-field="name">Item Name</th>
                <th data-field="price">Item Price</th>
                <th data-field="state" data-checkbox="true"
                data-formatter="stateFormatter"></th>
            </tr>
            </thead>
        </table>
    </div>
<script>
    function stateFormatter(value, row, index) {
        if (index === 1000) {
            return {
                disabled: true
            };
        }
        if (index === 1001) {
            return {
                disabled: true,
                checked: true
            }
        }
        return value;
    }
    
</script>
<script>
    function detailFormatter(index, row) {
        var html = [];
        $.each(row, function (key, value) {
            html.push('<p><b>' + key + ':</b> ' + value + '</p>');
        });
        return html.join('');
    }
</script>
</body>
</html>