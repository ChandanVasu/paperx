
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        var mainContent = document.getElementById('main-single-post');
        mainContent.style.transition = 'opacity 0.05s';
        mainContent.style.opacity = '1';
    }, 100); // 200 milliseconds = 0.2 seconds
});



function callHamburger() {
    var header = document.querySelector('.header-content-vasutheme');
    if (header) {
        header.style.position = 'sticky';
        header.style.top = '0';
        header.style.zIndex = '1000'; // Adjust z-index as needed
    }

    var body = document.querySelector('body');
    if (body) {
        var menu = document.querySelector('.paper-header-menu-mobile');
        if (menu) {
            if (menu.style.display === 'block') {
                body.style.overflow = 'auto'; // Restore body scroll
            } else {
                body.style.overflow = 'hidden'; // Turn off body scroll
            }
        }
    }

    var headerarea = document.querySelector('.header-content-vasutheme');
    var adminarea = document.getElementById("wpadminbar");

    var menu = document.querySelector('.paper-header-menu-mobile');

    if (headerarea && menu) {
        var headerHeight = headerarea.clientHeight || 0;
        var adminHeight = adminarea ? adminarea.clientHeight : 0;

        menu.style.top = headerHeight + adminHeight + 2 + 'px'; // Set top position based on header height
        menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';

        // alert(headerHeight + adminHeight + 'px');
    }
    else {
        alert("Header or admin bar height not found.");
    }


    var menuIcon = document.querySelector('.image-menu-icon');
      var closeIcon = document.querySelector('.image-menu-close-icon');

      if (menu.style.display === 'block') {
        menuIcon.style.display = 'none';
        closeIcon.style.display = 'block';
      } else {
        menuIcon.style.display = 'block';
        closeIcon.style.display = 'none';
      }
}


document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.paper-header-menu li .sub-menu').forEach(subMenu => {
      let timeoutId;
  
      const showSubMenu = () => {
        clearTimeout(timeoutId);
        subMenu.style.display = 'block';
      };
  
      const hideSubMenuWithDelay = () => {
        timeoutId = setTimeout(() => subMenu.style.display = 'none', 250); // 3 second delay
      };
  
      subMenu.parentElement.addEventListener('mouseenter', showSubMenu);
      subMenu.parentElement.addEventListener('mouseleave', hideSubMenuWithDelay);
    });
  });
  
  