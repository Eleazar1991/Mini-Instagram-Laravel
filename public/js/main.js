var url="http://proyecto-laravel.com.devel/";
window.addEventListener("load",function(){

    $('.btn-like').css('cursor','pointer')
    $('.btn-dislike').css('cursor','pointer')

    //Boton de like
    function like(){
        $('.btn-like').unbind('click').click(function(){
            $(this).addClass('btn-dislike').removeClass('btn-like')
            $(this).attr('src',url+'img/hearts-64-gray.png');

            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),
                type: 'GET',
                success:response=>console.log(response),
                error:response=>console.log(response)
            })
            dislike();
        })
    }
    like();
    //Boton de dislike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){
            $(this).addClass('btn-like').removeClass('btn-dislike')
            $(this).attr('src',url+'img/hearts-64-red.png');
            
            $.ajax({
                url: url+'/like/'+$(this).data('id'),
                type: 'GET',
                success:response=>console.log(response),
                error:response=>console.log(response)
            })
            like();
        })
        
    }
    dislike();

    //Buscador
    $('#buscador').submit(function(){
        console.log($('#search').val());
        $(this).attr('action',url+'all/'+$('#search').val());
    })
})