{{-- <html>
<head>
    <style>
        .selectpicker option
        {
                border: none;
                background-color: white;
                outline: none;
                -webkit-appearance: none;
                -moz-appearance : none;
                color: #14B1B2;
                font-weight: bold;
                font-size: 30px;
                margin: 0;
                padding-left: 0;
                margin-top: -20px;
                background: none;
            }
        select.selectpicker
        {
                border: none;
                background-color: white;
                outline: none;
                -webkit-appearance: none;
                -moz-appearance : none;
                color: #14B1B2;
                font-weight: bold;
                font-size: 30px;
                margin: 0;
                padding-left: 0;
                margin-top: -20px;
                background: none;
            }</style>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>  

Ciao
{{ $admin->username }}

<a href="{{ route('logout.admin') }}">Logout</a>




<html>
  <head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  </head>

  Studenti:
<div class="container">
    <div class="row-fluid">
        
        <br>
        <div class="box">
        <select class="selectpicker des student" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
    @foreach($studenti as $student)
            <option value="{{ $student->ID }}">{{ $student->NOME }} {{ $student->COGNOME }}</option>
    @endforeach
        </select>
            </div>
     
    </div>
</div>
<div id="marks"></div>
Classi:
<div class="container">
    <div class="row-fluid">
        
        <br>
        <div class="box">
        <select class="selectpicker des class" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
    @foreach($classi as $classe)
            <option value="{{ $classe->ID }}">{{ $classe->NOME }}</option>
    @endforeach
        </select>
            </div>
     
    </div>
</div>
<div id="students"></div>
Professori:
<div class="container">
    <div class="row-fluid">
        
        <br>
        <div class="box">
        <select class="selectpicker des teacher" data-show-subtext="false" data-live-search="true" style="-webkit-appearance: none;">
    @foreach($professori as $professore)
            <option value="{{ $professore->ID }}">{{ $professore->NOME }} {{ $professore->COGNOME }}</option>
    @endforeach
        </select>
            </div>
     
    </div>
</div>
<div id="professori"></div>


<script>
    $(document).ready(function() {
        $('.student').change(function() {
            var studentId = $(this).val();
            $.ajax({
                url: '/api/students/' + studentId,
                method: 'GET',
                success: function(response) {
       
                    console.log(response);
                    var marks = response;
                    if(marks.length == 0){
                        $('#marks').html('Nessun voto trovato');
                        return;
                    }
                    var html = '<table class="table table-bordered"><thead><tr><th>VALUTAZIONE</th><th>DATA</th><th>TIPO</th><th>DESCRIZIONE</th></tr></thead><tbody>';
                    for (var i = 0; i < marks.length; i++) {
                        html += '<tr><td>' + marks[i].VALUTAZIONE + '</td><td>' + marks[i].DATA + '</td><td>' + marks[i].TIPO + '</td><td>' + marks[i].DESCRIZIONE + '</td></tr>';
                    }
                    html += '</tbody></table>';
                    $('#marks').html(html);


                },
                error: function(error) {
                    // Handle the error here
               scriptonsole.log(error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.class').change(function() {
            var classId = $(this).val();
            $.ajax({
                url: '/api/students/class/' + classId,
                method: 'GET',
                success: function(response) {
       
                    console.log(response);
                    var students = response;
                    if(students.length == 0){
                        $('#students').html('Nessun studente trovato');
                        return;
                    }
                    var html = '<table class="table table-bordered"><thead><tr><th>NOME</th><th>COGNOME</th><th>DATA DI NASCITA</th><th>EMAIL</th><th>STATO</th></tr></thead><tbody>';
                    for (var i = 0; i < students.length; i++) {
                        html += '<td>' + students[i].NOME + '</td><td>' + students[i].COGNOME + '</td><td>' + students[i].DATA_DI_NASCITA + '</td><td>' + students[i].EMAIL + '</td><td>' + students[i].STATO + '</td></tr>';
                    }
                    html += '</tbody></table>';
                    $('#students').html(html);
                }
            });
        });
    });

</script>
<script>
    $(document).ready(function() {
        $('.teacher').change(function() {
            var teacherId = $(this).val();
            $.ajax({
                url: '/api/teachers/' + teacherId,
                method: 'GET',
                success: function(response) {
       
                    console.log(response);
                    var professori = response;
                    if(professori.length == 0){
                        $('#professori').html('Nessun professore trovato');
                        return;
                    }
                    var html = '<table class="table table-bordered"><thead><tr><th>NOME</th><th>COGNOME</th><th>DATA DI NASCITA</th><th>EMAIL</th><th>CODICE LOGIN</th></tr></thead><tbody>';
                    for (var i = 0; i < professori.length; i++) {
                        html += '<td>' + professori[i].NOME + '</td><td>' + professori[i].COGNOME + '</td><td>' + professori[i].CODICE_FISCALE + '</td><td>' + professori[i].EMAIL + '</td><td>' + professori[i].cod_login + '</td></tr>';
                    }
                    html += '</tbody></table>';
                    $('#professori').html(html);
                }
            });
        });
    });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
</html> --}}
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>Codischool | Admin - Dashboard</title>

        <!-- Custom fonts for this template-->
        <link
            href="{{ asset('assets/vendor_admin/fontawesome-free/css/all.min.css') }}"
            rel="stylesheet"
            type="text/css"
        />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet"
        />

        <!-- Custom styles for this template-->
        <link href="{{ asset('assets/css_admin/sb-admin-2.min.css') }}" rel="stylesheet" />
    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul
                class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
                id="accordionSidebar"
            >
                <!-- Sidebar - Brand -->
                <a
                    class="sidebar-brand d-flex align-items-center justify-content-center"
                    href="index.html"
                >
                    <div class="sidebar-brand-icon rotate-n-15">
                        <i class="fas fa-laugh-wink"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">
                        SB Admin <sup>2</sup>
                    </div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0" />

                <!-- Nav Item - Dashboard -->
                <li class="nav-item">
                    <a class="nav-link" href="index.html">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Dashboard</span></a
                    >
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider" />

                <!-- Heading -->
                <div class="sidebar-heading">Interface</div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseTwo"
                        aria-expanded="true"
                        aria-controls="collapseTwo"
                    >
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Components</span>
                    </a>
                    <div
                        id="collapseTwo"
                        class="collapse"
                        aria-labelledby="headingTwo"
                        data-parent="#accordionSidebar"
                    >
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Components:</h6>
                            <a class="collapse-item" href="buttons.html"
                                >Buttons</a
                            >
                            <a class="collapse-item" href="cards.html">Cards</a>
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapseUtilities"
                        aria-expanded="true"
                        aria-controls="collapseUtilities"
                    >
                        <i class="fas fa-fw fa-wrench"></i>
                        <span>Utilities</span>
                    </a>
                    <div
                        id="collapseUtilities"
                        class="collapse"
                        aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar"
                    >
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Utilities:</h6>
                            <a class="collapse-item" href="utilities-color.html"
                                >Colors</a
                            >
                            <a
                                class="collapse-item"
                                href="utilities-border.html"
                                >Borders</a
                            >
                            <a
                                class="collapse-item"
                                href="utilities-animation.html"
                                >Animations</a
                            >
                            <a class="collapse-item" href="utilities-other.html"
                                >Other</a
                            >
                        </div>
                    </div>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider" />

                <!-- Heading -->
                <div class="sidebar-heading">Addons</div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a
                        class="nav-link collapsed"
                        href="#"
                        data-toggle="collapse"
                        data-target="#collapsePages"
                        aria-expanded="true"
                        aria-controls="collapsePages"
                    >
                        <i class="fas fa-fw fa-folder"></i>
                        <span>Pages</span>
                    </a>
                    <div
                        id="collapsePages"
                        class="collapse"
                        aria-labelledby="headingPages"
                        data-parent="#accordionSidebar"
                    >
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Login Screens:</h6>
                            <a class="collapse-item" href="login.html">Login</a>
                            <a class="collapse-item" href="register.html"
                                >Register</a
                            >
                            <a class="collapse-item" href="forgot-password.html"
                                >Forgot Password</a
                            >
                            <div class="collapse-divider"></div>
                            <h6 class="collapse-header">Other Pages:</h6>
                            <a class="collapse-item" href="404.html"
                                >404 Page</a
                            >
                            <a class="collapse-item" href="blank.html"
                                >Blank Page</a
                            >
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Charts -->
                <li class="nav-item active">
                    <a class="nav-link" href="charts.html">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Charts</span></a
                    >
                </li>

                <!-- Nav Item - Tables -->
                <li class="nav-item">
                    <a class="nav-link" href="tables.html">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Tables</span></a
                    >
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block" />

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button
                        class="rounded-circle border-0"
                        id="sidebarToggle"
                    ></button>
                </div>
            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav
                        class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow"
                    >
                        <!-- Sidebar Toggle (Topbar) -->
                        <button
                            id="sidebarToggleTop"
                            class="btn btn-link d-md-none rounded-circle mr-3"
                        >
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Search -->
                        <form
                            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        >
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control bg-light border-0 small"
                                    placeholder="Search for..."
                                    aria-label="Search"
                                    aria-describedby="basic-addon2"
                                />
                                <div class="input-group-append">
                                    <button
                                        class="btn btn-primary"
                                        type="button"
                                    >
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="searchDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="fas fa-search fa-fw"></i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div
                                    class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                    aria-labelledby="searchDropdown"
                                >
                                    <form
                                        class="form-inline mr-auto w-100 navbar-search"
                                    >
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                class="form-control bg-light border-0 small"
                                                placeholder="Search for..."
                                                aria-label="Search"
                                                aria-describedby="basic-addon2"
                                            />
                                            <div class="input-group-append">
                                                <button
                                                    class="btn btn-primary"
                                                    type="button"
                                                >
                                                    <i
                                                        class="fas fa-search fa-sm"
                                                    ></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </li>

                            <!-- Nav Item - Alerts -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="alertsDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="fas fa-bell fa-fw"></i>
                                    <!-- Counter - Alerts -->
                                    <span
                                        class="badge badge-danger badge-counter"
                                        >3+</span
                                    >
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div
                                    class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="alertsDropdown"
                                >
                                    <h6 class="dropdown-header">
                                        Alerts Center
                                    </h6>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="mr-3">
                                            <div class="icon-circle bg-primary">
                                                <i
                                                    class="fas fa-file-alt text-white"
                                                ></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                December 12, 2019
                                            </div>
                                            <span class="font-weight-bold"
                                                >A new monthly report is ready
                                                to download!</span
                                            >
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="mr-3">
                                            <div class="icon-circle bg-success">
                                                <i
                                                    class="fas fa-donate text-white"
                                                ></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                December 7, 2019
                                            </div>
                                            $290.29 has been deposited into your
                                            account!
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="mr-3">
                                            <div class="icon-circle bg-warning">
                                                <i
                                                    class="fas fa-exclamation-triangle text-white"
                                                ></i>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="small text-gray-500">
                                                December 2, 2019
                                            </div>
                                            Spending Alert: We've noticed
                                            unusually high spending for your
                                            account.
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item text-center small text-gray-500"
                                        href="#"
                                        >Show All Alerts</a
                                    >
                                </div>
                            </li>

                            <!-- Nav Item - Messages -->
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="messagesDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <i class="fas fa-envelope fa-fw"></i>
                                    <!-- Counter - Messages -->
                                    <span
                                        class="badge badge-danger badge-counter"
                                        >7</span
                                    >
                                </a>
                                <!-- Dropdown - Messages -->
                                <div
                                    class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="messagesDropdown"
                                >
                                    <h6 class="dropdown-header">
                                        Message Center
                                    </h6>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="dropdown-list-image mr-3">
                                            <img
                                                class="rounded-circle"
                                                src="{{ asset('assets/img_admin/undraw_profile_1.svg') }}"
                                                alt="..."
                                            />
                                            <div
                                                class="status-indicator bg-success"
                                            ></div>
                                        </div>
                                        <div class="font-weight-bold">
                                            <div class="text-truncate">
                                                Hi there! I am wondering if you
                                                can help me with a problem I've
                                                been having.
                                            </div>
                                            <div class="small text-gray-500">
                                                Emily Fowler · 58m
                                            </div>
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="dropdown-list-image mr-3">
                                            <img
                                                class="rounded-circle"
                                                src="{{ asset('assets/img_admin/undraw_profile_2.svg') }}"
                                                alt="..."
                                            />
                                            <div class="status-indicator"></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">
                                                I have the photos that you
                                                ordered last month, how would
                                                you like them sent to you?
                                            </div>
                                            <div class="small text-gray-500">
                                                Jae Chun · 1d
                                            </div>
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="dropdown-list-image mr-3">
                                            <img
                                                class="rounded-circle"
                                                src="{{ asset('assets/img_admin/undraw_profile_3.svg') }}"
                                                alt="..."
                                            />
                                            <div
                                                class="status-indicator bg-warning"
                                            ></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">
                                                Last month's report looks great,
                                                I am very happy with the
                                                progress so far, keep up the
                                                good work!
                                            </div>
                                            <div class="small text-gray-500">
                                                Morgan Alvarez · 2d
                                            </div>
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item d-flex align-items-center"
                                        href="#"
                                    >
                                        <div class="dropdown-list-image mr-3">
                                            <img
                                                class="rounded-circle"
                                                src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                                alt="..."
                                            />
                                            <div
                                                class="status-indicator bg-success"
                                            ></div>
                                        </div>
                                        <div>
                                            <div class="text-truncate">
                                                Am I a good boy? The reason I
                                                ask is because someone told me
                                                that people say this to all
                                                dogs, even if they aren't
                                                good...
                                            </div>
                                            <div class="small text-gray-500">
                                                Chicken the Dog · 2w
                                            </div>
                                        </div>
                                    </a>
                                    <a
                                        class="dropdown-item text-center small text-gray-500"
                                        href="#"
                                        >Read More Messages</a
                                    >
                                </div>
                            </li>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    id="userDropdown"
                                    role="button"
                                    data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                >
                                    <span
                                        class="mr-2 d-none d-lg-inline text-gray-600 small"
                                        >{{ $admin->username }}</span
                                    >
                                    <img
                                        class="img-profile rounded-circle"
                                        src="{{ asset('assets/img_admin/undraw_profile.svg') }}"
                                    />
                                </a>
                                <!-- Dropdown - User Information -->
                                <div
                                    class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown"
                                >
                                    <a class="dropdown-item" href="#">
                                        <i
                                            class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"
                                        ></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i
                                            class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"
                                        ></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i
                                            class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"
                                        ></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        data-toggle="modal"
                                        data-target="#logoutModal"
                                    >
                                        <i
                                            class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"
                                        ></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Calendario Assenze</h1>
                        <p class="mb-4">
                            <!--Create a calendar -->

                            <a
                                target="_blank"
                                href="https://www.chartjs.org/docs/latest/">
                                Classe 1A
                                </a
                            >
                        </p>

                        <!-- Content Row -->
                        <div class="row">
                            <div class="col-xl-8 col-lg-7">
                                <!-- Area Chart -->
                                <div id='bodyContentRow'>


                            <input name="ctl00$ContentPlaceHolderBody$txtDataSelezionataCAL" type="hidden" id="ContentPlaceHolderBody_txtDataSelezionataCAL" value="08/05/2024" />
                            <input name="ctl00$ContentPlaceHolderBody$idAluSelected" type="hidden" id="ContentPlaceHolderBody_idAluSelected" value="nothing" />

                            <div class="bootstrap">
                              <div class="container-fluid" style="margin-top: 5px">
                                <div class="row">
                                  <div style="margin-left: 5px; margin-right: 5px;">
                                    <div id="ContentPlaceHolderBody_divContent">
                                        <input type='hidden' name='fsGuids' id='fsGuids' value='MzhiN2RiZTEtZjZkZC00ZTAzLWJmZjAtNWZlODIzNTNmNDIyfDlkMjgxMWY3LTE1MTItNGY2Ny1hOTQ4LWFjZDllNzQxY2E1YXxmMTc3YmY4Zi1hY2E4LTQ5MGUtYWQ2YS1mYTJmYTUwMWY1MmF8Q3wwMDAwMDAwMC0wMDAwLTAwMDAtMDAwMC0wMDAwMDAwMDAwMDB8RmFsc2V8MDgvMDUvMjAyNHwwMDAwMDAwMC0wMDAwLTAwMDAtMDAwMC0wMDAwMDAwMDAwMDB8YjliNmI5MDUtNTQxZi00OWFlLTk4MGItNjRjZGNmZTBjM2Vi'>
                                        <input type='hidden' name='classeId' id='classeId' value='w4zDpsOpw43igLoS4oChBsK8DVbDs8KlF8O6U8OrO8OlI8O2w5PDmsWgYcKuw7knw7bDkMO3w6JIRnrFvg=='>
                                        <div id='rcla-content-left'>
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <table id='tabAlu' class='table table-striped table-condensed table-bordered table-hover table-th-middle table-th-center table-td-middle'>
                                                        <thead>
                                                            <tr>
                                                                <th rowspan='2' style='width: 35px;'>
                                                                    <label class='mt-checkbox  mt-checkbox-outline' title='Cliccando su questo campo è possibile selezionare o deselezionare tutti gli alunni'>
                                                                        <input type='checkbox' id='chkAll' name='chkAll' >
                                                                        <span>

                                                                        </span>
                                                                    </label>
                                                                </th>
                                                                <th rowspan='2' colspan='2'>
                                                                    Cognome e Nome
                                                                    <br>
                                                                    <button class='btn btn-sm btn-primary' id='btnEvento' id='btnEvento' style='margin-top: 5px'><i class='far fa-fw fa-edit'>
                                                                    </i> Assenze</button>&nbsp;
                                                                    <br>
                                                                    <input type='hidden' name='fsFascia' id='fsFascia' value='D'>
                                                                </th>
                                                                <th class='bg-success' colspan='4'>
                                                                {{ date('Y-m-d') }} Giorno: {{ date('l') }}
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th style='font-weight: normal;'>Ass.</th>
                                                                <th style='font-weight: normal;' title='Indicare se lo studente è o doveva essere in DaD'><i class='fas fa-fw fa-house-user tutti-in-dad' style='cursor: pointer;'></i></th>
                                                                <th style='font-weight: normal;' colspan='3'>Info</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                         
                                                            @foreach ($studenti as $student)
                                                            <tr id='row002' ><td class='text-center'><label class='mt-checkbox  mt-checkbox-outline'><input type='checkbox' id='chkAlu#002' name='chkAlu#002' value='beb7018f-948f-4539-b07e-b024feafb007' ><span></span></label></td><td class='cognome' title='Avena Diana nato/a il 20/09/2005'>[{{ $student->ID }}] <b>{{ $student->NOME }}</b></td><td class='text-center' style='width: 30px'><button class='btn btn-sm btn-info alunno-scheda' title='Clicca qui per visualizzare la scheda dell&#039;alunno.' data-action='ALUNNO_SCHEDA'  data-others='UkNMQXxiZWI3MDE4Zi05NDhmLTQ1MzktYjA3ZS1iMDI0ZmVhZmIwMDd8MzhiN2RiZTEtZjZkZC00ZTAzLWJmZjAtNWZlODIzNTNmNDIyfDlkMjgxMWY3LTE1MTItNGY2Ny1hOTQ4LWFjZDllNzQxY2E1YXxmMTc3YmY4Zi1hY2E4LTQ5MGUtYWQ2YS1mYTJmYTUwMWY1MmF8MDAwMDAwMDAtMDAwMC0wMDAwLTAwMDAtMDAwMDAwMDAwMDAw'><i class='fa fa-info-circle'></i></button></td><td class='text-center flagAss' style='width: 35px;'><label class='mt-checkbox  mt-checkbox-outline'><input type='checkbox' id='chkAssenza#002' name='chkAssenza#002' value='1'><span></span></label></td><td class='text-center flagDaD' style='width: 35px;'><label class='mt-checkbox  mt-checkbox-outline'><input type='checkbox' id='chkDaD#002' name='chkDaD#002' value='1'><span></span></label></td><td class='bg-status-0000 text-center tagGius  ' style='width: 40px' title=''><span class="badge badge-sm badge-danger">(ASSENZA)</span></td><td class='text-muted infoAlu' style='width: 110px;'></td></tr>
                                                            @endforeach

                                                        </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div>
                              <span id="ContentPlaceHolderBody_lblResult" class="RE_ST_Label_Error"></span>
                            </div>


                                </div>
                                <!-- Bar Chart -->
                            </div>

                            <!-- Donut Chart -->

                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div
            class="modal fade"
            id="logoutModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Ready to Leave?
                        </h5>
                        <button
                            class="close"
                            type="button"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Select "Logout" below if you are ready to end your
                        current session.
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-secondary"
                            type="button"
                            data-dismiss="modal"
                        >
                            Cancel
                        </button>
                        <a class="btn btn-primary" href="login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        
        <script src="{{ asset("assets/vendor_admin/jquery/jquery.min.js") }}"></script>
        <script src="{{ asset("assets/vendor_admin/bootstrap/js/bootstrap.bundle.min.js") }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset("assets/vendor_admin/jquery-easing/jquery.easing.min.js") }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset("assets/js_admin/sb-admin-2.min.js") }}"></script>

        <!-- Page level plugins -->


    </body>
</html>
