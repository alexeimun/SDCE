$(function ()
{
    if (localStorage.collapse && localStorage.collapse == 1)
    {
        $('body').addClass('sidebar-collapse');
    }

    $('body').on('click', 'a[data-periodo_academico]', function ()
    {
        $.post($('li[data-periodo_academico_url]').data('periodo_academico_url') + 'parametros/CambiarPeriodoAcdemicoAjax', {PERIODO: $(this).data('periodo_academico')}, function ()
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
    setTimeout(function ()
    {
        $.post($('li[data-periodo_academico_url]').data('periodo_academico_url') ? $('li[data-periodo_academico_url]').data('periodo_academico_url') : '' + '/app/sessionIsActive', function (data)
        {
            if (data == 'ok')
            {
                location.replace('http://www.fumc.edu.co');
            }
        });
    }, 15 * 60 * 1000);
});

$(document).on('ready', function ()
{
   if(localStorage.cooperador && localStorage.cooperador==1)
   {
       $('header').hide(500);
       $('.main-sidebar').hide(500);
       $('#unlockcooperador').show(500);
   }
});