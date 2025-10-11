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

// ---- AJAX Cart Functions ----
function addToCart(productId, quantity = 1) {
    // Show loading state
    const addToCartBtn = event.target;
    const originalText = addToCartBtn.textContent;
    addToCartBtn.textContent = 'Adding...';
    addToCartBtn.disabled = true;

    // Make AJAX request
    fetch(window.location.origin + '/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id: productId,
            qty: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.msg_type === 'success') {
            // Update cart count in header
            updateCartCount(data.qty);
            
            // Update cart sidebar
            updateCartSidebar();
            
            // Show success message
            showNotification(data.msg, 'success');
            
            // Open cart sidebar
            const cartSidebar = document.getElementById('cartSidebar');
            const cartOverlay = document.getElementById('cartOverlay');
            if (cartSidebar && cartOverlay) {
                cartSidebar.classList.add('active');
                cartOverlay.classList.add('active');
            }
        } else {
            showNotification(data.msg || 'Error adding to cart', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error adding to cart', 'error');
    })
    .finally(() => {
        // Reset button state
        addToCartBtn.textContent = originalText;
        addToCartBtn.disabled = false;
    });
}

function updateCartCount(qty) {
    // Update cart count in header
    const cartCountElements = document.querySelectorAll('.cart-count, .toolbar-count');
    cartCountElements.forEach(element => {
        element.textContent = qty || 0;
    });
}

function updateCartSidebar() {
    // Fetch cart data and update sidebar
    fetch(window.location.origin + '/cart/data', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        const cartContent = document.querySelector('.cart-content');
        if (cartContent) {
            if (data.cart && data.cart.items && data.cart.items.length > 0) {
                cartContent.innerHTML = generateCartHTML(data.cart);
            } else {
                cartContent.innerHTML = `
                    <img src="${window.location.origin}/theme2/img/cart-cut-icon.svg">
                    <p>No Products In The Cart.</p>
                    <button onclick="window.location.href='${window.location.origin}'"> Return To Shop </button>
                `;
            }
        }
    })
    .catch(error => {
        console.error('Error fetching cart data:', error);
    });
}

function generateCartHTML(cart) {
    let html = '<div class="cart-items">';
    
    cart.items.forEach(item => {
        html += `
            <div class="cart-item" data-product-id="${item.id}">
                <div class="cart-item-image">
                    <img src="${item.image || '/theme2/img/solo.webp'}" alt="${item.name}">
                </div>
                <div class="cart-item-details">
                    <h4>${item.name}</h4>
                    <p class="cart-item-price">Rs: ${item.price}</p>
                    <div class="cart-item-quantity">
                        <button onclick="updateQuantity(${item.id}, ${item.qty - 1})">-</button>
                        <span>${item.qty}</span>
                        <button onclick="updateQuantity(${item.id}, ${item.qty + 1})">+</button>
                    </div>
                </div>
                <div class="cart-item-remove">
                    <button onclick="removeFromCart(${item.id})" class="remove-btn">&times;</button>
                </div>
            </div>
        `;
    });
    
    html += `
        </div>
        <div class="cart-total">
            <h3>Total: Rs: ${cart.amount}</h3>
            <p>${cart.qty} item(s) in cart</p>
        </div>
        <div class="cart-actions">
            <button onclick="window.location.href='${window.location.origin}/checkout'" class="checkout-btn">Checkout</button>
            <button onclick="window.location.href='${window.location.origin}'" class="continue-shopping-btn">Continue Shopping</button>
        </div>
    `;
    
    return html;
}

function updateQuantity(productId, newQuantity) {
    if (newQuantity < 1) {
        removeFromCart(productId);
        return;
    }
    
    fetch(window.location.origin + '/cart/increment', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        updateCartSidebar();
        updateCartCount(data.qty);
    })
    .catch(error => {
        console.error('Error updating quantity:', error);
    });
}

function removeFromCart(productId) {
    fetch(`${window.location.origin}/cart/remove/${productId}`, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        updateCartSidebar();
        showNotification('Item removed from cart', 'success');
    })
    .catch(error => {
        console.error('Error removing item:', error);
    });
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        z-index: 10000;
        animation: slideIn 0.3s ease;
        max-width: 300px;
    `;
    
    // Set background color based on type
    const colors = {
        success: '#28a745',
        error: '#dc3545',
        info: '#17a2b8',
        warning: '#ffc107'
    };
    notification.style.backgroundColor = colors[type] || colors.info;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Add CSS for notifications
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    .cart-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }
    .cart-item-image {
        width: 60px;
        height: 60px;
        margin-right: 10px;
    }
    .cart-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 5px;
    }
    .cart-item-details {
        flex: 1;
    }
    .cart-item-details h4 {
        margin: 0 0 5px 0;
        font-size: 14px;
    }
    .cart-item-price {
        margin: 0 0 10px 0;
        font-weight: bold;
        color: #333;
    }
    .cart-item-quantity {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .cart-item-quantity button {
        width: 25px;
        height: 25px;
        border: 1px solid #ddd;
        background: white;
        cursor: pointer;
        border-radius: 3px;
    }
    .cart-item-remove .remove-btn {
        background: #dc3545;
        color: white;
        border: none;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        cursor: pointer;
    }
    .cart-total {
        padding: 15px;
        border-top: 2px solid #eee;
        text-align: center;
    }
    .cart-actions {
        padding: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    .checkout-btn, .continue-shopping-btn {
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .checkout-btn {
        background: #007bff;
        color: white;
    }
    .continue-shopping-btn {
        background: #6c757d;
        color: white;
    }
`;
document.head.appendChild(style);

// Initialize cart on page load
document.addEventListener('DOMContentLoaded', function() {
    updateCartSidebar();
});

