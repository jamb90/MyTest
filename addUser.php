<!DOCTYPE HTML>
<?php
    error_reporting( ~E_NOTICE ); // avoid notice
    require_once 'db/db_config.php';
 
    if(isset($_POST['btnsave']))
    {
        $username = $_POST['user_name'];// user name
        $userlastname = $_POST['user_lastname'];// user lastname
        $userdocument = $_POST['user_document'];// user document
        $useraddress = $_POST['user_address'];// user address
    
        $imgFile = $_FILES['user_image']['name'];
        $tmp_dir = $_FILES['user_image']['tmp_name'];
        $imgSize = $_FILES['user_image']['size'];
    
        
        if(empty($username))
        {
            $msg = "Por favor Ingrese Usuario.";
        }
        else if(empty($userlastname))
        {
            $msg = "Por favor Ingrese Apellido.";
        }
        else if(empty($userdocument))
        {
            $msg = "Por favor Ingrese Documento de Identidad.";
        }
        else if(empty($useraddress))
        {
            $msg = "Por favor Ingrese Dirección.";
        }
        else if(empty($imgFile))
        {
            $msg = "Por favor seleccione o cargue una Imagen.";
        }
        else
        {
            $upload_dir = 'user_images/'; // upload directory
    
            $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    
            // valid image extensions
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    
            // rename uploading image
            $userpic = rand(1000,1000000).".".$imgExt;
        
            // allow valid image file formats
            if(in_array($imgExt, $valid_extensions)){   
        
            // Check file size '5MB'
            if($imgSize < 5000000)
            {
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            }
            else
            {
                $msg = "Diculpe, el archivo es muy grande.";
            }
        }
        else
        {
            $msg = "Disculpe, solo las extensiones de archivos JPG, JPEG, PNG & GIF son permitidos.";  
        }
    }

    // if no error occured, continue ....
    if(!isset($msg))
    {
        $stmt = $DB_con->prepare('INSERT INTO user(name,lastName,document,address,image) VALUES(:uname, :ulastname, :udoc, :uaddress, :uimage)');
        $stmt->bindParam(':uname',$username);
        $stmt->bindParam(':ulastname',$userlastname);
        $stmt->bindParam(':udoc',$userdocument);
        $stmt->bindParam(':uaddress',$useraddress);
        $stmt->bindParam(':uimage',$userpic);

        if($stmt->execute())
        {
            $msg = "Nuevo registro guardado exitosamente ...";
            $classmsg="alert alert-success";
        }
        else
        {
            $msg = "Error al intentar guardar el registro....";
            $classmsg="alert alert-danger";
        }
?>
        <div class="col-md-6">
            <div class="<?php echo $classmsg; ?>">
                <span class="glyphicon glyphicon-info-sign"><?php echo $msg;  header("refresh:5;index.php"); // redirects page after 5 seconds.?></span>
            </div>
        </div>
<?php
    }
    else{
?>
        <div class="col-md-6">
            <div class="alert alert-danger">
                <span class="glyphicon glyphicon-info-sign"><?php echo $msg; header("refresh:3;"); // refresh page after 3 seconds.?></span>
            </div>
        </div>
<?php
    }
}
?>

<HTML>
<HEAD>
    
<TITLE> My Test </TITLE>

<META name="description" content=">donde escribirás una breve descripción de la página">
<META name="keywords" content="Aquí escribe las palabras clave separadas por una coma">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</HEAD>
<BODY>

<div class="container">
    <div class="row">  
        <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto form p-4">  
            <form id="form" method="post" enctype="multipart/form-data"  class="border p-3 form" class="justify-content-center">
            <fieldset>
                
                <legend class="text-center header">Registrese</legend>
                
                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"></span>
                    <input type="text" class="form-control" id="inputName" name="user_name" placeholder="Introduzca Nombre" value="<?php echo $username; ?>" >
                </div>
                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"></span>
                    <input type="text" class="form-control" id="inputLastName" name="user_lastname" placeholder="Introduzca Apellido" value="<?php echo $userlastname; ?>" >
                </div>
                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"></span>
                    <input type="number" class="form-control" id="inputDocument" name="user_document" placeholder="N° Cédula: 12345678" value="<?php echo $userdocument; ?>" >
                </div>
                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"></span>
                    <input type="text" class="form-control" id="inputAddress" name="user_address" placeholder="Caracas, Venezuela. El Valle. 1090." value="<?php echo $useraddres; ?>">
                </div>
                <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center">
                    <label for="controlFile">Foto</label>
                    <input type="file" class="form-control-file" id="controlFile" name="user_image" accept="image/*">
                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-outline-dark" name="btnsave">Guardar</button>
                </div>
            </fieldset>
            </form>
        </div>
    </div>
</div>

</BODY>
</HTML>