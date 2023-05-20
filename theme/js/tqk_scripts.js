const mobileNavBtn = document.getElementById('mobile-nav-btn')
const dropdownMenu = document.getElementById('dropdown-menu')
const mouseEnterArea = document.getElementById('mouse-enter-area')

mobileNavBtn.addEventListener('click', function () {
    if (dropdownMenu.style.display !== 'block') {
        dropdownMenu.style.display = 'block';
    } else {
        dropdownMenu.style.display = 'none';
    }
});

mouseEnterArea.addEventListener('mouseenter', function () {
    dropdownMenu.style.display = 'flex';
});

dropdownMenu.addEventListener('mouseleave', function () {
    dropdownMenu.style.display = 'none';
});