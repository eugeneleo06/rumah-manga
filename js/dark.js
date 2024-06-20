$(document).ready(function() {
    // Check if dark mode is enabled in local storage
    if (localStorage.getItem('darkMode') === 'true') {
        $('.navbar-expand-lg').addClass('dark-mode');
        $('body').addClass('dark-mode');
        $('#dark-toggle').removeClass('fa-toggle-off').addClass('fa-toggle-on');
    } else {
        $('.navbar-expand-lg').removeClass('dark-mode');
        $('#dark-toggle').removeClass('fa-toggle-on').addClass('fa-toggle-off');
    }

    // Toggle dark mode on button click
    $('#dark-toggle').on('click', function() {
        $('.navbar-expand-lg').toggleClass('dark-mode');
        $('body').toggleClass('dark-mode');
        const isDarkMode = $('.navbar-expand-lg').hasClass('dark-mode');
        localStorage.setItem('darkMode', isDarkMode);
        if (isDarkMode) {
            $('#dark-toggle').removeClass('fa-toggle-off').addClass('fa-toggle-on');
        } else {
            $('#dark-toggle').removeClass('fa-toggle-on').addClass('fa-toggle-off');
        }
    });
});