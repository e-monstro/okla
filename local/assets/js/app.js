jQuery.expr[':'].Contains = function(a, i, m) {
    return jQuery(a).text().toUpperCase()
        .indexOf(m[3].toUpperCase()) >= 0;
};

// OVERWRITES old selecor
jQuery.expr[':'].contains = function(a, i, m) {
    return jQuery(a).text().toUpperCase()
        .indexOf(m[3].toUpperCase()) >= 0;
};

$(document).ready(function () {
    $(document).on('submit', '.ajax_form', function (e) {
        e.preventDefault();

        var formData = $(this).serialize();
        var url = $(this).attr('action');

        $.post(url, formData, function (response) {
            $('.fancybox-inner').html(response);
            $.fancybox.update();
        });
    });

    var $searhInput = $('.search-input');

    $searhInput.focus(function () {
        $('.search-wrapper').addClass('focused-wrap');
    });

    $searhInput.blur(function () {
        $('.search-wrapper').removeClass('focused-wrap');
    });

    //smart filter logic

    $('.smartfilter').find('input:not(".brand-search-input")').change(function () {
        filterAjaxSubmit($(this))
    });

    $(document).on('click', '.remove-fields').click(function (e) {
        e.preventDefault();

        var newUrl = $(this).data('remove-href');
        location.href = newUrl;
    });

    var $brandsFilterInput = $('.brand-search-input');
    $brandsFilterInput.keyup(function () {
        var $parent = $(this).closest('.sidebar-cont');
        if ($(this).val()) {
            $parent.find('.check-list-items li').hide();
            $parent.find('.check-list-items li:contains("' + $(this).val() + '")').show();
        } else {
            $parent.find('.check-list-items li').show();
        }
    });

    $brandsFilterInput.blur(function () {
        var $parent = $(this).closest('.sidebar-cont');
        if (!$(this).val()) {
            $parent.find('.check-list-items li').show();
        }
    });
});

function filterAjaxSubmit($input) {
    var $form = $input.closest('form');
    var url = $form.attr('action');
    var formData = $form.serialize();
    aShowLoader();
    $.get(url, formData, function (response) {
        var $ajaxContainer = $('.catalog-ajax-container');
        $ajaxContainer.html(response);
        $ajaxContainer.find("select").select2({
            minimumResultsForSearch: -1
        });

        $('.remove-fields').each(function () {
            var fieldInFilter = $(this).data('field-id');

            if (!$(this).hasClass('get-from-input')) {
                if ($('.label_' + fieldInFilter).length > 0) {
                    var removeText = $('.label_' + fieldInFilter).text();
                } else {
                    var removeText = $('[for="' + fieldInFilter + '"]').text();
                }
            } else {
                var removeText = $('.label_' + fieldInFilter).val();
            }
            $(this).find('.st-remove-text').text(removeText);
        });
        aHideLoader();
    });
}

function aShowLoader() {
    $('.loader-wrapper').show();
}

function aHideLoader() {
    $('.loader-wrapper').hide();
}

function validateForm($form) {
    var valid = true;
    $form.find('.required').each(function () {
        if (!$(this).val()) {
            $(this).addClass('error-input');
            valid = false;
        } else {
            $(this).removeClass('error-input');
        }
    });

    if ($('.reg-pass-conf').val() != $('.reg-pass').val()) {
        valid = false;
    }

    return valid;
}

function processRegStep($form, step) {
    if (validateForm($form)) {
        if (step == 2) {
            checkUnique($('.reg-login').val(), $('.reg-email').val(), step);
        } else {
            $('.reg-form-step').hide();
            $('.step--' + step).fadeIn(300);
        }
    } else {
        return false;
    }
}

function checkUnique(login, email, step) {
    $.getJSON('/local/ajax/check_unique.php',
        {
            login: login,
            email: email
        }, function (response) {
            if (response.success) {
                $('.reg-form-step').hide();
                $('.step--' + step).fadeIn(300);
                return true;
            } else {
                if (response.errors.login) {
                    $('.login-error').show();
                    $('.reg-login').addClass('error-input');
                } else {
                    $('.login-error').hide();
                    $('.reg-login').removeClass('error-input');
                }

                if (response.errors.email) {
                    $('.email-error').show();
                    $('.reg-email').addClass('error-input');
                } else {
                    $('.email-error').hide();
                    $('.reg-email').removeClass('error-input');
                }

                return false;
            }
        });
}

