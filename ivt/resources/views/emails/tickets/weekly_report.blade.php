@component('mail::message')

Dear Adour,

<br>Berikut terlampir daftar hal yang harus dikerjakan : {{ now()->format('l, d F Y') }}:

<!-- Start Custom HTML Table for Header Color -->

<table width="100%" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
<!-- Table Header with Color -->
<thead style="background-color: #07cf5e; color: #383838;"> <!-- Light Gray background with Dark text -->
<tr style="border-bottom: 1px solid #e5e7eb;">
<th style="padding: 12px 8px; text-align: center; border-right: 1px solid #e5e7eb; font-size: 14px;">No</th>
<th style="padding: 12px 8px; text-align: center; border-right: 1px solid #e5e7eb; font-size: 14px;">No Tiket</th>
<th style="padding: 12px 8px; text-align: center; border-right: 1px solid #e5e7eb; font-size: 14px;">Branch - Departemen</th>
<th style="padding: 12px 8px; text-align: center; border-right: 1px solid #e5e7eb; font-size: 14px;">Judul</th>
<th style="padding: 12px 8px; text-align: center; font-size: 14px;">Tgl Dibuat</th>
</tr>
</thead>
<!-- Table Body -->
<tbody>
@foreach ($tickets as $ticket)
<tr style="border-bottom: 1px solid #e5e7eb;">
<td style="padding: 8px; text-align: center; border-right: 1px solid #e5e7eb; font-size: 14px;">{{ $loop->iteration }}</td>
<td style="padding: 8px; text-align: left; border-right: 1px solid #e5e7eb; font-size: 14px;">{{ $ticket->no_tiket }}</td>
<td style="padding: 8px; text-align: left; border-right: 1px solid #e5e7eb; font-size: 14px;">{{ $ticket->branch }} - {{ $ticket->departemen }}</td>
<td style="padding: 8px; text-align: left; border-right: 1px solid #e5e7eb; font-size: 14px;">{{ $ticket->judul }}</td>
<td style="padding: 8px; text-align: center; font-size: 14px;">{{ $ticket->created_at->format('d-m-Y') }}</td>
</tr>
@endforeach
</tbody>
</table>
<!-- End Custom HTML Table -->

<br>Demikian atas perhatian dan kerjasamanya terima kasih.

Salam,

Tim Dukungan
<hr style="border: 0; border-top: 1px solid #e5e7eb; margin: 20px 0;">
<a style="font-size: 0.5em; margin-top: 20px; color: #000; text-align: center;">
    Ini adalah email otomatis, harap tidak membalas email ini. Jika butuh bantuan, silahkan hubungi tim <strong style="color:#07cf5e;">IT Pendukung 😀</strong>
</a>
@endcomponent