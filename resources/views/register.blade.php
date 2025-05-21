<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Page</title>
    @include('@component/assets')

</head>

<body class="bg-base-200 min-h-screen flex items-center justify-center">

    <div id="app" class="card w-full max-w-md shadow-2xl bg-base-100">
        <div class="card-body">
            <h2 class="text-2xl font-bold text-center mb-4">Daftar Akun</h2>

            <div v-if="alert" role="alert" class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Error! Password Doesnt Match</span>
            </div>


            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text"></span>
                </label>
                <input type="text" v-model="name" ref="name" placeholder="Nama lengkap"
                    class="input input-bordered" required />
            </div>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text"> </span>
                </label>
                <input type="email" v-model="email" ref="email" placeholder="Email " class="input input-bordered"
                    required />
            </div>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text"></span>
                </label>
                <input type="password" v-model="password" ref="password" placeholder="Password"
                    class="input input-bordered" required />
            </div>

            <div class="form-control mb-4">
                <label class="label">
                    <span class="label-text"></span>
                </label>
                <input type="password" v-model="confirm" ref="confirm" placeholder="Confirmation Password"
                    class="input input-bordered" required />
            </div>


            <div class="form-control mt-4">
                <button class="btn btn-primary" @click="register">Register</button>
            </div>
      <hr>

            <p class="text-sm text-center mt-4">
                Sudah punya akun?
                <a href="/login" class="text-primary hover:underline">Masuk di sini</a>
            </p>
        </div>
    </div>

    <script>
        new Vue({
            el: "#app",
            data: {
                name: null,
                email: null,
                password: null,
                confirm: null,
                alert : false
            },
            methods: {
                register: function() {
                    if (this.name == null) {
                        this.$refs.name.focus();
                        return;
                    }
                    if (this.email == null) {
                        this.$refs.email.focus();
                        return;
                    }
                    if (this.password == null) {
                        this.$refs.password.focus();
                        return;
                    }
                    if (this.confirm == null) {
                        this.$refs.confirm.focus();
                        return;
                    }

                    if (this.password != this.confirm) {
                        this.alert = true;
                        return;
                    }
                    this.alert = false;
                    const $this = this;
                    // Ini buat request method POST ke route /register
                    axios.post("/register", {
                            name: this.name,
                            email: this.email,
                            password: this.confirm,
                        })
                        .then(function(response) {

                            if (response.data.result === false) {
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: response.data.message,
                                    footer: ''
                                });
                                $this.name = null;
                                $this.email = null;
                                $this.password = null;
                                $this.confirm = null;
                            } else {
                                Swal.fire({
                                    icon: "success",
                                    title: "Mantap",
                                    text: "Register Success",
                                    footer: ''
                                });
                                window.location.href="/login"
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }
            },
            mounted() {

            }
        });
    </script>

</body>

</html>
