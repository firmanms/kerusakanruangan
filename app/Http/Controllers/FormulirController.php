<?php

namespace App\Http\Controllers;

use App\Models\Bangunan;
use App\Models\Formulir;
use Illuminate\Http\Request;

class FormulirController extends Controller
{
    public function formulirruanga(string $id)
    {
        $formulir=Formulir::where('id',1)->first();
        // $bangunan=Bangunan::where('id',)->first();

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
        return view('formulir.formulirruanga',compact('formulir','pondasi_tahap1con','pondasi_tahap2con','instalasi_listrik_tahap2con','instalasi_airbersih_tahap2con','kolom_tahap1con','balok_tahap1con','atap_tahap1con','dinding_tahap1con','plafond_tahap1con'));
        }
}
