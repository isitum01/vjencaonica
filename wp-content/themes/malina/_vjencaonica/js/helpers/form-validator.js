/* eslint-disable */
// defines the form validator
const formValidator = (function ($) {
  // init
  function init(errorClass) {
    errorClass = !errorClass ? 'error' : errorClass;
    const validationElements = [];

    // default validation function
    function defaultValidationFn(value) {
      return false;
    }

    // default value getter
    function defaultValueGetterFn(element) {
      return $(element).val();
    }

    // default function for setting the error
    function defaultSetErrorFn(element) {
      // finds the parent
      const parent = $(element).closest('.c-input-container');

      // sets the error class
      parent.addClass(errorClass);
    }

    // default unset error function
    function defaultUnsetErrorFn(element) {
      // finds the parent
      const parent = $(element).parent();

      // unsets the error class
      parent.removeClass(errorClass);
    }

    // default name getter
    function defaultNameGetterFn(element) {
      // retrieves the data
      const id = $(element).attr('id');
      const name = $(element).attr('name');

      if (id) return id;
      else if (name) return name;
      return (new Date()).getTime() + '-' + Math.random();
    }

    // handles default value
    function handleDefaultValues(validationFn, inverse, valueGetterFn, setErrorFn, unsetErrorFn) {
      // returns the defaults
      return {
        validationFn: validationFn || defaultValidationFn,
        inverse: !!inverse,
        valueGetterFn: valueGetterFn || defaultValueGetterFn,
        setErrorFn: setErrorFn || defaultSetErrorFn,
        unsetErrorFn: unsetErrorFn || defaultUnsetErrorFn
      };
    }

    // function for handling validation
    function handleValidation(element, validationFn, inverse, valueGetterFn, setErrorFn, unsetErrorFn) {
      // handles the functions
      const validators = handleDefaultValues(validationFn, inverse, valueGetterFn, setErrorFn, unsetErrorFn);

      // retrieves the value from element
      const value = validators.valueGetterFn(element);

      // deos the validation
      const validationValue = validators.validationFn(value);
      const isValid = validators.inverse ? !validationValue : validationValue;

      // checks if valid
      if (isValid) {
        // calls the error unset
        validators.unsetErrorFn(element);
      } else {
        // else - sets the error
        validators.setErrorFn(element);
      }

      // returns the validation state
      return isValid;
    }

    // function for registering validation
    function registerValidation(
      element,
      event,
      validationFn,
      inverse,
      valueGetterFn,
      setErrorFn,
      unsetErrorFn
    ) {
      // handles the default values
      const validators = handleDefaultValues(validationFn, inverse, valueGetterFn, setErrorFn, unsetErrorFn);

      // retrieves the element name
      const name = defaultNameGetterFn(element);

      // sets the element
      const elementValidationData = {
        element,
        name,
        oldValue: undefined,
        isDirty: false,
        isValid: false,
        validationFn: validators.validationFn,
        inverse: validators.inverse,
        valueGetterFn: validators.valueGetterFn,
        setErrorFn: validators.setErrorFn,
        unsetErrorFn: validators.unsetErrorFn
      };
      validationElements[name] = elementValidationData;

      // registers the dirty checker
      $(element).on(event, (event) => {
        // returns if already dirty
        if (validationElements[name].isDirty) return;

        // retrieves values
        const oldValue = validationElements[name].oldValue;
        const newValue = validators.valueGetterFn(element);

        // checks if different values
        if (oldValue != newValue) {
          // sets the new dirty data
          validationElements[name].oldValue = newValue;
          validationElements[name].isDirty = true;
        }
      });

      // registers the validation handling
      $(element).on(event, (event) => {
        if (validationElements[name].isDirty == false) return;
        validateElement(elementValidationData);
      });
    }

    // validates the element
    function validateElement(elementValidationData) {
      // validates the element
      elementValidationData.isValid = handleValidation(
        elementValidationData.element,
        elementValidationData.validationFn,
        elementValidationData.inverse,
        elementValidationData.valueGetterFn,
        elementValidationData.setErrorFn,
        elementValidationData.unsetErrorFn
      );
    }

    // returns if state is valid
    function isStateValid() {
      // sets the state
      let isValid = true;

      // iterates
      for (const key in validationElements) {
        if (validationElements.hasOwnProperty(key)) {
          // updates validity
          isValid = isValid && validationElements[key].isValid;
        }
      }

      // returns validity
      return isValid;
    }

    // checks if single item is valid
    function isValidSingle(key) {
      // retrieves validation element
      const element = validationElements[key];

      // returns the state's validity
      return element && element.isValid;
    }

    // validates all elements
    function validateAll() {
      // iterates
      for (const key in validationElements) {
        if (validationElements.hasOwnProperty(key)) {
          validateElement(validationElements[key]);
        }
      }
    }

    // validates one element
    function validateSingle(key) {
      // validates single element
      validateElement(validationElements[key]);
    }


    // Explicitly return methods
    // this will set them to public
    return {
      handleValidation,
      registerValidation,
      validationElements,
      isStateValid,
      isValidSingle,
      validateAll,
      validateSingle,
    };
  }

  // public interface
  return {
    init
  };
}(jQuery));

module.exports = formValidator;
