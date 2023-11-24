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

    text: 'Select the operating bandwidth of the speaker. If you are not sure what to select here, then "Full Range" is a safe option.',
    attachTo: {
      element: '.shepherd-bandwidth',
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

    text: 'Enter the AES/RMS Power provided by the manufacturer.',
    attachTo: {
      element: '.shepherd-power-rms',
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

    text: 'Enter the Peak Power provided by the manufacturer. If you are not sure what to enter here, this is usually 2x RMS Power.',
    attachTo: {
      element: '.shepherd-power-peak',
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

    text: 'Enter the nominal impedance of your loudspeaker (usually 4, 8 or 16 ohms).',
    attachTo: {
      element: '.shepherd-impedance',
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

    text: 'This is not required but used for future calculations and other features.',
    attachTo: {
      element: '.shepherd-spl',
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