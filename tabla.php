<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla</title>
    <link href="css/estilo.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>

<div class="container">

    <header class="jumbotron">
    <img src="img/logo.png">
    </header>

    <form method="post" action="tabla.php">
        <input type="text" name="rut">
        <button name="buscar" type="submit">Buscar</button>
    </form>

    <div class="table responsive">
    <table border="1" class="table table-bordered table-sm">
        <thead>
        <tr>
            <th>Rut</th>
            <th>Rut Emisor</th>
            <th>Razon Social</th>
            <th>Giro Emisor</th>
            <th>Telefono</th>
            <th>Correo Emisor</th>
            <th>Acteco</th>
            <th>CdgSIISucur</th>
            <th>Direccion Origen</th>
            <th>Comuna Origen</th>
            <th>Ciudad Origen</th>
        </tr>
        </thead>

<?php

// Conexion a la base de datos //

$user = "root";
$pass = "";
$server = "localhost";
$db = "oxford";

$con = mysqli_connect($server,$user,$pass,$db);

if($con->connect_errno) {
    die("La conexion ha fallado" . $conexion->connect_errno);
} 

// Variables 

$where = "";

if (isset($_POST['buscar']))
{
    $rut = $_POST['rut'];
    $where = "where rut like '".$rut."'";
}

// Consulta //

$sql = "select distinct rut,xml from xmls $where";

$consulta = mysqli_query($con,$sql);

// Muestra //

while ($mostrar = mysqli_fetch_array($consulta)){
?>
<tbody>
<tr>
    <td><?php echo $mostrar['rut'] ?></td>
    <?php
    $xml = simplexml_load_string($mostrar['xml']);
    $rutEmisor = $xml->SetDTE->DTE->Documento->Encabezado->Emisor->RUTEmisor;
    $rznSoc = $xml->SetDTE->DTE->Documento->Encabezado->Emisor->RznSoc;
    $giroEmis = $xml->SetDTE->DTE->Documento->Encabezado->Emisor->GiroEmis;
    $telefono = $xml->SetDTE->DTE->Documento->Encabezado->Emisor->Telefono;
    $correoEmisor = $xml->SetDTE->DTE->Documento->Encabezado->Emisor->CorreoEmisor;
    $acteco = $xml->SetDTE->DTE->Documento->Encabezado->Emisor->Acteco;
    $cdgSIISucur = $xml->SetDTE->DTE->Documento->Encabezado->Emisor->CdgSIISucur;
    $dirOrigen = $xml->SetDTE->DTE->Documento->Encabezado->Emisor->DirOrigen;
    $cmnaOrigen = $xml->SetDTE->DTE->Documento->Encabezado->Emisor->CmnaOrigen;
    $ciudadOrigen = $xml->SetDTE->DTE->Documento->Encabezado->Emisor->CiudadOrigen;
    ?>
    <td><?php echo $rutEmisor; ?></td>
    <td><?php echo $rznSoc; ?></td>
    <td><?php echo $giroEmis; ?></td>
    <td><?php echo $telefono; ?></td>
    <td><?php echo $correoEmisor; ?></td>
    <td><?php echo $acteco; ?></td>
    <td><?php echo $cdgSIISucur; ?></td>
    <td><?php echo $dirOrigen; ?></td>
    <td><?php echo $cmnaOrigen; ?></td>
    <td><?php echo $ciudadOrigen; ?></td>
</tr>
</tbody>
<?php
} 

?>
</table>

<a href="./excel.php" class="btn btn-primary">Descargar Excel</a>


</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
</body>
</html>