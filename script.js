
$(function(){

    // Сохраняем некоторые элементы в переменные для удобства

    var refreshButton = $('h1 img'),
        shoutboxForm = $('.shoutbox-form'),
        form = shoutboxForm.find('form'),
        closeForm = shoutboxForm.find('h2 span'),
        nameElement = form.find('#shoutbox-name'),
        commentElement = form.find('#shoutbox-comment'),
        ul = $('ul.shoutbox-content');

    // Заменяем :) на смайлики-эмоджи:
    emojione.ascii = true;

    // Загружаем комментарии.
    load();

    // При отправке формы, если все заполнено, публикуем сообщение в базе данных

    var canPostComment = true;

    form.submit(function(e){
        e.preventDefault();

        if(!canPostComment) return;

        var name = nameElement.val().trim();
        var comment = commentElement.val().trim();

        if(name.length && comment.length && comment.length < 240) {

            publish(name, comment);

            // Блокируем публикацию новых сообщений

            canPostComment = false;

            // Разрешаем новому комментарию быть опубликованным через 5 секунд

            setTimeout(function(){
                canPostComment = true;
            }, 5000);

        }

    });

    // Переключаем видимость формы.

    shoutboxForm.on('click', 'h2', function(e){

        if(form.is(':visible')) {
            formClose();
        }
        else {
            formOpen();
        }

    });

    // При клике на кнопку REPLY (Ответить) происходит добавление в текстовое поле имени человека, которому вы хотели бы ответить.

    ul.on('click', '.shoutbox-comment-reply', function(e){

        var replyName = $(this).data('name');

        formOpen();
        commentElement.val('@'+replyName+' ').focus();

    });

    // При клике на кнопку «Обновить» происходит срабатывание функции load

    var canReload = true;

    refreshButton.click(function(){

        if(!canReload) return false;

        load();
        canReload = false;

        // Разрешаем дополнительные перезагрузки через 2 секунды
        setTimeout(function(){
            canReload = true;
        }, 2000);
    });

    // Автоматически обновляем сообщения каждые 20 секунд
    setInterval(load,20000);


    function formOpen(){

        if(form.is(':visible')) return;

        form.slideDown();
        closeForm.fadeIn();
    }

    function formClose(){

        if(!form.is(':visible')) return;

        form.slideUp();
        closeForm.fadeOut();
    }

    // Сохраняем сообщение в базе данных

    function publish(name,comment){

        $.post('publish.php', {name: name, comment: comment}, function(){
            nameElement.val("");
            commentElement.val("");
            load();
        });

    }

    // Получаем последние сообщения

    function load(){
        $.getJSON('./load.php', function(data) {
            appendComments(data);
        });
    }

    // Обрабатываем массив с сообщениями в виде HTML

    function appendComments(data) {

        ul.empty();

        data.forEach(function(d){
            ul.append('<li>'+
                '<span class="shoutbox-username">' + d.name + '</span>'+
                '<p class="shoutbox-comment">' + emojione.toImage(d.text) + '</p>'+
                '<div class="shoutbox-comment-details"><span class="shoutbox-comment-reply" data-name="' + d.name + '">REPLY</span>'+
                '<span class="shoutbox-comment-ago">' + d.timeAgo + '</span></div>'+
            '</li>');
        });

    }

});
