import {
    openEditor,
    processImage,
    createDefaultImageReader,
    createDefaultImageWriter,
    legacyDataToImageState,
    getEditorDefaults,
} from '/keen/js/pintura/pintura-js.js';

filePondWithEditor('measuredUploadPond', 'input.measured-upload-pond');
//filePondWithEditor('assignedUploadPond', 'input.assigned-upload-pond');


function filePondWithEditor(mode = 'measuredUploadPond', selectorHandler = 'input.measured-upload-pond')
{
    var uploadPondResult;
    FilePond.registerPlugin(FilePondPluginImageEditor);
    uploadPondResult = FilePond.create(document.querySelector(selectorHandler));

    uploadPondResult.setOptions({
        labelIdle: '<span style="position: relative; top: 2px;" class="pr-1">Drag picture here or</span> <span style="text-decoration: none !important;" class="filepond--label-action btn btn-sm btn-outline-primary" role="button">Select a File</span>',
        allowMultiple: true,
        allowRevert: false,
        // FilePond generic properties
        // filePosterMaxHeight: 256,
        imageEditorInstantEdit: true,
        allowImageEditor: true,

        // FilePond Image Editor plugin properties
        imageEditor: {
            // Maps legacy data objects to new imageState objects (optional)
            legacyDataToImageState: legacyDataToImageState,

            // Used to create the editor (required)
            createEditor: openEditor,

            // Used for reading the image data. See JavaScript installation for details on the `imageReader` property (required)
            imageReader: [createDefaultImageReader],

            // Can leave out when not generating a preview thumbnail and/or output image (required)
            imageWriter: [
                createDefaultImageWriter
            ],

            // Used to poster and output images, runs an invisible "headless" editor instance.
            imageProcessor: processImage,

            // Pintura Image Editor options
            editorOptions: {
                // Pass the editor default configuration options
                ...getEditorDefaults(),

                layoutDirectionPreference: 'vertical',

                previewUpscale: true,

                // This will set a square crop aspect ratio
                imageCropAspectRatio: 1,
            },
        },
        server: {
            url: '/temporary-upload',
            headers: {
              'X-CSRF-TOKEN': $('#tokenForImg').val(),
              'type': "POST",
            },
            process: {
                method: 'POST',
                onload: (fileUploadResponseString) => {
                    let fileUploadResponse = JSON.parse(fileUploadResponseString);

                    if (fileUploadResponse.newPictureId) {
                        if(mode === 'measuredUploadPond')
                        {
                            $('#measuredPictureId').val(fileUploadResponse.imgsrc);
                            $('#measuredPictureImg').attr('src', '/uploaded_file/'+fileUploadResponse.imgsrc);
                        }
                        else if(mode === 'assignedUploadPond')
                        {
                            $('#assignedPictureId').val(fileUploadResponse.newPictureId);
                        }
                        
                        //loadPictures();
                    }
                }
            }
        },
    });

    if(mode === 'measuredUploadPond')
    {
        window.measuredUploadPond = uploadPondResult;
    }
    else
    {
        window.assignedUploadPond = uploadPondResult;
    }
}

function loadPictures() {
    let data = {
        measuredPictureId: $('#measuredPictureId').val(),
        assignedPictureId: $('#assignedPictureId').val(),
    };

    let awsBucket = $('#awsBucket').val();

    $.post('/scheduler/beforeAndAfterPictures', data, function(r) {
        if (r.beforePictureFileName) {
            let beforePictureSrc = ( 'https://s3.amazonaws.com/' + awsBucket + '/' + r.beforePictureFileName );
            $('#beforePictureImg').attr('src', beforePictureSrc);
        }

        if (r.afterPictureFileName) {
            let afterPictureSrc = ( 'https://s3.amazonaws.com/' + awsBucket + '/' + r.afterPictureFileName );
            $('#afterPictureImg').attr('src', afterPictureSrc);
        }
    }, 'json');
}

$(document).ready(function () {
    $('#addBeforeAndAfter').click(function () {
        $(this).attr('disabled', 'disabled');

        $.post('/scheduler/doAddBeforeAndAfter', $('#beforeAndAfterForm').serialize(), function(r) {
            if (r.status) {
                if ($('#returnUrlWithAutoOpenParam').val() === '') {
                    window.location.href = '/scheduler/month';
                } else {
                    window.location.href = $('#returnUrlWithAutoOpenParam').val();
                }
            }
        }, 'json');
    });

    $('#showOnClientPortal').change(function () {
        if ($(this).is(':checked')) {
            $(this).val('1');
        } else {
            $(this).val('0');
        }
    });

    $('#updateBeforeAndAfter').click(function () {
        $(this).attr('disabled', 'disabled');

        $.post('/scheduler/doUpdateBeforeAndAfter', $('#beforeAndAfterForm').serialize(), function(r) {
            if (r.status) {
                if ($('#returnUrlWithAutoOpenParam').val() === '') {
                    window.location.href = '/scheduler/month';
                } else {
                    window.location.href = $('#returnUrlWithAutoOpenParam').val();
                }
            }
        }, 'json');
    });

    $('#deleteBeforeAndAfter').click(function () {
        bootbox.confirm({
            title: "Delete",
            message: "Are you sure you want to delete the before and after pictures?",
            className: "pl-3 pr-3",
            buttons: {
                confirm: {
                    label: 'Yes'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-light'
                }
            },
            callback: function (result) {
                if (result) {
                    $(this).attr('disabled', 'disabled');
                    let id = $('#beforeAndAfterId').val();

                    $.post('/scheduler/doDeleteBeforeAndAfter', {id: id}, function(r) {
                        if (r.status) {
                            if ($('#returnUrlWithAutoOpenParam').val() === '') {
                                window.location.href = '/scheduler/month';
                            } else {
                                window.location.href = $('#returnUrlWithAutoOpenParam').val();
                            }
                        }
                    }, 'json');
                }
            }
        });
    });

    setInterval(
        function() {
            window.measuredUploadPond.processFiles();
            //window.assignedUploadPond.processFiles();
        },
        1000
    );

    $('.loadingAnimation').css('display', 'none');
    $('.uploadFileContainer').css('display', 'block');
});
