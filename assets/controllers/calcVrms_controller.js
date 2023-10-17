import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    async calc() {

        const processorId = document.querySelector('#limiter_Processor').value;
        console.log('Processor: ' + processorId);

        const amplifierId = document.querySelector('#limiter_Amplifier').value;
        console.log('Amplifier: ' + amplifierId);

        const speakerId = document.querySelector('#limiter_Speaker').value;
        console.log('Speaker: ' + speakerId);        

        if (speakerId && amplifierId && processorId) {
            var data = {
                processor_id: processorId,   // Use the correct property names for processorId, amplifierId, and speakerId.
                amplifier_id: amplifierId,
                speaker_id: speakerId,
            };
        
            var jsonRequest = JSON.stringify(data);
        
            try {
                const response = await this.fetchData(jsonRequest);
                console.log(response);
        
                // Uncomment and adapt these lines if you want to use the response data
                const vrms = document.querySelector('#limiter_Vrms');
                const vrms_value = document.querySelector('#limiter_VrmsValue');
                const vrms_attack = document.querySelector('#limiter_VrmsAttack');
                const vrms_release = document.querySelector('#limiter_VrmsRelease');

                const vpeak = document.querySelector('#limiter_Vpeak');
                const vpeak_value = document.querySelector('#limiter_VpeakValue');
                const vpeak_attack = document.querySelector('#limiter_VpeakAttack');
                const vpeak_release = document.querySelector('#limiter_VpeakRelease');
                
                vrms.setAttribute('value', response.vrms);
                vrms_value.setAttribute('value', response.vrms_value);
                vrms_attack.setAttribute('value', response.vrms_attack);
                vrms_release.setAttribute('value', response.vrms_release);

                vpeak.setAttribute('value', response.vpeak);
                vpeak_value.setAttribute('value', response.vpeak_value);
                vpeak_attack.setAttribute('value', response.vpeak_attack);
                vpeak_release.setAttribute('value', response.vpeak_release);
            } catch (error) {
                console.error(error);
            }
        }
        
    }
    
    async fetchData(jsonRequest) {
        try {
            const response = await fetch('/api/get/limiter/calculation', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: jsonRequest, // Use 'body' instead of 'data'
            });
    
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
    
            return await response.json();
        } catch (error) {
            throw error;
        }
    }    
}