<!-- Number of Users -->
<div class="row d-flex align-items-center justify-content-center w-100 mx-auto py-5">
    <div class="col-2 border border-dark  neu d-flex flex-column align-content-between m-3" style="width: 200px; height: 200px;">
        <h4 class="p-2 my-color">Users</h4>
        <div class="text-center fw-bold p-color" style="font-size: 100px;">
            <?= count($users_data) ?>
        </div>
    </div>
    <div class="col-2 border border-dark  neu d-flex flex-column align-content-between m-3 " style="width: 200px; height: 200px;">
        <h4 class="p-2 my-color">GUEST'S</h4>
        <div class="text-center fw-bold p-color" style="font-size: 100px;">
            <?= count($guest_data) ?>
        </div>
    </div>
</div>