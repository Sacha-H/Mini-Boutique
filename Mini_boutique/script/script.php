<script>
        $(function() {
            // On recupere la position du bloc par rapport au haut du site
            var position_top_raccourci = $("#navigation").offset().top;

            //Au scroll dans la fenetre on déclenche la fonction
            $(window).scroll(function() {

                //si on a defile de plus de 150px du haut vers le bas
                if ($(this).scrollTop() > 400) {

                    //on ajoute la classe "fixNavigation" a <div id="navigation">
                    $('#navigation').addClass("fixNavigation");
                } else {

                    //sinon on retire la classe "fixNavigation" a <div id="navigation">
                    $('#navigation').removeClass("fixNavigation");
                }
            });
        });
    </script>



    <script>
        /***********Fonction de transformation du menu burger*******************/
        $(document).ready(function() {
            $('#nav-icon').click(function() {
                $(this).toggleClass('open');
                $(".topnav").toggleClass('responsive');
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>