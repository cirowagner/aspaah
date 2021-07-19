<?php
  include_once "../../includes/connect.php";

  $connect = new ConnectionDB();
  $conn = $connect->iniciarDB();

  $queryC = "SELECT * FROM socio";
  $resC = $conn->query($queryC);
  $cantidadC = mysqli_num_rows($resC);

  $queryS = "SELECT * FROM solicitud";
  $resS = $conn->query($queryS);
  $cantidadS = mysqli_num_rows($resC);

  $queryT = "SELECT * FROM tractor";
  $resT = $conn->query($queryT);
  $cantidadT = mysqli_num_rows($resT);

  $queryB = "SELECT * FROM bovino";
  $resB = $conn->query($queryB);
  $cantidadB = mysqli_num_rows($resB);

  mysqli_close($conn);
?>

<div class= "conatiner_inicio">
    <div class="d-flex align-items-center justify-content-between my-4">
        <h2 class="m-0">UX/UI ASPAAH</h2>
        <div>
            <a class="py-2 my-1 mx-2 btn rounded-pill btn-primary" href="">+ Crear nuevo Dashboard</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3 my-2">
            <div class="content-dark bg-info text-white d-flex align-items-center p-3">
                <i class="fs-1 fas fa-user-circle"></i>
                <div class="ms-3">
                    <h3><?php echo $cantidadC ?></h3>
                    <p class="m-0">Socios</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 my-2">
            <div class="content-dark bg-info text-white d-flex align-items-center p-3">
                <i class="fs-1 fas fa-user-circle"></i>
                <div class="ms-3">
                    <h3><?php echo $cantidadS ?></h3>
                    <p class="m-0">Solicitudes</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 my-2">
            <div class="content-dark bg-info text-white d-flex align-items-center p-3">
                <i class="fs-1 fas fa-user-circle"></i>
                <div class="ms-3">
                    <h3><?php echo $cantidadT ?></h3>
                    <p class="m-0">Maquinarias</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 my-2">
            <div class="content-dark bg-info text-white d-flex align-items-center p-3">
                <i class="fs-1 fas fa-user-circle"></i>
                <div class="ms-3">
                    <h3><?php echo $cantidadB ?></h3>
                    <p class="m-0">Bovinos</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3 text-white">
        <div class="col-lg-6 my-2">
            <div class="bg-info content-dash content-dark py-4">
                <h2 class="ms-3 mb-4">Cantidad de socios / Tipo</h2>
                <div class="w-100 h-75" id="dash-bar"></div>
            </div>
        </div>
        <div class="col-lg-6 my-2">
            <div class="bg-info content-dash content-dark py-4">
                <h2 class="ms-3 mb-4">Maquinarias / Modelo</h2>
                <div class="w-100 h-75 fs-6" id="dash-donut"></div>
            </div>
        </div>
        <div class="col-12 my-2">
            <div class="bg-info content-dash content-dark py-4">
                <h2 class="ms-3 mb-2">Cantidad de Bovinos / Raza</h2>
                <div class="w-100 h-100 mb-3" id="dash-semi-c"></div>
            </div>
        </div>
    </div>
</div>

<!-- Dashboards -->
<script src="../js/dashboards/dash_bars.js"></script>
<script src="../js/dashboards/dash_donut.js"></script>
<script src="../js/dashboards/dash_semi_circle.js"></script>