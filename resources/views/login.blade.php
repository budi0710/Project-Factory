<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login SIP</title>
    @include('@component/assets')

</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div id="app" class="w-full max-w-md p-8 bg-white shadow-xl rounded-xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login</h2>
      
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="email">Email</label>
                <input v-model="email" ref="email" id="email" type="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="you@example.com" required />
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="password">Password</label>
                <input v-model="password" ref="password" id="password" type="password"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter your password" required />
            </div>

            <div class="mb-6">
                <button type="button" @click="login"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700">
                    Login
                </button>
                <br><br>
                <a class="link link-info" href="/register">Register</a> <br>  
                <a class="link link-info" href="/forgot">Forgot Password</a>
            </div>

      
    </div>

    <script>
        const _TOKEN_ = '<?= csrf_token(); ?>';

        new Vue({
            // #app adalah element dari div
            el: "#app",
            data: {
                // email dan password adalah data yang akan diakses di vue dari v-model
                email: null,
                password: null
            },
            methods: {
                // login adalah method yang akan dijalankan ketika button login di klik
                login: function() {
                    if (this.email == null) {
                        this.$refs.email.focus();
                        return;
                    }
                    if (this.password == null) {
                        this.$refs.password.focus();
                        return;
                    }

                    const $this = this;
                    // membuat request ke server dengan method POST ke route login
                    axios.post("/login", {
                            // mengirimkan data email dan password ke server
                            email: this.email,
                            password: this.password,
                            _token : _TOKEN_
                        })
                        .then(function(response) {
                            // check response dari server response.data.result jika false maka menampilkan pesan
                             if (response.data.result===false){
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "Something went wrong!",
                                    footer: ''
                                });
                             }else{
                                Swal.fire({
                                    icon: "success",
                                    title: "Mantap",
                                    text: "Login Success",
                                    footer: ''
                                });
                                window.location.href= "/home"
                             }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }
            }
        });
    </script>
</body>

</html>
