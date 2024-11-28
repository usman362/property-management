<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="description" content="Resyahel - Buildings and Apartments">
    <meta name="keywords" content="hotel, resort, Spa">
    <meta name="robots" content="index, follow">
    <!-- for open graph social media -->
    <meta property="og:title" content="Buildings and Apartments">
    <meta property="og:description" content="Resyahel - Buildings and Apartments">
    <!-- for twitter sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Buildings and Apartments">
    <meta name="twitter:description" content="Resyahel - Buildings and Apartments">
    <!-- favicon -->
    <link rel="icon" href="{{ asset('f2/assets/images/favicon.ico') }}" type="image/x-icon">
    <!-- title -->
    <title>Resyahel - Buildings and Apartments</title>

    <!-- google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Gilda+Display&amp;family=Jost:ital,wght@0,100..900;1,100..900&amp;display=swap"
        rel="stylesheet">
    <!-- icon font from flaticon -->
    <link rel="stylesheet" href="{{ asset('f2/assets/fonts/flaticon_bokinn.css') }}">
    <!-- all plugin css -->
    <link rel="stylesheet" href="{{ asset('f2/assets/css/plugins.min.css') }}">
    <!-- main style custom css -->
    <link rel="stylesheet" href="{{ asset('f2/assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    @stack('styles')
</head>

