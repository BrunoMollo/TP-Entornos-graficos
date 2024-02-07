<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aviso Fin Inscripcion Llamado Jefe Catedra</title>
</head>
<body>
    <h1>Aviso Fin Inscripcion Llamado Jefe Catedra</h1>

    <p>Estimado/a Jefe de Cátedra {{$llamado->catedra->jefe_catedra->name}} {{$llamado->catedra->jefe_catedra->last_name}},</p>

    <p>Le informamos que la inscripción para el llamado "{{$llamado->puesto}} - {{$llamado->descripcion}}" ha finalizado.</p>

    <p>Atentamente,</p>
    <p>El equipo de su aplicación</p>
</body>
</html>
