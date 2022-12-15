$(document).ready(function () {

    var firstDayOfWeek = $("#weekstart").val();
    firstDayOfWeek = parseInt(firstDayOfWeek);

    var df = $("#dateFormat").val();
    var momentJsDateFormat = '';
    var jqueryDatePickerDateFormat = '';

    if (df === 'D M d, Y') {
        momentJsDateFormat = 'ddd MMM DD, YYYY';
        jqueryDatePickerDateFormat = 'D M dd, yy';
    }

    if (df === "M d, Y") {
        momentJsDateFormat = 'MMM DD, YYYY';
        jqueryDatePickerDateFormat = 'M dd, yy';
    }

    if (df === 'M d, y') {
        momentJsDateFormat = 'MMM DD, YY';
        jqueryDatePickerDateFormat = 'M dd, y';
    }

    if (df === 'm/d/y') {
        momentJsDateFormat = 'MM/DD/YY';
        jqueryDatePickerDateFormat = 'mm/dd/y';
    }

    if (df === 'm/d/Y') {
        momentJsDateFormat = 'MM/DD/YYYY';
        jqueryDatePickerDateFormat = 'mm/dd/yy';
    }

    if (df === 'd/m/y') {
        momentJsDateFormat = 'DD/MM/YY';
        jqueryDatePickerDateFormat = 'dd/mm/y';
    }

    if (df === 'd-M-y') {
        momentJsDateFormat = 'DD-MMM-YY';
        jqueryDatePickerDateFormat = 'dd-M-y';
    }

    if (df === 'd-M-Y') {
        momentJsDateFormat = 'DD-MMM-YYYY';
        jqueryDatePickerDateFormat = 'dd-M-yy';
    }

    if (df === 'd-m-Y') {
        momentJsDateFormat = 'DD-MM-YYYY';
        jqueryDatePickerDateFormat = 'dd-mm-yy';
    }

    if (df === 'd M Y') {
        momentJsDateFormat = 'DD MMM YYYY';
        jqueryDatePickerDateFormat = 'dd M yy';
    }

    if (df === 'Y-m-d') {
        momentJsDateFormat = 'YYYY-MM-DD';
        jqueryDatePickerDateFormat = 'yy-mm-dd';
    }

    if (df === 'd/m/Y') {
        momentJsDateFormat = 'DD/MM/YYYY';
        jqueryDatePickerDateFormat = 'dd/mm/yy';
    }

    if (df === 'j F Y') {
        momentJsDateFormat = 'D MMMM YYYY';
        jqueryDatePickerDateFormat = 'd MM yy';
    }

    if (df === 'F j, Y') {
        momentJsDateFormat = 'MMMM D, YYYY';
        jqueryDatePickerDateFormat = 'MM d, yy';
    }

    if (df === 'd/m/y') {
        momentJsDateFormat = 'DD/MM/YY';
        jqueryDatePickerDateFormat = 'dd/mm/y';
    }

    if (df === 'Y/m/d') {
        momentJsDateFormat = 'YYYY/MM/DD';
        jqueryDatePickerDateFormat = 'yy/mm/dd';
    }

    if (momentJsDateFormat === '') {
        momentJsDateFormat = 'DD MMM YYYY';
    }

    if (jqueryDatePickerDateFormat === '') {
        jqueryDatePickerDateFormat = 'dd M yy';
    }

    window.momentJsDateFormat = momentJsDateFormat;
    window.jqueryDatePickerDateFormat = jqueryDatePickerDateFormat;
    window.firstDayOfWeek = firstDayOfWeek;

    window.dateRangePickerOptions = {
        startDate: moment($("#sdate").val(), "YYYY-MM-DD"),
        endDate: moment($("#edate").val(), "YYYY-MM-DD"),
        applyButtonClasses: 'btn btn-primary mt-3 mt-md-0',
        cancelButtonClasses: 'btn btn-light mt-3 mt-md-0',
        locale: {
            format: window.momentJsDateFormat,
            firstDay: window.firstDayOfWeek
        },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'This Week': [moment().startOf('week'),moment().endOf('week')],
            'Last Week': [moment().subtract(1, 'week').startOf('week'), moment().subtract(1, 'week').endOf('week')],
            'This Week-to-Date': [moment().startOf('week'), moment()],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'Last 60 Days': [moment().subtract(59, 'days'), moment()],
            'Last 90 Days': [moment().subtract(89, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'This Month-to-Date': [moment().startOf('month'), moment()],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'This Year': [moment().startOf('year'), moment().endOf('year')],
            'This Year to Date': [moment().startOf('year'), moment()], 
            'Last Year': [moment().subtract(1, "y").startOf("year"), moment().subtract(1, "y").endOf("year")]
        }
    }

    var startDateHidden = $("#sdate");
    var endDateHidden = $("#edate");

    $('#reportrange').daterangepicker(
        window.dateRangePickerOptions,
        function (start, end) {
            $('#reportrange span').html(start.format(window.momentJsDateFormat) + ' - ' + end.format(window.momentJsDateFormat));
            startDateHidden.val(start.format("YYYY-MM-DD"));
            endDateHidden.val(end.format("YYYY-MM-DD"));
            return false;
        }
    );

    $('#reportrange span').html(moment(startDateHidden.val(), "YYYY-MM-DD").format(window.momentJsDateFormat) + ' - ' + moment(endDateHidden.val(), "YYYY-MM-DD").format(window.momentJsDateFormat));

    $("#command-learnmore").on("click", function () {
        var commandHTML = $('#command-popup-info').html();
        bootbox.alert({
            message: commandHTML,
            className: 'command-learnmore'
        });
        return false;
    });

    $("#login_to_franchise").click(function(){
        var htmlStr = $("#franchise-login-popup").html();
        var dialog  = bootbox.dialog({
            title: "Login to Franchise",
            message: htmlStr,
            className: "franchise-login-popup",
            buttons: {
                cancel: {
                    label: "Cancel",
                    className: 'btn-light border',
                    callback: function(){
                        $("#franchise-login-popup").html(htmlStr);
                    }
                },
                loginFranchise: {
                    label: "Login to Franchise",
                    className: 'btn-primary do-franchise-login-btn',
                    callback: function(){
                        btnLoadingState(".do-franchise-login-btn");

                        var choose_franchise    = $('#choose_franchise').val();
                        var choose_category     = $('#choose_category').val();
                        var master_id           = $('#master_id').val();

                        $.post('/command-center/sub-account-login', { master_id: master_id, choose_franchise:choose_franchise, choose_category:choose_category}, function (r) {
                            console.log(r)
                            if (r.status) {
                                window.location.href = r.url;
                            }
                            else {
                                bootbox.alert('Error: Invalid Sub Account');
                                btnRetrieveState(".do-franchise-login-btn", "Login to Franchise");
                                return false;
                            }
                        }, "json");
                    }
                }
            },
            onHide: function() {
                $("#franchise-login-popup").html(htmlStr);
            }
        });

        dialog.init(function(){
            $("#franchise-login-popup").html('');
            $("#choose_franchise").select2({
                dropdownParent: $(".franchise-login-popup .modal-content"), 
                theme: "bootstrap4",
                minimumResultsForSearch: 10
            });
            $("#choose_category").select2({
                dropdownParent: $(".franchise-login-popup .modal-content"),
                theme: "bootstrap4",
                minimumResultsForSearch: 10
            });

        });
        return false;
    });

    function btnLoadingState(butid){
        $(butid).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>  Loading...')
    }

    function btnRetrieveState(butid,title){
        $(butid).removeAttr('disabled');
        $(butid).html(title);
    }


    $("#addFranchise").click(function () {
        btnLoadingState("#addFranchise");
        var subAccountID = $('#add_account').val();
        $.post('/command-center/add-sub-account', { subAccountID: subAccountID}, function (r) {
            if (r.status) {
                bootbox.alert(subAccountID + ' is now your sub account');
                btnRetrieveState("#addFranchise", "Add Franchise");
            }
            else {
                bootbox.alert('Error: Invalid ID');
                btnRetrieveState("#addFranchise", "Add Franchise");
                return false;
            }
        }, "json");
    });
});
