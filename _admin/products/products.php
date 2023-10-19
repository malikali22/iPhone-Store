<?php include './partials/admin_header.php'; ?>
<?php include './partials/admin_sideBar.php'; ?>

<?php

if (!isset($_SESSION['admin_l_name'])) {
    header('Location: admin_auth/login.php');
}

$alert = false;

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<?php if (isset($_SESSION['alert'])) {
    $alert = $_SESSION['alert'];
    $type = $_SESSION['type'];
    $alert_title = $_SESSION['alert_title'];
    $alert_message = $_SESSION['alert_message'];
}
?>

<?php include '../partials/flash_messages.php';

$_SESSION['alert'] = false;
$_SESSION['type'] = false;
$_SESSION['alert_title'] = false;
$_SESSION['alert_message'] = false;
?>

<div class="container my-5 p-0">
    <div class="" style="margin-right: 40px;">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Products</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover text-center">
                    <thead class="table-secondary">

                        <tr class="align-middle">
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Color</th>
                            <th>Storage</th>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Catagory</th>
                            <th>Code</th>
                            <th>Price</th>
                            <th>
                                <a href="../action.php?database_remove_all" class="btn btn-outline-danger p-1 <?php echo ($result->num_rows > 0) ? "" : "disabled"  ?>" onclick="return confirm('Are you sure want to remove all items?')">&nbsp;<i class="fas fa-trash"></i>&nbsp;&nbsp;Remove All</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $grand_total = 0;
                        while ($row = $result->fetch_assoc()
                        ) { ?>
                            <tr class="align-middle">
                                <td><?php echo $i ?></td>
                                <td><img class="p-2" style="width: 75px;" src="../assets/images/products/<?php echo $row['product_image_path'] ?>"></td>
                                <td><?php echo $row['product_name'] ?></td>
                                <td><?php echo $row['product_color'] ?></td>
                                <td><?php echo $row['product_storage'] ?> GB</td>
                                <td class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque et minima suscipit, recusandae officia consectetur.</td>
                                <td><?php echo $row['avalible_quantity'] ?></td>
                                <td><?php echo $row['product_catagory'] ?></td>
                                <td><?php echo $row['product_code'] ?></td>
                                <td>$<?php echo number_format($row['product_price'], 2) ?></td>
                                <td>
                                    <a href="edit_product.php?id=<?php echo $row['id'] ?>" class="text-primary"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                                    <a href="../action.php?database_remove_item_id=<?php echo $row['id'] ?>" class="text-danger" onclick="return confirm('Are you sure want to remove this item from cart?')"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php
                            $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php include './partials/admin_footer.php'; ?>