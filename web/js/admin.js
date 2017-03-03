$(function(){
    console.log('loaded admin');

    $(document).on("click","tr[data-href]",function(e) {

        document.location.href = $(this).attr('data-href');
    });
})
