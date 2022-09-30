//toggle to active tab
if (location.hash) {
    $("a[href='" + location.hash + "']").tab("show");
}

let fnNotify = (message, type) => {
    $.notify(message, type);
};

let fnConfirm = (message) => {
    return confirm(message);
};

$(document.body).on("click", "a[data-toggle]", function (event) {
    location.hash = this.getAttribute("href");
});

//styled checkbox
$(".styled").uniform({
    radioClass: 'choice'
});

$(".control-success").uniform({
    radioClass: 'choice',
    wrapperClass: 'border-success-600 text-success-800'
});
//styled checkbox

$('.delete-item').on('click', function (e) {
    e.preventDefault()
    let c = confirm('Are you sure??')
    if (c) {
        window.location.href = $(e.target).closest('a').attr('href')
    }
})

function nepaliDatePicker(fromDateLabel = null, toDateLabel = null, _ele = null) {

    let datePickerClass = '.nepali-datepicker';

    if (_ele)
        datePickerClass = _ele.find(datePickerClass);

    $(datePickerClass).nepaliDatePicker({
        dateFormat: "%y-%m-%d",
        closeOnDateSelect: true,
    });

    fromDateLabel = fromDateLabel || 'from-date'
    toDateLabel = toDateLabel || 'to-date'

    let fromDateAdClass = `.${fromDateLabel}-ad`;
    let fromDateBsClass = `.${fromDateLabel}-bs`;

    let toDateAdClass = `.${toDateLabel}-ad`;
    let toDateBsClass = `.${toDateLabel}-bs`;

    if (_ele) {
        fromDateAdClass = _ele.find(fromDateAdClass);
        fromDateBsClass = _ele.find(fromDateBsClass);

        toDateAdClass = _ele.find(toDateAdClass);
        toDateBsClass = _ele.find(toDateBsClass);
    }

    $(fromDateBsClass).on("dateSelect", function (event) {
        let fromDateElem = $(fromDateAdClass)
        fromDateElem.data('daterangepicker').setStartDate(moment(event.datePickerData.adDate).format('YYYY-MM-DD'))
        fromDateElem.data('daterangepicker').setEndDate(moment(event.datePickerData.adDate).format('YYYY-MM-DD'))
        fromDateElem.data('daterangepicker').updateView()
        fromDateElem.data('daterangepicker').updateCalendars()
    });

    $(toDateBsClass).on("dateSelect", function (event) {
        let toDateElem = $(toDateAdClass)
        toDateElem.data('daterangepicker').setStartDate(moment(event.datePickerData.adDate).format('YYYY-MM-DD'))
        toDateElem.data('daterangepicker').setEndDate(moment(event.datePickerData.adDate).format('YYYY-MM-DD'))
        toDateElem.data('daterangepicker').updateView()
        toDateElem.data('daterangepicker').updateCalendars()
    });
}

function singleDatePickerBs(elemClass) {
    // $(`.${elemClass}`).datetimepicker({
    //     format: 'YYYY-MM-DD',
    //     useCurrent: false
    // })

    $(`.${elemClass}`).daterangepicker({
        timePicker: false,
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD'
        },
        singleDatePicker: true,
        autoUpdateInput: false
    });
}

function singleTimePicker(elemClass = 'datetime', attrs = {}) {
    $(`.${elemClass}`).daterangepicker({
        timePicker: true,
        startDate: moment(),
        locale: {
            format: 'YYYY-MM-DD HH:mm:ss'
        },
        singleDatePicker: true,
        drops: (attrs && attrs.drops) || 'up',
        useCurrent: false,
    });
}

function datePicker(elemClass = 'datepicker', attrs = {}) {
    $(`.${elemClass}`).daterangepicker({
        startDate: moment(),
        locale: {
            format: 'YYYY-MM-DD'
        },
        singleDatePicker: true,
        drops: (attrs && attrs.drops) || 'up',
        useCurrent: false
    });
}


function singleDatePicker(fromDateLabel = null, toDateLabel = null, _ele = null) {

    let datePickerClass = '.date-single, .datepicker';

    if (_ele)
        datePickerClass = _ele.find(datePickerClass);

    $(datePickerClass).daterangepicker({
        timePicker: false,
        showDropdowns: true,
        locale: {
            format: 'YYYY-MM-DD'
        },
        singleDatePicker: true,
        useCurrent: false
    });

    fromDateLabel = fromDateLabel || 'from-date'
    toDateLabel = toDateLabel || 'to-date'

    let fromDateAdClass = `.${fromDateLabel}-ad`;
    let fromDateBsClass = `.${fromDateLabel}-bs`;

    let toDateAdClass = `.${toDateLabel}-ad`;
    let toDateBsClass = `.${toDateLabel}-bs`;

    if (_ele) {
        fromDateAdClass = _ele.find(fromDateAdClass);
        fromDateBsClass = _ele.find(fromDateBsClass);

        toDateAdClass = _ele.find(toDateAdClass);
        toDateBsClass = _ele.find(toDateBsClass);
    }

    $(fromDateAdClass).on('apply.daterangepicker', function (ev, picker) {
        $(fromDateBsClass).val(pickerDateToBs(picker))
    });

    $(toDateAdClass).on('apply.daterangepicker', function (ev, picker) {
        $(toDateBsClass).val(pickerDateToBs(picker))
    });
}

