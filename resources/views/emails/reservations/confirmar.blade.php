@component('mail::message')
    
# Confirmación de reserva de ambiente(s).

## Estimado docente,

Nos complace informarte que su solicitud de reserva ha sido aceptada. 
A continuación, te proporcionamos los detalles de tu reserva:

### Información de la fecha y hora

**Fecha de la solicitud:** {{ $date }}
**Hora de la solicitud:** {{ $hora }}

### Información del ambiente

@foreach ($classrooms as $classroom)
| Ambiente                  | Capacidad                     |
|:-------------------:      |:---------:                    |
| {{ $classroom->name }}   | {{ $classroom->capacity }}     |
@endforeach

### Información del solicitante

@foreach ($teachers as $teacher)
**Nombre de docente**
$teacher->name

**Materia(s) para la solicitud**
@foreach ($subjects as $subject)
| Materia(s)            | Grupo(s)                   |
|:-------------------:  |:---------:                 |
| {{ $subject }}        | {{ $subject->groups }}     |
@endforeach

@endforeach

@component('mail::button', ['url' => URL::to('/')])
Mira tu reserva aquí
@endcomponent

Gracias, <br>
{{ config('app.name') }}

@endcomponent