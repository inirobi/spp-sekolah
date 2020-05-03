
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Rincian</title>
    <style>
.page_break { page-break-before: always; },
</style>
  </head>
  <body>
    <header class="clearfix">
      <div style="text-align: center">
      <h2>Rincian {{$rincian}}</h2>
      </div>
      <div id="project" style="font-size:16px">
      </div>
    </header>
    <br>
    <hr>
    <main style="align-item:center;">
      <table style="font-size:14px;">
        <thead>
          <tr>
            <th width="30">NO</th>
            <th width="320">DESKRIPSI</th>
            <th width="170">JUMLAH</th>
          </tr>
        </thead>
        <tbody>
        @php
        $total =0;
        @endphp
        @foreach($datas as $data)
        @php
        $total+=intval($data->kredit);
        @endphp
        <tr>
          <td colspan="3"><hr></td>
          </tr>
          <tr>
            <td >
            <div style="text-align:center">
            {{$no++}}
            </div>
            </td>
            <td >
              <div style="word-wrap: break-word;">
              {{$data->description}}
              </div>
            <td class="unit">
              <div style="text-align:right">
              {{number_format($data->kredit,0,',','.')}}
              </div>
            </td>
          </tr>
          @endforeach
          <tr>
          <td colspan="3"><hr></td>
          </tr>
          <tr>
            <td colspan="2">Total Tunggakan</td>
            <td class="total">
              <div style="text-align:right; font-size:16; font-weight:bold">
              Rp. {{number_format($total,0,',','.')}}
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <br>
    </main>
    <footer>
    <br>
    <br>
    <div style="widht:100%; text-align:right">
    <p>
    Sumedang, {{$tanggal}}<br>
    Bendahara Sekolah
    </p>
    <br>
    <br>
    <p><span style="text-decoration: underline; font-weight:bold">
    {{$user}}</span> <br>
    </p>
    </div>
    </footer>
  </body>
</html>