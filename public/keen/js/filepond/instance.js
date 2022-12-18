import {
    openEditor,
    processImage,
    createDefaultImageReader,
    createDefaultImageWriter,
    legacyDataToImageState,
    getEditorDefaults,
} from '/keen/js/pintura/pintura-js.js';

filePondWithEditor('satelliteUploadPond', 'input.satellite-upload-pond');
filePondWithEditor('frontUploadPond', 'input.front-upload-pond');
filePondWithEditor('measuredUploadPond', 'input.measured-upload-pond');


function filePondWithEditor(mode = 'satelliteUploadPond', selectorHandler = 'input.satellite-upload-pond')
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
                        if(mode === 'satelliteUploadPond')
                        {
                            $('#satellitePictureId').val(fileUploadResponse.imgsrc);
                            $('#satellitePictureImg').attr('src', '/uploaded_file/'+fileUploadResponse.imgsrc);
                        }
                        else if(mode === 'frontUploadPond')
                        {
                            $('#frontPictureId').val(fileUploadResponse.imgsrc);
                            $('#frontPictureImg').attr('src', '/uploaded_file/'+fileUploadResponse.imgsrc);
                        }
                        else if(mode === 'measuredUploadPond')
                        {
                            $('#measuredPictureId').val(fileUploadResponse.imgsrc);
                            $('#measuredPictureImg').attr('src', '/uploaded_file/'+fileUploadResponse.imgsrc);
                        }
                        
                        //loadPictures();
                    }
                }
            }
        },
    });

    if(mode === 'satelliteUploadPond')
    {
        window.satelliteUploadPond = uploadPondResult;
    }
    else if(mode === 'measuredUploadPond')
    {
        window.measuredUploadPond = uploadPondResult;
    }
    else
    {
        window.frontUploadPond = uploadPondResult;
    }
}

$(document).ready(function () {
    setInterval(
        function() {
            window.satelliteUploadPond.processFiles();
            window.frontUploadPond.processFiles();
            window.measuredUploadPond.processFiles();
        },
        1000
    );

    $('.loadingAnimation').css('display', 'none');
    $('.uploadFileContainer').css('display', 'block');
});
