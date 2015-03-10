var Application;

Application = (function() {
    function Application()
    {
        this.initialize_active_classes();
    }

    Application.prototype.initialize_active_classes = function()
    {
        var _this = this, $body = $('body');

        $body.on('click', 'a.ajax-post, a.ajax-get', function(event) {
            event.preventDefault();
            var $this = $(this),
                data_type;

            data_type = $this.attr('dataType');
            data_type = (data_type === typeof undefined || data_type === false) ? 'json' : data_type;

            if (!$this.hasClass('sending'))
            {
                $.ajax({
                    type: $this.hasClass('ajax-get') ? 'GET' : 'POST',
                    url: this.href,
                    dataType: data_type,
                    cache: false,
                    beforeSend: function()
                    {
                        $this.trigger({
                            type: 'ajax:before'
                        });
                        $this.addClass('sending');
                    }
                }).done(function(response){
                    _this.handle_response_messages(response);

                    $this.trigger({
                        type: 'ajax:complete',
                        response: response
                    });

                    $this.removeClass('sending');
                });
            }
        });

        $body.on('click', 'a.ajax-delete', function(event) {
            event.preventDefault();
            var $this = $(this);

            if ($this.hasClass('skip-confirm') || $this.data('confirm') && confirm($this.data('confirm')))
            {
                var $this = $(this);

                if (!$this.hasClass('deleting'))
                {
                    $.ajax({
                        type: 'POST',
                        url: this.href,
                        dataType: 'json',
                        cache: false,
                        beforeSend: function()
                        {
                            $this.trigger({
                                type: 'ajax:before'
                            });
                            $this.addClass('deleting');
                        }
                    })
                    .done(function(response){
                        _this.handle_response_messages(response);

                        $this.trigger({
                            type: 'ajax:complete',
                            response: response
                        });

                        $this.removeClass('deleting');
                    });
                }
            }
        });

        $body.on('submit', '.ajax-form', function(event) {
            event.preventDefault();
            event.stopPropagation();

            _this.submit_form(this);
        });

        $body.on('click', 'a.submit-btn', function(event) {
            event.preventDefault();
            event.stopPropagation();

            $(this).parents('form').submit();
        });

        $body.on('click', 'a.ajax-load', function(event) {
            event.preventDefault();
            event.stopPropagation();

            var $this = $(this);
            var has_target = (typeof $this.attr('target') !== typeof undefined) && ($this.attr('target') !== false);


            if (has_target)
            {
                $($this.attr('target')).load($this.attr('href'), $this.data());
            }
            else
            {
                var $ajax_content_block = $('#async-loaded-content');
                var data = {};

                if ($ajax_content_block.length == 0)
                {
                    $ajax_content_block = $('<div id="async-loaded-content"></div>');
                    $body.append($ajax_content_block);
                }

                $ajax_content_block.load($this.attr('href'), $this.data());
            }
        });

        return true;
    }

    Application.prototype.submit_form = function(selector)
    {
        var $form, $loader;
        var _this = this;

        if (!$(selector).length)
        {
            return false;
        }

        var $form = $(selector);

        if ($form.hasClass('submiting'))
        {
            return false;
        }

        if ($form.attr('data-loader'))
        {
            $loader = $($form.attr('data-loader'));
        }
        else
        {
            $loader = $form.find('input[type="submit"], a.submit-btn')[0];
        }

        var method = $form.attr('method');
        method = ( method != undefined && method != '' ) ? method : 'POST';

        $form.ajaxSubmit({
            url         : $form.attr('action'),
            dataType    : 'json',
            cache       : false,
            type        : method,

            beforeSubmit: function(arr, $form, options) {
                $form.trigger({
                    type: 'ajax:before'
                });

                _this.remove_form_errors($form);
                _this.show_loader($loader);
                $form.find('input,select,button').attr('disabled', 'disabled');
                $form.addClass('submiting');
            },

            error: function(xhr, status, error) {
                $form.trigger({
                    type: 'ajax:error',
                    xhr: xhr,
                    error: error,
                    status: status
                });
                _this.hide_loader($loader);
                $form.find('input, select, button').removeAttr('disabled');
                $form.removeClass('submiting');
            },

            success: function(response, status, xhr) {
                _this.hide_loader($loader);
                _this.handle_response_messages(response);

                if( (typeof(response.errors) != 'undefined') && (response.errors != '') && (!$form.hasClass('no-errors')))
                {
                    _this.show_form_errors( response.errors, $form );
                }
                else
                {
                    if ($form.hasClass('resettable'))
                    {
                        $form.trigger('reset');
                    }
                }

                $form.trigger({
                    type: 'ajax:success',
                    xhr: xhr,
                    response: response
                });

                $form.removeClass('submiting');
                $form.find('input, select, button').removeAttr('disabled');
            }
        });
    }

    Application.prototype.show_form_errors = function(errors, $form)
    {
        var form_name = $form.attr('name');

        $.each( errors, function( field_name, error_message ) {
            var $input = $form.find( '[name="' + form_name + '[' + field_name + ']"]:first' );
            var $errorContainer = $form.find('span[ref="' + field_name + '-error"]' );

            if( !$errorContainer[0] )
            {
                $('<span class="error-msg" ref="' + field_name + '-error">' + error_message + '</span>')
                    .insertAfter( $input )
                    .show();
            }
            else
            {
                $errorContainer.html(error_message.toString()).show();
            }

            $input.parents('div.input-holder').addClass( 'error-3' );
        });
    };

    Application.prototype.remove_form_errors = function($form)
    {
        $form.find( 'span.error-msg' ).html('').hide();
        $form.find( '.error-3' ).removeClass('error-3');
    };

    Application.prototype.handle_response_messages = function(response)
    {
        if ((typeof(response.error_message) != 'undefined') && (response.error_message != ''))
        {
            new jBox('Notice', {
                content: $.tmpl($('#error_message_template').html(), { message: response.error_message}),
                attributes: {
                    x: 'right',
                    y: 'top'
                },
                position: {
                    x: 0,
                    y: 50
                }
            });
        }

        if ((typeof(response.success_message) != 'undefined') && (response.success_message != ''))
        {
            new jBox('Notice', {
                content: $.tmpl($('#success_message_template').html(), { message: response.success_message}),
                attributes: {
                    x: 'right',
                    y: 'top'
                },
                position: {
                    x: 0,
                    y: 50
                }
            });
        }

        if ((typeof(response.redirect) != 'undefined') && (response.redirect != ''))
        {
            window.location.href = response.redirect;
        }

        if ((typeof(response['reload']) != 'undefined') && (response['reload'] != ''))
        {
            window.location.reload();
        }
    }

    Application.prototype.show_loader = function(selector)
    {
        if (!jQuery( selector ).length)
        {
            return false;
        }

        var $selector = jQuery( selector );
        $selector.addClass( 'loader' );
    };

    Application.prototype.hide_loader = function(selector)
    {
        var $selector = $( selector );
        $selector.removeClass( 'loader' );
    };

    Application.prototype.show_error_message = function(message)
    {
        new jBox('Notice', {
            content: $.tmpl($('#error_message_template').html(), { message: message}),
            attributes: {
                x: 'right',
                y: 'top'
            },
            position: {
                x: 0,
                y: 50
            }
        });
    }

    return Application;

})();

window.Application = Application; 