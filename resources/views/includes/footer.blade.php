<div class="footer">
    <div id="footerMobile" class="footer-container blue-bg">
        <div class="footer-div">
            <img class="logo" src="{{asset('admin/assets/icons/logo.svg')}}" alt="">
        </div>
        <div class="links">
            <hr>
            <div>
                <div id="shop" class="footer-drop-down">
                    <p class="drop-down-title">TIENDA</p>
                    <p id="shopDropdown" class="drop-down-cross">+</p>
                </div>
                <div id="shopLinks" class="links-container links-vertical active-links">
                    <a class="shop-links" href="{{ url('productos?categorySelector=' . App\Models\Admin\Category::COMBO) }}">PLAZA</a>
                    <a class="shop-links" href="{{ url('productos?categorySelector=' . App\Models\Admin\Category::INDIVIDUAL) }}">JUEGOS INDIVIDUALES</a>
                    <a class="shop-links" href="{{ url('productos') }}">VER TODOS</a>
                </div>
            </div>
            <hr>
            <div>
                <div class="footer-drop-down">
                    <p class="drop-down-title">NOSOTROS</p>
                    <p id="aboutUsDropdown" class="drop-down-cross">+</p>
                </div>
                <div id="aboutUsLinks" class="links-container links-vertical active-links">
                    <a class="shop-links" href="{{ url('about-us') }}">SOBRE JUGANDO TOY</a>
                    <a class="shop-links" href="{{ url('our-values') }}">NUESTROS VALORES</a>
                </div>
            </div>
            <hr>
            <div>
                <div class="footer-drop-down">
                    <p class="drop-down-title">NUESTRAS REDES</p>
                    <p id="socialMediaDropdown" class="drop-down-cross">+</p>
                </div>
                <div id="socialMediaLinks" class="links-container active-links">
                    <a href="https://www.instagram.com/decorelieve/?hl=es" target="_blank">
                        <img src="{{ asset('admin/assets/icons/igIcon.svg') }}" alt="">
                    </a>
                    <a id="fb-icon" href="https://m.facebook.com/DecoRelieve/" target="_blank">
                        <img src="{{ asset('admin/assets/icons/fbIcon.svg') }}" alt="">
                    </a>
                </div>
            </div>
            <hr>
        </div>
        <div class="contact-questions">
            <div class="footer-div">
                <button class="button contact-btn">Contacto</button>
            </div>
            <div class="footer-div questions-div">
                <a class="general-questions" href="">POLÍTICA DE DEVOLUCIONES</a>
                <a class="general-questions" href="">PREGUNTAS FRECUENTES</a>
                <a class="general-questions" href="">ENVÍOS Y GARANTÍAS</a>
            </div>
        </div>
    </div>
    <div class="footer-copyright light-blue-bg" style="margin: 0">
        <p class="copyright-text" style="margin-right: 2px">Jugando Toy © Todos los derechos reservados.</p>
        <div class="d-flex">
            <p class="copyright-text" style="margin-right: 5px">Sitio creado por </p>
            <img src="{{ asset('admin/assets/images/GridMakersLogo.svg') }}" alt="">
        </div>
    </div>
</div>
