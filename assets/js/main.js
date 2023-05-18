window.onload = () => {
    let btnHeader = document.getElementsByClassName('header-display')[0]
    btnHeader.addEventListener('click', displayMenu)
}
function displayMenu() {
    
    var img = 'assets/img/'
    let padding = 0;
    if (!this.src.includes('closemenu')) {
        img += 'closemenu.svg';
        padding = '5px';
    } else img += 'menu.svg';

    this.src = img
    this.style.padding = padding

    const header = document.getElementsByClassName('header')[0]
    if (header.style.display != 'flex') {
        header.style.display = 'flex';
    } else {
        header.style.display = 'none';
    }
}