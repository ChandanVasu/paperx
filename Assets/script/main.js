
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            var mainContent = document.getElementById('main-single-post');
            mainContent.style.transition = 'opacity 0.05s';
            mainContent.style.opacity = '1';
        }, 200); // 200 milliseconds = 0.2 seconds
    });

