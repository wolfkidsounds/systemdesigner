import Shepherd from 'shepherd.js';


const tour = new Shepherd.Tour({

    useModalOverlay: true,
    defaultStepOptions: {
      classes: 'z-9999 shadow p-3 bg-body rounded',
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

    text: 'Enter the model name of the processor (for example: DCX 2496 Pro).',
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

    text: 'Enter the number of inputs the processor has (for example: 2).',
    attachTo: {
      element: '.shepherd-inputs',
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

    text: 'Enter the number of outputs the processor has (for example: 6).',
    attachTo: {
      element: '.shepherd-outputs',
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

    text: 'Enter the "Offset" a processor has (for example: 20). The Offset can be calculated from the maximum output and the maximum limiter setting. Consult the manual of your processor for more information.',
    attachTo: {
      element: '.shepherd-offset',
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

  text: 'Finally save the processor in the database to use it.',
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