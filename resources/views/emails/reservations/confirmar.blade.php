@component('mail::message')
    
# Confirmación de reserva de ambiente(s).

## Estimado docente,

Nos complace informarle que su solicitud de reserva ha sido aceptada. 
A continuación, le proporcionamos los detalles de su reserva:

## Información de la fecha y hora

@component('mail::panel')
**Fecha de la reserva:**        {{ $date }} <br>
**Hora de la reserva:**         {{ $hour }}
@endcomponent


## Información del ambiente(s)

@component('mail::table')
| Ambiente                  | Capacidad                     |
|---------------------------|-------------------------------|
@foreach ($classrooms as $classroom)
| {{ $classroom['name'] }}    | {{ $classroom['capacity'] }}    |
@endforeach
@endcomponent


## Información del solicitante(s)

@foreach ($docenteMateriaGrupo as $teacher)
**Nombre de docente**

{{$teacher['teacher_name']}}

**Materia(s) para la solicitud**

@component('mail::table')
| Materia(s)            | Grupo(s)                              |
|-----------------------|---------------------------------------|
@foreach ($teacher['subjects'] as $subject => $details)
| {{ $subject }}        | {{ implode(', ', $details['groups']) }} |
@endforeach
@endcomponent

---
@endforeach

@component('mail::button', ['url' => URL::to('/')])
Mira tu reserva aquí
@endcomponent

Gracias, <br>
{{ config('app.name') }}

@endcomponent