<!DOCTYPE html>
<html>
<head>
<style>
    .atable table, .atable th, .atable tr {
  border: 0px ;
}
 .atable td {
  border: 0px ;
}
.btable table, .btable th, .btable td {
  border: 1px solid black;
  border-collapse: collapse;
  text-align: center;
  font-size:9pt;
}

table {
  border-collapse: collapse; /* Menghilangkan jarak antar sel */
  width: 100%; /* Opsional, untuk membuat tabel menyesuaikan lebar */
  text-align: center;
  font-size:9pt;
}

th, td {
  border: 1px solid black; /* Menambahkan border pada th dan td */
  padding: 0; /* Menghilangkan padding agar lebih rapat */
  text-align: center;
  font-size:9pt;
}



</style>
</head>
<body>

<b>FORMULIR PENILAIAN KERUSAKAN BANGUNAN</b>
<table class="atable" width="100%">
    <tr>
        <td style="text-align: left;" width="20%">Nama Sekolah</td>
        <td style="text-align: left;">: {{$formulir->user->name}}</td>
    </tr>
    {{-- <tr>
        <td>Nama Sekolah</td>
        <td>: </td>
    </tr> --}}
    <tr>
        <td style="text-align: left;">NPSN</td>
        <td style="text-align: left;">: {{$formulir->user->npsn}}</td>
    </tr>
    <tr>
        <td style="text-align: left;">Nama Bangunan</td>
        <td style="text-align: left;">: {{$formulir1->bangunans->nama_bangunan}}</td>
    </tr>
    {{-- <tr>
        <td style="text-align: left;">Nama Ruang</td>
        <td style="text-align: left;">: {{$formulir1->ruangs->nama_ruang}}</td>
    </tr> --}}
    <tr>
        <td style="text-align: left;">NUP (No Urut Perolehan)</td>
        <td style="text-align: left;">: </td>
    </tr>
    <tr>
        <td style="text-align: left;">Alamat</td>
        <td style="text-align: left;">: {{$formulir->user->alamat_sekolah}}</td>
    </tr>
    <tr>
        <td style="text-align: left;">Kabupaten/Kota</td>
        <td style="text-align: left;">: Bandung</td>
    </tr>
    <tr>
        <td style="text-align: left;">Koordinat</td>
        <td style="text-align: left;">: {{$tanah->lat}} , {{$tanah->long}}</td>
    </tr>
    <tr>
        <td style="text-align: left;">Luas Bangunan</td>
        <td style="text-align: left;">: {{ $formulir1->bangunans->luas_tapak}}  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jumlah Lantai : {{$formulir->bangunans->jumlah_lantai}}</td>
    </tr>
