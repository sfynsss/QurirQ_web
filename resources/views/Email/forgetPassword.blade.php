@component('mail::message')
<h1><b><center>Lupa password?</center></b></h1>
<br>

Kami mengirimkan email ini karena kamu meminta penggantian password QurirQ. 
Klik tombol di bawah ini untuk mengganti password :
<br>

@component('mail::button', ['url' => url('auth/forgetPassword')."?token=".$token."&email=".$email])
Ganti Password
@endcomponent

Thanks,<br>
QurirQ Team
@endcomponent
