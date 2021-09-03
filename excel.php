<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename= archivo.xls")

?>

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

$user = "root";
$pass = "";
$server = "localhost";
$db = "oxford";

$con = mysqli_connect($server,$user,$pass,$db);

if($con->connect_errno) {
    die("La conexion ha fallado" . $conexion->connect_errno);
} 

$sql = "select distinct rut,xml from xmls";

$consulta = mysqli_query($con,$sql);

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