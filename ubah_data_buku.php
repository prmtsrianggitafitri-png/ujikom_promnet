<?php
    require("function.php");
    session_start();
if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
    $id_buku = $_GET['id_buku'];


    $query = query("SELECT * FROM data_buku WHERE id_buku = $id_buku")[0];
    // echo "<pre>";
    // var_dump($query);
    // echo "</pre>";
    $data_buku = $query;
   
    $kategori = query("SELECT * FROM data_kategori");


    // ketika tombol submit nya di klik
    if(isset($_POST['tombol_submit'])){
       
        if(ubah_data_buku($_POST) > 0){
            echo "
                <script>
                    alert('Data BERHASIL diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data GAGAL diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }


    }


?>

<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SIMBS</title>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="dist/css/adminlte.min.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media='all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.min.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="index.php" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="#" class="nav-link">Contact</a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="bi bi-search"></i>
              </a>
            </li>
            <!--end::Navbar Search-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="dist/assets/img/user2-160x160.jpg"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline"><?php
        echo
            $_SESSION["username"]
        ?></span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="dist/assets/img/user2-160x160.jpg"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    Nama Kamu - Web Developer
                    <small>Member Naquinity since August 2024</small>
                  </p>
                </li>
                <!--end::User Image-->
                
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                  <a href="#" class="btn btn-default btn-flat float-end">Sign out</a>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="index.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="dist/assets/img/AdminLTELogo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">SIMBS</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Data Master
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php" class="nav-link active">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Buku</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="kategori.php" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Data Kategori</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-header">AUTENTIKASI</li>
              <li class="nav-item">
                <a href="./generate/theme.html" class="nav-link">
                  <i class="nav-icon bi bi-palette"></i>
                  <p>Sign Out</p>
                </a>
              </li>

            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->

      <!-- ====================================================================================== -->
      <!--  MAIN SECTION -->
      <!-- ====================================================================================== -->

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0">Tambah Data Buku</h3>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item"><a href="index.php">Data Buku</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-md-6">
              <!-- =============== ISI FORM NYA DI SINI =============== -->
                <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_buku" value="<?= $query['id_buku'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama Penulis</label>
                        <input type="text" class="form-control" name="nama_penulis" value="<?= $data_buku['nama_penulis'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul Buku</label>
                        <input type="text" class="form-control" name="judul_buku" value="<?= $data_buku['judul_buku'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control" name="jumlah_halaman" value="<?= $data_buku['jumlah_halaman'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" value="<?= $data_buku['penerbit'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" placeholder="Stok" autocomplete="off" value="<?= $data_buku['stok'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori Buku</label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="">--- Pilih Kategori ---</option> 
                            <?php foreach ($kategori as $row) : ?>
                                <option value="<?= $row['id_kategori'] ?>"
                                    <?php if ($row['id_kategori'] == $data_buku['id_kategori']) echo 'selected'; ?>>
                                    <?= $row['nama_kategori'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini:</label>
                        <p><img src="img/<?= $data_buku['gambar'] ?>" width="100"></p>
                        <label class="form-label">Ganti Gambar</label>
                        <input type="file" class="form-control" name="gambar" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <button class="btn-sm btn btn-primary" name="tombol_submit">Submit</button>
                    </div>
                </form>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Bismillah Tugas Promnet</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2025&nbsp;
        </strong>
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
   
  </body>
  <!--end::Body-->
</html>
