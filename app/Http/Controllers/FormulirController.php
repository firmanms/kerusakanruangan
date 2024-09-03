<?php

namespace App\Http\Controllers;

use App\Models\Bangunan;
use App\Models\Formulir;
use App\Models\Tanah;
use Illuminate\Http\Request;

class FormulirController extends Controller
{
    public function formulirruangan(string $id)
    {
        $formulir=Formulir::where('id',$id)->first();
        $bangunanid=$formulir->bangunans_id;
        $bangunan=Bangunan::where('id',$bangunanid)->first();
        $tanahid=$bangunan->tanahs_id;
         $tanah=Tanah::where('id',$tanahid)->first();

        if($formulir->pondasi_tahap1==0){
            $pondasi_tahap1con="Tidak ada kerusakan";
            $pondasi_tahap1conb="Cek Kerusakan Komponen Lain";
        }elseif($formulir->pondasi_tahap1==1){
            $pondasi_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
            $pondasi_tahap1conb="Rusak Berat";
        }elseif($formulir->pondasi_tahap1==3){
            $pondasi_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
            $pondasi_tahap1conb="Cek Kerusakan Komponen Lain";
        }

        if($formulir->pondasi_tahap2==0){
            $pondasi_tahap2con="Pondasi diindikasi dalam kondisi baik";
        }elseif($formulir->pondasi_tahap2==20){
            $pondasi_tahap2con="Penurunan merata pada seluruh struktur bangunan";
        }elseif($formulir->pondasi_tahap2==35){
            $pondasi_tahap2con="Penurunan tidak merata, namun perbedaan penurunan tidak melebihi 1/250 L";
        }elseif($formulir->pondasi_tahap2==50){
            $pondasi_tahap2con="Penurunan > 1/250 L sehingga menimbulkan kerusakan struktur atasnya. Tanah disekeliling bangunan naik";
        }elseif($formulir->pondasi_tahap2==70){
            $pondasi_tahap2con="Bangunan miring secara kasat mata, Lantai dasar naik/menggelembung";
        }elseif($formulir->pondasi_tahap2==85){
            $pondasi_tahap2con="Pondasi patah, bergeser akibat longsor, struktur atas menjadi rusak ";
        }elseif($formulir->pondasi_tahap2==100){
            $pondasi_tahap2con="Material, dimensi, dan konstruksi pondasi diindikasi tidak sesuai dengan persyaratan teknis (merujuk pada Rencana Teknis apabila ada, Petunjuk Teknis, dan/atau SNI)";
        }

        if($formulir->instalasi_listrik_tahap2==0){
            $instalasi_listrik_tahap2con="Jaringan listrik dalam kondisi baik";
        }elseif($formulir->instalasi_listrik_tahap2==20){
            $instalasi_listrik_tahap2con="Sebagian kecil komponen dari panel-panel LP rusak, ada sedikit jalur kabel instalasi shortage, sebagian kecil armature rusak ringan, sehingga biaya perbaikan kurang dari 10% dari biaya instalasi baru";
        }elseif($formulir->instalasi_listrik_tahap2==35){
            $instalasi_listrik_tahap2con="Beberapa komponen dari panel-panel LP rusak, sebagian kecil jalur kabel instalasi shortage, sehingga armature rusak ringan, sehingga biaya perbaikan 10-25% dari biaya instalasi baru";
        }elseif($formulir->instalasi_listrik_tahap2==50){
            $instalasi_listrik_tahap2con="Beberapa komponen dari panel-panel LP rusak, sebagian kecil jalur kabel instalasi shortage, sehingga armature rusak berat dan ringan, sehingga biaya perbaikan 25-50% dari biaya instalasi baru";
        }elseif($formulir->instalasi_listrik_tahap2==70){
            $instalasi_listrik_tahap2con="Sebagian besar komponen panel-panel LP rusak, sebagian besar kabel instalasi shortage, sebagian besar armature rusak, sehingga biaya perbaikan 50-65 % dari instalasi baru";
        }elseif($formulir->instalasi_listrik_tahap2==85){
            $instalasi_listrik_tahap2con="Sebagian besar komponen panel-panel LP rusak, sebagian besar kabel instalasi shortage, seluruh armature rusak berat, sehingga biaya perbaikan lebih dari 65 % dari instalasi baru";
        }elseif($formulir->instalasi_listrik_tahap2==100){
            $instalasi_listrik_tahap2con="Material, dimensi, dan konstruksi jaringan listrik diindikasi tidak sesuai dengan persyaratan teknis (merujuk pada Rencana Teknis apabila ada, Petunjuk Teknis, dan/atau SNI)";
        }

        if($formulir->instalasi_airbersih_tahap2==0){
            $instalasi_airbersih_tahap2con="Sistem penyediaan air dalam kondisi baik";
        }elseif($formulir->instalasi_airbersih_tahap2==20){
            $instalasi_airbersih_tahap2con="Kebocoran pipa terbatas ditempat yang terlihat atau mudah dicapai, keran-keran kecil rusak, sehingga biaya perbaikan kurang dari 10% biaya instalasi baru";
        }elseif($formulir->instalasi_airbersih_tahap2==35){
            $instalasi_airbersih_tahap2con="Bagian-bagian kecil pemipaan bocor, motor pompa terbakar, keran-keran kecil rusak, sehingga biaya perbaikan antara 10-25% dari biaya instalasi baru";
        }elseif($formulir->instalasi_airbersih_tahap2==50){
            $instalasi_airbersih_tahap2con="Pompa, motor, pipa, dan keran rusak apabila diganti atau diperbaiki memerlukan biaya antara 25-50% dari biaya instalasi baru";
        }elseif($formulir->instalasi_airbersih_tahap2==70){
            $instalasi_airbersih_tahap2con="Sebagian besar pompa, sebagian besar motor terbakar, pipa utama bocor namun ditempat terbuka, beberapa keran tidak berfungsi, sehingga biaya perbaikan 50-65% dari biaya instalasi baru";
        }elseif($formulir->instalasi_airbersih_tahap2==85){
            $instalasi_airbersih_tahap2con="Pompa –pompa rusak total, motor terbakar, di banyak tempat terbuka dan tutup pipa-pipa bocor keran-keran tidak berfungsi, sehingga perbaikan instalasi perlu menyeluruh, dengan perkiraan biaya lebih dari 65% dari biaya instalasi baru";
        }elseif($formulir->instalasi_airbersih_tahap2==100){
            $instalasi_airbersih_tahap2con="Material, dimensi, dan konstruksi sistem penyediaan air diindikasi tidak sesuai dengan persyaratan teknis (merujuk pada Rencana Teknis apabila ada, Petunjuk Teknis, dan/atau SNI)";
        }

        if($formulir->kolom_tahap1==0){
            $kolom_tahap1con="Tidak ada kerusakan";
        }elseif($formulir->kolom_tahap1==1){
            $kolom_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
        }elseif($formulir->kolom_tahap1==3){
            $kolom_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
        }

        if($formulir->balok_tahap1==0){
            $balok_tahap1con="Tidak ada kerusakan";
        }elseif($formulir->balok_tahap1==1){
            $balok_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
        }elseif($formulir->balok_tahap1==3){
            $balok_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
        }

        if($formulir->atap_tahap1==0){
            $atap_tahap1con="Tidak ada kerusakan";
        }elseif($formulir->atap_tahap1==1){
            $atap_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
        }elseif($formulir->atap_tahap1==3){
            $atap_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
        }

        if($formulir->dinding_tahap1==0){
            $dinding_tahap1con="Tidak ada kerusakan";
        }elseif($formulir->dinding_tahap1==1){
            $dinding_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
        }elseif($formulir->dinding_tahap1==3){
            $dinding_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
        }

        if($formulir->plafond_tahap1==0){
            $plafond_tahap1con="Tidak ada kerusakan";
        }elseif($formulir->plafond_tahap1==1){
            $plafond_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
        }elseif($formulir->plafond_tahap1==3){
            $plafond_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
        }
        return view('formulir.formulirruanga',compact('formulir','tanah','pondasi_tahap1con','pondasi_tahap2con','instalasi_listrik_tahap2con','instalasi_airbersih_tahap2con','kolom_tahap1con','balok_tahap1con','atap_tahap1con','dinding_tahap1con','plafond_tahap1con'));
        }

