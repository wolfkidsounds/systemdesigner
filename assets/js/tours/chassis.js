import Shepherd from 'shepherd.js';


const tour = new Shepherd.Tour({

    useModalOverlay: true,
    defaultStepOptions: {
      classes: 'z-9999 shadow p-3 fs-12 bg-body rounded w-75',
      scrollTo: true
    }

});

tour.addStep({

    text: 'This is the toolbar. Click the arrow on the right side to go back to the overview.',
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

  text: 'Select a manufacturer. If the menu is empty you need to create one first.',
  attachTo: {
    element: '.shepherd-manufacturer',
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

    text: 'Enter the model name of the amplifier (for example: E-800).',
    attachTo: {
      element: '.shepherd-name',
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

    text: 'Enter the power values. For empty values enter "0". ',
    attachTo: {
      element: '.shepherd-power',
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

    text: 'Enter the power values for bridge mode. For emtpy values enter "0".',
    attachTo: {
      element: '.shepherd-power-bridge',
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

    text: 'Upload a Manual in PDF file format. The Manual is used for verification as well as usefull for quick access.',
    attachTo: {
      element: '.shepherd-manual',
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

  text: 'Finally save the amplifier in the database to use it.',
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