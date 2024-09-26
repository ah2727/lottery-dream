<?php
?>
                    <?php
                    if (isset($_GET['menu']) && $_GET['menu'] == "SiteSetting"){
                        if (isset($_GET['type'])){
                            switch ($_GET['type']){
                                case 'addNewAdmin':
                                    include_once 'inc/addNewAdmin.php';
                                    break;
                                case "AdminSetting":
                                    include_once 'inc/AdminSetting.php';
                                    break;
                                case "Profile":
                                    include_once 'inc/profile.php';
                                    break;
                                default:
                                    include_once "inc/charts.php";
                            }
                        }else{
                            include_once "inc/charts.php";
                        }
                    }else{
                        include_once "inc/charts.php";
                    }

                    ?>
                </div>
            </div>
        </div>

    </section>