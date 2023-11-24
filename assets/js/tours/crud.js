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

tour.addStep({

    text: 'This is the toolbar. You can find the name on the left side and the menu on the right side.',
    attachTo: {
      element: '.card-header',
      on: 'bottom'
    },

    classes: 'mt-3',
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

    text: 'Clicking the search icon enables you to search the entire table for every field you want.',
    attachTo: {
      element: '.shepherd-search',
      on: 'left'
    },

    classes: 'me-3',
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

  text: 'This is the list of all the items you have created.',
  attachTo: {
    element: '.card-body',
    on: 'bottom'
  },

  classes: 'mt-3',
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

    text: 'Use the + icon to add a new item to your list.',
    attachTo: {
      element: '.shepherd-new',
      on: 'left'
    },

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

  text: 'Click the + icon to add a new item to your list.',
  attachTo: {
    element: '.shepherd-new',
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

addStepIf(isDesktop(), {

  text: 'This is the list of all the items you have created.',
  attachTo: {
    element: '.card-body',
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