//picker date to nepali date converter
function pickerDateToBs(picker) {
    let adYear = parseInt(picker.startDate.format('YYYY'));
    let adMonth = parseInt(picker.startDate.format('MM'));
    let adDay = parseInt(picker.startDate.format('DD'));
    let bsDateUnFormatted = calendarFunctions.getBsDateByAdDate(adYear, adMonth, adDay)
    return calendarFunctions.bsDateFormat("%y-%m-%d", bsDateUnFormatted.bsYear, bsDateUnFormatted.bsMonth, bsDateUnFormatted.bsDate);
}

function select2(className = 'select2', options = {}, cb) {
    $(`.${className}`).select2(options)
    if (typeof cb === 'function') cb()
}

function createActionModal(createPath, updatePath, modalTitle, modalId = 'commonModal', attrs = {}, modalSize = '') {
    createModalDomElement(modalId, modalSize);
    $(`#${modalId}`)
        .off('show.bs.modal')
        .on('show.bs.modal', function (e) {
            let target = e.relatedTarget
            let id = $(target).data('id')
            let modal = $(this)
            modal.find('.modal-body').html(`
                <div class="text-center">
                    <i class="icon icon-2x icon-gear spinner"></i>
                </div>
            `)
            let url = id ? updatePath.replace(/ID/g, id) : createPath
            $.ajax({
                url: url,
                success: function (data) {
                    if (data && data.success) {
                        modal.find('.modal-title').html(modalTitle)
                        modal.find('.modal-body').html(data.template)
                        $(`#${modalId}`)
                            .off('submit', 'form')
                            .on('submit', 'form', function (e) {
                                e.preventDefault()
                                let form = $(this).get(0)
                                $.ajax({
                                    url: url,
                                    method: 'POST',
                                    data: new FormData(form),
                                    contentType: false,
                                    processData: false,
                                    cache: false,
                                    beforeSend: function () {
                                        let submitBtn = form.querySelector('.submit-btn')
                                        if (submitBtn) submitBtn.setAttribute('disabled', 'disabled')
                                    },
                                    success: function (data) {
                                        if (data && data.success) {
                                            window.location.href = ''
                                        } else {
                                            modal.find('.modal-body').html(data.template)
                                        }
                                    }
                                })
                            })
                        if (attrs && typeof attrs.cb === 'function') attrs.cb()
                    }
                }
            })
        })
}

function timeRangeInputMask() {
    $('.timerangeinputmask').mask('00:00 AB - 00:00 AB', {
        translation: {
            'A': {pattern: /[aA|pP]/},
            'B': {pattern: /[mM]/}
        },
        placeholder: '06:00 AM - 12:00 PM'
    })
}

function createModalDomElement(modalId, modalSize) {
    if (document.getElementById(modalId)) document.getElementById(modalId).remove()
    let modalTemplate =
        `<div class="modal fade" id="${modalId}" tabindex="-1" role="dialog" aria-labelledby="${modalId}Label">
            <div class="modal-dialog ${modalSize}">
                <div class="modal-content">
                    <div class="modal-header bg-table-head">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="${modalId}Label">Loading...</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="icon icon-2x icon-gear spinner"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>`

    let modal = document.createElement('div')
    modal.innerHTML = modalTemplate
    document.querySelector('body').appendChild(modal.childNodes[0]);
}

//start select2Modal
function select2AddModal(target, path, title, modalId, modalSize = "") {
    createModalDomElement(modalId, modalSize)
    $(target)
        .select2()
        .off('select2:open')
        .on('select2:open', function () {
            $(".select2-results:not(:has(a))")
                .append(`
                    <a class='select2-results__option select2-btn select-2-action text-center'
                        style='display: block' data-toggle='modal' data-target='#${modalId}'>
                        Add ${title}
                    </a>
                `);
        })
    ;

    $(`#${modalId}`)
        .off('show.bs.modal')
        .on('show.bs.modal', function (e) {
            $(target).select2("close");
            var modal = $(this)
            var url = path
            $.ajax({
                url: url,
                success: function (data) {
                    if (data && data.success) {
                        modal.find('.modal-title').html(`${title} form`)
                        modal.find('.modal-body').html(data.template)
                        modal.find('form')
                            .off('submit')
                            .on('submit', function (e) {
                                e.preventDefault()
                                $.ajax({
                                    url: url,
                                    method: 'POST',
                                    data: $(this).serialize(),
                                    success: function (data) {
                                        if (data && data.success) {
                                            modal.modal('hide')
                                            $(target).children().prop('selected', false)
                                            let id = data.id || data.entity.id
                                            let val = data.val || data.entity.name
                                            $(target).append(`<option value="${id}" selected="selected">${val}</option>`)
                                        }
                                    }
                                })
                            })
                    }
                }
            })
        })
};


