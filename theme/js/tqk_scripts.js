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

// 리뷰창 textarea 라인 높이
var textarea = document.getElementById('comment');
var minRows = 4; // 최소 줄 수를 설정하고 이 값에 따라 최소 높이를 설정하세요.
var lineHeight = 19; // 텍스트 라인의 높이를 확인하고 이 값을 설정하세요.

textarea.addEventListener('input', function () {
    this.style.height = 'auto';

    // 최소 높이를 설정하고, 입력된 텍스트 줄 수가 최소 높이를 초과하면 그에 따라 높이를 조정합니다.
    this.style.height = (this.scrollHeight > minRows * lineHeight ? this.scrollHeight : minRows * lineHeight) + 'px';
});

