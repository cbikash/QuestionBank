// (function ($) {
//
//     $.vx.vxAjaxModal = function (options) {
//         return this.each(function () {
//             let defaults = $.extend({
//                 title: 'Modal Title',
//                 url: '',
//                 content: '',
//                 size: '',
//                 confirmation: '',
//                 onSuccess: function () {
//                 },
//                 onGetSuccess: function () {
//                 }
//             }, options)
//
//             let _self = $(this)
//             let _selfHTML = _self.html();
//             let modalTitle = _self.data('title') || defaults.title;
//             let modalContent = _self.data('content') || defaults.content;
//             let modalSize = _self.data('size') || defaults.size;
//             let callBackUrl = _self.data('url') || defaults.url;
//             let askConfirmation = _self.data('confirmation') || defaults.confirmation;
//             let onSuccessCallBack = _self.data('success-callback') || defaults.onSuccess;
//             let onGetSuccessCallBack = _self.data('get-success-callback') || defaults.onGetSuccess;
//
//             let modal = $(`
//                 <div class="modal fade custom-modal" role="dialog" data-backdrop="static" data-keyboard="false" aria-label="true">
//                     <div class="modal-dialog ${modalSize}">
//                         <div class="modal-content">
//                             <div class="modal-header bg-table-head">
//                                 <button type="button" class="close" data-dismiss="modal"><i class="icon-cross"></i></button>
//                                 <h6 class="modal-title">${modalTitle}</h6>
//                             </div>
//                             <div class="modal-body">${modalContent}</div>
//                         </div>
//                     </div>
//                 </div>
//         `);
//
//             let modalBody = modal.find('.modal-body');
//             let loaderTemplate = $(`<div class="spinner-border text-primary" role="status">
//                                   <span class="sr-only">Loading...</span>
//                                 </div>`);
//
//             if (!defaults.content) {
//                 modalBody.append(loaderTemplate);
//             }
//
//             let disabledSelf = () => {
//                 _self.html('');
//                 _self.html(`<div class="spinner-border text-primary" role="status">
//                                   <span class="sr-only">Loading...</span>
//                                 </div> Processing.........`)
//                 _self.prop('disable', true)
//             }
//
//             let enableSelf = () => {
//                 _self.html('')
//                 _self.html(_selfHTML);
//                 _self.prop('disable', false)
//
//             }
//
//             let loadForm = () => {
//                 disabledSelf();
//
//                 if (!callBackUrl) {
//                     modal.modal('show');
//                     return;
//                 }
//                 $.ajax({
//                     url: callBackUrl,
//                     type: 'get',
//                     success: function (res) {
//                         if (res.status !== undefined && res.status === false) {
//                             modal.modal('hide')
//                         } else {
//                             modalBody.html(res.template);
//                             onGetSuccessCallBack(modal, res, _self);
//                             modal.modal('show');
//                         }
//                         enableSelf();
//
//                     },
//                     error: function () {
//                         modal.remove();
//                         enableSelf();
//
//                     }
//                 })
//             }
//
//
//         })
//
//     }
//
// }(jQuery))