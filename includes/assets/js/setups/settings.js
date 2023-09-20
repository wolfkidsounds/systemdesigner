const parallelCheckboxes = document.querySelectorAll('.parallel_mode');
const bridgeCheckboxes = document.querySelectorAll('.bridge_mode');

parallelCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const dataId = checkbox.getAttribute('data-id'); // Get the data-id attribute

        if (checkbox.checked) {
            // When checkbox is checked, apply the 'parallel-mode-active' class to the corresponding inputs
            const slotInputs = document.querySelectorAll(`[data-id="${dataId}"].slot-input`);
            slotInputs.forEach((input, index) => {
                if (index % 2 === 1) {
                    input.classList.add('parallel-mode-active');
                }
            });
        } else {
            // When checkbox is unchecked, remove the 'parallel-mode-active' class from the corresponding inputs
            const slotInputs = document.querySelectorAll(`[data-id="${dataId}"].slot-input`);
            slotInputs.forEach((input) => {
                input.classList.remove('parallel-mode-active');
            });
        }
    });
});

bridgeCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function () {
        const dataId = checkbox.getAttribute('data-id'); // Get the data-id attribute

        if (checkbox.checked) {
            // When checkbox is checked, apply the 'parallel-mode-active' class to the corresponding inputs
            const slotInputs = document.querySelectorAll(`[data-id="${dataId}"].slot-output`);
            slotInputs.forEach((input, index) => {
                if (index % 2 === 1) {
                    input.classList.add('bridge-mode-active');
                }
            });
        } else {
            // When checkbox is unchecked, remove the 'parallel-mode-active' class from the corresponding inputs
            const slotInputs = document.querySelectorAll(`[data-id="${dataId}"].slot-output`);
            slotInputs.forEach((input) => {
                input.classList.remove('bridge-mode-active');
            });
        }
    });
});