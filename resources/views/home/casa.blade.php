@extends('layouts.landing')

<!-- Titulos -->
@section('title', 'Casa')

@section('content')

    <div class="hero-container">
        <div class="hero-text">Casa Rural</div>
    </div>

    <div class="container py-5">
        <h1 class="text-center mb-4">Casa Rural</h1>
        <p class="text-justify">Tras un año de rehabilitación de un edificio prácticamente en ruinas, cuya parte más antigua
            data del siglo XVI, logramos recuperar su esencia conservando elementos emblemáticos. Entre ellos, destacan el
            arco de la entrada, la galería, piedras y dinteles originales, así como otros detalles que han sido restaurados
            minuciosamente para devolverles su esplendor. Además, se han incorporado espacios funcionales como un antiguo
            lavadero, adaptado a las comodidades modernas sin perder su esencia histórica.</p>
    </div>

    <!-- Descanso Visual 1-->
    <hr>
    @component('components.benefits')
    @endcomponent
    <hr>

    <div class="container">
        <div class="row section align-items-center">
            <div class="col-md-6 text-content">
                <h2>Dos plantas comunicadas</h2>
                <p>El hotel está diseñado en dos niveles conectados por cómodas escaleras de madera. En la planta baja se
                    encuentra la recepción, junto con un amplio salón de descanso y una zona de estar con chimenea. En la
                    primera planta, los huéspedes pueden disfrutar de un espacio de lectura con vistas al jardín.
                    Finalmente, la primera planta alberga habitaciones acogedoras con techos abuhardillados que crean un
                    ambiente cálido y rústico.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/img/Fachada.jpg') }}" alt="Imagen de la habitación">
            </div>
        </div>

        <div class="row section align-items-center flex-md-row-reverse">
            <div class="col-md-6 text-content">
                <h2>Habitaciones exteriores</h2>
                <p>Las habitaciones del hotel están diseñadas para ofrecer una experiencia de confort y tranquilidad. La
                    mayoría de ellas tienen vistas a la galería exterior o al jardín, permitiendo la entrada de luz natural
                    durante el día. Cada habitación cuenta con una cama amplia, mobiliario de madera y una decoración en
                    tonos cálidos que armonizan con la arquitectura rústica del edificio. Además, todas disponen de baño
                    privado completamente equipado, calefacción y detalles pensados para una estancia placentera.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/img/Estandar2.jpg') }}" alt="Imagen del exterior">
            </div>
        </div>

        <div class="row section align-items-center">
            <div class="col-md-6 text-content">
                <h2>Espacios para disfrutar</h2>
                <p>El hotel dispone de varias zonas comunes donde los huéspedes pueden relajarse y disfrutar de su estancia.
                    Entre ellas, se encuentra un salón con chimenea, ideal para leer o compartir momentos en un ambiente
                    acogedor. También hay una terraza amueblada con vistas a las montañas, perfecta para tomar un café por
                    la mañana o disfrutar de la puesta de sol. Además, los huéspedes pueden acceder a una pequeña biblioteca
                    con libros y juegos de mesa para su entretenimiento.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/img/Salon.jpg') }}" alt="Imagen del salón">
            </div>
        </div>

        <div class="row section align-items-center flex-md-row-reverse">
            <div class="col-md-6 text-content">
                <h2>Jardín</h3>
                    <p>El jardín del hotel es un espacio diseñado para conectar con la naturaleza y relajarse en un entorno
                        sereno. Cuenta con diversas áreas de descanso con bancos de madera y caminos rodeados de flores y
                        plantas autóctonas. Además, hay una zona con mesas y sombrillas donde los huéspedes pueden disfrutar
                        de
                        un desayuno al aire libre o simplemente descansar bajo la sombra de los árboles. La iluminación
                        nocturna
                        del jardín crea un ambiente mágico, ideal para pasear al atardecer.</p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('assets/img/Jardin.jpg') }}" alt="Imagen del jardín">
            </div>
        </div>
    </div>

@endsection

<!-- Estilos -->
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/casa_styles.css') }}">
@endsection