        public function formulirbangunan1(string $id)
    {
        $formulir1=Formulir::where('bangunans_id',$id)
        ->select('bangunans_id')
        ->selectRaw('SUM(pondasi_tahap1) as pondasi_tahap11,
        COUNT(*) as jumlah_baris,

        SUM(CASE WHEN pondasi_tahap1 LIKE "%1%" THEN 1 ELSE 0 END) as pondasi_tahap111,
        SUM(CASE WHEN pondasi_tahap1 LIKE "%3%" THEN 3 ELSE 0 END) as pondasi_tahap13,

        SUM(CASE WHEN kolom_tahap1 LIKE "%1%" THEN 1 ELSE 0 END) as kolom_tahap111,
        SUM(CASE WHEN kolom_tahap1 LIKE "%3%" THEN 3 ELSE 0 END) as kolom_tahap13,

        SUM(CASE WHEN balok_tahap1 LIKE "%1%" THEN 1 ELSE 0 END) as balok_tahap111,
        SUM(CASE WHEN balok_tahap1 LIKE "%3%" THEN 3 ELSE 0 END) as balok_tahap13,

        SUM(CASE WHEN atap_tahap1 LIKE "%1%" THEN 1 ELSE 0 END) as atap_tahap111,
        SUM(CASE WHEN atap_tahap1 LIKE "%3%" THEN 3 ELSE 0 END) as atap_tahap13,

        SUM(CASE WHEN dinding_tahap1 LIKE "%1%" THEN 1 ELSE 0 END) as dinding_tahap111,
        SUM(CASE WHEN dinding_tahap1 LIKE "%3%" THEN 3 ELSE 0 END) as dinding_tahap13,

        SUM(CASE WHEN plafond_tahap1 LIKE "%1%" THEN 1 ELSE 0 END) as plafond_tahap111,
        SUM(CASE WHEN plafond_tahap1 LIKE "%3%" THEN 3 ELSE 0 END) as plafond_tahap13,

        SUM(kolom_tahap2a) as jml_kolomt2a,
        SUM(kolom_tahap2b) as jml_kolomt2b,
        SUM(kolom_tahap2c) as jml_kolomt2c,
        SUM(kolom_tahap2d) as jml_kolomt2d,
        SUM(kolom_tahap2e) as jml_kolomt2e,
        SUM(kolom_tahap2f) as jml_kolomt2f,
        SUM(kolom_tahap2g) as jml_kolomt2g,

        SUM(balok_tahap2a) as jml_balokt2a,
        SUM(balok_tahap2b) as jml_balokt2b,
        SUM(balok_tahap2c) as jml_balokt2c,
        SUM(balok_tahap2d) as jml_balokt2d,
        SUM(balok_tahap2e) as jml_balokt2e,
        SUM(balok_tahap2f) as jml_balokt2f,
        SUM(balok_tahap2g) as jml_balokt2g,

        SUM(atap_tahap2a) as jml_atapt2a,
        SUM(atap_tahap2b) as jml_atapt2b,
        SUM(atap_tahap2c) as jml_atapt2c,
        SUM(atap_tahap2d) as jml_atapt2d,
        SUM(atap_tahap2e) as jml_atapt2e,
        SUM(atap_tahap2f) as jml_atapt2f,
        SUM(atap_tahap2g) as jml_atapt2g,

        SUM(dinding_tahap2a) as jml_dindingt2a,
        SUM(dinding_tahap2b) as jml_dindingt2b,
        SUM(dinding_tahap2c) as jml_dindingt2c,
        SUM(dinding_tahap2d) as jml_dindingt2d,
        SUM(dinding_tahap2e) as jml_dindingt2e,
        SUM(dinding_tahap2f) as jml_dindingt2f,
        SUM(dinding_tahap2g) as jml_dindingt2g,

        SUM(plafond_tahap2a) as jml_plafondt2a,
        SUM(plafond_tahap2b) as jml_plafondt2b,
        SUM(plafond_tahap2c) as jml_plafondt2c,
        SUM(plafond_tahap2d) as jml_plafondt2d,
        SUM(plafond_tahap2e) as jml_plafondt2e,
        SUM(plafond_tahap2f) as jml_plafondt2f,
        SUM(plafond_tahap2g) as jml_plafondt2g,

        SUM(lantai_tahap2a) as jml_lantait2a,
        SUM(lantai_tahap2b) as jml_lantait2b,
        SUM(lantai_tahap2c) as jml_lantait2c,
        SUM(lantai_tahap2d) as jml_lantait2d,
        SUM(lantai_tahap2e) as jml_lantait2e,
        SUM(lantai_tahap2f) as jml_lantait2f,
        SUM(lantai_tahap2g) as jml_lantait2g,

        SUM(kusen_tahap2a) as jml_kusent2a,
        SUM(kusen_tahap2b) as jml_kusent2b,
        SUM(kusen_tahap2c) as jml_kusent2c,
        SUM(kusen_tahap2d) as jml_kusent2d,
        SUM(kusen_tahap2e) as jml_kusent2e,
        SUM(kusen_tahap2f) as jml_kusent2f,
        SUM(kusen_tahap2g) as jml_kusent2g,

        SUM(pintu_tahap2a) as jml_pintut2a,
        SUM(pintu_tahap2b) as jml_pintut2b,
        SUM(pintu_tahap2c) as jml_pintut2c,
        SUM(pintu_tahap2d) as jml_pintut2d,
        SUM(pintu_tahap2e) as jml_pintut2e,
        SUM(pintu_tahap2f) as jml_pintut2f,
        SUM(pintu_tahap2g) as jml_pintut2g,

        SUM(jendela_tahap2a) as jml_jendelat2a,
        SUM(jendela_tahap2b) as jml_jendelat2b,
        SUM(jendela_tahap2c) as jml_jendelat2c,
        SUM(jendela_tahap2d) as jml_jendelat2d,
        SUM(jendela_tahap2e) as jml_jendelat2e,
        SUM(jendela_tahap2f) as jml_jendelat2f,
        SUM(jendela_tahap2g) as jml_jendelat2g,

        SUM(finishing_plafont_tahap2a) as jml_finishing_plafontt2a,
        SUM(finishing_plafont_tahap2b) as jml_finishing_plafontt2b,
        SUM(finishing_plafont_tahap2c) as jml_finishing_plafontt2c,
        SUM(finishing_plafont_tahap2d) as jml_finishing_plafontt2d,
        SUM(finishing_plafont_tahap2e) as jml_finishing_plafontt2e,
        SUM(finishing_plafont_tahap2f) as jml_finishing_plafontt2f,
        SUM(finishing_plafont_tahap2g) as jml_finishing_plafontt2g,

        SUM(finishing_dinding_tahap2a) as jml_finishing_dindingt2a,
        SUM(finishing_dinding_tahap2b) as jml_finishing_dindingt2b,
        SUM(finishing_dinding_tahap2c) as jml_finishing_dindingt2c,
        SUM(finishing_dinding_tahap2d) as jml_finishing_dindingt2d,
        SUM(finishing_dinding_tahap2e) as jml_finishing_dindingt2e,
        SUM(finishing_dinding_tahap2f) as jml_finishing_dindingt2f,
        SUM(finishing_dinding_tahap2g) as jml_finishing_dindingt2g,

        SUM(finishing_kusen_tahap2a) as jml_finishing_kusent2a,
        SUM(finishing_kusen_tahap2b) as jml_finishing_kusent2b,
        SUM(finishing_kusen_tahap2c) as jml_finishing_kusent2c,
        SUM(finishing_kusen_tahap2d) as jml_finishing_kusent2d,
        SUM(finishing_kusen_tahap2e) as jml_finishing_kusent2e,
        SUM(finishing_kusen_tahap2f) as jml_finishing_kusent2f,
        SUM(finishing_kusen_tahap2g) as jml_finishing_kusent2g,

        SUM(drainaselimbah_tahap2a) as jml_drainaselimbaht2a,
        SUM(drainaselimbah_tahap2b) as jml_drainaselimbaht2b,
        SUM(drainaselimbah_tahap2c) as jml_drainaselimbaht2c,
        SUM(drainaselimbah_tahap2d) as jml_drainaselimbaht2d,
        SUM(drainaselimbah_tahap2e) as jml_drainaselimbaht2e,
        SUM(drainaselimbah_tahap2f) as jml_drainaselimbaht2f,
        SUM(drainaselimbah_tahap2g) as jml_drainaselimbaht2g,

        SUM(pondasi_tahap2) as jml_pondasit2,
        SUM(instalasi_listrik_tahap2) as jml_listrikt2,
        SUM(instalasi_airbersih_tahap2) as jml_airt2,

        SUM(kolom_volume) as jumlah_kolom,
        SUM(balok_volume) as jumlah_balok,
        SUM(kusen_volume) as jumlah_kusen,
        SUM(pintu_volume) as jumlah_pintu,
        SUM(jendela_volume) as jumlah_jendela,
        SUM(drainaselimbah_volume) as jumlah_drainase')

        ->groupBy('bangunans_id')
        ->first();

        $averagep = ($formulir1->jml_pondasit2 / $formulir1->jumlah_baris)/100;
        $averagel = ($formulir1->jml_listrikt2 / $formulir1->jumlah_baris)/100;
        $averagea = ($formulir1->jml_airt2 / $formulir1->jumlah_baris)/100;
        // Hitung persentase rata-rata terhadap total
        $rekappondasit2 = round($averagep * 100);
        $rekaplistrikt2 = round($averagel * 100);
        $rekapairt2 = round($averagea * 100);


        $jumlah_kolom=$formulir1->jumlah_kolom;
        $jumlah_balok=$formulir1->jumlah_balok;
        $jumlah_kusen=$formulir1->jumlah_kusen;
        $jumlah_pintu=$formulir1->jumlah_pintu;
        $jumlah_jendela=$formulir1->jumlah_jendela;
        $jumlah_drainase=$formulir1->jumlah_drainase;

        $rekapatap=$formulir1->jml_atapt2a+$formulir1->jml_atapt2b+$formulir1->jml_atapt2c+$formulir1->jml_atapt2d+$formulir1->jml_atapt2e+$formulir1->jml_atapt2f+$formulir1->jml_atapt2g;
        $rekapdinding=$formulir1->jml_dindingt2a+$formulir1->jml_dindingt2b+$formulir1->jml_dindingt2c+$formulir1->jml_dindingt2d+$formulir1->jml_dindingt2e+$formulir1->jml_dindingt2f+$formulir1->jml_dindingt2g;
        $rekapplafond=$formulir1->jml_plafondt2a+$formulir1->jml_plafondt2b+$formulir1->jml_plafondt2c+$formulir1->jml_plafondt2d+$formulir1->jml_plafondt2e+$formulir1->jml_plafondt2f+$formulir1->jml_plafondt2g;
        $rekaplantai=$formulir1->jml_lantait2a+$formulir1->jml_lantait2b+$formulir1->jml_lantait2c+$formulir1->jml_lantait2d+$formulir1->jml_lantait2e+$formulir1->jml_lantait2f+$formulir1->jml_lantait2g;
        $rekapfinishing_plafon=$formulir1->jml_finishing_plafont2a+$formulir1->jml_finishing_plafont2b+$formulir1->jml_finishing_plafont2c+$formulir1->jml_finishing_plafont2d+$formulir1->jml_finishing_plafont2e+$formulir1->jml_finishing_plafont2f+$formulir1->jml_finishing_plafont2g;
        $rekepfinishing_dinding=$formulir1->jml_finishing_dindingt2a+$formulir1->jml_finishing_dindingt2b+$formulir1->jml_finishing_dindingt2c+$formulir1->jml_finishing_dindingt2d+$formulir1->jml_finishing_dindingt2e+$formulir1->jml_finishing_dindingt2f+$formulir1->jml_finishing_dindingt2g;
        $rekapfinishing_kusen=$formulir1->jml_finishing_kusent2a+$formulir1->jml_finishing_kusent2b+$formulir1->jml_finishing_kusent2c+$formulir1->jml_finishing_kusent2d+$formulir1->jml_finishing_kusent2e+$formulir1->jml_finishing_kusent2f+$formulir1->jml_finishing_kusent2g;



        // dd($rekapatap);

        $formulir=Formulir::where('id',$id)->first();


        if($formulir1->pondasi_tahap111==0 and $formulir1->pondasi_tahap13==0 ){
            $pondasi_tahap111=0;
        }else if($formulir1->pondasi_tahap111==0 && $formulir1->pondasi_tahap13>=3){
            $pondasi_tahap111=3;
        }elseif($formulir1->pondasi_tahap111>=1){
            $pondasi_tahap111=($formulir1->pondasi_tahap111*0)+1;
        }


        if($formulir1->kolom_tahap111==0 and $formulir1->kolom_tahap13==0 ){
            $kolom_tahap111=0;
        }else if($formulir1->kolom_tahap111==0 && $formulir1->kolom_tahap13>=3){
            $kolom_tahap111=3;
        }else if($formulir1->kolom_tahap111>=1){
            $kolom_tahap111=($formulir1->kolom_tahap111*0)+1;
        }

        if($formulir1->balok_tahap111==0 and $formulir1->balok_tahap13==0 ){
            $balok_tahap111=0;
        }else if($formulir1->balok_tahap111==0 && $formulir1->balok_tahap13>=3){
            $balok_tahap111=3;
        }else if($formulir1->balok_tahap111>=1){
            $balok_tahap111=($formulir1->balok_tahap111*0)+1;
        }

        if($formulir1->atap_tahap111==0 and $formulir1->atap_tahap13==0 ){
            $atap_tahap111=0;
        }else if($formulir1->atap_tahap111==0 && $formulir1->atap_tahap13>=3){
            $atap_tahap111=3;
        }else if($formulir1->atap_tahap111>=1){
            $atap_tahap111=($formulir1->atap_tahap111*0)+1;
        }

        if($formulir1->dinding_tahap111==0 and $formulir1->dinding_tahap13==0 ){
            $dinding_tahap111=0;
        }else if($formulir1->dinding_tahap111==0 && $formulir1->dinding_tahap13>=3){
            $dinding_tahap111=3;
        }else if($formulir1->dinding_tahap111>=1){
            $dinding_tahap111=($formulir1->dinding_tahap111*0)+1;
        }

        if($formulir1->plafond_tahap111==0 and $formulir1->plafond_tahap13==0 ){
            $plafond_tahap111=0;
        }else if($formulir1->plafond_tahap111==0 && $formulir1->plafond_tahap13>=3){
            $plafond_tahap111=3;
        }else if($formulir1->plafond_tahap111>=1){
            $plafond_tahap111=($formulir1->plafond_tahap111*0)+1;
        }

        // dd($kolom_tahap111);
        $bangunanid=$formulir->bangunans_id;
        $bangunan=Bangunan::where('id',$bangunanid)->first();
        $tanahid=$bangunan->tanahs_id;
        $tanah=Tanah::where('id',$tanahid)->first();

        $pondasi_tahap1con=0;

        if($pondasi_tahap111==0){
            $pondasi_tahap1con="Tidak ada kerusakan";
            $pondasi_tahap1conb="Cek Kerusakan Komponen Lain";
        }elseif($pondasi_tahap111==1){
            $pondasi_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
            $pondasi_tahap1conb="Rusak Berat";
        }elseif($pondasi_tahap111>=1){
            $pondasi_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
            $pondasi_tahap1conb="Cek Kerusakan Komponen Lain";
        }

        if ($rekappondasit2 >= 0 && $rekappondasit2 < 20) {
            $pondasi_tahap2p = 0;
            $pondasi_tahap2con = "Pondasi diindikasi dalam kondisi baik";
        } elseif ($rekappondasit2 >= 20 && $rekappondasit2 < 35) {
            $pondasi_tahap2p = 20;
            $pondasi_tahap2con = "Penurunan merata pada seluruh struktur bangunan";
        } elseif ($rekappondasit2 >= 35 && $rekappondasit2 < 50) {
            $pondasi_tahap2p = 35;
            $pondasi_tahap2con = "Penurunan tidak merata, namun perbedaan penurunan tidak melebihi 1/250 L";
        } elseif ($rekappondasit2 >= 50 && $rekappondasit2 < 70) {
            $pondasi_tahap2p = 50;
            $pondasi_tahap2con = "Penurunan > 1/250 L sehingga menimbulkan kerusakan struktur atasnya. Tanah disekeliling bangunan naik";
        } elseif ($rekappondasit2 >= 70 && $rekappondasit2 < 85) {
            $pondasi_tahap2p = 70;
            $pondasi_tahap2con = "Bangunan miring secara kasat mata, Lantai dasar naik/menggelembung";
        } elseif ($rekappondasit2 >= 85 && $rekappondasit2 < 100) {
            $pondasi_tahap2p = 85;
            $pondasi_tahap2con = "Pondasi patah, bergeser akibat longsor, struktur atas menjadi rusak";
        } elseif ($rekappondasit2 == 100) {
            $pondasi_tahap2p = 100;
            $pondasi_tahap2con = "Material, dimensi, dan konstruksi pondasi diindikasi tidak sesuai dengan persyaratan teknis (merujuk pada Rencana Teknis apabila ada, Petunjuk Teknis, dan/atau SNI)";
        }

        if($rekaplistrikt2 >=0 && $rekaplistrikt2 < 20){
            $instalasi_listrik_tahap2p=0;
            $instalasi_listrik_tahap2con="Jaringan listrik dalam kondisi baik";
        } elseif ($rekaplistrikt2 >= 20 && $rekaplistrikt2 < 35) {
            $instalasi_listrik_tahap2p = 20;
            $instalasi_listrik_tahap2con = "Sebagian kecil komponen dari panel-panel LP rusak, ada sedikit jalur kabel instalasi shortage, sebagian kecil armature rusak ringan, sehingga biaya perbaikan kurang dari 10% dari biaya instalasi baru";
        } elseif ($rekaplistrikt2 >= 35 && $rekaplistrikt2 < 50) {
            $instalasi_listrik_tahap2p = 35;
            $instalasi_listrik_tahap2con = "Beberapa komponen dari panel-panel LP rusak, sebagian kecil jalur kabel instalasi shortage, sehingga armature rusak ringan, sehingga biaya perbaikan 10-25% dari biaya instalasi baru";
        } elseif ($rekaplistrikt2 >= 50 && $rekaplistrikt2 < 70) {
            $instalasi_listrik_tahap2p = 50;
            $instalasi_listrik_tahap2con = "Beberapa komponen dari panel-panel LP rusak, sebagian kecil jalur kabel instalasi shortage, sehingga armature rusak berat dan ringan, sehingga biaya perbaikan 25-50% dari biaya instalasi baru";
        } elseif ($rekaplistrikt2 >= 70 && $rekaplistrikt2 < 85) {
            $instalasi_listrik_tahap2p = 70;
            $instalasi_listrik_tahap2con = "Sebagian besar komponen panel-panel LP rusak, sebagian besar kabel instalasi shortage, sebagian besar armature rusak, sehingga biaya perbaikan 50-65 % dari instalasi baru";
        } elseif ($rekaplistrikt2 >= 85 && $rekaplistrikt2 <= 100) {
            $instalasi_listrik_tahap2p = 85;
            $instalasi_listrik_tahap2con = "Sebagian besar komponen panel-panel LP rusak, sebagian besar kabel instalasi shortage, seluruh armature rusak berat, sehingga biaya perbaikan lebih dari 65 % dari instalasi baru";
        }elseif($rekaplistrikt2==100){
            $instalasi_listrik_tahap2p=100;
            $instalasi_listrik_tahap2con="Material, dimensi, dan konstruksi jaringan listrik diindikasi tidak sesuai dengan persyaratan teknis (merujuk pada Rencana Teknis apabila ada, Petunjuk Teknis, dan/atau SNI)";
        }

        if($rekapairt2 >=0 && $rekapairt2 < 20){
            $instalasi_airbersih_tahap2p=0;
            $instalasi_airbersih_tahap2con="Sistem penyediaan air dalam kondisi baik";
        } elseif ($rekapairt2 >= 20 && $rekapairt2 < 35) {
            $instalasi_airbersih_tahap2p = 20;
            $instalasi_airbersih_tahap2con = "Kebocoran pipa terbatas ditempat yang terlihat atau mudah dicapai, keran-keran kecil rusak, sehingga biaya perbaikan kurang dari 10% biaya instalasi baru";
        } elseif ($rekapairt2 >= 35 && $rekapairt2 < 50) {
            $instalasi_airbersih_tahap2p = 35;
            $instalasi_airbersih_tahap2con = "Bagian-bagian kecil pemipaan bocor, motor pompa terbakar, keran-keran kecil rusak, sehingga biaya perbaikan antara 10-25% dari biaya instalasi baru";
        } elseif ($rekapairt2 >= 50 && $rekapairt2 < 70) {
            $instalasi_airbersih_tahap2p = 50;
            $instalasi_airbersih_tahap2con = "Pompa, motor, pipa, dan keran rusak apabila diganti atau diperbaiki memerlukan biaya antara 25-50% dari biaya instalasi baru";
        } elseif ($rekapairt2 >= 70 && $rekapairt2 < 85) {
            $instalasi_airbersih_tahap2p = 70;
            $instalasi_airbersih_tahap2con = "Sebagian besar pompa, sebagian besar motor terbakar, pipa utama bocor namun ditempat terbuka, beberapa keran tidak berfungsi, sehingga biaya perbaikan 50-65% dari biaya instalasi baru";
        } elseif ($rekapairt2 >= 85 && $rekapairt2 < 100) {
            $instalasi_airbersih_tahap2p = 85;
            $instalasi_airbersih_tahap2con = "Pompa –pompa rusak total, motor terbakar, di banyak tempat terbuka dan tutup pipa-pipa bocor keran-keran tidak berfungsi, sehingga perbaikan instalasi perlu menyeluruh, dengan perkiraan biaya lebih dari 65% dari biaya instalasi baru";
        } elseif ($rekapairt2 == 100) {
            $instalasi_airbersih_tahap2p = 100;
            $instalasi_airbersih_tahap2con = "Material, dimensi, dan konstruksi sistem penyediaan air diindikasi tidak sesuai dengan persyaratan teknis (merujuk pada Rencana Teknis apabila ada, Petunjuk Teknis, dan/atau SNI)";
        }

        if($kolom_tahap111==0){
            $kolom_tahap1con="Tidak ada kerusakan";
        }elseif($kolom_tahap111==1){
            $kolom_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
        }elseif($kolom_tahap111>=1){
            $kolom_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
        }

        if($balok_tahap111==0){
            $balok_tahap1con="Tidak ada kerusakan";
        }elseif($balok_tahap111==1){
            $balok_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
        }elseif($balok_tahap111>=1){
            $balok_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
        }

        if($atap_tahap111==0){
            $atap_tahap1con="Tidak ada kerusakan";
        }elseif($atap_tahap111==1){
            $atap_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
        }elseif($atap_tahap111>=1){
            $atap_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
        }

        if($dinding_tahap111==0){
            $dinding_tahap1con="Tidak ada kerusakan";
        }elseif($dinding_tahap111==1){
            $dinding_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
        }elseif($dinding_tahap111>=1){
            $dinding_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
        }

        if($plafond_tahap111==0){
            $plafond_tahap1con="Tidak ada kerusakan";
        }elseif($plafond_tahap111==1){
            $plafond_tahap1con="Ada kerusakan yang diindikasi membahayakan keselamatan pemanfaatan ruang/bangunan";
        }elseif($plafond_tahap111>=1){
            $plafond_tahap1con="Ada kerusakan, namun diindikasi tidak membahayakan keselamatan pemanfaatan ruang/bangunan";
        }
        //  dd($rekapairt2);
        return view('formulir.formulirbangunan1',compact('formulir', 'formulir1', 'tanah', 'pondasi_tahap1con','pondasi_tahap2p', 'pondasi_tahap2con',
        'instalasi_listrik_tahap2p','instalasi_listrik_tahap2con','instalasi_airbersih_tahap2p', 'instalasi_airbersih_tahap2con', 'kolom_tahap1con',
        'balok_tahap1con', 'atap_tahap1con', 'dinding_tahap1con', 'plafond_tahap1con', 'jumlah_kolom','jumlah_balok','jumlah_kusen','jumlah_pintu','jumlah_jendela','jumlah_drainase',
                      'pondasi_tahap111','kolom_tahap111','balok_tahap111','atap_tahap111','dinding_tahap111','plafond_tahap111','rekapatap','rekapdinding','rekapplafond','rekaplantai','rekapfinishing_plafon','rekepfinishing_dinding','rekapfinishing_kusen'));
        }
}
