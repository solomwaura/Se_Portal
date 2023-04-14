function clearSession() {
    $.ajax({
        url: 'clear_session.php',
        success: function() {
            alert('Session cleared!');
        }
    });
}
