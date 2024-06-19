
<html>

<body>

<div class="login" id="login">
    <div>
        <section id="btn_exit_login">
            <i class="fa-solid fa-xmark"></i>
        </section>
        <span>
            ورود
        </span>
        <form method="post" class="was-validated" action="index.php">
            <section>
                <div>
                    <span class="input-group-text" id="basic-addon1">نام کاربری:</span>
                    <input type="text" class="form-control" placeholder="Username"
                           aria-label="Username" aria-describedby="basic-addon1" required
                            minlength="3" maxlength="16"
                           pattern="[A-Za-z]+[A-Za-z0-9]{3,16}" name="username"
                           title="نام کاربری با حروف انگلیسی شروع شده و شامل حروف کوچک و بزرگ انگلیسی و اعداد می باشد.">
                    <div class="invalid-feedback">
                        نام کاربری را وارد کنید.
                    </div>
                </div>
                <div>
                    <span class="input-group-text" id="basic-addon1">رمز عبور:</span>
                    <input type="password" class="form-control" placeholder="Password"
                           aria-label="Password" aria-describedby="basic-addon1"
                           minlength="3" maxlength="16"
                           pattern="[A-Za-z0-9]{3,16}" name="password" required>
                    <div class="invalid-feedback">
                        رمز عبور را وارد کنید.
                    </div>
                </div>
                <div style="text-align: center">
                    <div class='form-check' style='margin-right: 15px; color: black; margin-top: 5px; transition: 0.2s; float: right'>
                        <input class='form-check-input' type='radio' name='level'
                               id='gender1' checked value='2' style='transition: 0.4s'>
                        <label class='form-check-label' for='gender1' style='color: black; margin-right: 75px'>
                            مشتری
                        </label>
                    </div>
                    <div class='form-check' style='margin-right: 15px; color: black; margin-top: 5px; transition: 0.2s; float: right'>
                        <input class='form-check-input' type='radio' name='level' id='gender2'
                               style='transition: 0.4s' value='0'>
                        <label class='form-check-label' for='gender2' style='color: black; margin-right: 25px'>
                            مدیر
                        </label>
                    </div>
                </div>
                <a id="btn_signin">ثبت نام نکرده ام!!!</a>
                <div>
                    <button class="btn btn-primary" type="submit">
                        ورود
                    </button>
                </div>

            </section>
        </form>
    </div>
</div>

<div class="login" id="signin">
    <div>
        <section id="btn_exit_signin">
            <i class="fa-solid fa-xmark"></i>
        </section>
        <span>
            ثبت نام
        </span>
        <span  style="margin-top: 150px; font-size: 15pt">
            جهت ثبت نام به دفتر مشاور املاک نجاتی مراجعه نمایید.
        </span>
        <a style="margin-top: 300px;" id="btn_login">قبلا ثبت نام کردم.</a>
    </div>
</div>


</body>


</html>
