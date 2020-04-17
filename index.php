<!DOCTYPE HTML>
<?php
require_once 'db/db_config.php';
?>

<HTML>
<HEAD>
<TITLE> My Test </TITLE>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</HEAD>
<BODY>




<div class="table-responsive-md">
    <table class="table" >
        <caption>Lista de Usuarios</caption>

        <thead class="text-center table-dark" >
            <tr>
                <th >#</th>
                <th >Nombre</th>
                <th >Apellido</th>
                <th >Cédula</th>
                <th >Dirección</th>
                <th >Foto</th>
            </tr>
        </thead>

        <tbody class="text-center">

        <?php
            $stmt = $DB_con->prepare('SELECT id, name, lastName, document, address, image FROM user ORDER BY id DESC');
            $stmt->execute();
            $numberOfUser = 0;
    
            if($stmt->rowCount() > 0)
            {
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row);
                    $numberOfUser += 1;
        ?>

                    <tr>
                        <td class="align-middle"><?php echo $numberOfUser?></td>
                        <td class="align-middle"><?php echo $name?></td>
                        <td class="align-middle"><?php echo $lastName?></td>
                        <td class="align-middle"><?php echo $document?></td>
                        <td class="align-middle"><?php echo $address?></td>
                        <td class="align-middle"><img src="user_images/<?php echo $row['image']; ?>" class="mx-auto d-block rounded-circle" width="100px" height="65px" alt="Responsive image"/></td>
                    </tr>
        <?php
                }
            }
            else
            {
        ?>
        <div class="col-md-6">
            <div class="alert alert-warning">
                <span class="glyphicon glyphicon-info-sign">No se encontraron registros en Base de Datos ...</span>
            </div>
        </div>
        <?php
            }
        ?>    
        </tbody>
        <tfoot class="table-dark">
        <tr>
            <td colspan="5"><strong>Total de Usuarios</strong></td>
            <td class="text-right"><strong><?php echo $numberOfUser?></strong></td>
        </tr>
    </tfoot>
    </table>
</div>

</BODY>
</HTML>