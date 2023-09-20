<div class="modal-container">
    <div class="modal-header">
        <a href="#close" class="btn btn-clear float-right close-modal" aria-label="Close"></a>
        <div class="modal-title h5">New Slot</div>
    </div>
    <div class="modal-body">
        <div class="content">
            <div class="form-group item-selector">
                <label class="form-checkbox">
                    <input id="show_processors" type="checkbox" checked>
                    <i class="form-icon"></i> Show Processors
                </label>
                <label class="form-checkbox">
                    <input id="show_amplifiers" type="checkbox" checked>
                    <i class="form-icon"></i> Show Amplifiers
                </label>
            </div>
            <?php
                $amplifiers = Functions::Amplifiers()->getAllAmplifiers();
                $processors = Functions::Processors()->getAllProcessors();
            ?>
            <div class="form-container">
                <div class="form-divider"></div>
                <div class="form-group">
                    <select class="form-select js-select">
                        <option>Select Processor</option>
                        <?php
                            foreach ($processors as $processor) {
                                $brand_id = $processor["proc_brand_id"];
                                $brand = Functions::Brands()->getBrand($brand_id);
                                $brand_name = $brand["brand_name"];
                                $amp_name = $processor["proc_model_name"];
                                $amp_id = $amplifier["id"];
                            ?>
                            <option data-amplifier="<?php out($amp_id); ?>"><?php out($brand_name . " - " . $amp_name); ?></option>
                            <?php } ?>
                    </select>
                </div>
                <div class="form-divider"></div>
                <div class="form-group">
                    <select class="form-select js-select">
                        <option>Select Amplifier</option>
                        <?php
                            foreach ($amplifiers as $amplifier) {
                                $brand_id = $amplifier["amp_brand"];
                                $brand = Functions::Brands()->getBrand($brand_id);
                                $brand_name = $brand["brand_name"];
                                $amp_name = $amplifier["amp_model"];
                                $amp_id = $amplifier["id"];
                            ?>
                            <option data-amplifier="<?php out($amp_id); ?>"><?php out($brand_name . " - " . $amp_name); ?></option>
                            <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
    </div>
</div>
<script src="/node_modules\select2\dist\js\select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-select').select2();
});
</script>