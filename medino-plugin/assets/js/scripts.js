//like query
jQuery ( document ) . ready( function ($) {

    $( '.medino-upvote' ) . on ( 'click', function(e) {

        e.preventDefault();

        let post_id = jQuery( this ) . attr( 'id' );
        console.log ( post_id );

        jQuery.ajax({
            type: 'post',
            dataType: 'json',
            url: my_ajax_object.ajax_url,
            data: {
                action: 'medino_like_button',
                post_id: post_id,
            },
            success: function(msg) {
                console.log(msg);
            }
        });
    });
});

//hate query
jQuery ( document ) . ready( function ($) {

    $( '.medino-downvote' ) . on ( 'click', function(e) {

        e.preventDefault();

        let post_id = jQuery( this ) . attr( 'id' );
        console.log ( post_id );

        jQuery.ajax({
            type: 'post',
            dataType: 'json',
            url: my_ajax_object.ajax_url,
            data: {
                action: 'medino_hate_button',
                post_id: post_id,
            },
            success: function(msg) {
                console.log(msg);
            }
        });
    });
});