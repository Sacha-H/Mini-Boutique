<header id="Header">
        <div id='navigation' class="navigation">
            <div class="menu">
                <nav class="topnav" id="myTopnav">
                    <?php
                    if (!empty($_SESSION['pseudo'])){
                        ?>
                        <a class="menu-hover" href="../update/updateUser.php">
                        <?php echo $_SESSION['pseudo']?></a>
                        <?php
                    }
                    ?>
                    <a class="menu-hover" href="../index.php">Boutique</a>
                    <a class="menu-hover" href="../connexion/connexion.php">Admin</a>
                   <?php

if (!empty($_SESSION['idUser']) && !empty($_SESSION['pseudo'])){
    ?>
    <a  class="menu-hover" href="../connexion/deconnexionUser.php">Déconnexion</a>
   <?php
}
else{ ?>
                    <a class="menu-hover" href="../connexion/connexionUser.php">Connexion</a>
                    <?php
}
?>

                    <a class="menu-hover" href="../pages/shop.php">Panier - <?php if  (!empty($_SESSION['number'])) {  echo $_SESSION['number']; }?></a>

                </nav>
            </div>
            <!-- Début bouton burger -->
            <div id="nav-icon">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="responsive">
            </div>
        </div>
</header>