

<script language="javascript">
function validasi(form){
  if (form.nama.value == ""){
    alert("Anda belum mengisikan Nama.");
    form.nama.focus();
    return (false);
  }    
  if (form.alamat.value == ""){
    alert("Anda belum mengisikan Alamat.");
    form.alamat.focus();
    return (false);
  }
  if (form.telpon.value == ""){
    alert("Anda belum mengisikan Telpon.");
    form.telpon.focus();
    return (false);
  }
  if (form.email.value == ""){
    alert("Anda belum mengisikan Email.");
    form.email.focus();
    return (false);
  }
  if (form.jasa.value == 0){
    alert("Anda belum memilih jasa pengiriman barang.");
    form.jasa.focus();
    return (false);
  }
  if (form.kota.value == 0){
    alert("Anda belum mengisikan Kota.");
    form.kota.focus();
    return (false);
  }
  return (true);
}


function harusangka(jumlah){
  var karakter = (jumlah.which) ? jumlah.which : event.keyCode
  if (karakter > 31 && (karakter < 48 || karakter > 57))
    return false;

  return true;
}


$(document).ready(function() {
  $('#jasa').change(function() { 
    var category = $(this).val();
    $.ajax({
      type: 'GET',
      url: 'config/kota.php',
      data: 'perusahaan=' + category, // Untuk data di MySQL dengan menggunakan kata kunci tsb
      dataType: 'html',
      beforeSend: function() {
        $('#kota').html('<tr><td colspan=2>Loading ....</td></tr>'); 
      },
      success: function(response) {
        $('#kota').html(response);
      }
    });
    });
});

</script>

<?php
// Halaman utama (Home)
if ($_GET[module]=='toko'){

     echo " 
            </div><div class='profil2'></div>
          </div> "; 

  echo "<h4 class='heading colr2'></h4><br />";
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT 12");
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<center> <a class='tombol' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='font'><span class=''> <br /></span>&nbsp;<span class=''> Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
    $hargadiskon="<div class='prod_price'><span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>&nbsp;<span class='price3'>Diskon $r[diskon]% 
   <br /><span class='price2'>Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      }else{
      $divharga=$hargatetap;
      } 

    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'> 

             <div class=''><a class='tombol3' href='produk-$r[id_produk]-$r[produk_seo].php'>$r[nama_produk]</a></div>
             <div class='product_img'>
                             <a href='produk-$r[id_produk]-$r[produk_seo].php'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'>
               <img src='foto_produk/$r[gambar]' border='0' height=110 width=114  class='tooltip' title='klik untuk memperbesar gambar'></a>
             </div>
             $divharga
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
            <a href='produk-$r[id_produk]-$r[produk_seo].php' class='tombol1'>DETAIL</a> 
          </div>
          </div>";
  }
}


