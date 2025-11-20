<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
  body {
    font-size: 14px;
    font-family: "Helvetica Neue", Arial, sans-serif;
  }
  #judul {
    text-align: center;
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 20px;
    color: #00AA5B;
  }
  table {
    border: 1px solid black;
    border-collapse: collapse;
    width: 80%;
  }
  th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: left;
  }
  th {
    background-color: #f2f2f2;
  }
  #td {
    font-size: 16px;
  }
  .badge {
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    color: #fff;
  }
  table.center {
    margin-left: auto;
    margin-right: auto;
  }
  .page-break {
    page-break-after: always;
  }
</style>

<body>
  <table class="center" cellpadding="10" cellspacing="0">
    <tr>
      <td id="judul" colspan="3">Detail Tiket Laporan</td>
    </tr>
    <tr>
      <td>Subject :</td>
      <td id="td">{{ $ticket->judul }}</td>
      <td>....</td>
    </tr>
    <tr>
      <td>Nama Barang : </td>
      <td>{{ $ticket->no_tiket }}</td>
      <td>....</td>
    </tr>
    <tr>
      <td>Asal Perolehan : </td>
      <td>{{ $ticket->no_tiket }}</td>
      <td>....</td>
    </tr>
    <tr>
      <td>Asal Perolehan : </td>
      <td>{{ $ticket->no_tiket }}</td>
      <td>....</td>
    </tr>
  </table>
</body>

</html>
