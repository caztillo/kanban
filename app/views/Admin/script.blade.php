$(document).ready(function(){


    $('.filterable .btn-filter').click(function(e)
    {
        e.preventDefault();
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $search = $(this).siblings('button[type="submit"]'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true)
        {
            $search.fadeIn();
            $filters.prop('disabled', false);
            $filters.first().focus();
        }
        else
        {
            $search.fadeOut();
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

});