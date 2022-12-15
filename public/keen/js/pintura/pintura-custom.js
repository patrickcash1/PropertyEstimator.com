function showImageBuilder(imageSource, options)
{
    var loadLib = 'pintura';
    var currentView = $('#current-page-view').val();

    if(window.libCurrentSettings)
    {
        loadLib = window.libCurrentSettings;
    }

    if (imageSource) {
        var id = options.id;

        let imageData = ( 'data:image/png;base64,' + imageSource );

        if(loadLib === 'pintura')
        {
            let doka = $.fn.pintura.openDefaultEditor({
                src: imageData,
                layoutDirectionPreference: 'vertical',
                previewUpscale: true,
                imageWriter: {
                    store: (state, options, onprogress) =>
                        new Promise((resolve, reject) => {
                            const { dest } = state;

                            const formData = new FormData();

                            formData.append('editedPicture', dest);
                            formData.append('id', id);

                            $.ajax({
                                type: "POST",
                                enctype: 'multipart/form-data',
                                url: "/editPicture",
                                data: formData,
                                processData: false,
                                contentType: false,
                                cache: false,
                                timeout: 600000,
                                dataType: 'json',
                                success: function (r) {
                                    if (r.status) {
                                        resolve(state);

                                        initiatedUtilities(currentView);
                                    }
                                }
                            });
                        }),
                }
            });

            doka.handleEvent = (type, detail) => {
                if (type === 'close' || type === 'hide') {
                    $(".ui-tooltip").remove();
                }
            };
        }
        else
        {
            let doka = Doka.create({
                outputData: true,
                outputFile: true,
                afterCreateOutput: (output, setLabel) => new Promise((resolve, reject) => {
                    const { file, data } = output;

                    setLabel('Uploading image…');

                    const formData = new FormData();
                    formData.append('editedPicture', file);
                    formData.append('id', id);

                    $.ajax({
                        type: "POST",
                        enctype: 'multipart/form-data',
                        url: "/editPicture",
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        timeout: 600000,
                        dataType: 'json',
                        success: function (r) {
                            if (r.status) {
                                resolve(output);

                                initiatedUtilities(currentView);
                            }
                        }
                    });
                })
            });

            doka.open(imageData);
        }
    }
}

/**
 * will load the utilities after succesful editor saved images
 * @param currentView
 */
function initiatedUtilities(currentView)
{
    if(currentView === 'customers')
    {
        let custId = $("#custom_id").val();
        let url = ('/customers/pictures/' + custId);

        $.get(url, function(html) {
            $('#custPictures').html(html);
            addCustomerPicturesEventHandlers();
        });
    }
    else if(currentView === 'finance_invoice')
    {
        let invoiceId = $("#inv_id").val();
        let url = ('/finances/invoices/pictures/' + invoiceId);

        $.get(url, function(html) {
            $('#invoicePictures').html(html);
            addInvoicePicturesEventHandlers();
        });
    }
    else if(currentView === 'finance_estimates')
    {
        let estimateId = $("#est_id").val();
        let url = ('/finances/estimates/pictures/' + estimateId);

        $.get(url, function(html) {
            $('#estimatePictures').html(html);
            addEstimatePicturesEventHandlers();
        });
    }
    else if(currentView === 'assets')
    {
        let assetId = $('#assets_id').val();
        let url = ('/assets/details/pictures/' + assetId);

        $.get(url, function(html) {
            $('#imageContainer').html(html);
            addPictureEventHandlers();
        });
    }
    else if(currentView === 'expenses')
    {
        let expenseId = $('#expenseId').val();
        let url = ('/expenses/pictures/' + expenseId);

        $.get(url, function(html) {
            $('#expensePictures').html(html);
            addExpensePicturesEventHandlers();
        });
    }
    else if(currentView === 'chemical_app')
    {
        let chemId = $("#chemapp_id").val();
        let url = ('/chemicals/chemical-application/pictures/' + chemId);

        $.get(url, function(html) {
            $('#chemicalApplicationPictures').html(html);
            addChemAppPicturesEventHandlers();
        });
    }
    else if(currentView === 'chemical_track')
    {
        let chemId = $("#chem_id").val();
        let url = ('/chemicals/pictures/' + chemId);

        $.get(url, function(html) {
            $('#chemPictures').html(html);
            addChemPicturesEventHandlers();
        });
    }
    else if(currentView === 'equipment')
    {
        let equipmentId = $('#equip_id').val();
        let url = ('/resources/trucks-equipment/pictures/' + equipmentId);

        $.get(url, function(html) {
            $('#equipmentPictures').html(html);
            addEquipmentPicturesEventHandlers();
        });
    }
    else if(currentView === 'scheduler_upload')
    {
        let visitId = $("#e_id").val();
        let url = ('/scheduler/pictures/' + visitId);

        $.get(url, function(html) {
            $('#visitPictures').html(html);
            addVisitPicturesEventHandlers();
        });
    }
    else if(currentView === 'scheduler_recurring')
    {
        let visitId = $("#rec_id").val();
        let url = ('/scheduler/recurring/pictures/' + visitId);

        $.get(url, function(html) {
            $('#visitPictures').html(html);
            addVisitPicturesEventHandlers();
        });
    }
    else if(currentView === 'vendor')
    {
        let vendorId = $("#vendor_id").val();
        let url = ('/vendors-suppliers/pictures/' + vendorId);

        $.get(url, function(html) {
            $('#custPictures').html(html);
            addCustomerPicturesEventHandlers();
        });
    }
}

$(document).on('click', '.editPicture', function () {
    let id = $(this).data('id');

    $.ajax({
        type: 'GET',
        url: ('/getBase64ForPicture/' + id),
        dataType: 'json',
        success: function (r) {
            if (r.status) {
                if (r.base64) {
                    var options = {'id': id};
                    showImageBuilder(r.base64, options);

                    // let doka = Doka.create({
                    //     outputData: true,
                    //     outputFile: true,
                    //     afterCreateOutput: (output, setLabel) => new Promise((resolve, reject) => {
                    //         const { file, data } = output;
                    //
                    //         setLabel('Uploading image…');
                    //
                    //         const formData = new FormData();
                    //         formData.append('editedPicture', file);
                    //         formData.append('id', id);
                    //
                    //         $.ajax({
                    //             type: "POST",
                    //             enctype: 'multipart/form-data',
                    //             url: "/editPicture",
                    //             data: formData,
                    //             processData: false,
                    //             contentType: false,
                    //             cache: false,
                    //             timeout: 600000,
                    //             dataType: 'json',
                    //             success: function (r) {
                    //
                    //                 if (r.status) {
                    //                     resolve(output);
                    //
                    //                     let estimateId = $("#est_id").val();
                    //                     let url = ('/finances/estimates/pictures/' + estimateId);
                    //
                    //                     $.get(url, function(html) {
                    //                         $('#estimatePictures').html(html);
                    //                         addEstimatePicturesEventHandlers();
                    //                     });
                    //                 }
                    //             }
                    //         });
                    //     })
                    // });
                    // let base64 = r.base64;
                    // let imageData = ( 'data:image/png;base64,' + base64 );
                    // doka.open(imageData);
                }
            }
        }
    });
});

// $('.editPicture').off('click').on('click', function () {
//     let id = $(this).data('id');
//     let currentPageView = $('#current-page-view').val();
//
//     $.ajax({
//         type: 'GET',
//         url: ('/getBase64ForPicture/' + id),
//         dataType: 'json',
//         success: function (r) {
//             if (r.status) {
//                 showImageBuilder(r.base64,currentPageView);
//             }
//         }
//     });
// });
