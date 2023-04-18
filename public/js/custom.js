/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/custom.js ***!
  \********************************/
$(document).ready(function () {
  $('#save_comment').on('click', function (e) {
    e.preventDefault();
    var body = $('textarea[name="body"]').val();
    $.ajax({
      url: $(this).closest('form').attr('action'),
      type: "POST",
      data: {
        body: body
      },
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(data) {
        $('textarea[name="body"]').val('');
        $("#comments_container").prepend(data);
      },
      error: function error(msg) {
        console.log('Error');
      }
    });

  }); // setTimeout(function(){
  //     $.ajax({
  //         url: "/api/v1/view?id=" + $('article').data('post_id'),
  //         type: "PATCH",
  //         headers: {
  //             'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  //         },
  //
  //         success: function (data) {
  //             $('.views span').text(data)
  //         },
  //         error: function (msg) {
  //             console.log('Error');
  //         }
  //     });
  // }, 5000);

  $('#like_btn').on('click', function (e) {
    e.preventDefault();
    $.ajax({
      url: "/api/v1/like?id=" + $('article').data('post_id'),

      type: "POST",
      headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
        'Authorization': "Bearer " + $('input[name="access_token"]').val()
      },
      success: function success(data) {
        $('#like_btn').toggleClass('bg-gray-800');
        $('#like_btn span').text(data);
      },
      error: function error(msg) {
        console.log(msg);
      }
    });
  });
});
/******/ })()
;