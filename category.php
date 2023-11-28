<?php require_once("../resources/config.php");?>
<?php require_once(TEMPLATE_FRONT.DS."header.php");?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>Bienvenu chez Shop225!</h1>
            <p>Une multitude de produit à porter de main</p>
            
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Produits tendances</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php get_products_in_cat_page(); ?>

 

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

<?php require_once(TEMPLATE_FRONT.DS."footer.php");?>