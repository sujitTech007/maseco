(function () {
    function getFeedbackContainer(field) {
        var parent = field.parentElement;

        if (parent && parent.classList.contains('input-group')) {
            return parent;
        }

        if (parent && parent.tagName === 'LABEL') {
            return parent;
        }

        return field;
    }

    function clearError(field) {
        var error = document.getElementById(field.dataset.validationErrorId || '');

        if (error) {
            error.remove();
        }

        field.removeAttribute('aria-invalid');
        delete field.dataset.validationErrorId;
    }

    function showError(field) {
        clearError(field);

        var error = document.createElement('div');
        var errorId = 'required-field-error-' + Math.random().toString(36).slice(2);
        error.id = errorId;
        error.className = 'text-danger small mt-1';
        error.textContent = field.validity.valueMissing
            ? 'This field is required.'
            : field.validationMessage;

        var container = getFeedbackContainer(field);
        container.insertAdjacentElement('afterend', error);
        field.dataset.validationErrorId = errorId;
        field.setAttribute('aria-invalid', 'true');
    }

    function validateForm(form) {
        var invalidFields = Array.from(form.elements).filter(function (field) {
            return field.willValidate && !field.checkValidity();
        });

        if (!invalidFields.length) {
            return true;
        }

        invalidFields.forEach(showError);
        invalidFields[0].focus();
        return false;
    }

    function enhanceForm(form) {
        if (form.dataset.inlineValidationReady === 'true') {
            return;
        }

        form.dataset.inlineValidationReady = 'true';
        form.noValidate = true;

        form.addEventListener('submit', function (event) {
            if (!validateForm(form)) {
                event.preventDefault();
                event.stopImmediatePropagation();
            }
        }, true);

        form.addEventListener('input', function (event) {
            if (event.target.willValidate && event.target.checkValidity()) {
                clearError(event.target);
            }
        }, true);

        form.addEventListener('change', function (event) {
            if (event.target.willValidate && event.target.checkValidity()) {
                clearError(event.target);
            }
        }, true);

        form.addEventListener('reset', function () {
            window.setTimeout(function () {
                Array.from(form.elements).forEach(clearError);
            }, 0);
        });
    }

    function initialize() {
        document.querySelectorAll('form').forEach(enhanceForm);

        new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                mutation.addedNodes.forEach(function (node) {
                    if (node.nodeType !== Node.ELEMENT_NODE) {
                        return;
                    }

                    if (node.matches('form')) {
                        enhanceForm(node);
                    }

                    node.querySelectorAll('form').forEach(enhanceForm);
                });
            });
        }).observe(document.body, { childList: true, subtree: true });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initialize);
    } else {
        initialize();
    }
})();
