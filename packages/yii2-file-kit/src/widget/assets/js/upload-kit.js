/*!
 * Yii2 File Kit library
 * http://github.com/yii2-starter-kit/yii2-file-kit
 *
 * Author: Eugine Terentev <eugine@terentev.net>
 *
 * Date: 2014-05-01T17:11Z
 */
(function( $ ) {
    jQuery.fn.yiiUploadKit = function(options) {
        var $input = this;
        var $container = $input.parent('div');
        var $files = $('<ul>', {"class":"files"}).insertBefore($input);
        var $emptyInput = $container.find('.empty-value');

        var methods = {
            init: function(){
                if (options.multiple) {
                    $input.attr('multiple', true);
                    $input.attr('name', $input.attr('name') + '[]');
                }
                $container.addClass('upload-kit');
                if (options.sortable) {
                    $files.sortable({
                        placeholder: "upload-kit-item sortable-placeholder",
                        tolerance: "pointer",
                        forcePlaceholderSize: true,
                        update: function () {
                            methods.updateOrder()
                        }
                    })
                }
                $input.wrapAll($('<li class="upload-kit-input"></div>'))
                    .after($('<span class="fas fa-plus-circle add"></span>'))
                    .after($('<span class="fas fa-arrow-alt-circle-down drag"></span>'))
                    .after($('<span/>', {"data-toggle":"popover", "class":"fas fa-exclamation-circle error-popover"}))
                    .after(
                        '<div class="progress">'+
                        '<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>'+
                        '</li>'
                    );
                $files.on('click', '.upload-kit-item .remove', methods.removeItem);
                methods.checkInputVisibility();
                methods.fileuploadInit();
                methods.dragInit();
                if (options.acceptFileTypes && !(options.acceptFileTypes instanceof RegExp)) {
                    options.acceptFileTypes = new RegExp(eval(options.acceptFileTypes))
                }

            },
            fileuploadInit: function(){
                var $fileupload = $input.fileupload({
                    name: options.name || 'file',
                    url: options.url,
                    dropZone: $input.parents('.upload-kit-input'),
                    dataType: 'json',
                    singleFileUploads: false,
                    multiple: options.multiple,
                    maxNumberOfFiles: options.maxNumberOfFiles,
                    maxFileSize: options.maxFileSize, // 5 MB
                    acceptFileTypes: options.acceptFileTypes,
                    minFileSize: options.minFileSize,
                    messages: options.messages,
                    process: true,
                    getNumberOfFiles: methods.getNumberOfFiles,
                    start: function (e, data) {
                        if(options.errorHandler == 'yii'){
                            $container.parents('form').yiiActiveForm('updateAttribute', $emptyInput.attr('id'), '');
                        }
                        $container.find('.upload-kit-input')
                            .removeClass('error')
                            .addClass('in-progress');
                        $input.trigger('start');
                        if (options.start !== undefined) options.start(e, data);
                    },
                    processfail: function(e, data) {
                        if (data.files.error) {
                            methods.showError(data.files[0].error);
                        }
                    },
                    progressall: function (e, data) {
                        var progress = parseInt(data.loaded / data.total * 100, 10);
                        $container.find('.progress-bar').attr('aria-valuenow', progress).css(
                            'width',
                            progress + '%'
                        ).text(progress + '%');
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            if (!file.error) {
                                var item = methods.createItem(file);
                                item.appendTo($files);
                            } else {
                                methods.showError(file.errors)
                            }

                        });
                        methods.handleEmptyValue();
                        methods.checkInputVisibility();
                        $input.trigger('done');
                        if (options.done !== undefined) options.done(e, data);
                    },
                    fail: function (e, data) {
                        methods.showError(data.errorThrown);
                        if (options.fail !== undefined) options.fail(e, data);
                    },
                    always: function (e, data) {
                        $container.find('.upload-kit-input').removeClass('in-progress');
                        $input.trigger('always');
                        if (options.always !== undefined) options.always(e, data);
                    }

                });
                if (options.files) {
                    options.files.sort(function(a, b){
                        return parseInt(a.order) - parseInt(b.order);
                    });
                    $fileupload.fileupload('option', 'done').call($fileupload, $.Event('done'), {result: {files: options.files}});
                    methods.handleEmptyValue();
                    methods.checkInputVisibility();
                }
            },
            dragInit: function(){
                $(document).on('dragover', function ()
                {
                    $('.upload-kit-input').addClass('drag-highlight');
                });
                $(document).on('dragleave drop', function ()
                {
                    $('.upload-kit-input').removeClass('drag-highlight');
                });
            },
            showError: function(error){
                if(options.errorHandler == 'yii'){
                    $container.parents('form').yiiActiveForm('updateAttribute', $emptyInput.attr('id'), [error]);
                }else if ($.fn.popover) {
                    $container.find('.error-popover').attr('data-content', error).popover({html:true,trigger:"hover"});
                }
                $container.find('.upload-kit-input').addClass('error');
            },
            removeItem: function(e){
                var $this = $(this);
                var url = $this.data('url');
                if (url) {
                    $.ajax({
                        url: url,
                        type: 'DELETE'
                    })
                }
                $this.parents('.upload-kit-item').remove();
                methods.handleEmptyValue();
                methods.checkInputVisibility();
            },
            createItem: function(file){
                var name = options.name;
                var index = methods.getNewItemIndex();
                if (options.multiple) {
                    name += '[' + index + ']';
                }
                var item = $('<li>', {"class": "upload-kit-item done", value: index})
                    .append($('<input/>', {"name": name + '[' + options.pathAttributeName + ']', "value": file[options.pathAttribute], "type":"hidden"}))
                    .append($('<input/>', {"name": name + '[name]', "value": file.name, "type": (options.editFilename === true) ? "text" : "hidden"}))
                    .append($('<input/>', {"name": name + '[size]', "value": file.size, "type":"hidden"}))
                    .append($('<input/>', {"name": name + '[type]', "value": file.type, "type":"hidden"}))
                    .append($('<input/>', {"name": name + '[order]', "value": file.order, "type":"hidden", "data-role": "order"}))
                    .append($('<input/>', {"name": name + '[' + options.baseUrlAttributeName + ']', "value": file[options.baseUrlAttribute], "type":"hidden"}))
                    .append($('<span/>', {
                        "class": "name",
                        "title": file.name,
                        "text": options.showPreviewFilename ? file.name : null
                    }))
                    .append($('<span/>', {"class": "fas fa-times-circle remove", "data-url": file.delete_url}));
                if ((!file.type || file.type.search(/image\/.*/g) !== -1) && options.previewImage) {
                    item.removeClass('not-image').addClass('image');
                    item.prepend($('<img/>', {src: file[options.baseUrlAttribute] + '/' +file[options.pathAttribute]}));
                    item.find('span.type').text('');
                } else {
                    item.removeClass('image').addClass('not-image');
                    item.css('backgroundImage', '');
                    item.find('span.name').text(file.name);
                }
                return item;
            },
            checkInputVisibility: function(){
                var inputContainer = $container.find('.upload-kit-input');
                if (options.maxNumberOfFiles && (methods.getNumberOfFiles() >= options.maxNumberOfFiles)) {
                    inputContainer.hide();
                } else {
                    inputContainer.show();
                }
            },
            handleEmptyValue: function(){
                if (methods.getNumberOfFiles() > 0) {
                    $emptyInput.val(methods.getNumberOfFiles())
                } else {
                    $emptyInput.removeAttr('value');
                }
            },
            getNumberOfFiles: function() {
                return $container.find('.files .upload-kit-item').length;
            },
            getNewItemIndex: function () {
                var existingIndexes = [];
                $container.find('.files .upload-kit-item').each(function (index, item) {
                    existingIndexes.push(index);
                });
                return existingIndexes.length ? (Math.max.apply(Math, existingIndexes)+1) : 0;
            },
            updateOrder: function () {
                $files.find('.upload-kit-item').each(function(index, item){
                    $(item).find('input[data-role=order]').val(index);
                })
            }
        };

        methods.init.apply(this);
        return this;
    };

})(jQuery);