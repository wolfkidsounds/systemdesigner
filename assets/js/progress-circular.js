// Get the circular progress bars
const circularProgressBars = document.querySelectorAll(".progress-bar-circular");

circularProgressBars.forEach(progressBar => {
    const progress = parseFloat(progressBar.getAttribute("data-progress"));
    const max = 10; // Set your max value here

    // Calculate the angle for conic-gradient based on progress and max value
    const angle = (progress / max) * 360;

    // Update the background of the circular progress bar
    progressBar.style.background = `conic-gradient(var(--bs-primary) ${angle}deg, rgba(255,255,255,.1) 0deg)`;
});