<?php
  ini_set('display_errors', '1');
  ini_set('display_startup_errors', '1');
  error_reporting(E_ALL);
class SinhVien
{
    // thuoc tinh
    public $mssv;
    public $ten;
    public $nganh;
    protected $diem;

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

    public static function  message() {
        echo "khởi tạo class";
    }
}

class SinhVienTKW extends SinhVien {
    private $phpCoBan;
    public $php1;
    public $php2;
    public $php3;
    
    function __construct($mssv, $ten, $nganh,  $diem,$phpCoBan,$php1, $php2, $php3) {
        parent::__construct($mssv, $ten, $nganh,  $diem);
        $this->phpCoBan = $phpCoBan;
        $this->php1= $php1;
        $this->php2 = $php2;
        $this->php3 = $php3;
    }
    public function xuatThongTin() {
        parent::xuatThongTin();
        echo "phpCoBan: $this->phpCoBan <br/>";
        echo "php1: $this->php1 <br/>";
        echo "php2: $this->php2 <br/>";
        echo "php3: $this->php3 <br/>";
    }
    public function get_phpCoBan() {
        return $this->phpCoBan;
    }
    public function set_phpCoBan($phpCoBan) {
        $this-> phpCoBan = $phpCoBan;
    }

    public function XuatDiem() {
        echo "Điểm: $this->diem ";
    }
}


class SinhVienPTPM extends SinhVien {
    public $cSharpCoBan;
    public $cSharp1;
    public $cSharp2;
    public $cSharp3;

    function __construct($mssv, $ten, $nganh,  $diem,$cSharpCoBan,$cSharp1, $cSharp2, $cSharp3) {
        parent::__construct($mssv, $ten, $nganh,  $diem);
        $this->cSharpCoBan = $cSharpCoBan;
        $this->cSharp1= $cSharp1;
        $this->cSharp2 = $cSharp2;
        $this->cSharp3 = $cSharp3;
    }
    public function xuatThongTin() {
        parent::xuatThongTin();
        echo "cSharpCoBan: $this->cSharpCoBan <br/>";
        echo "cSharp1: $this->cSharp1 <br/>";
        echo "cSharp2: $this->cSharp2 <br/>";
        echo "cSharp3: $this->cSharp3 <br/>";
    }
}   



// $svThanh = new SinhVien("PS46198", "Thành", "TKW", 8);
// $svThanh->xuatThongTin();
// $svThanh->set_diem(7.5);
// $svThanh->xuatThongTin();
# sinh vien nganh tkw

$svTKW = new SinhVienTKW("PS46198", "Thành", "TKW",8,7.5,8,9,8);
$svTKW->xuatThongTin();
// cap nhat bien diem php co ban
$svTKW->set_phpCoBan(9);
echo "-----------------<br/>";
$svTKW->xuatThongTin();
echo "-----------------<br/>";
# sinh vien nganh PTPM
$svPTPM = new SinhVienPTPM("PS46178", "Tú", "PTPM",8,7.5,8,7,8.5);
$svPTPM->xuatThongTin();
echo "-----------------<br/>";
$svThanh = new SinhVien("PS46198", "Thành", "TKW", 8);
// $svThanh->diem = 5;
$svTKW->XuatDiem();
// $svThanh->xuatThongTin();
// $svThanh->set_diem(7.5);
// $svThanh->xuatThongTin();

SinhVien::message();