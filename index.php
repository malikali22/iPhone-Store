<?php include 'partials/header.php'; ?>

<style>
    #dismiss-btn {
        cursor: pointer;
    }

    #dismiss-btn:hover {
        color: #b91d1d;
        /* transition:; */
    }

    #card-link {
        text-decoration: none;
        color: inherit;
        background-color: transparent;
    }

    #p-card:hover {
        box-shadow: 0 0 5px 2px gray;
        transition: box-shadow 0.2s 0.1s;

    }

    #p-card:not(:hover) {
        box-shadow: none;
        transition: box-shadow 1s;
    }

    #card-img:hover {
        padding: 37px !important;
        transition: padding 0.7s ease-in-out;
    }

    #card-img:not(:hover) {
        padding: 48px !important;
        transition: padding 1s;
    }

    @media screen and (max-width : 1600px) {
        #main_products_image {
            width: 1500px;
        }
    }

    @media screen and (max-width : 1550px) {
        #main_products_image {
            width: 1350px;
        }

        #phoneCollection {
            width: 400px;
            height: auto;
        }

        #ipadCollection {
            width: 600px;
            height: auto;
        }

        #watchCollection {
            width: 400px;
            height: auto;
        }

        #singleWatch {
            width: 400px;
            height: auto;
        }

        .content_box {
            width: 1000px !important;
        }
    }

    @media screen and (max-width : 1400px) {
        #main_products_image {
            width: 1250px;
        }

        .content_box {
            width: 900px !important;
        }
    }

    @media screen and (max-width : 1300px) {
        #main_products_image {
            width: 1000px;
        }

        .content_box {
            width: 800px !important;
        }

        .support-icons {
            width: 180px;
        }
    }

    @media screen and (max-width : 1200px) {
        #phoneCollection {
            width: 350px;
            height: auto;
        }

        #ipadCollection {
            width: 500px;
            height: auto;
        }

        #watchCollection {
            width: 350px;
            height: auto;
        }

        #singleWatch {
            width: 350px;
            height: auto;
        }
    }

    @media screen and (max-width : 1050px) {
        #main_products_image {
            width: 800px;
        }

        #phoneCollection {
            width: 280px;
            height: auto;
        }

        #ipadCollection {
            width: 400px;
            height: auto;
        }

        #watchCollection {
            width: 280px;
            height: auto;
        }

        #singleWatch {
            width: 280px;
            height: auto;
        }

        .content_box {
            width: 650px !important;
        }

        .support-icons {
            width: 120px;
        }

        .footer_main_box {
            padding: 48px 30px !important;
        }
    }

    @media screen and (max-width : 770px) {
        #main_products_image {
            width: 600px;
        }

        #phoneCollection {
            width: 200px;
            height: auto;
        }

        #ipadCollection {
            width: 300px;
            height: auto;
        }

        #watchCollection {
            width: 200px;
            height: auto;
        }

        #singleWatch {
            width: 200px;
            height: auto;
        }

        .content_box {
            width: 700px !important;
        }

        .support-icons-container {
            margin-inline: 40px !important;
        }

        .support-icons {
            width: 100px;
        }

        .support-icons-container>p {
            font-size: 1.5vw;
        }

        #footer_container {
            padding-inline: 20px !important;
        }

        .footer_main_box>h5 {
            font-size: 1.7vw;
        }

        .footer_main_box {
            padding: 48px 10px !important;
            margin: 0 !important;
            font-size: 1.5vw;
        }

        /* #footer_main_box_2{
            width: 200px !important;
        } */
    }

    @media screen and (max-width : 430px) {
        #main_products_image {
            width: 380px;
        }

        #collectin_img_container>div {
            flex-direction: column;
            /* height: 400px; */
        }

        #phoneCollection {
            width: 200px;
            height: auto;
        }

        #ipadCollection {
            width: 280px;
            height: auto;
            padding-top: 70px !important;
            padding-bottom: 5px !important;
        }

        #watchCollection {
            width: 200px;
            /* height: auto; */
            margin-top: 5px;
            padding-top: 55px !important;
        }

        #singleWatch {
            width: 200px;
            height: auto;
            padding-top: 40px !important;

        }
        #content_box_container{
            padding-inline: 20px !important;
        }

        .content_box {
            display: flex;
            flex-direction: column;
            width: 100% !important;
            margin-inline: 20px;
        }

        .content_box > div {
            width: 100% !important;
        }

        .content_box > div:first-child {
            margin-bottom: 48px !important;
        }

        .support-icons-container {
            margin-inline: 10px !important;
        }
        .support-icons-container > p {
            font-size: 3vw;
        }

        .support-icons {
            width: 80px;
        }

        #footer_container {
            padding-inline: 20px !important;
        }
        #footer_main{
            flex-direction: column;  
        }
        .footer_main_box {
            padding: 48px 10px !important;
            margin: 0 !important;
            width: 100% !important;
            font-size: 4vw;
        }
        .footer_main_box >h5 {
            font-size: 5vw;
        }
    }

    @media screen and (max-width : 375px) {
        #main_products_image {
            width: 350px;
        }

        #collectin_img_container>div {
            flex-direction: column;
            /* height: 400px; */
        }

        #phoneCollection {
            width: 200px;
            height: auto;
        }

        #ipadCollection {
            width: 280px;
            height: auto;
            padding-top: 70px !important;
            padding-bottom: 5px !important;
        }

        #watchCollection {
            width: 200px;
            /* height: auto; */
            margin-top: 5px;
            padding-top: 55px !important;
        }

        #singleWatch {
            width: 200px;
            height: auto;
            padding-top: 40px !important;

        }

        .support-icons-container {
            margin-inline: 10px !important;
        }
        .support-icons-container > p {
            font-size: 3vw;
        }

        .support-icons {
            width: 60px;
        }
        #footer_main{
            flex-direction: column;  
        }
        .footer_main_box {
            padding: 48px 10px !important;
            margin: 0 !important;
            width: 100% !important;
            font-size: 4vw;
        }
        .footer_main_box >h5 {
            font-size: 5vw;
        }
    }

    @media screen and (max-width : 321px) {
        #main_products_image {
            width: 280px;
        }

        #collectin_img_container>div {
            flex-direction: column;
            /* height: 400px; */
        }

        #phoneCollection {
            width: 200px;
            height: auto;
        }

        #ipadCollection {
            width: 280px;
            height: auto;
            padding-top: 70px !important;
            padding-bottom: 5px !important;
        }

        #watchCollection {
            width: 200px;
            /* height: auto; */
            margin-top: 5px;
            padding-top: 55px !important;
        }

        #singleWatch {
            width: 200px;
            height: auto;
            padding-top: 40px !important;

        }

        .support-icons-container {
            margin-inline: 10px !important;
        }
        .support-icons-container > p {
            font-size: 3vw;
        }
        .support-icons {
            width: 50px;
        }

        #footer_container {
            padding-inline: 20px !important;
        }
        #footer_main{
            flex-direction: column;  
        }

        .footer_main_box {
            padding: 48px 10px !important;
            margin: 0 !important;
            width: 100% !important;
            font-size: 4vw;
        }
        .footer_main_box >h5 {
            font-size: 5vw;
        }
        #footer_end{
            font-size: 4vw;
        }
    }
