// ---- image slider ---- 
(() => {
    const track = document.getElementById('track');
    const slider = document.getElementById('slider');
    if (track && slider) {   // ✅ only run if both exist
        const slides = Array.from(track.children);
        let index = 0;
        let isDown = false;
        let startX = 0;
        let currentTranslate = 0;
        let prevTranslate = 0;
        let pointerId = null;

        const width = () => slider.clientWidth;

        function setTranslate(x, animate = true) {
            track.style.transition = animate ? 'transform 0.3s ease' : 'none';
            track.style.transform = `translateX(${x}px)`;
        }

        function pointerDown(e) {
            if (e.pointerType === 'mouse' && e.button !== 0) return;
            isDown = true;
            pointerId = e.pointerId;
            track.setPointerCapture(pointerId);
            track.classList.add('grabbing');
            startX = e.clientX;
            prevTranslate = -index * width();
            currentTranslate = prevTranslate;
            setTranslate(currentTranslate, false);
        }

        function pointerMove(e) {
            if (!isDown || e.pointerId !== pointerId) return;
            const dx = e.clientX - startX;
            currentTranslate = prevTranslate + dx;
            setTranslate(currentTranslate, false);
        }

        function pointerUp(e) {
            if (!isDown || e.pointerId !== pointerId) return;
            isDown = false;
            track.releasePointerCapture(pointerId);
            track.classList.remove('grabbing');

            const movedBy = currentTranslate - prevTranslate;
            const threshold = width() * 0.20;

            if (movedBy < -threshold && index < slides.length - 1) index++;
            else if (movedBy > threshold && index > 0) index--;

            prevTranslate = -index * width();
            setTranslate(prevTranslate, true);
        }

        track.addEventListener('pointerdown', pointerDown);
        track.addEventListener('pointermove', pointerMove);
        track.addEventListener('pointerup', pointerUp);
        track.addEventListener('pointercancel', pointerUp);
        track.addEventListener('lostpointercapture', pointerUp);

        window.addEventListener('resize', () => {
            prevTranslate = -index * width();
            setTranslate(prevTranslate, true);
        });

        slides.forEach(s => {
            const img = s.querySelector('img');
            if (img) img.addEventListener('dragstart', e => e.preventDefault());
        });

        prevTranslate = -index * width();
        setTranslate(prevTranslate, true);
    }
})();


// ---- cart open ----   
const openCartBtns = document.querySelectorAll('.openCart');
const closeCartBtn = document.getElementById('closeCart');
const cartSidebar = document.getElementById('cartSidebar');
const cartOverlay = document.getElementById('cartOverlay');

if (openCartBtns.length && cartSidebar && cartOverlay) {
    openCartBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            cartSidebar.classList.add('active');
            cartOverlay.classList.add('active');
        });
    });

    if (closeCartBtn) {
        closeCartBtn.addEventListener('click', () => {
            cartSidebar.classList.remove('active');
            cartOverlay.classList.remove('active');
        });
    }

    cartOverlay.addEventListener('click', () => {
        cartSidebar.classList.remove('active');
        cartOverlay.classList.remove('active');
    });
}


// ---- open menu ---- 
    const openBtnDesktop = document.getElementById('openMenuDesktop');
    const openBtnMobile = document.getElementById('openMenuMobile');
    const closeBtn = document.getElementById('closeMenu');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    if (sidebar && overlay) {
        function openSidebar() {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        }

        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }

        if (openBtnDesktop) openBtnDesktop.addEventListener('click', openSidebar);
        if (openBtnMobile) openBtnMobile.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);
    }


    document.addEventListener("DOMContentLoaded", function () {
    const toggles = document.querySelectorAll(".toggle-submenu");

    // ✅ Run only if sidebar submenu toggles exist
    if (toggles.length > 0) {
        toggles.forEach(toggle => {
            toggle.addEventListener("click", function () {
                const submenu = this.nextElementSibling;

                if (submenu && submenu.classList.contains("submenu")) {
                    submenu.classList.toggle("active");
                }

                // rotate arrow
                this.classList.toggle("open");
            });
        });
    }
});


