<?php
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;

function askMedicalQuestion($botman, $conversation)
{
    $conversation->ask('Would you like to ask about medical equipment? If yes, type your question.', function (Answer $answer, $conversation) use ($botman) {
        $question = strtolower($answer->getText());

        switch ($question) {
            case 'what is an x-ray machine?':
                $conversation->say("An X-ray machine is used to take images of the inside of the body, especially bones.");
                break;

            case 'how does an mri work?':
                $conversation->say("MRI uses strong magnetic fields and radio waves to produce detailed images of the organs and tissues.");
                break;

            case 'what is a defibrillator?':
                $conversation->say("A defibrillator is a device that gives a high-energy electric shock to the heart to treat life-threatening arrhythmias.");
                break;

            case 'what is a ventilator?':
                $conversation->say("A ventilator helps patients breathe by moving air in and out of their lungs when they cannot breathe on their own.");
                break;

            case 'what is an ecg machine?':
                $conversation->say("An ECG machine records the electrical activity of the heart over a period of time.");
                break;

            case 'what does a blood pressure monitor do?':
                $conversation->say("A blood pressure monitor measures the force of blood against your artery walls as your heart pumps.");
                break;

            case 'what is a stethoscope used for?':
                $conversation->say("A stethoscope is used by medical professionals to listen to the internal sounds of a body, especially the heart and lungs.");
                break;

            case 'how does an ultrasound machine work?':
                $conversation->say("An ultrasound machine uses high-frequency sound waves to create images of the inside of the body.");
                break;

            case 'what is a pulse oximeter?':
                $conversation->say("A pulse oximeter is a device that measures the oxygen saturation level of the blood.");
                break;

            case 'what is an infusion pump?':
                $conversation->say("An infusion pump delivers fluids, such as nutrients or medications, into a patient's body in controlled amounts.");
                break;

            case 'what does a glucometer do?':
                $conversation->say("A glucometer measures the blood glucose (sugar) level in a person’s blood.");
                break;

            case 'what is an otoscope?':
                $conversation->say("An otoscope is used to look inside the ears to diagnose ear infections or other issues.");
                break;

            case 'what is an ophthalmoscope?':
                $conversation->say("An ophthalmoscope is used to examine the inside of the eye, especially the retina.");
                break;

            case 'what is a nebulizer?':
                $conversation->say("A nebulizer turns liquid medicine into a mist that can be inhaled directly into the lungs.");
                break;

            case 'what is a dialysis machine?':
                $conversation->say("A dialysis machine filters waste products from the blood when the kidneys are not functioning properly.");
                break;

            case 'what is a sphygmomanometer?':
                $conversation->say("A sphygmomanometer is a device used to measure blood pressure.");
                break;

            case 'what is a thermometer used for?':
                $conversation->say("A thermometer measures the body temperature to detect fever.");
                break;

            case 'what is a surgical laser?':
                $conversation->say("A surgical laser is used to cut tissue or remove surface lesions with precision.");
                break;

            case 'what does a heart monitor do?':
                $conversation->say("A heart monitor continuously records the heart's electrical activity, often used in hospitals for cardiac patients.");
                break;

            case 'what is an anesthesia machine?':
                $conversation->say("An anesthesia machine delivers controlled amounts of anesthesia gases to keep patients unconscious during surgery.");
                break;

            case 'how does a ct scan work?':
                $conversation->say("A CT scanner uses X-rays and a computer to create detailed cross-sectional images of the body.");
                break;

            case 'what is a pacemaker?':
                $conversation->say("A pacemaker is a small device implanted in the chest to help control abnormal heart rhythms.");
                break;

            case 'what is a colposcope?':
                $conversation->say("A colposcope is used to examine the cervix, vagina, and vulva for signs of disease.");
                break;

            case 'what is a laryngoscope?':
                $conversation->say("A laryngoscope is used to view the vocal cords and the glottis during procedures like intubation.");
                break;

            case 'what is a dermatoscope?':
                $conversation->say("A dermatoscope is used to examine skin lesions and diagnose conditions like melanoma.");
                break;

            case 'what is an incubator used for?':
                $conversation->say("An incubator provides a controlled environment for premature or sick newborns to support their development.");
                break;

            case 'what is a c-arm used for?':
                $conversation->say("A C-arm is an imaging scanner used in surgery to provide high-resolution X-ray images in real-time.");
                break;

            case 'how does an eeg machine work?':
                $conversation->say("An EEG machine records electrical activity in the brain to diagnose neurological conditions.");
                break;

            case 'what is a dialysis catheter?':
                $conversation->say("A dialysis catheter is inserted into a large vein to allow blood to be drawn and returned during dialysis.");
                break;

            case 'what is a ventilator circuit?':
                $conversation->say("A ventilator circuit connects the ventilator machine to the patient, delivering air or oxygen.");
                break;

            default:
                $conversation->say("I'm sorry, I don't have information about that. Please ask about a medical device.");
                break;
        }

        // Ask if the user wants to continue
        askToContinue($botman, $conversation);
    });
}

function askToContinue($botman, $conversation)
{
    $conversation->ask('Do you want to ask another question about medical equipment? (yes or no)', function (Answer $answer,$conversation) use ($botman) {
        if (strtolower($answer->getText()) === 'yes') {
            // Restart the question-answer process
           askMedicalQuestion($botman,$conversation); // Recursively calling askName
        } else {
            $conversation->say('Thank you for your time!');
        }
    });
}
