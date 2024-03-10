<?php include "./components/header.php" ?>
    <main>
        <div class="container">
            <h4>Ha ocurrido un error</h4>
            <i><?php echo $error ?></i>
            <?php 
                $linkText = "Volver";
                $href = $backURL;
                include "./components/formInputs/link.php";
            ?>
        </div>
    </main>
<?php include "./components/footer.php" ?>