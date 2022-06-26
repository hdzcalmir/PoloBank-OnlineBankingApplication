'use strict';

const btns = document.querySelectorAll("[data-target]");
const close_modals = document.querySelectorAll(".btn_close-modal");
const overlay = document.querySelector(".overlay");
const btnScrollTo = document.querySelector('.btn--scroll-to');
const section1 = document.querySelector('#section--1');
const nav = document.querySelector('.nav');
const tabs = document.querySelectorAll('.operations__tab');
const tabsContainer = document.querySelector('.operations__tab-container');
const tabsContent = document.querySelectorAll('.operations__content');

///////////////////////////////////////
// Modal window

btns.forEach((btn) => {
    btn.addEventListener("click", () => {
        document.querySelector(btn.dataset.target).classList.remove("hidden");
        overlay.classList.remove("hidden");
    });
});

close_modals.forEach((btn) => {
    btn.addEventListener("click", () => {
        const modal = btn.closest(".modal_window");
        modal.classList.add("hidden");
        overlay.classList.add("hidden");
    });
});

window.onclick = (event) => {
    if (event.target == overlay) {
        const modals = document.querySelectorAll(".modal_window");
        modals.forEach((modal) => modal.classList.add("hidden"));
        overlay.classList.add("hidden");
    }
};