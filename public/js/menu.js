console.log('Menu script loaded');

  const menu = document.querySelector('.menu-list');
  const closeMenu = document.querySelector('.close-menu');
  const openMenu = document.querySelector('.open-menu');

    openMenu.addEventListener('click', () => {
      console.log('open menu');
      menu.classList.add('open');
    });

    closeMenu.addEventListener('click', () => {
      menu.classList.remove('open');
    });