</table>
<br>
<table width="100%" >
    <tr>
        <td rowspan="4">NO</td>
        <td rowspan="4">SISTEM</td>
        <td rowspan="4">KOMPONEN</td>
        <td rowspan="4">SATUAN</td>
        <td rowspan="4">VOLUME SELURUH KOMPONEN</td>
        <td rowspan="4">TAHAP 1 - PENGAMATAN VISUAL ADA / TDKNYA KERUSAKAN DAN INDIKASI DAMPAK KERUSAKAN TERHADAP KESELAMATAN PEMANFAATAN RUANGAN / BANGUNAN</td>
        <td colspan="7">TAHAP 2 - HITUNG VOLUME KERUSAKAN KOMPONEN BERDASARKAN KLASIFIKASI KERUSAKAN</td>
        <td colspan="8">PERHITUNGAN TINGKAT KERUSAKAN KOMPONEN</td>
        <td rowspan="4">BOBOT KOMPONEN</td>
        <td rowspan="4">TINGKAT KERUSAKAN KOMPONEN THD MASSA BANGUNAN / RUANGAN</td>
    </tr>
    <tr>
        <td rowspan="2">Tdk Rusak</td>
        <td colspan="5">Rusak, dengan Tingkat Kerusakan:</td>
        <td rowspan="2">Komponen Tdk Sesuai / Tdk Ada</td>
        <td rowspan="2">1</td>
        <td rowspan="2">2</td>
        <td rowspan="2">3</td>
        <td rowspan="2">4</td>
        <td rowspan="2">5</td>
        <td rowspan="2">6</td>
        <td rowspan="2">7</td>
        <td rowspan="3">TOTAL</td>
    </tr>
    <tr>
        <td>Sangat Ringan</td>
        <td>Ringan</td>
        <td>Sedang</td>
        <td>Berat</td>
        <td>Sangat Berat</td>
    </tr>
    <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>0.00 @php $satu=0 @endphp</td>
        <td>0.20 @php $dua=0.20 @endphp</td>
        <td>0.35 @php $tiga=0.35 @endphp</td>
        <td>0.50 @php $empat=0.50 @endphp</td>
        <td>0.70 @php $lima=0.70 @endphp</td>
        <td>0.85 @php $enam=0.85 @endphp</td>
        <td>1.00 @php $tujuh=0.00 @endphp</td>
    </tr>
    <tr style="font-size: 7pt;text-align: center">
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
        <td>12</td>
        <td>13</td>
        <td>14</td>
        <td>15</td>
        <td>16</td>
        <td>17</td>
        <td>18</td>
        <td>19</td>
        <td>20</td>
        <td>21</td>
        <td>22</td>
        <td>23</td>
    </tr>
    <tr>
        <td rowspan="4">1</td>
        <td rowspan="4">STRUKTUR</td>
        <td>Pondasi & Skoof</td>
        <td>Estimasi</td>
        <td></td>
        <td>{{$pondasi_tahap1con}}</td>
        <td colspan="7">{{$pondasi_tahap2con}}</td>
        <td colspan="7"></td>
        <td>{{$pondasi_tahap2p}}%</td>
        <td>{{$bobotpondasi=number_format(12, 2, '.', '')}}%</td>
        <td>{{$sumtingkatpondasi=number_format($pondasi_tahap2p*$bobotpondasi/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Kolom</td>
        <td>unit</td>
        <td> {{$formulir1->jumlah_kolom}} </td>
        <td>{{$kolom_tahap1con}}</td>
        <td>{{$formulir1->jml_kolomt2a}}</td>
        <td>{{$formulir1->jml_kolomt2b}}</td>
        <td>{{$formulir1->jml_kolomt2c}}</td>
        <td>{{$formulir1->jml_kolomt2d}}</td>
        <td>{{$formulir1->jml_kolomt2e}}</td>
        <td>{{$formulir1->jml_kolomt2f}}</td>
        <td>{{$formulir1->jml_kolomt2g}}</td>
        <td>{{$kolom1=number_format($formulir1->jml_kolomt2a/$formulir1->jumlah_kolom*$satu, 2, '.', '')}}</td>
        <td>{{$kolom2=number_format($formulir1->jml_kolomt2b/$formulir1->jumlah_kolom*$dua, 2, '.', '')}}</td>
        <td>{{$kolom3=number_format($formulir1->jml_kolomt2c/$formulir1->jumlah_kolom*$tiga, 2, '.', '')}}</td>
        <td>{{$kolom4=number_format($formulir1->jml_kolomt2d/$formulir1->jumlah_kolom*$empat, 2, '.', '')}}</td>
        <td>{{$kolom5=number_format($formulir1->jml_kolomt2e/$formulir1->jumlah_kolom*$lima, 2, '.', '')}}</td>
        <td>{{$kolom6=number_format($formulir1->jml_kolomt2f/$formulir1->jumlah_kolom*$enam, 2, '.', '')}}</td>
        <td>{{$kolom7=number_format($formulir1->jml_kolomt2g/$formulir1->jumlah_kolom*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumkolom=number_format(($kolom1+$kolom2+$kolom3+$kolom4+$kolom5+$kolom6+$kolom7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotkolom=number_format(10, 2, '.', '')}}%</td>
        <td>{{$sumtingkatkolom=number_format($sumkolom*$bobotkolom/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Balok</td>
        <td>unit</td>
        <td> {{$jumlah_balok}} </td>
        <td>{{$balok_tahap1con}}</td>
        <td>{{$formulir1->jml_balokt2a}}</td>
        <td>{{$formulir1->jml_balokt2b}}</td>
        <td>{{$formulir1->jml_balokt2c}}</td>
        <td>{{$formulir1->jml_balokt2d}}</td>
        <td>{{$formulir1->jml_balokt2e}}</td>
        <td>{{$formulir1->jml_balokt2f}}</td>
        <td>{{$formulir1->jml_balokt2g}}</td>
        <td>{{$balok1=number_format($formulir1->jml_balokt2a/$formulir1->jumlah_balok*$satu, 2, '.', '')}}</td>
        <td>{{$balok2=number_format($formulir1->jml_balokt2b/$formulir1->jumlah_balok*$dua, 2, '.', '')}}</td>
        <td>{{$balok3=number_format($formulir1->jml_balokt2c/$formulir1->jumlah_balok*$tiga, 2, '.', '')}}</td>
        <td>{{$balok4=number_format($formulir1->jml_balokt2d/$formulir1->jumlah_balok*$empat, 2, '.', '')}}</td>
        <td>{{$balok5=number_format($formulir1->jml_balokt2e/$formulir1->jumlah_balok*$lima, 2, '.', '')}}</td>
        <td>{{$balok6=number_format($formulir1->jml_balokt2f/$formulir1->jumlah_balok*$enam, 2, '.', '')}}</td>
        <td>{{$balok7=number_format($formulir1->jml_balokt2g/$formulir1->jumlah_balok*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumbalok=number_format(($balok1+$balok2+$balok3+$balok4+$balok5+$balok6+$balok7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotbalok=number_format(8, 2, '.', '')}}%</td>
        <td>{{$sumtingkatbalok=number_format($sumbalok*$bobotbalok/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Atap</td>
        <td>%</td>
        <td> {{100}} </td>
        <td>{{$atap_tahap1con}}</td>
        <td>{{number_format(($formulir1->jml_atapt2a/$rekapatap)*100)}}</td>
        <td>{{number_format(($formulir1->jml_atapt2b/$rekapatap)*100)}}</td>
        <td>{{number_format(($formulir1->jml_atapt2c/$rekapatap)*100)}}</td>
        <td>{{number_format(($formulir1->jml_atapt2d/$rekapatap)*100)}}</td>
        <td>{{number_format(($formulir1->jml_atapt2e/$rekapatap)*100)}}</td>
        <td>{{number_format(($formulir1->jml_atapt2f/$rekapatap)*100)}}</td>
        <td>{{number_format(($formulir1->jml_atapt2g/$rekapatap)*100)}}</td>
        <td>{{$atap1=number_format(($formulir1->jml_atapt2a/$formulir1->jumlah_baris)/100*$satu, 2, '.', '')}}</td>
        <td>{{$atap2=number_format(($formulir1->jml_atapt2b/$formulir1->jumlah_baris)/100*$dua, 2, '.', '')}}</td>
        <td>{{$atap3=number_format(($formulir1->jml_atapt2c/$formulir1->jumlah_baris)/100*$tiga, 2, '.', '')}}</td>
        <td>{{$atap4=number_format(($formulir1->jml_atapt2d/$formulir1->jumlah_baris)/100*$empat, 2, '.', '')}}</td>
        <td>{{$atap5=number_format(($formulir1->jml_atapt2e/$formulir1->jumlah_baris)/100*$lima, 2, '.', '')}}</td>
        <td>{{$atap6=number_format(($formulir1->jml_atapt2f/$formulir1->jumlah_baris)/100*$enam, 2, '.', '')}}</td>
        <td>{{$atap7=number_format(($formulir1->jml_atapt2g/$formulir1->jumlah_baris)/100*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumatap=number_format(($atap1+$atap2+$atap3+$atap4+$atap5+$atap6+$atap7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotatap=number_format(7, 2, '.', '')}}%</td>
        <td>{{$sumtingkatatap=number_format($sumatap*$bobotatap/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td rowspan="9">2</td>
        <td rowspan="9">ARSITEKTUR</td>
        <td>Dinding /Pondasi</td>
        <td>%</td>
        <td> {{100}} </td>
        <td>{{$dinding_tahap1con}}</td>
        <td>{{number_format(($formulir1->jml_dindingt2a/$rekapdinding)*100, 1, '.', '')}}</td>
        <td>{{number_format(($formulir1->jml_dindingt2b/$rekapdinding)*100, 1, '.', '')}}</td>
        <td>{{number_format(($formulir1->jml_dindingt2c/$rekapdinding)*100, 1, '.', '')}}</td>
        <td>{{number_format(($formulir1->jml_dindingt2d/$rekapdinding)*100, 1, '.', '')}}</td>
        <td>{{number_format(($formulir1->jml_dindingt2e/$rekapdinding)*100, 1, '.', '')}}</td>
        <td>{{number_format(($formulir1->jml_dindingt2f/$rekapdinding)*100, 1, '.', '')}}</td>
        <td>{{number_format(($formulir1->jml_dindingt2g/$rekapdinding)*100, 1, '.', '')}}</td>
        <td>{{$dinding1=number_format(($formulir1->jml_dindingt2a/$formulir1->jumlah_baris)/100*$satu, 2, '.', '')}}</td>
        <td>{{$dinding2=number_format(($formulir1->jml_dindingt2b/$formulir1->jumlah_baris)/100*$dua, 2, '.', '')}}</td>
        <td>{{$dinding3=number_format(($formulir1->jml_dindingt2c/$formulir1->jumlah_baris)/100*$tiga, 2, '.', '')}}</td>
        <td>{{$dinding4=number_format(($formulir1->jml_dindingt2d/$formulir1->jumlah_baris)/100*$empat, 2, '.', '')}}</td>
        <td>{{$dinding5=number_format(($formulir1->jml_dindingt2e/$formulir1->jumlah_baris)/100*$lima, 2, '.', '')}}</td>
        <td>{{$dinding6=number_format(($formulir1->jml_dindingt2f/$formulir1->jumlah_baris)/100*$enam, 2, '.', '')}}</td>
        <td>{{$dinding7=number_format(($formulir1->jml_dindingt2g/$formulir1->jumlah_baris)/100*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumdinding=number_format(($dinding1+$dinding2+$dinding3+$dinding4+$dinding5+$dinding6+$dinding7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotdinding=number_format(21.50, 2, '.', '')}}%</td>
        <td>{{$sumtingkatdinding=number_format($sumdinding*$bobotdinding/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Plafond</td>
        <td>%</td>
        <td> {{$formulir->plafond_volume}} </td>
        <td>{{$plafond_tahap1con}}</td>
        <td>{{$formulir->plafond_tahap2a}}</td>
        <td>{{$formulir->plafond_tahap2b}}</td>
        <td>{{$formulir->plafond_tahap2c}}</td>
        <td>{{$formulir->plafond_tahap2d}}</td>
        <td>{{$formulir->plafond_tahap2e}}</td>
        <td>{{$formulir->plafond_tahap2f}}</td>
        <td>{{$formulir->plafond_tahap2g}}</td>
        <td>{{$plafond1=number_format($formulir->plafond_tahap2a/$formulir->plafond_volume*$satu, 2, '.', '')}}</td>
        <td>{{$plafond2=number_format($formulir->plafond_tahap2b/$formulir->plafond_volume*$dua, 2, '.', '')}}</td>
        <td>{{$plafond3=number_format($formulir->plafond_tahap2c/$formulir->plafond_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$plafond4=number_format($formulir->plafond_tahap2d/$formulir->plafond_volume*$empat, 2, '.', '')}}</td>
        <td>{{$plafond5=number_format($formulir->plafond_tahap2e/$formulir->plafond_volume*$lima, 2, '.', '')}}</td>
        <td>{{$plafond6=number_format($formulir->plafond_tahap2f/$formulir->plafond_volume*$enam, 2, '.', '')}}</td>
        <td>{{$plafond7=number_format($formulir->plafond_tahap2g/$formulir->plafond_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumplafond=number_format(($plafond1+$plafond2+$plafond3+$plafond4+$plafond5+$plafond6+$plafond7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotplafond=number_format(10, 2, '.', '')}}%</td>
        <td>{{$sumtingkatplafond=number_format($sumplafond*$bobotplafond/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Lantai</td>
        <td>%</td>
        <td> {{$formulir->lantai_volume}} </td>
        <td></td>
        <td>{{$formulir->lantai_tahap2a}}</td>
        <td>{{$formulir->lantai_tahap2b}}</td>
        <td>{{$formulir->lantai_tahap2c}}</td>
        <td>{{$formulir->lantai_tahap2d}}</td>
        <td>{{$formulir->lantai_tahap2e}}</td>
        <td>{{$formulir->lantai_tahap2f}}</td>
        <td>{{$formulir->lantai_tahap2g}}</td>
        <td>{{$lantai1=number_format($formulir->lantai_tahap2a/$formulir->lantai_volume*$satu, 2, '.', '')}}</td>
        <td>{{$lantai2=number_format($formulir->lantai_tahap2b/$formulir->lantai_volume*$dua, 2, '.', '')}}</td>
        <td>{{$lantai3=number_format($formulir->lantai_tahap2c/$formulir->lantai_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$lantai4=number_format($formulir->lantai_tahap2d/$formulir->lantai_volume*$empat, 2, '.', '')}}</td>
        <td>{{$lantai5=number_format($formulir->lantai_tahap2e/$formulir->lantai_volume*$lima, 2, '.', '')}}</td>
        <td>{{$lantai6=number_format($formulir->lantai_tahap2f/$formulir->lantai_volume*$enam, 2, '.', '')}}</td>
        <td>{{$lantai7=number_format($formulir->lantai_tahap2g/$formulir->lantai_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumlantai=number_format(($lantai1+$lantai2+$lantai3+$lantai4+$lantai5+$lantai6+$lantai7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotlantai=number_format(14.50, 2, '.', '')}}%</td>
        <td>{{$sumtingkatlantai=number_format($sumlantai*$bobotlantai/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Kusen</td>
        <td>unit</td>
        <td> {{$jumlah_kusen}} </td>
        <td></td>
        <td>{{$formulir1->jml_kusent2a}}</td>
        <td>{{$formulir1->jml_kusent2b}}</td>
        <td>{{$formulir1->jml_kusent2c}}</td>
        <td>{{$formulir1->jml_kusent2d}}</td>
        <td>{{$formulir1->jml_kusent2e}}</td>
        <td>{{$formulir1->jml_kusent2f}}</td>
        <td>{{$formulir1->jml_kusent2g}}</td>
        <td>{{$kusen1=number_format($formulir1->jml_kusent2a/$formulir1->jumlah_kusen*$satu, 2, '.', '')}}</td>
        <td>{{$kusen2=number_format($formulir1->jml_kusent2b/$formulir1->jumlah_kusen*$dua, 2, '.', '')}}</td>
        <td>{{$kusen3=number_format($formulir1->jml_kusent2c/$formulir1->jumlah_kusen*$tiga, 2, '.', '')}}</td>
        <td>{{$kusen4=number_format($formulir1->jml_kusent2d/$formulir1->jumlah_kusen*$empat, 2, '.', '')}}</td>
        <td>{{$kusen5=number_format($formulir1->jml_kusent2e/$formulir1->jumlah_kusen*$lima, 2, '.', '')}}</td>
        <td>{{$kusen6=number_format($formulir1->jml_kusent2f/$formulir1->jumlah_kusen*$enam, 2, '.', '')}}</td>
        <td>{{$kusen7=number_format($formulir1->jml_kusent2g/$formulir1->jumlah_kusen*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumkusen=number_format(($kusen1+$kusen2+$kusen3+$kusen4+$kusen5+$kusen6+$kusen7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotkusen=number_format(1, 2, '.', '')}}%</td>
        <td>{{$sumtingkatkusen=number_format($sumkusen*$bobotkusen/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Pintu</td>
        <td>unit</td>
        <td> {{$jumlah_pintu}} </td>
        <td></td>
        <td>{{$formulir1->jml_pintut2a}}</td>
        <td>{{$formulir1->jml_pintut2b}}</td>
        <td>{{$formulir1->jml_pintut2c}}</td>
        <td>{{$formulir1->jml_pintut2d}}</td>
        <td>{{$formulir1->jml_pintut2e}}</td>
        <td>{{$formulir1->jml_pintut2f}}</td>
        <td>{{$formulir1->jml_pintut2g}}</td>
        <td>{{$pintu1=number_format($formulir1->jml_pintut2a/$formulir1->jumlah_pintu*$satu, 2, '.', '')}}</td>
        <td>{{$pintu2=number_format($formulir1->jml_pintut2b/$formulir1->jumlah_pintu*$dua, 2, '.', '')}}</td>
        <td>{{$pintu3=number_format($formulir1->jml_pintut2c/$formulir1->jumlah_pintu*$tiga, 2, '.', '')}}</td>
        <td>{{$pintu4=number_format($formulir1->jml_pintut2d/$formulir1->jumlah_pintu*$empat, 2, '.', '')}}</td>
        <td>{{$pintu5=number_format($formulir1->jml_pintut2e/$formulir1->jumlah_pintu*$lima, 2, '.', '')}}</td>
        <td>{{$pintu6=number_format($formulir1->jml_pintut2f/$formulir1->jumlah_pintu*$enam, 2, '.', '')}}</td>
        <td>{{$pintu7=number_format($formulir1->jml_pintut2g/$formulir1->jumlah_pintu*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumpintu=number_format(($pintu1+$pintu2+$pintu3+$pintu4+$pintu5+$pintu6+$pintu7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotpintu=number_format(1.50, 2, '.', '')}}%</td>
        <td>{{$sumtingkatpintu=number_format($sumpintu*$bobotpintu/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Jendela</td>
        <td>unit</td>
        <td> {{$jumlah_jendela}} </td>
        <td></td>
        <td>{{$formulir1->jml_jendelat2a}}</td>
        <td>{{$formulir1->jml_jendelat2b}}</td>
        <td>{{$formulir1->jml_jendelat2c}}</td>
        <td>{{$formulir1->jml_jendelat2d}}</td>
        <td>{{$formulir1->jml_jendelat2e}}</td>
        <td>{{$formulir1->jml_jendelat2f}}</td>
        <td>{{$formulir1->jml_jendelat2g}}</td>
        <td>{{$jendela1=number_format($formulir1->jml_jendelat2a/$formulir1->jumlah_jendela*$satu, 2, '.', '')}}</td>
        <td>{{$jendela2=number_format($formulir1->jml_jendelat2b/$formulir1->jumlah_jendela*$dua, 2, '.', '')}}</td>
        <td>{{$jendela3=number_format($formulir1->jml_jendelat2c/$formulir1->jumlah_jendela*$tiga, 2, '.', '')}}</td>
        <td>{{$jendela4=number_format($formulir1->jml_jendelat2d/$formulir1->jumlah_jendela*$empat, 2, '.', '')}}</td>
        <td>{{$jendela5=number_format($formulir1->jml_jendelat2e/$formulir1->jumlah_jendela*$lima, 2, '.', '')}}</td>
        <td>{{$jendela6=number_format($formulir1->jml_jendelat2f/$formulir1->jumlah_jendela*$enam, 2, '.', '')}}</td>
        <td>{{$jendela7=number_format($formulir1->jml_jendelat2g/$formulir1->jumlah_jendela*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumjendela=number_format(($jendela1+$jendela2+$jendela3+$jendela4+$jendela5+$jendela6+$jendela7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotjendela=number_format(2, 2, '.', '')}}%</td>
        <td>{{$sumtingkatjendela=number_format($sumjendela*$bobotjendela/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Finishing Plafond</td>
        <td>%</td>
        <td> {{$formulir->finishing_plafont_volume}} </td>
        <td></td>
        <td>{{$formulir->finishing_plafont_tahap2a}}</td>
        <td>{{$formulir->finishing_plafont_tahap2b}}</td>
        <td>{{$formulir->finishing_plafont_tahap2c}}</td>
        <td>{{$formulir->finishing_plafont_tahap2d}}</td>
        <td>{{$formulir->finishing_plafont_tahap2e}}</td>
        <td>{{$formulir->finishing_plafont_tahap2f}}</td>
        <td>{{$formulir->finishing_plafont_tahap2g}}</td>
        <td>{{$finishing_plafont1=number_format($formulir->finishing_plafont_tahap2a/$formulir->finishing_plafont_volume*$satu, 2, '.', '')}}</td>
        <td>{{$finishing_plafont2=number_format($formulir->finishing_plafont_tahap2b/$formulir->finishing_plafont_volume*$dua, 2, '.', '')}}</td>
        <td>{{$finishing_plafont3=number_format($formulir->finishing_plafont_tahap2c/$formulir->finishing_plafont_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$finishing_plafont4=number_format($formulir->finishing_plafont_tahap2d/$formulir->finishing_plafont_volume*$empat, 2, '.', '')}}</td>
        <td>{{$finishing_plafont5=number_format($formulir->finishing_plafont_tahap2e/$formulir->finishing_plafont_volume*$lima, 2, '.', '')}}</td>
        <td>{{$finishing_plafont6=number_format($formulir->finishing_plafont_tahap2f/$formulir->finishing_plafont_volume*$enam, 2, '.', '')}}</td>
        <td>{{$finishing_plafont7=number_format($formulir->finishing_plafont_tahap2g/$formulir->finishing_plafont_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumfinishing_plafont=number_format(($finishing_plafont1+$finishing_plafont2+$finishing_plafont3+$finishing_plafont4+$finishing_plafont5+$finishing_plafont6+$finishing_plafont7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotfinishing_plafont=number_format(3, 2, '.', '')}}%</td>
        <td>{{$sumtingkatfinishing_plafond=number_format($sumfinishing_plafont*$bobotfinishing_plafont/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Finishing Dinding</td>
        <td>%</td>
        <td> {{$formulir->finishing_dinding_volume}} </td>
        <td></td>
        <td>{{$formulir->finishing_dinding_tahap2a}}</td>
        <td>{{$formulir->finishing_dinding_tahap2b}}</td>
        <td>{{$formulir->finishing_dinding_tahap2c}}</td>
        <td>{{$formulir->finishing_dinding_tahap2d}}</td>
        <td>{{$formulir->finishing_dinding_tahap2e}}</td>
        <td>{{$formulir->finishing_dinding_tahap2f}}</td>
        <td>{{$formulir->finishing_dinding_tahap2g}}</td>
        <td>{{$finishing_dinding1=number_format($formulir->finishing_dinding_tahap2a/$formulir->finishing_dinding_volume*$satu, 2, '.', '')}}</td>
        <td>{{$finishing_dinding2=number_format($formulir->finishing_dinding_tahap2b/$formulir->finishing_dinding_volume*$dua, 2, '.', '')}}</td>
        <td>{{$finishing_dinding3=number_format($formulir->finishing_dinding_tahap2c/$formulir->finishing_dinding_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$finishing_dinding4=number_format($formulir->finishing_dinding_tahap2d/$formulir->finishing_dinding_volume*$empat, 2, '.', '')}}</td>
        <td>{{$finishing_dinding5=number_format($formulir->finishing_dinding_tahap2e/$formulir->finishing_dinding_volume*$lima, 2, '.', '')}}</td>
        <td>{{$finishing_dinding6=number_format($formulir->finishing_dinding_tahap2f/$formulir->finishing_dinding_volume*$enam, 2, '.', '')}}</td>
        <td>{{$finishing_dinding7=number_format($formulir->finishing_dinding_tahap2g/$formulir->finishing_dinding_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumfinishing_dinding=number_format(($finishing_dinding1+$finishing_dinding2+$finishing_dinding3+$finishing_dinding4+$finishing_dinding5+$finishing_dinding6+$finishing_dinding7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotfinishing_dinding=number_format(4, 2, '.', '')}}%</td>
        <td>{{$sumtingkatfinishing_dinding=number_format($sumfinishing_dinding*$bobotfinishing_dinding/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Finishing Kusen & Pintu</td>
        <td>%</td>
        <td> {{$formulir->finishing_kusen_volume}} </td>
        <td></td>
        <td>{{$formulir->finishing_kusen_tahap2a}}</td>
        <td>{{$formulir->finishing_kusen_tahap2b}}</td>
        <td>{{$formulir->finishing_kusen_tahap2c}}</td>
        <td>{{$formulir->finishing_kusen_tahap2d}}</td>
        <td>{{$formulir->finishing_kusen_tahap2e}}</td>
        <td>{{$formulir->finishing_kusen_tahap2f}}</td>
        <td>{{$formulir->finishing_kusen_tahap2g}}</td>
        <td>{{$finishing_kusen1=number_format($formulir->finishing_kusen_tahap2a/$formulir->finishing_kusen_volume*$satu, 2, '.', '')}}</td>
        <td>{{$finishing_kusen2=number_format($formulir->finishing_kusen_tahap2b/$formulir->finishing_kusen_volume*$dua, 2, '.', '')}}</td>
        <td>{{$finishing_kusen3=number_format($formulir->finishing_kusen_tahap2c/$formulir->finishing_kusen_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$finishing_kusen4=number_format($formulir->finishing_kusen_tahap2d/$formulir->finishing_kusen_volume*$empat, 2, '.', '')}}</td>
        <td>{{$finishing_kusen5=number_format($formulir->finishing_kusen_tahap2e/$formulir->finishing_kusen_volume*$lima, 2, '.', '')}}</td>
        <td>{{$finishing_kusen6=number_format($formulir->finishing_kusen_tahap2f/$formulir->finishing_kusen_volume*$enam, 2, '.', '')}}</td>
        <td>{{$finishing_kusen7=number_format($formulir->finishing_kusen_tahap2g/$formulir->finishing_kusen_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumfinishing_kusen=number_format(($finishing_kusen1+$finishing_kusen2+$finishing_kusen3+$finishing_kusen4+$finishing_kusen5+$finishing_kusen6+$finishing_kusen7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotfinishing_kusen=number_format(2, 2, '.', '')}}%</td>
        <td>{{$sumtingkatfinishing_kusen=number_format($sumfinishing_kusen*$bobotfinishing_kusen/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td rowspan="3">3</td>
        <td rowspan="3">UTILITAS</td>
        <td>Instalasi Listrik</td>
        <td>Estimasi</td>
        <td></td>
        <td></td>
        <td colspan="7">{{$instalasi_listrik_tahap2con}}</td>
        <td colspan="7"></td>
        <td>{{$instalasi_listrik_tahap2p}}%</td>
        <td>{{$bobotinstalasi_listrik=number_format(1, 2, '.', '')}}%</td>
        <td>{{$sumtingkatinstalasi_listrik=number_format($instalasi_listrik_tahap2p*$bobotinstalasi_listrik/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Instalasi Air Bersih</td>
        <td>Estimasi</td>
        <td></td>
        <td></td>
        <td colspan="7">{{$instalasi_airbersih_tahap2con}}</td>
        <td colspan="7"></td>
        <td>{{$instalasi_airbersih_tahap2p}}%</td>
        <td>{{$bobotinstalasi_airbersih=number_format(1, 2, '.', '')}}%</td>
        <td>{{$sumtingkatinstalasi_airbersih=number_format($instalasi_airbersih_tahap2p*$bobotinstalasi_airbersih/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Drainase Limbah</td>
        <td>m1</td>
        <td> {{$jumlah_drainase}} </td>
        <td></td>
        <td>{{$formulir->drainaselimbah_tahap2a}}</td>
        <td>{{$formulir->drainaselimbah_tahap2b}}</td>
        <td>{{$formulir->drainaselimbah_tahap2c}}</td>
        <td>{{$formulir->drainaselimbah_tahap2d}}</td>
        <td>{{$formulir->drainaselimbah_tahap2e}}</td>
        <td>{{$formulir->drainaselimbah_tahap2f}}</td>
        <td>{{$formulir->drainaselimbah_tahap2g}}</td>
        <td>{{$drainaselimbah1=number_format($formulir->drainaselimbah_tahap2a/$formulir->drainaselimbah_volume*$satu, 2, '.', '')}}</td>
        <td>{{$drainaselimbah2=number_format($formulir->drainaselimbah_tahap2b/$formulir->drainaselimbah_volume*$dua, 2, '.', '')}}</td>
        <td>{{$drainaselimbah3=number_format($formulir->drainaselimbah_tahap2c/$formulir->drainaselimbah_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$drainaselimbah4=number_format($formulir->drainaselimbah_tahap2d/$formulir->drainaselimbah_volume*$empat, 2, '.', '')}}</td>
        <td>{{$drainaselimbah5=number_format($formulir->drainaselimbah_tahap2e/$formulir->drainaselimbah_volume*$lima, 2, '.', '')}}</td>
        <td>{{$drainaselimbah6=number_format($formulir->drainaselimbah_tahap2f/$formulir->drainaselimbah_volume*$enam, 2, '.', '')}}</td>
        <td>{{$drainaselimbah7=number_format($formulir->drainaselimbah_tahap2g/$formulir->drainaselimbah_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumdrainaselimbah=number_format(($drainaselimbah1+$drainaselimbah2+$drainaselimbah3+$drainaselimbah4+$drainaselimbah5+$drainaselimbah6+$drainaselimbah7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotdrainaselimbah=number_format(1.50, 2, '.', '')}}%</td>
        <td>{{$sumtingkatdrainaselimbah=number_format($sumdrainaselimbah*$bobotdrainaselimbah/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        @php
            $totalkerusakan=
        $sumtingkatpondasi+
        $sumtingkatkolom+
        $sumtingkatbalok+
        $sumtingkatatap+
        $sumtingkatdinding+
        $sumtingkatplafond+
        $sumtingkatlantai+
        $sumtingkatkusen+
        $sumtingkatpintu+
        $sumtingkatjendela+
        $sumtingkatfinishing_plafond+
        $sumtingkatfinishing_dinding+
        $sumtingkatfinishing_kusen+
        $sumtingkatinstalasi_listrik+
        $sumtingkatinstalasi_airbersih+
        $sumtingkatdrainaselimbah;

            if($totalkerusakan <= 30){
                $keterangan = "Rusak Ringan";
                $warna      = "green";
            }else if($totalkerusakan > 30 && $totalkerusakan <= 45){
                $keterangan = "Rusak Sedang";
                $warna      =  "orange";
            }else{
                $keterangan = "Rusak Berat";
                $warna      = "red";
            }

            if($pondasi_tahap111==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }elseif($kolom_tahap111==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }elseif($balok_tahap111==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }elseif($atap_tahap111==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }elseif($dinding_tahap111==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }elseif($plafond_tahap111==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }else{
                $status=$keterangan;
                $statusa="Hitung Kerusakan";
                $warnaa=$warna;
            }
        @endphp
        <td colspan="5"></td>
        <td>{{$statusa}}</td>
        <td colspan="7"></td>
        <td colspan="9">TOTAL NILAI KERUSAKAN
            MASSA BANGUNAN / RUANGAN=</td>
        <td>{{$totalkerusakan}}%</td>
    </tr>
    <tr class="atable">
        <td class="atable" colspan="23">&nbsp;</td>
    </tr>
    <tr>
        @php
        // $warnaa=0;

        @endphp

        <td style="border: none;" colspan="13"></td>
        <td colspan="9">KESIMPULAN TINGKAT KERUSAKAN
            MASSA BANGUNAN / RUANGAN =</td>
        <td bgcolor="{{$warnaa}}">{{$status}}</td>
    </tr>
    <tr class="atable">
        <td class="atable" colspan="23">&nbsp;</td>
    </tr>
    <tr class="atable">
        <td class="atable" colspan="23">&nbsp;</td>
    </tr>
    <tr class="atable">
        <td colspan="20"></td>
        <td style="text-align: left;" colspan="2">Ringan</td>
        <td style="text-align: left;">: <= 30% </td>
    </tr>
    <tr>
        <td colspan="18" rowspan="19">SKETSA DENAH BANGUNAN</td>
        <td style="border: none;text-align: left;" colspan="2"></td>
        <td style="border: none;text-align: left;" colspan="2">Sedang</td>
        <td style="border: none;text-align: left;">: >30% - 45%</td>
    </tr>
    <tr>
        <td style="border: none;text-align: left;" colspan="2"></td>
        <td style="border: none;text-align: left;" colspan="2">Berat</td>
        <td style="border: none;text-align: left;">: >45%</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">TIM SURVEY</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">Petugas Survey</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">(........................)</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">MENYETUJUI</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">Dinas PU Kab/Kota/Provinsi</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">(........................)</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">MENGETAHUI</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">Dinas Kebudayaan Pendidikan</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">Kab/Kota/Provinsi</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">&nbsp;</td>
    </tr>
    <tr>
        <td style="border: none;" colspan="2"></td>
        <td style="border: none;" colspan="5">(........................)</td>
    </tr>



</table>
</body>
</html>
