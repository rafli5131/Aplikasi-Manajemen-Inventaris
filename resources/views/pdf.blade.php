<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<style>
  body {
    font-size: 18px;
    font-family: Arial, Helvetica, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  table {
    border-collapse: collapse;
    width: 100%;
  }

  td, th {
    padding: 10px;
    border: 1px solid black;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
  }

  .page-break {
    page-break-after: always;
  }
</style>

<body>
@foreach($records as $key => $record)
  <table>
    <tr>
      <td colspan="2" style="text-align: center;">Barang Milik RSU ANANDA PURWOREJO</td>
    </tr>
    <tr>
      <th>Kode Barang : </th>
      <td>{{$record->kode}}</td>
    </tr>
    <tr>
      <th>Nama Barang : </th>
      <td>{{$record->nama}}</td>
    </tr>
    <tr>
      <th>Tanggal Pembelian : </th>
      <td>{{$record->tanggal_pembelian}}</td>
    </tr>
  </table>
  @if(!$loop->last)
    <div class="page-break"></div>
  @endif
  @endforeach
</body>

</html>