function timePicker(className = 'timepicker', _ele = null) {
    let timepicker = $(`.${className}`);

    if (_ele) {
        timepicker = _ele.find(`.${className}`)
    }

    timepicker.daterangepicker({
        timePicker: true,
        timePicker12Hour: true,
        timePickerIncrement: 1,
        timePickerSeconds: false,
        locale: {
            format: 'hh:mm A'
        },
        singleDatePicker: true
    })
        .on('show.daterangepicker', function (ev, picker) {
            picker.container.find(".calendar-table").hide();
        });
}

function calculateAge(date) {
    let birthday = new Date(date),
        ageDifMs = Date.now() - birthday.getTime(),
        ageDate = new Date(ageDifMs);
    return Math.abs(ageDate.getUTCFullYear() - 1970)
}

function roundNumber(num, scale) {
    if (!("" + num).includes("e")) {
        return +(Math.round(num + "e+" + scale) + "e-" + scale);
    } else {
        var arr = ("" + num).split("e");
        var sig = ""
        if (+arr[1] + scale > 0) {
            sig = "+";
        }
        return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
    }
}

function fnRoundNumber(num, scale = 2){
    if (!("" + num).includes("e")) {
        return +(Math.round(num + "e+" + scale) + "e-" + scale);
    } else {
        var arr = ("" + num).split("e");
        var sig = ""
        if (+arr[1] + scale > 0) {
            sig = "+";
        }
        return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);
    }
}
function deleteCollectionRow() {
    $(document).on('click', '.delete-collection-row', function (e) {
        e.preventDefault()
        let c = confirm('Are you sure??')
        if (!c) return
        let targetElement = $(this).data('target-element')
        $(this).closest(targetElement).remove()
    });
}

function yearPicker(elemClass = 'yearpicker') {
    $(`.${elemClass}`).datetimepicker({
        format: 'YYYY',
        viewMode: 'years',
        useCurrent: false
    })
}

function singleNepaliDatePicker(label, config, joinedDate = '') {
    let format = (config && config.format) || 'YYYY-MM-DD'
    let adElem = $(`.${label}-ad`)
    let bsElem = $(`.${label}-bs`)
    bsElem.nepaliDatePicker({
        dateFormat: "%y-%m-%d",
        closeOnDateSelect: true,
    });

    adElem.daterangepicker({
        timePicker: (config && config.timePicker),
        showDropdowns: true,
        locale: {
            format: format
        },
        singleDatePicker: true,
        autoUpdateInput: false
    });

    bsElem.on("dateSelect", function (event) {
        let labelElem = $(`.${label}-ad`)
        labelElem.data('daterangepicker').setStartDate(moment(event.datePickerData.adDate).format(format))
        labelElem.data('daterangepicker').setEndDate(moment(event.datePickerData.adDate).format(format))
        labelElem.data('daterangepicker').updateView()
        labelElem.data('daterangepicker').updateCalendars()
    });

    adElem.on('apply.daterangepicker', function (ev, picker) {

        var fromDate = picker.startDate.format('YYYY-MM-DD');

        if (joinedDate) {
            if (fromDate < joinedDate) {
                $.notify("From date should be grater than joined Date.", "Warning");
                $(this).val(' ');
                return false;
            }
        }
        $(this).val(picker.startDate.format('YYYY-MM-DD'));
        bsElem.val(pickerDateToBs(picker))
    });


    bsElem.on('dateSelect', function (e) {
        let convertedAdDate = e.datePickerData.adDate;
        let finalEngDate = nepToEngByEvent(convertedAdDate);
        adElem.val(finalEngDate);

        if (joinedDate) {
            let fromDate = Date.parse(finalEngDate);
            if (fromDate < Date.parse(joinedDate)) {
                $.notify("From date should be grater than joined Date.", "Warning");
                return false;
            }
        }
        adElem.trigger('change')
    });

    let nepToEngByEvent = (adDate) => {
        let newAdYear = adDate.getFullYear();
        let newAdMonth = adDate.getMonth() + 1;
        let newAdDate = adDate.getDate();

        return newAdYear + '-' + newAdMonth + '-' + newAdDate;
    }

}

function disableSubmitButton() {
    $(document).on('submit', 'form', function () {
        $(this).find('input[type=submit], button[type=submit]')
            .addClass('disabled')
            .attr('disabled', true)
    })
}

function numberToOrdinal(number) {
    if (!Number.isInteger(number)) return number;
    let ends = ['th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th'];
    return (((number % 100) >= 11) && ((number % 100) <= 13)) ? number + 'th' : number + ends[number % 10];
}

function bsDateTimePicker(elemClass = 'datetime-picker') {
    $(`.${elemClass}`).datetimepicker();
}


