<?php
$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<h2>Kategori Produk</h2>
          <div class='left'><input type=button class='btn btn-success' value='Tambah Kategori' 
          onclick=\"window.location.href='?module=kategori&act=tambahkategori';\"><br><br></div>
          <table class='table table-hover'>
          <tr><th><center>No</th>
          <th><center>Nama Kategori</th>
          <th><center>Aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td><center>$no</td>
             <td><center>$r[nama_kategori]</td>
             <td><center><a class='btn btn-success' href=?module=kategori&act=editkategori&id=$r[id_kategori]><b>Edit</b></a> 
	               <a class='btn btn-danger' href=$aksi?module=kategori&act=hapus&id=$r[id_kategori]><b>Hapus</b></a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  // Form Tambah Kategori
  case "tambahkategori":
    echo "<h2>Tambah Kategori</h2>
          <form method=POST action='$aksi?module=kategori&act=input'>
          <table class='table table-hover'>
          <tr><td>Nama Kategori</td><td><center> <input class='form-control' type=text name='nama_kategori'></td></tr>
          <tr><td colspan=2><input type=submit name=submit class='btn btn-success'  value=Simpan>
                            <input type=button class='btn btn-danger'  value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Kategori  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Kategori</h2>
          <form method=POST action=$aksi?module=kategori&act=update>
          <input  type=hidden name=id value='$r[id_kategori]'>
          <table class='table table-hover'>
          <tr><td>Nama Kategori</td><td> <center><input class='form-control' type=text name='nama_kategori' value='$r[nama_kategori]'></td></tr>
          <tr><td colspan=2><input type=submit class='btn btn-success' value=Update>
                            <input type=button class='btn btn-danger' value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
