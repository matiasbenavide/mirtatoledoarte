export async function main()
{
    const track = $('.carousel__track')[0];
    const slides = Array.from(track.children);

    const nextButton = $('.carousel__button--right')[0];
    const prevButton = $('.carousel__button--left')[0];

    const dotsNav = $('.carousel__nav')[0];
    const dots = Array.from(dotsNav.children);

    const slideWidth = slides[0].getBoundingClientRect().width;

    const setSlidePosition = (slide, i) => {
        slide.style.left = slideWidth * i + 'px';
    };

    slides.forEach(setSlidePosition);

    const moveToSlide = (currentSlide, targetSlide) => {
        track.style.transform = 'translateX(-' + targetSlide.style.left + ')';

        currentSlide.classList.remove('current-slide');
        targetSlide.classList.add('current-slide');
    }

    const updateDots = (currentDot, targetDot) => {
        currentDot.classList.remove('current-slide');
        targetDot.classList.add('current-slide');
    }

    const showHideNav = (targetIndex) => {
        if (targetIndex === 0) {
            prevButton.classList.add('active');
            nextButton.classList.remove('active');
        }
        else if (targetIndex === slides.length + slides.lastIndexOf()) {
            prevButton.classList.remove('active')
            nextButton.classList.add('active');
        }
        else {
            prevButton.classList.remove('active')
            nextButton.classList.remove('active')
        }
    }

    nextButton.addEventListener('click', e => {
        const currentSlide = track.querySelector('.current-slide');
        const nextSlide = currentSlide.nextElementSibling;

        const currentDot = dotsNav.querySelector('.current-slide');
        const nextDot = currentDot.nextElementSibling;

        const nextIndex = slides.findIndex(slide => slide === nextSlide);

        showHideNav(nextIndex);
        moveToSlide(currentSlide, nextSlide);
        updateDots(currentDot, nextDot);
    });

    prevButton.addEventListener('click', e => {
        const currentSlide = track.querySelector('.current-slide');
        const previousSlide = currentSlide.previousElementSibling;

        const currentDot = dotsNav.querySelector('.current-slide');
        const previousDot = currentDot.previousElementSibling;

        const previousIndex = slides.findIndex(slide => slide === previousSlide);

        showHideNav(previousIndex);
        moveToSlide(currentSlide, previousSlide);
        updateDots(currentDot, previousDot);
    });

    dotsNav.addEventListener('click', e => {
        const targetDot = e.target.closest('button');

        if (!targetDot) return;

        const currentSlide = track.querySelector('.current-slide');
        const currentDot = dotsNav.querySelector('.current-slide');
        const targetIndex = dots.findIndex(dot => dot === targetDot);
        const targetSlide = slides[targetIndex];

        showHideNav(targetIndex);
        moveToSlide(currentSlide, targetSlide);
        updateDots(currentDot, targetDot);
    });
}
