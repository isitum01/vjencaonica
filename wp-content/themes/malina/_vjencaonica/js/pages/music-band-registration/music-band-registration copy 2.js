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
        formData.gangChoice = getChoiceFromUrl(URL_PARAMETER);

        // Set url
        const url = 'ew_ketchup_gang_registration';

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
        const $firstNameInput = $form.find('input[name="firstName"]');
        const $lastNameInput = $form.find('input[name="lastName"]');
        const $emailInput = $form.find('input[name="email"]');
        const $phoneInput = $form.find('input[name="phone"]');
        const $tocCheckbox = $form.find('input[name="acceptTerms"]');

        // Registers the validator
        const formValidator = FormValidatorFactory.init();
        formValidator.registerValidation($firstNameInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($lastNameInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($emailInput, 'blur', validator.isEmail);
        formValidator.registerValidation($phoneInput, 'blur', validator.isEmpty, true);
        formValidator.registerValidation($tocCheckbox, 'change', () => $tocCheckbox.prop('checked'));

        // Prepares the inputs
        const inputs = {
            firstNameInput: $firstNameInput,
            lastNameInput: $lastNameInput,
            emailInput: $emailInput,
            phoneInput: $phoneInput,
            tocCheckbox: $tocCheckbox,
        };

        // Registers the data getter
        const getFormData = () => ({
            firstName: $firstNameInput.val(),
            lastName: $lastNameInput.val(),
            email: $emailInput.val(),
            phone: $phoneInput.val()
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

    function init() {
        initElements();
        initEvents();
    }

    // Returns the public interface
    return {
        init
    };
}

export default new MusicBandRegistration(jQuery);
