$(function ()
{
    if (localStorage.collapse && localStorage.collapse == 1)
    {
        $('body').addClass('sidebar-collapse')
    }

    $('body').on('click', 'a[data-periodo_academico]', function ()
    {
        $.post($('li[data-periodo_academico_url]').data('periodo_academico_url'), {PERIODO: $(this).data('periodo_academico')}, function ()
        {
            location.href = '';
        });
    });
    $('.sidebar-toggle').on('click', function ()
    {
        if ($('body').hasClass('sidebar-collapse'))
        {
            localStorage.collapse = 1;
        }
        else
        {
            localStorage.collapse = 0;
        }
    });
});