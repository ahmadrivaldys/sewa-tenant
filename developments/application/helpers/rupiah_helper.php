<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function rupiah($angka)
{
    $hasil = 'Rp. ' . number_format($angka, 0, ",", ".");
    return $hasil;
}