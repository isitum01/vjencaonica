// Imports
import validator from 'validator';
import FormValidatorFactory from '../../helpers/form-validator';
import ApiService from '../../services/api-service';


function MusicBandRegistration($) {

    const formValidator = FormValidatorFactory.init('CLASS_INPUT_ERROR');
    const apiService = new ApiService();

    // Elements
    let $form;
    let $bandName;
    let $phone;
    let $email;
    let $city;
    let $country;
    let $availableLocations;
    let $members;
    let $instruments;
    let $videoLink;
    let $genres;
    let $femaleVocal;
    let $maleVocal;
    let $website;
    let $instagram;
    let $facebook;
    let $tags;
    let $yearOfFoundation;
    let $description;

    let $btnSubmit;

    function initElements() {
        $form = $('.js-mbr-form');
        $bandName = $form.find('input[name="bandName"]');
        $phone = $form.find('input[name="phone"]');
        $email = $form.find('input[name="email"]');
        $city = $form.find('input[name="city"]');
        $country = $form.find('input[name="country"]');
        $availableLocations = $form.find('input[name="availableLocations"]');
        $members = $form.find('input[name="members"]');
        $instruments = $form.find('input[name="instruments"]');
        $videoLink = $form.find('input[name="videoLink"]');
        $genres = $form.find('input[name="genres"]');
        $femaleVocal = $form.find('input[name="femaleVocal"]');
        $maleVocal = $form.find('input[name="maleVocal"]');
        $website = $form.find('input[name="website"]');
        $instagram = $form.find('input[name="instagram"]');
        $facebook = $form.find('input[name="facebook"]');
        $tags = $form.find('input[name="tags"]');
        $yearOfFoundation = $form.find('input[name="yearOfFoundation"]');
        $description = $form.find('input[name="description"]');
        $btnSubmit = $form.find('.js-mbr-submit');
    }

    function initEvents() {
        $btnSubmit.on('click', onFormSubmit);
    }

    async function onFormSubmit(e) {
        e.preventDefault();
        console.log("submit");
        const formData = getFormData();

        try {
            await apiService.post('vj_music-band-registration', formData);
            showSuccessPage();
        } catch (ex) {
            console.log(ex);
        } finally {
            console.log("prijava poslana");
        }
    }

    function getFormData() {
        return {
            bandName: $bandName.val(),
            phone: $phone.val(),
            email: $email.val(),
            city: $city.val(),
            country: $country.val(),
            availableLocations: $availableLocations.val(),
            members: $members.val(),
            instruments: $instruments.val(),
            videoLink: $videoLink.val(),
            genres: $genres.val(),
            femaleVocal: $femaleVocal.val(),
            maleVocal: $maleVocal.val(),
            website: $website.val(),
            instagram: $instagram.val(),
            facebook: $facebook.val(),
            tags: $tags.val(),
            yearOfFoundation: $yearOfFoundation.val(),
            description: $description.val()
        };
    }

    function showSuccessPage() {
        console.log("prijava pos");
    }

    function fillForm() {
        $bandName.val('em@ail.com');
        $phone.val('em@ail.com');
        $email.val('em@ail.com');
        $city.val('em@ail.com');
        $country.val('em@ail.com');
        $availableLocations.val('em@ail.com');
        $members.val('em@ail.com');
        $instruments.val('em@ail.com');
        $videoLink.val('em@ail.com');
        $genres.val('em@ail.com');
        $femaleVocal.val('em@ail.com');
        $maleVocal.val('em@ail.com');
        $website.val('em@ail.com');
        $instagram.val('em@ail.com');
        $facebook.val('em@ail.com');
        $tags.val('em@ail.com');
        $yearOfFoundation.val('em@ail.com');
        $description.val('em@ail.com');
    }



    return {
        init() {
            initElements();
            initEvents();
            fillForm();
        }
    }
}

export default MusicBandRegistration(jQuery);