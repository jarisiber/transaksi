<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
  body {
    font-size: 18px;
    font-family: Arial, Helvetica, sans-serif;
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
  @foreach($commodities as $key => $commodity)
  <table class="center" border="1" cellpadding="10" cellspacing="0">
    <tr>
      <td colspan="2">Barang {{$jaris}}</td>
    </tr>
    <tr>
      <th>Kode Barang : </th>
      <td>{{ $commodity->item_code }}</td>
    </tr>
    <tr>
      <th>Nama Barang : </th>
      <td>{{ $commodity->name }}</td>
    </tr>
    <tr>
      <th>Asal Perolehan : </th>
      <td>{{ $commodity->commodity_acquisition->name }}</td>
    </tr>
    <tr>
      <th>Kondisi : </th>
      @if($commodity->condition === 1)
			<td>
				<span class="badge badge-pill badge-success" title="Baik">
					<i class="fas fa-fw fa-check-circle"></i>
					Baik
				</span>
			</td>
			@elseif($commodity->condition === 2)
			<td>
				<span class="badge badge-pill badge-warning" title="Kurang Baik">
					<i class="fa fa-fw fa-exclamation-circle"></i>
					Kurang Baik
				</span>
			</td>
			@else
      <td>
				<span class="badge badge-pill badge-danger" title="Rusak Berat">
					<i class="fa fa-fw fa-times-circle"></i>
					Rusak Berat</span>
			</td>
			@endif
    </tr>
  </table>
  <br>
  @if ($key!=0)
  @if (($key+1) % 4==0)
  <div class="page-break"></div>
  @endif
  @endif
  @endforeach
</body>

</html>
