<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Akuntansi</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    @yield('css')
    @php
        
        $data_admin = session('user');
    @endphp
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-primary navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../../index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary active">Akun Setting</button>
                    <button type="button" class="btn btn-secondary active dropdown-toggle dropdown-icon"
                        data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                        <div class="dropdown-menu" role="menu" style="">
                            <a class="dropdown-item" href="#tutupAKunMdl" id="btnTutupAkun" data-toggle='modal'
                                data-target='#tutupAKunMdl'>Tutup Akun</a>
                            <div class="dropdown-divider"></div>

                            <form action="/logout" id="logoutForm" method="POST">
                                @csrf
                                <a href="#" onclick="document.getElementById('logoutForm').submit();"
                                    class="dropdown-item" type="submit">Logout</a>
                            </form>
                        </div>
                    </button>
                </div>
                <!-- Notifications Dropdown Menu -->

            </ul>
        </nav>
        <!-- /.navbar -->
        <div class="modal fade" id="tutupAKunMdl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tutup Akun </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/tutupakun" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select name="tahun" id="tahun" class="form-control">
                                    {{ $last = date('Y') - 5 }}
                                    {{ $now = date('Y') }}

                                    @for ($i = $now; $i >= $last; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor

                                </select>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Tutup Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="../../dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Moia Servindo</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ $data_admin->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-header">&nbsp;&nbsp;&nbsp; FEATURES</li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Daftar Stakeholder
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('karyawan/') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Karyawan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('supplier/') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Supplier</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/stok-barang" class="nav-link">
                                <i class="nav-icon far fa fa-bookmark"></i>
                                <p>
                                    Jasa & Persediaan Barang
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Daftar Transaksi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/penjualan" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transaksi Penjualan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/pembelian" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transaksi Pembelian</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Transaksi Lainnya
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/data-beban" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Beban</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/data-peralatan" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Peralatan</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="/akun" class="nav-link">
                                <i class="nav-icon far fa fa-database"></i>
                                <p>
                                    Daftar Akun
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="/bukubesar" class="nav-link">
                                <i class="nav-icon far fa fa-bookmark"></i>
                                <p>
                                    Buku Besar
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Jurnal
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="/jurnal/pengeluaran-kas" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jurnal Pengeluaran Kas</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="/jurnal/penerimaan-kas" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jurnal Penerimaan Kas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/jurnal/penyesuaian" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jurnal Penyesuaian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/jurnal/umum" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jurnal Umum</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/jurnal/penutup" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jurnal Penutup</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="/laporan/keuangan" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Laporan Keuangan
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/laporan/neraca" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Neraca</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/laporan/laba-rugi" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Laba Rugi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <hr />

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">@yield('judul')</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"
                                data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        @yield('content')
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        @yield('footer')
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.0.5
            </div>
            <strong>Sistem Informasi Akuntansi <a href="http://adminlte.io"> - ReymonRizkiT</a>.</strong>

        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/mask-input/dist/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('plugins/mask-input/dist/jquery.mask.js') }}"></script>
    <script>
        $('.price').mask('000.000.000.000.000', {
            reverse: true
        })

        function formatNumber(number) {
            // var num = number.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })
            // console.log(num)

            return number.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".");

        }
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $("#datatable").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
        });
        $('#btnTutupAkun').click(function() {
            $('#tutupAKunMdl').modal('show')
        })
    </script>

    @yield('js')
</body>

</html>
