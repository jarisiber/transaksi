@component('mail::message')

<strong>{{$messages->hi}}</strong>
<br><a>Tiket Laporan Baru Dibuat!</a>
<br>Permintaan Anda telah dibuatkan tiket baru oleh {{ Auth::user()->name }}.

@component('mail::panel')
Nomor Tiket: <strong>{{ $messages->ticket_number }}</strong>
<p>Isu Tiket: <strong>{{ $messages->ticket_issue }}</strong></p>
@endcomponent

<br>Terima kasih, jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan!
<p>Regards,</p>


{{ config('app.name') }}
<hr style="border: 0; border-top: 1px solid #e5e7eb; margin: 20px 0;">
<a style="font-size: 0.5em; margin-top: 20px; color: #000; text-align: center;">
    Ini adalah email otomatis, harap tidak membalas email ini. Jika butuh bantuan, silahkan hubungi tim <strong style="color:#07cf5e;">IT Pendukung 😀</strong>
</a>
@endcomponent
