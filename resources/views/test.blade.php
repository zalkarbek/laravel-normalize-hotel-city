<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    </head>
    <body>
        <button id="normalize">
            нормализация
        </button>

        <button id="rollback">
            rollback
        </button>

        <script>
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            normaleButton = document.getElementById('normalize')
            rollbackButton = document.getElementById('rollback')

            normaleButton.addEventListener('click', function () {

                fetch('/normalize', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        is_normalize: 1,
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Ответ:', data);
                    alert('нормализация успешно завершен')
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });
            })

            rollbackButton.addEventListener('click', function () {

                fetch('/normalize', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({
                        is_normalize: 0,
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Ответ:', data);
                        alert('откат успешно завершен')
                    })
                    .catch(error => {
                        console.error('Ошибка:', error);
                    });
            })
        </script>
    </body>
</html>