</style>

<?php

$alert = false;

$sql = "SELECT * FROM pcatagories";
$result = $conn->query($sql);

if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    $type = $_SESSION['type'];
    $alert_title = $_SESSION['alert_title'];
    $alert_message = $_SESSION['alert_message'];
}

?>


<div class="text-center pt-5" style="background-color: black;">

    <?php include './partials/flash_messages.php';

    $_SESSION['alert'] = false;
    $_SESSION['type'] = false;
    $_SESSION['alert_title'] = false;
    $_SESSION['alert_message'] = false;
    ?>

    <img class="my-5" id="main_products_image" src="./assets/images/others/main_products_image.png" alt="">
</div>


<div class="container my-5">
    <div class="pt-5 mb-5 d-flex justify-content-center">
        <form class="d-flex align-middle col-lg-6" role="search">
            <input id="searchTerm" class="form-control me-2" style="height: 45px;" type="search" placeholder="I'm looking for..." aria-label="Search">
            <button id="searchButton" class="btn btn-outline-secondary">Search</button>
        </form>
    </div>
    <!-- <div class="p-3" style="background-color: white; border-radius: 20px;"> -->
    <div id="search-item-dismiss" class="d-none text-end mb-1 px-1" style="margin-top: -8px;">
        <i class="fas fa-remove me-1" id="dismiss-btn"></i>
    </div>
    <div class="row" id="searchedProducts">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <a href="./catagory_items.php?product_catagory=<?= $row['product_catagory'] ?>" id="card-link">
                    <div class="card h-100" id="p-card">
                        <img id="card-img" style="background-color: #b0b0b0;" src="assets/images/product_profiles/<?php echo $row['product_profile_img_path'] ?>" class="card-img-top img-fluid p-5" alt="Product Image" style="size: 170px;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $row['product_catagory'] ?></h5>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
        <!-- </div> -->
    </div>
</div>

