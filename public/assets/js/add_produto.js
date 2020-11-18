var App = function(){

    var add_item_cart = function(){

        $('.btn-add-produto').on('click', function(){
            
            var produto_id = $(this).attr('data-id');

            $.ajax({
                type: 'post',
                url: BASE_URL +'carrinho/insert',
                dataType: 'json',
                data: {
                    produto_id: produto_id,
                },
                beforeSend: function(){
                    $('.btn-add-produto').html('<span class="text-white"><i class="fa fa-cog fa-spin"></i>&nbsp;adicionando...</span>');
                },
            }).then(function (response){
                $('.btn-add-produto').html('Adicionar');

                console.log(response);
            })
        });

    }

    return {
        init: function(){
            add_item_cart();
        }
    }

}();

jQuery(document).ready(function(){
    $(window).keydown(function (event){
        if(event.keyCode == 13){
            event.preventDefault();
            return false;
        }
    });

    App.init();

});