// ---- single product slider ---- 
document.querySelectorAll(".slider-wrapper").forEach(wrapper => {
    const productsSection = wrapper.querySelector(".products-section");
    const prevBtn = wrapper.querySelector(".prev");
    const nextBtn = wrapper.querySelector(".next");
    const productWidthEl = wrapper.querySelector(".single-product-section");

    if (!productsSection || !prevBtn || !nextBtn || !productWidthEl) return;

    const productWidth = productWidthEl.offsetWidth;
    const visibleProducts = 6;
    let currentIndex = 0;
    const totalProducts = wrapper.querySelectorAll(".single-product-section").length;
    const maxIndex = Math.max(0, totalProducts - visibleProducts);

    function updateSlider() {
        productsSection.style.transform = `translateX(-${currentIndex * productWidth}px)`;
        productsSection.style.transition = "transform 0.4s ease-in-out";
    }

    nextBtn.addEventListener("click", () => {
        if (currentIndex < maxIndex) {
            currentIndex++;
            updateSlider();
        }
    });

    prevBtn.addEventListener("click", () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    });

    // ---- Mouse drag (swipe) support ----
    let isDragging = false, startX = 0, scrollStart = 0;

    productsSection.addEventListener("mousedown", e => {
        isDragging = true;
        startX = e.pageX;
        scrollStart = currentIndex * productWidth;
        productsSection.style.transition = "none";
    });

    productsSection.addEventListener("mousemove", e => {
        if (!isDragging) return;
        const dx = e.pageX - startX;
        productsSection.style.transform = `translateX(${-(scrollStart - dx)}px)`;
    });

    productsSection.addEventListener("mouseup", e => {
        if (!isDragging) return;
        isDragging = false;
        const dx = e.pageX - startX;
        if (dx < -50 && currentIndex < maxIndex) currentIndex++;
        else if (dx > 50 && currentIndex > 0) currentIndex--;
        updateSlider();
    });

    productsSection.addEventListener("mouseleave", () => {
        if (isDragging) {
            isDragging = false;
            updateSlider();
        }
    });
});

    //-- tab-open--

    document.addEventListener("DOMContentLoaded", () => {
        const tabLinks = document.querySelectorAll(".tab-link");
        const tabContents = document.querySelectorAll(".tab-content");

        if (tabLinks.length && tabContents.length) {
            tabLinks.forEach(link => {
                link.addEventListener("click", () => {
                    // Remove active from all
                    tabLinks.forEach(l => l.classList.remove("active"));
                    tabContents.forEach(c => c.classList.remove("active"));

                    // Add active to clicked tab
                    link.classList.add("active");
                    const target = document.getElementById(link.dataset.tab);
                    if (target) target.classList.add("active"); // ✅ only if element exists
                });
            });
        }
    });

    //--write a review--//

        document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("toggleReviewForm");
        const reviewForm = document.getElementById("reviewForm");

        if (toggleBtn && reviewForm) {  
            toggleBtn.addEventListener("click", function () {
            reviewForm.style.display = (reviewForm.style.display === "none" || reviewForm.style.display === "") 
                ? "block" 
                : "none";
            });
        }
        });


        document.addEventListener("DOMContentLoaded", function() {
            // check if this section exists on the page
            let mainImage = document.getElementById("mainProductImage");
            let thumbnails = document.querySelectorAll(".single-page-product-image-section img");

            if (mainImage && thumbnails.length > 0) {
                thumbnails.forEach(img => {
                    img.addEventListener("click", function() {
                        // update main image
                        mainImage.src = this.src;

                        // reset borders
                        thumbnails.forEach(t => t.style.border = "2px solid #F0F0F0");

                        // set active border
                        this.style.border = "2px solid #000";
                    });
                });

                // ✅ make first thumbnail active by default
                thumbnails[0].style.border = "2px solid #000";
            }
        });




