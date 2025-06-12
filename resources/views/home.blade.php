<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home Page</title>
    @include('@component/assets')

</head>

<body>
    @include('@component/navbar')
    <br>
    <div id="app" class="mx-auto">
         @include('@component/slide')
        <hr>
        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <center>
                <h1>Selamat Datang di Sistem Informasi Produksi</h1>
            </center>
        </div>
    </div>
    <br><br>
    @include('@component/footer')
    <script>
        const _TOKEN_ = '<?= csrf_token() ?>';
        new Vue({
            el : "#app",
            data : {
                
            },
            methods: {
                go: function(page){
                    window.location.href= "./"+page;
                }
            },
        })
    </script>

</body>
</html>
