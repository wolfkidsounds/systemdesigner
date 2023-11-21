import Shepherd from 'shepherd.js';


const tour = new Shepherd.Tour({

    useModalOverlay: true,
    defaultStepOptions: {
      classes: 'z-9999 shadow p-3 bg-body rounded ms-3 mt-3',
      scrollTo: true
    }

});

tour.addStep({

    text: 'This is the logo, clicking it results in going back to your dashboard.',
    attachTo: {
      element: '.shepherd-logo',
      on: 'right'
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

tour.addStep({

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

tour.addStep({

  text: 'View your settings here.',
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

tour.addStep({

  text: 'These badges show how many items you have already used.',
  attachTo: {
    element: '.shepherd-badge',
    on: 'right'
  },

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