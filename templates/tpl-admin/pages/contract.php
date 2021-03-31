<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    SURAT PERJANJIAN SEWA TENANT

    Saya yang bertanda tangan di bawah ini
    Nama			:
    Nama Perusahaan	:
    Alamat			:
    No. Telepon		:
    Selanjutnya disebut pihak I (Pertama)

    Nama			:
    Nama Perusahaan	:
    Alamat Perusahaan	:
    Jenis Usaha		:
    No. Telepon		:
    Selanjutnya disebut pihak II (Kedua)
    Kedua pihak membuat perjanjian sebagai berikut :

    Pihak I (Pertama) menyewakan Tenant yang ada di pusat perbelanjaan Gandaria City Mall kepada Pihak II (Kedua) dengan masa sewa seperti yang sudah dipesan oleh Pihak II (Kedua) dengan harga yang sudah disepakati bersama sesuai dengan spesifikasi Tenant dan lama masa sewa.
    Memang benar Pihak II (Kedua) telah menyewa Tenant dari pihak I (Pertama) yang sesuai dengan poin no. 1 di atas.
    Pihak II (Kedua) bebas melakukan modifikasi pada Tenant yang telah disewa sesuai dengan jenis usaha selama hal tersebut tidak melanggar batas wilayah Tenant yang disewakan.

    Demikian Surat Perjanjian ini kami buat tanpa ada unsur paksaan dari pihak manapun. Dan apabila ada perjanjian waktu dan lain-lain akan dimusyawarahkan kemudian.

    Kami yang membuat Perjanjian
    Pihak II (Kedua)						Pihak 1 (Pertama)


        Pihak Penyewa						PT. Artisan Wahyu
    <form name="doc_test" action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="submit" name="submit_doc" value="Ekspor ke MS WORD">
    </form>

    <?php
		if(isset($_POST['submit_doc'])) {
			header("Content-Type: application/vnd.msword");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("content-disposition: attachment;filename=hasilekspor.doc");
		}
	?>
</body>
</html>