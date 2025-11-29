<?php
    
    //kongigurasi
    $conn = mysqli_connect("localhost", "root", "", "simbs");
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

//join 2 tabe;
$join_query = "FROM data_buku db 
INNER JOIN data_kategori k 
ON db.id_kategori = k.id_kategori";
$main_query = "SELECT db.*, k.nama_kategori, k.tanggal_input " . $join_query ;

//menampilkan 2 tabel
function query($query){
    global $conn; 
    
    $result = mysqli_query($conn, $query);
    if ($result === false) {
        die("Query gagal: " . mysqli_error($conn) . " Query: " . $query); 
    }
    
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
    
}

//menampilkan halaman kategori
$kategori_query = "SELECT * FROM data_kategori";

//fungsi cari data buku (glona;)
function search_data($keyword) {
    global $conn, $join_query; 

    $keyword = mysqli_real_escape_string($conn, $keyword); 

    $query_search = "SELECT db.*, k.nama_kategori, k.tanggal_input " . $join_query . "
                     WHERE
                          db.nama_buku LIKE '%$keyword%' OR
                          db.nama_penulis LIKE '%$keyword%' OR
                          db.judul_buku LIKE '%$keyword%' OR
                          k.nama_kategori LIKE '%$keyword%'"; 

    return query($query_search);
}

//fungsi search kategori buku
function search_data_kategori ($keyword) {
    global $conn; 

    $keyword = mysqli_real_escape_string($conn, $keyword);

    $query_search = "SELECT * FROM data_kategori WHERE
                        nama_kategori LIKE '%$keyword%' OR
                        id_kategori LIKE '%$keyword%'";

    return query($query_search);
}

//fungsi tambah data buku
function tambah_data($data){
    global $conn;

    $nama_penulis = $data['nama_penulis'];
    $judul_buku = $data['judul_buku'];
    $jumlah_halaman = $data['jumlah_halaman'];
    $penerbit = $data['penerbit'];
    $stok = $data['stok'];
    $kategori = $data['id_kategori'];

    // $gambar = $data['gambar'];

    // upload gambar
    $gambar = upload_gambar($judul_buku, $nama_penulis);  
    if( !$gambar ) {
        return false;
    }

    $query = "INSERT INTO data_buku (nama_penulis, judul_buku, jumlah_halaman, penerbit, stok,id_kategori, gambar)
                  VALUES ('$nama_penulis', '$judul_buku', '$jumlah_halaman', '$penerbit', '$stok', '$kategori', '$gambar')
                 ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);    
}

// fungsi untuk upload gambar
function upload_gambar($judul_buku, $nama_penulis) {


    // setting gambar
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];


    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }


    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }


    // cek jika ukurannya terlalu besar
    // maks --> 5MB
    if( $ukuranFile > 5000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }


    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = $judul_buku . "_" . $nama_penulis;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);


    return $namaFileBaru;
}


//tambah data kategori
function tambah_data_kategori($data){
    global $conn;

    //htmlspecialchars = buat ngubah string jadi elemen html
    $kategori = htmlspecialchars($data['nama_kategori']);
    $kategori = mysqli_real_escape_string($conn, $kategori);

    $cek_query = "SELECT nama_kategori FROM data_kategori WHERE nama_kategori = '$kategori'";
    $result_kategori =mysqli_query($conn, $cek_query);

    //cek biar ga masukin kategori ganda
    if(mysqli_num_rows ($result_kategori) > 0){
        return "Kategori sudah Ada!";
    } 
    
    $tambah_query = "INSERT INTO data_kategori (nama_kategori)
                     VALUES ('$kategori')";
    
    mysqli_query($conn, $tambah_query);
    return mysqli_affected_rows($conn);
}

//fungsi ubah data buku
function ubah_data_buku($data){
    global $conn;

    $id_buku = $data['id_buku'];
    $nama_penulis = $data['nama_penulis'];
    $judul_buku = $data['judul_buku'];
    $jumlah_halaman = $data['jumlah_halaman'];
    $penerbit = $data['penerbit'];
    $stok = $data['stok'];
    $kategori = $data['id_kategori'];
    
    $gambar_lama = htmlspecialchars($data['gambar_lama']);

    if( $_FILES['gambar']['error'] !== 4 ) {
        $gambar_baru = upload_gambar($judul_buku, $nama_penulis);

        if ($gambar_baru === false) {
            return false; 
        }
        
        $gambar = $gambar_baru;
        if ($gambar_lama != 'default.jpg' && file_exists('img/' . $gambar_lama)) {
            @unlink('img/' . $gambar_lama); 
             }
        }

    //update
    $query = "UPDATE data_buku SET
                nama_penulis = '$nama_penulis',
                id_buku = '$id_buku',
                judul_buku = '$judul_buku',
                jumlah_halaman = '$jumlah_halaman',
                penerbit = '$penerbit',
                stok = '$stok',
                id_kategori = '$kategori',
                gambar = '$gambar'
              WHERE id_buku = $id_buku
             ";


            $result = mysqli_query($conn, $query);
                
            if ($result === false) {
                return 0; 
            }

            
            return (mysqli_affected_rows($conn) >= 0) ? 1 : 0;
}


//ubah data kategori

//fungsi ubah data buku
function ubah_data_kategori($data){
    global $conn;

    

    $nama_kategori = $data['nama_kategori'];
    $id_kategori = $data['id_kategori'];

    //update
    $query = "UPDATE data_kategori SET
                nama_kategori = '$nama_kategori'
              WHERE id_kategori = '$id_kategori'
             ";


     $result = mysqli_query($conn, $query);
     
     return mysqli_affected_rows($conn);
}

//fungsi hapus data buku
function hapus_data_buku($id_buku){
    global $conn;


    $query = "DELETE FROM data_buku WHERE id_buku = $id_buku";


    $result = mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);    
}

//hapus data kategori

//fungsi hapus data buku
function hapus_data_kategori($id_kategori){
    global $conn;


    $query = "DELETE FROM data_kategori WHERE id_kategori = $id_kategori";


    $result = mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);    
}

// fungsi untuk register
function register($data){
    global $conn;


    $username = strtolower($data['username']);
    $email = $data['email'];
    $password = mysqli_real_escape_string($conn, $data['password']);

    if (strlen($data['password']) < 8) {
        return "Password minimal harus 8 karakter!";}


    // query untuk ngecek username yang diinputkan oleh user di database
    $query = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    $result = mysqli_fetch_assoc($query);


    if($result != NULL){
        return "Username sudah terdaftar!";
    }



    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user (username, email, password) VALUES('$username', '$email', '$password')");


    return true;
}

// fungsi untuk login
function login($data){
    global $conn;

    $username = strtolower($data['username']);
    $password = $data['password'];


    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);


    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);


        if(password_verify($password, $row['password'])){
            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];
            return true;
        } else {
           
            return "Password salah!";
        }


    }else{
        return "Username tidak terdaftar!";
    }
}
?>