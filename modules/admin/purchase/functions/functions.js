

loadInvTable();
function loadInvTable() {
  var inv = $('#loadInvTable').data('id');
  $("#loadInvTable").load("loadInvTable.php", { inv: inv }, function () { });
}

function printModal() {
  const printContents = document.getElementById('invModal').innerHTML;
  const originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}

function reset_filter() {
  window.location.href = 'index.php';
}

$(document).ready(function () {
  if (user_req == 1) {
    $('.request_col').show();
  } else {
    $('.request_col').hide();
  }
});

function printPage() {
  $('.edit_row').hide();
  window.print();
  setTimeout(function () {
    $('.edit_row').show();
  }, 1000);
}