    document.addEventListener('DOMContentLoaded', function() {


        const swiper = new Swiper(".cards", {
            slidesPerView: 1,
            centeredSlides: true,
            spaceBetween: 10,
            keyboard: {
                enabled: true,
            },
            loop: true,
            pagination: {
                el: ".swiper-pagination",
            },
            navigation: {
                nextEl: ".swiper-btn-next",
                prevEl: ".swiper-btn-prev",
            },
            breakpoints: {
                767: {
                    slidesPerView: 3,
                },
            },
        });

        const slides = document.getElementsByClassName("swiper-slide");
        console.log("clled")
        for (const slide of slides) {
            slide.addEventListener("click", () => {
                const activeCard = slide.querySelector('.swiper-slide-active');
                const selectedCardText = slide.querySelector('.video-card');

                selectedCardText.style.display = 'block'

                const {className} = slide;
                if (className.includes("swiper-slide-next")) {
                    swiper.slideNext();
                    const parent = document.querySelector('.swiper-slide-next');
                    parent.querySelector('.video-card').style.display = 'block';
                    const parentPrev = document.querySelector('.swiper-slide-prev');
                    parentPrev.querySelector('.video-card').style.display = 'block';
                } else if (className.includes("swiper-slide-prev")) {
                    swiper.slidePrev();
                    const parent = document.querySelector('.swiper-slide-next');
                    parent.querySelector('.video-card').style.display = 'block';
                    const parentPrev = document.querySelector('.swiper-slide-prev');
                    parentPrev.querySelector('.video-card').style.display = 'block';
                }
            });
        }

        function resizeTextToFit() {
            const quoteEls = document.getElementsByClassName('quote');
            for (const el of quoteEls) {
                el.style.width = el.offsetWidth;
                el.style.height = el.offsetHeight;
            }
            textFit(quoteEls, {
                maxFontSize: 14
            });
        }
        resizeTextToFit();
        addEventListener("resize", (event) => {
            resizeTextToFit();
        });
    });
