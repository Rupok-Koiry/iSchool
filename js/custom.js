$(document).ready(function () {
  $(function () {
    $("#playlist li a").on('click', function (e) {
      e.preventDefault();
      $("#videoarea").attr({
        src: $(this).attr("movieurl"),
      })
    })
    $("#videoarea").attr({
      src: $("#playlist li a").eq(0).attr("movieurl"),
    })
  })
})
