import Shepherd from 'shepherd.js';


const tour = new Shepherd.Tour({

    useModalOverlay: true,
    defaultStepOptions: {
      classes: 'z-9999 shadow p-3 bg-body rounded',
      scrollTo: true
    }

});

tour.addStep({

    text: 'This is the toolbar.',
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

    text: 'Use this button to get back to the overview.',
    attachTo: {
      element: '.shepherd-back',
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

    text: 'Use this button to view additional settings.',
    attachTo: {
      element: '.shepherd-toolbar-settings',
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

    text: 'Use this button to view information about the limiter timing suggestions.',
    attachTo: {
      element: '.shepherd-time',
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

    text: 'Use this button to view some useful information about the calcualtion process.',
    attachTo: {
      element: '.shepherd-details',
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

  text: 'This is the selector. The calculation only starts if a processor, amplifier and speaker are selected.',
  attachTo: {
    element: '.shepherd-selector',
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

    text: 'These fields show you the results of the calculation. The Value field is what you need to enter into your processor.',
    attachTo: {
      element: '.shepherd-fields',
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

    text: 'The messagebox shows you additional message where "!" is a critical message or error and "#" represents an information.',
    attachTo: {
      element: '.shepherd-messagebox',
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

  text: 'Use the save button to put the entry into the database for easy access.',
  attachTo: {
    element: '.shepherd-save',
    on: 'bottom'
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