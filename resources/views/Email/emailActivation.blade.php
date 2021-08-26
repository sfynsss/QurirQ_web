@component('mail::message')
# Hai {{ $name }}

Terimakasih telah melakukan pendaftaran di Larisso Apps <br>
Kode aktivasi Anda 

<h1>{{$token}}</h1>

Terimakasih,<br>
Larisso Grup
@endcomponent