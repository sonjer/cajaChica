
<!DOCTYPE html>
<html>
<head>
    <title>disabled-checkbox</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-table/src/bootstrap-table.css">
    <link rel="stylesheet" href="../assets/examples.css">
    <script src="../assets/jquery.min.js"></script>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="../ga.js"></script>
</head>
<body>
    <div class="container">
        <h1>Disabled Checkbox</h1>
        <p>Use <code>checkboxHeader</code>, <code>checkboxEnable</code> options and <code>formatter</code> column option to disabled select input.</p>
        <table id="table"
               data-toggle="table"
               data-height="460"
               data-click-to-select="true"
               data-url="../json/data1.json">
            <thead>
            <tr>
                <th data-field="state" data-checkbox="true"
                    data-formatter="stateFormatter"></th>
                <th data-field="id">ID</th>
                <th data-field="name">Item Name</th>
                <th data-field="price">Item Price</th>
            </tr>
            </thead>
        </table>
    </div>
<script>
    function stateFormatter(value, row, index) {
        if (index === 2) {
            return {
                disabled: true
            };
        }
        if (index === 5) {
            return {
                disabled: true,
                checked: true
            }
        }
        return value;
    }
</script>
</body>
</html>