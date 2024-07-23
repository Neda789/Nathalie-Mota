// Ajoutez ce fichier comme `load-more.js` dans votre dossier de thème et incluez-le dans `functions.php`
jQuery(document).ready(function($){
    $('#load-more').on('click', function(){
        var button = $(this);
        var data = {
            'action': 'loadmore',
            'page': button.data('page'),
            'nonce': button.data('nonce')
        };

        $.ajax({
            url : button.data('url'),
            data : data,
            type : 'POST',
            beforeSend : function ( xhr ) {
                button.text('Loading...'); // Change button text
            },
            success : function( data ){
                if( data ) { 
                    button.text('Charger plus').data('page', data.next_page);
                    $('.catalogue_photos').append(data.content); 
                } else {
                    button.text('No more posts'); 
                    button.prop('disabled', true);
                }
            }
        });
    });
});
