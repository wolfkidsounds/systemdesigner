import Shepherd from 'shepherd.js';


const tour = new Shepherd.Tour({

    useModalOverlay: true,
    defaultStepOptions: {
      classes: 'z-9999 shadow p-3 bg-body rounded',
      scrollTo: true
    }

});

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

tour.addStep({

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

tour.addStep({

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

tour.addStep({

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