<div id="collectin_img_container" style="margin-top: 150px;">
    <div style="display: flex; justify-content: space-evenly;">
        <a href="catagory_items.php?product_catagory=iPhone" class="d-flex justify-content-center align-items-center w-100" style="margin: 5px 5px 0px 0; padding-top: 55px; background-color: black;">
            <img id="phoneCollection" src="./assets/images/others/phone_collection.jpg" alt="">
        </a>
        <a href="catagory_items.php?product_catagory=Macbook" class="d-flex justify-content-center align-items-center w-100" style="margin: 5px 0px 0px 0; background-color: black;">
            <img id="ipadCollection" width="720" height="310" src="./assets/images/others/ipad_collections.jpg" alt="">
        </a>
    </div>
    <div style="display: flex; justify-content: space-evenly;">
        <a href="catagory_items.php?product_catagory=Watch" class="d-flex justify-content-center align-items-center w-100" style="margin: 5px 5px 0px 0; background-color: black;">
            <img id="watchCollection" width="480" height="400" src="./assets/images/others/watch_collections.png" alt="">
        </a>
        <a href="catagory_items.php?product_catagory=Watch" class="d-flex justify-content-center align-items-center w-100" style="margin: 5px 0px 0px 0; background-color: black;">
            <img id="singleWatch" src="./assets/images/others/watch.jpg" alt="">
        </a>
    </div>
</div>

<div id="content_box_container" class="d-flex flex-column align-items-center my-5">
    <div class="content_box p-5 w-50 mb-5" style="background-color: white; border-radius: 30px;">
        <h5 class="text-center fw-bold pb-3">Safe and reliable repairs</h5>
        <p class="text-center">At Apple, every product we make is built to last. We design durable, easy-to-use devices with innovative features that customers depend on, all while protecting their privacy and data. Customers should have access to safe, reliable, and secure repairs with genuine Apple parts if they need them.
            <br><br>
            Learn more about Apple’s approach to expanding access to safe and reliable repairs.
        </p>
    </div>
    <div class="content_box d-flex justify-content-center w-50">
        <div class="p-5 w-75 me-3" style="background-color: white; border-radius: 30px;">
            <h5 class="fw-bold pb-3">Beware of counterfeit parts</h5>
            <p class="">Some counterfeit and third party power adapters and batteries may not be designed properly and could result in safety issues. To ensure you receive a genuine Apple battery during a battery replacement, we recommend visiting an Apple Store or Apple Authorized Service Provider. If you need a replacement adapter to charge your Apple device, we recommend getting an Apple power adapter.
            </p>
        </div>
        <div class="p-5 w-50" style="background-color: white; border-radius: 30px;">
            <!-- <i class="fas fa-gift fa-2x"></i> -->
            <img class="mb-3" src="./assets/icons/icon_giftcard.svg" alt="" width="60px">
            <h5 class="fw-bold pb-3">Be aware of gift card scams</h5>
            <p class="">Be aware of scams involving Apple Gift Cards, App Store & iTunes Gift Cards, and Apple Store Gift Cards.
            </p>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center py-5 text-white my-5" style="background-color: black;">
    <span class="support-icons-container d-flex flex-column align-items-center mx-5">
        <img class="support-icons" src="./assets/icons/icon_thumb.png" alt="" width="250px">
        <p class="fw-bold text-center mt-3">100% Original Products</p>
    </span>
    <span class="support-icons-container d-flex flex-column align-items-center mx-5">
        <img class="support-icons" src="./assets/icons/icon_warrante.png" alt="" width="250px">
        <p class="fw-bold text-center mt-3">One Year Warranty</p>
    </span>
    <span class="support-icons-container d-flex flex-column align-items-center mx-5">
        <img class="support-icons" src="./assets/icons/icon_repair.png" alt="" width="250px">
        <p class="fw-bold text-center mt-3">Free One Year Repair</p>
    </span>
    <span class="support-icons-container d-flex flex-column align-items-center mx-5">
        <img class="support-icons" src="./assets/icons/icon_customer_support.png" alt="" width="250px">
        <p class="fw-bold text-center mt-3">Professional Customer Suport</p>
    </span>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $("#searchTerm").click(function() {
            $("#searchTerm").removeClass("border-danger");
        });
        $("#searchButton").click(function(e) {
            e.preventDefault();
            var searchTerm = $("#searchTerm").val();
            if (searchTerm == "") {
                $("#searchTerm").addClass("border-danger");
                alert("Please enter your desired product name");
            } else {
                $("#search-item-dismiss").removeClass("d-none");

                $.ajax({
                    url: "action.php",
                    type: "POST",
                    data: {
                        searchTerm: searchTerm
                    },
                    success: function(data) {
                        $("#searchedProducts").html(data);
                    }
                });
            }
        });

        $("#dismiss-btn").click(function() {
            var searchTerm = "xyz";
            $.ajax({
                url: "action.php",
                type: "POST",
                data: {
                    searchTerm: searchTerm
                },
                success: function(data) {
                    $("#searchedProducts").html(data);
                }
            });
            $("#search-item-dismiss").addClass("d-none");
        });
    });
</script>

<?php include 'partials/footer.php'; ?>