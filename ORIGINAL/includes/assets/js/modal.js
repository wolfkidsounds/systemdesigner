$(document).ready(function() {
    // Listen for clicks on the "Close" button inside the modal
    $('.close-modal').on('click', function() {
      // Find the modal element with the class "modal" and remove the "active" property
      $('.modal').removeClass('active');
    });
    
});