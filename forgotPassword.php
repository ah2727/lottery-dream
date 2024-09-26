<?php
session_start();
include_once 'clases/db_connect.php';
include_once 'clases/send_Email.php';
include_once 'clases/register.php';
$pdo = new send_Email();

$errorMsg = '';

?>
<?php
if (isset($_POST['sendEmail'])){
    $sel = new register();
    $res = $sel->SelectbyEmail($_POST['email']);
    $email = $_POST['email'];
    if (!empty($res)){
        $token = bin2hex(openssl_random_pseudo_bytes(20));
        $sel->insertToken($token,$_POST['email']);
        $text ="<a href='https://lottery.re/resetPassword.php?token=$token&email=$email'>https://lottery.re/resetPassword.php?token=$token&email=$email 
        This link is avaliable for 30 minutes.
        </a>";
        $result = $pdo->forgotPassword("this is your email passwoord code:",$email,$text);
        if ($result){
            $_SESSION['successful'] = 'Email has been sended';
            header('Location:login.php');
        }
    }else{
        $errorMsg = "Email is not found";
    }
}
?>
<?php
include_once 'inc/header.php';
?>
<main>
    <div id="__next">
        <div class="flex items-center w-full md:pb-16 lg:pb-8 flex-col min-h-screen-8/10 bg-white md:bg-gradient-to-b from-blue-400 to-blue-100">
            <div class="flex flex-col items-stretch w-full sm:max-w-full lg:max-w-3xl md:max-w-2xl">
                <div class="flex justify-center md:pt-8 md:mx-6">
                    <div class="relative flex flex-col w-full md:w-125 lg:w-full items-stretch bg-white md:shadow lg:shadow md:rounded-2xl pt-8 md:pt-0">
                        <div class="flex flex-col px-6 lg:pt-6 md:pt-6 lg:px-22 md:px-11">
                            <div class="flex items-center justify-center pb-8">
                                <h3 class="mt-auto text-center font-black text-3xl">Forgot Password</h3>

                            </div>
                            <?php if(isset($_SESSION['RegS'])){
                                ?>
                                <div class="flex items-center justify-center pb-8">
                                    <h3 class="mt-auto text-center font-black text-1xl text-success"><?php echo $_SESSION['RegS']; unset($_SESSION['RegS'])?></h3>

                                </div>
                                <?php
                            }
                            ?>

                            <div class="flex flex-col items-stretch self-center lg:w-92">

                                <div class="px-4">
                                    <form action="" method="post">

                                        <div class="mb-4">
                                            <div role="presentation"
                                                 class="relative-stacking rounded transition-colors bg-white cursor-text border pointer-events-auto px-4 py-2 h-14 flex flex-row text-left border-gray-400">
                                                <div class=" flex-1">
                                                    <input name="email" id="Email" type="email" class="font-bold text-lg text-blue-800 outline-none w-full" style="height: 100%" placeholder="Email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mx-4 lg:mx-12 mb-5">
                                            <input id="signInButton" name="sendEmail" type="submit" value="Send Email"
                                                   class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold cursor-default p-4 border-gray-400"
                                                   style="width: 100%;background-color: rgba(196,220,51,var(--tw-bg-opacity));color: rgba(45,69,80,var(--tw-text-opacity))" >
                                        </div>
                                        <?php
                                        if (!empty($errorMsg)){
                                            ?>
                                            <div class="mb-3">
                                                <p class="text-center text-danger"><?=$errorMsg?></p>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </form>
                                </div>
                                <div class="relative inline-flex justify-between px-4 py-6 mb-8 bg-cover lg:hidden md:hidden bg-register-here-tablet rounded-xl">
                                    <p class="w-6/12 text-lg font-bold text-white">Create an account &amp; start
                                        playing!</p>
                                    <div class="mt-auto mb-auto text-center whitespace-pre"><a role="link"
                                                                                               class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold shadow-button hover:shadow-button-hov px-4 py-1 text-blue-800 bg-white active:bg-blue-lighter-04"
                                                                                               href="signUp/step1.php"><span>Register Here</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="justify-between hidden px-6 py-6 bg-cover lg:inline-flex md:inline-flex lg:relative md:relative  rounded-bl-2xl" style="background-image: url('image/RegisterHereBackgroundDesktop.svg')">
                            <p class="font-bold text-white">Create an account &amp; start playing!</p><a role="button"
                                                                                                         class="flex items-center justify-center rounded-full border text-sm transition duration-150 uppercase font-bold shadow-button hover:shadow-button-hov px-4 py-1 text-blue-800 bg-white active:bg-blue-lighter-04"
                                                                                                         href="signUp/step1.php"><span>Register Here</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include_once 'inc/footer.php';
?>
