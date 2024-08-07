jQuery(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Раскрытие и скрытие пунктов меню каталога в левой колонке
    $('#catalog-sidebar > ul ul').hide();
    $('#catalog-sidebar .badge').on('click', function () {
        var $badge = $(this);
        var $submenu = $badge.closest('li').children('ul');
        var isClosed = $submenu.is(':hidden');
        console.log(isClosed);

        // var closed = $badge.siblings('ul') && !$badge.siblings('ul').is(':visible');

        if (isClosed) {
            $submenu.slideDown('normal', function () {
                $badge.children('i').removeClass('fa-plus').addClass('fa-minus');
            });
        } else {
            $submenu.slideUp('normal', function () {
                $badge.children('i').removeClass('fa-minus').addClass('fa-plus');
            });
        }
    });

    //Получение данных профиля пользователя при оформлении заказа
    $('form#profiles button[type="submit"]').hide();
    // при выборе профиля отправляем ajax-запрос, чтобы получить данные
    $('form#profiles select').change(function () {
        // если выбран элемент «Выберите профиль»
        if ($(this).val() == 0) {
            // очищаем все поля формы оформления заказа
            $('#checkout').trigger('reset');
            return;
        }
        var data = new FormData($('form#profiles')[0]);
        $.ajax({
            url: '/basket/profile',
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                $('input[name="name"]').val(data.profile.name);
                $('input[name="email"]').val(data.profile.email);
                $('input[name="phone"]').val(data.profile.phone);
                $('input[name="address"]').val(data.profile.address);
                $('textarea[name="comment"]').val(data.profile.comment);
            },
            error: function (reject) {
                alert(reject.responseJSON.error);
            }
        });
    });
    // Добавление товара в корзину с помощью ajax-запроса без перезагрузки
    $('form.add-to-basket').submit(function (e) {
        // отменяем отправку формы стандартным способом
        e.preventDefault();
        // получаем данные этой формы добавления в корзину
        var $form = $(this);
        var data = new FormData($form[0]);
        $.ajax({
            url: $form.attr('action'),
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'HTML',
            beforeSend: function () {
                var spinner = ' <span class="spinner-border spinner-border-sm"></span>';
                $form.find('button').append(spinner);
            },
            success: function(html) {
                $form.find('.spinner-border').remove();
                $('#top-basket').html(html);
            }
        });
    });
});
