(function( $ ) {
    jQuery.fn.yiiUploadKit = function(options) {

        options = $.extend( {
            maxFiles : 1
        }, options);

        var methods = {
            init: function(){
                var file = this.find('input[type=file]').attr('value');

                this.addClass('upload-kit');
                this.addClass(options.maxFiles > 1 ? 'multiply' : null);
                this.find('input').wrapAll($('<div class="upload-kit-item"></div>'));
                $('body').on('click', '.upload-action .remove', methods.remove);
                this.find('.upload-kit-item').append(
                    $('<span class="upload-action"><span>')
                        .append([
                            '<i class="fa fa-plus-square add"></i>',
                            '<i class="fa fa-trash-o remove"></i>',
                            '<div class="progress" style="display: none">'+
                                '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'+
                            '</div>'
                        ])
                );
                if(file){
                    methods.success.call(this.find('.upload-kit-item'), file)
                }
                methods.dragInit()
                methods.fileupload.apply(this);
            },
            success: function(url){
                this.find('input[type=file]').attr('disabled', 'disabled');
                this.addClass('done')
                    .css('backgroundImage', 'url(' + url +')')
                    .find('input[type=hidden]')
                        .val(url);
            },
            remove: function(){
                var uploadKitItem = $(this).parents('.upload-kit-item');
                uploadKitItem
                    .removeClass('done')
                    .css('backgroundImage', 'none');

                uploadKitItem
                    .find('input[type=hidden]')
                    .val(null);

                uploadKitItem
                    .find('input[type=file]')
                    .removeAttr('disabled')
                    .attr('value', null)
                    .replaceWith(uploadKitItem.find('input[type=file]'))
            },
            fileupload: function(){
                this.find('input[type=file]').fileupload({
                    url: options.url,
                    dropZone: $('.upload-kit-item'),
                    start: function (e, data) {
                        $(e.target).parents('.upload-kit-item').addClass('.in-progress')
                    },
                    progress: function (e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $(this).parents('.upload-kit-item').find('.progress-bar').attr('aria-valuenow', progress).css(
                            'width',
                            progress + '%'
                        ).text(progress + '%');
                    },
                    done: function (e, data) {
                        var uploadKitItem = $(e.target).parents('.upload-kit-item');
                        uploadKitItem
                            .find('.progress-bar').attr('aria-valuenow', 0)
                            .css('width', 0)
                            .text();
                        if(data.result.success && data.result.success[0]){
                            var file = data.result.success[0];
                            methods.success.call(uploadKitItem, file.url)
                        }
                    }
                })
            },
            dragInit: function(){
                $(document).bind('dragover', function (e)
                {
                    $(e.target).parents('.upload-kit-item').addClass('drag-hover');
                    e.preventDefault();
                });
            }
        }

        methods.init.apply(this);
        return this;
    };
})(jQuery)
