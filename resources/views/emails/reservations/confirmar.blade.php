@component('mail::message')
    
# Confirmación de reserva de ambiente(s).

## Estimado docente,

Nos complace informarte que su solicitud de reserva ha sido aceptada. 
A continuación, te proporcionamos los detalles de tu reserva:

## Información de la fecha y hora

**Fecha de la solicitud:** {{ $date }}

**Hora de la solicitud:** {{ $hour }}

## Información del ambiente

{{-- 
| Ambiente                  | Capacidad                     |
|---------------------------|-------------------------------|
@foreach ($classrooms as $classroom)
| {{ $classroom->name }}    | {{ $classroom->capacity }}    |
@endforeach --}}


## Información del solicitante

{{-- @foreach ($docenteMateriaGrupo as $teacher)
**Nombre de docente**

{{$teacher['teacher_name']}}

**Materia(s) para la solicitud**

| Materia(s)            | Grupo(s)                              |
|-----------------------|---------------------------------------|
@foreach ($teacher['subjects'] as $subject => $details)
| {{ $subject }}        | {{ json_encode($details['groups']) }} |
@endforeach

@endforeach --}}

| Encabezado 1              | Encabezado 2 |
|---------------------------|--------------|
| Fila 1 Col 1              | Fila 1 Col 2 |
| Fila 2 Col 1              | Fila 2 Col 2 |

@component('mail::button', ['url' => URL::to('/')])
Mira tu reserva aquí
@endcomponent

Gracias, <br>
{{ config('app.name') }}

@endcomponent