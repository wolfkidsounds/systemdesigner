<link rel="stylesheet" href="/includes/assets/css/new_item.css">
<link rel="stylesheet" href="/includes/assets/css/new_limiter.css">

<?php //new/limiter.php

require_once VIEWSPATH . "partials/inc_partials.php";
Partials::Open();
Partials::Header(true, true);

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    header("Location: /app/brands");

} else {

    ?>
    
    <h3>New Limiter (Easy Mode)</h3>
    <form name="new_limiter" method="post" action="/app/new/limiter">

    <div class="form-group">
        <div class="new_limiter_form">

            <div class="form-divider">
                <div style="grid-column:1/2;" class="processor form-element-tooltip">
                    <h6>Processor</h6>
                    <div class="tooltip tooltip-right" data-tooltip="Select the processor">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <select class="form-select select2js" id="processor" name="processor">
                        <option>Select Processor...</option>
                        <?php 
                            $processors = Functions::Processors()->getAll();

                            foreach ($processors as $processor) {
                                $brand_id = $processor["brand_id"];
                                $brand = Functions::Brands()->get($brand_id);
                                ?>
                                <option data-id="<?php out($processor["id"]); ?>" value="<?php out($processor["id"]); ?>"><?php out($brand["name"] . " - " . $processor["name"]); ?></option>
                            <?php } ?>                        
                    </select>
                </div>
                
                <div style="grid-column:2/3;" class="amplifier form-element-tooltip">
                    <h6>Amplifier</h6>
                    <div class="tooltip tooltip-left" data-tooltip="Select the amplifier">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <select class="form-select select2js" id="amplifier" name="amplifier">
                        <option>Select Amplifier...</option>
                        <?php 
                            $amplifiers = Functions::Amplifiers()->getAll();

                            foreach ($amplifiers as $amplifier) {
                                $brand_id = $amplifier["brand_id"];
                                $brand = Functions::Brands()->get($brand_id);
                                ?>
                                <option value="<?php out($amplifier["id"]); ?>"><?php out($brand["name"] . " - " . $amplifier["name"]); ?></option>
                            <?php } ?>                        
                    </select>
                </div>

                <div style="grid-column:3/4;" class="speaker form-element-tooltip">
                    <h6>Speaker</h6>
                    <div class="tooltip tooltip-left" data-tooltip="Select the speaker">
                        <i class="fa-solid fa-question"></i>
                    </div>
                    <select class="form-select select2js" id="speaker" name="speaker">
                        <option>Select Speaker...</option>
                        <?php 
                            $speakers = Functions::Speakers()->getAll();

                            foreach ($speakers as $speaker) {
                                $brand_id = $speaker["brand_id"];
                                $brand = Functions::Brands()->get($brand_id);
                                ?>
                                <option value="<?php out($speaker["id"]); ?>"><?php out($brand["name"] . " - " . $speaker["name"]); ?></option>
                            <?php } ?>                        
                    </select>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="form-divider"></div>
        <div class="new_limiter_form">
            <h6>Configuration</h6>
            <div class="form-divider">
                <div style="grid-column:1/2;" class="form-element-tooltip">
                    <h6>Amplifier in Bridge Mode?</h6>
                    <select class="form-select" id="bridge-mode" name="bridge-mode">
                        <option value="false">No</option>
                        <option value="true">Yes</option>                     
                    </select>
                </div>
                <div style="grid-column:2/3;" class="form-element-tooltip">
                    <h6>Input Sensitivity</h6>
                    <div class="input-group">
                        <input class="form-input" type="number" step="0.001" id="input-sens" name="input-sens" value="0.775">
                        <span class="input-group-addon addon-sm">V</span>
                    </div>
                </div>
                <div style="grid-column:3/4;" class="form-element-tooltip">
                    <h6>Speakers in Parallel</h6>
                    <select class="form-select" id="speakers-parallel" name="speakers-parallel">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>                     
                    </select>
                </div>
                <!-- <div style="grid-column:4/5;" class="form-element-tooltip">
                     <h6>Scaling</h6>
                    <div class="input-group">
                        <input class="form-input" type="number" id="scaling" name="scaling" value="75" min="50" max="100" placeholder="Scaling">
                        <span class="input-group-addon addon-sm">%</span>
                    </div>
                    
                </div> -->                
            </div> 
        </div>
    <hr>
    <div class="form-divider"></div>
        <div class="new_limiter_form">
            <div class="form-divider">
                <div style="grid-column:1/2;" class="form-element-tooltip">
                    <h6>Power Request</h6>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="table-term">Peak Power</td>
                                <td class="table-value apr_power_peak"></td>
                                <td class="table-symbol">W</td>
                            </tr>
                            <tr>
                                <td class="table-term">RMS Power</td>
                                <td class="table-value apr_power_rms"></td>
                                <td class="table-symbol">W</td>
                            </tr>
                            <tr>
                                <td class="table-term">Impedance</td>
                                <td class="table-value apr_impedance"></td>
                                <td class="table-symbol">Ω</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="grid-column:2/3;" class="form-element-tooltip">
                </div>

                <div style="grid-column:3/4;" class="form-element-tooltip">
                    <div class="form-divider"></div>
                    <h6>Peak Limiter</h6>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="table-term">Peak Voltage</td>
                                <td class="table-value lim_peak_v"></td>
                                <td class="table-symbol">V</td>
                            </tr>
                            <tr>
                                <td class="table-term">Peak Limiter Value</td>
                                <td class="table-value lim_peak_value"></td>
                                <td class="table-symbol">dBu</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="form-divider"></div>
                    <h6>Power/RMS Limiter</h6>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="table-term">RMS Voltage</td>
                                <td class="table-value lim_rms_v"></td>
                                <td class="table-symbol">V</td>
                            </tr>
                            <tr>
                                <td class="table-term">RMS Limiter Value</td>
                                <td class="table-value lim_rms_value"></td>
                                <td class="table-symbol">dBu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>

<script src="/node_modules\jquery\dist\jquery.min.js"></script>
<script src="/node_modules\select2\dist\js\select2.min.js"></script>
<script src="/includes\assets\js\select2.js"></script>

<script>
    $(document).ready(function () {
        $('#processor').on('change', function () {

            var processorID = $('#processor').val();
            var load = $('.processor');

            var requestData = {
                processor_id: processorID,
                http_user_token: '<?php out($_SESSION["HTTP_USER_TOKEN"]); ?>'
            };

            load.addClass("loading");
            $.ajax({
                type: 'POST',
                url: '/api/get/processor',
                dataType: 'json',
                data: JSON.stringify(requestData),
                contentType: 'json',
                success: function (data) {
                    console.log("Response Data:", data);
                    $('.proc_inputs').text(data.ch_inputs);
                    $('.proc_outputs').text(data.ch_outputs);
                    $('.proc_offset').text(data.proc_offset);
                    load.removeClass("loading");
                },
                error: function (xhr, status, error, data) {
                    console.log("Response Data:", data);
                    console.log("Ajax error:", status, error);
                    alert('Failed to fetch processor data.');
                    load.removeClass("loading");
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#amplifier').on('change', function () {

            var amplifierID = $('#amplifier').val();
            var load = $('.amplifier');

            var requestData = {
                amplifier_id: amplifierID,
                http_user_token: '<?php out($_SESSION["HTTP_USER_TOKEN"]); ?>'
            };

            load.addClass("loading");
            $.ajax({
                type: 'POST',
                url: '/api/get/amplifier',
                dataType: 'json',
                data: JSON.stringify(requestData),
                contentType: 'json',
                success: function (data) {
                    console.log("Response Data:", data);
                    $('.amp_height').text(data.rack_units);
                    $('.amp_channels').text(data.ch_outputs);
                    $('.amp_power_8').text(data.amp_power_8);
                    $('.amp_power_4').text(data.amp_power_4);
                    $('.amp_power_2').text(data.amp_power_2);
                    $('.amp_power_bridge_8').text(data.amp_power_bridge_8);
                    $('.amp_power_bridge_4').text(data.amp_power_bridge_4);
                    load.removeClass("loading");
                },
                error: function (xhr, status, error, data) {
                    console.log("Response Data:", data);
                    console.log("Ajax error:", status, error);
                    alert('Failed to fetch amplifier data.');
                    load.removeClass("loading");
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#speaker').on('change', function () {

            var speakerID = $('#speaker').val();
            var load = $('.speaker');

            var requestData = {
                speaker_id: speakerID,
                http_user_token: '<?php out($_SESSION["HTTP_USER_TOKEN"]); ?>'
            };

            load.addClass("loading");
            $.ajax({
                type: 'POST',
                url: '/api/get/speaker',
                dataType: 'json',
                data: JSON.stringify(requestData),
                contentType: 'json',
                success: function (data) {
                    console.log("Response Data:", data);
                    $('.speak_impedance').text(data.impedance);
                    $('.speak_power_rms').text(data.power_rms);
                    $('.speak_power_program').text(data.power_program);
                    $('.speak_power_peak').text(data.power_peak);
                    $('.speak_spl').text(data.sensitivity);
                    $('.speak_max_spl').text(data.max_spl);
                    $('.speak_bandwidth').text(data.bandwidth);
                    load.removeClass("loading");
                },
                error: function (xhr, status, error, data) {
                    console.log("Response Data:", data);
                    console.log("Ajax error:", status, error);
                    alert('Failed to fetch speaker data.');
                    load.removeClass("loading");
                }
            });
        });
    });
</script>

<script>

$(document).ready(function () {
    function areAllOptionsSelected() {
        var processorValue = $('#processor').val();
        var amplifierValue = $('#amplifier').val();
        var speakerValue = $('#speaker').val();

        return (
            processorValue !== null && processorValue !== "Select Processor..." &&
            amplifierValue !== null && amplifierValue !== "Select Amplifier..." &&
            speakerValue !== null && speakerValue !== "Select Speaker..."
        );
    };

    function calculateLimiters() {
        if (areAllOptionsSelected()) {
            var processorID = $('#processor').val();
            var amplifierID = $('#amplifier').val();
            var speakerID = $('#speaker').val();
            var inputSens = $('#input-sens').val();
            //var scaling = $('#scaling').val();
            var bridgeMode = $('#bridge-mode').val();
            var speakersParallel = $('#speakers-parallel').val();

            var requestData = {
                processor_id: processorID,
                amplifier_id: amplifierID,
                speaker_id: speakerID,
                input_sensitivity: inputSens,
                //scaling: scaling,
                bridge_mode: bridgeMode,
                speakers_in_parallel: speakersParallel,
                http_user_token: '<?php out($_SESSION["HTTP_USER_TOKEN"]); ?>'
            };

            var load = $('.limiter');
            load.addClass("loading");

            $.ajax({
                type: 'POST',
                url: '/api/get/limiter/calc',
                dataType: 'json',
                data: JSON.stringify(requestData),
                contentType: 'json',
                success: function (data) {
                    console.log("Response Data:", data);
                    $('.apr_power_peak').text(data.apr_power_peak);
                    $('.apr_power_rms').text(data.apr_power_rms);
                    $('.apr_impedance').text(data.apr_impedance);
                    $('.lim_peak_value').text(data.lim_peak_value);
                    $('.lim_rms_value').text(data.lim_rms_value);
                    $('.lim_peak_v').text(data.lim_vpeak);
                    $('.lim_rms_v').text(data.lim_vrms);

                    // $('.apr_vpeak').text(data.apr_vpeak);
                    // $('.apr_vrms').text(data.apr_vrms);
                    // $('.apr_apeak').text(data.apr_apeak);
                    // $('.apr_arms').text(data.apr_arms);
                    // $('.lim_factor_peak').text(data.lim_factor_peak);
                    // $('.lim_factor_rms').text(data.lim_factor_rms);
                    // $('.lim_clip_v').text(data.lim_clip_v);
                    
                    // $('.lim_peak_attack').text(data.lim_peak_attack);
                    // $('.lim_peak_release').text(data.lim_peak_release);
                    // $('.lim_rms_attack').text(data.lim_rms_attack);
                    // $('.lim_rms_release').text(data.lim_rms_release);

                    // $('.apr_single').text(data.apr_single);
                    // $('.apr_bridge').text(data.apr_bridge);
                    // $('.lup_single').text(data.lup_single);
                    // $('.lup_bridge').text(data.lup_bridge);
                    // $('.lup_headroom_single').text(data.lup_headroom_single);
                    // $('.lup_headroom_bridge').text(data.lup_headroom_bridge);

                    load.removeClass("loading");
                },
                error: function (xhr, status, error, data) {
                    console.log("Response Data:", data);
                    console.log("Ajax error:", status, error);
                    alert('Failed to fetch speaker data.');
                    load.removeClass("loading");
                }
            });
        }
        
    };

    $('#processor, #amplifier, #speaker, #bridge-mode, #input-sens, #speakers-parallel, #scaling').change(function () {
        calculateLimiters();
    });
});

</script>

    <?php } ?>

<?php Partials::Close(); ?>