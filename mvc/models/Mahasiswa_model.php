<?php

class Mahasiswa_model {
    private $mhs = [
        [
            "nama" => "Faldi Arsan",
            "nrp" => "203040007",
            "email" => "faldi@gmail.com",
            "jurusan" => "Teknik Informatika"
        ]
    ];

    public function getAllMahasiswa()
    {
        return $this->mhs;
    }
}