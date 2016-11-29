
<!DOCTYPE html>
<html>
<head>

    <title>ICOM INGENIERÍA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="//localhost/intranet/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="//localhost/intranet/assets/bootstrap-table/src/bootstrap-table.css">
    <link rel="stylesheet" href="//localhost/intranet/assets/examples.css">
    <script src="//localhost/intranet/assets/jquery.min.js"></script>
    <script src="//localhost/intranet/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="//localhost/intranet/assets/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="//localhost/intranet/ga.js"></script>
</head>
<body background="//localhost/intranet/images/icom-wallpaper.png">
<div class="alert alert-info" role="alert">
<b><script type="text/javascript" > var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); var f=new Date(); document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear()); </script><b><br>
<script type="text/javascript" > function startTime(){ today=new Date(); h=today.getHours(); m=today.getMinutes(); s=today.getSeconds(); m=checkTime(m); s=checkTime(s); document.getElementById('reloj').innerHTML=h+":"+m+":"+s; t=setTimeout('startTime()',500);} function checkTime(i) {if (i<10) {i="0" + i;}return i;} window.onload=function(){startTime();} </script> 
<b><div id="reloj" ></div><b>
</a>
</div>
    <div class="container">
        <h4>ORDENES DE COMPRA POR AUTORIZAR</h4>
        
        <table id="table"
               data-toggle="table"
               data-height="420"
               data-click-to-select="true"
              
               
               data-show-columns="true"
               data-url="//localhost/intranet/json/detalle.json">
               
            <thead>
            <tr>

                
                <th data-field="Ccostos" data-switchable="false">Ccostos</th>
                <th data-field="factura"data-switchable="false">factura</th>
                <th data-field="fecha"data-switchable="false">fecha</th>
                <th data-field="proveedor" data-visible="false">proveedor</th>
                <th data-field="descripcion"data-visible="false">descripcion</th>
                <th data-field="importe"data-switchable="false">importe</th>
                <th data-field="iva" data-visible="false">iva</th>
                <th data-field="Total"data-visible="false">Total</th>
                <th data-field="state" data-checkbox="true"
                data-formatter="stateFormatter"></th>
            </tr>
            </thead>
        </table>
         <button type="button" ng-click="eliminaUsuario()" class="btn btn-danger btn-sm">Cancelar</button>
         <button type="submit" name= "enviar" value= "Aceptar informacion"class="btn btn-primary btn-sm">Guardar</button>
    </div>

                                
<script>
    function stateFormatter(value, row, index) {
        if (index === 0) {
            return {
                disabled: false
            };
        }
        if (index === 1) {
            return {
                disabled: false,
                checked: false
            }
        }
        return value;
    }
    
</script>
<style>
body {
background:url(//localhost/intranet/images/icom-wallpaper.png) no-repeat center center fixed;
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;
}
</style>
</body>
</html>