// Modul detail produk
elseif ($_GET[module]=='detailproduk'){

  $detail=mysql_query("SELECT * FROM produk,kategori    
                      WHERE kategori.id_kategori=produk.id_kategori 
                      AND id_produk='$_GET[id]'");
  $d   = mysql_fetch_array($detail);
  $tgl = tgl_indo($d[tanggal]);


    $harga = format_rupiah($d[harga]);
    $disc     = ($d[diskon]/100)*$d[harga];
    $hargadisc     = number_format(($d[harga]-$disc),0,",",".");


  echo "<h4 class='heading colr'>kategori : <a class='tombol3' href='kategori-$d[id_kategori]-$d[kategori_seo].php'>$d[nama_kategori]</a></h4></div>";

  echo"<div class='feat_prod_box_details'>";
  
              echo"
        <div class='product_img'>
                             <a href='produk-$d[id_produk]-$d[produk_seo].php'><a href='foto_produk/$d[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$d[nama_produk]'>
               <img src='foto_produk/$d[gambar]' border='0' height=110 width=114  class='tooltip' title='klik untuk memperbesar gambar'></a></a>
             </div>
        
        <div class='details_big_box'>
            <b><div class='font'>$d[nama_produk]</b></div><br>
            <div class=''>$d[deskripsi]</div><br />
                   <b> <div class='font'>&bull; HARGA: </b><span class='table7'>Rp. $hargadisc,-</span></div>
              
                    <b><div class='font'>&bull; STOK: </b><span class='table7'> $d[stok] item</span></div>
                    <a href='aksi.php?module=keranjang&act=tambah&id=$d[id_produk]' class='tombol'>Beli</a>
                    <div class='clear'></div>
                    </div>
                    
                    <div class='box_bottom'></div>
                </div> <div class='clear'></div>
            </div><br /> ";

          
// Produk Lainnya (random)          
  $sql=mysql_query("SELECT * FROM produk ORDER BY rand() LIMIT 4");
      
  echo "<h4 class='heading colr'>Produk Lainnya</h4></div>";
      
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='tombol' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='font'><span class='font'> <br /></span>&nbsp;<span class='font'> Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
    $hargadiskon="<div class='prod_price'><span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>&nbsp;<span class='price3'>Diskon $r[diskon]% 
   <br /><span class='price2'>Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      }else{
      $divharga=$hargatetap;
      } 

    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class=''><a class='tombol3' href='produk-$r[id_produk]-$r[produk_seo].php'>$r[nama_produk]</a></div>
             <div class='product_img'>
               <a href='produk-$r[id_produk]-$r[produk_seo].php'><a href='produk-$r[id_produk]-$r[produk_seo].php'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'>
               <img src='foto_produk/$r[gambar]' border='0' height=110 width=114  class='tooltip' title='klik untuk memperbesar gambar'></a>
             </div>
             $divharga
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].php' class='tombol1'>DETAIL</a>            
          </div> 
          </div>";
  }
}

// Modul produk per kategori
elseif ($_GET[module]=='detailkategori'){
  // Tampilkan nama kategori
  $sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
  $n = mysql_fetch_array($sq);

  echo "<h4 class='heading colr'>$n[nama_kategori]</h4></div>";

  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new Paging3;
  $batas  = 12;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan daftar produk yang sesuai dengan kategori yang dipilih
  $sql = mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]' 
            ORDER BY id_produk DESC LIMIT $posisi,$batas");    
  $jumlah = mysql_num_rows($sql);

  // Apabila ditemukan produk dalam kategori
  if ($jumlah > 0){
  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='tombol' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 

    $d=$r['diskon'];
    $hargatetap="<div class='font'><span class='font'> <br /></span>&nbsp;<span class='font'> Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
    $hargadiskon="<div class='prod_price'><span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>&nbsp;<span class='price3'>Diskon $r[diskon]% 
   <br /><span class='price2'>Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      }else{
      $divharga=$hargatetap;
      } 

    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class=''><a class='tombol3' href='produk-$r[id_produk]-$r[produk_seo].php'>$r[nama_produk]</a></div>
             <div class='product_img'>
               <a href='produk-$r[id_produk]-$r[produk_seo].php'><a href='produk-$r[id_produk]-$r[produk_seo].php'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'>
               <img src='foto_produk/$r[gambar]' border='0' height=110 width=114  class='tooltip' title='klik untuk memperbesar gambar'></a>
             </div>
             $divharga
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].php' class='tombol1'>DETAIL</a>            
          </div> 
          </div>";
  }



  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk WHERE id_kategori='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halkategori], $jmlhalaman);

  echo "<div class=halaman>Halaman : $linkHalaman </div><br>";
  }
  else{
    echo "<p align=left><span class='table7'>Belum ada produk pada kategori ini.</p>";
  }
}

// Menu utama di header









