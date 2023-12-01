import Shepherd from 'shepherd.js';

const tour = new Shepherd.Tour({

  useModalOverlay: true,
  defaultStepOptions: {
    classes: 'z-9999 shadow p-3 fs-12 bg-body rounded w-75',
    scrollTo: true
  }

});

// Function to check if the device is a desktop
function isDesktop() {
  return window.innerWidth >= 992; // Adjust the width as needed
}

// Function to add a step based on device type
function addStepIf(condition, step) {
  if (condition) {
    tour.addStep(step);
  }
}

addStepIf(isDesktop(), {

    id: 'logo-desktop',
    text: 'This is the logo, clicking it results in going back to your dashboard.',
    attachTo: {
      element: '.shepherd-logo',
      on: 'right'
    },

    classes: 'ms-3 mt-3',
    buttons: [
      {
        classes: 'btn btn-primary mt-3 me-3',
        text: 'Next',
        action: tour.next
      },
      {
        classes: 'btn btn-secondary mt-3',
        text: 'Cancel',
        action: tour.cancel
      }
    ]

});

addStepIf(isDesktop(), {

  text: 'This is the main menu. Select an item to view the contents.',
  attachTo: {
    element: '.shepherd-menu',
    on: 'right'
  },

  classes: 'ms-4',
  buttons: [
    {
      classes: 'btn btn-primary mt-3 me-3',
      text: 'Next',
      action: tour.next
    },
    {
      classes: 'btn btn-secondary mt-3',
      text: 'Cancel',
      action: tour.cancel
    }
  ]

});

addStepIf(!isDesktop(), {

  text: 'This is the main menu. Select an item to view the contents. Click the far left purple icon to go back to the dashboard.',
  attachTo: {
    element: '.shepherd-menu',
    on: 'top'
  },

  classes: 'mb-4',
  buttons: [
    {
      classes: 'btn btn-primary mt-3 me-3',
      text: 'Next',
      action: tour.next
    },
    {
      classes: 'btn btn-secondary mt-3',
      text: 'Cancel',
      action: tour.cancel
    }
  ]

});

addStepIf(isDesktop(), {

  text: 'This is the options menu. View Notifications, Settings and the FAQ here.',
  attachTo: {
    element: '.shepherd-settings',
    on: 'right'
  },

  classes: 'ms-4',
  buttons: [
    {
      classes: 'btn btn-primary mt-3 me-3',
      text: 'Next',
      action: tour.next
    },
    {
      classes: 'btn btn-secondary mt-3',
      text: 'Cancel',
      action: tour.cancel
    }
  ]

});

addStepIf(isDesktop(), {

  text: 'These badges show the amount of items you have used and how many items are still available.',
  attachTo: {
    element: '.shepherd-badge',
    on: 'right'
  },

  classes: 'ms-3',
  buttons: [
    {
      classes: 'btn btn-primary mt-3 me-3',
      text: 'End Tour',
      action: tour.next
    },
    {
      classes: 'btn btn-secondary mt-3',
      text: 'Cancel',
      action: tour.cancel
    }
  ]

});

addStepIf(!isDesktop(), {

  text: 'These badges show the amount of items you have used and how many items are still available.',
  attachTo: {
    element: '.shepherd-badge',
    on: 'bottom'
  },

  classes: 'mt-3',
  buttons: [
    {
      classes: 'btn btn-primary mt-3 me-3',
      text: 'End Tour',
      action: tour.next
    },
    {
      classes: 'btn btn-secondary mt-3',
      text: 'Cancel',
      action: tour.cancel
    }
  ]

});

window.tour = tour;