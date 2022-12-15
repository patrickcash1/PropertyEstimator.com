import {
    openEditor,
    processImage,
    createDefaultImageReader,
    createDefaultImageWriter,
    legacyDataToImageState,
    getEditorDefaults,
} from '/keen/js/pintura/pintura-js.js';

filePondWithEditor('assignedUploadPond', 'input.assigned-upload-pond');


function filePondWithEditor(mode = 'assignedUploadPond', selectorHandler = 'input.assigned-upload-pond')
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
                        $('#assignedPictureId').val(fileUploadResponse.imgsrc);
                        $('#assignedPictureImg').attr('src', '/uploaded_file/'+fileUploadResponse.imgsrc);
                    }
                }
            }
        },
    });

    window.assignedUploadPond = uploadPondResult;
}

$(document).ready(function () {
    setInterval(
        function() {
            window.assignedUploadPond.processFiles();
        },
        1000
    );

    $('.loadingAnimation').css('display', 'none');
    $('.uploadFileContainer').css('display', 'block');
});
