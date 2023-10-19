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
</style>
<?php
$alert = false;

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    $type = $_SESSION['type'];
    $alert_title = $_SESSION['alert_title'];
    $alert_message = $_SESSION['alert_message'];
}

?>
<?php include './partials/flash_messages.php';

$_SESSION['alert'] = false;
$_SESSION['type'] = false;
$_SESSION['alert_title'] = false;
$_SESSION['alert_message'] = false;
?>


<div class="container my-5">
    <div class="mb-5 d-flex justify-content-center">
        <form class="d-flex align-middle col-lg-6" role="search">
            <input id="searchTerm" class="form-control me-2" style="height: 45px;" type="search" placeholder="I'm looking for..." aria-label="Search">
            <button id="searchButton" class="btn btn-outline-secondary" type="submit">Search</button>
        </form>
    </div>
    <div id="search-item-dismiss" class="d-none text-end mb-1 px-1" style="margin-top: -8px;">
        <i class="fas fa-remove me-1" id="dismiss-btn"></i>
    </div>
    <div class="row" id="searchedProducts">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="col-sm-6 col-md-4 col-lg-3  mb-3 ">
                <a href="./product_description.php?id=<?= $row['id'] ?>" id="card-link">
                    <div class="card h-100" id="p-card">
                        <img id="card-img" style="background-color: #b0b0b0;" src="assets/images/products/<?php echo $row['product_image_path'] ?>" class="card-img-top img-fluid  p-5" alt="Product Image" style="size: 170px;">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $row['product_name'] ?></h5>
                            <p class="cart-text text-center text-primary" style="font-size: 18px;">$<?php echo number_format($row['product_price'], 2) ?></p>
                        </div>

                        <div class="card-footer text-center">
                            <a href="action.php?add_cart_item_id=<?php echo $row['id'] ?>" id="add-to-cart-btn" class="btn btn-outline-primary  w-75 p-2"><i class="fas fa-cart-plus">&nbsp;&nbsp;</i>Add to cart</a>
                            <a href="action.php?add_wishlist_item_id=<?php echo $row['id'] ?>" class="btn btn-outline-danger px-2"><i class="fas fa-heart" style="font-size: 1.5rem;"></i></a>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        
        $("#searchTerm").click(function(){
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