/**
 * Validate email
 */
jQuery(document).ready(function($) {
    // Send form
    $(document).on('click', '.contact-button', function(e) {
        e.preventDefault();
        var form = $(this).parents('.contact-form'),
            form_block = form.parents('.contacts');
            msg = 'Wrong! Please enter at least 1 character',
            msg_email = 'Wrong! Please enter a valid email address';

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'contactform_action',
                form: $(this).parent('.contact-form').serialize()
            },
            dataType: 'json',
            beforeSend: function() {
                form.find('.form-group').removeClass('error');
                form.find('.error-text').remove();

                var name = form.find('.input-name'),
                    email = form.find('.input-email'),
                    message = form.find('.message');
                
                if (name.length) {
                    if (!name.val()) {
                        name.parent().append('<p class="error-text">' + msg + '</p>').addClass('error');
                        return false;
                    }
                } 
                if (email.length) {
                    if (!email.val() || !isValidEmailAddress(email.val())) {
                        email.parent().append('<p class="error-text">' + msg_email + '</p>').addClass('error');
                        return false;
                    }
                }
                if (message.length) {
                    if (!message.val()) {
                        message.parent().append('<p class="error-text">' + msg + '</p>').addClass('error');
                        return false;
                    }
                }
            },
            success: function(response, jqXHR, errorThrown) {
                if (response.status == 'error') {
                    form_block.html("<div class='send-response send-response-error'><div class='send-response-image'></div><span>Some error occured. Your message haven't been sent.</span></div>");
                }  else if (response.status == 'success') {
                    form[0].reset();
                    form_block.html("<div class='send-response send-response-success'><div class='send-response-image'></div><span>Your message has been successfully sent to the " + response.mail + " email address.</span></div>");
                }
            }
        });
    });
});

/**
 * Get valid email
 * @param {object} emailAddress
 * @returns {object}
 */
function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
    return pattern.test(emailAddress);
}
