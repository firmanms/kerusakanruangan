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
        <td style="text-align: left;">: </td>
    </tr>
    <tr>
        <td style="text-align: left;">Nama Bangunan</td>
        <td style="text-align: left;">: {{$formulir->ruangs->nama_ruang}}</td>
    </tr>
    <tr>
        <td style="text-align: left;">NUP (No Urut Perolehan)</td>
        <td style="text-align: left;">: </td>
    </tr>
    <tr>
        <td style="text-align: left;">Alamat</td>
        <td style="text-align: left;">: </td>
    </tr>
    <tr>
        <td style="text-align: left;">Kabupaten/Kota</td>
        <td style="text-align: left;">: </td>
    </tr>
    <tr>
        <td style="text-align: left;">Koordinat</td>
        <td style="text-align: left;">: </td>
    </tr>
    <tr>
        <td style="text-align: left;">Luas Bangunan</td>
        <td style="text-align: left;">: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Jumlah Lantai :</td>
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
        <td>{{$formulir->pondasi_tahap2}}%</td>
        <td>{{$bobotpondasi=number_format(12, 2, '.', '')}}%</td>
        <td>{{$sumtingkatpondasi=number_format($formulir->pondasi_tahap2*$bobotpondasi/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Kolom</td>
        <td>unit</td>
        <td> {{$formulir->kolom_volume}} </td>
        <td>{{$kolom_tahap1con}}</td>
        <td>{{$formulir->kolom_tahap2a}}</td>
        <td>{{$formulir->kolom_tahap2b}}</td>
        <td>{{$formulir->kolom_tahap2c}}</td>
        <td>{{$formulir->kolom_tahap2d}}</td>
        <td>{{$formulir->kolom_tahap2e}}</td>
        <td>{{$formulir->kolom_tahap2f}}</td>
        <td>{{$formulir->kolom_tahap2g}}</td>
        <td>{{$kolom1=number_format($formulir->kolom_tahap2a/$formulir->kolom_volume*$satu, 2, '.', '')}}</td>
        <td>{{$kolom2=number_format($formulir->kolom_tahap2b/$formulir->kolom_volume*$dua, 2, '.', '')}}</td>
        <td>{{$kolom3=number_format($formulir->kolom_tahap2c/$formulir->kolom_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$kolom4=number_format($formulir->kolom_tahap2d/$formulir->kolom_volume*$empat, 2, '.', '')}}</td>
        <td>{{$kolom5=number_format($formulir->kolom_tahap2e/$formulir->kolom_volume*$lima, 2, '.', '')}}</td>
        <td>{{$kolom6=number_format($formulir->kolom_tahap2f/$formulir->kolom_volume*$enam, 2, '.', '')}}</td>
        <td>{{$kolom7=number_format($formulir->kolom_tahap2g/$formulir->kolom_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumkolom=number_format(($kolom1+$kolom2+$kolom3+$kolom4+$kolom5+$kolom6+$kolom7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotkolom=number_format(10, 2, '.', '')}}%</td>
        <td>{{$sumtingkatkolom=number_format($sumkolom*$bobotkolom/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Balok</td>
        <td>unit</td>
        <td> {{$formulir->balok_volume}} </td>
        <td>{{$balok_tahap1con}}</td>
        <td>{{$formulir->balok_tahap2a}}</td>
        <td>{{$formulir->balok_tahap2b}}</td>
        <td>{{$formulir->balok_tahap2c}}</td>
        <td>{{$formulir->balok_tahap2d}}</td>
        <td>{{$formulir->balok_tahap2e}}</td>
        <td>{{$formulir->balok_tahap2f}}</td>
        <td>{{$formulir->balok_tahap2g}}</td>
        <td>{{$balok1=number_format($formulir->balok_tahap2a/$formulir->balok_volume*$satu, 2, '.', '')}}</td>
        <td>{{$balok2=number_format($formulir->balok_tahap2b/$formulir->balok_volume*$dua, 2, '.', '')}}</td>
        <td>{{$balok3=number_format($formulir->balok_tahap2c/$formulir->balok_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$balok4=number_format($formulir->balok_tahap2d/$formulir->balok_volume*$empat, 2, '.', '')}}</td>
        <td>{{$balok5=number_format($formulir->balok_tahap2e/$formulir->balok_volume*$lima, 2, '.', '')}}</td>
        <td>{{$balok6=number_format($formulir->balok_tahap2f/$formulir->balok_volume*$enam, 2, '.', '')}}</td>
        <td>{{$balok7=number_format($formulir->balok_tahap2g/$formulir->balok_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumbalok=number_format(($balok1+$balok2+$balok3+$balok4+$balok5+$balok6+$balok7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotbalok=number_format(8, 2, '.', '')}}%</td>
        <td>{{$sumtingkatbalok=number_format($sumbalok*$bobotbalok/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Atap</td>
        <td>%</td>
        <td> {{$formulir->atap_volume}} </td>
        <td>{{$atap_tahap1con}}</td>
        <td>{{$formulir->atap_tahap2a}}</td>
        <td>{{$formulir->atap_tahap2b}}</td>
        <td>{{$formulir->atap_tahap2c}}</td>
        <td>{{$formulir->atap_tahap2d}}</td>
        <td>{{$formulir->atap_tahap2e}}</td>
        <td>{{$formulir->atap_tahap2f}}</td>
        <td>{{$formulir->atap_tahap2g}}</td>
        <td>{{$atap1=number_format($formulir->atap_tahap2a/$formulir->atap_volume*$satu, 2, '.', '')}}</td>
        <td>{{$atap2=number_format($formulir->atap_tahap2b/$formulir->atap_volume*$dua, 2, '.', '')}}</td>
        <td>{{$atap3=number_format($formulir->atap_tahap2c/$formulir->atap_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$atap4=number_format($formulir->atap_tahap2d/$formulir->atap_volume*$empat, 2, '.', '')}}</td>
        <td>{{$atap5=number_format($formulir->atap_tahap2e/$formulir->atap_volume*$lima, 2, '.', '')}}</td>
        <td>{{$atap6=number_format($formulir->atap_tahap2f/$formulir->atap_volume*$enam, 2, '.', '')}}</td>
        <td>{{$atap7=number_format($formulir->atap_tahap2g/$formulir->atap_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumatap=number_format(($atap1+$atap2+$atap3+$atap4+$atap5+$atap6+$atap7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotatap=number_format(7, 2, '.', '')}}%</td>
        <td>{{$sumtingkatatap=number_format($sumatap*$bobotatap/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td rowspan="9">2</td>
        <td rowspan="9">ARSITEKTUR</td>
        <td>Dinding /Pondasi</td>
        <td>%</td>
        <td> {{$formulir->dinding_volume}} </td>
        <td>{{$dinding_tahap1con}}</td>
        <td>{{$formulir->dinding_tahap2a}}</td>
        <td>{{$formulir->dinding_tahap2b}}</td>
        <td>{{$formulir->dinding_tahap2c}}</td>
        <td>{{$formulir->dinding_tahap2d}}</td>
        <td>{{$formulir->dinding_tahap2e}}</td>
        <td>{{$formulir->dinding_tahap2f}}</td>
        <td>{{$formulir->dinding_tahap2g}}</td>
        <td>{{$dinding1=number_format($formulir->dinding_tahap2a/$formulir->dinding_volume*$satu, 2, '.', '')}}</td>
        <td>{{$dinding2=number_format($formulir->dinding_tahap2b/$formulir->dinding_volume*$dua, 2, '.', '')}}</td>
        <td>{{$dinding3=number_format($formulir->dinding_tahap2c/$formulir->dinding_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$dinding4=number_format($formulir->dinding_tahap2d/$formulir->dinding_volume*$empat, 2, '.', '')}}</td>
        <td>{{$dinding5=number_format($formulir->dinding_tahap2e/$formulir->dinding_volume*$lima, 2, '.', '')}}</td>
        <td>{{$dinding6=number_format($formulir->dinding_tahap2f/$formulir->dinding_volume*$enam, 2, '.', '')}}</td>
        <td>{{$dinding7=number_format($formulir->dinding_tahap2g/$formulir->dinding_volume*$tujuh, 2, '.', '')}}</td>
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
        <td> {{$formulir->kusen_volume}} </td>
        <td></td>
        <td>{{$formulir->kusen_tahap2a}}</td>
        <td>{{$formulir->kusen_tahap2b}}</td>
        <td>{{$formulir->kusen_tahap2c}}</td>
        <td>{{$formulir->kusen_tahap2d}}</td>
        <td>{{$formulir->kusen_tahap2e}}</td>
        <td>{{$formulir->kusen_tahap2f}}</td>
        <td>{{$formulir->kusen_tahap2g}}</td>
        <td>{{$kusen1=number_format($formulir->kusen_tahap2a/$formulir->kusen_volume*$satu, 2, '.', '')}}</td>
        <td>{{$kusen2=number_format($formulir->kusen_tahap2b/$formulir->kusen_volume*$dua, 2, '.', '')}}</td>
        <td>{{$kusen3=number_format($formulir->kusen_tahap2c/$formulir->kusen_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$kusen4=number_format($formulir->kusen_tahap2d/$formulir->kusen_volume*$empat, 2, '.', '')}}</td>
        <td>{{$kusen5=number_format($formulir->kusen_tahap2e/$formulir->kusen_volume*$lima, 2, '.', '')}}</td>
        <td>{{$kusen6=number_format($formulir->kusen_tahap2f/$formulir->kusen_volume*$enam, 2, '.', '')}}</td>
        <td>{{$kusen7=number_format($formulir->kusen_tahap2g/$formulir->kusen_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumkusen=number_format(($kusen1+$kusen2+$kusen3+$kusen4+$kusen5+$kusen6+$kusen7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotkusen=number_format(1, 2, '.', '')}}%</td>
        <td>{{$sumtingkatkusen=number_format($sumkusen*$bobotkusen/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Pintu</td>
        <td>unit</td>
        <td> {{$formulir->pintu_volume}} </td>
        <td></td>
        <td>{{$formulir->pintu_tahap2a}}</td>
        <td>{{$formulir->pintu_tahap2b}}</td>
        <td>{{$formulir->pintu_tahap2c}}</td>
        <td>{{$formulir->pintu_tahap2d}}</td>
        <td>{{$formulir->pintu_tahap2e}}</td>
        <td>{{$formulir->pintu_tahap2f}}</td>
        <td>{{$formulir->pintu_tahap2g}}</td>
        <td>{{$pintu1=number_format($formulir->pintu_tahap2a/$formulir->pintu_volume*$satu, 2, '.', '')}}</td>
        <td>{{$pintu2=number_format($formulir->pintu_tahap2b/$formulir->pintu_volume*$dua, 2, '.', '')}}</td>
        <td>{{$pintu3=number_format($formulir->pintu_tahap2c/$formulir->pintu_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$pintu4=number_format($formulir->pintu_tahap2d/$formulir->pintu_volume*$empat, 2, '.', '')}}</td>
        <td>{{$pintu5=number_format($formulir->pintu_tahap2e/$formulir->pintu_volume*$lima, 2, '.', '')}}</td>
        <td>{{$pintu6=number_format($formulir->pintu_tahap2f/$formulir->pintu_volume*$enam, 2, '.', '')}}</td>
        <td>{{$pintu7=number_format($formulir->pintu_tahap2g/$formulir->pintu_volume*$tujuh, 2, '.', '')}}</td>
        <td>{{$sumpintu=number_format(($pintu1+$pintu2+$pintu3+$pintu4+$pintu5+$pintu6+$pintu7)*100, 0, '.', '')}}%</td>
        <td>{{$bobotpintu=number_format(1.50, 2, '.', '')}}%</td>
        <td>{{$sumtingkatpintu=number_format($sumpintu*$bobotpintu/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Jendela</td>
        <td>unit</td>
        <td> {{$formulir->jendela_volume}} </td>
        <td></td>
        <td>{{$formulir->jendela_tahap2a}}</td>
        <td>{{$formulir->jendela_tahap2b}}</td>
        <td>{{$formulir->jendela_tahap2c}}</td>
        <td>{{$formulir->jendela_tahap2d}}</td>
        <td>{{$formulir->jendela_tahap2e}}</td>
        <td>{{$formulir->jendela_tahap2f}}</td>
        <td>{{$formulir->jendela_tahap2g}}</td>
        <td>{{$jendela1=number_format($formulir->jendela_tahap2a/$formulir->jendela_volume*$satu, 2, '.', '')}}</td>
        <td>{{$jendela2=number_format($formulir->jendela_tahap2b/$formulir->jendela_volume*$dua, 2, '.', '')}}</td>
        <td>{{$jendela3=number_format($formulir->jendela_tahap2c/$formulir->jendela_volume*$tiga, 2, '.', '')}}</td>
        <td>{{$jendela4=number_format($formulir->jendela_tahap2d/$formulir->jendela_volume*$empat, 2, '.', '')}}</td>
        <td>{{$jendela5=number_format($formulir->jendela_tahap2e/$formulir->jendela_volume*$lima, 2, '.', '')}}</td>
        <td>{{$jendela6=number_format($formulir->jendela_tahap2f/$formulir->jendela_volume*$enam, 2, '.', '')}}</td>
        <td>{{$jendela7=number_format($formulir->jendela_tahap2g/$formulir->jendela_volume*$tujuh, 2, '.', '')}}</td>
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
        <td>{{$formulir->instalasi_listrik_tahap2}}%</td>
        <td>{{$bobotinstalasi_listrik=number_format(1, 2, '.', '')}}%</td>
        <td>{{$sumtingkatinstalasi_listrik=number_format($formulir->instalasi_listrik_tahap2*$bobotinstalasi_listrik/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Instalasi Air Bersih</td>
        <td>Estimasi</td>
        <td></td>
        <td></td>
        <td colspan="7">{{$instalasi_airbersih_tahap2con}}</td>
        <td colspan="7"></td>
        <td>{{$formulir->instalasi_airbersih_tahap2}}%</td>
        <td>{{$bobotinstalasi_airbersih=number_format(1, 2, '.', '')}}%</td>
        <td>{{$sumtingkatinstalasi_airbersih=number_format($formulir->instalasi_airbersih_tahap2*$bobotinstalasi_airbersih/100, 2, '.', '')}}%</td>
    </tr>
    <tr>
        <td>Drainase Limbah</td>
        <td>m1</td>
        <td> {{$formulir->drainaselimbah_volume}} </td>
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

            if($formulir->pondasi_tahap1==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }elseif($formulir->kolom_tahap1==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }elseif($formulir->balok_tahap1==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }elseif($formulir->dinding_tahap1==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }elseif($formulir->plafond_tahap1==1){
                $status="Rusak Berat";
                $statusa="";
                $warnaa="red";
            }elseif($formulir->atap_tahap1==1){
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
