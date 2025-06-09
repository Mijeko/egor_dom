import Swiper from 'swiper';

import {Navigation, Pagination, Thumbs} from 'swiper/modules';


document.addEventListener('DOMContentLoaded', () => {
	new Swiper(".banner-slider", {
		modules: [Pagination, Navigation],
		slidesPerView: 1,
		pagination: {
			el: ".swiper-pagination",
		},
		navigation: {
			prevEl: '.swiper-button-prev',
			nextEl: '.swiper-button-next',
		}
	});

	new Swiper(".jobs__team-slider", {
		modules: [Pagination, Navigation],
		slidesPerView: 3.8,
		watchOverflow: true,
		pagination: {
			el: ".swiper-pagination",
		},
		breakpoints: {
			0: {
				slidesPerView: 1.5,
			},
			991: {
				slidesPerView: 2.8,
			},
			1199: {
				slidesPerView: 3.8,
			},
		},
	});

	new Swiper(".news-detail-slider", {
		modules: [Pagination, Navigation],
		slidesPerView: 1,
		pagination: {
			el: ".swiper-pagination",
		},
		navigation: {
			prevEl: '.swiper-button-prev',
			nextEl: '.swiper-button-next',
		}
	});
});

