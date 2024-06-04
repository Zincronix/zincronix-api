@component('mail::message')
    
# Rechazo de solicitud de reserva de ambiente(s).

## Estimado docente,

Lamentamos informarle que su solicitud de reserva no ha sido aceptada. 
A continuación, le proporcionamos los detalles de su solicitud rechazada:

{{ $motivo }}

## Información de la fecha y hora

@component('mail::panel')
**Fecha de la reserva:**        {{ $date }} <br>
**Hora de la reserva:**         {{ $hour }}
@endcomponent


## Información del ambiente(s) solicitudado(s)

@component('mail::table')
| Ambiente                  | Capacidad                     |
|---------------------------|-------------------------------|
@foreach ($classrooms as $classroom)
| {{ $classroom['name'] }}    | {{ $classroom['capacity'] }}    |
@endforeach
@endcomponent

Sentimos los inconvenientes que esto pueda causar. 

@component('mail::button', ['url' => 'http://localhost:5173/reservar/detalle'])
Hacer otra solicitud
@endcomponent

Gracias por su compresión, <br>
{{ config('app.name') }}

@endcomponent