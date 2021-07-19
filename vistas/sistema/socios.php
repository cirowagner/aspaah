<?php
    include_once "../../includes/connect.php";

    $connect = new ConnectionDB();
    $conn = $connect->iniciarDB();
?>

<div class="container_socios">
    <div class="d-flex align-items-center justify-content-between my-4">
        <h1 class="my-0">Socios</h1>
        <div>
            <a class="py-2 mx-2 btn rounded-pill btn-primary" href="">+ Registrar nuevo socio</a>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="bg-info p-3 content-dark text-white search-socio">
            <i class="fs-4 fas fa-search"></i>
            <input class="bg-info text-white ps-3" type="text" id="search" value="<?php echo $_POST["search"] ?>" placeholder="Buscar por ID, Nombre, Apellido ...">
        </div>
        <div class="ms-4 d-flex align-items-center fs-5">
            <input class="control-form" type="checkbox"><label class="ms-2">Socios deshabilitados</label>
        </div>
    </div>

    <?php
        if(isset($_POST["search"])){
            $search = $_POST["search"];        
            $query = "SELECT socio_id, socio_codigo, (SELECT p.pers_nombre FROM persona p WHERE p.pers_id = socio_persona_id), (SELECT p.pers_ape_paterno FROM persona p WHERE p.pers_id = socio_persona_id), socio_categoria, socio_tipo, socio_parentesco, socio_estado, (SELECT (SELECT ub.ubic_distrito FROM ubicacion ub WHERE ub.ubic_id = p.pers_id) FROM persona p WHERE p.pers_id = socio_id) FROM socio WHERE socio_id LIKE '$search%' OR (SELECT p.pers_nombre FROM persona p WHERE p.pers_id = socio_persona_id) LIKE '$search%' OR (SELECT p.pers_ape_paterno FROM persona p WHERE p.pers_id = socio_persona_id) LIKE '$search%' ORDER BY socio_id DESC";
        }else{
            $inicio = ($_POST["pagina"]-1)*3;

            if(!$_POST["pagina"]){
                $inicio = 0;
            }

            $query = "SELECT socio_id, socio_codigo, (SELECT p.pers_nombre FROM persona p WHERE p.pers_id = socio_persona_id), (SELECT p.pers_ape_paterno FROM persona p WHERE p.pers_id = socio_persona_id), socio_categoria, socio_tipo, socio_parentesco, socio_estado, (SELECT (SELECT ub.ubic_distrito FROM ubicacion ub WHERE ub.ubic_id = p.pers_id) FROM persona p WHERE p.pers_id = socio_id) FROM socio ORDER BY socio_id DESC LIMIT $inicio, 3";
        }
    ?>

    <table class="table table-hover table-info table-striped my-3">
        <thead>
            <tr>
                <td>#ID</td>
                <td>Cod</td>
                <td>Nombres</td>
                <td>Ape. Paterno</td>
                <td>Categoria</td>
                <td>Tipo</td>
                <td>Parentesco</td>
                <td>Estado</td>
                <td>Distrito</td>
                <td class="text-center">Operaciones</td>
            </tr>
        </thead>
        <tbody>
            <?php
                $res = $conn->query($query);

                if(!mysqli_num_rows($res) == 0){
                    while($data = $res->fetch_array()){?>
                        <tr>
                            <td><?php echo $data[0] ?></td>
                            <td><?php echo $data[1] ?></td>
                            <td><?php echo $data[2] ?></td>
                            <td><?php echo $data[3] ?></td>
                            <td><?php echo $data[4] ?></td>
                            <td><?php echo $data[5] ?></td>
                            <td><?php echo $data[6] ?></td>
                            <td><?php echo $data[7] ?></td>
                            <td><?php echo $data[8] ?></td>
                            <td><div class="d-flex justify-content-center">
                            <a class="btn btn-outline-primary py-0 me-2" data-fancybox data-type="ajax" id="test" data-src="html/socio/edit_socio.php?id=<?php echo $data[0] ?>" href="javascript:;">Editar</a>

                            <a class="btn btn-outline-danger py-0" href="javascript:fn_delete(<?php echo $data[0] ?>);">Deshabilitar</a>
                            </div></td>
                        </tr>
                <?php } 
                }else { ?>
                    <tr>
                        <td class="fs-4 text-primary text-center" colspan="10">No hay resultados en la busqueda de "<?php echo $_POST["search"] ?>"</td>
                    </tr>
                <?php } ?>
        </tbody>
    </table>
</div>

<?php
    $query2 = "SELECT * FROM lista_socios";
    $res2 = $conn->query($query2);
    $num_registros = mysqli_num_rows($res2);
    $paginas = $num_registros / 3;
    $paginas = ceil($paginas);

if(!isset($_POST["search"])){?>
    <nav class="d-flex justify-content-between" aria-label="Page navigation example" id="paginador">
        <div>
            <label class="ms-3">Reportes:</label>
            <a href="../resources/reportes/excel.php" class="btn btn-success" title="Exportar archivo excel" ><i class="fas fa-file-excel"></i></a>
            <a href="../resources/reportes/pdf.php" class="btn btn-danger" title="Imprimir PDF" ><i class="fas fa-print"></i></a>
        </div>
        <ul class="pagination">
            <li class="page-item <?php echo $_POST["pagina"] <= 1 ? 'disabled':'' ?>"><a class="page-link" href="javascript:nextPage(<?php echo $_POST["pagina"]-1 ?>)"><<</a></li>

            <?php for ($i = 0; $i < $paginas; $i++) {?>
                <li class="page-item <?php echo $_POST["pagina"] == $i+1 ? 'active':'' ?>"><a class="page-link" href="javascript:nextPage(<?php echo $i+1 ?>)"><?php echo $i+1 ?></a></li>
            <?php } ?>

            <li class="page-item <?php echo $_POST["pagina"] >= $paginas ? 'disabled':'' ?>"><a class="page-link" href="javascript:nextPage(<?php echo $_POST["pagina"]+1 ?>)">>></a></li>
        </ul>
    </nav>
<?php } ?>

<!-- Scripts -->
<script>
    (function($){
        $.fn.focusTextToEnd = function(){
            this.focus();
            let $thisVal = this.val();
            this.val('').val($thisVal);
            return this;
        }
    })(jQuery);

    $('#search').focusTextToEnd();

    $("#search").on("keyup", function(){
        if ($("#search").val()) {
            let search = $("#search").val();
            $.ajax({
                url: 'sistema/socios.php',
                type: 'post',
                data: {search},
                beforeSend: function(){
                    // $("#table").html("<h2>Epere...</h2>");
                }
            }).done(function(res) {
                $("#page-princ").html(res);
                console.log("Search: "+search);
            }).fail(function() {
                console.log("Error¡¡¡");
            });
        }else{
            $.ajax({
                url: 'sistema/socios.php',
                type: 'post',
                data: {}
            }).done(function(res) {            
                $("#page-princ").html(res);
                console.log("reload");            
            }).fail(function() {
                console.log("Error¡¡¡");
            });
        }
    });

    function nextPage(pagina) {
        $.post('sistema/socios.php',{pagina}, function (res) {
            $("#page-princ").html(res);
        });
        console.log(pagina);
    }
</script>