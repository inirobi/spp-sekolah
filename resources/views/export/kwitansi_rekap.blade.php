
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Rincian</title>
    <style>
.page_break { page-break-before: always; },
.garis_dua{ 
  border: 0;
  border-top: 5px double #8c8c8c;
}
</style>
  </head>
  <body>
    <header class="clearfix">
      <div >
        <div style="float:left;padding-right:20px;">
        <br>
          <img style="hight:70; width:70;" src="{{public_path('')}}\assets\img\logo\bbl.png" />
        </div>
        <div style="padding-top:10">
          <p> <span style="font-size:14pt;font-style:bold">SMK BAABUL KAMIL</span>
          <br> <span style="font-size:12pt">Terakreditasi 'A' | Program Keahlian : Multimedia, Adm Perkantoran & Perawatan</span>
          <br> <span style="font-size:10pt">Alamat:Jl. Cikuda No. 08 Jatinangor, Tlp : (022) 7797312 / 085294124866</span>
          <br> <span style="font-size:10pt">Email: <span style="color:blue; font-style: italic;"> smkbaabulkamil_jatinangor@yahoo.com </span></span>
          | <span style="font-size:10pt">Website : <span style="color:blue;font-style: italic;">www.smkbaabulkamil.sch.id</span></span>
          </p>
        </div>
      </div>
        <hr class="garis_dua">
        <center><h4>BUKTI PEMBAYARAN SISWA</h4></center><hr>
        <table width='100%'>
          <tr>
            <td width='50%'>
              <table>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>  
                <tr>
                  <td>TANGGAL</td>
                  <td>:</td>
                  <td> </td>
                </tr>  
                <tr>
                  <td>WAKTU</td>
                  <td>:</td>
                  <td></td>
                </tr>  
              </table>
            </td>
            <td width='50%'>
            <table>
                <tr>
                  <td>NIS</td>
                  <td>:</td>
                  <td>ULJ879778</td>
                </tr>  
                <tr>
                  <td>NAMA</td>
                  <td>:</td>
                  <td>ULJ879778</td>
                </tr>  
                <tr>
                  <td>KELAS</td>
                  <td>:</td>
                  <td>ULJ879778 - ULJ234092</td>
                </tr>  
              </table>
            </td>
          </tr>
        </table>
        
    </header>
    <br>
    <hr>
    <main style="align-item:center;">
      <table style="font-size:14px;" width="100%">
        <thead>
          <tr>
            <th width="15%">NO</th>
            <th width="50%">DESKRIPSI</th>
            <th width="35%">JUMLAH</th>
          </tr>
        </thead>
        <tbody>
        <tr>
          <td colspan="3"><hr></td>
          </tr>
          <tr>
            <td >
            <div style="text-align:center">
            1
            </div>
            </td>
            <td >
              <div style="word-wrap: break-word;">
              @php
              $a = "be";
              $cek="bu ".$a;
              @endphp
              {{ $cek }}
              </div>
            <td class="unit">
              <div style="text-align:right">
              70000
              </div>
            </td>
          </tr>
          <tr>
          <td colspan="3"><hr></td>
          </tr>
        </tbody>
      </table>
      <table width='100%'>
          <tr>
            <td width='50%'>
              <table>
                <tr>
                  <td><strong>Terbilang :</strong></td>
                </tr> 
                <tr>
                  <td><span style='font-style:italic'> Tujuh Puluh Juta Lima Ratus Ribu Rupiah Tujuh Puluh Juta Lima Ratus Ribu Rupiah Tujuh Puluh Juta Lima Ratus Ribu Rupiah</span></td>
                </tr>
              </table>
            </td>
            <td width='50%'>
            <table width='100%'>
              <tr>
                <td><strong>Grand Total :</strong></td>
                <td style="text-align:right"><strong>{{number_format(700000,0,',','.')}}</strong></td>
                </tr> 
                <tr>
                  <td colspan='2'><hr></td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
    </main>
    <footer>
    <br>
    <table width='100%'>
      <tr>
        <td width='50%'>
          <table width='100%'>
            <tr></tr>
          </table>
        </td>
        <td width='50%'>
          <table style="text-align:center" width='100%'>
            <tr>
              <td>Sumedang, 04/04/2020</td>
            </tr>
            <tr>
            <td>Bendahara Sekolah</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    <br>
    <table width='100%'>
      <tr>
        <td width='50%'>
          <table width='100%'>
            <tr>
              <td>Catatan</td>
            </tr>
            <tr style='font-size:14px'>
              <td>- Disimpan sebagai pembayaran bukti yang SAH</td>
            </tr>
            <tr style='font-size:14px'>
              <td>- Uang yang dibayar tidak dapat diminta kembali</td>
            </tr>
          </table>
        </td>
        <td width='50%'>
          <table style="text-align:center" width='100%'>
            <tr><td><br></td></tr>
            <tr><td><br></td></tr>
            <tr>
              <td><span style="text-decoration: underline; font-weight:bold"> Dadan Ramdani </span></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    </footer>
  </body>
</html>