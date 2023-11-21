$(document).ready(function() {
   var startTourButton = $("#tourstart");

   if (startTourButton.length) {
       startTourButton.on("click", function() {

           // Assuming tour is available globally
           if (window.tour) {
               window.tour.start();
           } else {
               console.error("Tour is not defined");
           }
           
       });
   }
});