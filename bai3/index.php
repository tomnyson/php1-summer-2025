<?php

class SinhVien
{
    // thuoc tinh
    public $mssv;
    public $ten;
    public $nganh;
    public $diem;

    function __construct($mssv, $ten, $nganh,  $diem)
    {
        $this->mssv = $mssv;
        $this->ten = $ten;
        $this->nganh = $nganh;
        $this->diem = $diem;
    }

    function xuatThongTin()
    {
        echo "mssv: $this->mssv <br/>";
        echo "tên: $this->ten <br/>";
        echo "ngành: $this->nganh <br/>";
        echo "điểm: $this->diem <br/>";
    }

    function get_diem()
    {
        return $this->diem;
    }

    function set_diem($diem)
    {
        $this->diem = $diem;
        if ($diem >= 0 && $diem <= 10) {
            $this->diem = $diem;
        } else {
            echo "diem khong hop le";
        }
    }
}


$svThanh = new SinhVien("PS46198", "Thành", "TKW", 8);
$svThanh->xuatThongTin();
$svThanh->set_diem(7.5);
$svThanh->xuatThongTin();
