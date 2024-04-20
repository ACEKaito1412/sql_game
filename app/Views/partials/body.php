<div class="container">
    <div class="row d-flex flex-lg-row flex-column align-items-center justify-content-center w-100 mx-auto py-5">
        <div class=" position-relative d-flex justify-content-between bg-danger " style="width:600px; height: 500px;">
            <div class="position-absolute d-flex justify-content-center top-50 start-50 translate-middle h-100 w-100" style="background-color: rgba(1,1,1,1);">
                <div class="d-flex flex-column align-items-center justify-content-center w-100 " style="display: none;">
                    <button class="btn neu neu-btn p-color w-50 m-2">Play As Guest</button>
                    <button class="btn neu neu-btn p-color w-50 m-2">Use a Username</button>
                    <button class="btn neu neu-btn p-color w-50 m-2">Register</button>
                </div>
                <div class=" flex-column align-items-center justify-content-center w-100" style="display: none;">
                    <h2>Login</h2>
                    <input type="text" class="form-control m-2 neu-inset w-50" placeholder="User-name">
                    <input type="password" class="form-control m-2 neu-inset w-50" placeholder="Password">
                    <button class="btn neu neu-btn p-color m-2  ">Play the game</button>
                </div>
                <div class=" flex-column align-items-center justify-content-center w-100" style="display: none;">
                    <h2>Register</h2>
                    <input type="text" class="form-control m-2 neu-inset w-50" placeholder="User-name">
                    <input type="password" class="form-control m-2 neu-inset w-50" placeholder="Password">
                    <input type="password" class="form-control m-2 neu-inset w-50" placeholder="Confirm-Password">
                    <button class="btn neu neu-btn p-color m-2  ">Play the game</button>
                </div>
            </div>
            <div class="border" style="width: 600px; height: 500px;">
                <div class="bg-primary" style="height: 85%;">

                </div>
                <div class="mt-3 row">
                    <div class="input-group mb-3" id="input_group" style="display: none;">
                        <input type="text" class="form-control neu-inset" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn neu neu-inset" type="button" id="button-addon2">Next</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 neu  mt-3 " style="height: 500px;">
            <h3 class="m-2 fw-bold my-color text-center">Leaderboard</h1>
                <div class="col overflow-y-scroll rmv-scroll" style="height: 430px;">
                    <?php for ($i = 1; $i < 20; $i++) : ?>
                        <div class="d-flex flex-row justify-content-between px-3 py-2 p-color neu m-2 rounded border border-dark">
                            <div class="d-flex flex-row">
                                <p class="my-0 mx-2"><?= $i ?></p>
                                <p class="fs-6 fw-semi-bold m-0">Juan Dela Cruz</p>
                            </div>
                            <p class="m-0"><?= 2000 - $i ?></p>
                        </div>
                    <?php endfor ?>
                </div>
        </div>
    </div>
</div>
<script>
    let gameStart = false;
    var input_group = document.querySelector('#input_group');
    if (!gameStart) {
        input_group.style.display = 'none';
    } else {
        input_group.style.display = 'block';
    }
</script>
<?php
echo view('partials/num_of_user')
?>