(function ($) {

    $.fn.singleDatePicker = function () {
        $(this).on("apply.daterangepicker", function (e, picker) {
            picker.element.val(picker.startDate.format(picker.locale.format));
        });
        return $(this).daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            singleDatePicker: true,
            autoUpdateInput: false
        });
    };

    $.fn.fnAjaxModal = function (options) {
        return this.each(function () {
            let defaults = $.extend({
                title: 'Modal Title',
                url: '',
                content: '',
                size: '',
                confirmation: '',
                onSuccess: function () {},
                onGetSuccess: function () {},
            }, options);

            let _self = $(this);
            let _selfHtml = _self.html();
            let modalTitle = _self.data('title') || defaults.title;
            let modalContent = _self.data('content') || defaults.content;
            let modalSize = _self.data('size') || defaults.size;
            let callbackUrl = _self.data('url') || defaults.url;
            let askConfirmation = _self.data('confirmation') || defaults.confirmation;
            let onSuccessCallback = _self.data('success-callback') || defaults.onSuccess;
            let onGetSuccessCallback = _self.data('get-success-callback') || defaults.onGetSuccess;
            let modal = $(`
                <div class="modal fade custom-modal" role="dialog" data-backdrop="static" data-keyboard="false" aria-label="true">
                    <div class="modal-dialog ${modalSize}">
                        <div class="modal-content">
                            <div class="modal-header bg-table-head">
                                <button type="button" class="close" data-dismiss="modal"><i class="icon-cross"></i></button>
                                <h6 class="modal-title">${modalTitle}</h6>
                            </div>
                            <div class="modal-body">${modalContent}</div>
                        </div>
                    </div>
                </div>
            `);
            let modalBody = modal.find('.modal-body');
            let loaderTemplate = $(`<i class="fa fa-spinner fa-spin"></i>`);
            if (!defaults.content) {
                modalBody.append(loaderTemplate);
            }

            let disableSelf = () => {
                _self.html('');
                _self.html('<i class="fa fa-spinner fa-spin"></i> Processing ...');
                _self.prop('disable', true);
            };

            let enableSelf = () => {
                _self.html('');
                _self.html(_selfHtml);
                _self.prop('disable', false);
            };

            let loadForm = () => {

                disableSelf();

                if (!callbackUrl) {
                    modal.modal('show');
                    return;
                }

                $.ajax({
                    url: callbackUrl,
                    type: 'get',
                    success: function (res) {
                        if (res.status !== undefined && res.status === false) {
                            modal.modal('hide');
                            fnNotify(res.message, 'error');
                        } else {
                            modalBody.html(res.template);
                            onGetSuccessCallback(modal, res, _self);
                            modal.modal('show');
                        }

                        enableSelf();
                    },
                    error: function () {
                        fnNotify('Oops!!! Something went wrong', "error");
                        modal.remove();
                        enableSelf();
                    }
                });
            };
            let submitForm = () => {
                let form = modalBody.find('form');
                let postData = form.serialize();
                let isMultiDataForm = form.find('input[type="file"]').length;
                let ajaxOptions = {
                    url: callbackUrl,
                    type: 'post',
                    data: postData,
                    success: function (res) {
                        postSuccess(res);
                    },
                    error: function () {
                        fnNotify('Oops!!! Something went wrong', "error");
                    },
                    complete: function () {
                        form.find('[type="submit"]').prop('disabled', false);
                    }
                };
                if (isMultiDataForm) {
                    postData = new FormData($(form)[0]);
                    ajaxOptions.data = postData;
                    ajaxOptions.cache = false;
                    ajaxOptions.contentType = false;
                    ajaxOptions.processData = false;
                }
                form.find('[type="submit"]').prop('disabled', true);
                $.ajax(ajaxOptions);
            };
            let postSuccess = (res) => {
                if (res.status === false) {
                    modalBody.html(res.template);
                    onGetSuccessCallback(modal, res, _self);
                } else {
                    onSuccessCallback(res, _self, modal);
                    fnNotify(res.message, "success");
                    modal.modal('hide');
                }
            };
            _self.on('click', function (e) {
                e.preventDefault();
                if (_self.data('disabled') === true) {
                    return;
                }
                let confirmRes = true;
                if(askConfirmation !== ''){
                    confirmRes = fnConfirm(askConfirmation);
                }
                if(confirmRes){
                    loadForm();
                }
            });

            modal.on('submit', 'form', function (e) {
                e.preventDefault();
                submitForm();
            });
        });
    };

    $.fn.fnSingleDatepicker = function (options) {
        return this.each(function () {
            let _self = $(this);
            _self.daterangepicker({
                timePicker: false,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD'
                },
                singleDatePicker: true,
                useCurrent: false
            });
        });
    };

    $.fn.fnPrint = function (options) {
        return this.each(function () {
            let defaults = $.extend({
                url: '',
                content: '',
                title: ''
            }, options);

            let _self = $(this);
            let _selfHtml = _self.html();
            let callbackUrl = _self.data('url') || defaults.url;
            let title = _self.data('title') || defaults.title;
            let modalContent = _self.data('content') || defaults.content;

            let disableSelf = () => {
                _self.html('');
                _self.html('<i class="fa fa-spinner fa-spin"></i> Processing ...');
                _self.prop('disable', true);
            };

            let enableSelf = () => {
                _self.html('');
                _self.html(_selfHtml);
                _self.prop('disable', false);
            };

            let initPrint = () => {
                disableSelf();
                if (!callbackUrl) {
                    openPrintWindow(modalContent);
                    enableSelf();
                }else{
                    $.ajax({
                        type:'POST',
                        data: "",
                        url:callbackUrl,
                        success:function (res) {
                            (res.status === true)
                                ? openPrintWindow(res.template)
                                : fnNotify(res.message, 'error');
                        },
                        error:function (res){ fnNotify('Something went wrong.', 'error'); },
                        complete: function(){ enableSelf(); }
                    });
                }
            };

            let openPrintWindow = (content) => {
                let frame1 = document.createElement('iframe');
                frame1.name = "frame1";
                frame1.style.position = "absolute";
                frame1.style.top = "-1000000px";
                document.body.appendChild(frame1);
                let frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
                frameDoc.document.open();
                frameDoc.document.write(`<html><head><title>${title}</title>`);
                frameDoc.document.write(`</head><body>`);
                frameDoc.document.write(content);
                frameDoc.document.write(`</body></html>`);
                frameDoc.document.close();
                setTimeout(function () {
                    window.frames["frame1"].focus();
                    window.frames["frame1"].print();
                    document.body.removeChild(frame1);
                }, 500);
                return false;
            };

            _self.on('click', function (e) {
                e.preventDefault();
                if (_self.data('disabled') === true) {
                    return;
                }
                initPrint();
            });
        });
    };

    $.fn.fnInitPaymentForm = function(options){

        return this.each(function(){
            let defaults = $.extend({
                chequeUrl: '',
                postUrl: '',
                successUrl: '',
                beforeSubmit: function(){},
            }, options);

            let fetchChequeUrl = defaults.chequeUrl;
            let postPaymentUrl = defaults.postUrl;
            let successRedirectUrl = defaults.successUrl || window.location.href;
            let wrapper = $(this);

            let initPaymentForm = (wrapper) => {

                let toggleBtn = wrapper.find('#initPaymentBtn');
                let formWrap = wrapper.find('#payment-form');
                let errorDiv = wrapper.find('#errorDiv');

                toggleBtn.on('click', function(e){
                    e.preventDefault();
                    formWrap.removeClass('hidden');
                    toggleBtn.addClass('hidden');
                });

                let cancelButton = wrapper.find('.cancelRecordPayment');
                cancelButton.on('click', function(e){
                    e.preventDefault();
                    formWrap.addClass('hidden');
                    toggleBtn.removeClass('hidden');
                });

                let modeEle = wrapper.find('.paymentMode');
                modeEle.on('change', function(){
                    let mode = $(this).val();
                    let bnkChargeEle = wrapper.find('.bankCharge');
                    bnkChargeEle.val('');
                    wrapper.find('.pAc').val('');
                    wrapper.find('.pAc').trigger('change');
                    wrapper.find('.p-mode-ele').addClass('hidden');
                    wrapper.find('.p-mode-ele .form-control').prop('required', false);
                    wrapper.find('.bnkCharge').removeClass('hidden');
                    switch(mode){
                        case 'cash':
                            wrapper.find('.p-cash').removeClass('hidden');
                            wrapper.find('.p-cash').find('.form-control').prop('required', true);
                            break;
                        case 'cheque':
                            wrapper.find('.p-cheque').removeClass('hidden');
                            wrapper.find('.p-cheque').find('.form-control').prop('required', true);
                            break;
                        case 'bank_transfer':
                            wrapper.find('.p-bank').removeClass('hidden');
                            wrapper.find('.p-bank').find('.form-control').prop('required', true);
                            break;
                        case 'advanced_receipt':
                        case 'advanced':
                            wrapper.find('.bnkCharge').addClass('hidden');
                            wrapper.find('.p-advance').removeClass('hidden');
                            wrapper.find('.p-advance').find('.form-control').prop('required', true);
                            break;
                        case 'work_advanced':
                            wrapper.find('.bnkCharge').addClass('hidden');
                            wrapper.find('.p-work-advance').removeClass('hidden');
                            wrapper.find('.p-work-advance').find('.form-control').prop('required', true);
                            break;
                        default:
                            break;
                    }
                });
                modeEle.trigger('change');

                let appliedRateEle = wrapper.find('.s_rate');
                appliedRateEle.on('keyup', function(e){
                    let ar = parseFloat($(this).val());
                    let amount = parseFloat(wrapper.find('.amount').val());
                    let amountLCY = fnRoundNumber(ar * amount);
                    wrapper.find('.amountLCY').val(amountLCY);
                });

                // local amount calculation
                let onFCYAmountChange = (_self) => {
                    let rateEle = wrapper.find('.s_rate');
                    let rate = rateEle.val();
                    let amountLCY = fnRoundNumber((_self.val() * rate));
                    wrapper.find('.amountLCY').val(amountLCY);
                };

                let amountEle = wrapper.find('.amount');
                amountEle.on('change', function(e){ onFCYAmountChange($(this)); });
                amountEle.on('keyup', function(e){ onFCYAmountChange($(this)); });
                amountEle.trigger('change');

                let updateBankChargeCurrency = (ele) => {
                    let bcEle = $('.bankChargeLabel');
                    if(bcEle.length){
                        bcEle.html(`Bank Charge`);
                        if(ele.val()){
                            let curCode = ele.find('option:selected').data('currency-code') || '';
                            bcEle.html(`Bank Charge (${curCode})`);
                        }
                    }
                };

                let bankSelect = $('.bankAccount');
                bankSelect.on('change', function () {
                    let _self = $(this);
                    if(fetchChequeUrl){
                        let bankAccountId = _self.val();
                        if(bankAccountId){
                            let url = fetchChequeUrl;
                            url = url.replace('ID', bankAccountId);
                            $.ajax({
                                type: 'post',
                                url: url,
                                data: {},
                                success: function(res){
                                    let html = '';
                                    $.each(res, function (id, lotNumber) {
                                        html = html + "<option value='"+id+"'>"+lotNumber+"</option>";
                                    });
                                    $(".chequeBookItem").html(html)
                                },
                                error: function(){}
                            });
                        }else{
                            $(".chequeBookItem").html(`<option value="">-- Cheque Number --</option>`)
                        }
                    }
                });

                bankSelect.trigger('change');

                let pmGl = $('.pAc');
                pmGl.on('change', function(e){
                    updateBankChargeCurrency($(this));
                });

                pmGl.trigger('change');

                // submit form
                if(postPaymentUrl){
                    let form = wrapper.find('form');
                    form.on('submit', function(e){
                        e.preventDefault();
                        defaults.beforeSubmit(form);
                        let _self = $(this);
                        let formData = new FormData(_self[0]);
                        errorDiv.html('');
                        _self.find('button').prop('disabled', true);
                        $.ajax({
                            url: postPaymentUrl,
                            type: 'POST',
                            data: formData,
                            success: function (response) {
                                if(response.status === true){
                                    if(response.message){
                                        fnNotify(response.message, 'success');
                                    }
                                    window.location = successRedirectUrl;
                                }else{
                                    errorDiv.html(response.message);
                                }
                                _self.find('button').prop('disabled', false);
                            },
                            contentType: false,
                            processData: false,
                            cache: false
                        });
                    });
                }

                // bill image upload
                let billImage = wrapper.find('#fn_payment_image');
                let showImage = wrapper.find('#showImage');
                let readURL = (e) => {
                    let input = e.target;
                    if (input.files && input.files[0]) {
                        let reader = new FileReader();
                        reader.onload = function (e) {
                            showImage.show();
                            showImage.attr('src', e.target.result);
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                };

                showImage.on('click', function () { billImage.click(); });
                billImage.on('change', readURL);


            };

            initPaymentForm(wrapper);



        });


    };

    $.fn.fnInventoryReceiveForm = function(options){

        return this.each(function(){
            let defaults = $.extend({
                makeTrigger: true,
                exchangeRates: {},
                triggerItemChange: false,
                onItemRowAdd: function(){}
            }, options);

            let _container = $(this);
            let makeTrigger = defaults.makeTrigger;
            let exRates = defaults.exchangeRates;

            let btnAddItemRow = _container.find('.addRowBtn');
            let itemHolder = _container.find('.item-holder');

            let makeCalculation = () => {
                let subTotal = 0;
                let vatAmount = 0;
                let collectionHolder = $('.item-holder');
                collectionHolder.find('.item-wrap').each(function(i,v){
                    let _self = $(v);
                    let quantity = _self.find('.quantity').val() || 0;
                    let rate = _self.find('.rate').val() || 0
                    let total = fnRoundNumber(parseFloat(quantity) * parseFloat(rate));

                    _self.find('.itemTotal').val(total);
                    subTotal = (subTotal + total) || 0;
                });

                subTotal = fnRoundNumber(subTotal);
                $('.sub-total').val(subTotal);

                let discountEle = $('.discount');
                let discountPriceEle = $('.discount-price');
                let totalAfterDiscountEle = $('.total-after-discount');

                let vatEle = $('.vat');
                let vatPriceEle = $('.vat-price');
                let tdsEle = $('.tds');
                let tdsPriceEle = $('.tds-price');
                let totalAfterVatEle = $('.total-after-vat');
                let grandTotalEle = $('.grand-total');

                let discountPercent = parseFloat(discountEle.val()) || 0;

                let discountPrice = fnRoundNumber((discountPercent) ? (discountPercent/100) * subTotal : 0);
                let totalAfterDiscount = fnRoundNumber(subTotal - discountPrice);

                let vatPercent = parseFloat(vatEle.val()) || 0;
                let vatPrice = fnRoundNumber((vatPercent) ? (vatPercent/100) * totalAfterDiscount : 0);

                let tdsPercent = parseFloat(tdsEle.val()) || 0;
                let tdsPrice = fnRoundNumber((tdsPercent) ? (tdsPercent/100) * totalAfterDiscount : 0);

                let totalAfterVat = fnRoundNumber(totalAfterDiscount + vatPrice);
                let grandTotal = fnRoundNumber(totalAfterVat - tdsPrice);

                discountPriceEle.val(discountPrice);
                totalAfterDiscountEle.val(totalAfterDiscount);
                totalAfterVatEle.val(totalAfterVat);
                vatPriceEle.val(vatPrice);
                tdsPriceEle.val(tdsPrice);
                grandTotalEle.val(grandTotal);

            };

            let onItemRowAdd = (_wrapper, triggerProductChange) => {
                _wrapper.find('.quantity').on('keyup', function(){
                    makeCalculation();
                });

                _wrapper.find('.rate').on('keyup', function(){
                    makeCalculation();
                });

                _wrapper.find('.deleteRow').on('click', function(e){
                    if(confirm('Are you sure to delete row?')){
                        e.preventDefault();
                        _wrapper.remove();
                        makeCalculation();
                    }
                });

                if(defaults.triggerItemChange){
                    let itemSelect = _wrapper.find('.pItem');

                    // itemSelect.select2().on('select2:open', function(){
                    //     let ele = $(this);
                    //     if (!$('.select-2-action').length) {
                    //         let button = $(`<button class="select2-btn select-2-action">Add New Item</button>`);
                    //         $('.select2-results').append(button);
                    //         button.on('click', function(e){
                    //             ele.select2('close');
                    //         });
                    //     }
                    // });

                    itemSelect.on('change',function () {
                        let _self = $(this);
                        let html = '';
                        let pckEle = _wrapper.find('.packaging');
                        let selectedUnit = pckEle.val();

                        if(_self.val()){
                            let pckJson = _self.find('option:selected').data('pck');
                            $.each(pckJson, function(i,v){
                                html = html + `<option value="${v.id}">${v.name}</option>`;
                            });
                        }

                        pckEle.html(html);
                        pckEle.val(selectedUnit);
                        pckEle.select2();
                    });

                    if(triggerProductChange){
                        itemSelect.trigger('change');
                    }
                }

                defaults.onItemRowAdd(_wrapper, defaults.makeTrigger);

            };

            _container.find('.amount-group').on('keyup', '.discount', function(){
                makeCalculation();
            });

            _container.find('.vat').on('keyup', function(){
                makeCalculation();
            });

            _container.find('.discount-price').on('keyup', function(){
                let val = parseFloat($(this).val()) || 0;
                let subTotal = $('.sub-total').val() || 0;
                let discountPercent = 0;
                if(val && subTotal){
                    discountPercent = ( val/subTotal) * 100;
                }
                $('.discount').val(discountPercent);
                makeCalculation();
            });

            _container.find('.vat-price').on('keyup', function(){
                let val = parseFloat($(this).val()) || 0;
                let totalAfterDiscount = $('.total-after-discount').val() || 0;
                let vatPercent = 0;
                if(val && totalAfterDiscount){
                    vatPercent = ( val/totalAfterDiscount) * 100;
                }
                $('.vat').val(vatPercent);
                makeCalculation();
            });

            _container.find('.tds').on('change', function(){
                makeCalculation();
            });

            $.each(itemHolder.find('.item-wrap'), function(i,v){
                onItemRowAdd($(v), false);
            });

            let currencyEle = _container.find('.currency');
            let rateObjEle = _container.find('.hidden-exchange-rate');
            let rateEle = _container.find('.appliedRate');

            currencyEle.on('change', function(e){
                let id = $(this).find(':selected').val();
                if(exRates.hasOwnProperty(id) ){
                    let rate = exRates[id];
                    rateObjEle.val(rate.id);
                    rateEle.val(rate.buyingRate);
                }else{
                    rateObjEle.val('');
                    rateEle.val('');
                    alert('Exchange rate not configured');
                }
            });

            currencyEle.trigger('change');

            btnAddItemRow.on('click', function(e){
                e.preventDefault();
                let collectionHolder = _container.find('.item-holder');
                let index = collectionHolder.data('index') + 1;
                collectionHolder.data('index', collectionHolder.find(':input').length);
                let prototype = collectionHolder.data('prototype');
                let newForm = $(prototype.replace(/__name__/g, index));
                collectionHolder.data('index', index + 1);
                collectionHolder.append(newForm);
                onItemRowAdd(newForm, false);
            });

            if(!itemHolder.find('.item-wrap').length){
                btnAddItemRow.trigger('click');
            }

            let vatAppliedChecked = _container.find('.vatApplied');
            let tdsAppliedChecked = _container.find('.tdsApplied');

            let vatCalcWrap = _container.find('.vatDetails');
            let tdsCalcWrap = _container.find('.tdsDetails');

            vatAppliedChecked.on('change', function(){
                $('.vat').val(0);
                makeCalculation();
                if($(this).prop('checked') === true){
                    vatCalcWrap.show();
                }else{
                    vatCalcWrap.hide();
                }
            });

            tdsAppliedChecked.on('change', function(){
                $('.tds').val(0);
                makeCalculation();
                if($(this).prop('checked') === true){
                    tdsCalcWrap.show();
                }else{
                    tdsCalcWrap.hide();
                }
            });

            if(makeTrigger){
                vatAppliedChecked.trigger('change');
                tdsAppliedChecked.trigger('change');
            }

            //profile image upload and preview script


            let readURL = (e)  => {
                let input = e.target;
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        showImage.show();
                        showImage.attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            };

            let billImage = $('.billImage');
            let showImage = $('#showImage');

            showImage.on('click', function () {
                billImage.click();
            });

            billImage.on('change', readURL);
        });
    };

    $.fn.fnFiscalYearFilter = function (options) {
        return this.each(function () {
            let defaults = $.extend({
                fromDateEle: null,
                toDateEle: null,
                format: 'YYYY-MM-DD'
            }, options);

            let _self = $(this);
            let fromDateEle = defaults.fromDateEle;
            let toDateEle = defaults.toDateEle;
            let pickerOptions = {
                format: 'yyyy-mm-dd',
                showDropdowns: true,
                autoclose : true,
                todayHighlight : true,
            };

            fromDateEle.datepicker(pickerOptions);


            toDateEle.datepicker(pickerOptions);

            fromDateEle.on('changeDate', function(ev,res){
                // console.log(toDateEle);
                // toDateEle.datepicker('option', 'setOption', {minDate:ev.date});
                // toDateEle.datepicker('option', 'minDate', ev.date);
                // toDateEle.datepicker('option', 'minDate', new Date(2021, 1 - 1, 1));
            });

            _self.on('change', function(e){
                let fySelect = $(this);
                let selectedOption = fySelect.find('option:selected');
                let fyStart = selectedOption ? selectedOption.data('from') : '';
                let fyEnd = selectedOption ? selectedOption.data('to') : '';
                if(fromDateEle) fromDateEle.val(fyStart);
                if(toDateEle) toDateEle.val(fyEnd);
            });

            let clearFySelect = () => {
                _self.val('');
                _self.select2();
            };

        });
    };

    $.fn.ysFormatAmount = function (options) {
        var defaults = $.extend({
            decimalPlace: 2,
            roundOff: false,
            callback: function () {
            }
        }, options);

        this.on('keyup', function (e) {
            let val = $(this).val().replace(/[^0-9\.]/g, '');
            if (val.indexOf('.') != -1) {
                if (val.split(".")[1].length > defaults.decimalPlace) {
                    if (defaults.roundOff) {
                        val = roundNumber(parseFloat(val), defaults.decimalPlace);
                        // val = parseFloat(val).toFixed(defaults.decimalPlace);
                    } else {
                        val = val.split(".")[0] + "." + val.split(".")[1].substr(0, defaults.decimalPlace);
                    }
                }
            }
            $(this).val(val);

            if (typeof defaults.callback == 'function') {
                defaults.callback();
            }

        });
        return this;
    };

    // $.fn.fnInitLeaveRequestForm = function(options){
    //     return this.each(function(){
    //         let defaults = $.extend({
    //             leaveInfoUrl: '',
    //             onSuccess: function(){},
    //         }, options);
    //
    //         let _self = $(this);
    //
    //         let leaveInfoUrl = defaults.leaveInfoUrl;
    //         _self.fnAjaxModal({
    //             size: 'modal-lg',
    //             onGetSuccess: function(modal, res, ele){
    //                 let datePickers = modal.find(`.fn-single-date-picker`);
    //                 let fromDatePicker = modal.find(`.fn-single-date-picker-from`);
    //                 let toDatePicker = modal.find(`.fn-single-date-picker-to`);
    //                 let leaveTypeSelect = modal.find(`.fn-leave-type-select`);
    //                 let submitButton = modal.find(':input[type="submit"]');
    //                 let formWrapper = modal.find(`#apply-form-wrap`);
    //
    //                 datePickers.fnSingleDatepicker();
    //
    //                 let leaveInformation = () => {
    //
    //                     let fromDate = fromDatePicker.val();
    //                     let toDate = toDatePicker.val();
    //                     let leaveTypeId = leaveTypeSelect.val() || null;
    //
    //                     toDate = toDate || fromDate;
    //
    //                     modal.find(`.tot-req-days`).val(0);
    //                     modal.find(`.tot-days`).val(0);
    //
    //                     modal.find("#totalLeaveDay").val('');
    //                     formWrapper.addClass('hidden');
    //                     submitButton.prop('disabled', true);
    //                     modal.find("#messageBlock").html('');
    //
    //                     if(fromDate && leaveTypeId && leaveInfoUrl){
    //
    //                         $.ajax({
    //                             type:'get',
    //                             url: leaveInfoUrl,
    //                             data:{from: fromDate, to: toDate, employeeLeaveInfo: leaveTypeId},
    //                             success:function (res) {
    //                                 modal.find("#messageBlock").html(res.template);
    //                                 if(res.eligible === true){
    //                                     modal.find("#totalLeaveDay").val(res.leaveDays);
    //                                     formWrapper.removeClass('hidden');
    //                                     submitButton.prop('disabled', false);
    //
    //                                     modal.find(`.tot-req-days`).val(res.leaveInfos.info.totalRequestLeave);
    //                                     modal.find(`.tot-days`).val(res.leaveInfos.info.resultLeave);
    //                                 }
    //                             },
    //                             error:function (res) {}
    //                         });
    //                     }
    //                 };
    //
    //                 submitButton.prop('disabled', true);
    //                 leaveTypeSelect.on('change', function () {
    //                     leaveInformation();
    //                 });
    //                 datePickers.on('apply.daterangepicker', function (e, picker) {
    //                     // if (picker.element.hasClass('fn-single-date-picker-from')){
    //                     //     toDatePicker.daterangepicker().setMinDate(picker.startDate);
    //                     // }
    //                     leaveInformation();
    //                 });
    //             },
    //             onSuccess: function(res, ele){
    //                 defaults.onSuccess(res, ele);
    //             }
    //         });
    //
    //
    //
    //     });
    //
    //
    // };


}(jQuery));

$(document).on('click', '.collection-add-btn', function () {
    $("html, body").animate({scrollTop: $(document).height() - $(window).height()});
});
