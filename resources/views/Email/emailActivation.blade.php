@component('mail::message')
# Hai {{ $name }}

Terimakasih telah melakukan pendaftaran di QurirQ Apps <br>
Kode aktivasi Anda 

<h1>{{$token}}</h1>

Terimakasih,<br>
QurirQ Team
@endcomponent