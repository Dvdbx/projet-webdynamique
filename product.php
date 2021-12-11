

<?php
//identifier votre BDD
$database = "paris shopping";
//identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$id = isset($_POST["id"])? $_POST["id"] : "";

if($db_found)
{
    
if (isset($_POST["button1"])){

    $req = "SELECT * FROM objet WHERE idObjet = '$id'";
    $res = mysqli_query($db_handle, $req);
    $product = mysqli_fetch_assoc($res);

    $ven = $product['idVendeur'];

    $req2 = "SELECT * FROM vendeur WHERE idVendeur = '$ven'";
    $res2 = mysqli_query($db_handle, $req2);
    $vendeur = mysqli_fetch_assoc($res2);

} 
else{echo"pas de clic";}
}
else{echo"db not found";}



?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Alcool Store - <?php echo $product['nomObjet']; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="accueil.php">Alcool <span>store</span></a>
            <div class="order-lg-last btn-group">
                <a href="panier.php" class="btn-cart dropdown-toggle dropdown-toggle-split">
                    <span class="fa fa-shopping-bag"></span>
                    <div class="d-flex justify-content-center align-items-center"><small>3</small></div>
                </a>

            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="accueil.php" class="nav-link">Accueil</a></li>
                    <li class="nav-item"><a href="parcourir.php" class="nav-link">Tout parcourir</a></li>
                    <li class="nav-item	"><a href="notifications.php" class="nav-link">Notifications</a></li>
                    <li class="nav-item"><a href="login.php" class="nav-link">Votre compte</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-wrap hero-wrap-2" style="background-image:url(images/bg_2.webp)"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="accueil.php">Accueil <i
                                    class="fa fa-chevron-right"></i></a></span> <span><a href="parcourir.php">Parcourir <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Produits <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Produit</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="images/<?php echo $product['photo1']; ?>" class="image-popup prod-img-bg">
                        <script data-cfasync="false"
                            src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                        <script data-pagespeed-no-defer>//<![CDATA[
                            (function () {
                                for (var g = "function" == typeof Object.defineProperties ? Object.defineProperty : function (b, c, a) { if (a.get || a.set) throw new TypeError("ES3 does not support getters and setters."); b != Array.prototype && b != Object.prototype && (b[c] = a.value) }, h = "undefined" != typeof window && window === this ? this : "undefined" != typeof global && null != global ? global : this, k = ["String", "prototype", "repeat"], l = 0; l < k.length - 1; l++) { var m = k[l]; m in h || (h[m] = {}); h = h[m] }
                                var n = k[k.length - 1], p = h[n], q = p ? p : function (b) { var c; if (null == this) throw new TypeError("The 'this' value for String.prototype.repeat must not be null or undefined"); c = this + ""; if (0 > b || 1342177279 < b) throw new RangeError("Invalid count value"); b |= 0; for (var a = ""; b;)if (b & 1 && (a += c), b >>>= 1) c += c; return a }; q != p && null != q && g(h, n, { configurable: !0, writable: !0, value: q }); var t = this;
                                function u(b, c) { var a = b.split("."), d = t; a[0] in d || !d.execScript || d.execScript("var " + a[0]); for (var e; a.length && (e = a.shift());)a.length || void 0 === c ? d[e] ? d = d[e] : d = d[e] = {} : d[e] = c }; function v(b) { var c = b.length; if (0 < c) { for (var a = Array(c), d = 0; d < c; d++)a[d] = b[d]; return a } return [] }; function w(b) { var c = window; if (c.addEventListener) c.addEventListener("load", b, !1); else if (c.attachEvent) c.attachEvent("onload", b); else { var a = c.onload; c.onload = function () { b.call(this); a && a.call(this) } } }; var x; function y(b, c, a, d, e) { this.h = b; this.j = c; this.l = a; this.f = e; this.g = { height: window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight, width: window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth }; this.i = d; this.b = {}; this.a = []; this.c = {} }
                                function z(b, c) {
                                    var a, d, e = c.getAttribute("data-pagespeed-url-hash"); if (a = e && !(e in b.c)) if (0 >= c.offsetWidth && 0 >= c.offsetHeight) a = !1; else { d = c.getBoundingClientRect(); var f = document.body; a = d.top + ("pageYOffset" in window ? window.pageYOffset : (document.documentElement || f.parentNode || f).scrollTop); d = d.left + ("pageXOffset" in window ? window.pageXOffset : (document.documentElement || f.parentNode || f).scrollLeft); f = a.toString() + "," + d; b.b.hasOwnProperty(f) ? a = !1 : (b.b[f] = !0, a = a <= b.g.height && d <= b.g.width) } a && (b.a.push(e),
                                        b.c[e] = !0)
                                } y.prototype.checkImageForCriticality = function (b) { b.getBoundingClientRect && z(this, b) }; u("pagespeed.CriticalImages.checkImageForCriticality", function (b) { x.checkImageForCriticality(b) }); u("pagespeed.CriticalImages.checkCriticalImages", function () { A(x) });
                                function A(b) {
                                    b.b = {}; for (var c = ["IMG", "INPUT"], a = [], d = 0; d < c.length; ++d)a = a.concat(v(document.getElementsByTagName(c[d]))); if (a.length && a[0].getBoundingClientRect) {
                                        for (d = 0; c = a[d]; ++d)z(b, c); a = "oh=" + b.l; b.f && (a += "&n=" + b.f); if (c = !!b.a.length) for (a += "&ci=" + encodeURIComponent(b.a[0]), d = 1; d < b.a.length; ++d) { var e = "," + encodeURIComponent(b.a[d]); 131072 >= a.length + e.length && (a += e) } b.i && (e = "&rd=" + encodeURIComponent(JSON.stringify(B())), 131072 >= a.length + e.length && (a += e), c = !0); C = a; if (c) {
                                            d = b.h; b = b.j; var f; if (window.XMLHttpRequest) f =
                                                new XMLHttpRequest; else if (window.ActiveXObject) try { f = new ActiveXObject("Msxml2.XMLHTTP") } catch (r) { try { f = new ActiveXObject("Microsoft.XMLHTTP") } catch (D) { } } f && (f.open("POST", d + (-1 == d.indexOf("?") ? "?" : "&") + "url=" + encodeURIComponent(b)), f.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"), f.send(a))
                                        }
                                    }
                                }
                                function B() { var b = {}, c; c = document.getElementsByTagName("IMG"); if (!c.length) return {}; var a = c[0]; if (!("naturalWidth" in a && "naturalHeight" in a)) return {}; for (var d = 0; a = c[d]; ++d) { var e = a.getAttribute("data-pagespeed-url-hash"); e && (!(e in b) && 0 < a.width && 0 < a.height && 0 < a.naturalWidth && 0 < a.naturalHeight || e in b && a.width >= b[e].o && a.height >= b[e].m) && (b[e] = { rw: a.width, rh: a.height, ow: a.naturalWidth, oh: a.naturalHeight }) } return b } var C = ""; u("pagespeed.CriticalImages.getBeaconData", function () { return C });
                                u("pagespeed.CriticalImages.Run", function (b, c, a, d, e, f) { var r = new y(b, c, a, e, f); x = r; d && w(function () { window.setTimeout(function () { A(r) }, 0) }) });
                            })();

                            pagespeed.CriticalImages.Run('/mod_pagespeed_beacon', 'https://preview.colorlib.com/theme/liquorstore/product-single.html', '-ilGEe-FWC', true, false, 'Bj3FOPkL4x0');
//]]></script><img src="images/<?php echo $product['photo1']; ?>" class="img-fluid" alt="Colorlib Template"
                            data-pagespeed-url-hash="720714356"
                            onload="pagespeed.CriticalImages.checkImageForCriticality(this);">
                    </a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3><?php echo $product['nomObjet']; ?></h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;"> <span
                                    style="color: #bbb;">Rareté : <?php if($product['rarete']=="hautDeGamme"){echo "Haut de gamme";}if($product['rarete']=="rare"){echo "Rare";}if($product['rarete']=="regulier"){echo "Régulier";}; ?></span></a>
                        </p>

                    </div>
                    <p class="price"><span><?php echo $product['prixObjet']; ?>€</span></p>
                    <p><strong>Volume : <?php echo $product['volume']; ?>cl</strong></p>
                    <p>Description produit...
                    </p>

                    <form action="panier.php" method="post" class="text-align-center">
                                            
                      <input class="hidden" type="text" value="<?php echo $product['idObjet']; ?>" name="id">
                                    
                    <div class="row mt-4">
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </span>
                            <input type="text" id="quantity" name="quantity" class="quantity form-control input-number"
                                value="1" min="1" max="100">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <p style="color: #000;">.. unités disponibles</p>
                        </div>
                    </div>
                    <p>

                    <button type="submit" name="button1" class="btn btn-primary py-4 px-5" ><a class="d-flex align-items-center justify-content-center" style="top:-100px;"><p>Ajouter au panier</p></a></button>                
                                    
                        </p>
                    </form>
                    <form action="<?php if($product['typeAchat']=="immediat"){echo "checkout.php";}if($product['typeAchat']=="transaction"){echo "transaction.php";}if($product['typeAchat']=="meilleurOffre"){echo "Meilleure offre";} ?>" method="post" class="text-align-center">
                                            
                         <input class="hidden" type="text" value="<?php echo $product['idObjet']; ?>" name="id">
                                                          
                             <p>
                      
                             <button type="submit" name="button" class="btn btn-primary py-4 px-5" ><a class="d-flex align-items-center justify-content-center" style="top:-100px;"><p><?php if($product['typeAchat']=="immediat"){echo "Achat immédiat";}if($product['typeAchat']=="transaction"){echo "Transaction";}if($product['typeAchat']=="meilleurOffre"){echo "Meilleure offre";} ?></p></a></button>                
                                                          
                             </p>
                     </form>
                    
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-12 nav-link-wrap">
                    <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill"
                            href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Description</a>
                        <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
                            role="tab" aria-controls="v-pills-2" aria-selected="false">Fabriquant</a>
                       
                    </div>
                </div>
                <div class="col-md-12 tab-wrap">
                    <div class="tab-content bg-light" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel"
                            aria-labelledby="day-1-tab">
                            <div class="p-4">
                                <h3 class="mb-4"><?php echo $product['nomObjet']; ?></h3>
                                <p>Description produit...</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
                            <div class="p-4">
                                <h3 class="mb-4">Manufacturé par <?php echo $vendeur['nomVendeur']; ?></h3>
                                <p>bla bla bla</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="ftco-footer">    
        <div class="container-fluid px-0 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-0 text-center" style="color: rgba(255,255,255,.5);">
                            Copyright &copy;
                            <script data-cfasync="false"
                                src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                            <script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart color-danger" aria-hidden="true"></i> by Adrien Oleksiak, David Su, Yohann Roedianto, Benjamin To</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js+popper.min.js+bootstrap.min.js.pagespeed.jc.j8jkLwyN3s.js"></script>
    <script>eval(mod_pagespeed_EkNsNuAH7z);</script>
    <script>eval(mod_pagespeed_MUKbCx0zLD);</script>
    <script>eval(mod_pagespeed_FeCx2cZWCK);</script>
    <script
        src="js/jquery.easing.1.3.js+jquery.waypoints.min.js+jquery.stellar.min.js+owl.carousel.min.js.pagespeed.jc.qRFk3bnuu9.js"></script>
    <script>eval(mod_pagespeed_28_LPaQVu7);</script>
    <script>eval(mod_pagespeed_sKOpq3Xdu4);</script>
    <script>eval(mod_pagespeed_8wXJW4KpLl);</script>
    <script>eval(mod_pagespeed_uzXeqpYx2h);</script>
    <script
        src="js/jquery.magnific-popup.min.js+jquery.animateNumber.min.js+scrollax.min.js+google-map.js+main.js.pagespeed.jc.si7t_nTE-j.js"></script>
    <script>eval(mod_pagespeed_Ma0$sNGcVa);</script>
    <script>eval(mod_pagespeed_4xnO8OMtgk);</script>
    <script>eval(mod_pagespeed_138dmePAkq);</script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script>eval(mod_pagespeed_aVJ4gRg5hC);</script>
    <script>
        $(document).ready(function () {

            var quantitiy = 0;
            $('.quantity-right-plus').click(function (e) {

                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                $('#quantity').val(quantity + 1);


                // Increment

            });

            $('.quantity-left-minus').click(function (e) {
                // Stop acting like a button
                e.preventDefault();
                // Get the field name
                var quantity = parseInt($('#quantity').val());

                // If is not undefined

                // Increment
                if (quantity > 0) {
                    $('#quantity').val(quantity - 1);
                }
            });

        });
    </script>

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/v64f9daad31f64f81be21cbef6184a5e31634941392597"
        integrity="sha512-gV/bogrUTVP2N3IzTDKzgP0Js1gg4fbwtYB6ftgLbKQu/V8yH2+lrKCfKHelh4SO3DPzKj4/glTO+tNJGDnb0A=="
        data-cf-beacon='{"rayId":"6b88908e1a0dedb7","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.11.0","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>