window.addEventListener('load', function () {
    let url = 'http://larapic.test/';

    function like() {
        $('.btn_like').unbind('click').click(function (e) {
            e.preventDefault();
            console.log('liked')
            $(this).children('.fa-heart').removeClass('far').addClass('fas').addClass('liked');
            $(this).removeClass('btn_like').addClass('btn_dislike');

            $.ajax({
                url: url + '/like/' + $(this).data('id'),
                type: 'get',
                success: (response) => {
                    if (response.like) {
                        console.log('has dado like a la publicacion');
                    } else {
                        console.log(response.message);
                    }
                }
            })

            dislike();
        });
    }
    like();

    function dislike() {
        $('.btn_dislike').unbind('click').click(function (e) {
            e.preventDefault();
            console.log('disliked')
            $(this).children('.fa-heart').removeClass('fas').removeClass('liked').addClass('far');
            $(this).removeClass('btn_dislike').addClass('btn_like');

            $.ajax({
                url: url + '/dislike/' + $(this).data('id'),
                type: 'get',
                success: (response) => {
                    if (response.dislike) {
                        console.log('has dado dislike a la publicacion');
                    } else {
                        console.log(response.message);
                    }
                }
            })

            like()
        })
    }
    dislike();
});
