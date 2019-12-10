// $('body').on('click','.deleteForm',function(e) {

$('body').on('click','.newdelete',function(e) {

  // let url = $(this).parent().attr('action');
  let url = /user_delete/;
  let token = $($('input[name="_token"]')[0]).val()
  let method = 'DELETE';

  url += $(this).val();
  console.log(url);

  user_row = $(this).parent().parent();

  $.ajax({
    type: "POST",
    url: url,
    data: {
      "_method": method,
      "_token": token,
    },
    success: function(response){
      console.log(response.success);

      user_row.fadeOut(400, function(){
        user_row.remove();
      });
    }
  });

})

$('.deleteForm .delete').click(function(e) {
  e.stopPropagation();
  e.preventDefault();
  console.log("Ajax has been called");

  let url = $(this).parent().attr('action');
  let token = $(this).prev().val();
  let method = $(this).prev().prev().val();

  let user_row = $(this).parent().parent().parent();

  $.ajax({
    type: "POST",
    url: url,
    data: {
      "_method": method,
      "_token": token,
    },
    success: function(response){
      user_row.fadeOut(400, function(){
        user_row.remove();
      });

      console.log(response.success);
    }
  });
});


$('.unverifiyForm .unverify').click(function(e) {
  e.stopPropagation();
  e.preventDefault();
  console.log("Ajax has been called");

  let url = $(this).parent().attr('action');
  let token = $(this).prev().val();
  let method = $(this).prev().prev().val();

  let user_row = $(this).parent().parent().parent();

  $.ajax({
    type: "POST",
    url: url,
    data: {
      "_method": method,
      "_token": token,
    },
    success: function(response){
      console.log(response.success);

      alert('User has been unverfied!');
    }
  });
});

  // automatically focus the search input field
$(document).keydown(function(e) {
  if ( ! $('#search').is(":focus") ) {
    $('#search').focus();
  }
});

// $('.searchForm #search').keydown(function(e) {
$('.searchForm').submit(function(e){
  e.preventDefault();
})

$('.searchForm #search').keyup(function(e) {
    // e.stopPropagation();
    // e.preventDefault();
    console.log("Ajax has been called");

    let search = $('#search').val();
    // search = search.normalize("NFD").replace(/[\u0300-\u036f]/g, "")
    search = search.toLowerCase();

    let url = $(this).parent().parent().attr('action') + '/' + search;
    // let token = $(this).parent().prev().val();
    // let method = $(this).parent().prev().prev().val();


    if (search == '') {
      $('.defaultContent').show();
      $('.pagination').show();

      $('.searchtable').remove();
      return
    }

    $.get( url ).done(function(response){
      if (response.length) {
        $('.defaultContent').hide();
        $('.pagination').hide();

        $('.searchtable').remove();

        let newsearchtable = maketable(response);
        $('#searchcontent').append(newsearchtable);
        // newsearchtable.html().insertAfter('#create');
      }

    });

    // $.ajax({
    //   type: "GET",
    //   url: url,
    //   // data: {
    //   //   "_method": method,
    //   //   "_token": token,
    //   // },
    // }).done(function(response){
    //   console.log(response);
    // });
});

function maketable(data) {
  // let table     = $('<table class="searchtable table table-bordered"><table>');

  let table     = '<table class="searchtable table table-bordered">'
  let tablehead = '<thead><tr><th style="padding-left: 15px;">#</th><th>Name</th><th>Phone</th><th>Email</th><th width="110px;">Action</th></tr></thead>';
  // console.log(data);
  let tablebody = '<tbody>';
  $.each( data, function( key, value ) {
    let deletebtn = '<input class="newdelete delete btn btn-danger btn-sm" type="submit" value="'+value.id+'">'
    // console.log(value);
    // console.log(value.id);
    tablebody += '<tr><td style="padding-left: 15px;">' + value.id + '</td><td>' + value.name + '</td><td>' + value.phone +'</td><td>' + value.email + '</td><td width="110px;">' + deletebtn + '</t></tr>';
  });
  tablebody += '</tbody><table>';
  // console.log(tablebody);

  return table + tablehead + tablebody;
}