// Modul semua produk
elseif ($_GET[module]=='semuaproduk'){
  echo "<h4 class='heading colr'>Semua Produk</h4>";

  // Tentukan berapa data yang akan ditampilkan per halaman (paging)
  $p      = new Paging2;
  $batas  = 16;
  $posisi = $p->cariPosisi($batas);

  // Tampilkan semua produk
  $sql=mysql_query("SELECT * FROM produk ORDER BY id_produk DESC LIMIT $posisi,$batas");

  while ($r=mysql_fetch_array($sql)){
    $harga = format_rupiah($r[harga]);
    $disc     = ($r[diskon]/100)*$r[harga];
    $hargadisc     = number_format(($r[harga]-$disc),0,",",".");
    $stok=$r['stok'];
    $tombolbeli="<a class='tombol' href=\"aksi.php?module=keranjang&act=tambah&id=$r[id_produk]\">BELI</a>";
    $tombolhabis="<span class='prod_cart_habis'></span>";
      if ($stok!= "0"){
      $tombol=$tombolbeli;
      }else{
      $tombol=$tombolhabis;
      } 
      

    $d=$r['diskon'];
    $hargatetap="<div class='prod_price'><span class='price'> <br /></span>&nbsp;<span class='price'> Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
    $hargadiskon="<div class='prod_price'><span style='text-decoration:line-through;' class='price'>Rp. $harga,- <br /></span>&nbsp;<span class='price3'>Diskon $r[diskon]% 
   <br /><span class='price2'>Rp. <b>$hargadisc,-</b></span></div>                        
          </div>";
      if ($d!= "0"){
      $divharga=$hargadiskon;
      }else{
      $divharga=$hargatetap;
      } 

    echo "<div class='prod_box'>
          <div class='top_prod_box'></div> 
          <div class='center_prod_box'>            
             <div class='product_title'><a href='produk-$r[id_produk]-$r[produk_seo].php'>$r[nama_produk]</a></div>
             <div class='product_img'>
               <a href='produk-$r[id_produk]-$r[produk_seo].php'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'>
               <img src='foto_produk/$r[gambar]' border='0' height=110 width=114  class='tooltip' title='klik untuk memperbesar gambar'></a>
             </div>
             $divharga
          <div class='bottom_prod_box'></div>
          <div class='prod_details_tab'>
             $tombol            
             <a href='produk-$r[id_produk]-$r[produk_seo].php' class='tombol1'>DETAIL</a>            
          </div> 
          </div>";

  }  
    
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM produk"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halproduk], $jmlhalaman);

  echo "<div class='halaman'>Halaman : $linkHalaman </div>";
}

// Modul keranjang belanja
elseif ($_GET[module]=='keranjangbelanja'){
  // Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
  $sid = session_id();
  $sql = mysql_query("SELECT * FROM orders_temp, produk 
                      WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
    echo "<script>window.alert('Keranjang Belanjanya masih kosong. Silahkan Anda berbelanja terlebih dahulu');
        window.location=('index.php')</script>";
    }
  else{  
  
    echo "<h4 class='heading colr'>Keranjang Belanja</h4>
          <form method=post action=aksi.php?module=keranjang&act=update>
      
       
  
      
          <table class='tb_customer' align=center>
          <tbody>
         <tr >
         <th>No</th>
         <th>Produk</th>
         <th>Nama Produk</th>
         <th>Berat(Kg)</th>
         <th>Qty</th>
          <th>Harga</th>
          <th>Sub Total</th>
          <th>Aksi</th>
          <td></td>
          </tr>";  
  
  $no=1;
  while($r=mysql_fetch_array($sql)){
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",",".");
    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r[harga]);
   
    
       echo "<tr   align=center>
       <td>$no</td>
       <input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td align=center><a href='produk-$r[id_produk]-$r[produk_seo].php'><a href='foto_produk/$r[gambar]' rel='clearbox[gallery=Koleksi Produk]' title='$r[nama_produk]'><img width=80 class='imgcart' src=foto_produk/$r[gambar]  class='tooltip' title='klik untuk memperbesar gambar'></td>
              <td>$r[nama_produk]</td>
              <td align=center>$r[berat]</td>
              <td><input type=text name='jml[$no]' value=$r[jumlah] size=1 onchange=\"this.form.submit()\" onkeypress=\"return harusangka(event)\"></td>
              <td>$hargadisc</td>
              <td>$subtotal_rp</td>
              <td class='tombol2' align=center><a href='aksi.php?module=keranjang&act=hapus&id=$r[id_orders_temp]'>Hapus</a></td>
              <td></td>
          </tr>";
    $no++; 
  } 
  echo "<tr>
  <td colspan=6 align=right><br>Total:</td>
  <td colspan=2><br>Rp. $total_rp,-</b></td>
  <td></td>
  </tr>
        <tr>
        <td colspan=8><br /><input style='width: 130px; height: 22px;' type=submit  class= tombol value='UPDATE KERANJANG'><br /></td>
        <td></td>
       </tr>
        </tbody>
  </table>";