<body>
    <!-- header area -->
    <div class="header__top">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 col-md-6">
                    <div class="social__links">
                        <a class="link__item gap-10" href="callto:#"><i class="flaticon-phone-flip"></i>
                            +1234567890</a>
                        <a class="link__item gap-10" href="mailto:#"><i class="flaticon-envelope"></i>
                            Resyahel@gmail.com</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="location">
                        <a class="link__item gap-10" href="#"><i class="flaticon-marker"></i>Lorem Ipsum is simply dummy text of the printing.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="main__header header__function">
        <div class="container">
            <div class="row">
                <div class="main__header__wrapper">
                    <div class="main__nav">
                        <div class="navigation d-none d-lg-block">
                            <nav class="navigation__menu" id="main__menu">
                                <ul class="list-unstyled">
                                    <li class="navigation__menu--item">
                                        <a href="{{route('home.index')}}" class="navigation__menu--item__link">Home</a>
                                    </li>
                                    <li class="navigation__menu--item">
                                        <a href="{{route('home.buildings')}}" class="navigation__menu--item__link">Buildings</a>
                                    </li>
                                    <li class="navigation__menu--item">
                                        <a href="{{route('home.apartments')}}" class="navigation__menu--item__link">Apartments</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                    <div class="main__logo">
                        <a href="{{route('home.index')}}">
                                <h4>Resyahel</h4>
                        </a>
                    </div>
                    <div class="main__right">
                        <a href="{{route('login')}}" class="theme-btn btn-style sm-btn fill"><span>Login</span></a>
                        <button class="theme-btn btn-style sm-btn fill menu__btn d-lg-none" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                            <span><img src="{{ asset('f2/assets/images/icon/menu-icon.svg') }}"
                                    alt=""></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->

    @yield('content')

    <!-- popup model -->

    <div class="modal similar__modal fade " id="loginModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="max-content similar__form form__padding">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h6 class="mb-0">Login To Resyahel</h6>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form action="https://html.themewant.com/Resyahel/candidate-dashboard.html" method="post"
                        class="d-flex flex-column gap-3">
                        <div class="form-group">
                            <label for="email-popup" class="text-dark mb-3">Your Email</label>
                            <div class="position-relative">
                                <input type="email" name="email-popup" id="email-popup"
                                    placeholder="Enter your email" required>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-dark mb-3">Password</label>
                            <div class="position-relative">
                                <input type="password" name="password" id="password"
                                    placeholder="Enter your password" required>

                            </div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between align-items-center ">
                            <div class="form-check d-flex align-items-center gap-2">
                                <input class="form-check-input mt-0" type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label mb-0" for="flexCheckDefault">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" class="forgot__password text-para" data-bs-toggle="modal"
                                data-bs-target="#forgotModal">Forgot Password?</a>
                        </div>
                        <div class="form-group my-3">
                            <button class="theme-btn btn-style sm-btn fill w-100"><span>Login</span></button>
                        </div>
                    </form>
                    <div class="d-block has__line text-center">
                        <p>Or</p>
                    </div>
                    <div class="d-flex gap-4 flex-wrap justify-content-center mt-20 mb-20">
                        <div class="is__social google">
                            <button class="theme-btn btn-style sm-btn"><span>Continue with Google</span></button>
                        </div>
                        <div class="is__social facebook">
                            <button class="theme-btn btn-style sm-btn"><span>Continue with Facebook</span></button>
                        </div>
                    </div>
                    <span class="d-block text-center ">Don`t have an account? <a href="#"
                            data-bs-target="#signupModal" data-bs-toggle="modal" class="text-primary">Sign Up</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- signup form -->
    <div class="modal similar__modal fade " id="signupModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="max-content similar__form form__padding">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h6 class="mb-0">Create A Free Account</h6>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <form action="#" class="d-flex flex-column gap-3">
                        <div class="form-group">
                            <label for="sname" class=" text-dark mb-3">Your Name</label>
                            <div class="position-relative">
                                <input type="text" name="sname" id="sname" placeholder="Candidate"
                                    required>
                                <i class="fa-light fa-user icon"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="signemail" class=" text-dark mb-3">Your Email</label>
                            <div class="position-relative">
                                <input type="email" name="signemail" id="signemail" placeholder="Enter your email"
                                    required>
                                <i class="fa-sharp fa-light fa-envelope icon"></i>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="spassword" class=" text-dark mb-3">Password</label>
                            <div class="position-relative">
                                <input type="password" name="spassword" id="spassword"
                                    placeholder="Enter your password" required>
                                <i class="fa-light fa-lock icon"></i>
                            </div>
                        </div>

                        <div class="form-group my-3">
                            <button class="theme-btn btn-style sm-btn fill w-100"><span>Register</span></button>
                        </div>
                    </form>
                    <div class="d-block has__line text-center">
                        <p>Or</p>
                    </div>
                    <div class="d-flex flex-wrap justify-content-center gap-4 mt-20 mb-20">
                        <div class="is__social google">
                            <button class="theme-btn btn-style sm-btn"><span>Continue with Google</span></button>
                        </div>
                        <div class="is__social facebook">
                            <button class="theme-btn btn-style sm-btn"><span>Continue with Facebook</span></button>
                        </div>
                    </div>
                    <span class="d-block text-center ">Have an account? <a href="#"
                            data-bs-target="#loginModal" data-bs-toggle="modal" class="text-primary">Login</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- forgot password form -->
    <div class="modal similar__modal fade " id="forgotModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="max-content similar__form form__padding">
                    <div class="d-flex mb-3 align-items-center justify-content-between">
                        <h6 class="mb-0">Forgot Password</h6>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <form action="#" class="d-flex flex-column gap-3">
                        <div class="form-group">
                            <label for="fmail" class=" text-dark mb-3">Your Email</label>
                            <div class="position-relative">
                                <input type="email" name="email" id="fmail" placeholder="Enter your email"
                                    required>
                                <i class="fa-sharp fa-light fa-envelope icon"></i>
                            </div>
                        </div>
                        <div class="form-group my-3">
                            <button class="theme-btn btn-style sm-btn fill w-100"><span>Reset Password</span></button>
                        </div>
                    </form>

                    <span class="d-block text-center ">Remember Your Password?
                        <a href="#" data-bs-target="#loginModal" data-bs-toggle="modal"
                            class="text-primary">Login</a> </span>
                </div>
            </div>
        </div>
    </div>

    <!-- offcanvase menu -->
    <div class="offcanvas offcanvas-start" id="offcanvasRight">
        <div class="rts__btstrp__offcanvase">
            <div class="offcanvase__wrapper">
                <div class="left__side mobile__menu">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    <div class="offcanvase__top">
                        <div class="offcanvase__logo">
                            <a href="{{route('home.index')}}">
                                <img src="{{ asset('f2/assets/images/logo/logo__two.svg') }}" alt="logo">
                            </a>
                        </div>
                        <p class="description">
                            Welcome to Resyahel, where luxury meets comfort in the heart of canada. Since 1999, we have
                            been dedicated to providing.
                        </p>
                    </div>
                    <div class="offcanvase__mobile__menu">
                        <div class="mobile__menu__active"></div>
                    </div>
                    <div class="offcanvase__bottom">
                        <div class="offcanvase__address">

                            <div class="item">
                                <span class="h6">Phone</span>
                                <a href="tel:+1234567890"><i class="flaticon-phone-flip"></i> +1234567890</a>
                            </div>
                            <div class="item">
                                <span class="h6">Email</span>
                                <a href="mailto:info@hostie.com"><i class="flaticon-envelope"></i>info@hostie.com</a>
                            </div>
                            <div class="item">
                                <span class="h6">Address</span>
                                <a href="#"><i class="flaticon-marker"></i> 280 Augusta Avenue, M5T 2L9 Toronto,
                                    Canada</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="right__side desktop__menu">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                    <div class="rts__desktop__menu">
                        <nav class="desktop__menu offcanvas__menu">
                            <ul class="list-unstyled">
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="#">Home
                                        <span class="toggle"></span>
                                    </a>
                                    <ul class="slide__menu">
                                        <li><a href="{{route('home.index')}}">Luxury Hotel</a></li>
                                        <li><a href="index-3.html">Luxe Vista Hotel</a></li>
                                        <li><a href="index-5.html">Ocean Breeze Hotel</a></li>
                                        <li><a href="index-4.html">Apartment Hotel</a></li>
                                        <li><a href="index-6.html">Mountain Hotel</a></li>
                                        <li><a href="index-7.html">City Hotel</a></li>
                                        <li><a href="index-8.html">Beach Hotel</a></li>
                                        <li><a href="index-dark.html">Hotel Dark</a></li>
                                        <li><a href="index-video.html">Hotel Seaside</a></li>
                                    </ul>
                                </li>
                                <li class="slide">
                                    <a class="slide__menu__item" href="about.html">About us
                                    </a>
                                </li>
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="#">Rooms
                                        <span class="toggle"></span>
                                    </a>
                                    <ul class="slide__menu">
                                        <li><a href="room-one.html">Room One</a></li>
                                        <li><a href="room-two.html">Room Two</a></li>
                                        <li><a href="room-three.html">Room Three</a></li>
                                        <li><a href="room-four.html">Room Four</a></li>
                                        <li><a href="room-details-1.html">Room Details One</a></li>
                                        <li><a href="room-details-2.html">Room Details Two</a></li>
                                    </ul>
                                </li>
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="#">Blog
                                        <span class="toggle"></span>
                                    </a>
                                    <ul class="slide__menu">
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                </li>
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="#">Pages
                                        <span class="toggle"></span>
                                    </a>
                                    <ul class="slide__menu">
                                        <li><a href="resturant.html">Resturant</a></li>
                                        <li><a href="gallery.html">Gallery</a></li>
                                        <li><a href="service.html">Service</a></li>
                                        <li><a href="event.html">Event</a></li>
                                        <li><a href="activities.html">Activities</a></li>
                                    </ul>
                                </li>
                                <li class="slide has__children">
                                    <a class="slide__menu__item" href="contact.html">Contact Us
                                    </a>

                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- offcanvase menu end -->
    <!-- footer style one -->
    <footer class="rts__section rts__footer is__common__footer footer__background has__shape">
        <div class="section__shape">
            <div class="shape__1">
                <img src="{{ asset('f2/assets/images/footer/shape-1.svg') }}" alt="">
            </div>
            <div class="shape__2">
                <img src="{{ asset('f2/assets/images/footer/shape-2.svg') }}" alt="">
            </div>
            <div class="shape__3">
                <img src="{{ asset('f2/assets/images/footer/shape-3.svg') }}" alt="">
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="footer__widget__wrapper">
                    <div class="rts__widget">
                        <a href="{{route('home.index')}}"><h4>Resyahel</h4></a>
                        <p class="font-sm max-290 mt-20">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        </p>
                    </div>
                    <div class="rts__widget">
                        <span class="widget__title">Quick Links</span>
                        <ul>
                            <li><a href="#" aria-label="footer__link">Lorem Ipsum</a></li>
                            <li><a href="#" aria-label="footer__link">Lorem Ipsum</a></li>
                            <li><a href="#" aria-label="footer__link">Lorem Ipsum</a></li>
                            <li><a href="#" aria-label="footer__link">Lorem Ipsum</a></li>
                        </ul>
                    </div>
                    <div class="rts__widget">
                        <span class="widget__title">Contact Us</span>
                        <ul>
                            <li><a aria-label="footer__contact" href="tel:+1234567890"><i
                                        class="flaticon-phone-flip"></i> +1234567890</a></li>
                            <li><a aria-label="footer__contact" href="mailto:UjJw6@example.com"><i
                                        class="flaticon-envelope"></i>Resyahel@gmail.com</a></li>
                            <li><a aria-label="footer__contact" href="#"><i class="flaticon-marker"></i>Lorem Ipsum is simply dummy.</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright__text">
            <div class="container">
                <div class="row">
                    <div class="copyright__wrapper">
                        <p class="mb-0">Copyright © 2024 Resyahel. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer style one end -->
    <!-- back to top -->
    <button type="button" class="rts__back__top" id="rts-back-to-top">
        <svg width="20" height="20" viewBox="0 0 13 22" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M7.30201 1.51317L7.29917 21.3422C7.29912 21.7057 6.97211 21.9993 6.5674 21.9993C6.16269 21.9992 5.83577 21.7055 5.83582 21.342L5.83844 3.10055L1.39753 7.08842C1.11169 7.34511 0.647535 7.34506 0.361762 7.0883C0.0759894 6.83155 0.0760493 6.41464 0.361896 6.15795L6.05367 1.04682C6.26405 0.857899 6.5773 0.802482 6.85167 0.905201C7.12374 1.00792 7.30205 1.24823 7.30201 1.51317Z"
                fill="#FFF" />
            <path
                d="M12.9991 6.6318C12.9991 6.80021 12.9282 6.96861 12.7841 7.09592C12.4983 7.35261 12.0341 7.35256 11.7483 7.0958L6.05118 1.97719C5.76541 1.72043 5.76547 1.30352 6.05131 1.04684C6.33716 0.790152 6.80131 0.790206 7.08709 1.04696L12.7842 6.16557C12.9283 6.29498 12.9991 6.46339 12.9991 6.6318Z"
                fill="#FFF" />
        </svg>

    </button>
    <!-- back to top end -->


    <!-- THEME PRELOADER START -->
    <div class="loader-wrapper">
        <div class="loader">
        </div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- THEME PRELOADER END -->


    <!-- plugin js -->
    <script src="{{ asset('f2/assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('f2/assets/js/gdpr.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('f2/assets/js/main.js') }}"></script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    @stack('scripts')
</body>
</html>
