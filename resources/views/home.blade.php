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
                <button @click="go('barang')" class="btn btn-active">Data Barang</button>
                <button @click="go('satuan')" class="btn btn-active btn-primary">Data Satuan</button>
                <button @click="go('jenis')" class="btn btn-active btn-secondary">Data Jenis</button>
                <button @click="go('brj')" class="btn btn-active btn-secondary">Barang Jadi</button>
                <button @click="go('supplier')" class="btn btn-active btn-secondary">Data Supplier</button>
                <button @click="go('rls_brg_sup')" class="btn btn-active btn-secondary">Barang Supplier</button>
                <button @click="go('customer')" class="btn btn-active btn-secondary">Data Customer</button>
                <button @click="go('rls_brg_cus')" class="btn btn-active btn-secondary">Barang Customer</button>
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