echo "<br /><br /><br /><br /><p>*   Apabila Anda mengubah jumlah (Qty), jangan lupa tekan tombol <b>Update Keranjang</b><br />
               **  Total harga di atas belum termasuk ongkos kirim yang akan dihitung saat <b>Selesai Belanja</b></p><br />
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big'></div>
           <div class='bottom_prod_box_big3'></div>
          </div>";             

}
}    





// Modul selesai belanja
if ($_GET['module']=='selesaibelanja'){
  $sid = session_id();
  $sql = mysql_query("SELECT * FROM orders_temp, produk 
                      WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk");
  $ketemu=mysql_num_rows($sql);
  if($ketemu < 1){
   echo "<script> alert('Keranjang belanja masih kosong');window.location='index.php'</script>\n";
     exit(0);
  }
  else{


  echo "<h4 class='heading colr'>Data Pembeli</h4>
      <form name=form action=simpan-transaksi.php method=POST onSubmit=\"return validasi(this)\">
      <table width=650>
      <tr><td><span class='table4'>Nama</td><td>  <input type=text name=nama size=30 class='table5'></td></tr>
      <tr><td><span class='table4'>Alamat Lengkap</td><td>  <input type=text name=alamat size=70 class='table5'></td></tr>
      <tr><td><span class='table4'>Telpon/HP</td><td>  <input type=text name=telpon class='table5'></td></tr>
      <tr><td><span class='table4'>Email</td><td>  <input type=text name=email class='table5'></td></tr>
      <tr><td valign=top><span class='table4'>Jasa Pengiriman</td><td>  
          <select name='jasa' id='jasa' class='table5'>
          <option value='0' selected>- Pilih Jenis Jasa Pengiriman -</option>";
          $tampil=mysql_query("SELECT * FROM shop_pengiriman ORDER BY nama_perusahaan");
          while($r=mysql_fetch_array($tampil)){
             echo "<option value='$r[id_perusahaan]'>$r[nama_perusahaan]</option>";
          }
      echo "</select></td></tr>
      <tr><td><span class='table4'>Kota Tujuan</td><td> <span id='kota'><select name='kota' id='kota' class='table5'><option value='0' selected>Tentukan Jenis Jasa Pengiriman Dahulu</option></select></span></td></tr>
      <tr><td colspan=2><input style='width: 60px; height: 25px;' type=submit class= tombol value=PROSES></td></tr>
      </table>";
      
     echo "<h4 class='heading colr'>Konfirmasi Keranjang Belanja Anda</h4>
          <table width=670 border=0 cellpadding=0 cellspacing=1 align=center class='tb_customer'>
          <tbody>
          <tr align=center height=23><th><span class='table'>No</th><th><span class='font'>Nama Produk</th><th><span class='font'>Berat(Kg)</th><th><span class='font'>Qty</th>
          <th><span class='font'>Harga</th><th><span class='font'>Sub Total</th></tr>";  
  
  $no=1;
  while($r=mysql_fetch_array($sql)){
  //START nampilkan diskon per produk --    
    $disc        = ($r[diskon]/100)*$r[harga];
    $hargadisc   = number_format(($r[harga]-$disc),0,",","."); 
    $subtotal    = ($r[harga]-$disc) * $r[jumlah];
//END nampilkan diskon per produk --
    $total       = $total + $subtotal;  
    $subtotal_rp = format_rupiah($subtotal);
    $total_rp    = format_rupiah($total);
    $harga       = format_rupiah($r['harga']);
    $subtotalberat = $r['berat'] * $r['jumlah']; // total berat per item produk 
    $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli    
    echo "<tr align=center height=23>
    <td>$no</td>
    <input type=hidden name=id[$no] value=$r[id_orders_temp]>
              <td>$r[nama_produk]</td>
              <td align=center>$r[berat]</td>
              <td align=center>$r[jumlah]</td>
              <td>$harga</td>
              <td>$subtotal_rp</td>
          </tr>";
    $no++; 
  }
  echo "<tr>
  <td colspan=2 align=right><span class='table3'>Total Berat:</td><td align=center><span class='table3'>$totalberat kg</b></td>
            <td align=right colspan=2><span class='table3'>Total Harga:</td><td align=center><span class='table3'>Rp. $total_rp,-</td></tr>
        </tbody></table></div></div></div>
        <div class='bottom_prod_box_big'></div>
        </div>";
    echo "<div class='prod_box_big'>
          <div class='top_prod_box_big'></div>
          <div class='center_prod_box_big'>            
          <div class='details_big_cari'><div><table>
          <tr>
          <td><input style='width: 70px; height: 22px;'  class= tombol2 type=button value='KEMBALI' onclick=self.history.back()>
          <span style='float : right;'><input style='width: 110px; height: 22px;' type=submit  class= tombol value='PROSES ORDER'></span>
          </td>
          </tr>
          </table>
          </div></div></div>
        <div class='bottom_prod_box_bigx'></div>
        </div>";        
                 
                               
  }
}      


// Modul simpan transaksi
elseif ($_GET[module]=='simpantransaksi'){
$kar1=strstr($_POST[email], "@");
$kar2=strstr($_POST[email], ".");

if (empty($_POST[nama]) || empty($_POST[alamat]) || empty($_POST[telpon]) || empty($_POST[email]) || empty($_POST[kota])){
  echo "Data yang Anda isikan belum lengkap<br />
        <a href='selesai-belanja.php'><b>Ulangi Lagi</b>";
}
elseif (!ereg("[a-z|A-Z]","$_POST[nama]")){
  echo "Nama tidak boleh diisi dengan angka atau simbol.<br />
        <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
elseif (strlen($kar1)==0 OR strlen($kar2)==0){
  echo "Alamat email Anda tidak valid, mungkin kurang tanda titik (.) atau tanda @.<br />
        <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
}
else{
// fungsi untuk mendapatkan isi keranjang belanja
function isi_keranjang(){
  $isikeranjang = array();
  $sid = session_id();
  $sql = mysql_query("SELECT * FROM orders_temp WHERE id_session='$sid'");
  
  while ($r=mysql_fetch_array($sql)) {
    $isikeranjang[] = $r;
  }
  return $isikeranjang;
}

$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

// simpan data pemesanan 
mysql_query("INSERT INTO orders(nama_kustomer, alamat, telpon, email, tgl_order, jam_order, id_kota) 
             VALUES('$_POST[nama]','$_POST[alamat]','$_POST[telpon]','$_POST[email]','$tgl_skrg','$jam_skrg','$_POST[kota]')");
  
// mendapatkan nomor orders
$id_orders=mysql_insert_id();

// panggil fungsi isi_keranjang dan hitung jumlah produk yang dipesan
$isikeranjang = isi_keranjang();
$jml          = count($isikeranjang);

// simpan data detail pemesanan  
for ($i = 0; $i < $jml; $i++){
  mysql_query("INSERT INTO orders_detail(id_orders, id_produk, jumlah) 
               VALUES('$id_orders',{$isikeranjang[$i]['id_produk']}, {$isikeranjang[$i]['jumlah']})");
}
  
// setelah data pemesanan tersimpan, hapus data pemesanan di tabel pemesanan sementara (orders_temp)
for ($i = 0; $i < $jml; $i++) {
  mysql_query("DELETE FROM orders_temp
               WHERE id_orders_temp = {$isikeranjang[$i]['id_orders_temp']}");
}

  echo "<h4 class='heading colr'>Proses Transaksi Selesai</h4>";

        echo "<div class='prod_box_big'>
          <div class='top_prod_box_big'></div>
        <div class='center_prod_box_big'>            
          <div class='details_big_cari'>
              <div>
      Data pemesan beserta ordernya adalah sebagai berikut: <br />
      <table>
      <tr><td>Nama           </td><td> : <b>$_POST[nama]</b> </td></tr>
      <tr><td>Alamat Lengkap </td><td> : $_POST[alamat] </td></tr>
      <tr><td>Telpon         </td><td> : $_POST[telpon] </td></tr>
      <tr><td>E-mail         </td><td> : $_POST[email] </td></tr></table><br />
      
      Nomor Order: <b> <span class='font'>$id_orders</b><br /><br />";

      $daftarproduk=mysql_query("SELECT * FROM orders_detail,produk 
                                 WHERE orders_detail.id_produk=produk.id_produk 
                                 AND id_orders='$id_orders'");

echo "<table width=600 border=0 cellpadding=0 cellspacing=1 align=center class='tb_customer'>
        <tr  align=center height=23><th><span class='font'>No</th><th><span class='font'>Nama Produk</th><th><span class='font'>Berat(Kg)</th><th><span class='font'>Qty</th><th><span class='font'>Harga</th><th><span class='font'>Sub Total</th></tr>";
      
$pesan="Terimakasih telah melakukan pemesanan online di toko kami<br /><br />  
        Nama: $_POST[nama] <br />
        Alamat: $_POST[alamat] <br/>
        Telpon: $_POST[telpon] <br /><hr />
        
        Nomor Order: $id_orders <br />
        Data order Anda adalah sebagai berikut: <br /><br />";
        
$no=1;
while ($d=mysql_fetch_array($daftarproduk)){
   $subtotalberat = $d[berat] * $d[jumlah]; // total berat per item produk 
   $totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli

  
    $disc        = ($d[diskon]/100)*$d[harga];
    $hargadisc   = number_format(($d[harga]-$disc),0,",","."); 
    $subtotal    = ($d[harga]-$disc) * $d[jumlah];

   $total       = $total + $subtotal;
   $subtotal_rp = format_rupiah($subtotal);    
   $total_rp    = format_rupiah($total);    
   $harga       = format_rupiah($d['harga']);

   echo "<tr align=center height=23><td>$no</td><td>$d[nama_produk]</td><td align=center>$d[berat]</td><td align=center>$d[jumlah]</td><td>Rp. $harga,-</td><td>Rp. $subtotal_rp,-</td></tr>";

   $pesan.="$d[jumlah] $d[nama_produk] -> Rp. $harga -> Subtotal: Rp. $subtotal_rp <br />";
   $no++;
}

$ongkos=mysql_fetch_array(mysql_query("SELECT ongkos_kirim FROM kota WHERE id_kota='$_POST[kota]'"));
$ongkoskirim1=$ongkos[ongkos_kirim];
$ongkoskirim = $ongkoskirim1 * $totalberat;

$grandtotal    = $total + $ongkoskirim; 

$ongkoskirim_rp = format_rupiah($ongkoskirim);
$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
$grandtotal_rp  = format_rupiah($grandtotal);  

$pesan.="<br /><br />Total : Rp. $total_rp,-
         <br />Ongkos Kirim untuk Tujuan Kota Anda : Rp. $ongkoskirim1_rp/Kg 
         <br />Total Berat : $totalberat Kg
         <br />Total Ongkos Kirim  : Rp. $ongkoskirim_rp     
         <br />Grand Total : Rp. $grandtotal_rp,-
         <br /><br />Silahkan lakukan pembayaran ke rekening Bank sebanyak Grand Total yang tercantum";

$subjek="Pemesanan Online";

// Kirim email dalam format HTML
$dari = "From: admin@buanaelektronik.com \n";
$dari .= "Content-type: text/html \r\n";

// Kirim email ke kustomer
mail($_POST[email],$subjek,$pesan,$dari);


mail("dadang@buanaelektronik.com",$subjek,$pesan,$dari);

echo "<tr><td colspan=5 align=right>Total : Rp. </td><td align=right><b>$total_rp</b></td></tr>
      <tr><td colspan=5 align=right>Ongkos Kirim untuk Tujuan Kota Anda: Rp. </td><td align=right><b>$ongkoskirim1_rp</b>/Kg</td></tr>      
      <tr><td colspan=5 align=right>Total Berat : </td><td align=right><b>$totalberat Kg</b></td></tr>
      <tr><td colspan=5 align=right>Total Ongkos Kirim : Rp. </td><td align=right><b>$ongkoskirim_rp</b></td></tr>      
      <tr><td colspan=5 align=right>Grand Total : Rp. </td><td align=right><b>$grandtotal_rp</b></td></tr>
      </table>";
echo "<br /><br /><br /><br /><p></p><br />      
              </div>
          </div>    
          </div>
            <div class='bottom_prod_box_big10'></div>
          </div>";    
      
}
}

?>
