const header = document.querySelector("header");
const btnNav = document.querySelector(".btn-nav");
const btnClose = document.querySelector("header .btn-close");
const nav = document.querySelector("header nav");
const btnSearch = document.querySelector(".btn-search");
const searchContainer = document.querySelector(".search-modal-container");
const scrollBtn = document.querySelector(".btn-top");

feather.replace();
let servicesSwiper = new Swiper(".servicesSwiper", {
    slidesPerView: 1,
    spaceBetween: 10,
    loop: true,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        992: {
            slidesPerView: 3,
            spaceBetween: 40,
        },
    },
});

let homeProjectsSwiper = new Swiper(".homeProjectsSwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        992: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

let partnersSwiper = new Swiper(".partnersSwiper", {
    slidesPerView: 2,
    spaceBetween: 30,
    loop: true,
    autoplay: {
        delay: 2500,
    },
    breakpoints: {
        768: {
            slidesPerView: 3,
        },
        992: {
            slidesPerView: 6,
        },
    },
});

let teamsSwiper = new Swiper(".teamsSwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

btnNav.addEventListener('click', () => {
    nav.classList.add("active");
})

btnClose.addEventListener('click', () => {
    nav.classList.remove('active');
})

window.addEventListener('scroll', () => {
    if (window.scrollY > 30) {
        header.classList.add("fixed-header");
    } else {
        header.classList.remove("fixed-header");
    }

    if (window.scrollY > 300) {
        scrollBtn.classList.add("active");
    } else {
        scrollBtn.classList.remove("active");
    }
})


btnSearch.addEventListener('click', () => {
    searchContainer.classList.add("active");
})

searchContainer.addEventListener('click', (e) => {
    if (e.target === searchContainer) {
        searchContainer.classList.remove("active");
    }
})

window.addEventListener('keyup', (e) => {
    if (e.key == "Escape") {
        searchContainer.classList.remove("active");
    }
})