const mobileNavBtn = document.getElementById('mobile-nav-btn')
const dropdownMenu = document.getElementById('dropdown-menu')
const mouseEnterArea = document.getElementById('mouse-enter-area')

mobileNavBtn.addEventListener('click', function () {
    if(window.innerWidth <= 1024){
        if (dropdownMenu.style.display !== 'block') {
            dropdownMenu.style.display = 'block';
        } else {
            dropdownMenu.style.display = 'none';
        }
    }
});

mouseEnterArea.addEventListener('mouseenter', function () {
    if(window.innerWidth >= 1024){
        dropdownMenu.style.display = 'flex';
    }
});

dropdownMenu.addEventListener('mouseleave', function () {
    if(window.innerWidth >= 1024){
        dropdownMenu.style.display = 'none';
    }
});