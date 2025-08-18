<x-layout>

    <div class="container py-5">
        {{-- Intestazione --}}
        <header class="text-center mb-5 ">
            <img src="/media/bg-img/io.jpg" alt="Foto Pentrelli Giuseppe" class="rounded-circle mb-3"
                style="width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--accessibilityBtn-bg);">
            <h1 class="fw-bold display-5 heading-title">
                <i class="bi bi-person-circle me-2"></i>Pentrelli Giuseppe - {{ __('ui.aboutMe') }}
            </h1>
            <p class="fst-italic fs-5">
                {{ __('ui.myTravel') }}
            </p>
        </header>

        {{-- Sezione: Presentazione e Passione --}}
        <section id="passione" class="mb-5">
            <h2 class="mb-4 text-center">{{ __('ui.myPassion') }}</h2>
            <p>
                {{ __('ui.myIntroText') }}
            </p>
        </section>

        {{-- Sezione: Timeline del Viaggio --}}
        <section class="timeline container-fluid my-5">
            <div class="row flex-column justify-content-center d-flex">

                <div class="timeline-item left" data-aos="fade-up">
                    <div class="icon"><i class="bi bi-scissors"></i></div>
                    <h4>{{ __('ui.dallaPoltrona') }}</h4>
                    <p>{{ __('ui.myHairstylingIntro') }}</p>
                </div>

                <div class="timeline-item right" data-aos="fade-up">
                    <div class="icon"><i class="bi bi-lightbulb"></i></div>
                    <h4>{{ __('ui.aulabDiscovery') }}</h4>
                    <p>{{ __('ui.aulabDiscoveryText') }}</p>
                </div>

                <div class="timeline-item left" data-aos="fade-up">
                    <div class="icon"><i class="bi bi-laptop"></i></div>
                    <h4>{{ __('ui.hackademyCourseStart') }}</h4>
                    <p>{{ __('ui.hackademyEarlyDays') }}</p>
                </div>

                <div class="timeline-item right" data-aos="fade-up">
                    <div class="icon"><i class="bi bi-book"></i></div>
                    <h4>{{ __('ui.studyAndPractice') }}</h4>
                    <p>{{ __('ui.hackademyPractice') }}</p>
                </div>

                <div class="timeline-item left" data-aos="fade-up">
                    <div class="icon"><i class="bi bi-trophy-fill"></i></div>
                    <h4>{{ __('ui.finalProject') }}</h4>
                    <p>{{ __('ui.finalProjectText') }}</p>
                </div>

                <div class="timeline-item right" data-aos="fade-up">
                    <div class="icon"><i class="bi bi-rocket-takeoff-fill"></i></div>
                    <h4>{{ __('ui.newBeginning') }}</h4>
                    <p>{{ __('ui.newCareerText') }}</p>
                </div>


            </div>
        </section>


        {{-- Sezione: Competenze tecniche --}}
        <section id="competenze" class="mb-5 container">
            <h2 class="mb-4 text-center" style="color: var(--title-color);">{{ __('ui.technicalSkills') }}</h2>

            <div class="row justify-content-center skill-row g-4">
                <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="300"">
                    <div class="skill-card text-center p-4">
                        <i class="bi bi-filetype-html display-5"></i>
                        <h5 class="mt-2">HTML5</h5>
                        <p class="small">{{ __('ui.htmlSemantic') }}</p>
                    </div>
                </div>


                <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="skill-card text-center p-4">
                        <i class="bi bi-filetype-css display-5"></i>
                        <h5 class="mt-2">CSS3</h5>
                        <p class="small">{{ __('ui.modernResponsive') }}</p>
                    </div>
                </div>


                <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="skill-card text-center p-4">
                        <i class="bi bi-filetype-js display-5"></i>
                        <h5 class="mt-2">JavaScript</h5>
                        <p class="small">{{ __('ui.interactivityAndLogic') }}}</p>
                    </div>
                </div>


                <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="400">
                    <div class="skill-card text-center p-4">
                        <i class="bi bi-braces display-5"></i>
                        <h5 class="mt-2">PHP</h5>
                        <p class="small">{{ __('ui.serverLogic') }}</p>
                    </div>
                </div>

                <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="skill-card text-center p-4">
                        <i class="bi bi-braces display-5"></i>
                        <h5 class="mt-2">Laravel</h5>
                        <p class="small">{{ __('ui.phpFramework') }}</p>
                    </div>
                </div>





                <div class="col-6 col-md-4 col-lg-3" data-aos="zoom-in" data-aos-delay="300">
                    <div class="skill-card text-center p-4">
                        <i class="bi bi-bootstrap display-5"></i>
                        <h5 class="mt-2">Bootstrap</h5>
                        <p class="small">{{ __('ui.fastUILibrary') }}</p>
                    </div>
                </div>
            </div>
        </section>


        
        
        
        
        {{-- Sezione video personali --}}
        <section class="container-fluid mb-5 video3dcontainer">
            <div class="row vh-100 align-items-center justify-content-center">
                <div class="text-center ">
                    <h2 class="heading-title fw-bold">{{__('ui.raccoltaProgetti')}}</h2>
                    <p class="fst-italic fs-5">{{__('ui.videoPercorso')}}</p>
                </div>
                <div class="video3d-wrapper"
                    style="perspective: 1200px; width: 400px; height: 250px; position: relative;">
                    <div class="video3d-carousel"
                        style="width: 100%; height: 100%; position: relative; transform-style: preserve-3d; transition: transform 1s;">
                        <div class="video3d-slide"
                            style="position: absolute; transform: rotateY(0deg) translateZ(430px);">
                            <video preload="none" controls poster="/media/progetti/PosterProgetto_Red_Dead.png">
                                <source src="/media/progetti/Progetto_Red_Deaad_Redemption.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="video3d-slide"
                            style="position: absolute; transform: rotateY(51.43deg) translateZ(430px);">
                            <video preload="none" controls poster="/media/progetti/ProgettoCronometro.png">
                                <source src="/media/progetti/ProgettoCronometro.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="video3d-slide"
                            style="position: absolute; transform: rotateY(102.86deg) translateZ(430px);">
                            <video preload="none" controls poster="/media/progetti/ProgettoPrestoFrontEnd.png">
                                <source src="/media/progetti/ProgettoPrestoFrontEnd.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="video3d-slide"
                            style="position: absolute; transform: rotateY(154.29deg) translateZ(430px);">
                            <video preload="none" controls poster="/media/progetti/PosterProgetto_ClashOfClans.png">
                                <source src="/media/progetti/Progetto_ClashOfClans.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="video3d-slide"
                            style="position: absolute; transform: rotateY(205.71deg) translateZ(430px);">
                            <video preload="none" controls poster="/media/progetti/PosterProgettoDragonball.png">
                                <source src="/media/progetti/ProgettoDragonball.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="video3d-slide"
                            style="position: absolute; transform: rotateY(257.14deg) translateZ(430px);">
                            <video preload="none" controls poster="/media/progetti/PosterFortniteBlog.png">
                                <source src="/media/progetti/FortniteBlog.mp4" type="video/mp4">
                            </video>
                        </div>
                        <div class="video3d-slide"
                            style="position: absolute; transform: rotateY(308.57deg) translateZ(430px);">
                            <video preload="none" controls poster="/media/progetti/PosterProgetto_canile.png">
                                <source src="/media/progetti/Progetto_canile.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </section>





        {{-- Sezione: Ringraziamenti --}}
        <section id="ringraziamenti" class="vh-100 d-flex flex-column justify-content-center ">
            <div class="container text-center">
                <h2 class=" mb-5 fw-bold heading-title">
                    <i class="bi bi-hand-thumbs-up-fill me-2"></i>{{ __('ui.specialThanks') }}
                </h2>

                <div class="swiper mySwiper" style="padding-bottom: 60px;">
                    <div class="swiper-wrapper">

                        {{-- Slide 1 con overlay --}}
                        <div class="swiper-slide rounded position-relative"
                            style="width: 700px; height: 500px; overflow: hidden;">
                            <img src="/media/bg-img/hackademy-di-aulab-121769.jpg" alt="Docente 1"
                                style="width: 100%; height: 100%; object-fit: cover;">
                            <div
                                class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center p-4">
                                <p class="text-white fs-5 m-0">
                                    {{ __('ui.thanksToTeachers') }}
                                </p>
                            </div>
                        </div>

                        {{-- Slide 2 senza overlay --}}
                        <div class="swiper-slide rounded" style="width: 700px; height: 500px; overflow: hidden;">
                            <img src="/media/bg-img/aulab-home-video-C6OdtYU6.webp" alt="Docente 2"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        {{-- Slide 3 con overlay --}}
                        <div class="swiper-slide rounded position-relative"
                            style="width: 700px; height: 500px; overflow: hidden;">
                            <img src="/media/bg-img/hackademy-di-aulab-121769.jpg" alt="Docente 3"
                                style="width: 100%; height: 100%; object-fit: cover;">
                            <div
                                class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex justify-content-center align-items-center p-4">
                                <p class="text-white fs-5 m-0">
                                    {{ __('ui.supportThanks') }}
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            {{-- SwiperJS CSS e JS --}}
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const swiper = new Swiper(".mySwiper", {
                        effect: "coverflow",
                        grabCursor: true,
                        centeredSlides: true,
                        slidesPerView: "auto",
                        coverflowEffect: {
                            rotate: 50,
                            stretch: 0,
                            depth: 100,
                            modifier: 1,
                            slideShadows: true,
                        },
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                        },
                        loop: true,
                    });
                });
            </script>
        </section>



        {{-- Sezione Social --}}
        <section id="social" class="text-center mb-5">
            <a href="https://github.com/tuo-username" target="_blank" class="text-dark mx-3 fs-3"
                aria-label="GitHub">
                <i class="bi bi-github"></i>
            </a>
            <a href="https://linkedin.com/in/tuo-username" target="_blank" class="text-primary mx-3 fs-3"
                aria-label="LinkedIn">
                <i class="bi bi-linkedin"></i>
            </a>
            <a href="mailto:tuo@email.com" class="text-danger mx-3 fs-3" aria-label="Email">
                <i class="bi bi-envelope-fill"></i>
            </a>
        </section>

        {{-- frase finale --}}
        <section class="text-center mt-5 mb-3 text-secondary fst-italic">
            <p>“{{ __('ui.myJourneyText') }}”</p>
        </section>
    </div>


</x-layout>
