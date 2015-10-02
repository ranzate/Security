$(function() {
    $('input:checkbox').uniform();
    if($("#acoes-ids option:selected").length > 0){
        $.each($("#acoes-ids").val(), function(index, val) {
            $('input:checkbox[value="'+val+'"]').trigger('click');
        });
    }
    $("#listgrupo").on('click', 'input:checkbox', function(event) {
        checked = $(this).filter(':checked').length;
        if(checked){
            $("#acoes-ids").find('option[value="'+$(this).val()+'"]').attr('selected', true);
        }else{
            $("#acoes-ids").find('option[value="'+$(this).val()+'"]').attr('selected', false);
        }
    });

});