// Imports
import validator from 'validator';
import FormValidatorFactory from '../../helpers/form-validator';
import ApiService from '../../services/ApiService';
import 'url-search-params-polyfill';

/**
 * MusicBandRegistration section
 *
 * @param {jQuery} $
 * @returns {{init}}
 */
function MusicBandRegistration($) {
    // Constants
    const URL_PARAMETER = 'gang';
    const DEFAULT_GANG_CHOICE = 'unknown';
    const CLASS_HIDDEN = 'hidden';

    // Elements
    let $form;
    let $formInputs;
    let $submitBtn;

    // Vars
    let kgFormValidator;
    let getFormDataFn;

    /**
     * Elements initialization
     */
    function initElements() {
        $form = $('.js-kg-form');
        $submitBtn = $('.js-kg-submit');
    }

    /**
     * Registers all the needed events for the page
     */
    function initEvents() {
        $submitBtn.on('click', handleFormSubmit);
    }

    /**
     * Handles form submit
     */
    function handleFormSubmit() {
        console.log("radi");

        // Register form
        const ketchupGangForm = registerStandardForm($form);

        // Sets the form data
        $formInputs = ketchupGangForm.inputs;
        kgFormValidator = ketchupGangForm.formValidator;
        getFormDataFn = ketchupGangForm.getFormData;

        // Validate form data
        kgFormValidator.validateAll();

        // If not valid abort form submit
        if (kgFormValidator.isStateValid() === false) {
            return false
        };

        // Retrieves the data
        const formData = getFormDataFn();

        // Add gang choice to form data
        // formData.gangChoice = getChoiceFromUrl(URL_PARAMETER);

        // Set url
        const url = 'vj_music_band_registration';

        // Process functions
        function setLoading() {
            // console.log('loading');
        }
        function onSuccess() {
            $form.addClass(CLASS_HIDDEN);
        }
        function onError() {
            console.log('error');
        }

        // Submit form
        submitForm(url, formData, setLoading, onSuccess, onError);
    }

    /**
     * 
     * Registers the standard form
     * @param {jQuery.element} $form
     * @returns {{inputs: object, formValidator: object, getFormData: function}}
    */
    function registerStandardForm($form) {
        // Retrieves the elements        
        const $bandNameInput = $form.find('input[name="bandName"]');
        const $phoneInput = $form.find('input[name="phone"]');
        const $emailInput = $form.find('input[name="email"]');
        const $cityInput = $form.find('input[name="city"]');
        const $countryInput = $form.find('input[name="country"]');
        const $availableLocationsInput = $form.find('input[name="availableLocations"]');
        const $membersInput = $form.find('input[name="members"]');
        const $instrumentsInput = $form.find('input[name="instruments"]');
        const $videoLinkInput = $form.find('input[name="videoLink"]');
        const $genresInput = $form.find('input[name="genres"]');
        const $femaleVocalInput = $form.find('input[name="femaleVocal"]');
        const $maleVocalInput = $form.find('input[name="maleVocal"]');
        const $websiteInput = $form.find('input[name="website"]');
        const $instagramInput = $form.find('input[name="instagram"]');
        const $facebookInput = $form.find('input[name="facebook"]');
        const $tagsInput = $form.find('input[name="tags"]');
        const $yearOfFoundationInput = $form.find('input[name="yearOfFoundation"]');
        const $shortDescriptionInput = $form.find('input[name="shortDescription"]');
        const $grantedInput = $form.find('input[name="granted"]');
        const $tocCheckbox = $form.find('input[name="acceptTerms"]');


        // Registers the validator
        const formValidator = FormValidatorFactory.init();
        formValidator.registerValidation($bandNameInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($phoneInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($emailInput, 'blur', validator.isEmail);
        formValidator.registerValidation($cityInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($countryInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($availableLocationsInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($membersInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($instrumentsInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($videoLinkInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($genresInput, 'blur', validator.isEmpty, true);
        // formValidator.registerValidation($femaleVocalInput, 'blur', validator.isEmpty, true);
        // formValidator.registerValidation($femaleVocalInput, 'change', () => $femaleVocalInput.prop('checked'));
        console.log($femaleVocalInput);
        formValidator.registerValidation($maleVocalInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($websiteInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($instagramInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($facebookInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($tagsInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($yearOfFoundationInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($shortDescriptionInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($grantedInput, 'blur', validator.isEmpty, true);
        // formValidator.registerValidation($tocCheckbox, 'change', () => $tocCheckbox.prop('checked'));

        // Prepares the inputs
        const inputs = {
            bandNameInput: $bandNameInput,
            phoneInput: $phoneInput,
            emailInput: $emailInput,
            cityInput: $cityInput,
            countryInput: $countryInput,
            availableLocationsInput: $availableLocationsInput,
            membersInput: $membersInput,
            instrumentsInput: $instrumentsInput,
            videoLinkInput: $videoLinkInput,
            genresInput: $genresInput,
            femaleVocalInput: $femaleVocalInput,
            maleVocalInput: $maleVocalInput,
            websiteInput: $websiteInput,
            instagramInput: $instagramInput,
            facebookInput: $facebookInput,
            tagsInput: $tagsInput,
            yearOfFoundationInput: $yearOfFoundationInput,
            shortDescriptionInput: $shortDescriptionInput,
            grantedInput: $grantedInput,
            // tocCheckbox: $tocCheckbox,
        };

        // Registers the data getter
        const getFormData = () => ({
            bandName: $bandNameInput.val(),
            phone: $phoneInput.val(),
            email: $emailInput.val(),
            city: $cityInput.val(),
            country: $countryInput.val(),
            availableLocations: $availableLocationsInput.val(),
            members: $membersInput.val(),
            instruments: $instrumentsInput.val(),
            videoLink: $videoLinkInput.val(),
            genres: $genresInput.val(),
            // femaleVocal: $femaleVocalInput.val(),
            femaleVocal: $femaleVocalInput.prop('checked') ? 0 : 1,
            maleVocal: $maleVocalInput.val(),
            website: $websiteInput.val(),
            instagram: $instagramInput.val(),
            facebook: $facebookInput.val(),
            tags: $tagsInput.val(),
            yearOfFoundation: $yearOfFoundationInput.val(),
            shortDescription: $shortDescriptionInput.val(),
            granted: $grantedInput.val()
        });

        // Returns the data
        return {
            inputs,
            formValidator,
            getFormData
        };
    }

    /**
     * Submits the form.
     *
     * @param {object} formData
     * @param {string} url
     * @param {function} setLoading
     * @param {function} onSuccess
     * @param {function} onError
     */
    async function submitForm(url, formData, setLoading, onSuccess, onError) {
        console.log(formData);
        // Starts the loading
        setLoading(true);

        // Inits the api service
        const apiService = new ApiService();

        // Tries to send the data
        let result = false;
        try {
            await apiService.post(url, formData);
            onSuccess();
            result = true;
        } catch (ex) {
            console.error(ex);
            onError();
            result = false;
        } finally {
            setLoading(false);
        }
        return result;
    }

    /**
     * Gets url parametar, if none returns custom default value
     */
    function getChoiceFromUrl(parameter) {
        const url = new URLSearchParams(window.location.search);

        if (url.get(parameter)) {
            return url.get(parameter);
        }
        return DEFAULT_GANG_CHOICE;
    }


      /**
   * Fills the form with custom data.
   */
    // eslint-disable-next-line no-unused-vars
    function fillForm() {
        //   console.log("dlksjflsdkjf");
        // $text.val('em@ail.com');
        $formInputs = $form.find('input');
        // $formInputs.emailInput.val('em@ail.com');
        // $formInputs.tocCheckbox.click();
        // eslint-disable-next-line no-restricted-syntax
        for (const item of Object.entries($formInputs)) {
            const $element = item[1];
            //   if ($element.attr('type') === 'text') {
            $($element).val('em@ail.com');
            //   }
        }
        // $formInputs.countryInput.val('Hrvatska');
    }



    function init() {
        initElements();
        initEvents();
        fillForm();
    }

    // Returns the public interface
    return {
        init
    };
}

export default new MusicBandRegistration(jQuery);
